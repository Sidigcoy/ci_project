<?php 
header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=MP_to_Excel.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<div class="box-body table-responsive no-padding">
  <table id="example1" class="table table-bordered table-hover dataTable" border="2px">
	<thead style='color:blue;'>
	  <tr>
		<th>NIK</th>
		<th>NAMA</th>
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
		
		<tr>
		<td><?php echo ucwords($lihat->P_EMPLOYEE_NUMBER); ?></td>
		<td><?php echo ucwords($lihat->P_NAME);?></td>
		<td><?php echo ucwords($lihat->P_BRANCH_NAME);?></td>
		<td><?php echo ucwords($lihat->P_JOB);?></td>
		<td><?php echo ucwords($lihat->P_POSITION);?></td>
		<td><?php echo ucwords($lihat->P_ORGANIZATION);?></td> 
		</tr>
		<?php endforeach; ?>
	</tbody>
  </table>
  <a href='toExcelAll'><span style='color:green;'>Export All Data</span></a>
</div><!-- /.box-body -->