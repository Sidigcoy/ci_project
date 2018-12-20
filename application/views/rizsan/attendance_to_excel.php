 <?php
 
 header("Content-type: application/ms-excel");
 
 header("Content-Disposition: attachment; filename=Laporan_Absensi.xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
 ?>
 <table id="example1" class="table table-bordered table-hover dataTable bg-green" border='2px'>
	<thead>
        <tr>
            <th width="3%">No.</th>
            <th width="8%">NIK</th>
            <th width="20%">Nama</th>
            <th width="10%">Tipe Pengembagan</th>
            <th width="20%">Penanggung Jawab</th>
            <th width="12%">Institusi</th>
            <th width="12%">Mulai</th>
            <th width="10%">Berakhir</th>                                              
    </thead>
    <tbody>
    <?php
        $nik                ="";
        $name               ="";
        $type_pengembangan  ="";
        $penanggung_jawab   ="";
        $institusi          ="";
        $start_date         ="";
        $end_date           ="";

            $rs = get_data_talent('',$connect);
            $i = 0;
            while (odbc_fetch_row($rs)){
                $i++;
                $nik                = odbc_result($rs,"nik");
                $name               = odbc_result($rs,"name");
                $type_pengembangan  = odbc_result($rs,"type_pengembangan");
                $penanggung_jawab   = odbc_result($rs, "aaaa");
                $institusi          = odbc_result($rs,"institusi");
                $start_date         = odbc_result($rs,"start_date");
                $end_date           = odbc_result($rs,"end_date");                      
    ?>
        <tr>
            <td width="3%"><?php echo $i.'.'; ?></td>
            <td width="9%"><?php echo $nik; ?></td> 
            <td width="20%"><?php echo $name; ?></td> 
            <td width="18"><?php echo $type_pengembangan; ?></td>
            <td width="20%"><?php echo $penanggung_jawab; ?></td>
            <td width="10%"><?php echo $institusi; ?></td>
            <td width="10%"><?php echo $start_date; ?></td> 
            <td width="10%"><?php echo $end_date; ?></td>      
    <?php  odbc_close($connect); }  ?>
        </tr>
    </tbody>
</table>

<?php 

function get_data_talent($p_nik ,$connect){
  $rs = "";
  if ($p_nik != "") {
    $a = "and ee.user_name = '$p_nik'";
    # code...
  }else{
    $a = "";}

      $str = "select distinct
              training_id,
              ee.user_name nik,
              pp.last_name name,
              upper(
                      case
                          when bb.name is null
                              then null
                          when bb.name like '%Mento%'
                              then 'MENTOR'
                          when bb.name like '%Lain%'
                              then  aa.training_type_other
                          else 'PELATIHAN' end)
                          type_pengembangan,
              (to_char (aa.start_date,'DD-MON-RRRR')) start_date,
              (to_char (aa.end_date,'DD-MON-RRRR')) end_date,
              cc.name institusi,
              aa.mentor aaaa,
              aa.recomendation

              from
              Myhris.sys_user ee,
              Myhris.rec_training_development aa,
              Myhris.rec_training_types bb,
              Myhris.rec_training_institutions cc,
              myhris.rec_trans dd,
              per_all_people_f pp

              where ee.person_id = pp.person_id
              and ee.person_id = dd.person_id
              and aa.training_type_id = bb.training_type_id
              and dd.rec_trans_id = aa.rec_trans_id
              and aa.institution_id = cc.institution_id
              and pp.employee_number = ee.user_name
              $a
              order by training_id desc;";


    $rs = odbc_exec($connect, $str);
  return $rs;
}

 ?>