<?php
$Project	= isset($_POST['projectcode']) ? $_POST['projectcode'] : '';
$HangerNO	= isset($_POST['hangerno']) ? $_POST['hangerno'] : '';
$subC1		= substr($HangerNO,0,3);
$subC2		= substr($HangerNO,3,5);
$subC3		= substr($HangerNO,9,3);

$sqlDB2 =" SELECT *,CURRENT_TIMESTAMP AS TGLS FROM ITXVIEWKNTORDER WHERE ITEMTYPEAFICODE ='KGF' AND PROJECTCODE ='$Project' AND (PROGRESSSTATUS='2' OR PROGRESSSTATUS='6')  ";	
$stmt   = db2_exec($conn1,$sqlDB2, array('cursor'=>DB2_SCROLLABLE));
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
               <label for="projectcode" class="col-md-1">Project</label>
               <div class="col-md-2"> 
                    <input name="projectcode" value="<?php echo $Project;?>" type="text" class="form-control form-control-sm" id=""  autocomplete="off" required>
			   </div>	
            </div>
				 <div class="form-group row">
                    <label for="hangerno" class="col-md-1">No. Hanger</label>
					<div class="col-md-2"> 
                    <select name="hangerno" class="form-control form-control-sm"  autocomplete="off">
						<option value="">Pilih</option>
						<?php while($rowdb2 = db2_fetch_assoc($stmt)){?>
						<option value="<?php echo trim($rowdb2['SUBCODE02']).trim($rowdb2['SUBCODE03'])." ".trim($rowdb2['SUBCODE04']);?>" <?php if($HangerNO==trim($rowdb2['SUBCODE02']).trim($rowdb2['SUBCODE03'])." ".trim($rowdb2['SUBCODE04'])){ echo "SELECTED";}?>><?php echo trim($rowdb2['SUBCODE02']).trim($rowdb2['SUBCODE03'])." ".trim($rowdb2['SUBCODE04']);?></option>
						<?php } ?>
					</select>	
                  </div>	
                  </div>
			  <button class="btn btn-primary" type="submit">Cari Data</button>
          </div>		  
		  <!-- /.card-body -->          
        </div>  
		</form>	
          <?php
		  $sqlDB21 =" SELECT *,CURRENT_TIMESTAMP AS TGLS FROM ITXVIEWKNTORDER WHERE ITEMTYPEAFICODE ='KGF' AND PROJECTCODE ='$Project' AND SUBCODE02='$subC1' AND SUBCODE03='$subC2' AND SUBCODE04='$subC3' AND (PROGRESSSTATUS='2' OR PROGRESSSTATUS='6') ";	
		  $stmt1   = db2_exec($conn1,$sqlDB21, array('cursor'=>DB2_SCROLLABLE));
		  $rowdb21 = db2_fetch_assoc($stmt1);
		  
		  $sqlDB2R =" SELECT COUNT(WEIGHTREALNET ) AS JML, SUM(WEIGHTREALNET ) AS JQTY FROM 
		  ELEMENTSINSPECTION WHERE DEMANDCODE ='$rowdb21[PRODUCTIONDEMANDCODE]' AND ELEMENTITEMTYPECODE='KGF'";	
		  $stmtR   = db2_exec($conn1,$sqlDB2R, array('cursor'=>DB2_SCROLLABLE));
		  $rowdb2R = db2_fetch_assoc($stmtR);
		  $kRajut  = round($rowdb21['BASEPRIMARYQUANTITY'],2)-round($rowdb2R['JQTY'],2);
		  ?>
		<div class="card">
              <div class="card-header">
                <h3 class="card-title">Analisa Kebutuhan Benang</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
			  Qty Order:  <strong><?php echo round($rowdb21['BASEPRIMARYQUANTITY'],2)." Kgs";?></strong><br>
			  Kurang Rajut: <strong><font color="<?php if($kRajut < 1){ echo "RED"; }?>"><?php echo round($kRajut,2)." Kgs"; ?></font></strong><br>
