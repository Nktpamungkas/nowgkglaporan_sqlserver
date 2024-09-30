<?php
$Project	= isset($_POST['projectcode']) ? $_POST['projectcode'] : '';
$HangerNO	= isset($_POST['hangerno']) ? $_POST['hangerno'] : '';
$subC1		= substr($HangerNO,0,3);
$subC2		= substr($HangerNO,3,5);
$subC3		= substr($HangerNO,9,3);

$sqlDB2 =" SELECT SUBCODE02,SUBCODE03,SUBCODE04, SUM(BASEPRIMARYQUANTITY) AS BASEPRIMARYQUANTITY, CURRENT_TIMESTAMP AS TGLS FROM ITXVIEWKNTORDER 
WHERE ITEMTYPEAFICODE ='KGF' AND PROJECTCODE ='$Project' AND (PROGRESSSTATUS='2' OR PROGRESSSTATUS='6')
GROUP BY SUBCODE02,SUBCODE03,SUBCODE04,CURRENT_TIMESTAMP ";	
$stmt   = db2_exec($conn1,$sqlDB2, array('cursor'=>DB2_SCROLLABLE));
$sqlDB210 =" SELECT SUM(BASEPRIMARYQUANTITY) AS QTY FROM ITXVIEWKNTORDER WHERE ITEMTYPEAFICODE ='KGF' AND PROJECTCODE ='$Project' AND
SUBCODE02='$subC1' AND SUBCODE03='$subC2' AND SUBCODE04='$subC3' AND (PROGRESSSTATUS='2' OR PROGRESSSTATUS='6')  ";	
$stmt10   = db2_exec($conn1,$sqlDB210, array('cursor'=>DB2_SCROLLABLE));
$rowdb210 = db2_fetch_assoc($stmt10);
?>
<!-- Main content -->
      <div class="container-fluid">
		<form role="form" method="post" enctype="multipart/form-data" name="form1">  
		<div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Filter Pergerakan Kain Greige</h3>

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
               <label for="projectcode" class="col-md-1">ProjectCode</label>
               <div class="col-md-2">  
                 <input type="text" class="form-control form-control-sm" value="<?php echo $Project; ?>" name="projectcode" required>
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
			  <div class="form-group row">
               <label for="qtyorder" class="col-md-1">Permintaan Rajut</label>
               <div class="col-md-1">  
                 <input type="text" class="form-control form-control-sm" value="<?php echo number_format(round($rowdb210['QTY'],2),2); ?>" name="qtyorder" style="text-align: right" required>
			   </div>
			  <strong> Kgs</strong>	  
            </div>
			  <button class="btn btn-info" type="submit" >Cari Data</button>
          </div>		  
		  <!-- /.card-body -->          
        </div>  
		 <div class="row">
          <div class="col-md-6">	
		<div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Detail Data Kain Greige Masuk</h3>				 
          </div>
              <!-- /.card-header -->              		
					<div class="card-body">
					<table id="example1" class="table table-sm table-bordered table-striped" style="font-size: 13px; text-align: center;">
                  <thead>
                  <tr>
                    <th valign="middle" style="text-align: center">Masuk</th>
                    <th valign="middle" style="text-align: center">&nbsp;</th>
                    <th valign="middle" style="text-align: center">&nbsp;</th>
                    <th valign="middle" style="text-align: center">&nbsp;</th>
                    <th valign="middle" style="text-align: center">&nbsp;</th>
                    <th valign="middle" style="text-align: center">&nbsp;</th>
                    <th valign="middle" style="text-align: center">&nbsp;</th>
                    <th valign="middle" style="text-align: center">&nbsp;</th>
                    <th valign="middle" style="text-align: center">&nbsp;</th>
                    <th valign="middle" style="text-align: center">&nbsp;</th>
                    </tr>
                  <tr>
                    <th valign="middle" style="text-align: center">No</th>
                    <th valign="middle" style="text-align: center">Tanggal</th>
                    <th valign="middle" style="text-align: center">No BON</th>
                    <th valign="middle" style="text-align: center">Prod. Order</th>
                    <th valign="middle" style="text-align: center">Code</th>
                    <th valign="middle" style="text-align: center">Jenis Benang</th>
                    <th valign="middle" style="text-align: center">Demand</th>
                    <th valign="middle" style="text-align: center">Hasil Inspek</th>
                    <th valign="middle" style="text-align: center">Roll</th>
                    <th valign="middle" style="text-align: center">Berat/Kg</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php
	 
