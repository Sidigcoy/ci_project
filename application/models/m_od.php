<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_od extends CI_Model {


	 
	
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
									and (ppo.actual_termination_date >= trunc(sysdate) or ppo.actual_termination_date is null)
									and ppo.date_start <= trunc(sysdate)
									AND  trunc(sysdate) BETWEEN paa.effective_start_date AND paa.effective_end_date
									AND  trunc(sysdate) BETWEEN pp.effective_start_date AND pp.effective_end_date
									order by pp.employee_number"
											);
	} 	 
}
