<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=greige_masuk".date($_GET['awal']).".xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
//disini script laporan anda

?>
<?php
$Awal	= isset($_GET['awal']) ? $_GET['awal'] : '';
$Akhir	= isset($_GET['akhir']) ? $_GET['akhir'] : '';
?>
<?php
ini_set("error_reporting", 1);
include"../../koneksi.php"
?>

<div style="display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
    <!-- Logo -->
    <div style="margin-right: 20px;">
        <!-- <img src="images/logo.png" alt="Logo" style="height: 80px;"> -->
    </div>

    <!-- Judul -->
    <div style="text-align: center;">
        <h1 style="margin: 0;">LAPORAN HARIAN PEMASUKANAN KAIN GREIGE</h1>
        <h3 style="margin: 5px 0 0 0;">
            NO. FORM : FW - 19 - GKG - 02/07<br />
            HALAMAN :
        </h3>
        <!-- <p>NO. REVISI:<br/>TGL Terbit:</p> -->
    </div>
</div>
<div align="LEFT">TGL : <?php echo date($_GET['awal']); ?></div>
<table width="125%" border="1" align="Center">
  <tr align="center">

    <td rowspan="2" >No</td>
    <td rowspan="2" >Tgl</td>
    <td rowspan="2" >Langganan</td>
    <td rowspan="2" >No SJ</td>
    <td colspan="4" >Jenis Benang</td>
    <td rowspan="2" >Jenis Kain</td>
    <td rowspan="2" >Celup</td>
    <td colspan="2" >Ukuran Jadi</td>
    <td rowspan="2" >Roll</td>
    <td rowspan="2" >Quantity (KG)</td>
    <td rowspan="2" >Knitt</td>
    <td rowspan="2" >Knitt Order</td>
    <td rowspan="2" class="tombol">Keterangan</td>
     </tr>
  <tr align="center">
    <td >1</td>
    <td >2</td>
    <td >3</td>
    <td >4</td>
    <td >Lbr</td>
    <td >Grm</td>
  </tr>
    <?php 
$no=1;   
$c=0;
					  
	$sqlDB21 = " SELECT
	STOCKTRANSACTION.TRANSACTIONDATE,
	STOCKTRANSACTION.PROJECTCODE,
	STOCKTRANSACTION.CREATIONUSER,
	INTERNALDOCUMENTLINE.SUBCODE01,
    INTERNALDOCUMENTLINE.SUBCODE02,
    INTERNALDOCUMENTLINE.SUBCODE03,
    INTERNALDOCUMENTLINE.SUBCODE04,
    INTERNALDOCUMENTLINE.ORDERLINE,
    INTERNALDOCUMENTLINE.EXTERNALREFERENCE,
    INTERNALDOCUMENTLINE.ITEMDESCRIPTION,
    STOCKTRANSACTION.LOTCODE, 
    STOCKTRANSACTION.USERPRIMARYUOMCODE,
    INTERNALDOCUMENT.PROVISIONALCOUNTERCODE,    
    STOCKTRANSACTION.WHSLOCATIONWAREHOUSEZONECODE,
    STOCKTRANSACTION.WAREHOUSELOCATIONCODE,
    INTERNALDOCUMENTLINE.DESTINATIONWAREHOUSECODE,
    FULLITEMKEYDECODER.SUMMARIZEDDESCRIPTION,
    INTERNALDOCUMENT.PROVISIONALCODE,
   	SUM(STOCKTRANSACTION.BASEPRIMARYQUANTITY) AS QTY1_KG,
	SUM(STOCKTRANSACTION.WEIGHTNET) AS QTY_KG,
	COUNT(STOCKTRANSACTION.WEIGHTNET) AS QTY_ROL
FROM
    INTERNALDOCUMENT INTERNALDOCUMENT
LEFT JOIN INTERNALDOCUMENTLINE INTERNALDOCUMENTLINE ON
    INTERNALDOCUMENT.PROVISIONALCOUNTERCODE = INTERNALDOCUMENTLINE.INTDOCPROVISIONALCOUNTERCODE
    AND INTERNALDOCUMENT.PROVISIONALCODE = INTERNALDOCUMENTLINE.INTDOCUMENTPROVISIONALCODE
