<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_mky extends CI_Model {


	public function double_bee()
	{
		return $this->db->query("select ASSIGNMENT_NUMBER, EFFECTIVE_DATE, Count(EFFECTIVE_DATE) AS CountOfP_EFFECTIVE_DATE
											from HR.PAY_BATCH_LINES
											where BATCH_ID  in
											(
											concat(concat(to_char(sysdate,'rrrr'),to_char(sysdate,'mm')),'999'),
											concat(concat(to_char(sysdate,'rrrr'),to_char(add_months(sysdate,-1),'mm')),'999')
											)
											GROUP BY ASSIGNMENT_NUMBER,EFFECTIVE_DATE
											having Count(EFFECTIVE_DATE) > 1
											order by CountOfP_EFFECTIVE_DATE DESC;");
	}

	public function double_stagging()
	{
		return $this->db->query("select assignment_number, effective_date, count(effective_date) jum from hris.ooa_temp
											group by assignment_number, effective_date
											having count(effective_date) > 1"
											);
	}
	
	public function double_sit_spkl()
	{
		return $this->db->query("SELECT DISTINCT pas.assignment_number NPP,
											haou.name business_group, 
											p.date_from TANGGAL_EFFECTIVE,count(p.date_from) as jml
											FROM per_person_analyses p, fnd_id_flex_structures s, per_analysis_criteria pac,
											per_all_assignments_f pas,per_all_people_f pap,
											hr_all_organization_units haou
											WHERE p.id_flex_num (+)  = s.id_flex_num
											AND UPPER(s.id_flex_structure_code) = UPPER('BAF_SPKL')
											and   haou.ORGANIZATION_ID = pas.ORGANIZATION_ID
											AND p.analysis_criteria_id = pac.analysis_criteria_id
											AND p.person_id = pas.person_id 
											AND p.date_from BETWEEN pas.effective_start_date AND pas.effective_end_date      
											AND PAP.PERSON_ID = P.PERSON_ID
											AND PAP.EFFECTIVE_END_DATE = TO_DATE('31-DEC-4712','DD-MON-RRRR')
											AND p.date_from >= TO_DATE(to_char(last_day(add_months(sysdate,-2))+1,'dd-Mon-rrrr'))
											AND p.date_from <= TO_DATE(to_char(last_day(sysdate),'dd-Mon-rrrr'))

											AND PAS.PRIMARY_FLAG = 'Y'
											GROUP BY pas.assignment_number,haou.name,p.date_from
											having Count(p.date_from) > 1
											order by p.date_from desc;"
											);
	}
	
	public function double_sit_ooa()
	{
		return $this->db->query("SELECT DISTINCT pas.assignment_number NPP,
											haou.name business_group, 
											p.date_from TANGGAL_EFFECTIVE,count(p.date_from) as jml
											FROM per_person_analyses p, fnd_id_flex_structures s, per_analysis_criteria pac,
											per_all_assignments_f pas,per_all_people_f pap,
											hr_all_organization_units haou
											WHERE p.id_flex_num (+)  = s.id_flex_num
											AND UPPER(s.id_flex_structure_code) = UPPER('BAF_OUTSIDE_ACTIVITY')
											and   haou.ORGANIZATION_ID = pas.ORGANIZATION_ID
											AND p.analysis_criteria_id = pac.analysis_criteria_id
											AND p.person_id = pas.person_id 
											AND p.date_from BETWEEN pas.effective_start_date AND pas.effective_end_date      
											AND PAP.PERSON_ID = P.PERSON_ID
											AND PAP.EFFECTIVE_END_DATE = TO_DATE('31-DEC-4712','DD-MON-RRRR')
											AND p.date_from >= TO_DATE(to_char(last_day(add_months(sysdate,-2))+1,'dd-Mon-rrrr'))
											AND p.date_from <= TO_DATE(to_char(last_day(sysdate),'dd-Mon-rrrr'))

											AND PAS.PRIMARY_FLAG = 'Y'
											GROUP BY pas.assignment_number,haou.name,p.date_from
											having Count(p.date_from) > 1
											order by p.date_from desc;"
											);
	}
	
	public function double_sit_bt()
	{
		return $this->db->query("SELECT DISTINCT pas.assignment_number NPP,
											haou.name business_group, 
											p.date_from TANGGAL_EFFECTIVE,count(p.date_from) as jml
											FROM per_person_analyses p, fnd_id_flex_structures s, per_analysis_criteria pac,
											per_all_assignments_f pas,per_all_people_f pap,
											hr_all_organization_units haou
											WHERE p.id_flex_num (+)  = s.id_flex_num
											AND UPPER(s.id_flex_structure_code) = UPPER('BAF_BUSINESS_TRIP_MASTER')
											and   haou.ORGANIZATION_ID = pas.ORGANIZATION_ID
											AND p.analysis_criteria_id = pac.analysis_criteria_id
											AND p.person_id = pas.person_id 
											AND p.date_from BETWEEN pas.effective_start_date AND pas.effective_end_date      
											AND PAP.PERSON_ID = P.PERSON_ID
											AND PAP.EFFECTIVE_END_DATE = TO_DATE('31-DEC-4712','DD-MON-RRRR')
											AND p.date_from >= TO_DATE(to_char(last_day(add_months(sysdate,-2))+1,'dd-Mon-rrrr'))
											AND p.date_from <= TO_DATE(to_char(last_day(sysdate),'dd-Mon-rrrr'))

											AND PAS.PRIMARY_FLAG = 'Y'
											GROUP BY pas.assignment_number,haou.name,p.date_from
											having Count(p.date_from) > 1
											order by p.date_from desc;"
											);
	}
	
	public function sisa_cuti()
	{
		return $this->db->query("SELECT  paa.assignment_number NIK, pap.last_name NAMA,
											per_utility_functions.get_net_accrual
											(paa.assignment_id,
											61,
											81,
											1,
											to_char(sysdate,'dd-Mon-rrrr'),
											1061,
											NULL,
											NULL
											) SISA_CUTI
											FROM per_all_assignments_f paa, per_all_people_f pap
											WHERE paa.person_id = pap.person_id
											AND paa.assignment_number IN (SELECT assignment_number
											FROM per_all_assignments_f)
											AND paa.effective_end_date = '31-dec-4712'
											AND pap.effective_end_date = '31-dec-4712'
											order by NIK asc;
											" );
	}
	
	public function man_power()
	{
		return $this->db->query("select distinct 
											pp.employee_number P_EMPLOYEE_NUMBER,
											pp.last_name P_NAME,
											upper(hl.LOCATION_CODE) P_BRANCH_NAME,
											pj.name P_JOB,
											pos.name P_POSITION,
											haou.name P_ORGANIZATION,
											ppo.actual_termination_date P_RESIGN_DATE
											 
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
											and (ppo.actual_termination_date > to_char(sysdate,'dd')||'-'||to_char(sysdate,'Mon')||'-'||to_char(sysdate,'rrrr') or ppo.actual_termination_date is null)
											and pj.name in ('CREDIT MARKETING OFFICER','CHIEF CREDIT MARKETING OFFICER')
											and ppo.date_start <= to_char(sysdate,'dd')||'-'||to_char(sysdate,'Mon')||'-'||to_char(sysdate,'rrrr') 
											AND to_char(sysdate,'dd')||'-'||to_char(sysdate,'Mon')||'-'||to_char(sysdate,'rrrr') BETWEEN paa.effective_start_date AND paa.effective_end_date  --
											AND to_char(sysdate,'dd')||'-'||to_char(sysdate,'Mon')||'-'||to_char(sysdate,'rrrr') BETWEEN pp.effective_start_date AND pp.effective_end_date   
											 
											order by P_EMPLOYEE_NUMBER;"
											);
	}

	
}
