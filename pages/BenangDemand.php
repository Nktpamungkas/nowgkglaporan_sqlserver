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
                <h3 class="card-title">Benang Per Mesin</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-sm table-bordered table-striped" style="font-size:13px;">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Tgl Selesai</th>
                    <th>Prod. Order</th>
                    <th>Demand</th>
                    <th>NoArt</th>
                    <th>Jenis Benang</th>
                    <th>No Mesin</th>
                    <th>Rol</th>
                    <th>Kgs</th>
                    <th>BS Mekanik</th>
                    <th>%</th>
                    <th>BS Produksi</th>
                    <th>%</th>
                    <th>Lain-Lain</th>
                    <th>%</th>
                    <th>Sisa</th>
                    <th>Pakai</th>
                    <th>Loss (Kgs)</th>
                    <th>Loss (%)</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php
	if( $Awal!="" and $Akhir!=""){				  
	$Tgl= " AND VARCHAR_FORMAT(i.FINALEFFECTIVEDATE,'YYYY-MM-DD') BETWEEN '$Awal' AND '$Akhir' " ;
	}else{
		$Tgl= " AND VARCHAR_FORMAT(i.FINALEFFECTIVEDATE,'YYYY-MM-DD') BETWEEN '2200-12-12' AND '2200-12-12' " ;
	}  
