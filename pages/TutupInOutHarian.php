<?php

include "../utils/helper.php";

$Awal	= isset($_POST['tgl_awal']) ? $_POST['tgl_awal'] : '';
?>

<!-- Main content -->
      <div class="container-fluid">
		<form role="form" method="post" enctype="multipart/form-data" name="form1">  
		<div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Filter Tgl Tutup In-Out Kain Greige</h3>

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
			 <div class="alert alert-primary alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-info"></i> Note!</h5>
                  * Tutup Transaksi Membutuhkan Waktu, Harap Tunggu...<br>
** Jangan di Tutup Sebelum Selesai.<br> 
                *** Bisa tutup Mulai jam 21:00 sampai jam 24:00 
                </div> 
             <div class="form-group row">
               <label for="tgl_awal" class="col-md-1">Tgl Tutup</label>
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
			  
          </div>	
		  <div class="card-footer">
			<button class="btn btn-info" type="submit" name="submit">Submit</button>
		</div>	
		  <!-- /.card-body -->          
        </div>  
		<div class="row">
			<div class="col-md-6">	
		<div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Detail Data Masuk Kain Greige Perhari</h3>				 
          </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-sm table-bordered table-striped" style="font-size: 14px; text-align: center;">
                  <thead>
                  <tr>
                    <th valign="middle" style="text-align: center">No</th>
                    <th valign="middle" style="text-align: center">Detail</th>
                    <th valign="middle" style="text-align: center">Tgl Tutup</th>
                    <th valign="middle" style="text-align: center">Rol</th>
                    <th valign="middle" style="text-align: center">KG</th>
                    <th valign="middle" style="text-align: center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