$no=1;   
$c=0;
					  
	$sqlDB21 = " SELECT STOCKTRANSACTION.TRANSACTIONDATE,STOCKTRANSACTION.PROJECTCODE,
	ITXVIEWLAPMASUKGREIGE.SUBCODE02,ITXVIEWLAPMASUKGREIGE.SUBCODE03,ITXVIEWLAPMASUKGREIGE.SUBCODE04,
	   ITXVIEWLAPMASUKGREIGE.ORDERLINE,ITXVIEWLAPMASUKGREIGE.EXTERNALREFERENCE,ITXVIEWLAPMASUKGREIGE.INTERNALREFERENCE,
       ITXVIEWLAPMASUKGREIGE.ITEMDESCRIPTION,ITXVIEWLAPMASUKGREIGE.LOTCODE,
       ITXVIEWLAPMASUKGREIGE.USERPRIMARYUOMCODE,
	   ITXVIEWLAPMASUKGREIGE.PROVISIONALCOUNTERCODE,
       ITXVIEWLAPMASUKGREIGE.WHSLOCATIONWAREHOUSEZONECODE,
       ITXVIEWLAPMASUKGREIGE.WAREHOUSELOCATIONCODE,ITXVIEWLAPMASUKGREIGE.DESTINATIONWAREHOUSECODE,
       ITXVIEWLAPMASUKGREIGE.SUMMARIZEDDESCRIPTION,
       ITXVIEWLAPMASUKGREIGE.PROVISIONALCODE,SUM(STOCKTRANSACTION.WEIGHTNET) AS QTY_KG,COUNT(STOCKTRANSACTION.WEIGHTNET) AS QTY_ROL  
       FROM DB2ADMIN.STOCKTRANSACTION STOCKTRANSACTION LEFT OUTER JOIN
