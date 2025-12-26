<?php

include "../utils/helper.php";

$Awal	= isset($_POST['tgl_awal']) ? $_POST['tgl_awal'] : '';
?>

<!-- Main content -->
      <div class="container-fluid">
		<form role="form" method="post" enctype="multipart/form-data" name="form1">  
		<div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Filter Tgl Tutup Persediaan Kain Greige</h3>

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
			
		<div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Detail Data Persediaan Kain Greige Perhari</h3>				 
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
$sql = sqlsrv_query($con," SELECT TOP 60 
											tgl_tutup, 
											SUM(rol) AS rol, 
											SUM(weight) AS kg, 
											CONVERT(DATE, GETDATE()) AS tgl 
										FROM 
											dbnow_gkg.tblopname 
										GROUP BY 
											tgl_tutup 
										ORDER BY 
											tgl_tutup DESC;
										");		  
    while($r = sqlsrv_fetch_array($sql)){
?>
	  <tr>
	  <td style="text-align: center"><?php echo $no;?></td>
	  <td style="text-align: center"><a href="DetailOpname-<?php echo cek($r['tgl_tutup']);?>" class="btn btn-info btn-xs" target="_blank"> <i class="fa fa-link"></i> Lihat Data</a></td>
	  <td style="text-align: center"><?php echo cek($r['tgl_tutup']);?></td>
      <td style="text-align: center"><?php echo $r['rol'];?></td>
      <td style="text-align: right"><?php echo number_format($r['kg'],3);?></td>
      <td style="text-align: center"><a href="#" class="btn btn-xs btn-danger <?php if(cek($r['tgl'])==cek($r['tgl_tutup'])){ }else{echo"disabled";} ?>" onclick="confirm_delete('DelOpname-<?php echo cek($r['tgl_tutup']); ?>');" ><small class="fas fa-trash"> </small> Hapus</a></td>
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
	</form>		
      </div><!-- /.container-fluid -->
    <!-- /.content -->
<div class="modal fade" id="delOpname" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content" style="margin-top:100px;">
                  <div class="modal-header">
					<h4 class="modal-title">INFOMATION</h4>  
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    
                  </div>
					<div class="modal-body">
						<h5 class="modal-title" style="text-align:center;">Are you sure to delete this information ?</h5>
					</div>	
                  <div class="modal-footer justify-content-between">
                    <a href="#" class="btn btn-danger" id="delete_link">Delete</a>
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
              function confirm_delete(delete_url) {
                $('#delOpname').modal('show', {
                  backdrop: 'static'
                });
                document.getElementById('delete_link').setAttribute('href', delete_url);
              }
</script>
<?php	
if(isset($_POST['submit'])){

//$cektgl=sqlsrv_query($con,"SELECT 
//											FORMAT(GETDATE(), 'yyyy-MM-dd') AS tgl, 
//											COUNT(tgl_tutup) AS ck, 
//											DATEPART(HOUR, GETDATE()) AS jam, 
//											FORMAT(GETDATE(), 'HH:mm') AS jam1 
//										FROM 
//											dbnow_gkg.tblopname 
//										WHERE 
//											tgl_tutup = '$Awal' 
//										GROUP BY 
//											tgl_tutup;
//										");
$cektgl=sqlsrv_query($con,"SELECT
    CONVERT(VARCHAR, GETDATE(), 23) AS tgl,
    COALESCE(COUNT(t.tgl_tutup), 0) AS ck,
    FORMAT(GETDATE(), 'HH') AS jam,
    FORMAT(GETDATE(), 'HH:mm') AS jam1
FROM
    (SELECT '$Awal' AS tgl_tutup) AS target_date
LEFT JOIN
    dbnow_gkg.tblopname t ON t.tgl_tutup = target_date.tgl_tutup
GROUP BY
    target_date.tgl_tutup;
	");
$dcek=sqlsrv_fetch_array($cektgl);
$t1=strtotime($Awal);
$t2=strtotime($dcek['tgl']);
$selh=round(abs($t2-$t1)/(60*60*45));

// ECHO $Awal.'M'; ECHO $dcek['tgl'];

	if($dcek['ck']>0){
		//echo "<script>";
			//echo "alert('Stok Tgl ".$Awal." Ini Sudah Pernah ditutup')";
			//echo "</script>";
			echo "<script>
						$(function() {
						toastr.error('Stok Tgl ".$Awal." Ini Sudah Pernah ditutup')
					});
					
					</script>";
			// Refresh form
			// echo "<meta http-equiv='refresh' content='0; url=index1.php?p=data-stok-kj'>";
	}else if($Awal > $dcek['tgl']){
		//echo "<script>";
		//echo "alert('Tanggal Lebih dari $selh hari')";
		//echo "</script>";

		if($dcek['tgl']){
			echo "<script>
					$(function() {
					toastr.error('Tanggal Lebih dari $selh hari')
				});
				
				</script>";
		}
		
		// Refresh form
		// echo "<meta http-equiv='refresh' content='0; url=index1.php?p=data-stok-kj'>";
	}else if($Awal < $dcek['tgl']){
		//echo "<script>";
		//echo "alert('Tanggal Kurang dari $selh hari')";
		//echo "</script>";
		echo "<script>
  		$(function() {
    		toastr.error('Tanggal Kurang dari $selh hari')
  		});  
  		</script>";
		// Refresh form
		// echo "<meta http-equiv='refresh' content='0; url=index1.php?p=data-stok-kj'>";
	}else if($dcek['jam'] < 10){
		//echo "<script>";
		//echo "alert('Tidak Bisa Tutup Sebelum jam 6 Pagi Sampai jam 12 Malam, Sekarang Masih Jam ".$dcek['jam1']."')";
		//echo "</script>";
		echo "<script>
  		$(function() {
    		toastr.error('Tidak Bisa Tutup Sebelum jam 9 Malam Sampai jam 12 Malam, Sekarang Masih Jam ".$dcek['jam1']."')
  		});  
  		</script>";
		// Refresh form
		// echo "<meta http-equiv='refresh' content='0; url=index1.php?p=data-stok-kj'>";
			}
			else{	
	
		$sqlDB21 = "SELECT
						SUM(b.BASEPRIMARYQUANTITYUNIT) AS BERAT,
						SUM(b.BASESECONDARYQUANTITYUNIT) AS YD,
						COUNT(b.BASESECONDARYQUANTITYUNIT) AS ROLL,
						b.LOTCODE,
						b.PROJECTCODE,
						b.ITEMTYPECODE,
						b.DECOSUBCODE01,
						b.DECOSUBCODE02,
						b.DECOSUBCODE03,
						b.DECOSUBCODE04,
						b.DECOSUBCODE05,
						b.DECOSUBCODE06,
						b.DECOSUBCODE07,
						b.DECOSUBCODE08,
						b.BASEPRIMARYUNITCODE,
						b.BASESECONDARYUNITCODE,
						b.WHSLOCATIONWAREHOUSEZONECODE,
						b.WAREHOUSELOCATIONCODE,
						prj.PROJECTCODE AS PROJAWAL,
						prj1.PROJECTCODE AS PROJAWAL1
					FROM
						BALANCE b
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
							ITXVIEWBUKMUTGKGKNT.PROJECTCODE) prj ON
						b.ELEMENTSCODE = prj.ITEMELEMENTCODE
					LEFT OUTER JOIN (
						SELECT
							STOCKTRANSACTION.ORDERCODE,
							STOCKTRANSACTION.ORDERLINE,
							STOCKTRANSACTION.ITEMELEMENTCODE,
							STOCKTRANSACTION.PROJECTCODE
						FROM
							STOCKTRANSACTION STOCKTRANSACTION
						WHERE
							STOCKTRANSACTION.TEMPLATECODE = 'OPN'
							AND STOCKTRANSACTION.ITEMTYPECODE = 'KGF'
						GROUP BY
							STOCKTRANSACTION.ORDERCODE,
							STOCKTRANSACTION.ORDERLINE,
							STOCKTRANSACTION.ITEMELEMENTCODE,
							STOCKTRANSACTION.PROJECTCODE) prj1 ON
						b.ELEMENTSCODE = prj1.ITEMELEMENTCODE
					WHERE
						(b.ITEMTYPECODE = 'FKG'
							OR b.ITEMTYPECODE = 'KGF')
						AND b.LOGICALWAREHOUSECODE = 'M021'
					GROUP BY
						b.ITEMTYPECODE,
						b.DECOSUBCODE01,
						b.DECOSUBCODE02,
						b.DECOSUBCODE03,
						b.DECOSUBCODE04,
						b.DECOSUBCODE05,
						b.DECOSUBCODE06,
						b.DECOSUBCODE07,
						b.DECOSUBCODE08,
						b.PROJECTCODE,
						b.LOTCODE,
						b.BASEPRIMARYUNITCODE,
						b.BASESECONDARYUNITCODE,
						b.WHSLOCATIONWAREHOUSEZONECODE,
						b.WAREHOUSELOCATIONCODE,
						prj.PROJECTCODE,
						prj1.PROJECTCODE";
//		$stmt1   = db2_exec($conn1,$sqlDB21, array('cursor'=>DB2_SCROLLABLE));
		$stmt1   = db2_prepare($conn1,$sqlDB21);
		db2_execute($stmt1);		
	//}				  
    while($rowdb21 = db2_fetch_assoc($stmt1)){
	$itemNo=trim($rowdb21['DECOSUBCODE02'])."".trim($rowdb21['DECOSUBCODE03'])." ".trim($rowdb21['DECOSUBCODE04']);
	if($rowdb21['ITEMTYPECODE']=="KGF"){$jns="KAIN";}else if($rowdb21['ITEMTYPECODE']=="FKG"){$jns="KRAH";}
	if($rowdb21['PROJAWAL']!=""){
		$proj=$rowdb21['PROJAWAL'];}
	else if($rowdb21['PROJAWAL1']!=""){
		$proj=$rowdb21['PROJAWAL1'];}
	else if($rowdb27['PROJECTCODE']!=""){ 
		$proj=$rowdb27['PROJECTCODE']; }
	else if($rowdb27['ORIGDLVSALORDLINESALORDERCODE']!=""){ 
		$proj=$rowdb27['ORIGDLVSALORDLINESALORDERCODE']; }
	else{ 
		$proj=$rowdb21['LOTCODE']; }	
	$sqlDB22 = " SELECT SALESORDER.CODE, SALESORDER.EXTERNALREFERENCE, SALESORDER.ORDPRNCUSTOMERSUPPLIERCODE,
		ITXVIEWAKJ.LEGALNAME1, ITXVIEWAKJ.ORDERPARTNERBRANDCODE, ITXVIEWAKJ.LONGDESCRIPTION
		FROM DB2ADMIN.SALESORDER SALESORDER LEFT OUTER JOIN DB2ADMIN.ITXVIEWAKJ 
       	ITXVIEWAKJ ON SALESORDER.CODE=ITXVIEWAKJ.CODE
		WHERE SALESORDER.CODE='$rowdb21[PROJECTCODE]' ";
//	$stmt2   = db2_exec($conn1,$sqlDB22, array('cursor'=>DB2_SCROLLABLE));
	$stmt2   = db2_prepare($conn1,$sqlDB22);
	db2_execute($stmt2);	
	$rowdb22 = db2_fetch_assoc($stmt2);		
	if($rowdb22['LEGALNAME1']==""){$langganan="";}else{$langganan=$rowdb22['LEGALNAME1'];}
	if($rowdb22['ORDERPARTNERBRANDCODE']==""){$buyer="";}else{$buyer=$rowdb22['LONGDESCRIPTION'];}	
	if($rowdb22['EXTERNALREFERENCE']!=""){
		$PO=$rowdb22['EXTERNALREFERENCE'];
	}else{
		$PO=$rowdb26['EXTERNALREFERENCE'];
	}
	$sqlDB23 = " SELECT p.SUBCODE01,p.SUBCODE02,p.SUBCODE03,p.SUBCODE04,p.SUBCODE05,p.SUBCODE06,p.SUBCODE07, p.LONGDESCRIPTION FROM (
SELECT p2.ITEMTYPEAFICODE,p2.SUBCODE01,p2.SUBCODE02,p2.SUBCODE03,p2.SUBCODE04,
p2.SUBCODE05,p2.SUBCODE06,p2.SUBCODE07  FROM PRODUCTIONDEMAND p 
LEFT OUTER JOIN PRODUCTIONRESERVATION p2 ON p.CODE =p2.ORDERCODE 
WHERE p.ITEMTYPEAFICODE ='KGF' AND p.SUBCODE01='".trim($rowdb21['DECOSUBCODE01'])."' 
AND p.SUBCODE02 ='".trim($rowdb21['DECOSUBCODE02'])."' AND p.SUBCODE03 ='".trim($rowdb21['DECOSUBCODE03'])."' AND
p.SUBCODE04='".trim($rowdb21['DECOSUBCODE04'])."' AND (p.PROJECTCODE ='".trim($proj)."' OR p.ORIGDLVSALORDLINESALORDERCODE  ='".trim($proj)."')
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
//$stmt3   = db2_exec($conn1,$sqlDB23, array('cursor'=>DB2_SCROLLABLE));
$stmt3   = db2_prepare($conn1,$sqlDB23);
db2_execute($stmt3);
$ai=0;
$a[0]="";
$a[1]="";
$a[2]="";
$a[3]="";		
while($rowdb23 = db2_fetch_assoc($stmt3)){
	$a[$ai]=$rowdb23['LONGDESCRIPTION'];
	$ai++;
}	
	$sqlDB25 = " SELECT ORDERITEMORDERPARTNERLINK.ORDPRNCUSTOMERSUPPLIERCODE,
       ORDERITEMORDERPARTNERLINK.LONGDESCRIPTION 
	   FROM DB2ADMIN.ORDERITEMORDERPARTNERLINK ORDERITEMORDERPARTNERLINK WHERE
       ORDERITEMORDERPARTNERLINK.ITEMTYPEAFICODE='$rowdb21[ITEMTYPECODE]' AND
	   ORDERITEMORDERPARTNERLINK.ORDPRNCUSTOMERSUPPLIERCODE='$rowdb22[ORDPRNCUSTOMERSUPPLIERCODE]' AND
	   ORDERITEMORDERPARTNERLINK.SUBCODE01='$rowdb21[DECOSUBCODE01]' AND
       ORDERITEMORDERPARTNERLINK.SUBCODE02='$rowdb21[DECOSUBCODE02]' AND
       ORDERITEMORDERPARTNERLINK.SUBCODE03='$rowdb21[DECOSUBCODE03]' AND
	   ORDERITEMORDERPARTNERLINK.SUBCODE04='$rowdb21[DECOSUBCODE04]' AND
       ORDERITEMORDERPARTNERLINK.SUBCODE05='$rowdb21[DECOSUBCODE05]' AND
	   ORDERITEMORDERPARTNERLINK.SUBCODE06='$rowdb21[DECOSUBCODE06]' AND
       ORDERITEMORDERPARTNERLINK.SUBCODE07='$rowdb21[DECOSUBCODE07]' AND
	   ORDERITEMORDERPARTNERLINK.SUBCODE08='$rowdb21[DECOSUBCODE08]'";
//	$stmt5   = db2_exec($conn1,$sqlDB25, array('cursor'=>DB2_SCROLLABLE));
	$stmt5   = db2_prepare($conn1,$sqlDB25);
		db2_execute($stmt5);
	$rowdb25 = db2_fetch_assoc($stmt5);	
	if($rowdb25['LONGDESCRIPTION']!=""){
		$item=$rowdb25['LONGDESCRIPTION'];
	}else{
		$item=trim($rowdb21['DECOSUBCODE02'])."".trim($rowdb21['DECOSUBCODE03']);
	}
	$sqlDB26 = " SELECT SALESORDERLINE.EXTERNALREFERENCE 
       FROM DB2ADMIN.SALESORDERLINE WHERE
       SALESORDERLINE.ITEMTYPEAFICODE='$rowdb21[ITEMTYPECODE]' AND	   
	   SALESORDERLINE.PROJECTCODE='$rowdb21[PROJECTCODE]' AND
	   SALESORDERLINE.SUBCODE01='$rowdb21[DECOSUBCODE01]' AND
       SALESORDERLINE.SUBCODE02='$rowdb21[DECOSUBCODE02]' AND
       SALESORDERLINE.SUBCODE03='$rowdb21[DECOSUBCODE03]' AND
	   SALESORDERLINE.SUBCODE04='$rowdb21[DECOSUBCODE04]' AND
       SALESORDERLINE.SUBCODE05='$rowdb21[DECOSUBCODE05]' AND
	   SALESORDERLINE.SUBCODE06='$rowdb21[DECOSUBCODE06]' AND
       SALESORDERLINE.SUBCODE07='$rowdb21[DECOSUBCODE07]' AND
	   SALESORDERLINE.SUBCODE08='$rowdb21[DECOSUBCODE08]' LIMIT 1";
//	$stmt6   = db2_exec($conn1,$sqlDB26, array('cursor'=>DB2_SCROLLABLE));
	$stmt6   = db2_prepare($conn1,$sqlDB26);
		db2_execute($stmt6);
	$rowdb26 = db2_fetch_assoc($stmt6);
	if($rowdb22['EXTERNALREFERENCE']!=""){
		$PO=$rowdb22['EXTERNALREFERENCE'];
	}else{
		$PO=$rowdb26['EXTERNALREFERENCE'];
	}
	$sqlDB27 = " SELECT PROJECTCODE, ORIGDLVSALORDLINESALORDERCODE FROM PRODUCTIONDEMAND  WHERE CODE ='$rowdb21[LOTCODE]' ";
//	$stmt7   = db2_exec($conn1,$sqlDB27, array('cursor'=>DB2_SCROLLABLE));
	$stmt7   = db2_prepare($conn1,$sqlDB27);
		db2_execute($stmt7);
	$rowdb27 = db2_fetch_assoc($stmt7);	
	
	if($rowdb21['PROJAWAL']!=""){$proAwal=$rowdb21['PROJAWAL'];}else if($rowdb21['PROJAWAL1']!=""){$proAwal=$rowdb21['PROJAWAL1'];}else if($rowdb27['PROJECTCODE']!=""){ $proAwal=$rowdb27['PROJECTCODE']; }else if($rowdb27['ORIGDLVSALORDLINESALORDERCODE']!=""){ $proAwal=$rowdb27['ORIGDLVSALORDLINESALORDERCODE']; }else{ $proAwal=$rowdb21['LOTCODE']; }	
	
	$query = "INSERT INTO dbnow_gkg.tblopname (
						langganan
						,buyer
						,proj_akhir
						,proj_awal
						,tipe
						,no_item
						,benang_1
						,benang_2
						,benang_3
						,benang_4
						,lot
						,rol
						,[weight]
						,satuan
						,[zone]
						,lokasi
						,tgl_tutup
						,tgl_buat
					) VALUES ( 
							?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?
					)";

	$params = [
		cek($langganan),
		cek($buyer),
		cek($rowdb21['PROJECTCODE']),
		cek($proAwal),
		cek($jns),
		cek($itemNo),
		cek(str_replace("'", "''", $a[0])),
		cek(str_replace("'", "''", $a[1])),
		cek(str_replace("'", "''", $a[2])),
		cek(str_replace("'", "''", $a[3])),
		cek($rowdb21['LOTCODE']),
		cek($rowdb21['ROLL']),
		cek(round($rowdb21['BERAT'], 3)),
		cek($rowdb21['BASEPRIMARYUNITCODE']),
		cek($rowdb21['WHSLOCATIONWAREHOUSEZONECODE']),
		cek($rowdb21['WAREHOUSELOCATIONCODE']),
		cek($Awal),
		cek(date('Y-m-d H:i:s')),
	];
	
	$simpan=sqlsrv_query($con,$query, $params) or die("GAGAL SIMPAN");	
	
	}
	if($simpan){		
		echo "<script>";
		echo "alert('Stok Tgl ".$Awal." Sudah ditutup')";
		echo "</script>";
        echo "<meta http-equiv='refresh' content='0; url=TutupHarian'>";
		
		}			
 }
}
?>