$sqlDB2 =" SELECT i.PRODUCTIONDEMANDCODE,i.PRODUCTIONORDERCODE,count(e.WEIGHTREALNET) AS INSROL,sum(e.WEIGHTREALNET) AS INSKG,
i.LEGALNAME1,i.SUBCODE02,i.SUBCODE03,i.SUBCODE04,i.PROJECTCODE,i.SCHEDULEDRESOURCECODE,VARCHAR_FORMAT(i.FINALEFFECTIVEDATE,'YYYY-MM-DD') AS TGLSELESAI 
FROM ITXVIEWKNTORDER i 
LEFT JOIN STOCKTRANSACTION s ON s.PRODUCTIONORDERCODE =i.PRODUCTIONORDERCODE
LEFT JOIN ELEMENTSINSPECTION e ON e.DEMANDCODE =s.ORDERCODE AND e.ELEMENTCODE =s.ITEMELEMENTCODE
WHERE  i.PROGRESSSTATUS='6'  AND i.ITEMTYPEAFICODE ='KGF' $Tgl
GROUP BY i.PRODUCTIONDEMANDCODE,i.FINALEFFECTIVEDATE,
i.LEGALNAME1,i.SUBCODE02,i.SUBCODE03,i.SUBCODE04,i.PROJECTCODE,i.SCHEDULEDRESOURCECODE,i.PRODUCTIONORDERCODE ";	
$stmt   = db2_exec($conn1,$sqlDB2, array('cursor'=>DB2_SCROLLABLE));
$no=1;   
$c=0;
$prsn=0;
$prsn1=0;
$prsn2=0;					  
 while ($rowdb2 = db2_fetch_assoc($stmt)) {
	 
	 $sqlDB21 = " SELECT sum(s.BASEPRIMARYQUANTITY) AS KGPAKAI FROM STOCKTRANSACTION s WHERE s.TEMPLATECODE='120' AND s.ITEMTYPECODE='GYR' AND s.ORDERCODE='$rowdb2[PRODUCTIONORDERCODE]' ";
	 $stmt1   = db2_exec($conn1,$sqlDB21, array('cursor'=>DB2_SCROLLABLE));
	 $rowdb21 = db2_fetch_assoc($stmt1);
	 
	 $sqlDB22 = " SELECT sum(s.WEIGHTREALNET) AS KGSISA FROM STOCKTRANSACTION s WHERE s.TEMPLATECODE='125' AND s.ITEMTYPECODE='GYR' AND s.ORDERCODE='$rowdb2[PRODUCTIONORDERCODE]' ";
	 $stmt2   = db2_exec($conn1,$sqlDB22, array('cursor'=>DB2_SCROLLABLE));
	 $rowdb22 = db2_fetch_assoc($stmt2);
	 
	 $sqlDB23 = " SELECT FULLITEMKEYDECODER.SUMMARIZEDDESCRIPTION
     FROM DB2ADMIN.PRODUCTIONRESERVATION PRODUCTIONRESERVATION LEFT OUTER JOIN 
     DB2ADMIN.BOMCOMPONENT BOMCOMPONENT ON 
     PRODUCTIONRESERVATION.BOMCOMPSEQUENCE=BOMCOMPONENT.SEQUENCE AND 
     PRODUCTIONRESERVATION.BOMCOMPBILLOFMATERIALNUMBERID=BOMCOMPONENT.BILLOFMATERIALNUMBERID LEFT OUTER JOIN 
     DB2ADMIN.FULLITEMKEYDECODER FULLITEMKEYDECODER ON
     PRODUCTIONRESERVATION.FULLITEMIDENTIFIER =FULLITEMKEYDECODER.IDENTIFIER
	 WHERE BOMCOMPONENT.BILLOFMATERIALITEMTYPECODE='KGF' 
	 AND BOMCOMPONENT.BILLOFMATERIALSUBCODE02='$rowdb2[SUBCODE02]' 
	 AND BOMCOMPONENT.BILLOFMATERIALSUBCODE03 ='$rowdb2[SUBCODE03]'
	 AND BOMCOMPONENT.BILLOFMATERIALSUBCODE04 ='$rowdb2[SUBCODE04]'
	 AND PRODUCTIONRESERVATION.ORDERCODE ='$rowdb2[PRODUCTIONDEMANDCODE]' ";
	 $stmt3   = db2_exec($conn1,$sqlDB23, array('cursor'=>DB2_SCROLLABLE));
	 
	 
	 $sql=mysqli_query($con," SELECT berat_awal FROM tbl_inspeksi_detail_now tidn WHERE tidn.demandno='$rowdb2[PRODUCTIONDEMANDCODE]' and tidn.ket_bs ='BS Mekanik'");
	 $rowd=mysqli_fetch_array($sql);
	 $sql1=mysqli_query($con," SELECT berat_awal FROM tbl_inspeksi_detail_now tidn WHERE tidn.demandno='$rowdb2[PRODUCTIONDEMANDCODE]' and tidn.ket_bs ='BS Produksi'");
	 $rowd1=mysqli_fetch_array($sql1);
	 $sql2=mysqli_query($con," SELECT berat_awal FROM tbl_inspeksi_detail_now tidn 
	 WHERE tidn.demandno='$rowdb2[PRODUCTIONDEMANDCODE]' and tidn.ket_bs ='BS Lain-lain'");
	 $rowd2=mysqli_fetch_array($sql2);
	 if($rowdb2['INSKG']>0){
	 $prsn=round(($rowd['berat_awal']/$rowdb2['INSKG'])*100,2);
	 $prsn1=round(($rowd1['berat_awal']/$rowdb2['INSKG'])*100,2);
	 $prsn2=round(($rowd2['berat_awal']/$rowdb2['INSKG'])*100,2);
	 }
	 $hslkg=$rowdb2['INSKG']+$rowdb22['KGSISA']+$rowd['berat_awal']+$rowd1['berat_awal']+$rowd2['berat_awal'];
	 $losskg=round($rowdb21['KGPAKAI']-$hslkg,2);
	 if($rowdb21['KGPAKAI']>0){
	 $prsnLoss=round(($losskg/$rowdb21['KGPAKAI'])*100,2);
	 }else{
	 $prsnLoss=0; 
	 }
	   ?>
	  <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $rowdb2['TGLSELESAI']; ?></td>
      <td><?php echo $rowdb2['PRODUCTIONORDERCODE']; ?></td>
      <td><?php echo $rowdb2['PRODUCTIONDEMANDCODE']; ?></td>
      <td><?php echo trim($rowdb2['SUBCODE02']).trim($rowdb2['SUBCODE03']); ?></td>
      <td><?php $noBn=1; while ($rowdb23 = db2_fetch_assoc($stmt3)){echo $noBn.". ".$rowdb23['SUMMARIZEDDESCRIPTION']."<br>"; $noBn++;}?></td>
      <td><?php echo $rowdb2['SCHEDULEDRESOURCECODE']; ?></td>
      <td><?php echo $rowdb2['INSROL']; ?></td>
      <td><?php echo $rowdb2['INSKG']; ?></td>
      <td><?php echo round($rowd['berat_awal'],2); ?></td>
      <td><?php echo $prsn; ?></td>
      <td><?php echo round($rowd1['berat_awal'],2); ?></td>
      <td><?php echo $prsn1; ?></td>
      <td><?php echo round($rowd2['berat_awal'],2); ?></td>
      <td><?php echo $prsn2; ?></td>
      <td><?php echo round($rowdb22['KGSISA'],2); ?></td>
      <td><?php echo round($rowdb21['KGPAKAI'],2); ?></td>
      <td><?php echo $losskg; ?></td>
      <td><?php echo $prsnLoss; ?></td>
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