DB2ADMIN.ITXVIEWLAPMASUKGREIGE ITXVIEWLAPMASUKGREIGE ON ITXVIEWLAPMASUKGREIGE.PROVISIONALCODE  = STOCKTRANSACTION.ORDERCODE
AND ITXVIEWLAPMASUKGREIGE.ORDERLINE  = STOCKTRANSACTION.ORDERLINE
AND ITXVIEWLAPMASUKGREIGE.PROVISIONALCOUNTERCODE  = STOCKTRANSACTION.ORDERCOUNTERCODE  
AND ITXVIEWLAPMASUKGREIGE.ITEMTYPEAFICODE = STOCKTRANSACTION.ITEMTYPECODE 
AND ITXVIEWLAPMASUKGREIGE.SUBCODE01= STOCKTRANSACTION.DECOSUBCODE01
AND ITXVIEWLAPMASUKGREIGE.SUBCODE02= STOCKTRANSACTION.DECOSUBCODE02
AND ITXVIEWLAPMASUKGREIGE.SUBCODE03= STOCKTRANSACTION.DECOSUBCODE03
AND ITXVIEWLAPMASUKGREIGE.SUBCODE04= STOCKTRANSACTION.DECOSUBCODE04 
WHERE STOCKTRANSACTION.PROJECTCODE='$Project' AND DECOSUBCODE02='$subC1' AND DECOSUBCODE03='$subC2' AND DECOSUBCODE04='$subC3' and 
STOCKTRANSACTION.LOGICALWAREHOUSECODE ='M021' 
AND NOT ITXVIEWLAPMASUKGREIGE.ORDERLINE IS NULL
GROUP BY ITXVIEWLAPMASUKGREIGE.PROVISIONALCODE,
ITXVIEWLAPMASUKGREIGE.SUMMARIZEDDESCRIPTION,ITXVIEWLAPMASUKGREIGE.DESTINATIONWAREHOUSECODE,
ITXVIEWLAPMASUKGREIGE.USERPRIMARYUOMCODE,STOCKTRANSACTION.PROJECTCODE,
       ITXVIEWLAPMASUKGREIGE.WHSLOCATIONWAREHOUSEZONECODE,ITXVIEWLAPMASUKGREIGE.PROVISIONALCOUNTERCODE,
       ITXVIEWLAPMASUKGREIGE.WAREHOUSELOCATIONCODE,ITXVIEWLAPMASUKGREIGE.ORDERLINE,ITXVIEWLAPMASUKGREIGE.EXTERNALREFERENCE,ITXVIEWLAPMASUKGREIGE.INTERNALREFERENCE,
       ITXVIEWLAPMASUKGREIGE.ITEMDESCRIPTION,ITXVIEWLAPMASUKGREIGE.LOTCODE,STOCKTRANSACTION.TRANSACTIONDATE,ITXVIEWLAPMASUKGREIGE.SUBCODE02,
       ITXVIEWLAPMASUKGREIGE.SUBCODE03,ITXVIEWLAPMASUKGREIGE.SUBCODE04";
	$stmt1   = db2_exec($conn1,$sqlDB21, array('cursor'=>DB2_SCROLLABLE));
	//}				  
    while($rowdb21 = db2_fetch_assoc($stmt1)){ 
$bon=trim($rowdb21['PROVISIONALCODE'])."-".trim($rowdb21['ORDERLINE']);
$itemc=trim($rowdb21['SUBCODE02'])."".trim($rowdb21['SUBCODE03'])." ".trim($rowdb21['SUBCODE04']);		
if (trim($rowdb21['PROVISIONALCOUNTERCODE']) =='I02M50') { $knitt = 'KNITTING ITTI- GREIGE'; } 
		$sqlDB22 = "SELECT COUNT(BALANCE.BASEPRIMARYQUANTITYUNIT) AS ROL,SUM(BALANCE.BASEPRIMARYQUANTITYUNIT) AS BERAT,BALANCE.LOTCODE  
		FROM DB2ADMIN.STOCKTRANSACTION STOCKTRANSACTION RIGHT OUTER JOIN 
		DB2ADMIN.BALANCE  BALANCE ON BALANCE.ELEMENTSCODE =STOCKTRANSACTION.ITEMELEMENTCODE  
		WHERE STOCKTRANSACTION.LOGICALWAREHOUSECODE='M021' AND STOCKTRANSACTION.ORDERCODE='$rowdb21[PROVISIONALCODE]'
		AND STOCKTRANSACTION.ORDERLINE ='$rowdb21[ORDERLINE]' 
		GROUP BY BALANCE.LOTCODE ";					  
		$stmt2   = db2_exec($conn1,$sqlDB22, array('cursor'=>DB2_SCROLLABLE));	
		$rowdb22 = db2_fetch_assoc($stmt2);
?>
	  <tr>
	  <td style="text-align: center"><?php echo $no;?></td>
	  <td style="text-align: center"><?php echo $rowdb21['TRANSACTIONDATE']; ?></td>
      <td style="text-align: center"><?php echo $bon; ?></td>
      <td style="text-align: center"><?php echo $rowdb21['EXTERNALREFERENCE']; ?></td>
      <td><?php echo $itemc;?></td> 
      <td style="text-align: left"><?php echo $rowdb21['SUMMARIZEDDESCRIPTION']; ?></td>
      <td style="text-align: center"><?php echo $rowdb21['LOTCODE']; ?></td>
      <td style="text-align: right"><?php echo $rowdb21['INTERNALREFERENCE']; ?></td>
      <td style="text-align: right"><?php echo $rowdb21['QTY_ROL']; ?></td>
      <td style="text-align: right"><?php echo number_format(round($rowdb21['QTY_KG'],2),2); ?></td>
      </tr>
	  				  
	<?php 
	 $no++; 
	$tMRol+=$rowdb21['QTY_ROL'];
	$tMKG +=$rowdb21['QTY_KG'];		
	} ?>
				  </tbody>
                  <tfoot>
		<tr>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td>&nbsp;</td>
	    <td style="text-align: left">&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: right"><span style="text-align: center"><strong>Total</strong></span></td>
	    <td style="text-align: right"><strong><?php echo $tMRol;?></strong></td>
	    <td style="text-align: right"><strong><?php echo number_format(round($tMKG,2),2);?></strong></td>
	    </tr>			
		</tfoot>
                </table>					
					</div> 
              <!-- /.card-body -->
            </div>
		 </div>
		 <div class="col-md-3">	
		<div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Detail Data Kain Greige Change Project</h3>				 
          </div>
              <!-- /.card-header -->              		
					<div class="card-body">
					<table id="example3" class="table table-sm table-bordered table-striped" style="font-size: 13px; text-align: center;">
                  <thead>
                  <tr>
                    <th colspan="5" valign="middle" style="text-align: center">Change Project</th>
                    </tr>
                  <tr>
                    <th valign="middle" style="text-align: center">Tanggal</th>
                    <th valign="middle" style="text-align: center">Bon Masuk</th>
                    <th valign="middle" style="text-align: center">Project</th>
                    <th valign="middle" style="text-align: center">Roll</th>
                    <th valign="middle" style="text-align: center">Berat/Kg</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php
	 
