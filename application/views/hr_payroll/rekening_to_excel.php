 <?php
 $date = date('d-M-Y');
 header("Content-type: application/ms-excel");
 
 header("Content-Disposition: attachment; filename=Laporan_MP_per_$date.xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
 ?>
<table id="example1" class="table table-bordered table-hover dataTable" border='2px'>
	<thead style="background-color:#000099;font-weight:bold">
	  <tr>
		<th style="background-color: #3c8dbc; color: seashell;">EMPLOYEE NUMBER</th>
		<th style="width: 500px; background-color: #3c8dbc; color: seashell;">NAME</th>
		<th style="width: 500px; background-color: #3c8dbc; color: seashell;">BRANCH</th>
		<th style="width: 500px; background-color: #3c8dbc; color: seashell;">DEPARTEMENT</th>
		<th style="width: 500px; background-color: #3c8dbc; color: seashell;">POSITION</th>
		<th style="width: 500px; background-color: #3c8dbc; color: seashell;">JOB</th>
		<th style="width: 500px; background-color: #3c8dbc; color: seashell;">BANK_NAME</th>
		<th style="width: 500px; background-color: #3c8dbc; color: seashell;">BANK_BRANCH_NAME</th>
		<th style="width: 500px; background-color: #3c8dbc; color: seashell;">ACCOUNT_NAME</th>
		<th style="width: 500px; background-color: #3c8dbc; color: seashell;">ACCOUNT_NUMBER</th>
		<th style="width: 500px; background-color: #3c8dbc; color: seashell;">PAYMENT_METHOD_DATE</th>
		<th style="width: 500px; background-color: #3c8dbc; color: seashell;">STARTING_DATE</th>
		<th style="width: 500px; background-color: #3c8dbc; color: seashell;">RESIGN_DATE</th>
	</thead>
	<tbody>
		<?php  
		$no = 1;
		foreach ($data as $lihat):
		?>
		<tr height="12.5px">
			<td width="48px">=right("<?php echo '-'.ucwords($lihat->NIK);?>",10)</td>
			<td><?php echo ucwords($lihat->NAME);?></td>
			<td><?php echo ucwords($lihat->BRANCH);?></td>
			<td><?php echo ucwords($lihat->DEPARTEMENT);?></td>
			<td><?php echo ucwords($lihat->POSITION);?></td>
			<td><?php echo ucwords($lihat->JOB);?></td>
			<td><?php echo ucwords($lihat->BANK_NAME);?></td>
			<td><?php echo ucwords($lihat->BANK_BRANCH_NAME);?></td>
			<td><?php echo ucwords($lihat->ACCOUNT_NAME);?></td>
			<td><?php echo ucwords($lihat->ACCOUNT_NUMBER);?></td>
			<td><?php echo ucwords($lihat->PAYMENT_METHOD_DATE);?></td>
			<td><?php echo ucwords($lihat->STARTING_DATE);?></td>
			<td><?php echo ucwords($lihat->RESIGN_DATE);?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>