LEFT JOIN STOCKTRANSACTION STOCKTRANSACTION ON
    INTERNALDOCUMENTLINE.INTDOCUMENTPROVISIONALCODE = STOCKTRANSACTION.ORDERCODE
    AND INTERNALDOCUMENTLINE.ORDERLINE = STOCKTRANSACTION.ORDERLINE
LEFT JOIN FULLITEMKEYDECODER FULLITEMKEYDECODER ON
    STOCKTRANSACTION.FULLITEMIDENTIFIER = FULLITEMKEYDECODER.IDENTIFIER
WHERE
    STOCKTRANSACTION.TEMPLATECODE = '204'
    AND STOCKTRANSACTION.LOGICALWAREHOUSECODE = 'M021' 
    AND STOCKTRANSACTION.TRANSACTIONDATE BETWEEN '$Awal' AND '$Akhir'
	AND NOT INTERNALDOCUMENTLINE.ORDERLINE IS NULL
GROUP BY
	STOCKTRANSACTION.TRANSACTIONDATE,
	STOCKTRANSACTION.PROJECTCODE,
	STOCKTRANSACTION.CREATIONUSER,
	INTERNALDOCUMENTLINE.SUBCODE01,
    INTERNALDOCUMENTLINE.SUBCODE02,
    INTERNALDOCUMENTLINE.SUBCODE03,
    INTERNALDOCUMENTLINE.SUBCODE04,
    INTERNALDOCUMENTLINE.ORDERLINE,
    INTERNALDOCUMENTLINE.EXTERNALREFERENCE,
    INTERNALDOCUMENTLINE.ITEMDESCRIPTION,
    STOCKTRANSACTION.LOTCODE, 
    STOCKTRANSACTION.USERPRIMARYUOMCODE,
    INTERNALDOCUMENT.PROVISIONALCOUNTERCODE,    
    STOCKTRANSACTION.WHSLOCATIONWAREHOUSEZONECODE,
    STOCKTRANSACTION.WAREHOUSELOCATIONCODE,
    INTERNALDOCUMENTLINE.DESTINATIONWAREHOUSECODE,
    FULLITEMKEYDECODER.SUMMARIZEDDESCRIPTION,
    INTERNALDOCUMENT.PROVISIONALCODE ";
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
$itemc=trim($rowdb21['SUBCODE02'])."".trim($rowdb21['SUBCODE03']);		
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

$sqlDB25 = " SELECT a.VALUEDECIMAL  FROM PRODUCT p 
LEFT OUTER JOIN ADSTORAGE a  ON a.UNIQUEID = p.ABSUNIQUEID 
WHERE p.SUBCODE01='$rowdb21[SUBCODE01]' AND
p.SUBCODE02='$rowdb21[SUBCODE02]' AND
p.SUBCODE03='$rowdb21[SUBCODE03]' AND
p.SUBCODE04='$rowdb21[SUBCODE04]' AND
a.NAMENAME ='Width' AND
p.ITEMTYPECODE ='KFF' ";
$stmt5   = db2_exec($conn1,$sqlDB25, array('cursor'=>DB2_SCROLLABLE));
$rowdb25 = db2_fetch_assoc($stmt5);
		
$sqlDB26 = " SELECT a.VALUEDECIMAL  FROM PRODUCT p 
LEFT OUTER JOIN ADSTORAGE a  ON a.UNIQUEID = p.ABSUNIQUEID 
WHERE p.SUBCODE01='$rowdb21[SUBCODE01]' AND
p.SUBCODE02='$rowdb21[SUBCODE02]' AND
p.SUBCODE03='$rowdb21[SUBCODE03]' AND
p.SUBCODE04='$rowdb21[SUBCODE04]' AND
a.NAMENAME ='GSM' AND
p.ITEMTYPECODE ='KFF' ";
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
		
