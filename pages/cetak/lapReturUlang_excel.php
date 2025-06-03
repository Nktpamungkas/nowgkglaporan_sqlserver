<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=retur_produksi".date($_GET['awal']).".xls");//ganti nama sesuai keperluan
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
        <h1 style="margin: 0;">LAPORAN RETUR PRODUKSI</h1>
        <h3 style="margin: 5px 0 0 0;">
            NO. FORM : 
            <!-- FW - 19 - GKG - 02/07 -->
             <br />
            HALAMAN:
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
					  
	$sqlDB21R = " SELECT s.PROJECTCODE,f.SUMMARIZEDDESCRIPTION,
s.TRANSACTIONDATE,s.DECOSUBCODE01,s.DECOSUBCODE02,s.DECOSUBCODE03,
s.DECOSUBCODE04,s.WHSLOCATIONWAREHOUSEZONECODE,s.WAREHOUSELOCATIONCODE,
s.LOTCODE,SUM(s.BASEPRIMARYQUANTITY) AS KG,COUNT(s.ITEMELEMENTCODE) AS JML, a2.VALUESTRING AS ALURPROSES,
s.CREATIONUSER,a1.VALUESTRING AS NOMESIN FROM STOCKTRANSACTION s 
LEFT OUTER JOIN ADSTORAGE a ON a.UNIQUEID = s.ABSUNIQUEID AND a.NAMENAME = 'StatusRetur'
LEFT OUTER JOIN PRODUCTIONDEMAND p ON p.CODE = s.LOTCODE
LEFT OUTER JOIN ADSTORAGE a1 ON a1.UNIQUEID = p.ABSUNIQUEID AND a1.NAMENAME = 'MachineNo'
LEFT OUTER JOIN ADSTORAGE a2 ON a2.UNIQUEID = s.ABSUNIQUEID AND a2.NAMENAME = 'AlurProses'
LEFT OUTER JOIN FULLITEMKEYDECODER f ON s.FULLITEMIDENTIFIER = f.IDENTIFIER
WHERE s.TRANSACTIONDATE BETWEEN '$Awal' AND '$Akhir' AND s.ITEMTYPECODE='KGF' AND 
s.LOGICALWAREHOUSECODE ='M021' AND s.TEMPLATECODE = 'OPN' AND a.VALUESTRING =  '1'
GROUP BY s.PROJECTCODE,
s.TRANSACTIONDATE,s.DECOSUBCODE01,s.DECOSUBCODE02,
s.DECOSUBCODE03, s.DECOSUBCODE04,
s.WHSLOCATIONWAREHOUSEZONECODE,
s.WAREHOUSELOCATIONCODE, s.LOTCODE, f.SUMMARIZEDDESCRIPTION, s.CREATIONUSER, a1.VALUESTRING, a2.VALUESTRING";
	$stmt1R   = db2_exec($conn1,$sqlDB21R, array('cursor'=>DB2_SCROLLABLE));

	//}				  
    while($rowdb21R = db2_fetch_assoc($stmt1R)){ 
$itemcR=trim($rowdb21R['DECOSUBCODE02'])."".trim($rowdb21R['DECOSUBCODE03']);
		
$sqlDB22R1 = " SELECT SALESORDER.CODE, SALESORDER.EXTERNALREFERENCE, SALESORDER.ORDPRNCUSTOMERSUPPLIERCODE,
		ITXVIEWAKJ.LEGALNAME1, ITXVIEWAKJ.ORDERPARTNERBRANDCODE, ITXVIEWAKJ.LONGDESCRIPTION
		FROM DB2ADMIN.SALESORDER SALESORDER LEFT OUTER JOIN DB2ADMIN.ITXVIEWAKJ 
       	ITXVIEWAKJ ON SALESORDER.CODE=ITXVIEWAKJ.CODE
		WHERE SALESORDER.CODE='".trim($rowdb21R['PROJECTCODE'])."' ";
$stmt2R1   = db2_exec($conn1,$sqlDB22R1, array('cursor'=>DB2_SCROLLABLE));
$rowdb22R1 = db2_fetch_assoc($stmt2R1);
		
$sqlDB22R = " SELECT LISTAGG(DISTINCT  TRIM(BALANCE.WAREHOUSELOCATIONCODE),', ') AS WAREHOUSELOCATIONCODE, COUNT(BALANCE.BASEPRIMARYQUANTITYUNIT) AS ROL,SUM(BALANCE.BASEPRIMARYQUANTITYUNIT) AS BERAT,BALANCE.LOTCODE  
		FROM (
		SELECT 
s.ITEMELEMENTCODE  FROM STOCKTRANSACTION s 
LEFT OUTER JOIN ADSTORAGE a ON a.UNIQUEID = s.ABSUNIQUEID AND a.NAMENAME = 'StatusRetur'
WHERE s.PROJECTCODE='".$rowdb21R['PROJECTCODE']."' AND s.ITEMTYPECODE='KGF' AND 
s.DECOSUBCODE02='".$rowdb21R['DECOSUBCODE02']."' AND s.DECOSUBCODE03='".$rowdb21R['DECOSUBCODE03']."' AND 
s.DECOSUBCODE04='".$rowdb21R['DECOSUBCODE04']."' AND s.LOGICALWAREHOUSECODE ='M021' AND
s.LOTCODE='$rowdb21R[LOTCODE]' AND 
s.TEMPLATECODE = 'OPN' AND a.VALUESTRING =  '1'
GROUP BY 
s.ITEMELEMENTCODE
		) STOCKTRANSACTION LEFT OUTER JOIN 
		DB2ADMIN.BALANCE BALANCE ON BALANCE.ELEMENTSCODE =STOCKTRANSACTION.ITEMELEMENTCODE  
		GROUP BY BALANCE.LOTCODE ";					  
		$stmt2R   = db2_exec($conn1,$sqlDB22R, array('cursor'=>DB2_SCROLLABLE));	
		$rowdb22R = db2_fetch_assoc($stmt2R);
$sqlDB23R = " SELECT p.SUBCODE01,p.SUBCODE02,p.SUBCODE03,p.SUBCODE04,p.SUBCODE05,p.SUBCODE06,p.SUBCODE07, p.LONGDESCRIPTION FROM (
SELECT p2.ITEMTYPEAFICODE,p2.SUBCODE01,p2.SUBCODE02,p2.SUBCODE03,p2.SUBCODE04,
p2.SUBCODE05,p2.SUBCODE06,p2.SUBCODE07  FROM PRODUCTIONDEMAND p 
LEFT OUTER JOIN PRODUCTIONRESERVATION p2 ON p.CODE =p2.ORDERCODE 
WHERE p.ITEMTYPEAFICODE ='KGF' AND p.SUBCODE01='".trim($rowdb21R['DECOSUBCODE01'])."' 
AND p.SUBCODE02 ='".trim($rowdb21R['DECOSUBCODE02'])."' AND p.SUBCODE03 ='".trim($rowdb21R['DECOSUBCODE03'])."' AND
p.SUBCODE04='".trim($rowdb21R['DECOSUBCODE04'])."' AND (p.PROJECTCODE ='".trim($rowdb21R['PROJECTCODE'])."' OR p.ORIGDLVSALORDLINESALORDERCODE  ='".trim($rowdb21R['PROJECTCODE'])."')
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
$stmt3R   = db2_exec($conn1,$sqlDB23R, array('cursor'=>DB2_SCROLLABLE));
$aiR=0;
$aR[0]="";
$aR[1]="";
$aR[2]="";
$aR[3]="";		
while($rowdb23R = db2_fetch_assoc($stmt3R)){
	$aR[$aiR]=$rowdb23R['LONGDESCRIPTION'];
	$aiR++;
}	
/*$sqlDB26R = " SELECT e.WIDTHGROSS AS LEBAR1,a.VALUEDECIMAL AS GSM1, e.DEMANDCODE  FROM ELEMENTSINSPECTION e 
LEFT OUTER JOIN ADSTORAGE a ON a.UNIQUEID =e.ABSUNIQUEID AND a.NAMENAME ='GSM'
WHERE e.ELEMENTITEMTYPECODE='KGF' AND e.DEMANDCODE='$rowdb21R[LOTCODE]'
GROUP BY e.WIDTHGROSS,a.VALUEDECIMAL,e.DEMANDCODE ";
$stmt6R   = db2_exec($conn1,$sqlDB26R, array('cursor'=>DB2_SCROLLABLE));
$rowdb26R = db2_fetch_assoc($stmt6R);*/

$sqlDB28R = " SELECT a.VALUEDECIMAL  FROM PRODUCT p 
LEFT OUTER JOIN ADSTORAGE a  ON a.UNIQUEID = p.ABSUNIQUEID 
WHERE p.SUBCODE01='".trim($rowdb21R['DECOSUBCODE01'])."' AND
p.SUBCODE02='".trim($rowdb21R['DECOSUBCODE02'])."' AND
p.SUBCODE03='".trim($rowdb21R['DECOSUBCODE03'])."' AND
p.SUBCODE04='".trim($rowdb21R['DECOSUBCODE04'])."' AND
a.NAMENAME ='Width' AND
p.ITEMTYPECODE ='KFF'  ";
$stmt8R   = db2_exec($conn1,$sqlDB28R, array('cursor'=>DB2_SCROLLABLE));
$rowdb28R = db2_fetch_assoc($stmt8R);	
$sqlDB29R = " SELECT a.VALUEDECIMAL  FROM PRODUCT p 
LEFT OUTER JOIN ADSTORAGE a  ON a.UNIQUEID = p.ABSUNIQUEID 
WHERE p.SUBCODE01='".trim($rowdb21R['DECOSUBCODE01'])."' AND
p.SUBCODE02='".trim($rowdb21R['DECOSUBCODE02'])."' AND
p.SUBCODE03='".trim($rowdb21R['DECOSUBCODE03'])."' AND
p.SUBCODE04='".trim($rowdb21R['DECOSUBCODE04'])."' AND
a.NAMENAME ='GSM' AND
p.ITEMTYPECODE ='KFF'  ";
$stmt9R   = db2_exec($conn1,$sqlDB29R, array('cursor'=>DB2_SCROLLABLE));
$rowdb29R = db2_fetch_assoc($stmt9R);		
if($rowdb22R1['LEGALNAME1']==""){$langganan="";}else{$langganan=$rowdb22R1['LEGALNAME1'];}
if($rowdb22R1['ORDERPARTNERBRANDCODE']==""){$buyer="";}else{$buyer=$rowdb22R1['ORDERPARTNERBRANDCODE'];}
if($rowdb28R['VALUEDECIMAL']!=""){$lbr1=round($rowdb28R['VALUEDECIMAL']);}
if($rowdb29R['VALUEDECIMAL']!=""){$gsm11=round($rowdb29R['VALUEDECIMAL']);}

$knitt1="ITTI";		
  echo"<tr>
  	<td >$no</td>
	<td >".$rowdb21R['TRANSACTIONDATE']."</td>
    <td >$langganan</td>
    <td ></td>
    <td >".$aR[0]."</td>
    <td >".$aR[1]."</td>
    <td >".$aR[2]."</td>
	<td >".$aR[3]."</td>
	<td >".$itemcR."</td>
	<td >".trim($rowdb21R['DECOSUBCODE04'])."</td>
	<td  align=right>".$lbr1."</td>
	<td  align=right>".$gsm11."</td>
	<td  align=right>".$rowdb21R['JML']."</td>
	<td  align=right>".number_format($rowdb21R['KG'],'2','.',',')."</td>
	<td >$knitt1</td>
	<td >".$rowdb21R['PROJECTCODE']."</td>
	<td >".$rowdb21R['NOMESIN']."</td>
	   </tr>";
	$totqt=$totqt+$rowdb21R['KG'];
	$totr=$totr+$rowdb21R['JML'];	
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

    <tr>
        <td colspan="17" style="border: none;">&nbsp;</td>
        </tr>
        <tr>
        <td colspan="17" style="border: none;">&nbsp;</td>
        </tr>
        <tr>
        <td colspan="17" style="border: none;">&nbsp;</td>
    </tr>

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


        


