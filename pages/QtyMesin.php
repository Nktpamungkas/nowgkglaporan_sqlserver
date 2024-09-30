<?php
$Awal	= isset($_POST['tgl_awal']) ? $_POST['tgl_awal'] : '';
$Akhir	= isset($_POST['tgl_akhir']) ? $_POST['tgl_akhir'] : '';
?>
<!-- Main content -->
      <div class="container-fluid">
		<form role="form" method="post" enctype="multipart/form-data" name="form1">  
		<div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Filter Data</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->		  
          <div class="card-body">
             <div class="form-group row">
               <label for="tgl_awal" class="col-md-1">Tgl Awal</label>
               <div class="col-md-2">  
                 <div class="input-group date" id="datepicker1" data-target-input="nearest">
                    <div class="input-group-prepend" data-target="#datepicker1" data-toggle="datetimepicker">
                      <span class="input-group-text btn-info">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    <input name="tgl_awal" value="<?php echo $Awal;?>" type="text" class="form-control form-control-sm" id=""  autocomplete="off" required>
                 </div>
			   </div>	
            </div>
				 <div class="form-group row">
                    <label for="tgl_akhir" class="col-md-1">Tgl Akhir</label>
					<div class="col-md-2">  
                    <div class="input-group date" id="datepicker2" data-target-input="nearest">
                    <div class="input-group-prepend" data-target="#datepicker2" data-toggle="datetimepicker">
                      <span class="input-group-text btn-info">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    <input name="tgl_akhir" value="<?php echo $Akhir;?>" type="text" class="form-control form-control-sm"  autocomplete="off" required>
                  </div>
					</div>	
                  </div>
			  <button class="btn btn-primary" type="submit">Cari Data</button>
          </div>		  
		  <!-- /.card-body -->          
        </div>  
		</form>	
		<div class="card">
              <div class="card-header">
                <h3 class="card-title">Qty Per Mesin</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-sm table-bordered table-striped" style="font-size:13px;">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Shift</th>
                    <th>Mesin</th>
                    <th>Qty</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php
	if( $Awal!="" and $Akhir!=""){				  
	$Tgl= " AND VARCHAR_FORMAT(e.INSPECTIONSTARTDATETIME,'YYYY-MM-DD') BETWEEN '$Awal' AND '$Akhir' " ;
	}else{
		$Tgl= " AND VARCHAR_FORMAT(e.INSPECTIONSTARTDATETIME,'YYYY-MM-DD') BETWEEN '2200-12-12' AND '2200-12-12' " ;
	}
$sqlDB2 =" SELECT sum(e.WEIGHTNET) AS KG,ik.SCHEDULEDRESOURCECODE, 
CASE 
      WHEN 
         VARCHAR_FORMAT(e.INSPECTIONSTARTDATETIME,'HH24:MI') > '06:59' AND VARCHAR_FORMAT(e.INSPECTIONSTARTDATETIME,'HH24:MI') < '14:59' 
      THEN 
         '1'
      ELSE 
         CASE 
      WHEN 
         VARCHAR_FORMAT(e.INSPECTIONSTARTDATETIME,'HH24:MI') > '14:59' AND VARCHAR_FORMAT(e.INSPECTIONSTARTDATETIME,'HH24:MI') < '22:59'
      THEN 
         '2'
      ELSE 
         '3'
   END 
   END AS SHIFT
FROM ELEMENTSINSPECTION e LEFT JOIN ITXVIEWKK_KNT ik ON ik.CODE= e.DEMANDCODE 
WHERE e.ELEMENTITEMTYPECODE ='KGF' $Tgl 
GROUP BY  ik.SCHEDULEDRESOURCECODE,(CASE 
      WHEN 
         VARCHAR_FORMAT(e.INSPECTIONSTARTDATETIME,'HH24:MI') > '06:59' AND VARCHAR_FORMAT(e.INSPECTIONSTARTDATETIME,'HH24:MI') < '14:59' 
      THEN 
         '1'
      ELSE 
         CASE 
      WHEN 
         VARCHAR_FORMAT(e.INSPECTIONSTARTDATETIME,'HH24:MI') > '14:59' AND VARCHAR_FORMAT(e.INSPECTIONSTARTDATETIME,'HH24:MI') < '22:59'
      THEN 
         '2'
      ELSE 
         '3'
   END 
   END) ";	
$stmt   = db2_exec($conn1,$sqlDB2, array('cursor'=>DB2_SCROLLABLE));
$no=1;   
$c=0;
 while ($rowdb2 = db2_fetch_assoc($stmt)) {
	   ?>
	  <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $rowdb2['SHIFT']; ?></td>
      <td><?php echo $rowdb2['SCHEDULEDRESOURCECODE']; ?></td>
      <td><?php echo $rowdb2['KG']; ?></td>
      </tr>				  
	<?php 
	 $no++;} ?>
				  </tbody>
                  <!--<tfoot>
                  <tr>
                    <th>No</th>
                    <th>No Mc</th>
                    <th>Sft</th>
                    <th>User</th>
                    <th>Operator</th>
					<th>Leader</th>
                    <th>NoArt</th>
                    <th>TgtCnt (100%)</th>
                    <th>Rpm</th>
                    <th>Cnt/Roll</th>
					<th>Jam Kerja</th>
				    <th>Count</th>
				    <th>Count</th>
				    <th>RL</th>
				    <th>Kgs</th>
				    <th>Grp</th>
      				<th>Tgt Grp (%)</th>
      				<th>Eff (%)</th>
      				<th>Hasil (%)</th>  
				    <th>Kd</th>
				    <th>Min</th>
				    <th>Kd</th>
				    <th>Min</th>
				    <th>Kd</th>
				    <th>Min</th> 
					<th>Tanggal</th>
      				<th>Keterangan</th>
                  </tr>
                  </tfoot>-->
                </table>
              </div>
              <!-- /.card-body -->
            </div>  
      </div><!-- /.container-fluid -->
    <!-- /.content -->
<script>
	$(function () {
		//Datepicker
    $('#datepicker').datetimepicker({
      format: 'YYYY-MM-DD'
    });
    $('#datepicker1').datetimepicker({
      format: 'YYYY-MM-DD'
    });
    $('#datepicker2').datetimepicker({
      format: 'YYYY-MM-DD'
    });
	
});		
</script>