<?php	 
$no=1;   
$c=0;				  
$sql = sqlsrv_query($con,"SELECT TOP 30 
										tgl_tutup, 
										SUM(qty) AS rol, 
										SUM(berat) AS kg, 
										FORMAT(GETDATE(), 'yyyy-MM-dd') AS tgl 
									FROM 
										dbnow_gkg.tblmasukkain 
									GROUP BY 
										tgl_tutup 
									ORDER BY 
										tgl_tutup DESC;");		  
    while($r = sqlsrv_fetch_array($sql)){	
?>
	  <tr>
	  <td style="text-align: center"><?php echo $no;?></td>
	  <td style="text-align: center"><a href="DetailInHarian-<?php echo cek($r['tgl_tutup']);?>" class="btn btn-info btn-xs" target="_blank"> <i class="fa fa-link"></i> Lihat Data</a></td>
	  <td style="text-align: center"><?php echo cek($r['tgl_tutup']);?></td>
      <td style="text-align: center"><?php echo $r['rol'];?></td>
      <td style="text-align: right"><?php echo number_format(round($r['kg'],2),2);?></td>
      <td style="text-align: center"><a href="#" class="btn btn-xs btn-danger <?php if(cek($r['tgl'])==cek($r['tgl_tutup'])){ }else{/*echo"disabled";*/} ?>" onclick="confirm_deleteIn('DelInHarian-<?php echo cek($r['tgl_tutup']); ?>');" ><small class="fas fa-trash"> </small> Hapus</a></td>
      </tr>
	  				  
	<?php 
	 $no++; 
	
	} ?>
				  </tbody>
                  <tfoot>				
				  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
          </div>
			</div>
			<div class="col-md-6">
		<div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Detail Data Keluar Kain Greige Perhari</h3>				 
          </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example3" class="table table-sm table-bordered table-striped" style="font-size: 14px; text-align: center;">
                  <thead>
                  <tr>
                    <th valign="middle" style="text-align: center">No</th>
                    <th valign="middle" style="text-align: center">Detail</th>
                    <th valign="middle" style="text-align: center">Tgl Tutup</th>
                    <th valign="middle" style="text-align: center">Rol</th>
                    <th valign="middle" style="text-align: center">KG</th>
                    <th valign="middle" style="text-align: center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
<?php	 
$no=1;   
$c=0;				  
$sql = sqlsrv_query($con,"SELECT TOP 30 
										tgl_tutup, 
										SUM(qty) AS rol, 
										SUM(berat) AS kg, 
										FORMAT(GETDATE(), 'yyyy-MM-dd') AS tgl 
									FROM 
										dbnow_gkg.tblkeluarkain 
									GROUP BY 
										tgl_tutup 
									ORDER BY 
										tgl_tutup DESC;
									");		  
    while($r = sqlsrv_fetch_array($sql)){
		
?>
	  <tr>
	  <td style="text-align: center"><?php echo $no;?></td>
	  <td style="text-align: center"><a href="DetailOutHarian-<?php echo cek($r['tgl_tutup']);?>" class="btn btn-info btn-xs" target="_blank"> <i class="fa fa-link"></i> Lihat Data</a></td>
	  <td style="text-align: center"><?php echo cek($r['tgl_tutup']);?></td>
      <td style="text-align: center"><?php echo $r['rol'];?></td>
      <td style="text-align: right"><?php echo number_format(round($r['kg'],2),2);?></td>
      <td style="text-align: center"><a href="#" class="btn btn-xs btn-danger <?php if($r['tgl']==cek($r['tgl_tutup'])){ }else{/*echo"disabled";*/} ?>" onclick="confirm_deleteOut('DelOutHarian-<?php echo cek($r['tgl_tutup']); ?>');" ><small class="fas fa-trash"> </small> Hapus</a></td>
      </tr>
	  				  
	<?php 
	 $no++; 
	
	} ?>
				  </tbody>
                  <tfoot>				
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
<div class="modal fade" id="delInHarian" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content" style="margin-top:100px;">
                  <div class="modal-header">
					<h4 class="modal-title">INFOMATION IN</h4>  
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    
                  </div>
					<div class="modal-body">
						<h5 class="modal-title" style="text-align:center;">Are you sure to delete this information ?</h5>
					</div>	
                  <div class="modal-footer justify-content-between">
                    <a href="#" class="btn btn-danger" id="delete_In">Delete</a>
                    <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                  </div>
                </div>
              </div>
            </div>
<div class="modal fade" id="delOutHarian" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content" style="margin-top:100px;">
                  <div class="modal-header">
					<h4 class="modal-title">INFOMATION OUT</h4> 
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    
                  </div>
					<div class="modal-body">
						<h5 class="modal-title" style="text-align:center;">Are you sure to delete this information ?</h5>
					</div>	
                  <div class="modal-footer justify-content-between">
                    <a href="#" class="btn btn-danger" id="delete_Out">Delete</a>
                    <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                  </div>
                </div>
              </div>
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
              function confirm_deleteIn(delete_url) {
                $('#delInHarian').modal('show', {
                  backdrop: 'static'
                });
                document.getElementById('delete_In').setAttribute('href', delete_url);
              }
			  function confirm_deleteOut(delete_url) {
                $('#delOutHarian').modal('show', {
                  backdrop: 'static'
                });
                document.getElementById('delete_Out').setAttribute('href', delete_url);
              }
</script>
<?php	
if(isset($_POST['submit'])){
$cektgl=sqlsrv_query($con,"SELECT
								CONVERT(VARCHAR, GETDATE(), 23) AS tgl,
								COALESCE(COUNT(t.tgl_tutup), 0) AS ck,
								FORMAT(GETDATE(), 'HH') AS jam,
								FORMAT(GETDATE(), 'HH:mm') AS jam1
							FROM
								(SELECT '$Awal' AS tgl_tutup) AS target_date
							LEFT JOIN
								dbnow_gkg.tblmasukkain t ON t.tgl_tutup = target_date.tgl_tutup
							GROUP BY
								target_date.tgl_tutup");
$dcek=sqlsrv_fetch_array($cektgl);
$t1=strtotime($Awal);
$t2=strtotime($dcek['tgl']);
$selh=round(abs($t2-$t1)/(60*60*45));

if($dcek['ck']>0){	
		echo "<script>
  	$(function() {
    toastr.error('Stok Tgl ".$Awal." Ini Sudah Pernah ditutup')
  });
  
</script>";
	/*}else if($Awal == $dcek['tgl']){
		echo "<script>
  	$(function() {
    toastr.error('Tanggal Harus Sebelumnya')
  });
  
</script>";*/
	}else if($Awal > $dcek['tgl']){
		echo "<script>
  	$(function() {
    toastr.error('Tanggal Lebih dari $selh hari')
  });
  
</script>";
		
	}else if($dcek['jam'] < 8){		
		echo "<script>
  		$(function() {
    		toastr.error('Tidak Bisa Tutup Sebelum jam 10 Malam Sampai jam 12 Malam, Sekarang Masih Jam ".$dcek['jam1']."')
  		});  
  		</script>";
			}
			else{	
	
	//Masuk Kain Greige
	$sqlDB21M = " SELECT STOCKTRANSACTION.TRANSACTIONDATE,STOCKTRANSACTION.PROJECTCODE,STOCKTRANSACTION.CREATIONUSER,ITXVIEWLAPMASUKGREIGE.SUBCODE01,
	ITXVIEWLAPMASUKGREIGE.SUBCODE02,ITXVIEWLAPMASUKGREIGE.SUBCODE03,ITXVIEWLAPMASUKGREIGE.SUBCODE04,
	   ITXVIEWLAPMASUKGREIGE.ORDERLINE,ITXVIEWLAPMASUKGREIGE.EXTERNALREFERENCE,
       ITXVIEWLAPMASUKGREIGE.ITEMDESCRIPTION,ITXVIEWLAPMASUKGREIGE.LOTCODE,
       ITXVIEWLAPMASUKGREIGE.USERPRIMARYUOMCODE,
	   ITXVIEWLAPMASUKGREIGE.PROVISIONALCOUNTERCODE,
       ITXVIEWLAPMASUKGREIGE.WHSLOCATIONWAREHOUSEZONECODE,
       ITXVIEWLAPMASUKGREIGE.WAREHOUSELOCATIONCODE,ITXVIEWLAPMASUKGREIGE.DESTINATIONWAREHOUSECODE,
       ITXVIEWLAPMASUKGREIGE.SUMMARIZEDDESCRIPTION,
       ITXVIEWLAPMASUKGREIGE.PROVISIONALCODE,SUM(STOCKTRANSACTION.BASEPRIMARYQUANTITY) AS QTY1_KG,SUM(STOCKTRANSACTION.WEIGHTNET) AS QTY_KG,COUNT(STOCKTRANSACTION.WEIGHTNET) AS QTY_ROL
       FROM DB2ADMIN.STOCKTRANSACTION STOCKTRANSACTION LEFT OUTER JOIN
DB2ADMIN.ITXVIEWLAPMASUKGREIGE ITXVIEWLAPMASUKGREIGE ON ITXVIEWLAPMASUKGREIGE.PROVISIONALCODE  = STOCKTRANSACTION.ORDERCODE
AND ITXVIEWLAPMASUKGREIGE.ORDERLINE  = STOCKTRANSACTION.ORDERLINE
AND ITXVIEWLAPMASUKGREIGE.PROVISIONALCOUNTERCODE  = STOCKTRANSACTION.ORDERCOUNTERCODE  
AND ITXVIEWLAPMASUKGREIGE.ITEMTYPEAFICODE = STOCKTRANSACTION.ITEMTYPECODE 
AND ITXVIEWLAPMASUKGREIGE.SUBCODE01= STOCKTRANSACTION.DECOSUBCODE01
AND ITXVIEWLAPMASUKGREIGE.SUBCODE02= STOCKTRANSACTION.DECOSUBCODE02
AND ITXVIEWLAPMASUKGREIGE.SUBCODE03= STOCKTRANSACTION.DECOSUBCODE03
AND ITXVIEWLAPMASUKGREIGE.SUBCODE04= STOCKTRANSACTION.DECOSUBCODE04     
LEFT OUTER JOIN DB2ADMIN.ITXVIEWHEADERKNTORDER ITXVIEWHEADERKNTORDER ON ITXVIEWHEADERKNTORDER.PRODUCTIONORDERCODE =ITXVIEWLAPMASUKGREIGE.EXTERNALREFERENCE AND 
ITXVIEWHEADERKNTORDER.CODE=ITXVIEWLAPMASUKGREIGE.LOTCODE	
WHERE STOCKTRANSACTION.TRANSACTIONDATE='$Awal' and STOCKTRANSACTION.LOGICALWAREHOUSECODE ='M021' 
AND NOT ITXVIEWLAPMASUKGREIGE.ORDERLINE IS NULL
GROUP BY ITXVIEWLAPMASUKGREIGE.PROVISIONALCODE,
ITXVIEWLAPMASUKGREIGE.SUMMARIZEDDESCRIPTION,ITXVIEWLAPMASUKGREIGE.DESTINATIONWAREHOUSECODE,
ITXVIEWLAPMASUKGREIGE.USERPRIMARYUOMCODE,STOCKTRANSACTION.PROJECTCODE,STOCKTRANSACTION.CREATIONUSER,
       ITXVIEWLAPMASUKGREIGE.WHSLOCATIONWAREHOUSEZONECODE,ITXVIEWLAPMASUKGREIGE.PROVISIONALCOUNTERCODE,
       ITXVIEWLAPMASUKGREIGE.WAREHOUSELOCATIONCODE,ITXVIEWLAPMASUKGREIGE.ORDERLINE,ITXVIEWLAPMASUKGREIGE.EXTERNALREFERENCE,
       ITXVIEWLAPMASUKGREIGE.ITEMDESCRIPTION,ITXVIEWLAPMASUKGREIGE.LOTCODE,STOCKTRANSACTION.TRANSACTIONDATE,
	   ITXVIEWLAPMASUKGREIGE.SUBCODE01,ITXVIEWLAPMASUKGREIGE.SUBCODE02,
       ITXVIEWLAPMASUKGREIGE.SUBCODE03,ITXVIEWLAPMASUKGREIGE.SUBCODE04 ";
	$stmt1M   = db2_exec($conn1,$sqlDB21M, array('cursor'=>DB2_SCROLLABLE));
	//}				  
    while($rowdb21M = db2_fetch_assoc($stmt1M)){
$sqlDB22M = " SELECT SALESORDER.CODE, SALESORDER.EXTERNALREFERENCE, SALESORDER.ORDPRNCUSTOMERSUPPLIERCODE,
		ITXVIEWAKJ.LEGALNAME1, ITXVIEWAKJ.ORDERPARTNERBRANDCODE, ITXVIEWAKJ.LONGDESCRIPTION
		FROM DB2ADMIN.SALESORDER SALESORDER LEFT OUTER JOIN DB2ADMIN.ITXVIEWAKJ 
       	ITXVIEWAKJ ON SALESORDER.CODE=ITXVIEWAKJ.CODE
		WHERE SALESORDER.CODE='".trim($rowdb21M['PROJECTCODE'])."' ";
$stmt2M   = db2_exec($conn1,$sqlDB22M, array('cursor'=>DB2_SCROLLABLE));
$rowdb22M = db2_fetch_assoc($stmt2M);		
$sqlDB23M = " SELECT p.SUBCODE01,p.SUBCODE02,p.SUBCODE03,p.SUBCODE04,p.SUBCODE05,p.SUBCODE06,p.SUBCODE07, p.LONGDESCRIPTION FROM (
SELECT p2.ITEMTYPEAFICODE,p2.SUBCODE01,p2.SUBCODE02,p2.SUBCODE03,p2.SUBCODE04,
p2.SUBCODE05,p2.SUBCODE06,p2.SUBCODE07  FROM PRODUCTIONDEMAND p 
LEFT OUTER JOIN PRODUCTIONRESERVATION p2 ON p.CODE =p2.ORDERCODE 
WHERE p.ITEMTYPEAFICODE ='KGF' AND p.SUBCODE01='".trim($rowdb21M['SUBCODE01'])."' 
AND p.SUBCODE02 ='".trim($rowdb21M['SUBCODE02'])."' AND p.SUBCODE03 ='".trim($rowdb21M['SUBCODE03'])."' AND
p.SUBCODE04='".trim($rowdb21M['SUBCODE04'])."' AND (p.PROJECTCODE ='".trim($rowdb21M['PROJECTCODE'])."' OR p.ORIGDLVSALORDLINESALORDERCODE  ='".trim($rowdb21M['PROJECTCODE'])."')
) a LEFT OUTER JOIN PRODUCT p ON
p.ITEMTYPECODE ='GYR' AND
p.SUBCODE01= a.SUBCODE01 AND p.SUBCODE02= a.SUBCODE02 AND 
p.SUBCODE03= a.SUBCODE03 AND p.SUBCODE04= a.SUBCODE04 AND 
p.SUBCODE05= a.SUBCODE05 AND p.SUBCODE06= a.SUBCODE06 AND
p.SUBCODE07= a.SUBCODE07 
GROUP BY 
p.SUBCODE01,p.SUBCODE02, 
p.SUBCODE03,p.SUBCODE04,
p.SUBCODE05,p.SUBCODE06,
p.SUBCODE07,p.LONGDESCRIPTION ";
$stmt3M   = db2_exec($conn1,$sqlDB23M, array('cursor'=>DB2_SCROLLABLE));
$aiM=0;
$aM[0]="";
$aM[1]="";
$aM[2]="";
$aM[3]="";		
while($rowdb23M = db2_fetch_assoc($stmt3M)){
	$aM[$aiM]=$rowdb23M['LONGDESCRIPTION'];
	$aiM++;
}
		
$bonM=trim($rowdb21M['PROVISIONALCODE'])."-".trim($rowdb21M['ORDERLINE']);
$itemcM=trim($rowdb21M['SUBCODE02'])."".trim($rowdb21M['SUBCODE03'])." ".trim($rowdb21M['SUBCODE04']);		
if (trim($rowdb21M['PROVISIONALCOUNTERCODE']) =='I02M50') { $knittM = 'KNITTING ITTI- GREIGE'; } 
$sqlDB24M = " SELECT LISTAGG(DISTINCT  TRIM(BLKOKASI.WAREHOUSELOCATIONCODE),', ') AS WAREHOUSELOCATIONCODE
	 FROM
(SELECT DISTINCT STKBLANCE.ELEMENTSCODE,  
       STKBLANCE.WAREHOUSELOCATIONCODE,
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
INNER JOIN ( SELECT
	b.WAREHOUSELOCATIONCODE,b.ELEMENTSCODE  
FROM BALANCE b  
WHERE b.ITEMTYPECODE ='KGF'  AND b.LOGICALWAREHOUSECODE ='M021' ) AS STKBLANCE ON STKBLANCE.ELEMENTSCODE=STOCKTRANSACTION.ITEMELEMENTCODE
WHERE STOCKTRANSACTION.ORDERCODE ='$rowdb21M[PROVISIONALCODE]'  and STOCKTRANSACTION.ORDERLINE ='$rowdb21M[ORDERLINE]' AND
STOCKTRANSACTION.LOGICALWAREHOUSECODE ='M021' 
AND NOT ITXVIEWLAPMASUKGREIGE.ORDERLINE IS NULL) AS BLKOKASI ";
$stmt4M   = db2_exec($conn1,$sqlDB24M, array('cursor'=>DB2_SCROLLABLE));					  
$rowdb24M = db2_fetch_assoc($stmt4M);	

$sqlDB25M = " SELECT
   QUALITYDOCLINE.VALUEQUANTITY AS LEBAR1,GSM.VALUEQUANTITY AS GSM1
FROM
    QUALITYDOCLINE 
LEFT OUTER JOIN 
(SELECT
  QUALITYDOCPRODUCTIONORDERCODE,VALUEQUANTITY
FROM
    QUALITYDOCLINE
WHERE
	QUALITYDOCUMENTHEADERNUMBERID ='35' AND
    QUALITYDOCLINE.CHARACTERISTICCODE = 'GSM' AND 
	QUALITYDOCUMENTITEMTYPEAFICODE ='KGF'
	) GSM ON GSM.QUALITYDOCPRODUCTIONORDERCODE=QUALITYDOCLINE.QUALITYDOCPRODUCTIONORDERCODE
WHERE
	QUALITYDOCUMENTHEADERNUMBERID ='35'  AND
	QUALITYDOCLINE.CHARACTERISTICCODE = 'LEBAR1' AND
	QUALITYDOCUMENTITEMTYPEAFICODE ='KGF' AND
	QUALITYDOCLINE.QUALITYDOCPRODUCTIONORDERCODE='$rowdb21M[EXTERNALREFERENCE]' ";
$stmt5M   = db2_exec($conn1,$sqlDB25M, array('cursor'=>DB2_SCROLLABLE));
$rowdb25M = db2_fetch_assoc($stmt5M);
		
$sqlDB26M = " SELECT
   QUALITYDOCLINE.VALUEQUANTITY AS LEBAR1,GSM.VALUEQUANTITY AS GSM1
FROM
    QUALITYDOCLINE 
LEFT OUTER JOIN 
(SELECT
  QUALITYDOCPRODUCTIONORDERCODE,VALUEQUANTITY
FROM
    QUALITYDOCLINE
WHERE
	QUALITYDOCUMENTHEADERNUMBERID ='1379' AND
    QUALITYDOCLINE.CHARACTERISTICCODE = 'GSM' AND 
	QUALITYDOCUMENTITEMTYPEAFICODE ='KGF'
	) GSM ON GSM.QUALITYDOCPRODUCTIONORDERCODE=QUALITYDOCLINE.QUALITYDOCPRODUCTIONORDERCODE
WHERE
	QUALITYDOCUMENTHEADERNUMBERID ='1379' AND
	QUALITYDOCLINE.CHARACTERISTICCODE = 'LEBAR1' AND
	QUALITYDOCUMENTITEMTYPEAFICODE ='KGF' AND
	QUALITYDOCLINE.QUALITYDOCPRODUCTIONORDERCODE='$rowdb21M[EXTERNALREFERENCE]' ";
$stmt6M   = db2_exec($conn1,$sqlDB26M, array('cursor'=>DB2_SCROLLABLE));
$rowdb26M = db2_fetch_assoc($stmt6M);			
		
$sqlDB27M = " 
SELECT ad.VALUESTRING AS NO_MESIN
FROM PRODUCTIONDEMAND pd 	
LEFT OUTER JOIN ADSTORAGE ad ON ad.UNIQUEID = pd.ABSUNIQUEID AND ad.NAMENAME ='MachineNo'
WHERE  pd.CODE ='$rowdb21M[LOTCODE]'
GROUP BY ad.VALUESTRING
";
$stmt7M   = db2_exec($conn1,$sqlDB27M, array('cursor'=>DB2_SCROLLABLE));					  
$rowdb27M = db2_fetch_assoc($stmt7M);	
$sqlDB28M = " SELECT a.VALUEDECIMAL  FROM PRODUCT p 
LEFT OUTER JOIN ADSTORAGE a  ON a.UNIQUEID = p.ABSUNIQUEID 
WHERE p.SUBCODE01='$rowdb21M[SUBCODE01]' AND
p.SUBCODE02='$rowdb21M[SUBCODE02]' AND
p.SUBCODE03='$rowdb21M[SUBCODE03]' AND
p.SUBCODE04='$rowdb21M[SUBCODE04]' AND
a.NAMENAME ='Width' AND
p.ITEMTYPECODE ='KFF'  ";
$stmt8M   = db2_exec($conn1,$sqlDB28M, array('cursor'=>DB2_SCROLLABLE));
$rowdb28M = db2_fetch_assoc($stmt8M);	
$sqlDB29M = " SELECT a.VALUEDECIMAL  FROM PRODUCT p 
LEFT OUTER JOIN ADSTORAGE a  ON a.UNIQUEID = p.ABSUNIQUEID 
WHERE p.SUBCODE01='$rowdb21M[SUBCODE01]' AND
p.SUBCODE02='$rowdb21M[SUBCODE02]' AND
p.SUBCODE03='$rowdb21M[SUBCODE03]' AND
p.SUBCODE04='$rowdb21M[SUBCODE04]' AND
a.NAMENAME ='GSM' AND
p.ITEMTYPECODE ='KFF'  ";
$stmt9M   = db2_exec($conn1,$sqlDB29M, array('cursor'=>DB2_SCROLLABLE));
$rowdb29M = db2_fetch_assoc($stmt9M);
$sqlDB30M = " 
SELECT e.WIDTHGROSS AS LEBAR1,a.VALUEDECIMAL AS GSM1,s.ORDERCODE,s.ORDERLINE  FROM ELEMENTSINSPECTION e 
LEFT OUTER JOIN ADSTORAGE a ON a.UNIQUEID =e.ABSUNIQUEID AND a.NAMENAME ='GSM'
LEFT OUTER JOIN STOCKTRANSACTION s ON s.ITEMELEMENTCODE =e.ELEMENTCODE
WHERE s.ORDERCODE='".$rowdb21M['PROVISIONALCODE']."' AND s.ORDERLINE='".$rowdb21M['ORDERLINE']."'
GROUP BY s.ORDERCODE,s.ORDERLINE,e.WIDTHGROSS,a.VALUEDECIMAL
";
$stmt10M   = db2_exec($conn1,$sqlDB30M, array('cursor'=>DB2_SCROLLABLE));					  
$rowdb30M = db2_fetch_assoc($stmt10M);		
if($rowdb22M['LEGALNAME1']==""){$langgananM="";}else{$langgananM=$rowdb22M['LEGALNAME1'];}
if($rowdb22M['ORDERPARTNERBRANDCODE']==""){$buyerM="";}else{$buyerM=$rowdb22M['ORDERPARTNERBRANDCODE'];}
$mcM=$rowdb27M['NO_MESIN'];
if($rowdb25M['GSM1']!=""){$gsmM=round($rowdb25M['GSM1']);}else if($rowdb26M['GSM1']!=""){$gsmM=round($rowdb26M['GSM1']);}else{$gsmM=round($rowdb30M['GSM1']); }
if($rowdb25M['LEBAR1']!=""){$lbrM=round($rowdb25M['LEBAR1']);}else if($rowdb26M['LEBAR1']!=""){$lbrM=round($rowdb26M['LEBAR1']);}else{ $lbrM=round($rowdb30M['LEBAR1']);}
if(substr($rowdb21M['EXTERNALREFERENCE'],0,3)!="000" or substr($rowdb21M['EXTERNALREFERENCE'],0,2)!="00"){$lotBM=$rowdb21M['EXTERNALREFERENCE'];}else{$lotBM="";}
if(substr($rowdb21M['EXTERNALREFERENCE'],0,3)=="000" or substr($rowdb21M['EXTERNALREFERENCE'],0,2)=="00"){$prdOrM=$rowdb21M['EXTERNALREFERENCE'];}else{$prdOrM="";}	
if($rowdb21M['QTY_KG']> 0){$KGS=$rowdb21M['QTY_KG'];}else{ $KGS=$rowdb21M['QTY1_KG']; }	

$query = "INSERT INTO dbnow_gkg.tblmasukkain (
						tgl_masuk	
						,no_bon	
						,buyer	
						,customer	
						,projectcode	
						,prod_order	
						,code	
						,mesin_rajut	
						,lot_benang	
						,lebar_g	
						,gramasi_g	
						,lebar_kj	
						,gramasi_kj	
						,jenis_kain	
						,lot	
						,benang1 
						,benang2 
						,benang3 
						,benang4 
						,qty	
						,berat	
						,blok	
						,balance	
						,userid	
						,tgl_tutup 
						,tgl_buat ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$params = [
	cek($rowdb21M['TRANSACTIONDATE']),
	cek($bonM),
	cek($buyerM),
	cek($langgananM),
	cek($rowdb21M['PROJECTCODE']),
	cek($prdOrM),
	cek($itemcM),
	cek($mcM),
	cek($lotBM),
	cek($lbrM),
	cek($gsmM),
	cek(round($rowdb28M['VALUEDECIMAL'])),
	cek(round($rowdb29M['VALUEDECIMAL'])),
	cek(str_replace("'","''",$rowdb21M['SUMMARIZEDDESCRIPTION'])),
	cek($rowdb21M['LOTCODE']),
	cek(str_replace("'","''",$aM[0])),
	cek(str_replace("'","''",$aM[1])),
	cek(str_replace("'","''",$aM[2])),
	cek(str_replace("'","''",$aM[3])),
	cek($rowdb21M['QTY_ROL']),
	cek($KGS),
	cek($rowdb21M['WHSLOCATIONWAREHOUSEZONECODE']."-".$rowdb21M['WAREHOUSELOCATIONCODE']),
	cek($rowdb24M['WAREHOUSELOCATIONCODE']),
	cek($rowdb21M['CREATIONUSER']),
	cek($Awal),
	date('Y-m-d H:i:s')
];


$simpanM=sqlsrv_query($con,$query, $params) or die("GAGAL SIMPAN MASUK KAIN");		
	
}

		//Retur Produksi				

$sqlDB21RM = "SELECT
				s.PROJECTCODE,
				f.SUMMARIZEDDESCRIPTION,
								s.TRANSACTIONDATE,
				s.DECOSUBCODE01,
				s.DECOSUBCODE02,
				s.DECOSUBCODE03,
								s.DECOSUBCODE04,
				s.WHSLOCATIONWAREHOUSEZONECODE,
				s.WAREHOUSELOCATIONCODE,
								s.LOTCODE,
				SUM(s.BASEPRIMARYQUANTITY) AS KG,
				COUNT(s.ITEMELEMENTCODE) AS JML,
								s.CREATIONUSER,
				a1.VALUESTRING AS NOMESIN
			FROM
				STOCKTRANSACTION s
			LEFT OUTER JOIN ADSTORAGE a ON
				a.UNIQUEID = s.ABSUNIQUEID
				AND a.NAMENAME = 'StatusRetur'
			LEFT OUTER JOIN PRODUCTIONDEMAND p ON
				p.CODE = s.LOTCODE
			LEFT OUTER JOIN ADSTORAGE a1 ON
				a1.UNIQUEID = p.ABSUNIQUEID
				AND a1.NAMENAME = 'MachineNo'
			LEFT OUTER JOIN FULLITEMKEYDECODER f ON
				s.FULLITEMIDENTIFIER = f.IDENTIFIER
			WHERE
				s.TRANSACTIONDATE = '$Awal'
				AND s.ITEMTYPECODE = 'KGF'
				AND 
								s.LOGICALWAREHOUSECODE = 'M021'
				AND s.TEMPLATECODE = 'OPN'
				AND a.VALUESTRING = '1'
			GROUP BY
				s.PROJECTCODE,
								s.TRANSACTIONDATE,
				s.DECOSUBCODE01,
				s.DECOSUBCODE02,
								s.DECOSUBCODE03,
				s.DECOSUBCODE04,
								s.WHSLOCATIONWAREHOUSEZONECODE,
								s.WAREHOUSELOCATIONCODE,
				s.LOTCODE,
				f.SUMMARIZEDDESCRIPTION,
				s.CREATIONUSER,
				a1.VALUESTRING";
		$stmt1RM   = db2_exec($conn1, $sqlDB21RM, array('cursor' => DB2_SCROLLABLE));
		while ($rowdb21RM = db2_fetch_assoc($stmt1RM)) {
			$itemcRM = trim($rowdb21RM['DECOSUBCODE02']) . "" . trim($rowdb21RM['DECOSUBCODE03']) . " " . trim($rowdb21RM['DECOSUBCODE04']);

			$sqlDB22R1M = "SELECT
								SALESORDER.CODE,
								SALESORDER.EXTERNALREFERENCE,
								SALESORDER.ORDPRNCUSTOMERSUPPLIERCODE,
														ITXVIEWAKJ.LEGALNAME1,
								ITXVIEWAKJ.ORDERPARTNERBRANDCODE,
								ITXVIEWAKJ.LONGDESCRIPTION
							FROM
								DB2ADMIN.SALESORDER SALESORDER
							LEFT OUTER JOIN DB2ADMIN.ITXVIEWAKJ 
														ITXVIEWAKJ ON
								SALESORDER.CODE = ITXVIEWAKJ.CODE
							WHERE
								SALESORDER.CODE = '" . trim($rowdb21RM[' PROJECTCODE']) . "'";
			$stmt2R1M   = db2_exec($conn1, $sqlDB22R1M, array('cursor' => DB2_SCROLLABLE));
			$rowdb22R1M = db2_fetch_assoc($stmt2R1M);

			$sqlDB22RM = "SELECT
							LISTAGG ( DISTINCT TRIM ( BALANCE.WAREHOUSELOCATIONCODE ), ', ' ) AS WAREHOUSELOCATIONCODE,
							COUNT ( BALANCE.BASEPRIMARYQUANTITYUNIT ) AS ROL,
							SUM ( BALANCE.BASEPRIMARYQUANTITYUNIT ) AS BERAT,
							BALANCE.LOTCODE 
						FROM
							(
							SELECT
								s.ITEMELEMENTCODE 
							FROM
								STOCKTRANSACTION s
								LEFT OUTER JOIN ADSTORAGE a ON a.UNIQUEID = s.ABSUNIQUEID 
								AND a.NAMENAME = 'StatusRetur' 
							WHERE
								s.PROJECTCODE = '" . $rowdb21RM[' PROJECTCODE '] . "' 
								AND s.ITEMTYPECODE = 'KGF' 
								AND s.DECOSUBCODE02 = '" . $rowdb21RM[' DECOSUBCODE02 '] . "' 
								AND s.DECOSUBCODE03 = '" . $rowdb21RM[' DECOSUBCODE03 '] . "' 
								AND s.DECOSUBCODE04 = '" . $rowdb21RM[' DECOSUBCODE04 '] . "' 
								AND s.LOGICALWAREHOUSECODE = 'M021' 
								AND s.LOTCODE = '$rowdb21RM[LOTCODE]' 
								AND s.TEMPLATECODE = 'OPN' 
								AND a.VALUESTRING = '1' 
							GROUP BY
								s.ITEMELEMENTCODE 
							) STOCKTRANSACTION
							LEFT OUTER JOIN DB2ADMIN.BALANCE BALANCE ON BALANCE.ELEMENTSCODE = STOCKTRANSACTION.ITEMELEMENTCODE 
						GROUP BY
							BALANCE.LOTCODE";
			$stmt2RM   = db2_exec($conn1, $sqlDB22RM, array('cursor' => DB2_SCROLLABLE));
			$rowdb22RM = db2_fetch_assoc($stmt2RM);
			$sqlDB23RM = " SELECT p.SUBCODE01,p.SUBCODE02,p.SUBCODE03,p.SUBCODE04,p.SUBCODE05,p.SUBCODE06,p.SUBCODE07, p.LONGDESCRIPTION FROM (
							SELECT p2.ITEMTYPEAFICODE,p2.SUBCODE01,p2.SUBCODE02,p2.SUBCODE03,p2.SUBCODE04,
							p2.SUBCODE05,p2.SUBCODE06,p2.SUBCODE07  FROM PRODUCTIONDEMAND p 
							LEFT OUTER JOIN PRODUCTIONRESERVATION p2 ON p.CODE =p2.ORDERCODE 
							WHERE p.ITEMTYPEAFICODE ='KGF' AND p.SUBCODE01='" . trim($rowdb21RM['DECOSUBCODE01']) . "' 
							AND p.SUBCODE02 ='" . trim($rowdb21RM['DECOSUBCODE02']) . "' AND p.SUBCODE03 ='" . trim($rowdb21RM['DECOSUBCODE03']) . "' AND
							p.SUBCODE04='" . trim($rowdb21RM['DECOSUBCODE04']) . "' AND (p.PROJECTCODE ='" . trim($rowdb21RM['PROJECTCODE']) . "' OR p.ORIGDLVSALORDLINESALORDERCODE  ='" . trim($rowdb21RM['PROJECTCODE']) . "')
							) a LEFT OUTER JOIN PRODUCT p ON
							p.ITEMTYPECODE ='GYR' AND
							p.SUBCODE01= a.SUBCODE01 AND p.SUBCODE02= a.SUBCODE02 AND 
							p.SUBCODE03= a.SUBCODE03 AND p.SUBCODE04= a.SUBCODE04 AND 
							p.SUBCODE05= a.SUBCODE05 AND p.SUBCODE06= a.SUBCODE06 AND
							p.SUBCODE07= a.SUBCODE07 
							GROUP BY 
							p.SUBCODE01,p.SUBCODE02, 
							p.SUBCODE03,p.SUBCODE04,
							p.SUBCODE05,p.SUBCODE06,
							p.SUBCODE07,p.LONGDESCRIPTION ";
			$stmt3RM   = db2_exec($conn1, $sqlDB23RM, array('cursor' => DB2_SCROLLABLE));
			$aiRM = 0;
			$aRM[0] = "";
			$aRM[1] = "";
			$aRM[2] = "";
			$aRM[3] = "";
			while ($rowdb23RM = db2_fetch_assoc($stmt3RM)) {
				$aRM[$aiRM] = $rowdb23RM['LONGDESCRIPTION'];
				$aiRM++;
			}

			$sqlDB28RM = " SELECT a.VALUEDECIMAL  FROM PRODUCT p 
							LEFT OUTER JOIN ADSTORAGE a  ON a.UNIQUEID = p.ABSUNIQUEID 
							WHERE p.SUBCODE01='" . trim($rowdb21RM['DECOSUBCODE01']) . "' AND
							p.SUBCODE02='" . trim($rowdb21RM['DECOSUBCODE02']) . "' AND
							p.SUBCODE03='" . trim($rowdb21RM['DECOSUBCODE03']) . "' AND
							p.SUBCODE04='" . trim($rowdb21RM['DECOSUBCODE04']) . "' AND
							a.NAMENAME ='Width' AND
							p.ITEMTYPECODE ='KFF'  ";
			$stmt8RM   = db2_exec($conn1, $sqlDB28RM, array('cursor' => DB2_SCROLLABLE));
			$rowdb28RM = db2_fetch_assoc($stmt8RM);
			$sqlDB29RM = " SELECT a.VALUEDECIMAL  FROM PRODUCT p 
							LEFT OUTER JOIN ADSTORAGE a  ON a.UNIQUEID = p.ABSUNIQUEID 
							WHERE p.SUBCODE01='" . trim($rowdb21RM['DECOSUBCODE01']) . "' AND
							p.SUBCODE02='" . trim($rowdb21RM['DECOSUBCODtE02']) . "' AND
							p.SUBCODE03='" . trim($rowdb21RM['DECOSUBCODE03']) . "' AND
							p.SUBCODE04='" . trim($rowdb21RM['DECOSUBCODE04']) . "' AND
							a.NAMENAME ='GSM' AND
							p.ITEMTYPECODE ='KFF'  ";
			$stmt9RM   = db2_exec($conn1, $sqlDB29RM, array('cursor' => DB2_SCROLLABLE));
			$rowdb29RM = db2_fetch_assoc($stmt9RM);
			if ($rowdb22R1M['LEGALNAME1'] == "") {
				$langgananRM = "";
			} else {
				$langgananRM = $rowdb22R1M['LEGALNAME1'];
			}
			if ($rowdb22R1M['ORDERPARTNERBRANDCODE'] == "") {
				$buyerRM = "";
			} else {
				$buyerRM = $rowdb22R1M['ORDERPARTNERBRANDCODE'];
			}

$simpanRMQuery = "INSERT INTO dbnow_gkg.tblmasukkain (
					tgl_masuk	
					,buyer	
					,customer	
					,code	
					,mesin_rajut	
					,lebar_kj	
					,gramasi_kj	
					,jenis_kain	
					,lot	
					,benang1 
					,benang2 
					,benang3 
					,benang4 
					,qty	
					,berat	
					,blok	
					,balance	
					,userid	
					,tgl_tutup 
					,tgl_buat ) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
			$paramsRM = [
				cek($rowdb21RM['TRANSACTIONDATE']),
				cek($buyerRM),
				cek($langgananRM),
				cek($itemcRM),
				cek($rowdb21RM['NOMESIN']),
				cek(round($rowdb28RM['VALUEDECIMAL'])),
				cek(round($rowdb29RM['VALUEDECIMAL'])),
				cek(str_replace("'", "''", $rowdb21RM['SUMMARIZEDDESCRIPTION'])),
				cek($rowdb21RM['LOTCODE']),
				cek(str_replace("'", "''", $aRM[0])),
				cek(str_replace("'", "''", $aRM[1])),
				cek(str_replace("'", "''", $aRM[2])),
				cek(str_replace("'", "''", $aRM[3])),
				cek($rowdb21RM['JML']),
				cek($rowdb21RM['KG']),
				cek($rowdb21RM['WHSLOCATIONWAREHOUSEZONECODE'] . "-" . $rowdb21RM['WAREHOUSELOCATIONCODE']),
				cek($rowdb22RM['WAREHOUSELOCATIONCODE']),
				cek($rowdb21RM['CREATIONUSER']),
				cek($Awal),
				date('Y-m-d H:i:s')
			];

$simpanRM=sqlsrv_query($con,$simpanRMQuery, $paramsRM) or die("GAGAL SIMPAN RETUR PRODUKSI");		
		
}

//Retur Bagi Ulang				

$sqlDB21RMBU = " SELECT s.PROJECTCODE,f.SUMMARIZEDDESCRIPTION,
s.TRANSACTIONDATE,s.DECOSUBCODE01,s.DECOSUBCODE02,s.DECOSUBCODE03,
s.DECOSUBCODE04,s.WHSLOCATIONWAREHOUSEZONECODE,s.WAREHOUSELOCATIONCODE,
s.LOTCODE,SUM(s.BASEPRIMARYQUANTITY) AS KG,COUNT(s.ITEMELEMENTCODE) AS JML,
s.CREATIONUSER,a1.VALUESTRING AS NOMESIN FROM STOCKTRANSACTION s 
LEFT OUTER JOIN ADSTORAGE a ON a.UNIQUEID = s.ABSUNIQUEID AND a.NAMENAME = 'StatusRetur'
LEFT OUTER JOIN PRODUCTIONDEMAND p ON p.CODE = s.LOTCODE
LEFT OUTER JOIN ADSTORAGE a1 ON a1.UNIQUEID = p.ABSUNIQUEID AND a1.NAMENAME = 'MachineNo'
LEFT OUTER JOIN FULLITEMKEYDECODER f ON s.FULLITEMIDENTIFIER = f.IDENTIFIER
WHERE s.TRANSACTIONDATE = '$Awal' AND s.ITEMTYPECODE='KGF' AND 
s.LOGICALWAREHOUSECODE ='M021' AND s.TEMPLATECODE = 'OPN' AND a.VALUESTRING =  '2'
GROUP BY s.PROJECTCODE,
s.TRANSACTIONDATE,s.DECOSUBCODE01,s.DECOSUBCODE02,
s.DECOSUBCODE03, s.DECOSUBCODE04,
s.WHSLOCATIONWAREHOUSEZONECODE,
s.WAREHOUSELOCATIONCODE, s.LOTCODE, f.SUMMARIZEDDESCRIPTION, s.CREATIONUSER,a1.VALUESTRING";
	$stmt1RMBU   = db2_exec($conn1,$sqlDB21RMBU, array('cursor'=>DB2_SCROLLABLE)); 
    while($rowdb21RMBU = db2_fetch_assoc($stmt1RMBU)){ 
$itemcRMBU=trim($rowdb21RMBU['DECOSUBCODE02'])."".trim($rowdb21RMBU['DECOSUBCODE03'])." ".trim($rowdb21RMBU['DECOSUBCODE04']);
		
$sqlDB22R1MBU = " SELECT SALESORDER.CODE, SALESORDER.EXTERNALREFERENCE, SALESORDER.ORDPRNCUSTOMERSUPPLIERCODE,
		ITXVIEWAKJ.LEGALNAME1, ITXVIEWAKJ.ORDERPARTNERBRANDCODE, ITXVIEWAKJ.LONGDESCRIPTION
		FROM DB2ADMIN.SALESORDER SALESORDER LEFT OUTER JOIN DB2ADMIN.ITXVIEWAKJ 
       	ITXVIEWAKJ ON SALESORDER.CODE=ITXVIEWAKJ.CODE
		WHERE SALESORDER.CODE='".trim($rowdb21RMBU['PROJECTCODE'])."' ";
$stmt2R1MBU   = db2_exec($conn1,$sqlDB22R1MBU, array('cursor'=>DB2_SCROLLABLE));
$rowdb22R1MBU = db2_fetch_assoc($stmt2R1MBU);
		
$sqlDB22RMBU = " SELECT LISTAGG(DISTINCT  TRIM(BALANCE.WAREHOUSELOCATIONCODE),', ') AS WAREHOUSELOCATIONCODE, COUNT(BALANCE.BASEPRIMARYQUANTITYUNIT) AS ROL,SUM(BALANCE.BASEPRIMARYQUANTITYUNIT) AS BERAT,BALANCE.LOTCODE  
		FROM (
		SELECT 
s.ITEMELEMENTCODE  FROM STOCKTRANSACTION s 
LEFT OUTER JOIN ADSTORAGE a ON a.UNIQUEID = s.ABSUNIQUEID AND a.NAMENAME = 'StatusRetur'
WHERE s.PROJECTCODE='".$rowdb21RMBU['PROJECTCODE']."' AND s.ITEMTYPECODE='KGF' AND 
s.DECOSUBCODE02='".$rowdb21RMBU['DECOSUBCODE02']."' AND s.DECOSUBCODE03='".$rowdb21RMBU['DECOSUBCODE03']."' AND 
s.DECOSUBCODE04='".$rowdb21RMBU['DECOSUBCODE04']."' AND s.LOGICALWAREHOUSECODE ='M021' AND
s.LOTCODE='$rowdb21RMBU[LOTCODE]' AND 
s.TEMPLATECODE = 'OPN' AND a.VALUESTRING =  '2'
GROUP BY 
s.ITEMELEMENTCODE
		) STOCKTRANSACTION LEFT OUTER JOIN 
		DB2ADMIN.BALANCE BALANCE ON BALANCE.ELEMENTSCODE =STOCKTRANSACTION.ITEMELEMENTCODE  
		GROUP BY BALANCE.LOTCODE ";					  
		$stmt2RMBU   = db2_exec($conn1,$sqlDB22RMBU, array('cursor'=>DB2_SCROLLABLE));	
		$rowdb22RMBU = db2_fetch_assoc($stmt2RMBU);
$sqlDB23RMBU = " SELECT p.SUBCODE01,p.SUBCODE02,p.SUBCODE03,p.SUBCODE04,p.SUBCODE05,p.SUBCODE06,p.SUBCODE07, p.LONGDESCRIPTION FROM (
SELECT p2.ITEMTYPEAFICODE,p2.SUBCODE01,p2.SUBCODE02,p2.SUBCODE03,p2.SUBCODE04,
p2.SUBCODE05,p2.SUBCODE06,p2.SUBCODE07  FROM PRODUCTIONDEMAND p 
LEFT OUTER JOIN PRODUCTIONRESERVATION p2 ON p.CODE =p2.ORDERCODE 
WHERE p.ITEMTYPEAFICODE ='KGF' AND p.SUBCODE01='".trim($rowdb21RMBU['DECOSUBCODE01'])."' 
AND p.SUBCODE02 ='".trim($rowdb21RMBU['DECOSUBCODE02'])."' AND p.SUBCODE03 ='".trim($rowdb21RMBU['DECOSUBCODE03'])."' AND
p.SUBCODE04='".trim($rowdb21RMBU['DECOSUBCODE04'])."' AND (p.PROJECTCODE ='".trim($rowdb21RMBU['PROJECTCODE'])."' OR p.ORIGDLVSALORDLINESALORDERCODE  ='".trim($rowdb21RMBU['PROJECTCODE'])."')
) a LEFT OUTER JOIN PRODUCT p ON
p.ITEMTYPECODE ='GYR' AND
p.SUBCODE01= a.SUBCODE01 AND p.SUBCODE02= a.SUBCODE02 AND 
p.SUBCODE03= a.SUBCODE03 AND p.SUBCODE04= a.SUBCODE04 AND 
p.SUBCODE05= a.SUBCODE05 AND p.SUBCODE06= a.SUBCODE06 AND
p.SUBCODE07= a.SUBCODE07 
GROUP BY 
p.SUBCODE01,p.SUBCODE02, 
p.SUBCODE03,p.SUBCODE04,
p.SUBCODE05,p.SUBCODE06,
p.SUBCODE07,p.LONGDESCRIPTION ";
$stmt3RMBU   = db2_exec($conn1,$sqlDB23RMBU, array('cursor'=>DB2_SCROLLABLE));
$aiRMBU=0;
$aRMBU[0]="";
$aRMBU[1]="";
$aRMBU[2]="";
$aRMBU[3]="";		
while($rowdb23RMBU = db2_fetch_assoc($stmt3RMBU)){
	$aRMBU[$aiRMBU]=$rowdb23RMBU['LONGDESCRIPTION'];
	$aiRMBU++;
}		

$sqlDB28RMBU = " SELECT a.VALUEDECIMAL  FROM PRODUCT p 
LEFT OUTER JOIN ADSTORAGE a  ON a.UNIQUEID = p.ABSUNIQUEID 
WHERE p.SUBCODE01='".trim($rowdb21RMBU['DECOSUBCODE01'])."' AND
p.SUBCODE02='".trim($rowdb21RMBU['DECOSUBCODE02'])."' AND
p.SUBCODE03='".trim($rowdb21RMBU['DECOSUBCODE03'])."' AND
p.SUBCODE04='".trim($rowdb21RMBU['DECOSUBCODE04'])."' AND
a.NAMENAME ='Width' AND
p.ITEMTYPECODE ='KFF'  ";
$stmt8RMBU   = db2_exec($conn1,$sqlDB28RMBU, array('cursor'=>DB2_SCROLLABLE));
$rowdb28RMBU = db2_fetch_assoc($stmt8RMBU);	
$sqlDB29RMBU = " SELECT a.VALUEDECIMAL  FROM PRODUCT p 
LEFT OUTER JOIN ADSTORAGE a  ON a.UNIQUEID = p.ABSUNIQUEID 
WHERE p.SUBCODE01='".trim($rowdb21RMBU['DECOSUBCODE01'])."' AND
p.SUBCODE02='".trim($rowdb21RMBU['DECOSUBCODE02'])."' AND
p.SUBCODE03='".trim($rowdb21RMBU['DECOSUBCODE03'])."' AND
p.SUBCODE04='".trim($rowdb21RMBU['DECOSUBCODE04'])."' AND
a.NAMENAME ='GSM' AND
p.ITEMTYPECODE ='KFF'  ";
$stmt9RMBU   = db2_exec($conn1,$sqlDB29RMBU, array('cursor'=>DB2_SCROLLABLE));
$rowdb29RMBU = db2_fetch_assoc($stmt9RMBU);		
if($rowdb22R1MBU['LEGALNAME1']==""){$langgananRMBU="";}else{$langgananRMBU=$rowdb22R1MBU['LEGALNAME1'];}
if($rowdb22R1MBU['ORDERPARTNERBRANDCODE']==""){$buyerRMBU="";}else{$buyerRMBU=$rowdb22R1MBU['ORDERPARTNERBRANDCODE'];}

$query = "INSERT INTO dbnow_gkg.tblmasukkain (
						tgl_masuk	
						,buyer	
						,customer	
						,code	
						,mesin_rajut	
						,lebar_kj	
						,gramasi_kj	
						,jenis_kain	
						,lot	
						,benang1 
						,benang2 
						,benang3 
						,benang4 
						,qty	
						,berat	
						,blok	
						,balance	
						,userid	
						,tgl_tutup 
						,tgl_buat ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$params = [
	cek($rowdb21RMBU['TRANSACTIONDATE']),
	cek($buyerRMBU),
	cek($langgananRMBU),
	cek($itemcRMBU),
	cek($rowdb21RMBU['NOMESIN']),
	cek(round($rowdb28RMBU['VALUEDECIMAL'])),
	cek(round($rowdb29RMBU['VALUEDECIMAL'])),
	cek(str_replace("'","''",$rowdb21RMBU['SUMMARIZEDDESCRIPTION'])),
	cek($rowdb21RMBU['LOTCODE']),
	cek(str_replace("'","''",$aRMBU[0])),
	cek(str_replace("'","''",$aRMBU[1])),
	cek(str_replace("'","''",$aRMBU[2])),
	cek(str_replace("'","''",$aRMBU[3])),
	cek($rowdb21RMBU['JML']),
	cek($rowdb21RMBU['KG']),
	cek($rowdb21RMBU['WHSLOCATIONWAREHOUSEZONECODE']."-".$rowdb21RMBU['WAREHOUSELOCATIONCODE']),
	cek($rowdb22RMBU['WAREHOUSELOCATIONCODE']),
	cek($rowdb21RMBU['CREATIONUSER']),
	cek($Awal),
	date('Y-m-d H:i:s')
];

$simpanRMBU=sqlsrv_query($con,$query, $params) or die("GAGAL SIMPAN RETUR BAGI ULANG");		
		
}				
				
//Add Stok Flat Knitt				
					  
	$sqlDB21FM = " SELECT s.PROJECTCODE,f.SUMMARIZEDDESCRIPTION,
s.TRANSACTIONDATE,s.DECOSUBCODE01,s.DECOSUBCODE02,s.DECOSUBCODE03,
s.DECOSUBCODE04,s.WHSLOCATIONWAREHOUSEZONECODE,s.WAREHOUSELOCATIONCODE,
s.LOTCODE,SUM(s.BASEPRIMARYQUANTITY) AS KG,COUNT(s.ITEMELEMENTCODE) AS JML,
s.CREATIONUSER,a1.VALUESTRING AS NOMESIN FROM STOCKTRANSACTION s 
LEFT OUTER JOIN ADSTORAGE a ON a.UNIQUEID = s.ABSUNIQUEID AND a.NAMENAME = 'StatusFlatKnitt'
LEFT OUTER JOIN PRODUCTIONDEMAND p ON p.CODE = s.LOTCODE
LEFT OUTER JOIN ADSTORAGE a1 ON a1.UNIQUEID = p.ABSUNIQUEID AND a1.NAMENAME = 'MachineNo'
LEFT OUTER JOIN FULLITEMKEYDECODER f ON s.FULLITEMIDENTIFIER = f.IDENTIFIER
WHERE s.TRANSACTIONDATE = '$Awal' AND s.ITEMTYPECODE='FKG' AND 
s.LOGICALWAREHOUSECODE ='M021' AND s.TEMPLATECODE = 'OPN' AND a.VALUESTRING =  '1'
GROUP BY s.PROJECTCODE,
s.TRANSACTIONDATE,s.DECOSUBCODE01,s.DECOSUBCODE02,
s.DECOSUBCODE03, s.DECOSUBCODE04,
s.WHSLOCATIONWAREHOUSEZONECODE,
s.WAREHOUSELOCATIONCODE, s.LOTCODE, f.SUMMARIZEDDESCRIPTION, s.CREATIONUSER,a1.VALUESTRING";
	$stmt1FM   = db2_exec($conn1,$sqlDB21FM, array('cursor'=>DB2_SCROLLABLE)); 
    while($rowdb21FM = db2_fetch_assoc($stmt1FM)){ 
$itemcFM=trim($rowdb21FM['DECOSUBCODE02'])."".trim($rowdb21FM['DECOSUBCODE03'])." ".trim($rowdb21FM['DECOSUBCODE04']);
		
$sqlDB22F1M = " SELECT SALESORDER.CODE, SALESORDER.EXTERNALREFERENCE, SALESORDER.ORDPRNCUSTOMERSUPPLIERCODE,
		ITXVIEWAKJ.LEGALNAME1, ITXVIEWAKJ.ORDERPARTNERBRANDCODE, ITXVIEWAKJ.LONGDESCRIPTION
		FROM DB2ADMIN.SALESORDER SALESORDER LEFT OUTER JOIN DB2ADMIN.ITXVIEWAKJ 
       	ITXVIEWAKJ ON SALESORDER.CODE=ITXVIEWAKJ.CODE
		WHERE SALESORDER.CODE='".trim($rowdb21FM['PROJECTCODE'])."' ";
$stmt2F1M   = db2_exec($conn1,$sqlDB22F1M, array('cursor'=>DB2_SCROLLABLE));
$rowdb22F1M = db2_fetch_assoc($stmt2F1M);
		
$sqlDB22FM = " SELECT LISTAGG(DISTINCT  TRIM(BALANCE.WAREHOUSELOCATIONCODE),', ') AS WAREHOUSELOCATIONCODE, COUNT(BALANCE.BASEPRIMARYQUANTITYUNIT) AS ROL,SUM(BALANCE.BASEPRIMARYQUANTITYUNIT) AS BERAT,BALANCE.LOTCODE  
		FROM (
		SELECT 
s.ITEMELEMENTCODE  FROM STOCKTRANSACTION s 
LEFT OUTER JOIN ADSTORAGE a ON a.UNIQUEID = s.ABSUNIQUEID AND a.NAMENAME = 'StatusFlatKnitt'
WHERE s.PROJECTCODE='".$rowdb21FM['PROJECTCODE']."' AND s.ITEMTYPECODE='FKG' AND 
s.DECOSUBCODE02='".$rowdb21FM['DECOSUBCODE02']."' AND s.DECOSUBCODE03='".$rowdb21FM['DECOSUBCODE03']."' AND 
s.DECOSUBCODE04='".$rowdb21FM['DECOSUBCODE04']."' AND s.LOGICALWAREHOUSECODE ='M021' AND
s.LOTCODE='$rowdb21FM[LOTCODE]' AND 
s.TEMPLATECODE = 'OPN' AND a.VALUESTRING =  '1'
GROUP BY 
s.ITEMELEMENTCODE
		) STOCKTRANSACTION LEFT OUTER JOIN 
		DB2ADMIN.BALANCE BALANCE ON BALANCE.ELEMENTSCODE =STOCKTRANSACTION.ITEMELEMENTCODE  
		GROUP BY BALANCE.LOTCODE ";					  
		$stmt2FM   = db2_exec($conn1,$sqlDB22FM, array('cursor'=>DB2_SCROLLABLE));	
		$rowdb22FM = db2_fetch_assoc($stmt2FM);
$sqlDB23FM = " SELECT p.SUBCODE01,p.SUBCODE02,p.SUBCODE03,p.SUBCODE04,p.SUBCODE05,p.SUBCODE06,p.SUBCODE07, p.LONGDESCRIPTION FROM (
SELECT p2.ITEMTYPEAFICODE,p2.SUBCODE01,p2.SUBCODE02,p2.SUBCODE03,p2.SUBCODE04,
p2.SUBCODE05,p2.SUBCODE06,p2.SUBCODE07  FROM PRODUCTIONDEMAND p 
LEFT OUTER JOIN PRODUCTIONRESERVATION p2 ON p.CODE =p2.ORDERCODE 
WHERE p.ITEMTYPEAFICODE ='FKG' AND p.SUBCODE01='".trim($rowdb21FM['DECOSUBCODE01'])."' 
AND p.SUBCODE02 ='".trim($rowdb21FM['DECOSUBCODE02'])."' AND p.SUBCODE03 ='".trim($rowdb21FM['DECOSUBCODE03'])."' AND
p.SUBCODE04='".trim($rowdb21FM['DECOSUBCODE04'])."' AND (p.PROJECTCODE ='".trim($rowdb21FM['PROJECTCODE'])."' OR p.ORIGDLVSALORDLINESALORDERCODE  ='".trim($rowdb21FM['PROJECTCODE'])."')
) a LEFT OUTER JOIN PRODUCT p ON
p.ITEMTYPECODE ='GYR' AND
p.SUBCODE01= a.SUBCODE01 AND p.SUBCODE02= a.SUBCODE02 AND 
p.SUBCODE03= a.SUBCODE03 AND p.SUBCODE04= a.SUBCODE04 AND 
p.SUBCODE05= a.SUBCODE05 AND p.SUBCODE06= a.SUBCODE06 AND
p.SUBCODE07= a.SUBCODE07 
GROUP BY 
p.SUBCODE01,p.SUBCODE02, 
p.SUBCODE03,p.SUBCODE04,
p.SUBCODE05,p.SUBCODE06,
p.SUBCODE07,p.LONGDESCRIPTION ";
$stmt3FM   = db2_exec($conn1,$sqlDB23FM, array('cursor'=>DB2_SCROLLABLE));
$aiFM=0;
$aFM[0]="";
$aFM[1]="";
$aFM[2]="";
$aFM[3]="";		
while($rowdb23FM = db2_fetch_assoc($stmt3FM)){
	$aFM[$aiFM]=$rowdb23FM['LONGDESCRIPTION'];
	$aiFM++;
}		

$sqlDB28FM = " SELECT a.VALUEDECIMAL  FROM PRODUCT p 
LEFT OUTER JOIN ADSTORAGE a  ON a.UNIQUEID = p.ABSUNIQUEID 
WHERE p.SUBCODE01='".trim($rowdb21FM['DECOSUBCODE01'])."' AND
p.SUBCODE02='".trim($rowdb21FM['DECOSUBCODE02'])."' AND
p.SUBCODE03='".trim($rowdb21FM['DECOSUBCODE03'])."' AND
p.SUBCODE04='".trim($rowdb21FM['DECOSUBCODE04'])."' AND
a.NAMENAME ='Width' AND
p.ITEMTYPECODE ='FKF'  ";
$stmt8FM   = db2_exec($conn1,$sqlDB28FM, array('cursor'=>DB2_SCROLLABLE));
$rowdb28FM = db2_fetch_assoc($stmt8FM);	
$sqlDB29FM = " SELECT a.VALUEDECIMAL  FROM PRODUCT p 
LEFT OUTER JOIN ADSTORAGE a  ON a.UNIQUEID = p.ABSUNIQUEID 
WHERE p.SUBCODE01='".trim($rowdb21FM['DECOSUBCODE01'])."' AND
p.SUBCODE02='".trim($rowdb21FM['DECOSUBCODE02'])."' AND
p.SUBCODE03='".trim($rowdb21FM['DECOSUBCODE03'])."' AND
p.SUBCODE04='".trim($rowdb21FM['DECOSUBCODE04'])."' AND
a.NAMENAME ='GSM' AND
p.ITEMTYPECODE ='FKF'  ";
$stmt9FM   = db2_exec($conn1,$sqlDB29FM, array('cursor'=>DB2_SCROLLABLE));
$rowdb29FM = db2_fetch_assoc($stmt9FM);		
if($rowdb22F1M['LEGALNAME1']==""){$langgananFM="";}else{$langgananFM=$rowdb22F1M['LEGALNAME1'];}
if($rowdb22F1M['ORDERPARTNERBRANDCODE']==""){$buyerFM="";}else{$buyerFM=$rowdb22F1M['ORDERPARTNERBRANDCODE'];}

$query = "INSERT INTO dbnow_gkg.tblmasukkain (
tgl_masuk	
,buyer	
,customer	
,code	
,mesin_rajut	
,lebar_kj	
,gramasi_kj	
,jenis_kain	
,lot	
,benang1 
,benang2 
,benang3 
,benang4 
,qty	
,berat	
,blok	
,balance	
,userid	
,tgl_tutup 
,tgl_buat ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, )";

