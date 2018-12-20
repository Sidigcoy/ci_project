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
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php echo "0"/*$surat_keluar*/; ?></h3>
                  <p>Surat Keluar</p>
                </div>
                <div class="icon">
                  <i class="fa fa-envelope"></i>
                </div>
                <a href="<?php echo base_url(); ?>admin/surat_keluar" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo $jenis; ?></h3>
                  <p>Jenis Surat</p>
                </div>
                <div class="icon">
                  <i class="fa fa-tag"></i>
                </div>
                <a href="<?php echo base_url(); ?>admin/jenis_surat" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
			<div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo $jenis; ?></h3>
                  <p>Jenis Surat</p>
                </div>
                <div class="icon">
                  <i class="fa fa-tag"></i>
                </div>
                <a href="<?php echo base_url(); ?>admin/jenis_surat" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
			<div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo $jenis; ?></h3>
                  <p>Jenis Surat</p>
                </div>
                <div class="icon">
                  <i class="fa fa-tag"></i>
                </div>
                <a href="<?php echo base_url(); ?>admin/jenis_surat" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
			<div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo $jenis; ?></h3>
                  <p>Jenis Surat</p>
                </div>
                <div class="icon">
                  <i class="fa fa-tag"></i>
                </div>
				
                <a href="<?php echo base_url(); ?>admin/jenis_surat" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          </div><!-- /.row -->
		  <table id="example1" class="table table-bordered table-hover dataTable">
			<thead>
			  <tr>
				<th>No</th>
				<th>Jenis Surat</th>
				<th>Aksi</th>
				<th>No</th>
				<th>Jenis Surat</th>
				<th>Aksi</th>
				<th>No</th>
				<th>Jenis Surat</th>
				<th>Aksi</th>
				<th>No</th>
				<th>Jenis Surat</th>
				<th>Aksi</th>
				
			</thead>
			<tbody>
				 
				<tr>
				<td>1a</td>
				<td>2ss</td>
				<td>1d</td>
				<td>ff2</td>
				<td>1gg</td>
				<td>vv2</td>
				<td>1bb</td>
				<td>2nnn</td>
				<td>1mmm</td>
				<td>2ww</td>
				<td>1ww</td> 
				<td align="center">
				  <div class="btn-group" role="group">
					<a href="#" class="btn btn-sm btn-primary btn-flat"><i class="fa fa-edit"></i> Edit</a>
					<a href="#" onclick="javascript: return confirm('Anda yakin akan menghapus data ini ?')" class="btn btn-sm btn-danger btn-flat"><i class="fa fa-trash"></i> Hapus</a>
				  </div>
				</td>                  		
				</tr>
				<tr>
				<td>1</td>
				<td>2</td>
				<td>1</td>
				<td>2</td>
				<td>1</td>
				<td>2</td>
				<td>1</td>
				<td>2</td>
				<td>1</td>
				<td>2</td>
				<td>1</td> 
				<td align="center">
				  <div class="btn-group" role="group">
					<a href="#" class="btn btn-sm btn-primary btn-flat"><i class="fa fa-edit"></i> Edit</a>
					<a href="#" onclick="javascript: return confirm('Anda yakin akan menghapus data ini ?')" class="btn btn-sm btn-danger btn-flat"><i class="fa fa-trash"></i> Hapus</a>
				  </div>
				</td>                  		
				</tr>
				<tr>
				<td>1</td>
				<td>2</td>
				<td>1</td>
				<td>2</td>
				<td>1</td>
				<td>2</td>
				<td>1</td>
				<td>2</td>
				<td>1</td>
				<td>2</td>
				<td>1</td> 
				<td align="center">
				  <div class="btn-group" role="group">
					<a href="#" class="btn btn-sm btn-primary btn-flat"><i class="fa fa-edit"></i> Edit</a>
					<a href="#" onclick="javascript: return confirm('Anda yakin akan menghapus data ini ?')" class="btn btn-sm btn-danger btn-flat"><i class="fa fa-trash"></i> Hapus</a>
				  </div>
				</td>                  		
				</tr>
				 
			</tbody>
		  </table>
          

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
