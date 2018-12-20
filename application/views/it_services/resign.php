<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           USER RESIGN
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Man Power</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          
          <!-- Small boxes (Stat box) -->
          <div class="row">
			<div class="col-xs-12">
          		<div class="box">
                <div class="box-header">
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
					  <table id="example1" class="table table-bordered table-hover">
						<thead>
						  <tr>
							<th>NIK</th>
							<th>NAMA</th>
							<th>RESIGN_DATE</th>
							<th>BRANCH</th>
							<th>JOB</th>
							<th>POSITION</th>
							<th>DEPARTEMENT</th>
						</thead>
						<tbody>
							<?php  
							$no = 1;
							foreach ($data as $lihat):
							?>
							<tr height="12.5px">
							<td><?php echo ucwords($lihat->P_EMPLOYEE_NUMBER);?></td>
							<td><?php echo ucwords($lihat->P_NAME);?></td>
							<td><?php echo ucwords($lihat->P_RESIGN_DATE);?></td>
							<td><?php echo ucwords($lihat->P_BRANCH_NAME);?></td>
							<td><?php echo ucwords($lihat->P_JOB);?></td>
							<td><?php echo ucwords($lihat->P_POSITION);?></td>
							<td><?php echo ucwords($lihat->P_ORGANIZATION);?></td> 
							</tr>
							<?php endforeach; ?>
						</tbody>
					  </table>
					  <br>
					  <b>Klik Disini Untuk Mendownload =></b> &nbsp;&nbsp;&nbsp; => &nbsp;&nbsp;&nbsp;<a href='<?php echo base_url(); ?>user/it_services/resign_to_excel' class='btn btn-primary' >Export Data to Excel</a>
						  <br>  
					 
				 
                </div>
             </div>
          </div><!-- /.row -->
		   
          

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
