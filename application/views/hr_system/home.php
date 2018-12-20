<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          
          <!-- Small boxes (Stat box) -->
          <div class="row">
			<div class="col-lg-6 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
					<table class="table dataTable">
						<thead>
						  <tr>
							<th>Tablespace</th>
							<th>Max size</th>
							<th>Spused</th>
							<th>PCTFR</th>
						</thead>
						<tbody>
							<?php  
							//$no = 1;
							foreach ($data as $lihat):
							?>
							<tr <?php if(($lihat->PCTFR) !="0" ){ echo 'class="bg-red blink_me" ';
							$a['message'] 		= $this->email->message(
							"Dear gaes,\r\nTablespace Penuh neh, coba di cek dulu, berikut detailnya; \r\n\r\nTABLESPACE	:  ".$lihat->TABLESPACE."\r\nMAX_SIZE	:  ".$lihat->MAX_SIZE."\r\nSPUSED	:  ".$lihat->SPUSED."\r\nPCTFR		:  ".$lihat->PCTFR."\r\n\r\n Regards, \r\n Tukang Pantau\r\n"			 
							); $a['send'] = $this->email->send();
							} ?>>
							<td><?php echo ucwords($lihat-> TABLESPACE);?></td>
							<td><?php echo ucwords($lihat-> MAX_SIZE);?></td>
							<td><?php echo ucwords($lihat-> SPUSED);?></td>
							<td><?php echo ucwords($lihat-> PCTFR);?></td>
							</tr>
							<?php endforeach;  ?>
						</tbody>
					</table>           
                </div>
                <div class="icon">
                  <i class="fa fa-rocket"></i>
                </div>
                <!--<a href="< ?php echo base_url(); ?>admin/jenis_surat" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
              </div>
            </div><!-- ./col -->
			
			<div class="col-lg-6   col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
					<table class="table dataTable">
						<thead>
						  <tr>
							<th>NAME</th>
							<th>FREE_MB</th>
							<th>TOTAL_MB</th>
							<th>PERCENTAGE</th>
						</thead>
						<tbody>
							<?php  
							//$no = 1;
							foreach ($cek_memori as $lihat):
							?>
							<tr <?php if(($lihat->PERCENTAGE)>='95' && $lihat->NAME =='ARCH' ){echo 'class="bg-red blink_me" ';
								$a['message'] 		= $this->email->message(
								"Dear gaes,\r\n\r\nMemori ada yang kepenuhan neh, coba di cek dulu, berikut detailnya; 
								\r\n
								\r\nNAME		:  ".$lihat->NAME."
								\r\nFREE_MB	:  ".$lihat->FREE_MB."
								\r\nTOTAL_MB	:  ".$lihat->TOTAL_MB."
								\r\nPERCENTAGE	:  ".$lihat->PERCENTAGE."
								\r\n\r\n Regards, \r\n Tukang Pantau\r\n"			 
								);
								$a['send'] = $this->email->send();
							} if(($lihat->PERCENTAGE)>='90' && $lihat->NAME =='DATA' ){ echo 'class="bg-red blink_me" '; 
								$a['message'] 		= $this->email->message(
								"Dear gaes,\r\n\r\nMemori ada yang kepenuhan neh, coba di cek dulu, berikut detailnya; \r\n\r\nNAME			:  ".$lihat->NAME."\r\nFREE_MB	:  ".$lihat->FREE_MB."\r\nTOTAL_MB		:  ".$lihat->TOTAL_MB."\r\nPERCENTAGE	:  ".$lihat->PERCENTAGE."%\r\n\r\n Regards, \r\n Tukang Pantau\r\n"			 
								);
								$a['send'] = $this->email->send();
							} ?>>
							<td><?php echo ucwords($lihat->NAME);?></td>
							<td><?php  echo ucwords($lihat->FREE_MB);?></td>
							<td><?php echo ucwords($lihat->TOTAL_MB);?></td>
							<td><?php echo ucwords($lihat->PERCENTAGE)."%";?></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>           
                </div>
                <div class="icon">
                  <i class="fa fa-info-circle"></i>
                </div>
                <!--<a href="< ?php echo base_url(); ?>admin/jenis_surat" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
              </div>
            </div><!-- ./col -->
			
			
			<div class="col-lg-6   col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
					<table class="table dataTable">
						<thead>
						  <tr>
							<th>NIK</th>
							<th>DATEHIRE</th>
							<th>LAST 4</th>
							<th>COMP 4</th>
							<th>LAST UPD</th>
						</thead>
						<tbody>
							<?php  
							//$no = 1;
							foreach ($compare_emp_num as $lihat):
							?>
							<tr <?php if(($lihat->NIK)!=''){ echo 'class="bg-red blink_me" '; 
							
							} ?>>
							<td><?php echo ucwords($lihat->NIK);?></td>
							<td><?php echo ucwords($lihat->DATE_HIRE);?></td>
							<td><?php echo ucwords($lihat->NIK_COMPARE);?></td>
							<td><?php echo ucwords($lihat->DATEHIRE_COMPARE);?></td>
							<td><?php echo ucwords($lihat->LAST_UPD_BY_NIK);?></td>
							</tr>
							<?php
							//message_s($lihat->NIK,$lihat->DATE_HIRE,$lihat->NIK_COMPARE,$lihat->DATEHIRE_COMPARE,$lihat->LAST_UPD_BY_NIK);
							//if(($lihat->NIK)!=''){ echo $send;}
							endforeach; ?>
						</tbody>
					</table>           
                </div>
                <div class="icon">
                  <i class="fa fa-info-circle"></i>
                </div>
                <!--<a href="< ?php echo base_url(); ?>admin/jenis_surat" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
              </div>
            </div><!-- ./col -->			


		<!--Tambahan 30 Jan 2017 -->
		<div class="col-lg-6 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-green">
				<div class="inner">
				<table class="table dataTable">
					<thead>
						<tr> 
							<th>LOGS</th>
							<th>TIMES</th>
						</tr>	
					</thead>
					<tbody>
						<?php  
						$no = 1;
						foreach ($cek_drc as $lihat):
						?>
						<tr>
							<td <?php if(($lihat->LOGS) =="GAP :" && $lihat->TIME > 1 ){
							echo 'class="bg-red blink_me"'; 
							$a['message'] = $this->email->message(
								"Dear gaes,\r\nGAP pada DRC sudah melebihi 1 hari, silahkan di cek dulu. \r\n\r\nRegards, \r\n Tukang Pantau\r\n"			 
							); $a['send'] = $this->email->send();}?>>
							<?php echo ucwords($lihat->LOGS);?></td>
							<td <?php if(($lihat->LOGS) =="GAP :" && $lihat->TIME > 1 ){ echo 'class="bg-red blink_me"'; }?>><?php echo ucwords($lihat->TIME);?></td>
						</tr>
						<?php endforeach;?>
					</tbody>
					</table>           
				</div> 
			<div class="icon">
			<i class="fa fa-info-circle"></i>
			</div>
			<!--<a href="< ?php echo base_url(); ?>admin/jenis_surat" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
			</div>
		</div><!-- ./col -->
		
		<!--Tambahan 30 Jan 2017  
		<div class="col-lg-6 col-xs-6">
			<!-- small box -- >
			<div class="small-box bg-green">
				<div class="inner">
				<table class="table dataTable">
					<thead>
						<tr> 
							<th>SERVER</th>
							<th>STATUS</th>
						</tr>	
					</thead>
					<tbody>
						<tr>
					 		<td>Stagging 220</td> < ?php pingAddress('10.1.192.220'); ?> 
						</tr> 
						<tr>
							 <td>Attendance 37</td>< ?php pingAddress('172.16.1.37'); ?> 
						</tr> 
						<tr>
							 <td>HQ HR Stagging 38</td>< ?php pingAddress('172.16.1.38'); ?> 
						</tr>  
					</tbody>
					</table>           
				</div> 
			<div class="icon">
			<i class="fa fa-info-circle"></i>
			</div>
			<!--<a href="< ?php echo base_url(); ?>admin/jenis_surat" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>- ->
			</div>
		</div><!-- ./col -->


            <!--<div class="col-lg-2 col-xs-6">
              <!-- small box -- >
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>< ?php echo $ttl_user_myhris; ?></h3>
                  <p>User MYHRIS</p>
                </div>
                <div class="icon">
                  <i class="fa fa-user"></i>
                </div> 
              </div>
            </div><!-- ./col -->

            <!--<div class="col-lg-2 col-xs-6">
              <!-- small box -- >
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>< ?php echo $mp_activ ?></h3>
                  <p>MP Active</p>
                </div>
                <div class="icon">
                  <i class="fa fa-user"></i>
                </div> 
              </div>
            </div><!-- ./col -->


            <!--<div class="col-lg-2 col-xs-6">
              <!-- small box -- >
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>< ?php echo $mp_resign ?></h3>
                  <p>MP Resign</p>
                </div>
                <div class="icon">
                  <i class="fa fa-user"></i>
                </div>
                <!--<a href="< ?php echo base_url(); ?>admin/jenis_surat" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>- ->
              </div>
            </div><!-- ./col -->
			

			
			<div class="<?php if($dbl_stagging == '0'){echo 'hide';} else {echo 'col-lg-3 col-xs-6';} ?>">
              <!-- small box -->
              <div class="small-box bg-red blink_me">
                <div class="inner">
                  <h3><?php echo $dbl_stagging;/*$surat_keluar*/; ?></h3>
                  <p>Double Stagging</p>
				  <textarea class="form-input">
			select assignment_number, effective_date, count(effective_date) jum from hris.ooa_temp
			group by assignment_number, effective_date
			having count(effective_date) > 1
				</textarea>
                </div>
                <div class="icon">
                  <i class="fa fa-trash-o"></i>
                </div>
                <!--<a href="< ?php echo base_url(); ?>admin/surat_keluar" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
              </div>
            </div><!-- ./col -->
			
           <div class="<?php if($dbl_bt == '0'){echo 'hide';} else {echo 'col-lg-3 col-xs-6';} ?>">
              <!-- small box -->
              <div class="small-box bg-red blink_me">
                <div class="inner">
                  <h3><?php echo $dbl_bt; ?></h3>
                  <p>Double (BT)</p>
				  <textarea>
					SELECT DISTINCT pas.assignment_number NPP,
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
					order by p.date_from desc 
					</textarea>	
                </div>
                <div class="icon">
                  <i class="fa fa-plane"></i>
                </div>
                <!--<a href="< ?php echo base_url(); ?>admin/jenis_surat" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
              </div>
            </div><!-- ./col -->
			
			<div class="<?php if($dbl_ooa == '0'){echo 'hide';} else {echo 'col-lg-3 col-xs-6';} ?>">
              <!-- small box -->
              <div class="small-box bg-red blink_me">
                <div class="inner">
                  <h3><?php echo $dbl_ooa; ?></h3>
                  <p>Double (OOA)</p>
				  <textarea>
					SELECT DISTINCT pas.assignment_number NPP,
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
					order by p.date_from desc
					</textarea>	
                </div>
                <div class="icon">
                  <i class="fa fa-road"></i>
                </div>
                <!--<a href="< ?php echo base_url(); ?>admin/jenis_surat" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
              </div>
            </div><!-- ./col -->
			
			<div class="<?php if($fail_route_detail == '0'){echo 'hide';} else {echo 'col-lg-3 col-xs-6';} ?>">
              <!-- small box -->
              <div class="small-box bg-red blink_me">
                <div class="inner">
                  <h3><?php echo $fail_route_detail; ?></h3>
                  <p>Fail Route Detail</p>
				  <textarea>
                    select c.name, a.position, a.link_to_hrm_area, a.LINK_TO_HRM ,(select e.USER_NAME from myhris.sys_user e where e.user_id = a.created_by ) created_by from 
                    myhris.sys_route_detail a, myhris.sys_Route_header b, myhris.sys_app_modules c, myhris.sys_apps d
                    where a.route_header_id = b.route_header_id and c.MODULE_ID = b.MODULE_ID and c.APP_ID = d.SYS_APP_ID and upper(d.name) like '%IBS%'
                    and (a.link_to_hrm_area ='' or a.link_to_hrm ='Y' or a.link_to_hrm_area is null)
                    union all
                    select c.name, a.position, a.link_to_hrm_area, a.LINK_TO_HRM , (select e.USER_NAME from myhris.sys_user e where e.user_id = a.created_by ) created_by from 
                    myhris.sys_route_detail a, myhris.sys_Route_header b, myhris.sys_app_modules c, myhris.sys_apps d
                    where a.route_header_id = b.route_header_id and c.MODULE_ID = b.MODULE_ID and c.APP_ID = d.SYS_APP_ID and upper(d.name) like '%HCM%'
                    and (a.link_to_hrm_area ='Y' or a.link_to_hrm ='Y')
                    union all
                    select c.name, a.position, a.link_to_hrm_area, a.LINK_TO_HRM, (select e.USER_NAME from myhris.sys_user e where e.user_id = a.created_by ) created_by from 
                    myhris.sys_route_detail a, myhris.sys_Route_header b, myhris.sys_app_modules c, myhris.sys_apps d
                    where a.route_header_id = b.route_header_id and c.MODULE_ID = b.MODULE_ID and c.APP_ID = d.SYS_APP_ID and upper(d.name) like '%RECRUITMENT%'
                    and (a.link_to_hrm_area ='Y' or a.link_to_hrm ='' or a.link_to_hrm is null)
					</textarea>	
                </div>
                <div class="icon">
                  <i class="fa fa-road"></i>
                </div>
                <!--<a href="< ?php echo base_url(); ?>admin/jenis_surat" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
              </div>
            </div><!-- ./col -->
			
			
			
			<div class="<?php if($dbl_spkl == '0'){echo 'hide';} else {echo 'col-lg-3 col-xs-6';} ?>">
              <!-- small box -->
              <div class="small-box bg-red blink_me">
                <div class="inner">
                  <h3><?php echo $dbl_spkl; ?></h3>
                  <p>Double (SPKL)</p>
				  <textarea>
						SELECT DISTINCT pas.assignment_number NPP,
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
						order by p.date_from desc
				  </textarea>
                </div>
                <div class="icon">
                  <i class="fa fa-clock-o"></i>
                </div>
                <!--<a href="< ?php echo base_url(); ?>admin/jenis_surat" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
              </div>
            </div><!-- ./col -->
			
			<div class="<?php if($ttl_plan == '0'){echo 'hide';} else {echo 'col-lg-3 col-xs-6';} ?>">
              <!-- small box -->
              <div class="small-box bg-red blink_me">
                <div class="inner">
                  <h3><?php echo $ttl_plan; ?></h3>
                  <p>Pengajuan Plan</p>
				  <textarea>
					select * from
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
					order by employee_number, creation_date desc
				  </textarea>
                </div>
                <div class="icon">
                  <i class="fa fa-calendar"></i>
                </div>
                <!--<a href="< ?php echo base_url(); ?>admin/jenis_surat" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
              </div>
            </div><!-- ./col -->
			
			
			
			<div class="<?php if($dbl_bee == '0'){echo 'hide';} else {echo 'col-lg-3 col-xs-6';} ?>">
              <!-- small box -->
              <div class="small-box bg-red blink_me">
                <div class="inner">
                  <h3><?php echo $dbl_bee; ?></h3>
                  <p>Double BEE</p>
				  <textarea>
					select ASSIGNMENT_NUMBER, EFFECTIVE_DATE, Count(EFFECTIVE_DATE) AS CountOfP_EFFECTIVE_DATE
					from HR.PAY_BATCH_LINES
					where BATCH_ID  in
					(
					concat(concat(to_char(sysdate,'rrrr'),to_char(sysdate,'mm')),'999'),
					concat(concat(to_char(sysdate,'rrrr'),to_char(add_months(sysdate,-1),'mm')),'999')
					)
					GROUP BY ASSIGNMENT_NUMBER,EFFECTIVE_DATE
					having Count(EFFECTIVE_DATE) > 1
					order by CountOfP_EFFECTIVE_DATE DESC;
				  </textarea>
                </div>
                <div class="icon">
                  <i class="fa fa-user"></i>
                </div>
                <!--<a href="< ?php echo base_url(); ?>admin/jenis_surat" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
              </div>
            </div><!-- ./col -->
			

			<div class="<?php if($user_hcm == '0'){echo 'hide';} else {echo 'col-lg-3 col-xs-6';} ?>">
              <!-- small box -->
              <div class="small-box bg-red blink_me">
                <div class="inner">
                  <h3><?php echo $user_hcm; ?></h3>
                  <p>User HCM belum di create</p>
				  <textarea>
					select distinct 
					pp.employee_number P_EMPLOYEE_NUMBER,
					pp.last_name P_NAME,
					ppo.date_start starting_Date,
					(select pos.name from per_positions pos where paa.position_id = pos.position_id) position,
					(select pos.name from per_jobs pos where paa.job_id = pos.job_id) job,
					(select haou.name from hr_all_organization_units haou where paa.organization_id = haou.organization_id) dept,
					(select fu.user_name from fnd_user fu where employee_number = fu.user_name) exist

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
					order by ppo.date_start asc;
				  </textarea>
                </div>
                <div class="icon">
                  <i class="fa fa-user"></i>
                </div>
                <!--<a href="< ?php echo base_url(); ?>admin/jenis_surat" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
              </div>
            </div><!-- ./col -->			
			


			<!--Tambahan 30 Jan 2017 -->
            <!--  <div class="col-lg-12 col-xs-12 table-responsive">
              <div class="small-box bg-green">
                <div class="inner">
					       <table id="example1" class="table dataTable">
						      <thead>
						        <tr> 
							      <th>LOCATION_CODE</th>
						      	<th>LOCATION_ID</th>
							     <th>JUMLAH_FINGER_ID</th>
							     <th>MAX_RETRIEVE</th>
						      </thead>
						      <tbody>
							 < ?php  
							$no = 1;
							
							foreach ($finger_id_log as $lihat):
							
							?>
							<tr>
							 
							<td < ?php if(($lihat->MAX_RETRIEVE) ==""){echo 'class="bg-red blink_me"';};?>>< ?php echo ucwords($lihat->LOCATION_CODE);?></td>
							<td < ?php if(($lihat->MAX_RETRIEVE) ==""){echo 'class="bg-red blink_me"';};?>>< ?php echo ucwords($lihat->LOCATION_ID);?></td>
							<td < ?php if(($lihat->MAX_RETRIEVE) ==""){echo 'class="bg-red blink_me"';};?>>< ?php echo ucwords($lihat->JUMLAH_FINGER_ID);?></td>
							<td < ?php if(($lihat->MAX_RETRIEVE) ==""){echo 'class="bg-red blink_me"';};?>>< ?php echo ucwords($lihat->MAX_RETRIEVE);?></td>

							</tr>
							< ?php endforeach; ?>
						</tbody>
					</table>           
                </div>
                <div class="icon">
                  <i class="fa fa-info-circle"></i>
                </div>
              </div>
            </div> -->
			
			
 


    </div><!-- /.row -->
          

        </section><!-- /.content -->
      </div><!-- /.content-wrapper