<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            DATA CREDIT
            <!-- <small>Control panel</small> -->
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">SPKL</li>
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
                <div class="box-body table-responsive no-padding">
                
                 <!--  <table id="example1" class="table table-bordered table-hover dataTable bg-green">
                    <thead>
                      <tr>
                        <th>NIK</th>
                        <th>NAMA</th>
                        <th>DEPARTEMENT</th>
						<th>POSITION</th>
						<th>DATE_FROM</th>
						<th>START_TIME</th>
						<th>FINISH_TIME</th>
						<th>KETERANGAN</th>
						<th>ORDER_BY</th>

                    </thead>
                    <tbody>
                      	<?php  
                        $no = 1;
                        foreach ($data as $lihat):
                        ?>
                    	<tr>
						<td><?php echo ucwords($lihat->NIK);?></td>
						<td><?php echo ucwords($lihat->NAMA);?></td>
						<td><?php echo ucwords($lihat->DEPARTEMENT);?></td>
						<td><?php echo ucwords($lihat->POSITION);?></td>
						<td><?php echo ucwords($lihat->Q);?></td>
						<td><?php echo ucwords($lihat->START_TIME);?></td>
						<td><?php echo ucwords($lihat->FINISH_TIME);?></td>
						<td><?php echo ucwords($lihat->KETERANGAN);?></td>
						<td><?php echo ucwords($lihat->ORDER_BY);?></td>
                    	</tr>
                    	<?php endforeach; ?>
                    </tbody>
                  </table> -->
				  <a href='<?php echo base_url(); ?>user/rizsan/spkl_to_excel'><span style='color:green;'>Export All Data</span></a>
                  
                </div><!-- /.box-body -->
                </div>
             </div>
          </div><!-- /.row -->
		   
          

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