$no=1;   
$c=0;
					  
	$sqlDB23 = " SELECT STOCKOUT.TRANSACTIONDATE,
	STOCKOUT.PROJECTCODE,
	STOCKOUT.ORDERCODE,STOCKOUT.PROVISIONALCODE,STOCKOUT.ORDERLINE,
	COUNT(STOCKOUT.ITEMELEMENTCODE) AS QTY_ROL,
	SUM(STOCKOUT.BASEPRIMARYQUANTITY) AS QTY_KG FROM
(SELECT DISTINCT STKKELUAR.ITEMELEMENTCODE,STKKELUAR.BASEPRIMARYQUANTITY,  
       STKKELUAR.TRANSACTIONDATE,STKKELUAR.ORDERCODE, STKKELUAR.PROJECTCODE,
	   ITXVIEWLAPMASUKGREIGE.PROVISIONALCODE,ITXVIEWLAPMASUKGREIGE.ORDERLINE
       FROM DB2ADMIN.STOCKTRANSACTION STOCKTRANSACTION LEFT OUTER JOIN
DB2ADMIN.ITXVIEWLAPMASUKGREIGE ITXVIEWLAPMASUKGREIGE ON ITXVIEWLAPMASUKGREIGE.PROVISIONALCODE  = STOCKTRANSACTION.ORDERCODE
AND ITXVIEWLAPMASUKGREIGE.ORDERLINE  = STOCKTRANSACTION.ORDERLINE
AND ITXVIEWLAPMASUKGREIGE.PROVISIONALCOUNTERCODE  = STOCKTRANSACTION.ORDERCOUNTERCODE  
AND ITXVIEWLAPMASUKGREIGE.ITEMTYPEAFICODE = STOCKTRANSACTION.ITEMTYPECODE 
AND ITXVIEWLAPMASUKGREIGE.SUBCODE01= STOCKTRANSACTION.DECOSUBCODE01
AND ITXVIEWLAPMASUKGREIGE.SUBCODE02= STOCKTRANSACTION.DECOSUBCODE02
AND ITXVIEWLAPMASUKGREIGE.SUBCODE03= STOCKTRANSACTION.DECOSUBCODE03
AND ITXVIEWLAPMASUKGREIGE.SUBCODE04= STOCKTRANSACTION.DECOSUBCODE04
INNER JOIN (SELECT
	STOCKTRANSACTION.TRANSACTIONDATE,
	STOCKTRANSACTION.ORDERCODE,
	STOCKTRANSACTION.PROJECTCODE,
	STOCKTRANSACTION.BASEPRIMARYQUANTITY,
	STOCKTRANSACTION.ITEMELEMENTCODE 
FROM STOCKTRANSACTION 
WHERE STOCKTRANSACTION.ITEMTYPECODE ='KGF'  AND STOCKTRANSACTION.LOGICALWAREHOUSECODE ='M021' 
AND TEMPLATECODE ='312') AS STKKELUAR ON STKKELUAR.ITEMELEMENTCODE=STOCKTRANSACTION.ITEMELEMENTCODE
WHERE STOCKTRANSACTION.PROJECTCODE='$Project' AND DECOSUBCODE02='$subC1' AND DECOSUBCODE03='$subC2' AND DECOSUBCODE04='$subC3' and 
STOCKTRANSACTION.LOGICALWAREHOUSECODE ='M021' 
AND NOT ITXVIEWLAPMASUKGREIGE.ORDERLINE IS NULL) AS STOCKOUT
GROUP BY STOCKOUT.TRANSACTIONDATE,STOCKOUT.PROJECTCODE,STOCKOUT.ORDERCODE,
STOCKOUT.PROVISIONALCODE,STOCKOUT.ORDERLINE";
	$stmt3   = db2_exec($conn1,$sqlDB23, array('cursor'=>DB2_SCROLLABLE));			  
    while($rowdb23 = db2_fetch_assoc($stmt3)){ 
		$bonMCG=trim($rowdb23['PROVISIONALCODE'])."-".trim($rowdb23['ORDERLINE']);
?>
	  <tr>
	  <td style="text-align: center"><?php echo $rowdb23['TRANSACTIONDATE']; ?></td>
      <td style="text-align: center"><span style="text-align: right"><?php echo $bonMCG; ?></span></td>
      <td style="text-align: center"><?php echo $rowdb23['PROJECTCODE']; ?></td>
      <td style="text-align: right"><?php echo $rowdb23['QTY_ROL']; ?></td>
      <td style="text-align: right"><?php echo number_format(round($rowdb23['QTY_KG'],2),2); ?></td>
      </tr>
	  				  
	<?php 
	 $no++; 
	$tCGRol3+=$rowdb23['QTY_ROL'];
	$tCGKG3 +=$rowdb23['QTY_KG'];	
	} ?>
				  </tbody>
                  <tfoot> 
		<tr>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: center"><span style="text-align: right"><strong>Total</strong></span></td>
	    <td style="text-align: right"><strong><?php echo $tCGRol3;?></strong></td>
	    <td style="text-align: right"><strong><?php echo number_format(round($tCGKG3,2),2);?></strong></td>
	    </tr>			
		</tfoot>
                </table>					
					</div> 
              <!-- /.card-body -->
            </div>
		 </div>	 
		 <div class="col-md-3">	
		<div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Detail Data Kain Greige Keluar</h3>				 
          </div>
              <!-- /.card-header -->              		
					<div class="card-body">
					<table id="example4" class="table table-sm table-bordered table-striped" style="font-size: 13px; text-align: center;">
                  <thead>
                  <tr>
                    <th colspan="6" valign="middle" style="text-align: center">Keluar</th>
                    </tr>
                  <tr>
                    <th valign="middle" style="text-align: center">Tanggal</th>
                    <th valign="middle" style="text-align: center">Prod. Order</th>
                    <th valign="middle" style="text-align: center">Project</th>
                    <th valign="middle" style="text-align: center">Roll</th>
                    <th valign="middle" style="text-align: center">Berat/Kg</th>
                    <th valign="middle" style="text-align: center">Bon Masuk</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php
	 