$params = [
	cek($rowdb21FM['TRANSACTIONDATE']),
	cek($buyerFM),
	cek($langgananFM),
	cek($itemcFM),
	cek($rowdb21FM['NOMESIN']),
	cek(round($rowdb28FM['VALUEDECIMAL'])),
	cek(round($rowdb29FM['VALUEDECIMAL'])),
	cek(str_replace("'","''",$rowdb21FM['SUMMARIZEDDESCRIPTION'])),
	cek($rowdb21FM['LOTCODE']),
	cek(str_replace("'","''",$aFM[0])),
	cek(str_replace("'","''",$aFM[1])),
	cek(str_replace("'","''",$aFM[2])),
	cek(str_replace("'","''",$aFM[3])),
	cek($rowdb21FM['JML']),
	cek($rowdb21FM['KG']),
	cek($rowdb21FM['WHSLOCATIONWAREHOUSEZONECODE']."-".$rowdb21FM['WAREHOUSELOCATIONCODE']),
	cek($rowdb22FM['WAREHOUSELOCATIONCODE']),
	cek($rowdb21FM['CREATIONUSER']),
	cek($Awal),
	date('Y-m-d H:i:s')
];

$simpanFM=sqlsrv_query($con, $query, $params) or die("GAGAL SIMPAN FLAT KNITT OPN");		
		
}				

