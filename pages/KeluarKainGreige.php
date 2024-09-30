<?php
$Awal	= isset($_POST['tgl_awal']) ? $_POST['tgl_awal'] : '';
$Akhir	= isset($_POST['tgl_akhir']) ? $_POST['tgl_akhir'] : '';
?>
<!-- Main content -->
      <div class="container-fluid">
		<form role="form" method="post" enctype="multipart/form-data" name="form1">  
		<div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">Filter Data Kain Greige Keluar</h3>

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
                    <input name="tgl_akhir" value="<?php echo $Akhir;?>" type="text" class="form-control form-control-sm" id=""  autocomplete="off" required>
                 </div>
			   </div>	
            </div> 
				 
			  <button class="btn btn-info" type="submit">Cari Data</button>
          </div>		  
		  <!-- /.card-body -->          
        </div>  
			
		<div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Detail Data Kain Greige Keluar</h3>				 
          </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-sm table-bordered table-striped" style="font-size: 13px; text-align: center;">
                  <thead>
                  <tr>
                    <th rowspan="2" valign="middle" style="text-align: center">No</th>
                    <th rowspan="2" valign="middle" style="text-align: center">TglKeluar</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Buyer</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Customer</th>
                    <th rowspan="2" valign="middle" style="text-align: center">ProjectCode</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Prod. Order</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Demand</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Code</th>
                    <th rowspan="2" valign="middle" style="text-align: center">LOT</th>
                    <th colspan="4" valign="middle" style="text-align: center">Jenis Benang</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Warna</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Jenis Kain</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Qty</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Berat/Kg</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Status</th>
                    <th rowspan="2" valign="middle" style="text-align: center">User</th>
                    </tr>
                  <tr>
                    <th valign="middle" style="text-align: center">1</th>
                    <th valign="middle" style="text-align: center">2</th>
                    <th valign="middle" style="text-align: center">3</th>
                    <th valign="middle" style="text-align: center">4</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php
	 
