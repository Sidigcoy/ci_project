<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Sisa Cuti Resign
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Sisa Cuti Resign</li>
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
                
                  <table id="example1" class="table table-bordered table-hover dataTable">
                    <thead>
                      <tr>
                        <th>NIK</th>
                        <th>NAMA</th>
                        <th>SISA CUTI</th>
						<th>TANGGAL RESIGN</th>
                    </thead>
                    <tbody>
                      	<?php  
                        $no = 1;
                        foreach ($data as $lihat):
                        ?>
                    	<tr>
						<td><?php echo ucwords($lihat->NIK);?></td>
						<td><?php echo ucwords($lihat->NAMA);?></td>
						<td><?php echo ucwords($lihat->SISA_CUTI);?></td>
                        <td><?php echo ucwords($lihat->TANGGAL_RESIGN);?></td> 
                    	</tr>
                    	<?php endforeach; ?>
                    </tbody>
                  </table>
				  <a href='toExcelAll'><span style='color:green;'>Export All Data</span></a>
                  
                </div><!-- /.box-body -->
                </div>
             </div>
          </div><!-- /.row -->
		   
          

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