//Add Stok Flat Knitt Maklun				
					  
	$sqlDB21AN = "  SELECT p.PROJECTCODE, p.ORIGDLVSALORDLINESALORDERCODE,s.PRODUCTIONORDERCODE,s.ORDERCODE,f.SUMMARIZEDDESCRIPTION,
s.TRANSACTIONDATE,s.DECOSUBCODE01,s.DECOSUBCODE02,s.DECOSUBCODE03,
s.DECOSUBCODE04,s.WHSLOCATIONWAREHOUSEZONECODE,s.WAREHOUSELOCATIONCODE,
s.LOTCODE,SUM(s.BASEPRIMARYQUANTITY) AS KG, COUNT(s.ITEMELEMENTCODE) AS JML,
s.CREATIONUSER FROM STOCKTRANSACTION s 
LEFT OUTER JOIN PRODUCTIONDEMAND p ON p.CODE = s.ORDERCODE 
LEFT OUTER JOIN FULLITEMKEYDECODER f ON s.FULLITEMIDENTIFIER = f.IDENTIFIER
WHERE s.TRANSACTIONDATE = '$Awal' AND s.ITEMTYPECODE='FKG' AND 
s.LOGICALWAREHOUSECODE ='M021' AND s.TEMPLATECODE = '110' 
GROUP BY p.PROJECTCODE,p.ORIGDLVSALORDLINESALORDERCODE,s.PRODUCTIONORDERCODE,s.ORDERCODE,
s.TRANSACTIONDATE,s.DECOSUBCODE01,s.DECOSUBCODE02,
s.DECOSUBCODE03, s.DECOSUBCODE04,
s.WHSLOCATIONWAREHOUSEZONECODE,
s.WAREHOUSELOCATIONCODE, s.LOTCODE, f.SUMMARIZEDDESCRIPTION, s.CREATIONUSER";
	$stmt1AN   = db2_exec($conn1,$sqlDB21AN, array('cursor'=>DB2_SCROLLABLE));
	//}				  
    while($rowdb21AN = db2_fetch_assoc($stmt1AN)){ 
$itemcAN=trim($rowdb21AN['DECOSUBCODE02'])."".trim($rowdb21AN['DECOSUBCODE03'])." ".trim($rowdb21AN['DECOSUBCODE04']);
if($rowdb21AN['PROJECTCODE']!=""){$proj=$rowdb21AN['PROJECTCODE'];}else{$proj=$rowdb21AN['ORIGDLVSALORDLINESALORDERCODE'];}		
		
$sqlDB22A1N = " SELECT SALESORDER.CODE, SALESORDER.EXTERNALREFERENCE, SALESORDER.ORDPRNCUSTOMERSUPPLIERCODE,
		ITXVIEWAKJ.LEGALNAME1, ITXVIEWAKJ.ORDERPARTNERBRANDCODE, ITXVIEWAKJ.LONGDESCRIPTION
		FROM DB2ADMIN.SALESORDER SALESORDER LEFT OUTER JOIN DB2ADMIN.ITXVIEWAKJ 
       	ITXVIEWAKJ ON SALESORDER.CODE=ITXVIEWAKJ.CODE
		WHERE SALESORDER.CODE='".trim($proj)."' ";
$stmt2A1N   = db2_exec($conn1,$sqlDB22A1N, array('cursor'=>DB2_SCROLLABLE));
$rowdb22A1N = db2_fetch_assoc($stmt2A1N);
		
$sqlDB22AN = " SELECT LISTAGG(DISTINCT  TRIM(BALANCE.WAREHOUSELOCATIONCODE),', ') AS WAREHOUSELOCATIONCODE, COUNT(BALANCE.BASEPRIMARYQUANTITYUNIT) AS ROL,SUM(BALANCE.BASEPRIMARYQUANTITYUNIT) AS BERAT,BALANCE.LOTCODE  
		FROM (
		SELECT 
s.ITEMELEMENTCODE  FROM STOCKTRANSACTION s 
LEFT OUTER JOIN ADSTORAGE a ON a.UNIQUEID = s.ABSUNIQUEID AND a.NAMENAME = 'StatusFlatKnitt'
WHERE s.PROJECTCODE='".$proj."' AND s.ITEMTYPECODE='FKG' AND 
s.DECOSUBCODE02='".$rowdb21AN['DECOSUBCODE02']."' AND s.DECOSUBCODE03='".$rowdb21AN['DECOSUBCODE03']."' AND 
s.DECOSUBCODE04='".$rowdb21AN['DECOSUBCODE04']."' AND s.LOGICALWAREHOUSECODE ='M021' AND
s.LOTCODE='$rowdb21AN[LOTCODE]' AND 
s.TEMPLATECODE = 'OPN' AND a.VALUESTRING =  '1'
GROUP BY 
s.ITEMELEMENTCODE
		) STOCKTRANSACTION LEFT OUTER JOIN 
		DB2ADMIN.BALANCE BALANCE ON BALANCE.ELEMENTSCODE =STOCKTRANSACTION.ITEMELEMENTCODE  
		GROUP BY BALANCE.LOTCODE ";					  
		$stmt2AN   = db2_exec($conn1,$sqlDB22AN, array('cursor'=>DB2_SCROLLABLE));	
		$rowdb22AN = db2_fetch_assoc($stmt2AN);
$sqlDB23AN = " SELECT p.SUBCODE01,p.SUBCODE02,p.SUBCODE03,p.SUBCODE04,p.SUBCODE05,p.SUBCODE06,p.SUBCODE07, p.LONGDESCRIPTION FROM (
SELECT p2.ITEMTYPEAFICODE,p2.SUBCODE01,p2.SUBCODE02,p2.SUBCODE03,p2.SUBCODE04,
p2.SUBCODE05,p2.SUBCODE06,p2.SUBCODE07  FROM PRODUCTIONDEMAND p 
LEFT OUTER JOIN PRODUCTIONRESERVATION p2 ON p.CODE =p2.ORDERCODE 
WHERE p.ITEMTYPEAFICODE ='KGF' AND p.SUBCODE01='".trim($rowdb21AN['DECOSUBCODE01'])."' 
AND p.SUBCODE02 ='".trim($rowdb21AN['DECOSUBCODE02'])."' AND p.SUBCODE03 ='".trim($rowdb21AN['DECOSUBCODE03'])."' AND
p.SUBCODE04='".trim($rowdb21AN['DECOSUBCODE04'])."' AND (p.PROJECTCODE ='".trim($proj)."' OR p.ORIGDLVSALORDLINESALORDERCODE  ='".trim($proj)."')
) a LEFT OUTER JOIN PRODUCT p ON
p.ITEMTYPECODE ='GYR' AND
p.SUBCODE01= a.SUBCODE01 AND p.SUBCODE02= a.SUBCODE02 AND 
p.SUBCODE03= a.SUBCODE03 AND p.SUBCODE04= a.SUBCODE04 AND 
p.SUBCODE05= a.SUBCODE05 AND p.SUBCODE06= a.SUBCODE06 AND
p.SUBCODE07= a.SUBCODE07 
GROUP BY 
p.SUBCODE01,p.SUBCODE02, 
p.SUBCODE03,p.SUBCODE04,
p.SUBCODE05,p.SUBCODE06,
p.SUBCODE07,p.LONGDESCRIPTION ";
$stmt3AN   = db2_exec($conn1,$sqlDB23AN, array('cursor'=>DB2_SCROLLABLE));
$aiAN=0;
$aAN[0]="";
$aAN[1]="";
$aAN[2]="";
$aAN[3]="";		
while($rowdb23AN = db2_fetch_assoc($stmt3AN)){
	$aAN[$aiAN]=$rowdb23AN['LONGDESCRIPTION'];
	$aiAN++;
}		
/*$sqlDB26R = " SELECT e.WIDTHGROSS AS LEBAR1,a.VALUEDECIMAL AS GSM1, e.DEMANDCODE  FROM ELEMENTSINSPECTION e 
LEFT OUTER JOIN ADSTORAGE a ON a.UNIQUEID =e.ABSUNIQUEID AND a.NAMENAME ='GSM'
WHERE e.ELEMENTITEMTYPECODE='KGF' AND e.DEMANDCODE='$rowdb21R[LOTCODE]'
GROUP BY e.WIDTHGROSS,a.VALUEDECIMAL,e.DEMANDCODE ";
$stmt6R   = db2_exec($conn1,$sqlDB26R, array('cursor'=>DB2_SCROLLABLE));
$rowdb26R = db2_fetch_assoc($stmt6R);*/

