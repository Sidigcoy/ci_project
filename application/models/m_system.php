<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_system extends CI_Model {


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



	public function resign()
	{
		return $this->db->query(" SELECT DISTINCT
									pap.employee_number NIK,
									pap.last_name NAME,
									UPPER (hl.LOCATION_CODE) branch_name,
									haou.name Departement,
									pj.name JOB,
									ppos.date_start starting_date,        
									ppos.actual_termination_date Actual_resign_date

									FROM per_periods_of_service ppos,
									PER_PEOPLE_F pap,
									PER_ASSIGNMENTS_F pas,
									hr_all_organization_units haou,
									per_jobs pj,
									per_positions pos,
									pay_people_groups ppg,
									HR_LOCATIONS HL

									WHERE     ppos.person_id = pap.person_id
									AND haou.ORGANIZATION_ID = pas.ORGANIZATION_ID
									AND pas.LOCATION_ID = HL.LOCATION_ID
									AND pap.person_id = pas.person_id
									AND pas.job_id = pj.job_id(+)
									AND pas.position_id = pos.position_id(+)
									AND pas.people_group_id = ppg.people_group_id
									AND pas.primary_flag = 'Y'
									AND ppos.actual_termination_date BETWEEN pas.effective_start_date
									AND pas.effective_end_date
									AND ppos.actual_termination_date BETWEEN pap.effective_start_date
									AND pap.effective_end_date
									and ppos.actual_termination_date between (to_char(last_day(add_months(sysdate,-1))+1,'DD-MON-RR')) and sysdate 
									and pap.employee_number not like 'C%'
									ORDER BY actual_resign_date, branch_name, ppos.actual_termination_date DESC, pap.employee_number");
	}

	public function total_plan()
	{
		return $this->db->query("
											select count(pas.assignment_number) jumlah
											from per_absence_attendances paa
											,per_absence_attendance_types paat
											--,per_all_people_f pap
											,per_all_assignments_f pas 
											where paa.person_id = pas.person_id 
											and paa.absence_attendance_type_id = paat.absence_attendance_type_id 
											and (paa.date_projected_start between TO_DATE(to_char(last_day(add_months(sysdate,-2))+1,'dd-Mon-rrrr')) and TO_DATE(to_char(last_day(sysdate),'dd-Mon-rrrr'))
											or paa.date_start between TO_DATE(to_char(last_day(add_months(sysdate,-2))+1,'dd-Mon-rrrr')) and TO_DATE(to_char(last_day(sysdate),'dd-Mon-rrrr')))
											and nvl(pas.effective_end_date, to_date('31-dec-4712','dd-mon-rrrr')) = to_date('31-dec-4712','dd-mon-rrrr')
											and decode(paa.date_start, null,'P','C') ='P'

											--select * from
											--(select pap.employee_number
											--,pap.last_name
											--,decode(paa.date_start, null,'P','C') absence_status
											--,paat.name absence_type
											--,paa.date_projected_start
											--,paa.date_projected_end
											--,paa.date_start actual_start_date
											--,paa.date_end actual_end_date
											--,paa.absence_days
											--,usr1.user_name created_by
											--,paa.creation_date
											--,usr2.user_name last_updated_by
											--,paa.last_update_date
											--from per_absence_attendances paa
											--,per_absence_attendance_types paat
											--,per_all_people_f pap
											--,per_all_assignments_f pas
											--,hr_locations hrl
											--,hr_all_organization_units haou
											--,per_jobs pj
											--,per_all_positions pos
											--,fnd_user usr1
											--,fnd_user usr2
											--where paa.person_id = pap.person_id
											--and pap.person_id = pas.person_id
											--and pas.location_id = hrl.location_id
											--and pas.organization_id = haou.organization_id
											--and pas.job_id = pj.job_id
											--and pas.position_id = pos.position_id
											--and usr1.user_id = paa.created_by
											--and usr2.user_id = paa.last_updated_by
											--and paa.absence_attendance_type_id = paat.absence_attendance_type_id
											 
											--and (paa.date_projected_start between pap.effective_start_date and pap.effective_end_date
											--or paa.date_start between pap.effective_start_date and pap.effective_end_date)
											--and (paa.date_projected_start between TO_DATE(to_char(last_day(add_months(sysdate,-2))+1,'dd-Mon-rrrr')) and TO_DATE(to_char(last_day(sysdate),'dd-Mon-rrrr'))
											--or paa.date_start between TO_DATE(to_char(last_day(add_months(sysdate,-2))+1,'dd-Mon-rrrr')) and TO_DATE(to_char(last_day(sysdate),'dd-Mon-rrrr')))
											--and nvl(pas.effective_end_date, to_date('31-dec-4712','dd-mon-rrrr')) = to_date('31-dec-4712','dd-mon-rrrr')) absence
											--where upper(absence_status) = 'P'
											--order by employee_number, creation_date desc
											;"
											
											);
	}
	
	public function user_hcm()
	{
		return $this->db->query("select distinct 
								pp.employee_number P_EMPLOYEE_NUMBER,
								pp.last_name P_NAME,
								ppo.date_start starting_Date,
								(select pos.name from per_positions pos where paa.position_id = pos.position_id) position,
								(select pos.name from per_jobs pos where paa.job_id = pos.job_id) job,
								(select haou.name from hr_all_organization_units haou where paa.organization_id = haou.organization_id) dept,
								(select fu.user_name from fnd_user fu where employee_number = fu.user_name) m

								from 
								PER_ALL_PEOPLE_F pp, 
								PER_ALL_ASSIGNMENTS_F paa,
								per_periods_of_service ppo,
								hr_all_organization_units haou

								where pp.person_id = paa.person_id
								AND pp.person_id = ppo.person_id
								and haou.ORGANIZATION_ID = paa.ORGANIZATION_ID
								and (ppo.actual_termination_date >= trunc(sysdate) or ppo.actual_termination_date is null)
								and ppo.date_start <= trunc(sysdate)
								AND (trunc(sysdate)) BETWEEN paa.effective_start_date AND paa.effective_end_date
								AND (trunc(sysdate)) BETWEEN pp.effective_start_date AND pp.effective_end_date
								and paa.assignment_number is not null
								and (select fu.user_name from fnd_user fu where employee_number = fu.user_name) is null
								order by ppo.date_start asc;"
											
											);
	}
	
	public function total_user_myhris()
	{
		return $this->db->query("select user_name from myhris.sys_user where user_name not in ('SYSADMIN','GUEST','UNKNOWN')" );
	}
	
	public function cek_tablespace()
	{
		return $this->db->query("select data_files.tablespace_name TABLESPACE, 
													DECODE(tot_extnd_blk,NULL,NVL(tot_alloc_byt,0),NVL(tot_alloc_byt,0) + (tot_extnd_blk * ts.block_size))/1024/1024 MAX_SIZE,
													ROUND((data_files.tot_alloc_byt - free_space.tot_free_byt)/1024/1024,0) SPUSED,
													NVL(ROUND( ( (( NVL(tot_free_byt,0) + DECODE( tot_extnd_blk,NULL,0,(tot_extnd_blk * ts.block_size) ) ) 
													/ DECODE  (tot_extnd_blk,NULL,NVL(tot_alloc_byt,0), NVL(tot_alloc_byt,0) + (tot_extnd_blk * ts.block_size) )) 
													* 100 ), 2),0) PCTFR
													FROM ( SELECT tablespace_name,
													SUM(bytes) tot_alloc_byt
													FROM sys.dba_data_files
													GROUP BY tablespace_name
													UNION ALL
													SELECT tablespace_name,
													SUM(bytes) tot_alloc_byt
													FROM sys.dba_temp_files 
													GROUP BY tablespace_name ) data_files,
													( SELECT tablespace_name,
													MAX(bytes) max_free_byt,
													SUM(bytes) tot_free_byt
													FROM sys.dba_free_space
													GROUP BY tablespace_name ) free_space,
													( SELECT tablespace_name,
													SUM(DECODE(SIGN(maxblocks - blocks),-1,0,(maxblocks - blocks))) tot_extnd_blk
													FROM sys.dba_data_files
													GROUP BY tablespace_name
													UNION ALL
													SELECT tablespace_name,
													SUM(DECODE(SIGN(maxblocks - blocks),-1,0,(maxblocks - blocks))) tot_extnd_blk
													FROM sys.dba_temp_files
													GROUP BY tablespace_name ) extnd,
													sys.dba_tablespaces ts
													WHERE data_files.tablespace_name = free_space.tablespace_name(+)
													AND data_files.tablespace_name = extnd.tablespace_name(+)
													AND data_files.tablespace_name = ts.tablespace_name
													AND NVL(ROUND( ( (( NVL(tot_free_byt,0) + DECODE( tot_extnd_blk,NULL,0,(tot_extnd_blk * ts.block_size) ) )
													/ DECODE(tot_extnd_blk,NULL,NVL(tot_alloc_byt,0), NVL(tot_alloc_byt,0) + (tot_extnd_blk * ts.block_size) ))
													* 100 ), 2),0) < 20
													and data_files.tablespace_name not in ('APPS_UNDOTS12','APPS_UNDOTS11','TEMP1','TEMP2')
													--('TEMP','BNEX','BENX','BISD','IGSX','PSPX','OKLD','ECXD','AXX','PAD','PAX')
													ORDER BY pctfr desc ;"
													);

	}

		public function cek_tablespace2()
		{
			return $this->db->query('select b.tablespace_name,
							        a.free_space,
							        tbs_size Total_Mb, 
							        
							        round(((tbs_size-a.free_space)/tbs_size)*100,2) as percent_used
							        from  (select tablespace_name, round(sum(bytes)/1024/1024 ,2) as free_space
							        from dba_free_space
							        group by tablespace_name) a,
							        (select tablespace_name, sum(bytes)/1024/1024 as tbs_size
							        from dba_data_files
							        group by tablespace_name) b
							        where a.tablespace_name(+)=b.tablespace_name order by percent_used desc;');

		}
	
		public function cek_memori()
	{
		return $this->db->query('SELECT NAME, FREE_MB, TOTAL_MB, substr(free_mb/total_mb*100,1,5) as PERCENTAGE FROM v$asm_diskgroup;');
	}
		//Tambahan 30 Jan 2017
		public function cek_drc()
		{
			return $this->db->query (' select '."'Last applied  : '".' Logs, to_char(next_time,'."'DD-MON-YY:HH24:MI:SS'".') Time from v$archived_log where sequence# = (select max(sequence#) from v$archived_log where applied='."'YES'".')
			union
			select '."'Last received : '".' Logs, to_char(next_time,'."'DD-MON-YY:HH24:MI:SS'".') Time from v$archived_log where sequence# = (select max(sequence#) from v$archived_log)
			union
			select distinct '."'GAP :'".' Logs, to_char( (a.next_time) - (select distinct b.next_time from v$archived_log b where b.sequence# = (select max(bb.sequence#) from v$archived_log bb)) ) TIME from v$archived_log a where a.sequence#  = (select max(aa.sequence#) from v$archived_log aa where aa.applied='."'YES'".')
			;'
			);
		}
		


		 public function finger_id_log()
		 {
		 	return $this->db->query (
		 												' 
		 												select hl.location_code, hl.location_id,
		 												(select count(hb.EMPLOYEE_NUMBER) from per_all_assignments_f paa, hris.baf_fpid hb where paa.location_id = hl.location_id and hb.EMPLOYEE_NUMBER = paa.assignment_number AND (sysdate) BETWEEN paa.effective_start_date AND paa.effective_end_date) jumlah_finger_id,
		 												(select max(hb.LAST_FPRETRIEVE_DATE) from per_all_assignments_f paa, hris.baf_fpid hb where paa.location_id = hl.location_id and hb.EMPLOYEE_NUMBER = paa.assignment_number AND (sysdate) BETWEEN paa.effective_start_date AND paa.effective_end_date) Max_retrieve
		 												from
		 												hr_locations hl
		 												order by max_retrieve
		 												;'
		 												);
		}
		
		public function compare_emp_num()
		 {
		 	return $this->db->query (
		 												"
														select pap.employee_number nik,to_char(ppos.date_start,'dd-Mon-rrrr') date_hire, pap.last_name nama,substr(pap.employee_number,7,4) nik_compare
														,to_char(ppos.date_start,'mmrr') datehire_compare,fu.user_name last_upd_by_nik 
														from per_all_people_f pap ,per_periods_of_service ppos ,fnd_user fu
														where pap.person_id = ppos.person_id
														and trunc(sysdate) between pap.effective_start_date and pap.effective_end_date
														and fu.user_id = pap.last_updated_by
														and (ppos.actual_termination_date > sysdate or ppos.actual_termination_date is null)
														and substr(pap.employee_number,7,4) <> to_char(ppos.date_start,'mmrr')
														and ppos.date_start >= to_char(last_day(add_months(sysdate,-3))+1,'DD-MON-RR')
														--and pap.employee_number ='0403230216'
		 												;"
		 												);
		}
		
		public function fail_route_detail()
		 {
		 	return $this->db->query (
		 												"select c.name, a.position, a.link_to_hrm_area, a.LINK_TO_HRM
														from myhris.sys_route_detail a, myhris.sys_Route_header b, myhris.sys_app_modules c, myhris.sys_apps d
														where 
														a.route_header_id = b.route_header_id
														and c.MODULE_ID = b.MODULE_ID
														and c.APP_ID = d.SYS_APP_ID
														and upper(d.name) like '%IBS%'
														and (a.link_to_hrm_area ='' or a.link_to_hrm ='Y' or a.link_to_hrm_area is null)

														union all

														select c.name, a.position, a.link_to_hrm_area, a.LINK_TO_HRM
														from myhris.sys_route_detail a, myhris.sys_Route_header b, myhris.sys_app_modules c, myhris.sys_apps d
														where 
														a.route_header_id = b.route_header_id
														and c.MODULE_ID = b.MODULE_ID
														and c.APP_ID = d.SYS_APP_ID
														and upper(d.name) like '%HCM%'
														and (a.link_to_hrm_area ='Y' or a.link_to_hrm ='Y')

														union all

														select c.name, a.position, a.link_to_hrm_area, a.LINK_TO_HRM
														from myhris.sys_route_detail a, myhris.sys_Route_header b, myhris.sys_app_modules c, myhris.sys_apps d
														where 
														a.route_header_id = b.route_header_id
														and c.MODULE_ID = b.MODULE_ID
														and c.APP_ID = d.SYS_APP_ID
														and upper(d.name) like '%RECRUITMENT%'
														and (a.link_to_hrm_area ='Y' or a.link_to_hrm ='' or a.link_to_hrm is null)
		 												;"
		 												);
		}
		

}
