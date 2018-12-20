Content Wrapper. Contains page content -->
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
            
      
      <div class="col-lg-6 col-xs-6">
      <h3 class="box-title">Tablespace</h3>
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
          <table class="table dataTable">
            <thead>
              <tr>
              <th>Tablespace</th>
              <!-- <th>Used</th> -->
              <th>Free (MegaByte)</th>
              <th>Total (MegaByte)</th>
              <th>Percentage (%)</th>
            </thead>
            <tbody>
              <?php  
              //$no = 1;
              foreach ($data as $lihat):
              ?>
              <!-- <tr < ?php if(($lihat->PCTFR) !="0" ){ echo 'class="bg-red blink_me" ';} ?>> -->
              <td><?php echo ucwords($lihat-> TABLESPACE_NAME);?></td>
              <td><?php echo ucwords($lihat-> FREE_SPACE);?></td>
              <td><?php echo ucwords($lihat-> TOTAL_MB);?></td>
              <!-- <td><?php echo ucwords($lihat-> LARGEST);?></td> -->
              <td><?php echo ucwords($lihat-> PERCENT_USED);?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>           
                </div>
                <div class="icon">
                  <i class="fa fa-rocket"></i>
                </div>
                <!--<a href="< ?php echo base_url(); ?>admin/jenis_surat" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
              </div>
            </div><!-- ./col -->

      
      <div class="col-lg-6 col-xs-6">
      <h3 class="box-title">ASM SPACE</h3>
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
          <table class="table dataTable">
            <thead>
              <tr>
              <th>NAME</th>
              <th>FREE_MB</th>
              <th>TOTAL_MB</th>
              <th>PERCENTAGE</th>
            </thead>
            <tbody>
              <?php  
              //$no = 1;
              foreach ($cek_memori as $lihat):
              ?>
              <tr <?php if(($lihat->PERCENTAGE)>='95' && $lihat->NAME =='ARCH' ){ echo 'class="bg-red blink_me" ';} if(($lihat->PERCENTAGE)>='90' && $lihat->NAME =='DATA' ){ echo 'class="bg-red blink_me" ';} ?>>
              <td><?php echo ucwords($lihat->NAME);?></td>
              <td><?php  echo ucwords($lihat->FREE_MB);?></td>
              <td><?php echo ucwords($lihat->TOTAL_MB);?></td>
              <td><?php echo ucwords($lihat->PERCENTAGE)."%";?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>           
                </div>
                <div class="icon">
                  <i class="fa fa-info-circle"></i>
                </div>
                <!--<a href="< ?php echo base_url(); ?>admin/jenis_surat" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
              </div>
            </div><!-- ./col -->

            <div class="col-lg-6 col-xs-6">
            <h3 class="box-title">DataGuard</h3>
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
          <table class="table dataTable">
            <thead>
              <tr> 
              <th>LOGS</th>
              <th>TIMES</th>
            </thead>
            <tbody>
              <?php  
              $no = 1;
              //$strDate1 = TIME;
              //$strDate2 = TIME;
              //$date1 = new DateTime($strDate1);
              //$date2 = new DateTime ($strDate2);
              //$dateDiff = $date1->diff($date2);
              //echo $dateDiff->format("%a");
              
              
              foreach ($cek_DRC as $lihat):
               
               
              //echo $TIME;
                //$GAP  = $LOGS - $TIME;
              ?>
              <tr>
               
              <td <?php if(($lihat->LOGS) =="GAP :" && $lihat->TIME > 1 ){echo 'class="bg-red blink_me"';};?>><?php echo ucwords($lihat->LOGS);?></td>
              <td <?php if(($lihat->LOGS) =="GAP :" && $lihat->TIME > 1 ){echo 'class="bg-red blink_me"';};?>><?php echo ucwords($lihat->TIME);?></td>

              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>           
                </div> 
                <div class="icon">
                  <i class="fa fa-info-circle"></i>
                </div>
                <!--<a href="< ?php echo base_url(); ?>admin/jenis_surat" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
              </div>
            </div><!-- ./col -->


           
      
      </div><!-- /.row -->
          

        </section><!-- /.content -->
      </div><!-- /.content-wrapper