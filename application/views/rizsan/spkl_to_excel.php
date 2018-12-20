 <?php
 
 header("Content-type: application/ms-excel");
 
 header("Content-Disposition: attachment; filename=Laporan_SPKL.xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
 ?>
 
<table id="example1" class="table table-bordered table-hover dataTable bg-green" border='2px'>
	<thead>
	  <tr>
		<th width="48px">NIK KARYAWAN</th>
		<th>NAMA</th>
		<th>DEPARTEMENT</th>
		<th>POSITION</th>
		<th>DATE_FROM</th>
		<th>START_TIME</th>
		<th>FINISH_TIME</th>
		<th>KETERANGAN</th>
		<th width="48px">ORDER_BY</th>

	</thead>
	<tbody>
		<?php  
		$no = 1;
		foreach ($data as $lihat):
		?>
		<tr>
		<td width="48px">=right("<?php echo 'a'.ucwords($lihat->NIK);?>",10)</td>
		<td><?php echo ucwords($lihat->NAMA);?></td>
		<td><?php echo ucwords($lihat->DEPARTEMENT);?></td>
		<td><?php echo ucwords($lihat->POSITION);?></td>
		<td><?php echo ucwords($lihat->Q);?></td>
		<td><?php echo ucwords($lihat->START_TIME);?></td>
		<td><?php echo ucwords($lihat->FINISH_TIME);?></td>
		<td><?php echo ucwords($lihat->KETERANGAN);?></td>
		<td width="48px">=right("<?php echo "".ucwords($lihat->ORDER_BY);?>",10)</td>
		</tr>
		<?php $no ++; endforeach; ?>
	</tbody>
</table>