$no=1;   
$c=0;
					  
	$sqlDB23 = " SELECT STOCKOUT.TRANSACTIONDATE,
	STOCKOUT.PROJECTCODE,
	STOCKOUT.ORDERCODE,STOCKOUT.PROVISIONALCODE,STOCKOUT.ORDERLINE,
	COUNT(STOCKOUT.ITEMELEMENTCODE) AS QTY_ROL,
	SUM(STOCKOUT.BASEPRIMARYQUANTITY) AS QTY_KG FROM
(SELECT DISTINCT STKKELUAR.ITEMELEMENTCODE,STKKELUAR.BASEPRIMARYQUANTITY,  
       STKKELUAR.TRANSACTIONDATE,STKKELUAR.ORDERCODE, STKKELUAR.PROJECTCODE,
	   ITXVIEWLAPMASUKGREIGE.PROVISIONALCODE,ITXVIEWLAPMASUKGREIGE.ORDERLINE
       FROM DB2ADMIN.STOCKTRANSACTION STOCKTRANSACTION LEFT OUTER JOIN
DB2ADMIN.ITXVIEWLAPMASUKGREIGE ITXVIEWLAPMASUKGREIGE ON ITXVIEWLAPMASUKGREIGE.PROVISIONALCODE  = STOCKTRANSACTION.ORDERCODE
AND ITXVIEWLAPMASUKGREIGE.ORDERLINE  = STOCKTRANSACTION.ORDERLINE
AND ITXVIEWLAPMASUKGREIGE.PROVISIONALCOUNTERCODE  = STOCKTRANSACTION.ORDERCOUNTERCODE  
AND ITXVIEWLAPMASUKGREIGE.ITEMTYPEAFICODE = STOCKTRANSACTION.ITEMTYPECODE 
AND ITXVIEWLAPMASUKGREIGE.SUBCODE01= STOCKTRANSACTION.DECOSUBCODE01
AND ITXVIEWLAPMASUKGREIGE.SUBCODE02= STOCKTRANSACTION.DECOSUBCODE02
AND ITXVIEWLAPMASUKGREIGE.SUBCODE03= STOCKTRANSACTION.DECOSUBCODE03
AND ITXVIEWLAPMASUKGREIGE.SUBCODE04= STOCKTRANSACTION.DECOSUBCODE04
INNER JOIN (SELECT
	STOCKTRANSACTION.TRANSACTIONDATE,
	STOCKTRANSACTION.ORDERCODE,
	STOCKTRANSACTION.PROJECTCODE,
	STOCKTRANSACTION.BASEPRIMARYQUANTITY,
	STOCKTRANSACTION.ITEMELEMENTCODE 
FROM STOCKTRANSACTION 
WHERE STOCKTRANSACTION.ITEMTYPECODE ='KGF'  and STOCKTRANSACTION.LOGICALWAREHOUSECODE ='M021' AND
STOCKTRANSACTION.ONHANDUPDATE > 1  AND NOT ORDERCODE IS NULL) AS STKKELUAR ON STKKELUAR.ITEMELEMENTCODE=STOCKTRANSACTION.ITEMELEMENTCODE
WHERE STOCKTRANSACTION.PROJECTCODE='$Project' AND DECOSUBCODE02='$subC1' AND DECOSUBCODE03='$subC2' AND DECOSUBCODE04='$subC3' and 
STOCKTRANSACTION.LOGICALWAREHOUSECODE ='M021' 
AND NOT ITXVIEWLAPMASUKGREIGE.ORDERLINE IS NULL) AS STOCKOUT
GROUP BY STOCKOUT.TRANSACTIONDATE,STOCKOUT.PROJECTCODE,STOCKOUT.ORDERCODE,
STOCKOUT.PROVISIONALCODE,STOCKOUT.ORDERLINE";
	$stmt3   = db2_exec($conn1,$sqlDB23, array('cursor'=>DB2_SCROLLABLE));			  
    while($rowdb23 = db2_fetch_assoc($stmt3)){ 
		$bonM=trim($rowdb23['PROVISIONALCODE'])."-".trim($rowdb23['ORDERLINE']);
?>
	  <tr>
	  <td style="text-align: center"><?php echo $rowdb23['TRANSACTIONDATE']; ?></td>
      <td style="text-align: center"><?php echo $rowdb23['ORDERCODE']; ?></td>
      <td style="text-align: center"><?php echo $rowdb23['PROJECTCODE']; ?></td>
      <td style="text-align: right"><?php echo $rowdb23['QTY_ROL']; ?></td>
      <td style="text-align: right"><?php echo number_format(round($rowdb23['QTY_KG'],2),2); ?></td>
      <td style="text-align: right"><?php echo $bonM; ?></td>
      </tr>
	  				  
	<?php 
	 $no++; 
	$tKRol3+=$rowdb23['QTY_ROL'];
	$tKKG3 +=$rowdb23['QTY_KG'];	
	} ?>
				  </tbody>
                  <tfoot> 
		<tr>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: center"><span style="text-align: right"><strong>Total</strong></span></td>
	    <td style="text-align: right"><strong><?php echo $tKRol3;?></strong></td>
	    <td style="text-align: right"><strong><?php echo number_format(round($tKKG3,2),2);?></strong></td>
	    <td style="text-align: right">&nbsp;</td>
	    </tr>			
		</tfoot>
                </table>					
					</div> 
              <!-- /.card-body -->
            </div>
		 </div>	 
		</div> 	 
	</form>		
      </div><!-- /.container-fluid -->
    <!-- /.content -->