$sqlDB28AN = " SELECT a.VALUEDECIMAL  FROM PRODUCT p 
LEFT OUTER JOIN ADSTORAGE a  ON a.UNIQUEID = p.ABSUNIQUEID 
WHERE p.SUBCODE01='".trim($rowdb21AN['DECOSUBCODE01'])."' AND
p.SUBCODE02='".trim($rowdb21AN['DECOSUBCODE02'])."' AND
p.SUBCODE03='".trim($rowdb21AN['DECOSUBCODE03'])."' AND
p.SUBCODE04='".trim($rowdb21AN['DECOSUBCODE04'])."' AND
a.NAMENAME ='Width' AND
p.ITEMTYPECODE ='FKF'  ";
$stmt8AN   = db2_exec($conn1,$sqlDB28AN, array('cursor'=>DB2_SCROLLABLE));
$rowdb28AN = db2_fetch_assoc($stmt8AN);	
$sqlDB29AN = " SELECT a.VALUEDECIMAL  FROM PRODUCT p 
LEFT OUTER JOIN ADSTORAGE a  ON a.UNIQUEID = p.ABSUNIQUEID 
WHERE p.SUBCODE01='".trim($rowdb21AN['DECOSUBCODE01'])."' AND
p.SUBCODE02='".trim($rowdb21AN['DECOSUBCODE02'])."' AND
p.SUBCODE03='".trim($rowdb21AN['DECOSUBCODE03'])."' AND
p.SUBCODE04='".trim($rowdb21AN['DECOSUBCODE04'])."' AND
a.NAMENAME ='GSM' AND
p.ITEMTYPECODE ='FKF'  ";
$stmt9AN   = db2_exec($conn1,$sqlDB29AN, array('cursor'=>DB2_SCROLLABLE));
$rowdb29AN = db2_fetch_assoc($stmt9AN);		
if($rowdb22A1N['LEGALNAME1']==""){$langgananAN="";}else{$langgananAN=$rowdb22A1N['LEGALNAME1'];}
if($rowdb22A1N['ORDERPARTNERBRANDCODE']==""){$buyerAN="";}else{$buyerAN=$rowdb22A1N['ORDERPARTNERBRANDCODE'];}