if($rowdb22['LEGALNAME1']==""){$langganan="";}else{$langganan=$rowdb22['LEGALNAME1'];}
if($rowdb22['ORDERPARTNERBRANDCODE']==""){$buyer="";}else{$buyer=$rowdb22['ORDERPARTNERBRANDCODE'];}	
if($rowdb25['VALUEDECIMAL']!=""){$lbr1=round($rowdb25['VALUEDECIMAL']);}
if($rowdb26['VALUEDECIMAL']!=""){$gsm11=round($rowdb26['VALUEDECIMAL']);}
if($rowdb21['SCHEDULEDRESOURCECODE']!=""){$noMC=$rowdb21['SCHEDULEDRESOURCECODE'];}else{$noMC=$rowdb27['NO_MESIN'];}		
$knitt1="ITTI";		
  echo"<tr>
  	<td >$no</td>
	<td >".$rowdb21['TRANSACTIONDATE']."</td>
    <td >$langganan</td>
    <td >$bon</td>
    <td >".$a[0]."</td>
    <td >".$a[1]."</td>
    <td >".$a[2]."</td>
	<td >".$a[3]."</td>
	<td >".$itemc."</td>
	<td >".trim($rowdb21['SUBCODE04'])."</td>
	<td  align=right>".$lbr1."</td>
	<td  align=right>".$gsm11."</td>
	<td  align=right>".$rowdb21['QTY_ROL']."</td>
	<td  align=right>".number_format($rowdb21['QTY_KG'],'2','.',',')."</td>
	<td >$knitt1</td>
	<td >".$rowdb21['PROJECTCODE']."</td>
	<td >".$noMC."</td>
	   </tr>";
	$totqt=$totqt+$rowdb21['QTY_KG'];
	$totr=$totr+$rowdb21['QTY_ROL'];	
  	$no++;}
  ?>
  <tr align="right">
  	<td colspan="8"  ><b>Total</b></td>
    <td ></td>
    <td ></td>
	<td ></td>
	<td ></td>
	<td > <b><?php echo $totr; ?></b></td>
	<td > <b><?php echo number_format($totqt,'2','.',','); ?></b></td>
	<td ></td>
	<td ></td>
    <td ></td>
	  </tr>

</table>

<table></table>
<table></table>

<table style="width: auto;" border="1">
    <tr>
    <td colspan="4"></td>
    <td colspan="3" style="text-align: center; vertical-align: middle;">Dibuat Oleh :</td>
    <td colspan="4" style="text-align: center; vertical-align: middle;">Diperiksa Oleh :</td>
    <td colspan="6" style="text-align: center; vertical-align: middle;">Mengertahui :</td>
    </tr>
    <tr>
    <td colspan="4" style="text-align: center; vertical-align: middle;">Nama</td>
    <td colspan="3" style="text-align: center; vertical-align: middle;"></td>
    <td colspan="4" style="text-align: center; vertical-align: middle;"></td>
    <td colspan="6" style="text-align: center; vertical-align: middle;"></td>
    </tr>
    <tr>
    <td colspan="4" style="text-align: center; vertical-align: middle;">Jabatan</td>
    <td colspan="3" style="text-align: center; vertical-align: middle;"></td>
    <td colspan="4" style="text-align: center; vertical-align: middle;"></td>
    <td colspan="6" style="text-align: center; vertical-align: middle;"></td>
    </tr>
    <tr>
    <td colspan="4" style="text-align: center; vertical-align: middle;">Tanggal</td>
    <td colspan="3" style="text-align: center; vertical-align: middle;"></td>
    <td colspan="4" style="text-align: center; vertical-align: middle;"></td>
    <td colspan="6" style="text-align: center; vertical-align: middle;"></td>
    </tr>
    <tr>
    <td colspan="4" style="text-align: center; vertical-align: middle;">Tanda Tangan</td>
    <td colspan="3" style="text-align: center; vertical-align: middle;"><br><br><br><br></td>
    <td colspan="4" style="text-align: center; vertical-align: middle;"></td>
    <td colspan="6" style="text-align: center; vertical-align: middle;"></td>
    </tr>
</table>


        


