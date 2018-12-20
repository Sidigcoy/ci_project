<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            USER BELUM DAFTAR MY HRIS
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">User Non MyhriS</li>
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
                        <th>CABANG</th>
						<th>JOB</th>
						<th>DEPARTEMEN</th>
						<th>POSISI</th>
                    </thead>
                    <tbody>
                   <!--   	< ?php  
                        $no = 1;
                        foreach ($data as $lihat):
                        ?>
                    	<tr>
						<td>< ?php echo ucwords($lihat->P_EMPLOYEE_NUMBER);?></td>
						<td>< ?php echo ucwords($lihat->P_NAME);?></td>
						<td>< ?php echo ucwords($lihat->P_BRANCH_NAME);?></td>
                        <td>< ?php echo ucwords($lihat->P_JOB);?></td>
						<td>< ?php echo ucwords($lihat->P_ORGANIZATION);?></td>
						<td>< ?php echo ucwords($lihat->P_POSITION);?></td>						
                    	</tr>
                    	< ?php endforeach; ?> -->
                    </tbody>
                  </table>
				  <a href='toExcelAll'><span style='color:green;'>Export All Data</span></a>
                  
                </div><!-- /.box-body -->
                </div>
             </div>
          </div><!-- /.row -->
		   
          

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
