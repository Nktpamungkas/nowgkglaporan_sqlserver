<?php
$Thn2			= isset($_POST['thn']) ? $_POST['thn'] : '';
$Bln2			= isset($_POST['bln']) ? $_POST['bln'] : '';
$Dept			= isset($_POST['dept']) ? $_POST['dept'] : '';
$Bulan			= $Thn2."-".$Bln2;
if($Thn2!="" and $Bln2!=""){
$d				= cal_days_in_month(CAL_GREGORIAN,$Bln2,$Thn2);
$Lalu 		= $Bln2-1;	
	if($Lalu=="0"){
	if(strlen($Lalu)==1){$bl0="0".$Lalu;}else{$bl0=$Lalu;}	
	$BlnLalu="12";	
	$Thn=$Thn2-1;
	$TBln=$Thn."-".$BlnLalu;	
	}else{
	if(strlen($Lalu)==1){$bl0="0".$Lalu;}else{$bl0=$Lalu;}	
	$BlnLalu=$bl0;
	$TBln=$Thn2."-".$BlnLalu;	
	}	
$Awal	= $Bulan."-01";
$Akhir	= $Bulan."-".$d;	
}
?>
<!-- Main content -->
      <div class="container-fluid">
		<form role="form" method="post" enctype="multipart/form-data" name="form1">  
		<div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Filter Data Gudang Greige Per Bulan</h3>

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
			<div class="col-sm-1">
                	<select name="thn" class="form-control form-control-sm  select2"> 
                	<option value="">Pilih Tahun</option>
        <?php
                $thn_skr = date('Y');
                for ($x = $thn_skr; $x >= 2022; $x--) {
                ?>
        <option value="<?php echo $x ?>" <?php if($Thn2!=""){if($Thn2==$x){echo "SELECTED";}}else{if($x==$thn_skr){echo "SELECTED";}} ?>><?php echo $x ?></option>
        <?php
                }
   ?>
                	</select>
                	</div>
		       	<div class="col-sm-2">
                	<select name="bln" class="form-control form-control-sm  select2"> 
                	<option value="">Pilih Bulan</option>
					<option value="01" <?php if($Bln2=="01"){ echo "SELECTED";}?>>Januari</option>
					<option value="02" <?php if($Bln2=="02"){ echo "SELECTED";}?>>Febuari</option>
					<option value="03" <?php if($Bln2=="03"){ echo "SELECTED";}?>>Maret</option>
					<option value="04" <?php if($Bln2=="04"){ echo "SELECTED";}?>>April</option>
					<option value="05" <?php if($Bln2=="05"){ echo "SELECTED";}?>>Mei</option>
					<option value="06" <?php if($Bln2=="06"){ echo "SELECTED";}?>>Juni</option>
					<option value="07" <?php if($Bln2=="07"){ echo "SELECTED";}?>>Juli</option>
					<option value="08" <?php if($Bln2=="08"){ echo "SELECTED";}?>>Agustus</option>
					<option value="09" <?php if($Bln2=="09"){ echo "SELECTED";}?>>September</option>
					<option value="10" <?php if($Bln2=="10"){ echo "SELECTED";}?>>Oktober</option>
					<option value="11" <?php if($Bln2=="11"){ echo "SELECTED";}?>>November</option>
					<option value="12" <?php if($Bln2=="12"){ echo "SELECTED";}?>>Desember</option>	
                	</select>
                	</div>		
				 <!-- /.input group -->
			
              	  
          </div>
			  
				 
			 
          </div>		  
		  <div class="card-footer"> 
			  <button class="btn btn-info" type="submit">Cari Data</button>
		  </div>	
		  <!-- /.card-body -->          
        </div>  
		<?php if($Bln2!="" and $Thn!=""){ ?>
		<div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Detail Laporan Stok Bulanan Kain Greige<!--<a href="pages/cetak/lapgmasuk_excel1.php?awal=<?php echo $Awal;?>&akhir=<?php echo $Akhir;?>" class="btn bg-blue float-right" target="_blank">Cetak Excel</a>-->          </h3>
          </div>
              <!-- /.card-header -->
              <div class="card-body"><br>
                <table id="example16" width="100%" class="table table-sm table-bordered table-striped" style="font-size: 11px; text-align: center;">
                  <thead>
                  <tr>
                    <th width="5%" rowspan="2" valign="middle" style="text-align: center">No</th>
                    <th width="5%" rowspan="2" valign="middle" style="text-align: center">Langganan</th>
                    <th colspan="4" valign="middle" style="text-align: center">Jenis Benang</th>
                    <th width="5%" rowspan="2" valign="middle" style="text-align: center">Jenis Kain</th>
                    <th colspan="2" valign="middle" style="text-align: center">Ukuran Jadi</th>
                    <th width="5%" rowspan="2" valign="middle" style="text-align: center">Knitt</th>
                    <th width="5%" rowspan="2" valign="middle" style="text-align: center">Knitt Order</th>
                    <th colspan="2" valign="middle" style="text-align: center">Stock</th>
                    <th width="5%" rowspan="2" valign="middle" style="text-align: center">Lama</th>
                    <th width="15%" rowspan="2" valign="middle" style="text-align: center">Keterangan</th>
                    </tr>
                  <tr>
                    <th width="6%" valign="middle" style="text-align: center">1</th>
                    <th width="6%" valign="middle" style="text-align: center">2</th>
                    <th width="7%" valign="middle" style="text-align: center">3</th>
                    <th width="8%" valign="middle" style="text-align: center">4</th>
                    <th width="10%" valign="middle" style="text-align: center">Lbr</th>
                    <th width="8%" valign="middle" style="text-align: center">Grm</th>
                    <th width="6%" valign="middle" style="text-align: center">Roll</th>
                    <th width="4%" valign="middle" style="text-align: center">Quantity (KG)</th>
                    </tr>
                  </thead>
                  <tbody>
<?php
	$no=1;				  
	$sqlDB21 = " SELECT STOCKTRANSACTION.TRANSACTIONDATE,STOCKTRANSACTION.PROJECTCODE,STOCKTRANSACTION.CREATIONUSER,ITXVIEWLAPMASUKGREIGE.SUBCODE01,
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
WHERE STOCKTRANSACTION.TRANSACTIONDATE BETWEEN '$Awal' AND '$Akhir' and STOCKTRANSACTION.LOGICALWAREHOUSECODE ='M021' 
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
	$stmt1   = db2_exec($conn1,$sqlDB21, array('cursor'=>DB2_SCROLLABLE));
	//}				  
    while($rowdb21 = db2_fetch_assoc($stmt1)){
$sqlDB22 = " SELECT SALESORDER.CODE, SALESORDER.EXTERNALREFERENCE, SALESORDER.ORDPRNCUSTOMERSUPPLIERCODE,
		ITXVIEWAKJ.LEGALNAME1, ITXVIEWAKJ.ORDERPARTNERBRANDCODE, ITXVIEWAKJ.LONGDESCRIPTION
		FROM DB2ADMIN.SALESORDER SALESORDER LEFT OUTER JOIN DB2ADMIN.ITXVIEWAKJ 
       	ITXVIEWAKJ ON SALESORDER.CODE=ITXVIEWAKJ.CODE
		WHERE SALESORDER.CODE='".trim($rowdb21['PROJECTCODE'])."' ";
$stmt2   = db2_exec($conn1,$sqlDB22, array('cursor'=>DB2_SCROLLABLE));
$rowdb22 = db2_fetch_assoc($stmt2);		
$sqlDB23 = " SELECT p.SUBCODE01,p.SUBCODE02,p.SUBCODE03,p.SUBCODE04,p.SUBCODE05,p.SUBCODE06,p.SUBCODE07, p.LONGDESCRIPTION FROM (
SELECT p2.ITEMTYPEAFICODE,p2.SUBCODE01,p2.SUBCODE02,p2.SUBCODE03,p2.SUBCODE04,
p2.SUBCODE05,p2.SUBCODE06,p2.SUBCODE07  FROM PRODUCTIONDEMAND p 
LEFT OUTER JOIN PRODUCTIONRESERVATION p2 ON p.CODE =p2.ORDERCODE 
WHERE p.ITEMTYPEAFICODE ='KGF' AND p.SUBCODE01='".trim($rowdb21['SUBCODE01'])."' 
AND p.SUBCODE02 ='".trim($rowdb21['SUBCODE02'])."' AND p.SUBCODE03 ='".trim($rowdb21['SUBCODE03'])."' AND
p.SUBCODE04='".trim($rowdb21['SUBCODE04'])."' AND (p.PROJECTCODE ='".trim($rowdb21['PROJECTCODE'])."' OR p.ORIGDLVSALORDLINESALORDERCODE  ='".trim($rowdb21['PROJECTCODE'])."')
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
		
$bon=trim($rowdb21['PROVISIONALCODE'])."-".trim($rowdb21['ORDERLINE']);
$itemc=trim($rowdb21['SUBCODE02'])."".trim($rowdb21['SUBCODE03'])." ".trim($rowdb21['SUBCODE04']);		
if (trim($rowdb21['PROVISIONALCOUNTERCODE']) =='I02M50') { $knitt = 'KNITTING ITTI- GREIGE'; } 
$sqlDB24 = " SELECT LISTAGG(DISTINCT  TRIM(BLKOKASI.WAREHOUSELOCATIONCODE),', ') AS WAREHOUSELOCATIONCODE
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
WHERE STOCKTRANSACTION.ORDERCODE ='$rowdb21[PROVISIONALCODE]'  and STOCKTRANSACTION.ORDERLINE ='$rowdb21[ORDERLINE]' AND
STOCKTRANSACTION.LOGICALWAREHOUSECODE ='M021' 
AND NOT ITXVIEWLAPMASUKGREIGE.ORDERLINE IS NULL) AS BLKOKASI ";
$stmt4   = db2_exec($conn1,$sqlDB24, array('cursor'=>DB2_SCROLLABLE));					  
$rowdb24 = db2_fetch_assoc($stmt4);	

$sqlDB25 = " SELECT
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
	QUALITYDOCLINE.QUALITYDOCPRODUCTIONORDERCODE='$rowdb21[EXTERNALREFERENCE]' ";
$stmt5   = db2_exec($conn1,$sqlDB25, array('cursor'=>DB2_SCROLLABLE));
$rowdb25 = db2_fetch_assoc($stmt5);
		
$sqlDB26 = " SELECT
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
	QUALITYDOCLINE.QUALITYDOCPRODUCTIONORDERCODE='$rowdb21[EXTERNALREFERENCE]' ";
$stmt6   = db2_exec($conn1,$sqlDB26, array('cursor'=>DB2_SCROLLABLE));
$rowdb26 = db2_fetch_assoc($stmt6);			
		
$sqlDB27 = " 
SELECT ad.VALUESTRING AS NO_MESIN
FROM PRODUCTIONDEMAND pd 	
LEFT OUTER JOIN ADSTORAGE ad ON ad.UNIQUEID = pd.ABSUNIQUEID AND ad.NAMENAME ='MachineNo'
WHERE  pd.CODE ='$rowdb21[LOTCODE]'
GROUP BY ad.VALUESTRING
";
$stmt7   = db2_exec($conn1,$sqlDB27, array('cursor'=>DB2_SCROLLABLE));					  
$rowdb27 = db2_fetch_assoc($stmt7);	
$sqlDB28 = " SELECT a.VALUEDECIMAL  FROM PRODUCT p 
LEFT OUTER JOIN ADSTORAGE a  ON a.UNIQUEID = p.ABSUNIQUEID 
WHERE p.SUBCODE01='$rowdb21[SUBCODE01]' AND
p.SUBCODE02='$rowdb21[SUBCODE02]' AND
p.SUBCODE03='$rowdb21[SUBCODE03]' AND
p.SUBCODE04='$rowdb21[SUBCODE04]' AND
a.NAMENAME ='Width' AND
p.ITEMTYPECODE ='KFF'  ";
$stmt8   = db2_exec($conn1,$sqlDB28, array('cursor'=>DB2_SCROLLABLE));
$rowdb28 = db2_fetch_assoc($stmt8);	
$sqlDB29 = " SELECT a.VALUEDECIMAL  FROM PRODUCT p 
LEFT OUTER JOIN ADSTORAGE a  ON a.UNIQUEID = p.ABSUNIQUEID 
WHERE p.SUBCODE01='$rowdb21[SUBCODE01]' AND
p.SUBCODE02='$rowdb21[SUBCODE02]' AND
p.SUBCODE03='$rowdb21[SUBCODE03]' AND
p.SUBCODE04='$rowdb21[SUBCODE04]' AND
a.NAMENAME ='GSM' AND
p.ITEMTYPECODE ='KFF'  ";
$stmt9   = db2_exec($conn1,$sqlDB29, array('cursor'=>DB2_SCROLLABLE));
$rowdb29 = db2_fetch_assoc($stmt9);
$sqlDB30 = " 
SELECT e.WIDTHGROSS AS LEBAR1,a.VALUEDECIMAL AS GSM1,s.ORDERCODE,s.ORDERLINE  FROM ELEMENTSINSPECTION e 
LEFT OUTER JOIN ADSTORAGE a ON a.UNIQUEID =e.ABSUNIQUEID AND a.NAMENAME ='GSM'
LEFT OUTER JOIN STOCKTRANSACTION s ON s.ITEMELEMENTCODE =e.ELEMENTCODE
WHERE s.ORDERCODE='".$rowdb21['PROVISIONALCODE']."' AND s.ORDERLINE='".$rowdb21['ORDERLINE']."'
GROUP BY s.ORDERCODE,s.ORDERLINE,e.WIDTHGROSS,a.VALUEDECIMAL
";
$stmt10   = db2_exec($conn1,$sqlDB30, array('cursor'=>DB2_SCROLLABLE));					  
$rowdb30 = db2_fetch_assoc($stmt10);		
if($rowdb22['LEGALNAME1']==""){$langganan="";}else{$langganan=$rowdb22['LEGALNAME1'];}
if($rowdb22['ORDERPARTNERBRANDCODE']==""){$buyer="";}else{$buyer=$rowdb22['ORDERPARTNERBRANDCODE'];}		
?>			  
	  <tr>
	    <td align="center"><?php echo $no; ?></td>
	    <td align="left"><?php echo $langganan."/".$buyer; ?></td>
	    <td align="left"><?php echo $a[0]; ?></td>
	    <td align="left"><?php echo $a[1]; ?></td>
	    <td align="left"><?php echo $a[2]; ?></td>
	    <td align="left"><?php echo $a[3]; ?></td>
	  <td align="left"><?php echo $rowdb21['SUMMARIZEDDESCRIPTION']; ?></td>
      <td align="center"><?php echo round($rowdb28['VALUEDECIMAL']); ?></td>
      <td align="center"><?php echo round($rowdb29['VALUEDECIMAL']); ?></td>
      <td align="center">ITTI</td>
      <td align="center"><?php echo $rowdb21['PROJECTCODE']; ?></td>
      <td align="right"><?php echo $rowdb21['QTY_ROL']; ?></td>
      <td align="right"><?php echo $rowdb21['QTY_KG']; ?></td>
      <td align="right">&nbsp;</td>
      <td align="right">&nbsp;</td>
      </tr>
	  				  
	<?php 
	 $no++; 
	$trol+=$rowdb21['QTY_ROL'];
	$tKg+=$rowdb21['QTY_KG'];
	} 
	$tS=($total+$tM)-$tK;
					  ?>
				  </tbody>
                  <tfoot>
	 <tr>
	   <td align="right">&nbsp;</td>
	   <td align="right">&nbsp;</td>
	   <td>&nbsp;</td>
	    <td align="right">&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td align="right">&nbsp;</td>
	    <td align="right">&nbsp;</td>
	    <td>&nbsp;</td>
	    <td align="right">&nbsp;</td>
	    <td align="right">&nbsp;</td>
	    <td align="right"><?php echo $trol; ?></td>
	    <td align="right"><?php echo $tKg; ?></td>
	    <td align="right">&nbsp;</td>
	    <td align="right">&nbsp;</td>
	    </tr>				
					</tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div> 
		<?php } ?>	
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