$no=1;   
$c=0;
					  
	$sqlDB21 = " SELECT 
	 
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
	STOCKTRANSACTION.PROJECTCODE,
	COUNT(STOCKTRANSACTION.BASEPRIMARYQUANTITY) AS QTY_DUS,
	SUM(STOCKTRANSACTION.BASEPRIMARYQUANTITY) AS QTY_KG,
	ITXVIEWKNTORDER.PRODUCTIONDEMANDCODE,
	ITXVIEWKNTORDER.LEGALNAME1,
	FULLITEMKEYDECODER.SUMMARIZEDDESCRIPTION,
	ITXVIEWKK.LONGDESCRIPTION,
	ITXVIEWKK.DSUBCODE01, 
	ITXVIEWKK.DSUBCODE02,
	ITXVIEWKK.DSUBCODE03,
	ITXVIEWKK.DSUBCODE04,
	ITXVIEWKK.DSUBCODE05,
	ITXVIEWKK.DSUBCODE06,
	ITXVIEWKK.DSUBCODE07,
	ITXVIEWKK.DSUBCODE08
	FROM DB2ADMIN.STOCKTRANSACTION STOCKTRANSACTION LEFT OUTER JOIN
	(SELECT 
	ITXVIEWKNTORDER.PRODUCTIONORDERCODE,	
	ITXVIEWKNTORDER.INITIALSCHEDULEDACTUALDATE,
	LISTAGG(DISTINCT  TRIM(ITXVIEWKNTORDER.PRODUCTIONDEMANDCODE),', ') AS PRODUCTIONDEMANDCODE,
	ITXVIEWKNTORDER.LEGALNAME1 FROM 
DB2ADMIN.ITXVIEWKNTORDER
GROUP BY ITXVIEWKNTORDER.PRODUCTIONORDERCODE,
ITXVIEWKNTORDER.LEGALNAME1,
ITXVIEWKNTORDER.INITIALSCHEDULEDACTUALDATE) ITXVIEWKNTORDER
	 ON ITXVIEWKNTORDER.PRODUCTIONORDERCODE =STOCKTRANSACTION.ORDERCODE AND 
	 ITXVIEWKNTORDER.INITIALSCHEDULEDACTUALDATE=STOCKTRANSACTION.TRANSACTIONDATE
	LEFT OUTER JOIN DB2ADMIN.FULLITEMKEYDECODER FULLITEMKEYDECODER ON
    STOCKTRANSACTION.FULLITEMIDENTIFIER = FULLITEMKEYDECODER.IDENTIFIER
    LEFT OUTER JOIN ( SELECT ITXVIEWKK.LONGDESCRIPTION,
	ITXVIEWKK.DSUBCODE01, 
	ITXVIEWKK.DSUBCODE02,
	ITXVIEWKK.DSUBCODE03,
	ITXVIEWKK.DSUBCODE04,
	ITXVIEWKK.DSUBCODE05,
	ITXVIEWKK.DSUBCODE06,
	ITXVIEWKK.DSUBCODE07,
	ITXVIEWKK.DSUBCODE08,
	ITXVIEWKK.PRODUCTIONORDERCODE,
	ITXVIEWKK.PROJECTCODE
FROM ITXVIEWKK 
GROUP BY 
ITXVIEWKK.LONGDESCRIPTION,
	ITXVIEWKK.DSUBCODE01, 
	ITXVIEWKK.DSUBCODE02,
	ITXVIEWKK.DSUBCODE03,
	ITXVIEWKK.DSUBCODE04,
	ITXVIEWKK.DSUBCODE05,
	ITXVIEWKK.DSUBCODE06,
	ITXVIEWKK.DSUBCODE07,
	ITXVIEWKK.DSUBCODE08,
	ITXVIEWKK.PRODUCTIONORDERCODE,
	ITXVIEWKK.PROJECTCODE) ITXVIEWKK ON ITXVIEWKK.PRODUCTIONORDERCODE =STOCKTRANSACTION.ORDERCODE AND 
    ITXVIEWKK.PROJECTCODE = STOCKTRANSACTION.PROJECTCODE
WHERE (STOCKTRANSACTION.ITEMTYPECODE ='KGF' OR STOCKTRANSACTION.ITEMTYPECODE ='FKG') and STOCKTRANSACTION.LOGICALWAREHOUSECODE ='M021' AND
STOCKTRANSACTION.ONHANDUPDATE > 1 AND TRANSACTIONDATE BETWEEN '$Awal' AND '$Akhir' AND NOT ORDERCODE IS NULL 
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
	STOCKTRANSACTION.PROJECTCODE,
	ITXVIEWKNTORDER.LEGALNAME1,
	ITXVIEWKNTORDER.PRODUCTIONDEMANDCODE,
	FULLITEMKEYDECODER.SUMMARIZEDDESCRIPTION,
	ITXVIEWKK.LONGDESCRIPTION,
	ITXVIEWKK.DSUBCODE01, 
	ITXVIEWKK.DSUBCODE02,
	ITXVIEWKK.DSUBCODE03,
	ITXVIEWKK.DSUBCODE04,
	ITXVIEWKK.DSUBCODE05,
	ITXVIEWKK.DSUBCODE06,
	ITXVIEWKK.DSUBCODE07,
	ITXVIEWKK.DSUBCODE08
