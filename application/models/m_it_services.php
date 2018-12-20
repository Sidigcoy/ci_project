<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_it_services extends CI_Model {


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
											ppo.date_start P_STARTING_DATE,
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
											and ppo.period_of_service_id = paa.period_of_service_id											
											and haou.ORGANIZATION_ID = paa.ORGANIZATION_ID
											and pg.grade_id = paa.grade_id
											and (ppo.actual_termination_date > to_char(sysdate,'dd')||'-'||to_char(sysdate,'Mon')||'-'||to_char(sysdate,'rrrr') or ppo.actual_termination_date is null)  
											and ppo.date_start <= to_char(sysdate,'dd')||'-'||to_char(sysdate,'Mon')||'-'||to_char(sysdate,'rrrr') 
											AND to_char(sysdate,'dd')||'-'||to_char(sysdate,'Mon')||'-'||to_char(sysdate,'rrrr') BETWEEN paa.effective_start_date AND paa.effective_end_date  --
											AND to_char(sysdate,'dd')||'-'||to_char(sysdate,'Mon')||'-'||to_char(sysdate,'rrrr') BETWEEN pp.effective_start_date AND pp.effective_end_date   
											 
											order by P_EMPLOYEE_NUMBER;"
											);
	}
	
	public function resign()
	{
		return $this->db->query("select distinct 
								pp.employee_number P_EMPLOYEE_NUMBER,
								pp.last_name P_NAME, 
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
								and ppo.period_of_service_id = paa.period_of_service_id
								AND paa.position_id = pos.position_id 
								and haou.ORGANIZATION_ID = paa.ORGANIZATION_ID
								and pg.grade_id = paa.grade_id
								and ppo.actual_termination_date < trunc(sysdate)
								and ppo.date_start <= trunc(sysdate)
								AND (trunc(sysdate)) BETWEEN paa.effective_start_date AND paa.effective_end_date
								AND (trunc(sysdate)) BETWEEN pp.effective_start_date AND pp.effective_end_date
								order by pp.employee_number;");
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
													AND Data_files.tablespace_name not in ('TEMP','BNEX','BENX','BISD','IGSX','PSPX','OKLD','ECXD','AXX','PAD','PAX')
													ORDER BY pctfr desc ;"
													);
	}
	
		public function cek_memori()
	{
		return $this->db->query('SELECT NAME, FREE_MB, TOTAL_MB, substr(free_mb/total_mb*100,1,5) as PERCENTAGE FROM v$asm_diskgroup;'
													);
	}
		//Tambahan 30 Jan 2017
		public function cek_DRC()
		{
			return $this->db->query (
														' select '."'Last applied  : '".' Logs, to_char(next_time,'."'DD-MON-YY:HH24:MI:SS'".') Time from v$archived_log
														where sequence# = (select max(sequence#) from v$archived_log where applied='."'YES'".')
														union
														select '."'Last received : '".' Logs, to_char(next_time,'."'DD-MON-YY:HH24:MI:SS'".') Time
														from v$archived_log
														where sequence# = (select max(sequence#) from v$archived_log)
														union
														select '."'GAP :'".' Logs, 
														to_char(
														(select distinct to_date(next_time) from v$archived_log where sequence# = (select max(sequence#) from v$archived_log))- (select distinct to_date(next_time) from v$archived_log where sequence# = (select max(sequence#) from v$archived_log where applied='."'YES'".')))
														TIME from v$archived_log where sequence# = (select max(sequence#) from v$archived_log)
														;'
														);
		}
		
		public function FINGER_ID_LOG()
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
}