<div id="DetailShow" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>	
<div id="DetailPergerakanShow" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">	
</div>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- SweetAlert2 -->
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="plugins/toastr/toastr.min.js"></script>	
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

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
<script type="text/javascript">
function checkAll(form1){
    for (var i=0;i<document.forms['form1'].elements.length;i++)
    {
        var e=document.forms['form1'].elements[i];
        if ((e.name !='allbox') && (e.type=='checkbox'))
        {
            e.checked=document.forms['form1'].allbox.checked;
			
        }
    }
}
</script>
<?php 
if($_POST['mutasikain']=="MutasiKain"){
	
function mutasiurut(){
include "koneksi.php";		
$format = "20".date("ymd");
$sql=mysqli_query($con,"SELECT no_mutasi FROM tbl_mutasi_kain WHERE substr(no_mutasi,1,8) like '%".$format."%' ORDER BY no_mutasi DESC LIMIT 1 ") or die (mysql_error());
$d=mysqli_num_rows($sql);
if($d>0){
$r=mysqli_fetch_array($sql);
$d=$r['no_mutasi'];
$str=substr($d,8,2);
$Urut = (int)$str;
}else{
$Urut = 0;
}
$Urut = $Urut + 1;
$Nol="";
$nilai=2-strlen($Urut);
for ($i=1;$i<=$nilai;$i++){
$Nol= $Nol."0";
}
$tidbr =$format.$Nol.$Urut;
return $tidbr;
}
$nomid=mutasiurut();	

$sql1=mysqli_query($con,"SELECT *,count(b.transid) as jmlrol,a.transid as kdtrans FROM tbl_mutasi_kain a 
LEFT JOIN tbl_prodemand b ON a.transid=b.transid 
WHERE isnull(a.no_mutasi) AND date_format(a.tgl_buat ,'%Y-%m-%d')='$Awal' AND a.gshift='$Gshift' 
GROUP BY a.transid");
$n1=1;
$noceklist1=1;	
while($r1=mysqli_fetch_array($sql1)){	
	if($_POST['cek'][$n1]!='') 
		{
		$transid1 = $_POST['cek'][$n1];
		mysqli_query($con,"UPDATE tbl_mutasi_kain SET
		no_mutasi='$nomid',
		tgl_mutasi=now()
		WHERE transid='$transid1'
		");
		}else{
			$noceklist1++;
	}
	$n1++;
	}
if($noceklist1==$n1){
	echo "<script>
  	$(function() {
    const Toast = Swal.mixin({
      toast: false,
      position: 'middle',
      showConfirmButton: false,
      timer: 2000
    });
	Toast.fire({
        icon: 'info',
        title: 'Data tidak ada yang di Ceklist',
		
      })
  });
  
</script>";	
}else{	
echo "<script>
	$(function() {
    const Toast = Swal.mixin({
      toast: false,
      position: 'middle',
      showConfirmButton: true,
      timer: 6000
    });
	Toast.fire({
  title: 'Data telah di Mutasi',
  text: 'klik OK untuk Cetak Bukti Mutasi',
  icon: 'success',  
}).then((result) => {
  if (result.isConfirmed) {
    	window.open('pages/cetak/cetak_mutasi_ulang.php?mutasi=$nomid', '_blank');
  }
})
  });
	</script>";
	
/*echo "<script>
	Swal.fire({
  title: 'Data telah di Mutasi',
  text: 'klik OK untuk Cetak Bukti Mutasi',
  icon: 'success',  
}).then((result) => {
  if (result.isConfirmed) {
    	window.location='Mutasi';
  }
});
	</script>";	*/
}
}
?>