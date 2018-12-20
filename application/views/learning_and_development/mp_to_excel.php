 <?php
 
 header("Content-type: application/ms-excel");
 
 header("Content-Disposition: attachment; filename=Laporan_Preample.xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
 ?>
<table id="example1" class="table table-bordered table-hover dataTable" border='2px'>
	<thead>
	  <tr>
		<th width="48px">NIK KARYAWAN</th>
		<th>NAMA</th>
		<th>BRANCH</th>
		<th>JOB</th>
		<th style="width: 500px;" >POSITION</th>
		<th style="width: 400px;" >DEPARTEMENT</th>
		<th>TANGGAL RESIGN</th>
	</thead>
	<tbody>
		<?php  
		$no = 1;
		foreach ($data as $lihat):
		?>
		<tr height="12.5px">
		<td width="48px">=right("<?php echo '-'.ucwords($lihat->P_EMPLOYEE_NUMBER);?>",10)</td>
		<td><?php echo ucwords($lihat->P_NAME);?></td>
		<td><?php echo ucwords($lihat->P_BRANCH_NAME);?></td>
		<td><?php echo ucwords($lihat->P_JOB);?></td>
		<td><?php echo ucwords($lihat->P_POSITION);?></td>
		<td><?php echo ucwords($lihat->P_ORGANIZATION);?></td>
		<td><?php echo ucwords($lihat->P_RESIGN_DATE);?></td>		
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>