$query = "INSERT INTO dbnow_gkg.tblmasukkain (
						tgl_masuk	
						,buyer	
						,customer	
						,code	
						,mesin_rajut	
						,lebar_kj	
						,gramasi_kj	
						,jenis_kain	
						,lot	
						,benang1 
						,benang2 
						,benang3 
						,benang4 
						,qty	
						,berat	
						,blok	
						,balance	
						,userid	
						,tgl_tutup 
						,tgl_buat ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$params = [
	cek($rowdb21AN['TRANSACTIONDATE']),
	cek($buyerAN),
	cek($langgananAN),
	cek($itemcAN),
	cek('maklun'),
	cek(round($rowdb28AN['VALUEDECIMAL'])),
	cek(round($rowdb29AN['VALUEDECIMAL'])),
	cek(str_replace("'", "''", $rowdb21AN['SUMMARIZEDDESCRIPTION'])),
	cek($rowdb21AN['LOTCODE']),
	cek(str_replace("'", "''", $aAN[0])),
	cek(str_replace("'", "''", $aAN[1])),
	cek(str_replace("'", "''", $aAN[2])),
	cek(str_replace("'", "''", $aAN[3])),
	cek($rowdb21AN['JML']),
	cek($rowdb21AN['KG']),
	cek($rowdb21AN['WHSLOCATIONWAREHOUSEZONECODE'] . "-" . $rowdb21AN['WAREHOUSELOCATIONCODE']),
	cek($rowdb21AN['WAREHOUSELOCATIONCODE']),
	cek($rowdb21AN['CREATIONUSER']),
	cek($Awal),
	date('Y-m-d H:i:s')
];

$simpanFMN=sqlsrv_query($con,$query, $params) or die("GAGAL SIMPAN FLAT KNITT MAKLUN");		
		
}				
	//Keluar Kain Greige
