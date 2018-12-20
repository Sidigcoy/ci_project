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
		<th style="background-color: #3c8dbc; color: seashell;">P_EMPLOYEE_NUMBER</th>
		<th style="width: 500px; background-color: #3c8dbc; color: seashell;">P_NAME</th>
		<th style="background-color: #3c8dbc; color: seashell;">P_GENDER</th>
		<th style="background-color: #3c8dbc; color: seashell;">P_GRADE</th> 
		<th style="background-color: #3c8dbc; color: seashell;">P_DATE_OF_BIRTH</th>
		<th style="background-color: #3c8dbc; color: seashell;">P_STARTING_DATE</th>
		<th style="background-color: #3c8dbc; color: seashell;">P_RESIGN_DATE</th>
		<th style="background-color: #3c8dbc; color: seashell;">P_JOB_TYPE</th>
		<th style="background-color: #3c8dbc; color: seashell;">P_EMPLOYEMENT_STATUS</th>
		<th style="width: 500px; background-color: #3c8dbc; color: seashell;">P_BRANCH_NAME</th>
		<th style="width: 500px; background-color: #3c8dbc; color: seashell;">P_JOB</th>
		<th style="width: 500px; background-color: #3c8dbc; color: seashell;">P_ORGANIZATION</th>
		<th style="width: 500px; background-color: #3c8dbc; color: seashell;">P_POSITION</th>
		<th style="width: 500px; background-color: #3c8dbc; color: seashell;">P_HOMEBASE</th>
	</thead>
	<tbody>
		<?php  
		$no = 1;
		foreach ($data as $lihat):
		?>
		<tr height="12.5px">
			<td width="48px">=right("<?php echo '-'.ucwords($lihat->P_EMPLOYEE_NUMBER);?>",10)</td>
			<td><?php echo ucwords($lihat->P_NAME);?></td>
			<td><?php echo ucwords($lihat->P_GENDER);?></td>
			<td><?php echo ucwords($lihat->P_GRADE);?></td> 
			<td><?php echo  $lihat->P_DATE_OF_BIRTH ;?></td>
			<td><?php echo  $lihat->P_STARTING_DATE ;?></td>
			<td><?php echo  $lihat->P_RESIGN_DATE ;?></td>
			<td><?php echo ucwords($lihat->P_JOB_TYPE);?></td>
			<td><?php echo ucwords($lihat->P_EMPLOYEMENT_STATUS);?></td>
			<td><?php echo ucwords($lihat->P_BRANCH_NAME);?></td>
			<td><?php echo ucwords($lihat->P_JOB);?></td>
			<td><?php echo ucwords($lihat->P_ORGANIZATION);?></td>
			<td><?php echo ucwords($lihat->P_POSITION);?></td>
			<td><?php echo ucwords($lihat->P_HOMEBASE);?></td>

		</tr>
		<?php endforeach; ?>
	</tbody>
</table>