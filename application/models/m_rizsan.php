<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_rizsan extends CI_Model {


	public function absensi_dept_terkait()
	{
		return $this->db->query("SELECT TO_CHAR (pbl.assignment_number) NIK, pap.last_name name, haou.name Department, pbl.effective_date Work_Date,
                                                CASE WHEN value_1 IS NULL THEN NULL ELSE TO_CHAR ( TO_DATE ( TO_CHAR (effective_date, 'DD-MON-RRRR') || ' ' || pyxxbafta.convert_text_t0_date_format (value_1), 'DD-MON-RRRR HH24:MI'), 'HH24:MI') END
                                                time_in,
                                                TO_CHAR (pbl.effective_date, 'dd-Mon-rrrr') Work_Date_CHAR,
                                                CASE
                                                WHEN value_2 IS NULL
                                                THEN
                                                NULL
                                                ELSE
                                                CASE
                                                WHEN TO_DATE (
                                                TO_CHAR (effective_date, 'DD-MON-RRRR')
                                                || ' '
                                                || pyxxbafta.convert_text_t0_date_format (value_2),
                                                'DD-MON-RRRR HH24:MI') >
                                                TO_DATE (
                                                TO_CHAR (effective_date, 'DD-MON-RRRR')
                                                || ' '
                                                || pyxxbafta.convert_text_t0_date_format (value_1),
                                                'DD-MON-RRRR HH24:MI')
                                                THEN
                                                TO_CHAR (
                                                TO_DATE (
                                                TO_CHAR (effective_date, 'DD-MON-RRRR')
                                                || ' '
                                                || pyxxbafta.convert_text_t0_date_format (value_2),
                                                'DD-MON-RRRR HH24:MI'),
                                                'HH24:MI')
                                                ELSE
                                                TO_CHAR (
                                                TO_DATE (
                                                TO_CHAR (effective_date, 'DD-MON-RRRR')
                                                || ' '
                                                || pyxxbafta.convert_text_t0_date_format (value_2),
                                                'DD-MON-RRRR HH24:MI')
                                                + 1,
                                                'HH24:MI')
                                                END
                                                END
                                                time_out,         
                                                DECODE (
                                                pyxxbafff2.get_absence_status_by_date (pbl.assignment_number,
                                                pbl.effective_date),
                                                'N/A', DECODE (
                                                pyxxbafta.get_ooa_detail (pas.person_id,
                                                pbl.effective_date),
                                                '',   DECODE (hris_function.cek_bisstrip (pas.assignment_id , pbl.effective_date),'N','','Pengajuan Business Trip'),

                                                'Outside Office Activity'),
                                                pyxxbafff2.get_absence_status_by_date (pbl.assignment_number,
                                                pbl.effective_date))
                                                absence_status,
                                                case when pbl.value_9 is null then null
                                                when pbl.value_9 = 'Y' then 'late'
                                                end Late,
                                                                                                        
                                                TO_DATE(to_char(last_day(add_months(sysdate,-2))+1,'dd-Mon-rrrr')) start_date
                                                ,to_date(last_day(sysdate),'dd-Mon-rrrr') end_date
                                                                                                        
                                                FROM pay_batch_lines pbl,
                                                per_all_people_f pap,
                                                per_all_assignments_f pas,
                                                per_grades pg,
                                                hr_locations hrl,
                                                hr_all_organization_units haou
                                                WHERE     pbl.element_name = 'BAF ATTENDANCE INFO'
                                                AND pbl.assignment_number = pas.assignment_number
                                                AND pap.person_id = pas.person_id
                                                AND pg.grade_id = pas.grade_id
                                                AND haou.organization_id in ('8115','8659', '8660','8064')
                                                AND hrl.location_id = pas.location_id
                                                AND haou.organization_id = pas.organization_id
                                                AND TO_DATE (pbl.effective_date) BETWEEN 
                                                TO_DATE(to_char(last_day(add_months(sysdate,-2))+1,'dd-Mon-rrrr')) 
                                                and
                                                to_date(last_day(sysdate),'dd-Mon-rrrr')  
                                                AND TRUNC (SYSDATE) BETWEEN pap.effective_start_date AND pap.effective_end_date
                                                AND TRUNC (SYSDATE) BETWEEN pas.effective_start_date AND pas.effective_end_date
                                                ORDER BY  NIK, work_date asc");
	}

	public function spkl()
	{
		return $this->db->query(" SELECT DISTINCT pas.assignment_number NIK
												,pap.full_name Nama
												,UPPER(hrl.LOCATION_CODE) Branch
												 
												,haou.name Departement
												,pj.name JOB
												,pos.name POSITION 
												--TO_CHAR(pap.effective_start_date,'DD-MON-RRRR') TANGGAL_masuk,
												,to_char(p.date_from,'dd-Mon-rrrr') q
												,p.date_from
												,pac.segment1 Start_time-- (As SPKL)
												,pac.segment2 Finish_Time -- (As SPKL)
												,pac.segment5 Keterangan -- (As SPKL)
												,pac.segment4 order_by
												 
																
												FROM  per_person_analyses p
												,fnd_id_flex_structures s
												,per_analysis_criteria pac
												,per_all_assignments_f pas
												,per_all_people_f pap
												,per_positions pos
												,per_jobs pj
												,hr_all_organization_units haou
												,HR_LOCATIONS hrl
												,(select user_id, user_name from fnd_user) usr
												,(select user_id, user_name from fnd_user) usrclon
												WHERE p.id_flex_num (+)  = s.id_flex_num
												AND UPPER(s.id_flex_structure_code) = UPPER('BAF_SPKL') -- SPKL= BAF_SPKL, BT= BAF_BUSINESS_TRIP_MASTER , OOA=BAF_OUTSIDE_ACTIVITY, NPWP= ID_EE_NPWP_TAX_DETAILS
												and   haou.ORGANIZATION_ID = pas.ORGANIZATION_ID
												AND p.analysis_criteria_id = pac.analysis_criteria_id
												AND p.person_id = pas.person_id
												AND pas.LOCATION_ID = hrl.LOCATION_ID
												AND pas.position_id = pos.position_id
												AND pas.job_id = pj.job_id
												AND haou.organization_id in ('8115','8659', '8660','8064') 
												--AND pas.business_group_id = 101
												AND p.date_from BETWEEN pas.effective_start_date AND pas.effective_end_date      
												AND PAP.PERSON_ID = P.PERSON_ID
												AND PAP.EFFECTIVE_END_DATE = TO_DATE('31-DEC-4712','DD-MON-RRRR')
												AND pac.created_by = usr.user_id AND p.last_updated_by = usrclon.user_id
												AND p.date_from >= TO_DATE(to_char(last_day(add_months(sysdate,-2))+1,'dd-Mon-rrrr')) 
												AND p.date_from <= to_date(last_day(sysdate),'dd-Mon-rrrr')
												--AND pas.assignment_number ='0266760211' -- To All Just Remarks
												--and pac.segment3 like 'Y'
												AND PAS.PRIMARY_FLAG = 'Y'
												order by pas.assignment_number, p.date_from"
											);
	}
	
	/*
	/*public function double_sit_spkl()
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
	
	/*public function double_sit_ooa()
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
	
	/*public function double_sit_bt()
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
	}*/
	/*
	public function man_power()
	{
		return $this->db->query("select distinct 
											pp.employee_number P_EMPLOYEE_NUMBER,
											pp.last_name P_NAME,
											upper(hl.LOCATION_CODE) P_BRANCH_NAME,
											pj.name P_JOB,
											pos.name P_POSITION,
											haou.name P_ORGANIZATION
											 
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
											AND sysdate BETWEEN paa.effective_start_date AND paa.effective_end_date  --
											AND sysdate BETWEEN pp.effective_start_date AND pp.effective_end_date   
											 
											order by P_EMPLOYEE_NUMBER;"
											);
	}

	public function total_plan()
	{
		return $this->db->query("select * from
											(select pap.employee_number
											,pap.last_name
											,decode(paa.date_start, null,'P','C') absence_status
											,paat.name absence_type
											,paa.date_projected_start
											,paa.date_projected_end
											,paa.date_start actual_start_date
											,paa.date_end actual_end_date
											,paa.absence_days
											,usr1.user_name created_by
											,paa.creation_date
											,usr2.user_name last_updated_by
											,paa.last_update_date
											from per_absence_attendances paa
											,per_absence_attendance_types paat
											,per_all_people_f pap
											,per_all_assignments_f pas
											,hr_locations hrl
											,hr_all_organization_units haou
											,per_jobs pj
											,per_all_positions pos
											,fnd_user usr1
											,fnd_user usr2
											where paa.person_id = pap.person_id
											and pap.person_id = pas.person_id
											and pas.location_id = hrl.location_id
											and pas.organization_id = haou.organization_id
											and pas.job_id = pj.job_id
											and pas.position_id = pos.position_id
											and usr1.user_id = paa.created_by
											and usr2.user_id = paa.last_updated_by
											and paa.absence_attendance_type_id = paat.absence_attendance_type_id
											 
											and (paa.date_projected_start between pap.effective_start_date and pap.effective_end_date
											or paa.date_start between pap.effective_start_date and pap.effective_end_date)
											and (paa.date_projected_start between TO_DATE(to_char(last_day(add_months(sysdate,-2))+1,'dd-Mon-rrrr')) and TO_DATE(to_char(last_day(sysdate),'dd-Mon-rrrr'))
											or paa.date_start between TO_DATE(to_char(last_day(add_months(sysdate,-2))+1,'dd-Mon-rrrr')) and TO_DATE(to_char(last_day(sysdate),'dd-Mon-rrrr')))
											and nvl(pas.effective_end_date, to_date('31-dec-4712','dd-mon-rrrr')) = to_date('31-dec-4712','dd-mon-rrrr')) absence
											where upper(absence_status) = 'P'
											order by employee_number, creation_date desc;"
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
														(select distinct to_char(next_time,'."'dd'".') from v$archived_log where sequence# = (select max(sequence#) from v$archived_log))-
														(select distinct to_char(next_time,'."'dd'".') from v$archived_log where sequence# = (select max(sequence#) from v$archived_log where applied='."'YES'".')))
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
	*/
}