<table id="example1" class="table table-sm table-bordered table-striped" style="font-size:13px;">
        <thead>
                  <tr>
                    <th rowspan="2" style="text-align: center; vertical-align: middle">No</th>
                    <th rowspan="2" style="text-align: center; vertical-align: middle">Jenis Benang</th>
                    <th rowspan="2" style="text-align: center; vertical-align: middle">%</th>
                    <th rowspan="2" style="text-align: center; vertical-align: middle">Kebutuhan Benang</th>
                    <th rowspan="2" style="text-align: center; vertical-align: middle">Permohonan</th>
                    <th rowspan="2" style="text-align: center; vertical-align: middle">Shipped</th>
                    <th rowspan="2" style="text-align: center; vertical-align: middle">Received</th>
                    <th colspan="2" style="text-align: center; vertical-align: middle">Stock/Project</th>
                    <th colspan="3" style="text-align: center; vertical-align: middle">Total Stock</th>
          </tr>
                  <tr>
                    <th style="text-align: center">P501</th>
                    <th style="text-align: center">M501</th>
                    <th style="text-align: center">P501</th>
                    <th style="text-align: center">M501</th>
                    <th style="text-align: center">M011</th>
          </tr>
        </thead>
                  <tbody>
				  <?php
$sqlDB22 =" SELECT 
		PRODUCTIONRESERVATION.SUBCODE01,
		PRODUCTIONRESERVATION.SUBCODE02,
		PRODUCTIONRESERVATION.SUBCODE03,
PRODUCTIONRESERVATION.SUBCODE04,PRODUCTIONRESERVATION.SUBCODE05,PRODUCTIONRESERVATION.SUBCODE06,PRODUCTIONRESERVATION.SUBCODE07,PRODUCTIONRESERVATION.SUBCODE08,
       BOMCOMPONENT.QUANTITYPER 
FROM DB2ADMIN.PRODUCTIONRESERVATION PRODUCTIONRESERVATION LEFT OUTER JOIN 
       DB2ADMIN.BOMCOMPONENT BOMCOMPONENT ON 
       PRODUCTIONRESERVATION.BOMCOMPSEQUENCE=BOMCOMPONENT.SEQUENCE AND 
       PRODUCTIONRESERVATION.BOMCOMPBILLOFMATERIALNUMBERID=BOMCOMPONENT.BILLOFMATERIALNUMBERID 
	   WHERE BOMCOMPONENT.BILLOFMATERIALITEMTYPECODE='KGF' 
	   AND BOMCOMPONENT.BILLOFMATERIALSUBCODE02='$subC1' 
	   AND BOMCOMPONENT.BILLOFMATERIALSUBCODE03 ='$subC2'
	   AND BOMCOMPONENT.BILLOFMATERIALSUBCODE04 ='$subC3'
	   AND PRODUCTIONRESERVATION.ORDERCODE ='$rowdb21[CODE]'
	   ";	
$stmt2   = db2_exec($conn1,$sqlDB22, array('cursor'=>DB2_SCROLLABLE));
					  
