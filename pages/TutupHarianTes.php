<?php
$Awal	= isset($_POST['tgl_awal']) ? $_POST['tgl_awal'] : '';

$dateY = date('Y-m-d', strtotime('-1 days', strtotime($Awal)));
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
** Jangan di Tutup Sebelum Selesai. 
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
$sql = mysqli_query($con," SELECT tgl_tutup,sum(rol) as rol,sum(weight) as kg,DATE_FORMAT(now(),'%Y-%m-%d') as tgl FROM tblopname_tes GROUP BY tgl_tutup ORDER BY tgl_tutup LIMIT 30");		  
    while($r = mysqli_fetch_array($sql)){
		
?>
	  <tr>
	  <td style="text-align: center"><?php echo $no;?></td>
	  <td style="text-align: center"><a href="DetailOpname-<?php echo $r['tgl_tutup'];?>" class="btn btn-info btn-xs" target="_blank"> <i class="fa fa-link"></i> Lihat Data</a></td>
	  <td style="text-align: center"><?php echo $r['tgl_tutup'];?></td>
      <td style="text-align: center"><?php echo $r['rol'];?></td>
      <td style="text-align: right"><?php echo number_format($r['kg'],3);?></td>
      <td style="text-align: center"><!--<a href="#" class="btn btn-xs btn-danger <?php if($r['tgl']==$r['tgl_tutup']){ }else{echo"disabled";} ?>" onclick="confirm_delete('DelOpname-<?php echo $r['tgl_tutup']; ?>');" ><small class="fas fa-trash"> </small> Hapus</a>--></td>
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
		<div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Detail Data Masuk Kain Greige Perhari</h3>				 
          </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-sm table-bordered table-striped" style="font-size: 14px; text-align: center;">
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
$sql = mysqli_query($con," SELECT tgl_tutup,sum(qty) as rol,sum(berat) as kg,DATE_FORMAT(now(),'%Y-%m-%d') as tgl FROM tblmasukkain GROUP BY tgl_tutup ORDER BY tgl_tutup LIMIT 30");		  
    while($r = mysqli_fetch_array($sql)){
		
?>
	  <tr>
	  <td style="text-align: center"><?php echo $no;?></td>
	  <td style="text-align: center"><a href="DetailOpname-<?php echo $r['tgl_tutup'];?>" class="btn btn-info btn-xs" target="_blank"> <i class="fa fa-link"></i> Lihat Data</a></td>
	  <td style="text-align: center"><?php echo $r['tgl_tutup'];?></td>
      <td style="text-align: center"><?php echo $r['rol'];?></td>
      <td style="text-align: right"><?php echo number_format($r['kg'],3);?></td>
      <td style="text-align: center"><!--<a href="#" class="btn btn-xs btn-danger <?php if($r['tgl']==$r['tgl_tutup']){ }else{echo"disabled";} ?>" onclick="confirm_delete('DelOpname-<?php echo $r['tgl_tutup']; ?>');" ><small class="fas fa-trash"> </small> Hapus</a>--></td>
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
		<div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Detail Data Keluar Kain Greige Perhari</h3>				 
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
$sql = mysqli_query($con," SELECT tgl_tutup,sum(rol) as rol,sum(weight) as kg,DATE_FORMAT(now(),'%Y-%m-%d') as tgl FROM tblopname_tes GROUP BY tgl_tutup ORDER BY tgl_tutup LIMIT 30");		  
    while($r = mysqli_fetch_array($sql)){
		
?>
	  <tr>
	  <td style="text-align: center"><?php echo $no;?></td>
	  <td style="text-align: center"><a href="DetailOpname-<?php echo $r['tgl_tutup'];?>" class="btn btn-info btn-xs" target="_blank"> <i class="fa fa-link"></i> Lihat Data</a></td>
	  <td style="text-align: center"><?php echo $r['tgl_tutup'];?></td>
      <td style="text-align: center"><?php echo $r['rol'];?></td>
      <td style="text-align: right"><?php echo number_format($r['kg'],3);?></td>
      <td style="text-align: center"><!--<a href="#" class="btn btn-xs btn-danger <?php if($r['tgl']==$r['tgl_tutup']){ }else{echo"disabled";} ?>" onclick="confirm_delete('DelOpname-<?php echo $r['tgl_tutup']; ?>');" ><small class="fas fa-trash"> </small> Hapus</a>--></td>
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

$cektgl=mysqli_query($con,"SELECT DATE_FORMAT(NOW(),'%Y-%m-%d') as tgl,COUNT(tgl_tutup) as ck ,DATE_FORMAT(NOW(),'%H') as jam,DATE_FORMAT(NOW(),'%H:%i') as jam1 FROM tblopname_tes WHERE tgl_tutup='".$Awal."' LIMIT 1");
$dcek=mysqli_fetch_array($cektgl);
$t1=strtotime($Awal);
$t2=strtotime($dcek['tgl']);
$selh=round(abs($t2-$t1)/(60*60*45));

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
		echo "<script>
  	$(function() {
    toastr.error('Tanggal Lebih dari $selh hari')
  });
  
</script>";
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
	}else if($dcek['jam'] < 6){
		//echo "<script>";
		//echo "alert('Tidak Bisa Tutup Sebelum jam 6 Pagi Sampai jam 12 Malam, Sekarang Masih Jam ".$dcek['jam1']."')";
		//echo "</script>";
		echo "<script>
  		$(function() {
    		toastr.error('Tidak Bisa Tutup Sebelum jam 6 Pagi Sampai jam 12 Malam, Sekarang Masih Jam ".$dcek['jam1']."')
  		});  
  		</script>";
		// Refresh form
		// echo "<meta http-equiv='refresh' content='0; url=index1.php?p=data-stok-kj'>";
			}
			else{	
	
	$sqlDB21 = " SELECT SUM(b.BASEPRIMARYQUANTITYUNIT) AS BERAT,SUM(b.BASESECONDARYQUANTITYUNIT) AS YD,COUNT(b.BASESECONDARYQUANTITYUNIT) AS ROLL,b.LOTCODE,b.PROJECTCODE,
b.ITEMTYPECODE,b.DECOSUBCODE01,b.DECOSUBCODE02,b.DECOSUBCODE03,b.DECOSUBCODE04,b.DECOSUBCODE05,b.DECOSUBCODE06,b.DECOSUBCODE07,b.DECOSUBCODE08,
b.BASEPRIMARYUNITCODE,b.BASESECONDARYUNITCODE,b.WHSLOCATIONWAREHOUSEZONECODE,b.WAREHOUSELOCATIONCODE,prj.PROJECTCODE AS PROJAWAL,prj1.PROJECTCODE AS PROJAWAL1  
FROM BALANCE b 
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
    ITXVIEWBUKMUTGKGKNT.PROJECTCODE) prj ON b.ELEMENTSCODE = prj.ITEMELEMENTCODE
LEFT OUTER JOIN (
SELECT
    STOCKTRANSACTION.ORDERCODE,
    STOCKTRANSACTION.ORDERLINE,
    STOCKTRANSACTION.ITEMELEMENTCODE,
    STOCKTRANSACTION.PROJECTCODE
FROM
    STOCKTRANSACTION STOCKTRANSACTION
WHERE
    STOCKTRANSACTION.TEMPLATECODE = 'OPN' AND STOCKTRANSACTION.ITEMTYPECODE='KGF'  
GROUP BY
    STOCKTRANSACTION.ORDERCODE,
    STOCKTRANSACTION.ORDERLINE,
    STOCKTRANSACTION.ITEMELEMENTCODE,
    STOCKTRANSACTION.PROJECTCODE) prj1 ON b.ELEMENTSCODE = prj1.ITEMELEMENTCODE    
WHERE (b.ITEMTYPECODE='FKG' OR b.ITEMTYPECODE='KGF') AND b.LOGICALWAREHOUSECODE='M021' 
GROUP BY b.ITEMTYPECODE,b.DECOSUBCODE01,
b.DECOSUBCODE02,b.DECOSUBCODE03,
b.DECOSUBCODE04,b.DECOSUBCODE05,
b.DECOSUBCODE06,b.DECOSUBCODE07,
b.DECOSUBCODE08,b.PROJECTCODE,b.LOTCODE,
b.BASEPRIMARYUNITCODE,b.BASESECONDARYUNITCODE,
b.WHSLOCATIONWAREHOUSEZONECODE,b.WAREHOUSELOCATIONCODE,prj.PROJECTCODE,prj1.PROJECTCODE ";
	$stmt1   = db2_exec($conn1,$sqlDB21, array('cursor'=>DB2_SCROLLABLE));
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
	$stmt2   = db2_exec($conn1,$sqlDB22, array('cursor'=>DB2_SCROLLABLE));
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
$stmt3   = db2_exec($conn1,$sqlDB23, array('cursor'=>DB2_SCROLLABLE));
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
	$stmt5   = db2_exec($conn1,$sqlDB25, array('cursor'=>DB2_SCROLLABLE));
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
	$stmt6   = db2_exec($conn1,$sqlDB26, array('cursor'=>DB2_SCROLLABLE));
	$rowdb26 = db2_fetch_assoc($stmt6);
	if($rowdb22['EXTERNALREFERENCE']!=""){
		$PO=$rowdb22['EXTERNALREFERENCE'];
	}else{
		$PO=$rowdb26['EXTERNALREFERENCE'];
	}
	$sqlDB27 = " SELECT PROJECTCODE, ORIGDLVSALORDLINESALORDERCODE FROM PRODUCTIONDEMAND  WHERE CODE ='$rowdb21[LOTCODE]' ";
	$stmt7   = db2_exec($conn1,$sqlDB27, array('cursor'=>DB2_SCROLLABLE));
	$rowdb27 = db2_fetch_assoc($stmt7);	
	
	if($rowdb21['PROJAWAL']!=""){$proAwal=$rowdb21['PROJAWAL'];}else if($rowdb21['PROJAWAL1']!=""){$proAwal=$rowdb21['PROJAWAL1'];}else if($rowdb27['PROJECTCODE']!=""){ $proAwal=$rowdb27['PROJECTCODE']; }else if($rowdb27['ORIGDLVSALORDLINESALORDERCODE']!=""){ $proAwal=$rowdb27['ORIGDLVSALORDLINESALORDERCODE']; }else{ $proAwal=$rowdb21['LOTCODE']; }	
	$simpan=mysqli_query($con,"INSERT INTO `tblopname_tes` SET 
					langganan = '".$langganan."',
					buyer = '".$buyer."',
					proj_akhir = '".$rowdb21['PROJECTCODE']."',
					proj_awal = '".$proAwal."',
					tipe = '".$jns."',
					no_item = '".$itemNo."',
					benang_1 = '".str_replace("'","''",$a[0])."',
					benang_2 = '".str_replace("'","''",$a[1])."',
					benang_3 = '".str_replace("'","''",$a[2])."',
					benang_4 = '".str_replace("'","''",$a[3])."',
					lot = '".$rowdb21['LOTCODE']."',
					rol = '".$rowdb21['ROLL']."',
					weight = '".round($rowdb21['BERAT'],3)."',
					satuan = '".$rowdb21['BASEPRIMARYUNITCODE']."',
					zone = '".$rowdb21['WHSLOCATIONWAREHOUSEZONECODE']."',
					lokasi = '".$rowdb21['WAREHOUSELOCATIONCODE']."',
					tgl_tutup = '".$Awal."',
					tgl_buat =now()
					
					") or die("GAGAL SIMPAN");	
	
	}
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
       ITXVIEWLAPMASUKGREIGE.PROVISIONALCODE,SUM(STOCKTRANSACTION.WEIGHTNET) AS QTY_KG,COUNT(STOCKTRANSACTION.WEIGHTNET) AS QTY_ROL,
       ITXVIEWKNTORDER.SCHEDULEDRESOURCECODE
       FROM DB2ADMIN.STOCKTRANSACTION STOCKTRANSACTION LEFT OUTER JOIN
DB2ADMIN.ITXVIEWLAPMASUKGREIGE ITXVIEWLAPMASUKGREIGE ON ITXVIEWLAPMASUKGREIGE.PROVISIONALCODE  = STOCKTRANSACTION.ORDERCODE
AND ITXVIEWLAPMASUKGREIGE.ORDERLINE  = STOCKTRANSACTION.ORDERLINE
AND ITXVIEWLAPMASUKGREIGE.PROVISIONALCOUNTERCODE  = STOCKTRANSACTION.ORDERCOUNTERCODE  
AND ITXVIEWLAPMASUKGREIGE.ITEMTYPEAFICODE = STOCKTRANSACTION.ITEMTYPECODE 
AND ITXVIEWLAPMASUKGREIGE.SUBCODE01= STOCKTRANSACTION.DECOSUBCODE01
AND ITXVIEWLAPMASUKGREIGE.SUBCODE02= STOCKTRANSACTION.DECOSUBCODE02
AND ITXVIEWLAPMASUKGREIGE.SUBCODE03= STOCKTRANSACTION.DECOSUBCODE03
AND ITXVIEWLAPMASUKGREIGE.SUBCODE04= STOCKTRANSACTION.DECOSUBCODE04     
LEFT OUTER JOIN DB2ADMIN.ITXVIEWKNTORDER ITXVIEWKNTORDER ON ITXVIEWKNTORDER.PRODUCTIONORDERCODE =ITXVIEWLAPMASUKGREIGE.EXTERNALREFERENCE AND 
ITXVIEWKNTORDER.CODE=ITXVIEWLAPMASUKGREIGE.LOTCODE	
WHERE STOCKTRANSACTION.TRANSACTIONDATE='$dateY' and STOCKTRANSACTION.LOGICALWAREHOUSECODE ='M021' 
AND NOT ITXVIEWLAPMASUKGREIGE.ORDERLINE IS NULL
GROUP BY ITXVIEWLAPMASUKGREIGE.PROVISIONALCODE,
ITXVIEWLAPMASUKGREIGE.SUMMARIZEDDESCRIPTION,ITXVIEWLAPMASUKGREIGE.DESTINATIONWAREHOUSECODE,
ITXVIEWLAPMASUKGREIGE.USERPRIMARYUOMCODE,STOCKTRANSACTION.PROJECTCODE,STOCKTRANSACTION.CREATIONUSER,
       ITXVIEWLAPMASUKGREIGE.WHSLOCATIONWAREHOUSEZONECODE,ITXVIEWLAPMASUKGREIGE.PROVISIONALCOUNTERCODE,
       ITXVIEWLAPMASUKGREIGE.WAREHOUSELOCATIONCODE,ITXVIEWLAPMASUKGREIGE.ORDERLINE,ITXVIEWLAPMASUKGREIGE.EXTERNALREFERENCE,
       ITXVIEWLAPMASUKGREIGE.ITEMDESCRIPTION,ITXVIEWLAPMASUKGREIGE.LOTCODE,STOCKTRANSACTION.TRANSACTIONDATE,
	   ITXVIEWLAPMASUKGREIGE.SUBCODE01,ITXVIEWLAPMASUKGREIGE.SUBCODE02,
       ITXVIEWLAPMASUKGREIGE.SUBCODE03,ITXVIEWLAPMASUKGREIGE.SUBCODE04,
       ITXVIEWKNTORDER.SCHEDULEDRESOURCECODE ";
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
if($rowdb21M['SCHEDULEDRESOURCECODE']!=""){$mcM=$rowdb21M['SCHEDULEDRESOURCECODE'];}else{$mcM=$rowdb27M['NO_MESIN'];}
if($rowdb25M['GSM1']!=""){$gsmM=round($rowdb25M['GSM1']);}else if($rowdb26M['GSM1']!=""){$gsmM=round($rowdb26M['GSM1']);}else{$gsmM=round($rowdb30M['GSM1']); }
if($rowdb25M['LEBAR1']!=""){$lbrM=round($rowdb25M['LEBAR1']);}else if($rowdb26M['LEBAR1']!=""){$lbrM=round($rowdb26M['LEBAR1']);}else{ $lbrM=round($rowdb30M['LEBAR1']);}
if(substr($rowdb21M['EXTERNALREFERENCE'],0,3)!="000" or substr($rowdb21M['EXTERNALREFERENCE'],0,2)!="00"){$lotBM=$rowdb21M['EXTERNALREFERENCE'];}else{$lotBM="";}
if(substr($rowdb21M['EXTERNALREFERENCE'],0,3)=="000" or substr($rowdb21M['EXTERNALREFERENCE'],0,2)=="00"){$prdOrM=$rowdb21M['EXTERNALREFERENCE'];}else{$prdOrM="";}		
$simpanM=mysqli_query($con,"INSERT INTO `tblmasukkain` SET 
tgl_masuk	= '".$rowdb21M['TRANSACTIONDATE']."',
no_bon	= '".$bonM."',
buyer	= '".$buyerM."',
customer	= '".$langgananM."',
projectcode	= '".$rowdb21M['PROJECTCODE']."',
prod_order	= '".$prdOrM."',
code	= '".$itemcM."',
mesin_rajut	= '".$mcM."',
lot_benang	= '".$lotBM."',
lebar_g	= '".$lbrM."',
gramasi_g	= '".$gsmM."',
lebar_kj	= '".round($rowdb28M['VALUEDECIMAL'])."',
gramasi_kj	= '".round($rowdb29M['VALUEDECIMAL'])."',
jenis_kain	= '".str_replace("'","''",$rowdb21M['SUMMARIZEDDESCRIPTION'])."',
lot	= '".$rowdb21M['LOTCODE']."',
benang1 = '".str_replace("'","''",$aM[0])."',
benang2 = '".str_replace("'","''",$aM[1])."',
benang3 = '".str_replace("'","''",$aM[2])."',
benang4 = '".str_replace("'","''",$aM[3])."',
qty	= '".$rowdb21M['QTY_ROL']."',
berat	= '".$rowdb21M['QTY_KG']."',
blok	= '".$rowdb21M['WHSLOCATIONWAREHOUSEZONECODE']."-".$rowdb21M['WAREHOUSELOCATIONCODE']."',
balance	= '".$rowdb24M['WAREHOUSELOCATIONCODE']."',
userid	= '".$rowdb21M['CREATIONUSER']."',
tgl_tutup = '".$dateY."',
tgl_buat =now()") or die("GAGAL SIMPAN MASUK KAIN");		
	
}

//Retur Produksi				
					  
	$sqlDB21RM = " SELECT s.PROJECTCODE,f.SUMMARIZEDDESCRIPTION,
s.TRANSACTIONDATE,s.DECOSUBCODE01,s.DECOSUBCODE02,s.DECOSUBCODE03,
s.DECOSUBCODE04,s.WHSLOCATIONWAREHOUSEZONECODE,s.WAREHOUSELOCATIONCODE,
s.LOTCODE,SUM(s.BASEPRIMARYQUANTITY) AS KG,COUNT(s.ITEMELEMENTCODE) AS JML,
s.CREATIONUSER,a1.VALUESTRING AS NOMESIN FROM STOCKTRANSACTION s 
LEFT OUTER JOIN ADSTORAGE a ON a.UNIQUEID = s.ABSUNIQUEID AND a.NAMENAME = 'StatusRetur'
LEFT OUTER JOIN PRODUCTIONDEMAND p ON p.CODE = s.LOTCODE
LEFT OUTER JOIN ADSTORAGE a1 ON a1.UNIQUEID = p.ABSUNIQUEID AND a1.NAMENAME = 'MachineNo'
LEFT OUTER JOIN FULLITEMKEYDECODER f ON s.FULLITEMIDENTIFIER = f.IDENTIFIER
WHERE s.TRANSACTIONDATE = '$dateY' AND s.ITEMTYPECODE='KGF' AND 
s.LOGICALWAREHOUSECODE ='M021' AND s.TEMPLATECODE = 'OPN' AND a.VALUESTRING =  '1'
GROUP BY s.PROJECTCODE,
s.TRANSACTIONDATE,s.DECOSUBCODE01,s.DECOSUBCODE02,
s.DECOSUBCODE03, s.DECOSUBCODE04,
s.WHSLOCATIONWAREHOUSEZONECODE,
s.WAREHOUSELOCATIONCODE, s.LOTCODE, f.SUMMARIZEDDESCRIPTION, s.CREATIONUSER,a1.VALUESTRING";
	$stmt1RM   = db2_exec($conn1,$sqlDB21RM, array('cursor'=>DB2_SCROLLABLE)); 
    while($rowdb21RM = db2_fetch_assoc($stmt1RM)){ 
$itemcRM=trim($rowdb21RM['DECOSUBCODE02'])."".trim($rowdb21RM['DECOSUBCODE03'])." ".trim($rowdb21RM['DECOSUBCODE04']);
		
$sqlDB22R1M = " SELECT SALESORDER.CODE, SALESORDER.EXTERNALREFERENCE, SALESORDER.ORDPRNCUSTOMERSUPPLIERCODE,
		ITXVIEWAKJ.LEGALNAME1, ITXVIEWAKJ.ORDERPARTNERBRANDCODE, ITXVIEWAKJ.LONGDESCRIPTION
		FROM DB2ADMIN.SALESORDER SALESORDER LEFT OUTER JOIN DB2ADMIN.ITXVIEWAKJ 
       	ITXVIEWAKJ ON SALESORDER.CODE=ITXVIEWAKJ.CODE
		WHERE SALESORDER.CODE='".trim($rowdb21RM['PROJECTCODE'])."' ";
$stmt2R1M   = db2_exec($conn1,$sqlDB22R1M, array('cursor'=>DB2_SCROLLABLE));
$rowdb22R1M = db2_fetch_assoc($stmt2R1M);
		
$sqlDB22RM = " SELECT LISTAGG(DISTINCT  TRIM(BALANCE.WAREHOUSELOCATIONCODE),', ') AS WAREHOUSELOCATIONCODE, COUNT(BALANCE.BASEPRIMARYQUANTITYUNIT) AS ROL,SUM(BALANCE.BASEPRIMARYQUANTITYUNIT) AS BERAT,BALANCE.LOTCODE  
		FROM (
		SELECT 
s.ITEMELEMENTCODE  FROM STOCKTRANSACTION s 
LEFT OUTER JOIN ADSTORAGE a ON a.UNIQUEID = s.ABSUNIQUEID AND a.NAMENAME = 'StatusRetur'
WHERE s.PROJECTCODE='".$rowdb21RM['PROJECTCODE']."' AND s.ITEMTYPECODE='KGF' AND 
s.DECOSUBCODE02='".$rowdb21RM['DECOSUBCODE02']."' AND s.DECOSUBCODE03='".$rowdb21RM['DECOSUBCODE03']."' AND 
s.DECOSUBCODE04='".$rowdb21RM['DECOSUBCODE04']."' AND s.LOGICALWAREHOUSECODE ='M021' AND
s.LOTCODE='$rowdb21RM[LOTCODE]' AND 
s.TEMPLATECODE = 'OPN' AND a.VALUESTRING =  '1'
GROUP BY 
s.ITEMELEMENTCODE
		) STOCKTRANSACTION LEFT OUTER JOIN 
		DB2ADMIN.BALANCE BALANCE ON BALANCE.ELEMENTSCODE =STOCKTRANSACTION.ITEMELEMENTCODE  
		GROUP BY BALANCE.LOTCODE ";					  
		$stmt2RM   = db2_exec($conn1,$sqlDB22RM, array('cursor'=>DB2_SCROLLABLE));	
		$rowdb22RM = db2_fetch_assoc($stmt2RM);
$sqlDB23RM = " SELECT p.SUBCODE01,p.SUBCODE02,p.SUBCODE03,p.SUBCODE04,p.SUBCODE05,p.SUBCODE06,p.SUBCODE07, p.LONGDESCRIPTION FROM (
SELECT p2.ITEMTYPEAFICODE,p2.SUBCODE01,p2.SUBCODE02,p2.SUBCODE03,p2.SUBCODE04,
p2.SUBCODE05,p2.SUBCODE06,p2.SUBCODE07  FROM PRODUCTIONDEMAND p 
LEFT OUTER JOIN PRODUCTIONRESERVATION p2 ON p.CODE =p2.ORDERCODE 
WHERE p.ITEMTYPEAFICODE ='KGF' AND p.SUBCODE01='".trim($rowdb21RM['DECOSUBCODE01'])."' 
AND p.SUBCODE02 ='".trim($rowdb21RM['DECOSUBCODE02'])."' AND p.SUBCODE03 ='".trim($rowdb21RM['DECOSUBCODE03'])."' AND
p.SUBCODE04='".trim($rowdb21RM['DECOSUBCODE04'])."' AND (p.PROJECTCODE ='".trim($rowdb21RM['PROJECTCODE'])."' OR p.ORIGDLVSALORDLINESALORDERCODE  ='".trim($rowdb21RM['PROJECTCODE'])."')
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
$stmt3RM   = db2_exec($conn1,$sqlDB23RM, array('cursor'=>DB2_SCROLLABLE));
$aiRM=0;
$aRM[0]="";
$aRM[1]="";
$aRM[2]="";
$aRM[3]="";		
while($rowdb23RM = db2_fetch_assoc($stmt3RM)){
	$aRM[$aiRM]=$rowdb23RM['LONGDESCRIPTION'];
	$aiRM++;
}		

$sqlDB28RM = " SELECT a.VALUEDECIMAL  FROM PRODUCT p 
LEFT OUTER JOIN ADSTORAGE a  ON a.UNIQUEID = p.ABSUNIQUEID 
WHERE p.SUBCODE01='".trim($rowdb21RM['DECOSUBCODE01'])."' AND
p.SUBCODE02='".trim($rowdb21RM['DECOSUBCODE02'])."' AND
p.SUBCODE03='".trim($rowdb21RM['DECOSUBCODE03'])."' AND
p.SUBCODE04='".trim($rowdb21RM['DECOSUBCODE04'])."' AND
a.NAMENAME ='Width' AND
p.ITEMTYPECODE ='KFF'  ";
$stmt8RM   = db2_exec($conn1,$sqlDB28RM, array('cursor'=>DB2_SCROLLABLE));
$rowdb28RM = db2_fetch_assoc($stmt8RM);	
$sqlDB29RM = " SELECT a.VALUEDECIMAL  FROM PRODUCT p 
LEFT OUTER JOIN ADSTORAGE a  ON a.UNIQUEID = p.ABSUNIQUEID 
WHERE p.SUBCODE01='".trim($rowdb21RM['DECOSUBCODE01'])."' AND
p.SUBCODE02='".trim($rowdb21RM['DECOSUBCODE02'])."' AND
p.SUBCODE03='".trim($rowdb21RM['DECOSUBCODE03'])."' AND
p.SUBCODE04='".trim($rowdb21RM['DECOSUBCODE04'])."' AND
a.NAMENAME ='GSM' AND
p.ITEMTYPECODE ='KFF'  ";
$stmt9RM   = db2_exec($conn1,$sqlDB29RM, array('cursor'=>DB2_SCROLLABLE));
$rowdb29RM = db2_fetch_assoc($stmt9RM);		
if($rowdb22R1M['LEGALNAME1']==""){$langgananRM="";}else{$langgananRM=$rowdb22R1M['LEGALNAME1'];}
if($rowdb22R1M['ORDERPARTNERBRANDCODE']==""){$buyerRM="";}else{$buyerRM=$rowdb221M['ORDERPARTNERBRANDCODE'];}

$simpanRM=mysqli_query($con,"INSERT INTO `tblmasukkain` SET 
tgl_masuk	= '".$rowdb21RM['TRANSACTIONDATE']."',
buyer	= '".$buyerRM."',
customer	= '".$langgananRM."',
code	= '".$itemcRM."',
mesin_rajut	= '".$rowdb21RM['NOMESIN']."',
lebar_kj	= '".round($rowdb28RM['VALUEDECIMAL'])."',
gramasi_kj	= '".round($rowdb29RM['VALUEDECIMAL'])."',
jenis_kain	= '".str_replace("'","''",$rowdb21RM['SUMMARIZEDDESCRIPTION'])."',
lot	= '".$rowdb21RM['LOTCODE']."',
benang1 = '".str_replace("'","''",$aRM[0])."',
benang2 = '".str_replace("'","''",$aRM[1])."',
benang3 = '".str_replace("'","''",$aRM[2])."',
benang4 = '".str_replace("'","''",$aRM[3])."',
qty	= '".$rowdb21RM['JML']."',
berat	= '".$rowdb21RM['KG']."',
blok	= '".$rowdb21RM['WHSLOCATIONWAREHOUSEZONECODE']."-".$rowdb21RM['WAREHOUSELOCATIONCODE']."',
balance	= '".$rowdb22RM['WAREHOUSELOCATIONCODE']."',
userid	= '".$rowdb21RM['CREATIONUSER']."',
tgl_tutup = '".$dateY."',
tgl_buat =now()") or die("GAGAL SIMPAN RETUR PRODUKSI");		
		
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
	ITXVIEWKNTORDER.ORIGDLVSALORDLINESALORDERCODE,
	ITXVIEWKNTORDER.PROJECTCODE,
	ITXVIEWKNTORDER.PRODUCTIONDEMANDCODE,
	ITXVIEWKNTORDER.LEGALNAME1,  
	FULLITEMKEYDECODER.SUMMARIZEDDESCRIPTION
	FROM DB2ADMIN.STOCKTRANSACTION STOCKTRANSACTION
	LEFT OUTER JOIN
	(SELECT 
	ITXVIEWKNTORDER.PRODUCTIONORDERCODE,
	LISTAGG(DISTINCT TRIM(ITXVIEWKNTORDER.ORIGDLVSALORDLINESALORDERCODE),', ') AS ORIGDLVSALORDLINESALORDERCODE,
	LISTAGG(DISTINCT  TRIM(ITXVIEWKNTORDER.PRODUCTIONDEMANDCODE),', ') AS PRODUCTIONDEMANDCODE,
	LISTAGG(DISTINCT TRIM(ITXVIEWKNTORDER.PROJECTCODE),', ') AS PROJECTCODE,
	LISTAGG(DISTINCT TRIM(ITXVIEWKNTORDER.LEGALNAME1),', ') AS LEGALNAME1 FROM 
DB2ADMIN.ITXVIEWKNTORDER
GROUP BY ITXVIEWKNTORDER.PRODUCTIONORDERCODE) ITXVIEWKNTORDER
	 ON ITXVIEWKNTORDER.PRODUCTIONORDERCODE =STOCKTRANSACTION.ORDERCODE 
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
STOCKTRANSACTION.ONHANDUPDATE > 1 AND TRANSACTIONDATE='$dateY' AND NOT STOCKTRANSACTION.ORDERCODE IS NULL 
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
	ITXVIEWKNTORDER.ORIGDLVSALORDLINESALORDERCODE,
	ITXVIEWKNTORDER.PROJECTCODE,
	ITXVIEWKNTORDER.PRODUCTIONDEMANDCODE,
	ITXVIEWKNTORDER.LEGALNAME1,
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
		
$simpanK=mysqli_query($con,"INSERT INTO `tblkeluarkain` SET 
tglkeluar = '".$rowdb21K['TRANSACTIONDATE']."',
buyer = '".$buyerK."',
custumer = '".$langgananK."',
projectcode = '".$projK."',
prod_order = '".$rowdb21K['ORDERCODE']."',
demand = '".$rowdb21K['LOTCODE']."',
code = '".$rowdb21K['LOTCODE']."',
lot = '".$rowdb21K['LOTCODE']."',
benang1 = '".str_replace("'","''",$aK[0])."',
benang2 = '".str_replace("'","''",$aK[1])."',
benang3 = '".str_replace("'","''",$aK[2])."',
benang4 = '".str_replace("'","''",$aK[3])."',
warna = '".$rowdb24K['WARNA']."',
jenis_kain = '".$rowdb21K['SUMMARIZEDDESCRIPTION']."',
qty = '".$rowdb21K['QTY_DUS']."',
berat = '".number_format(round($rowdb21K['QTY_KG'],2),2)."',
proj_awal = '".$projAk."',
userid	= '".$rowdb21K['CREATIONUSER']."',
tgl_tutup = '".$dateY."',
tgl_buat =now()") or die("GAGAL SIMPAN TRANSAKSI KELUAR");
		
}
 // Permintaan Potong
$sqlDB21P = " SELECT 
s.CREATIONUSER, s.TRANSACTIONDATE, s.DECOSUBCODE02, s.DECOSUBCODE03, s.DECOSUBCODE04, 
s.LOTCODE, sum(s.BASEPRIMARYQUANTITY) AS KG, count(s.ITEMELEMENTCODE) AS JML, a.VALUESTRING AS PTG, a1.VALUESTRING as NOTE, s.PROJECTCODE  
FROM STOCKTRANSACTION s
LEFT OUTER JOIN ADSTORAGE a ON a.UNIQUEID = s.ABSUNIQUEID AND a.NAMENAME = 'StatusPotong'
LEFT OUTER JOIN ADSTORAGE a1 ON a1.UNIQUEID = s.ABSUNIQUEID AND a1.NAMENAME = 'NoteMintaPotong'
WHERE s.ITEMTYPECODE='KGF' AND s.LOGICALWAREHOUSECODE ='M021' AND a.VALUESTRING ='1' AND
s.TEMPLATECODE = '098' AND s.TRANSACTIONDATE='$dateY' 
GROUP BY s.TRANSACTIONDATE, s.DECOSUBCODE02, s.DECOSUBCODE03, s.DECOSUBCODE04, 
s.LOTCODE,s.CREATIONUSER,a.VALUESTRING, a1.VALUESTRING, s.PROJECTCODE ";
	$stmt1P   = db2_exec($conn1,$sqlDB21P, array('cursor'=>DB2_SCROLLABLE));
    while($rowdb21P = db2_fetch_assoc($stmt1P)){ 
if ($rowdb21P['LOGICALWAREHOUSECODE'] =='M904') { $knittP = 'LT2'; }
else if($rowdb21P['LOGICALWAREHOUSECODE'] ='P501'){ $knittP = 'LT1'; }
if($rowdb21P['PROJECTCODE']!=""){$projectP=$rowdb21P['PROJECTCODE'];}else{$projectP=$rowdb21P['ORIGDLVSALORDLINESALORDERCODE'];}		
$kdbenangP=trim($rowdb21P['DECOSUBCODE01'])." ".trim($rowdb21P['DECOSUBCODE02'])." ".trim($rowdb21P['DECOSUBCODE03'])." ".trim($rowdb21P['DECOSUBCODE04'])." ".trim($rowdb21P['DECOSUBCODE05'])." ".trim($rowdb21P['DECOSUBCODE06'])." ".trim($rowdb21P['DECOSUBCODE07'])." ".trim($rowdb21P['DECOSUBCODE08']);
$sqlDB22P = " SELECT SALESORDER.CODE, SALESORDER.EXTERNALREFERENCE, SALESORDER.ORDPRNCUSTOMERSUPPLIERCODE,
		ITXVIEWAKJ.LEGALNAME1, ITXVIEWAKJ.ORDERPARTNERBRANDCODE, ITXVIEWAKJ.LONGDESCRIPTION
		FROM DB2ADMIN.SALESORDER SALESORDER LEFT OUTER JOIN DB2ADMIN.ITXVIEWAKJ 
       	ITXVIEWAKJ ON SALESORDER.CODE=ITXVIEWAKJ.CODE
		WHERE SALESORDER.CODE='$projectP' ";
$stmt2P   = db2_exec($conn1,$sqlDB22P, array('cursor'=>DB2_SCROLLABLE));
$rowdb22P = db2_fetch_assoc($stmt2P);
if(strlen(trim($rowdb21P['LOTCODE']))=="8"){$WlotP=" AND ( p.PROJECTCODE ='".trim($rowdb21P['PROJAWAL'])."' OR p.ORIGDLVSALORDLINESALORDERCODE ='".trim($rowdb21P['PROJAWAL'])."' OR p.CODE='".trim($rowdb21P['LOTCODE'])."' ) ";}
else{$WlotP=" AND ( p.PROJECTCODE ='".trim($projectP)."' OR p.ORIGDLVSALORDLINESALORDERCODE ='".trim($projectP)."' ) ";}		

$sqlDB23P = " SELECT p.SUBCODE01,p.SUBCODE02,p.SUBCODE03,p.SUBCODE04,p.SUBCODE05,p.SUBCODE06,p.SUBCODE07, p.LONGDESCRIPTION FROM (
SELECT p2.ITEMTYPEAFICODE,p2.SUBCODE01,p2.SUBCODE02,p2.SUBCODE03,p2.SUBCODE04,
p2.SUBCODE05,p2.SUBCODE06,p2.SUBCODE07  FROM PRODUCTIONDEMAND p 
LEFT OUTER JOIN PRODUCTIONRESERVATION p2 ON p.CODE =p2.ORDERCODE 
WHERE p.ITEMTYPEAFICODE ='KGF' AND p.SUBCODE01='".trim($rowdb21P['DECOSUBCODE01'])."' 
AND p.SUBCODE02 ='".trim($rowdb21P['DECOSUBCODE02'])."' AND p.SUBCODE03 ='".trim($rowdb21P['DECOSUBCODE03'])."' AND
p.SUBCODE04='".trim($rowdb21P['DECOSUBCODE04'])."' $WlotP 
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
$stmt3P   = db2_exec($conn1,$sqlDB23P, array('cursor'=>DB2_SCROLLABLE));
$aiP=0;
$aP[0]="";$aP[1]="";$aP[2]="";$aP[3]="";		
while($rowdb23P = db2_fetch_assoc($stmt3P)){
	$aP[$aiP]=$rowdb23P['LONGDESCRIPTION'];
	$aiP++;
}
$sqlDB24P = " 
SELECT pr.LONGDESCRIPTION,p.PRODUCTIONORDERCODE,pd.SUBCODE01,pd.SUBCODE02,pd.SUBCODE03,
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
WHERE (pd.PROJECTCODE ='$projectP' OR pd.ORIGDLVSALORDLINESALORDERCODE ='$projectP') AND p.PRODUCTIONORDERCODE='$rowdb21P[ORDERCODE]'	
	GROUP BY pr.LONGDESCRIPTION,p.PRODUCTIONORDERCODE,pd.SUBCODE01,pd.SUBCODE02,pd.SUBCODE03,
	pd.SUBCODE04,pd.SUBCODE05,pd.SUBCODE06,pd.SUBCODE07,pd.SUBCODE08,pd.INTERNALREFERENCE ";
$stmt4P   = db2_exec($conn1,$sqlDB24P, array('cursor'=>DB2_SCROLLABLE));
$rowdb24P = db2_fetch_assoc($stmt4P);
		
$sqlDB25P = " 
SELECT CASE WHEN PROJECTCODE <> '' THEN PROJECTCODE ELSE ORIGDLVSALORDLINESALORDERCODE  END  AS PROJECT FROM PRODUCTIONDEMAND WHERE CODE='".$rowdb21['LOTCODE']."'
";
$stmt5P   = db2_exec($conn1,$sqlDB25P, array('cursor'=>DB2_SCROLLABLE));
$rowdb25P = db2_fetch_assoc($stmt5P);		
		
	if($rowdb22P['LEGALNAME1']==""){$langgananP="";}else{$langgananP=$rowdb22P['LEGALNAME1'];}
	if($rowdb22P['ORDERPARTNERBRANDCODE']==""){$buyerP="";}else{$buyer=$rowdb22P['ORDERPARTNERBRANDCODE'];}
	if($rowdb21P['PROJAWAL']!=""){$prjAP=$rowdb21P['PROJAWAL'];}else if($rowdb25P['PROJECT']!=""){$prjAP=$rowdb25P['PROJECT'];}else{$prjAP=$rowdb24P['INTERNALREFERENCE'];}	
		
	$simpanP=mysqli_query($con,"INSERT INTO `tblkeluarkain` SET 
tglkeluar = '".$rowdb21p['TRANSACTIONDATE']."',
buyer = '".$buyerp."',
custumer = '".$langgananp."',
projectcode = '".$projectP."',
code = '".$kdbenangP."',
lot = '".$rowdb21P['LOTCODE']."',
ket = '".str_replace("'","''",$rowdb21P['NOTE'])."',
qty = '".$rowdb21P['JML']."',
berat = '".number_format(round($rowdb21P['KG'],2),2)."',
proj_awal = '".$prjAP."',
userid	= '".$rowdb21P['CREATIONUSER']."',
tgl_tutup = '".$dateY."',
tgl_buat =now()") or die("GAGAL SIMPAN PERMINTAAN POTONG");	
}			
	if($simpan){		
		echo "<script>";
		echo "alert('Stok Tgl ".$Awal." Sudah ditutup')";
		echo "</script>";
        echo "<meta http-equiv='refresh' content='0; url=TutupHarianTes'>";
		
		}			
 }
}
?>