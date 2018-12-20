 <?php
 $date = date('d-M-Y');
 header("Content-type: application/vnd.ms-excel; charset=utf-8");
 
 header("Content-Disposition: attachment; filename=user_aktif_$date.xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
 ?>
<table id="example1" class="table table-bordered table-hover dataTable" border='2px'>
	<thead>
	  <tr>
		<th width="48px" style="background-color: #3c8dbc; color: seashell;">NIK KARYAWAN</th>
		<th style="background-color: #3c8dbc; color: seashell;">NAMA</th>
		<th style="background-color: #3c8dbc; color: seashell;">BRANCH</th>
		<th style="background-color: #3c8dbc; color: seashell;">JOB</th>
		<th style="width: 500px; background-color: #3c8dbc; color: seashell;" >POSITION</th>
		<th style="width: 400px; background-color: #3c8dbc; color: seashell;" >DEPARTEMENT</th>
		<th style="background-color: #3c8dbc; color: seashell;">STARTING_DATE</th>
		<th style="background-color: #3c8dbc; color: seashell;">TANGGAL RESIGN</th>
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
		<td><?php echo ucwords($lihat->P_STARTING_DATE);?></td>
		<td><?php echo ucwords($lihat->P_RESIGN_DATE);?></td>		
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>