$sqlDB21K = " 
	SELECT 	 
	STOCKTRANSACTION.ORDERCODE,
	STOCKTRANSACTION.LOGICALWAREHOUSECODE,
	STOCKTRANSACTION.DECOSUBCODE01,
	STOCKTRANSACTION.DECOSUBCODE02,
	STOCKTRANSACTION.DECOSUBCODE03,
	STOCKTRANSACTION.DECOSUBCODE04,
	STOCKTRANSACTION.DECOSUBCODE05,
	STOCKTRANSACTION.DECOSUBCODE06,
	STOCKTRANSACTION.DECOSUBCODE07,
	STOCKTRANSACTION.DECOSUBCODE08,
	STOCKTRANSACTION.TRANSACTIONDATE,
	STOCKTRANSACTION.LOTCODE,
	STOCKTRANSACTION.CREATIONUSER,
	prj.PROJECTCODE AS PROJAWAL,
	COUNT(STOCKTRANSACTION.BASEPRIMARYQUANTITY) AS QTY_DUS,
	SUM(STOCKTRANSACTION.BASEPRIMARYQUANTITY) AS QTY_KG,
	ITXVIEWHEADERKNTORDER.ORIGDLVSALORDLINESALORDERCODE,
	ITXVIEWHEADERKNTORDER.PROJECTCODE,
	ITXVIEWHEADERKNTORDER.PRODUCTIONDEMANDCODE,
	ITXVIEWHEADERKNTORDER.LEGALNAME1,  
	FULLITEMKEYDECODER.SUMMARIZEDDESCRIPTION
	FROM DB2ADMIN.STOCKTRANSACTION STOCKTRANSACTION
	LEFT OUTER JOIN
	(SELECT 
	ITXVIEWHEADERKNTORDER.PRODUCTIONORDERCODE,
	LISTAGG(DISTINCT TRIM(ITXVIEWHEADERKNTORDER.ORIGDLVSALORDLINESALORDERCODE),', ') AS ORIGDLVSALORDLINESALORDERCODE,
	LISTAGG(DISTINCT  TRIM(ITXVIEWHEADERKNTORDER.PRODUCTIONDEMANDCODE),', ') AS PRODUCTIONDEMANDCODE,
	LISTAGG(DISTINCT TRIM(ITXVIEWHEADERKNTORDER.PROJECTCODE),', ') AS PROJECTCODE,
	LISTAGG(DISTINCT TRIM(ITXVIEWHEADERKNTORDER.LEGALNAME1),', ') AS LEGALNAME1 FROM 
DB2ADMIN.ITXVIEWHEADERKNTORDER
GROUP BY ITXVIEWHEADERKNTORDER.PRODUCTIONORDERCODE) ITXVIEWHEADERKNTORDER
	 ON ITXVIEWHEADERKNTORDER.PRODUCTIONORDERCODE =STOCKTRANSACTION.ORDERCODE 
	LEFT OUTER JOIN DB2ADMIN.FULLITEMKEYDECODER FULLITEMKEYDECODER ON
    STOCKTRANSACTION.FULLITEMIDENTIFIER = FULLITEMKEYDECODER.IDENTIFIER
LEFT OUTER JOIN (
SELECT
    STOCKTRANSACTION.ORDERCODE,
    STOCKTRANSACTION.ORDERLINE,
    STOCKTRANSACTION.ITEMELEMENTCODE,
    ITXVIEWBUKMUTGKGKNT.PROJECTCODE
FROM
    STOCKTRANSACTION STOCKTRANSACTION
LEFT JOIN INTERNALDOCUMENTLINE INTERNALDOCUMENTLINE 
ON
    STOCKTRANSACTION.ORDERCODE = INTERNALDOCUMENTLINE.INTDOCUMENTPROVISIONALCODE
    AND 
STOCKTRANSACTION.ORDERLINE = INTERNALDOCUMENTLINE.ORDERLINE
LEFT JOIN ITXVIEWBUKMUTGKGKNT ITXVIEWBUKMUTGKGKNT 
ON
    INTERNALDOCUMENTLINE.INTDOCUMENTPROVISIONALCODE = ITXVIEWBUKMUTGKGKNT.INTDOCUMENTPROVISIONALCODE
    AND 
INTERNALDOCUMENTLINE.ORDERLINE = ITXVIEWBUKMUTGKGKNT.ORDERLINE
WHERE
    STOCKTRANSACTION.ORDERCOUNTERCODE = 'I02M50' 
GROUP BY
    STOCKTRANSACTION.ORDERCODE,
    STOCKTRANSACTION.ORDERLINE,
    STOCKTRANSACTION.ITEMELEMENTCODE,
    ITXVIEWBUKMUTGKGKNT.PROJECTCODE) prj ON prj.ITEMELEMENTCODE = STOCKTRANSACTION.ITEMELEMENTCODE	
WHERE (STOCKTRANSACTION.ITEMTYPECODE ='KGF' OR STOCKTRANSACTION.ITEMTYPECODE ='FKG') and STOCKTRANSACTION.LOGICALWAREHOUSECODE ='M021' AND
STOCKTRANSACTION.ONHANDUPDATE > 1 AND TRANSACTIONDATE='$Awal' AND NOT STOCKTRANSACTION.ORDERCODE IS NULL 
GROUP BY
	STOCKTRANSACTION.ORDERCODE,
	STOCKTRANSACTION.LOGICALWAREHOUSECODE,
	STOCKTRANSACTION.DECOSUBCODE01,
	STOCKTRANSACTION.DECOSUBCODE02,
	STOCKTRANSACTION.DECOSUBCODE03,
	STOCKTRANSACTION.DECOSUBCODE04,
	STOCKTRANSACTION.DECOSUBCODE05,
	STOCKTRANSACTION.DECOSUBCODE06,
	STOCKTRANSACTION.DECOSUBCODE07,
	STOCKTRANSACTION.DECOSUBCODE08,
	STOCKTRANSACTION.TRANSACTIONDATE,
	STOCKTRANSACTION.LOTCODE,
	STOCKTRANSACTION.CREATIONUSER,
	prj.PROJECTCODE,
	ITXVIEWHEADERKNTORDER.ORIGDLVSALORDLINESALORDERCODE,
	ITXVIEWHEADERKNTORDER.PROJECTCODE,
	ITXVIEWHEADERKNTORDER.PRODUCTIONDEMANDCODE,
	ITXVIEWHEADERKNTORDER.LEGALNAME1,
	FULLITEMKEYDECODER.SUMMARIZEDDESCRIPTION
";
	$stmt1K   = db2_exec($conn1,$sqlDB21K, array('cursor'=>DB2_SCROLLABLE));
	//}				  
    while($rowdb21K = db2_fetch_assoc($stmt1K)){ 
if ($rowdb21K['LOGICALWAREHOUSECODE'] =='M904') { $knittK = 'LT2'; }
else if($rowdb21K['LOGICALWAREHOUSECODE'] ='P501'){ $knittK = 'LT1'; }
if($rowdb21K['PROJECTCODE']!=""){$projectK=$rowdb21K['PROJECTCODE'];}else{$projectK=substr($rowdb21K['ORIGDLVSALORDLINESALORDERCODE'],0,10);}		
$kdbenangK=trim($rowdb21K['DECOSUBCODE01'])." ".trim($rowdb21K['DECOSUBCODE02'])." ".trim($rowdb21K['DECOSUBCODE03'])." ".trim($rowdb21K['DECOSUBCODE04'])." ".trim($rowdb21K['DECOSUBCODE05'])." ".trim($rowdb21K['DECOSUBCODE06'])." ".trim($rowdb21K['DECOSUBCODE07'])." ".trim($rowdb21K['DECOSUBCODE08']);
$sqlDB22K = " SELECT SALESORDER.CODE, SALESORDER.EXTERNALREFERENCE, SALESORDER.ORDPRNCUSTOMERSUPPLIERCODE,
		ITXVIEWAKJ.LEGALNAME1, ITXVIEWAKJ.ORDERPARTNERBRANDCODE, ITXVIEWAKJ.LONGDESCRIPTION
		FROM DB2ADMIN.SALESORDER SALESORDER LEFT OUTER JOIN DB2ADMIN.ITXVIEWAKJ 
       	ITXVIEWAKJ ON SALESORDER.CODE=ITXVIEWAKJ.CODE
		WHERE SALESORDER.CODE='$projectK' ";
$stmt2K   = db2_exec($conn1,$sqlDB22K, array('cursor'=>DB2_SCROLLABLE));
$rowdb22K = db2_fetch_assoc($stmt2K);
if(strlen(trim($rowdb21K['LOTCODE']))=="8"){$WlotK=" AND ( p.PROJECTCODE ='".trim($rowdb21K['PROJAWAL'])."' OR p.ORIGDLVSALORDLINESALORDERCODE ='".trim($rowdb21K['PROJAWAL'])."' OR p.CODE='".trim($rowdb21K['LOTCODE'])."' ) ";}
else{$WlotK=" AND ( p.PROJECTCODE ='".trim($projectK)."' OR p.ORIGDLVSALORDLINESALORDERCODE ='".trim($projectK)."' ) ";}		

$sqlDB23K = " SELECT p.SUBCODE01,p.SUBCODE02,p.SUBCODE03,p.SUBCODE04,p.SUBCODE05,p.SUBCODE06,p.SUBCODE07, p.LONGDESCRIPTION FROM (
SELECT p2.ITEMTYPEAFICODE,p2.SUBCODE01,p2.SUBCODE02,p2.SUBCODE03,p2.SUBCODE04,
p2.SUBCODE05,p2.SUBCODE06,p2.SUBCODE07  FROM PRODUCTIONDEMAND p 
LEFT OUTER JOIN PRODUCTIONRESERVATION p2 ON p.CODE =p2.ORDERCODE 
WHERE p.ITEMTYPEAFICODE ='KGF' AND p.SUBCODE01='".trim($rowdb21K['DECOSUBCODE01'])."' 
AND p.SUBCODE02 ='".trim($rowdb21K['DECOSUBCODE02'])."' AND p.SUBCODE03 ='".trim($rowdb21K['DECOSUBCODE03'])."' AND
p.SUBCODE04='".trim($rowdb21K['DECOSUBCODE04'])."' $WlotK 
) a LEFT OUTER JOIN PRODUCT p ON
p.ITEMTYPECODE ='GYR' AND
p.SUBCODE01= a.SUBCODE01 AND p.SUBCODE02= a.SUBCODE02 AND 
p.SUBCODE03= a.SUBCODE03 AND p.SUBCODE04= a.SUBCODE04 AND 
p.SUBCODE05= a.SUBCODE05 AND p.SUBCODE06= a.SUBCODE06 AND
p.SUBCODE07= a.SUBCODE07 
GROUP BY 
p.SUBCODE01,p.SUBCODE02, 
p.SUBCODE03,p.SUBCODE04,
p.SUBCODE05,p.SUBCODE06,
p.SUBCODE07,p.LONGDESCRIPTION ";
$stmt3K   = db2_exec($conn1,$sqlDB23K, array('cursor'=>DB2_SCROLLABLE));
$aiK=0;
$aK[0]="";$aK[1]="";$aK[2]="";$aK[3]="";		
while($rowdb23K = db2_fetch_assoc($stmt3K)){
	$aK[$aiK]=$rowdb23K['LONGDESCRIPTION'];
	$aiK++;
}
$sqlDB24K = " 
SELECT ugp.LONGDESCRIPTION AS WARNA,pr.LONGDESCRIPTION,p.PRODUCTIONORDERCODE,pd.SUBCODE01,pd.SUBCODE02,pd.SUBCODE03,
	pd.SUBCODE04,pd.SUBCODE05,pd.SUBCODE06,pd.SUBCODE07,pd.SUBCODE08,pd.INTERNALREFERENCE,
	LISTAGG(DISTINCT  TRIM(pd.CODE),', ') AS PRODUCTIONDEMANDCODE
	FROM PRODUCTIONDEMANDSTEP p
	LEFT OUTER JOIN PRODUCTIONDEMAND pd ON pd.CODE =p.PRODUCTIONDEMANDCODE
	LEFT JOIN PRODUCT pr ON
    pr.ITEMTYPECODE = pd.ITEMTYPEAFICODE
    AND pr.SUBCODE01 = pd.SUBCODE01
    AND pr.SUBCODE02 = pd.SUBCODE02
    AND pr.SUBCODE03 = pd.SUBCODE03
    AND pr.SUBCODE04 = pd.SUBCODE04
    AND pr.SUBCODE05 = pd.SUBCODE05
    AND pr.SUBCODE06 = pd.SUBCODE06
    AND pr.SUBCODE07 = pd.SUBCODE07
    AND pr.SUBCODE08 = pd.SUBCODE08
    AND pr.SUBCODE09 = pd.SUBCODE09
    AND pr.SUBCODE10 = pd.SUBCODE10
	LEFT JOIN DB2ADMIN.USERGENERICGROUP ugp ON
    pd.SUBCODE05 = ugp.CODE