";
	$stmt1   = db2_exec($conn1,$sqlDB21, array('cursor'=>DB2_SCROLLABLE));
	//}				  
    while($rowdb21 = db2_fetch_assoc($stmt1)){ 
if ($rowdb21['LOGICALWAREHOUSECODE'] =='M501') { $knitt = 'LT2'; }
else if($rowdb21['LOGICALWAREHOUSECODE'] ='P501'){ $knitt = 'LT1'; }
$kdbenang=trim($rowdb21['DECOSUBCODE01'])." ".trim($rowdb21['DECOSUBCODE02'])." ".trim($rowdb21['DECOSUBCODE03'])." ".trim($rowdb21['DECOSUBCODE04'])." ".trim($rowdb21['DECOSUBCODE05'])." ".trim($rowdb21['DECOSUBCODE06'])." ".trim($rowdb21['DECOSUBCODE07'])." ".trim($rowdb21['DECOSUBCODE08']);
$sqlDB22 = " SELECT SALESORDER.CODE, SALESORDER.EXTERNALREFERENCE, SALESORDER.ORDPRNCUSTOMERSUPPLIERCODE,
		ITXVIEWAKJ.LEGALNAME1, ITXVIEWAKJ.ORDERPARTNERBRANDCODE, ITXVIEWAKJ.LONGDESCRIPTION
		FROM DB2ADMIN.SALESORDER SALESORDER LEFT OUTER JOIN DB2ADMIN.ITXVIEWAKJ 
       	ITXVIEWAKJ ON SALESORDER.CODE=ITXVIEWAKJ.CODE
		WHERE SALESORDER.CODE='$rowdb21[PROJECTCODE]' ";
$stmt2   = db2_exec($conn1,$sqlDB22, array('cursor'=>DB2_SCROLLABLE));
$rowdb22 = db2_fetch_assoc($stmt2);
		
$sqlDB23 = " SELECT p.SUBCODE01,p.SUBCODE02,p.SUBCODE03,p.SUBCODE04,p.SUBCODE05,p.SUBCODE06,p.SUBCODE07, p.LONGDESCRIPTION FROM (
SELECT p2.ITEMTYPEAFICODE,p2.SUBCODE01,p2.SUBCODE02,p2.SUBCODE03,p2.SUBCODE04,
p2.SUBCODE05,p2.SUBCODE06,p2.SUBCODE07  FROM PRODUCTIONDEMAND p 
LEFT OUTER JOIN PRODUCTIONRESERVATION p2 ON p.CODE =p2.ORDERCODE 
WHERE p.ITEMTYPEAFICODE ='KGF' AND p.SUBCODE01='".trim($rowdb21['DECOSUBCODE01'])."' 
AND p.SUBCODE02 ='".trim($rowdb21['DECOSUBCODE02'])."' AND p.SUBCODE03 ='".trim($rowdb21['DECOSUBCODE03'])."' AND
p.SUBCODE04='".trim($rowdb21['DECOSUBCODE04'])."' AND p.PROJECTCODE ='".trim($rowdb21['PROJECTCODE'])."'
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
while($rowdb23 = db2_fetch_assoc($stmt3)){
	$a[$ai]=$rowdb23['LONGDESCRIPTION'];
	$ai++;
}
$sqlDB24 = " SELECT ITXVIEWKK.LONGDESCRIPTION,
	ITXVIEWKK.DSUBCODE01, 
	ITXVIEWKK.DSUBCODE02,
	ITXVIEWKK.DSUBCODE03,
	ITXVIEWKK.DSUBCODE04,
	ITXVIEWKK.DSUBCODE05,
	ITXVIEWKK.DSUBCODE06,
	ITXVIEWKK.DSUBCODE07,
	ITXVIEWKK.DSUBCODE08,
	ITXVIEWKK.PRODUCTIONORDERCODE,
	ITXVIEWKK.PROJECTCODE,
	LISTAGG(DISTINCT  TRIM(ITXVIEWKK.DEAMAND),', ') AS PRODUCTIONDEMANDCODE
FROM ITXVIEWKK 
WHERE ITXVIEWKK.PRODUCTIONORDERCODE='$rowdb21[ORDERCODE]' AND ITXVIEWKK.PROJECTCODE='$rowdb21[PROJECTCODE]'
GROUP BY 
ITXVIEWKK.LONGDESCRIPTION,
	ITXVIEWKK.DSUBCODE01, 
	ITXVIEWKK.DSUBCODE02,
	ITXVIEWKK.DSUBCODE03,
	ITXVIEWKK.DSUBCODE04,
	ITXVIEWKK.DSUBCODE05,
	ITXVIEWKK.DSUBCODE06,
	ITXVIEWKK.DSUBCODE07,
	ITXVIEWKK.DSUBCODE08,
	ITXVIEWKK.PRODUCTIONORDERCODE,
	ITXVIEWKK.PROJECTCODE ";
$stmt4   = db2_exec($conn1,$sqlDB24, array('cursor'=>DB2_SCROLLABLE));
$rowdb24 = db2_fetch_assoc($stmt4);
		
	if($rowdb22['LEGALNAME1']==""){$langganan="";}else{$langganan=$rowdb22['LEGALNAME1'];}
	if($rowdb22['ORDERPARTNERBRANDCODE']==""){$buyer="";}else{$buyer=$rowdb22['ORDERPARTNERBRANDCODE'];}
		
?>
	  <tr>
	  <td style="text-align: center"><?php echo $no;?></td>
	  <td style="text-align: center"><?php echo $rowdb21['TRANSACTIONDATE']; ?></td>
	  <td style="text-align: left"><?php echo $buyer; ?></td>
	  <td style="text-align: left"><?php echo $langganan; ?></td>
	  <td style="text-align: center"><?php echo $rowdb21['PROJECTCODE']; ?></td>
	  <td style="text-align: center"><?php echo $rowdb21['ORDERCODE']; ?></td>
	  <td><span style="text-align: center"><?php echo $rowdb24['PRODUCTIONDEMANDCODE']; ?></span></td>
      <td><?php echo $kdbenang; ?></td> 
      <td style="text-align: center"><?php echo $rowdb21['LOTCODE']; ?></td>
      <td style="text-align: left"><?php echo $a[0]; ?></td>
      <td style="text-align: left"><?php echo $a[1]; ?></td>
      <td style="text-align: left"><?php echo $a[2]; ?></td>
      <td style="text-align: left"><?php echo $a[3]; ?></td>
      <td style="text-align: left"><?php echo $rowdb21['LONGDESCRIPTION']; ?></td>
      <td style="text-align: left"><?php echo $rowdb21['SUMMARIZEDDESCRIPTION']; ?></td>
      <td style="text-align: center"><?php echo $rowdb21['QTY_DUS']; ?></td>
      <td style="text-align: right"><?php echo number_format(round($rowdb21['QTY_KG'],2),2); ?></td>
      <td style="text-align: center">&nbsp;</td>
      <td style="text-align: center"><?php  echo $rowdb21['CREATIONUSER']; ?></td>
      </tr>
	  				  
	<?php 
	 $no++; 
	$totRol=$totRol+$rowdb21['QTY_DUS'];
	$totKG=$totKG+$rowdb21['QTY_KG'];	
	
	} ?>
				  </tbody>
     <tfoot>
	<tr>
	    <th style="text-align: center">&nbsp;</th>
	    <th style="text-align: center">&nbsp;</th>
	    <th style="text-align: left">&nbsp;</th>
	    <th style="text-align: left">&nbsp;</th>
	    <th style="text-align: center">&nbsp;</th>
	    <th style="text-align: center">&nbsp;</th>
	    <th>&nbsp;</th>
	    <th>&nbsp;</th>
	    <th style="text-align: center">&nbsp;</th>
	    <th style="text-align: left">&nbsp;</th>
	    <th style="text-align: left">&nbsp;</th>
	    <th style="text-align: left">&nbsp;</th>
	    <th style="text-align: left">&nbsp;</th>
	    <th style="text-align: left">&nbsp;</th>
	    <th style="text-align: left">Total</th>
	    <th style="text-align: center"><?php echo $totRol;?></th>
	    <th style="text-align: right"><?php echo number_format(round($totKG,2),2);?></th>
	    <th style="text-align: center">&nbsp;</th>
	    <th style="text-align: center">&nbsp;</th>
	    </tr>				
	 </tfoot>             
                </table>
              </div>
              <!-- /.card-body -->
            </div> 
	</form>		
      </div><!-- /.container-fluid -->
    <!-- /.content -->
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