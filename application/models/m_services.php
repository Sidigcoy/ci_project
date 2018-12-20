<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_services extends CI_Model {

	
	public function tampil_jenis()
	{
		return $this->db->query("SELECT * from myhris.sys_user;");
	}

	public function tampil_surat_keluar()
	{
		return $this->db->query("SELECT * from APPS.PER_ALL_PEOPLE_F pp where pp.PERSON_ID ='83730';");
	}
	
	public function man_power()
	{
		return $this->db->query("select   
									pp.employee_number P_EMPLOYEE_NUMBER,
									pp.last_name P_NAME,
									pp.sex P_GENDER,
									substr(pg.name,0,1) P_GRADE ,  
									pp.DATE_OF_BIRTH P_DATE_OF_BIRTH,
									ppo.date_start P_STARTING_DATE,
									ppo.actual_termination_date P_RESIGN_DATE,
									ppg.group_name P_JOB_TYPE,
									paa.EMPLOYMENT_CATEGORY P_EMPLOYEMENT_STATUS,
									upper(hl.LOCATION_CODE) P_BRANCH_NAME,
									pj.name P_JOB,
									haou.name P_ORGANIZATION,
									pos.name P_POSITION, 
									(select upper(h.location_code) from hr_locations h 
									where h.location_id = pp.attribute1 and pp.attribute_category like 'BAF_ADDITIONAL_PERSONAL') P_HOMEBASE,
									CASE pp.PER_INFORMATION9
									WHEN NULL
									THEN NULL
									WHEN '1'
									THEN 'SMU'
									WHEN '2'
									THEN 'D1'
									WHEN '3'
									THEN 'D2'
									WHEN '4'
									THEN 'D3'
									WHEN '5'
									THEN 'S1'
									WHEN '6'
									THEN 'S2'
									WHEN  '7'
									THEN 'S3'
									ELSE 'D4'
									END AS P_Education,

									CASE pp.MARITAL_STATUS
									WHEN NULL
									THEN NULL
									WHEN 'S'
									THEN 'Single'
									WHEN 'M'
									THEN 'Married'
									WHEN 'BAF_04'
									THEN 'Widow'
									ELSE 'Widower'
									END AS P_Status
													

									from 
									PER_ALL_PEOPLE_F pp, 
									PER_ALL_ASSIGNMENTS_F paa,
									per_jobs pj,
									HR_LOCATIONS HL,
									pay_people_groups ppg, 
									per_positions pos, 
									per_periods_of_service ppo, 
									hr_all_organization_units haou, 
									per_grades pg

									where pp.person_id = paa.person_id
									AND paa.job_id = pj.job_id
									AND paa.people_group_id = ppg.people_group_id
									AND pp.person_id = ppo.person_id
									and paa.LOCATION_ID = HL.LOCATION_ID
									AND paa.position_id = pos.position_id 
									and haou.ORGANIZATION_ID = paa.ORGANIZATION_ID
									and pg.grade_id = paa.grade_id 
									AND  trunc(sysdate) BETWEEN paa.effective_start_date AND paa.effective_end_date
									AND  trunc(sysdate) BETWEEN pp.effective_start_date AND pp.effective_end_date
									order by pp.employee_number"
											);
	}
	
	public function sisa_cuti_resign()
	{
		return $this->db->query("SELECT DISTINCT pas.assignment_number NIK,
											pap.last_name NAMA,
											per_utility_functions.get_net_accrual (pas.assignment_id,
											61,
											81,
											1,
											TRUNC (SYSDATE), --PerTanggal Eksekusi)
											1061,
											NULL,
											NULL)
											SISA_CUTI,
											TO_CHAR(ppos.actual_termination_date, 'dd-Mon-rrrr') TANGGAL_RESIGN    
											FROM per_all_assignments_f pas, per_all_people_f pap, per_periods_of_service ppos
											WHERE     pas.person_id = pap.person_id
											AND pas.person_id = ppos.person_id
											AND  pas.person_id = ppos.person_id
											AND ppos.actual_termination_date IS NOT NULL
											AND ppos.actual_termination_date BETWEEN pas.effective_start_date
											AND pas.effective_end_date
											AND ppos.actual_termination_date IS NOT NULL   
											AND TO_CHAR (ppos.actual_termination_date,'rrrr')  ='2016';"
											);
	}
	
	public function non_myhris()
	{
		return $this->db->query("
											SELECT distinct 
											pp.employee_number P_EMPLOYEE_NUMBER,
											pp.last_name P_NAME,
											upper(hl.LOCATION_CODE) P_BRANCH_NAME,
											pj.name P_JOB,
											haou.name P_ORGANIZATION,
											pos.name P_POSITION  

											from 
											PER_ALL_PEOPLE_F pp, 
											PER_ALL_ASSIGNMENTS_F paa,
											per_jobs pj,
											HR_LOCATIONS HL,
											pay_people_groups ppg, 
											per_positions pos, 
											per_periods_of_service ppo, 
											hr_all_organization_units haou, 
											per_grades pg

											where pp.person_id = paa.person_id
											AND paa.job_id = pj.job_id
											AND paa.people_group_id = ppg.people_group_id
											AND pp.person_id = ppo.person_id
											and paa.LOCATION_ID = HL.LOCATION_ID
											AND paa.position_id = pos.position_id 
											and haou.ORGANIZATION_ID = paa.ORGANIZATION_ID
											and pg.grade_id = paa.grade_id
											and (ppo.actual_termination_date >= sysdate or ppo.actual_termination_date is null)  
											and ppo.date_start <= sysdate 
											AND (sysdate) BETWEEN paa.effective_start_date AND paa.effective_end_date  
											AND (sysdate) BETWEEN pp.effective_start_date AND pp.effective_end_date   
											and pp.employee_number not in 
											(
												select distinct 
												msu.user_name nik 

												from 
												myhris.sys_user msu,
												per_all_assignments_f paa,
												hr_locations hl,
												hr_all_organization_units hou,
												per_all_people_f pap

												where msu.user_name=paa.assignment_number
												and paa.person_id = pap.person_id
												and paa.ORGANIZATION_ID=hou.organization_id
												and paa.LOCATION_ID=hl.location_id
												and paa.EFFECTIVE_end_DATE = (select max(paa1.EFFECTIVE_END_DATE) from per_all_assignments_f paa1 where paa.ASSIGNMENT_ID=paa1.ASSIGNMENT_ID)
											)
											order by pp.employee_number;
											" );
	}

	public function history_employee()
	{
		return $this->db->query("SELECT  per.employee_number nik, per.last_name Employee_Name, to_char(per.start_date ,'dd-Mon-rrrr') Date_Hire
											, ppt.user_person_type Status_Current
											,hrlhb.location_code Homebase, past.USER_STATUS Employee_Type 
											,substr(hrl.attribute6,1,3) Branch_Code, hrl.location_code Branch,orgu.NAME Departement
											, pj.name Job,pos.NAME position,ppg.segment1 Job_Type,pg.name Grade,pay.payroll_name
											,ass.employment_category Employee_Category,ass.ass_attribute_category Ass_Context_Values
											,ass.ass_attribute1 Ass_Type,ass.ass_attribute3 Employee_Shift,ass.ass_attribute6 Ass_Letter_Type
											,ass.ass_attribute5 Moving_With_Family
											,to_char(ass.effective_start_date,'dd-Mon-rrrr') Effective_start_Date
											,to_char(ass.effective_end_date,'dd-Mon-rrrr') Effective_end_Date
											,to_char(pps.actual_termination_date,'dd-Mon-rrrr') resign_date  
											,usr.user_name Last_Update_by ,ass.last_update_date 
											FROM    per_all_people_f per
											,per_all_assignments_f ass
											,hr_all_organization_units orgu
											,per_all_positions pos
											,per_periods_of_service pps
											,per_person_types ppt
											,hr_locations hrl
											,pay_people_groups ppg
											,per_grades pg
											,per_jobs pj
											,pay_all_payrolls_f pay
											,hr_locations hrlhb
											,per_assignment_status_types past
											,fnd_user usr

											WHERE ass.person_id = per.person_id
											and past.ASSIGNMENT_STATUS_TYPE_ID = ass.ASSIGNMENT_STATUS_TYPE_ID
											and hrlhb.location_id = per.attribute1
											and ppg.people_group_id  = ass.people_group_id
											and pg.grade_id = ass.grade_id
											AND ass.organization_id = orgu.organization_id
											AND ass.position_id = pos.position_id
											AND pps.person_id = per.person_id
											AND ppt.person_type_id = per.person_type_id
											AND ass.job_id = pj.job_id 
											and pay.payroll_id = ass.payroll_id
											and ass.location_id = hrl.location_id
											and usr.user_id = ass.last_updated_by
											and (pps.actual_termination_date >= to_char(last_day(sysdate),'dd-Mon-rrrr') or pps.actual_termination_date is null)
											and pps.date_start <= to_char(last_day(sysdate),'dd-Mon-rrrr') 
											AND to_char(last_day(sysdate),'dd-Mon-rrrr') BETWEEN per.effective_start_date AND per.effective_end_date 
											ORDER BY nik, ass.effective_start_date DESC, substr(hrl.attribute6,1,3),per.last_name;
											" ); 
	}

 
}