WHERE (pd.PROJECTCODE ='$projectK' OR pd.ORIGDLVSALORDLINESALORDERCODE ='$projectK') AND p.PRODUCTIONORDERCODE='$rowdb21K[ORDERCODE]'	
	GROUP BY pr.LONGDESCRIPTION,p.PRODUCTIONORDERCODE,pd.SUBCODE01,pd.SUBCODE02,pd.SUBCODE03,
	pd.SUBCODE04,pd.SUBCODE05,pd.SUBCODE06,pd.SUBCODE07,pd.SUBCODE08,pd.INTERNALREFERENCE,ugp.LONGDESCRIPTION ";
$stmt4K   = db2_exec($conn1,$sqlDB24K, array('cursor'=>DB2_SCROLLABLE));
$rowdb24K = db2_fetch_assoc($stmt4K);
		
$sqlDB25K = " 
SELECT CASE WHEN PROJECTCODE <> '' THEN PROJECTCODE ELSE ORIGDLVSALORDLINESALORDERCODE  END  AS PROJECT FROM PRODUCTIONDEMAND WHERE CODE='".$rowdb21K['LOTCODE']."'
";
$stmt5K   = db2_exec($conn1,$sqlDB25K, array('cursor'=>DB2_SCROLLABLE));
$rowdb25K = db2_fetch_assoc($stmt5K);		
		
	if($rowdb22K['LEGALNAME1']==""){$langgananK="";}else{$langgananK=$rowdb22K['LEGALNAME1'];}
	if($rowdb22K['ORDERPARTNERBRANDCODE']==""){$buyerK="";}else{$buyerK=$rowdb22K['ORDERPARTNERBRANDCODE'];}
	if($rowdb21K['PROJECTCODE']!=""){$projK=$rowdb21K['PROJECTCODE'];}else{$projK=$rowdb21K['ORIGDLVSALORDLINESALORDERCODE'];}
	if($rowdb21K['PROJAWAL']!=""){$projAk=$rowdb21K['PROJAWAL'];}else if($rowdb25K['PROJECT']!=""){$projAk=$rowdb25K['PROJECT'];}else{$projAk=$rowdb24K['INTERNALREFERENCE'];}
	if($rowdb24K['PRODUCTIONDEMANDCODE']!=""){$demandK=$rowdb24K['PRODUCTIONDEMANDCODE'];}else{$demandK=$rowdb21K['PRODUCTIONDEMANDCODE'];}	
		
$query = "INSERT INTO dbnow_gkg.tblkeluarkain (
			tglkeluar 
			,buyer 
			,custumer 
			,projectcode 
			,prod_order 
			,demand 
			,code 
			,lot 
			,benang1 
			,benang2 
			,benang3 
			,benang4 
			,warna 
			,jenis_kain 
			,qty 
			,berat 
			,proj_awal 
			,userid	
			,tgl_tutup 
			,tgl_buat ) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

			$params = [
				cek($rowdb21K['TRANSACTIONDATE']),
				cek($buyerK),
				cek($langgananK),
				cek($projK),
				cek($rowdb21K['ORDERCODE']),
				cek($demandK),
				cek($kdbenangK),
				cek($rowdb21K['LOTCODE']),
				cek(str_replace("'","''",$aK[0])),
				cek(str_replace("'","''",$aK[1])),
				cek(str_replace("'","''",$aK[2])),
				cek(str_replace("'","''",$aK[3])),
				cek(str_replace("'","''",$rowdb24K['WARNA'])),
				cek(str_replace("'","''",$rowdb21K['SUMMARIZEDDESCRIPTION'])),
				cek($rowdb21K['QTY_DUS']),
				cek($rowdb21K['QTY_KG']),
				cek($projAk),
				cek($rowdb21K['CREATIONUSER']),
				cek($Awal),
				date('Y-m-d H:i:s')
			];

$simpanK=sqlsrv_query($con,$query, $params) or die("GAGAL SIMPAN TRANSAKSI KELUAR");
		
}
 // Permintaan Potong , Tarikan , hapus stok
$sqlDB21P = "SELECT
				s.CREATIONUSER,
				s.TRANSACTIONDATE,
				s.DECOSUBCODE02,
				s.DECOSUBCODE03,
				s.DECOSUBCODE04,
				s.LOTCODE,
				sum(s.BASEPRIMARYQUANTITY) AS KG,
				count(s.ITEMELEMENTCODE) AS JML,
				a.VALUESTRING AS PTG,
				a1.VALUESTRING AS NOTE,
				s.PROJECTCODE
			FROM
				STOCKTRANSACTION s
			LEFT OUTER JOIN ADSTORAGE a ON
				a.UNIQUEID = s.ABSUNIQUEID
				AND a.NAMENAME = 'StatusPotong'
			LEFT OUTER JOIN ADSTORAGE a1 ON
				a1.UNIQUEID = s.ABSUNIQUEID
				AND a1.NAMENAME = 'NoteMintaPotong'
			WHERE
				s.ITEMTYPECODE = 'KGF'
				AND s.LOGICALWAREHOUSECODE = 'M021'
				AND (a.VALUESTRING = '1'
					OR a.VALUESTRING = '2'
					OR a.VALUESTRING = '3')
				AND
			s.TEMPLATECODE = '098'
				AND s.TRANSACTIONDATE = '$Awal'
			GROUP BY
				s.TRANSACTIONDATE,
				s.DECOSUBCODE02,
				s.DECOSUBCODE03,
				s.DECOSUBCODE04,
				s.LOTCODE,
				s.CREATIONUSER,
				a.VALUESTRING,
				a1.VALUESTRING,
				s.PROJECTCODE";
	$stmt1P   = db2_exec($conn1,$sqlDB21P, array('cursor'=>DB2_SCROLLABLE));
    while($rowdb21P = db2_fetch_assoc($stmt1P)){ 
if ($rowdb21P['LOGICALWAREHOUSECODE'] =='M904') { $knittP = 'LT2'; }
else if($rowdb21P['LOGICALWAREHOUSECODE'] ='P501'){ $knittP = 'LT1'; }
if($rowdb21P['PROJECTCODE']!=""){$projectP=$rowdb21P['PROJECTCODE'];}else{$projectP=$rowdb21P['ORIGDLVSALORDLINESALORDERCODE'];}		
$kdbenangP=trim($rowdb21P['DECOSUBCODE01'])." ".trim($rowdb21P['DECOSUBCODE02'])." ".trim($rowdb21P['DECOSUBCODE03'])." ".trim($rowdb21P['DECOSUBCODE04'])." ".trim($rowdb21P['DECOSUBCODE05'])." ".trim($rowdb21P['DECOSUBCODE06'])." ".trim($rowdb21P['DECOSUBCODE07'])." ".trim($rowdb21P['DECOSUBCODE08']);
$sqlDB22P = "SELECT
				SALESORDER.CODE
				,
				SALESORDER.EXTERNALREFERENCE
				,
				SALESORDER.ORDPRNCUSTOMERSUPPLIERCODE
				,
				ITXVIEWAKJ.LEGALNAME1
				,
				ITXVIEWAKJ.ORDERPARTNERBRANDCODE
				,
				ITXVIEWAKJ.LONGDESCRIPTION
			FROM
				DB2ADMIN.SALESORDER SALESORDER
			LEFT OUTER JOIN DB2ADMIN.ITXVIEWAKJ ITXVIEWAKJ
			ON
				SALESORDER.CODE = ITXVIEWAKJ.CODE
			WHERE
				SALESORDER.CODE = '$projectP'";
$stmt2P   = db2_exec($conn1,$sqlDB22P, array('cursor'=>DB2_SCROLLABLE));
$rowdb22P = db2_fetch_assoc($stmt2P);
if(strlen(trim($rowdb21P['LOTCODE']))=="8"){$WlotP=" AND ( p.PROJECTCODE ='".trim($rowdb21P['PROJAWAL'])."' OR p.ORIGDLVSALORDLINESALORDERCODE ='".trim($rowdb21P['PROJAWAL'])."' OR p.CODE='".trim($rowdb21P['LOTCODE'])."' ) ";}
else{$WlotP=" AND ( p.PROJECTCODE ='".trim($projectP)."' OR p.ORIGDLVSALORDLINESALORDERCODE ='".trim($projectP)."' ) ";}

$sqlDB24P = " SELECT
				pr.LONGDESCRIPTION,
				p.PRODUCTIONORDERCODE,
				pd.SUBCODE01,
				pd.SUBCODE02,
				pd.SUBCODE03,
				pd.SUBCODE04,
				pd.SUBCODE05,
				pd.SUBCODE06,
				pd.SUBCODE07,
				pd.SUBCODE08,
				pd.INTERNALREFERENCE,
				LISTAGG(DISTINCT TRIM(pd.CODE),
				', ') AS PRODUCTIONDEMANDCODE
			FROM
				PRODUCTIONDEMANDSTEP p
			LEFT OUTER JOIN PRODUCTIONDEMAND pd ON
				pd.CODE = p.PRODUCTIONDEMANDCODE
			LEFT JOIN PRODUCT pr ON
				pr.ITEMTYPECODE = pd.ITEMTYPEAFICODE
				AND pr.SUBCODE01 = pd.SUBCODE01
				AND pr.SUBCODE02 = pd.SUBCODE02
				AND pr.SUBCODE03 = pd.SUBCODE03
				AND pr.SUBCODE04 = pd.SUBCODE04
				AND pr.SUBCODE05 = pd.SUBCODE05
				AND pr.SUBCODE06 = pd.SUBCODE06
				AND pr.SUBCODE07 = pd.SUBCODE07
				AND pr.SUBCODE08 = pd.SUBCODE08
				AND pr.SUBCODE09 = pd.SUBCODE09
				AND pr.SUBCODE10 = pd.SUBCODE10
			WHERE
				(pd.PROJECTCODE = '$projectP'
					OR pd.ORIGDLVSALORDLINESALORDERCODE = '$projectP')
				AND p.PRODUCTIONORDERCODE = '$rowdb21P[ORDERCODE]'
			GROUP BY
				pr.LONGDESCRIPTION,
				p.PRODUCTIONORDERCODE,
				pd.SUBCODE01,
				pd.SUBCODE02,
				pd.SUBCODE03,
				pd.SUBCODE04,
				pd.SUBCODE05,
				pd.SUBCODE06,
				pd.SUBCODE07,
				pd.SUBCODE08,
				pd.INTERNALREFERENCE";
$stmt4P   = db2_exec($conn1,$sqlDB24P, array('cursor'=>DB2_SCROLLABLE));
$rowdb24P = db2_fetch_assoc($stmt4P);
		
$sqlDB25P = " SELECT
				CASE
					WHEN PROJECTCODE <> '' THEN PROJECTCODE
					ELSE ORIGDLVSALORDLINESALORDERCODE
				END AS PROJECT
			FROM
				PRODUCTIONDEMAND
			WHERE
				CODE = '".$rowdb21P[' LOTCODE']."'
			";
$stmt5P   = db2_exec($conn1,$sqlDB25P, array('cursor'=>DB2_SCROLLABLE));
$rowdb25P = db2_fetch_assoc($stmt5P);		
		
	if($rowdb22P['LEGALNAME1']==""){$langgananP="";}else{$langgananP=$rowdb22P['LEGALNAME1'];}
	if($rowdb22P['ORDERPARTNERBRANDCODE']==""){$buyerP="";}else{$buyerP=$rowdb22P['ORDERPARTNERBRANDCODE'];}
	if($rowdb21P['PROJAWAL']!=""){$prjAP=$rowdb21P['PROJAWAL'];}else if($rowdb25P['PROJECT']!=""){$prjAP=$rowdb25P['PROJECT'];}else{$prjAP=$rowdb24P['INTERNALREFERENCE'];}	
	
	$query = "INSERT INTO dbnow_gkg.tblkeluarkain ( tglkeluar, buyer, custumer, projectcode, code, lot, ket, qty, berat, proj_awal, userid, tgl_tutup, tgl_buat )
VALUES
	( ?,
		?,
		?,
		?,
		?,
		?,
		?,
		?,
		?,
		?,
		?,
	?,
	? )";


	$params = [
		cek($rowdb21P['TRANSACTIONDATE']),
		cek($buyerP),
		cek($langgananP),
		cek($projectP),
		cek($kdbenangP),
		cek($rowdb21P['LOTCODE']),
		cek(str_replace("'", "''", $rowdb21P['NOTE'])),
		cek($rowdb21P['JML']),
		cek($rowdb21P['KG']),
		cek($prjAP),
		cek($rowdb21P['CREATIONUSER']),
		cek($Awal),
		date('Y-m-d H:i:s')
	];

	$simpanP=sqlsrv_query($con,$query, $params) or die("GAGAL SIMPAN PERMINTAAN POTONG");	
}
		
		echo "<script>";
		echo "alert('Stok Tgl ".$Awal." Sudah ditutup')";
		echo "</script>";
        echo "<meta http-equiv='refresh' content='0; url=TutupInOutHarian'>";
 }
}
?>