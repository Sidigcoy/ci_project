<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            DATA CREDIT
            </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Data Attendance</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          
          <!-- Small boxes (Stat box) -->
          <div class="row">
      <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
				  <a href='<?php echo base_url(); ?>user/rizsan/attendance_to_excel' class='btn btn-primary'><span style='color:white;'>Attendance</span></a> <br>
          <br>
          <a href='<?php echo base_url(); ?>user/rizsan/spkl_to_excel' class='btn btn-primary'><span style='color:white;'>SPKL</span></a> 
          

                  <div class="box-tools">
                    <!--
                    <div class="input-group" style="width: 150px;">
                      <input type="text" name="table_search" class="form-control input-sm pull-right" placeholder="Search">
                      <div class="input-group-btn">
                        <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                      </div>
                    </div>
                    -->
                  </div>
                </div><!-- /.box-header -->
                <!-- <div class="box-body table-responsive no-padding">
                
                  <table id="example1" class="table table-bordered table-hover dataTable">
                    <thead>
                      <tr>
                        <th>NIK</th>
                        <th>NAMA</th>
                        <th>DEPARTMENT</th>
                        <th>WORK_DATE</th>
                        <th>TIME_IN</th>
                        <th>TIME_OUT</th>
                        <th>LATE</th>
                        <th>ABSENCE_STATUS</th>
                    </thead>
                    <tbody>
                        <?php  
                        $no = 1;
                        foreach ($absensi_dept_terkait as $lihat):
                        ?>
                      <tr>
            <td><?php echo ucwords($lihat->NIK);?></td>
            <td><?php echo ucwords($lihat->NAME);?></td>
            <td><?php echo ucwords($lihat->DEPARTMENT);?></td>
            <td><?php echo ucwords($lihat->WORK_DATE_CHAR);?></td>
            <td><?php echo ucwords($lihat->TIME_IN);?></td>
            <td><?php echo ucwords($lihat->TIME_OUT);?></td>
            <td><?php echo ucwords($lihat->LATE); ?></td>
            <td><?php echo ucwords($lihat->ABSENCE_STATUS);?></td>
                      </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table> 
                  
                </div>--><!-- /.box-body -->
                </div>
             </div>           
			
 
 
 
 
	    </div><!-- /.row -->
          

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->