<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_payroll extends CI_Model {


	public function rekening()
	{
		return $this->db->query("select distinct pp.employee_number NIK,
									pp.last_name NAME,
									upper(hl.LOCATION_CODE) branch,
									haou.name Departement,
									pos.name POSITION,
									pj.name JOB,
									pea.segment1 Bank_Name, 
									pea.segment2 Bank_Branch_Name, 
									pea.segment3 Account_Name,
									pea.segment4 Account_Number, 
									ppm.effective_start_date payment_method_date,
									ppo.date_start starting_date,
									ppo.actual_termination_date resign_date

									from 
									PER_ALL_PEOPLE_F pp, 
									PER_ALL_ASSIGNMENTS_F paa,
									per_jobs pj,
									HR_LOCATIONS HL,
									per_positions pos, 
									per_periods_of_service ppo, 
									hr_all_organization_units haou, 
									pay_external_accounts pea, 
									pay_personal_payment_methods_f ppm

									where pp.employee_number = paa.assignment_number
									AND paa.job_id = pj.job_id
									and ppm.assignment_id = paa.assignment_id 
									AND ppm.external_account_id = pea.external_account_id 
									AND pp.person_id = ppo.person_id
									and paa.LOCATION_ID = HL.LOCATION_ID
									AND paa.position_id = pos.position_id 
									and haou.ORGANIZATION_ID = paa.ORGANIZATION_ID
									AND trunc (sysdate) BETWEEN paa.effective_start_date AND paa.effective_end_date  
									AND trunc(sysdate) BETWEEN pp.effective_start_date AND pp.effective_end_date 
									order by pp.employee_number");
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
									where h.location_id = pp.attribute1 and pp.attribute_category like 'BAF_ADDITIONAL_PERSONAL') P_HOMEBASE
													

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
									and (ppo.actual_termination_date >= trunc(sysdate) or ppo.actual_termination_date is null)
									and ppo.date_start <= trunc(sysdate)
									AND  trunc(sysdate) BETWEEN paa.effective_start_date AND paa.effective_end_date
									AND  trunc(sysdate) BETWEEN pp.effective_start_date AND pp.effective_end_date
									order by pp.employee_number;"
											);
	}	
}