$no=1; 
$c=0;
 while ($rowdb22 = db2_fetch_assoc($stmt2)) {	
	 $kdbenang=trim($rowdb22['SUBCODE01'])." ".trim($rowdb22['SUBCODE02']).trim($rowdb22['SUBCODE03'])." ".trim($rowdb22['SUBCODE04'])." ".trim($rowdb22['SUBCODE05'])." ".trim($rowdb22['SUBCODE06'])." ".trim($rowdb22['SUBCODE07'])." ".trim($rowdb22['SUBCODE08']);
	 $persen=number_format($rowdb22['QUANTITYPER']*100,2);
	 $kbhBenang=round((round($rowdb21['BASEPRIMARYQUANTITY'],2)*($persen+1))/100,2);
$sqlDB23 =" SELECT il.* FROM INTERNALDOCUMENT i LEFT JOIN
INTERNALDOCUMENTLINE il ON i.PROVISIONALCODE=il.INTDOCUMENTPROVISIONALCODE AND i.PROVISIONALCOUNTERCODE=il.INTDOCPROVISIONALCOUNTERCODE  
WHERE i.EXTERNALREFERENCE ='$Project' AND
i.INTERNALREFERENCE ='$HangerNO' AND
il.SUBCODE01='$rowdb22[SUBCODE01]' AND
il.SUBCODE02='$rowdb22[SUBCODE02]' AND
il.SUBCODE03='$rowdb22[SUBCODE03]' AND
il.SUBCODE04='$rowdb22[SUBCODE04]' AND
il.SUBCODE05='$rowdb22[SUBCODE05]' AND
il.SUBCODE06='$rowdb22[SUBCODE06]' AND
il.SUBCODE07='$rowdb22[SUBCODE07]' AND
il.SUBCODE08='$rowdb22[SUBCODE08]'
";	
$stmt3   = db2_exec($conn1,$sqlDB23, array('cursor'=>DB2_SCROLLABLE));
$rowdb23 = db2_fetch_assoc($stmt3);	

$sqlDB2P501 =" SELECT sum(b.BASEPRIMARYQUANTITYUNIT) AS QTYSTK  FROM STOCKTRANSACTION s LEFT JOIN
BALANCE b ON s.ITEMELEMENTCODE =b.ELEMENTSCODE 
WHERE s.ORDERCOUNTERCODE ='$rowdb23[INTDOCPROVISIONALCOUNTERCODE]' AND 
s.ORDERCODE ='$rowdb23[INTDOCUMENTPROVISIONALCODE]' AND 
s.TOKENCODE ='RECEIVED' AND
b.LOGICALWAREHOUSECODE ='P501' AND
b.DECOSUBCODE01='$rowdb22[SUBCODE01]' AND
b.DECOSUBCODE02='$rowdb22[SUBCODE02]' AND
b.DECOSUBCODE03='$rowdb22[SUBCODE03]' AND
b.DECOSUBCODE04='$rowdb22[SUBCODE04]' AND
b.DECOSUBCODE05='$rowdb22[SUBCODE05]' AND
b.DECOSUBCODE06='$rowdb22[SUBCODE06]' AND
b.DECOSUBCODE07='$rowdb22[SUBCODE07]' AND
b.DECOSUBCODE08='$rowdb22[SUBCODE08]'
";	
$stmtP501   = db2_exec($conn1,$sqlDB2P501, array('cursor'=>DB2_SCROLLABLE));
$rowdbP501 = db2_fetch_assoc($stmtP501);	
	 
$sqlDB2M501 =" SELECT sum(b.BASEPRIMARYQUANTITYUNIT) AS QTYSTK  FROM STOCKTRANSACTION s LEFT JOIN
BALANCE b ON s.ITEMELEMENTCODE =b.ELEMENTSCODE 
WHERE s.ORDERCOUNTERCODE ='$rowdb23[INTDOCPROVISIONALCOUNTERCODE]' AND 
s.ORDERCODE ='$rowdb23[INTDOCUMENTPROVISIONALCODE]' AND 
s.TOKENCODE ='RECEIVED' AND
b.LOGICALWAREHOUSECODE ='M501' AND
b.DECOSUBCODE01='$rowdb22[SUBCODE01]' AND
b.DECOSUBCODE02='$rowdb22[SUBCODE02]' AND
b.DECOSUBCODE03='$rowdb22[SUBCODE03]' AND
b.DECOSUBCODE04='$rowdb22[SUBCODE04]' AND
b.DECOSUBCODE05='$rowdb22[SUBCODE05]' AND
b.DECOSUBCODE06='$rowdb22[SUBCODE06]' AND
b.DECOSUBCODE07='$rowdb22[SUBCODE07]' AND
b.DECOSUBCODE08='$rowdb22[SUBCODE08]'
";	
$stmtM501   = db2_exec($conn1,$sqlDB2M501, array('cursor'=>DB2_SCROLLABLE));
$rowdbM501 = db2_fetch_assoc($stmtM501);	
	 
	 
$Sdb20="
	SELECT sum(BASEPRIMARYQUANTITYUNIT) AS TOTALSTK

FROM BALANCE WHERE ITEMTYPECODE ='GYR' AND LOGICALWAREHOUSECODE ='M011' AND
DECOSUBCODE01='$rowdb22[SUBCODE01]' AND
DECOSUBCODE02='$rowdb22[SUBCODE02]' AND
DECOSUBCODE03='$rowdb22[SUBCODE03]' AND
DECOSUBCODE04='$rowdb22[SUBCODE04]' AND
DECOSUBCODE05='$rowdb22[SUBCODE05]' AND
DECOSUBCODE06='$rowdb22[SUBCODE06]' AND
DECOSUBCODE07='$rowdb22[SUBCODE07]' AND
DECOSUBCODE08='$rowdb22[SUBCODE08]'

	";
	$st10   = db2_exec($conn1,$Sdb20, array('cursor'=>DB2_SCROLLABLE));
	$rdb20 = db2_fetch_assoc($st10);	 
$Sdb21="
	SELECT sum(BASEPRIMARYQUANTITYUNIT) AS TOTALSTK

FROM BALANCE WHERE ITEMTYPECODE ='GYR' AND LOGICALWAREHOUSECODE ='M501' AND
DECOSUBCODE01='$rowdb22[SUBCODE01]' AND
DECOSUBCODE02='$rowdb22[SUBCODE02]' AND
DECOSUBCODE03='$rowdb22[SUBCODE03]' AND
DECOSUBCODE04='$rowdb22[SUBCODE04]' AND
DECOSUBCODE05='$rowdb22[SUBCODE05]' AND
DECOSUBCODE06='$rowdb22[SUBCODE06]' AND
DECOSUBCODE07='$rowdb22[SUBCODE07]' AND
DECOSUBCODE08='$rowdb22[SUBCODE08]'
	";
	$st11   = db2_exec($conn1,$Sdb21, array('cursor'=>DB2_SCROLLABLE));
	$rdb21 = db2_fetch_assoc($st11);	 
$Sdb22="
	SELECT sum(BASEPRIMARYQUANTITYUNIT) AS TOTALSTK

FROM BALANCE WHERE ITEMTYPECODE ='GYR' AND LOGICALWAREHOUSECODE ='P501' AND
DECOSUBCODE01='$rowdb22[SUBCODE01]' AND
DECOSUBCODE02='$rowdb22[SUBCODE02]' AND
DECOSUBCODE03='$rowdb22[SUBCODE03]' AND
DECOSUBCODE04='$rowdb22[SUBCODE04]' AND
DECOSUBCODE05='$rowdb22[SUBCODE05]' AND
DECOSUBCODE06='$rowdb22[SUBCODE06]' AND
DECOSUBCODE07='$rowdb22[SUBCODE07]' AND
DECOSUBCODE08='$rowdb22[SUBCODE08]'
	";
	$st12   = db2_exec($conn1,$Sdb22, array('cursor'=>DB2_SCROLLABLE));
	$rdb22 = db2_fetch_assoc($st12);	 
	   ?>
	  <tr>
      <td style="text-align: center"><?php echo $no; ?></td>
      <td><?php echo $kdbenang; ?></td>
      <td style="text-align: right"><?php echo $persen; ?></td>
      <td style="text-align: right"><?php echo $kbhBenang; ?> Kgs</td>
      <td style="text-align: right"><?php echo number_format(round($rowdb23['BASEPRIMARYQUANTITY'],2),2); ?> Kgs</td>
      <td style="text-align: right"><?php echo number_format(round($rowdb23['SHIPPEDBASEPRIMARYQUANTITY'],2),2); ?> Kgs</td>
      <td style="text-align: right"><?php echo number_format(round($rowdb23['RECEIVEDBASEPRIMARYQUANTITY'],2),2); ?> Kgs</td>
      <td style="text-align: right"><?php echo number_format(round($rowdbP501['QTYSTK'],2),2); ?> Kgs</td>
      <td style="text-align: right"><?php echo number_format(round($rowdbM501['QTYSTK'],2),2); ?> Kgs</td>
      <td style="text-align: right"><?php echo number_format(round($rdb22['TOTALSTK'],2),2); ?> Kgs</td>
      <td style="text-align: right"><?php echo number_format(round($rdb21['TOTALSTK'],2),2); ?> Kgs</td>
      <td style="text-align: right"><?php echo number_format(round($rdb20['TOTALSTK'],2),2); ?> Kgs</td>
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