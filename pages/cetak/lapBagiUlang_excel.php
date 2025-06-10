<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=bagi_ulang".date($_GET['awal']).".xls");//ganti nama sesuai keperluan
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
        <h1 style="margin: 0;">LAPORAN RETUR UNTUK BAGI ULANG</h1>
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
					  
	$sqlDB21RBU = " SELECT s.PROJECTCODE,f.SUMMARIZEDDESCRIPTION,
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
s.LOGICALWAREHOUSECODE ='M021' AND s.TEMPLATECODE = 'OPN' AND a.VALUESTRING =  '2'
GROUP BY s.PROJECTCODE,
s.TRANSACTIONDATE,s.DECOSUBCODE01,s.DECOSUBCODE02,
s.DECOSUBCODE03, s.DECOSUBCODE04,
s.WHSLOCATIONWAREHOUSEZONECODE,
s.WAREHOUSELOCATIONCODE, s.LOTCODE, f.SUMMARIZEDDESCRIPTION, s.CREATIONUSER, a1.VALUESTRING, a2.VALUESTRING";
	$stmt1RBU   = db2_exec($conn1,$sqlDB21RBU, array('cursor'=>DB2_SCROLLABLE));
	//}				  
    while($rowdb21RBU = db2_fetch_assoc($stmt1RBU)){ 
$itemcRBU=trim($rowdb21RBU['DECOSUBCODE02'])."".trim($rowdb21RBU['DECOSUBCODE03']);
		
$sqlDB22R1BU = " SELECT SALESORDER.CODE, SALESORDER.EXTERNALREFERENCE, SALESORDER.ORDPRNCUSTOMERSUPPLIERCODE,
		ITXVIEWAKJ.LEGALNAME1, ITXVIEWAKJ.ORDERPARTNERBRANDCODE, ITXVIEWAKJ.LONGDESCRIPTION
		FROM DB2ADMIN.SALESORDER SALESORDER LEFT OUTER JOIN DB2ADMIN.ITXVIEWAKJ 
       	ITXVIEWAKJ ON SALESORDER.CODE=ITXVIEWAKJ.CODE
		WHERE SALESORDER.CODE='".trim($rowdb21RBU['PROJECTCODE'])."' ";
$stmt2R1BU   = db2_exec($conn1,$sqlDB22R1BU, array('cursor'=>DB2_SCROLLABLE));
$rowdb22R1BU = db2_fetch_assoc($stmt2R1BU);
		
$sqlDB22RBU = " SELECT LISTAGG(DISTINCT  TRIM(BALANCE.WAREHOUSELOCATIONCODE),', ') AS WAREHOUSELOCATIONCODE, COUNT(BALANCE.BASEPRIMARYQUANTITYUNIT) AS ROL,SUM(BALANCE.BASEPRIMARYQUANTITYUNIT) AS BERAT,BALANCE.LOTCODE  
		FROM (
		SELECT 
s.ITEMELEMENTCODE  FROM STOCKTRANSACTION s 
LEFT OUTER JOIN ADSTORAGE a ON a.UNIQUEID = s.ABSUNIQUEID AND a.NAMENAME = 'StatusRetur'
WHERE s.PROJECTCODE='".$rowdb21RBU['PROJECTCODE']."' AND s.ITEMTYPECODE='KGF' AND 
s.DECOSUBCODE02='".$rowdb21RBU['DECOSUBCODE02']."' AND s.DECOSUBCODE03='".$rowdb21RBU['DECOSUBCODE03']."' AND 
s.DECOSUBCODE04='".$rowdb21RBU['DECOSUBCODE04']."' AND s.LOGICALWAREHOUSECODE ='M021' AND
s.LOTCODE='$rowdb21RBU[LOTCODE]' AND 
s.TEMPLATECODE = 'OPN' AND a.VALUESTRING =  '2'
GROUP BY 
s.ITEMELEMENTCODE
		) STOCKTRANSACTION LEFT OUTER JOIN 
		DB2ADMIN.BALANCE BALANCE ON BALANCE.ELEMENTSCODE =STOCKTRANSACTION.ITEMELEMENTCODE  
		GROUP BY BALANCE.LOTCODE ";					  
		$stmt2RBU   = db2_exec($conn1,$sqlDB22RBU, array('cursor'=>DB2_SCROLLABLE));	
		$rowdb22RBU = db2_fetch_assoc($stmt2RBU);
$sqlDB23RBU = " SELECT p.SUBCODE01,p.SUBCODE02,p.SUBCODE03,p.SUBCODE04,p.SUBCODE05,p.SUBCODE06,p.SUBCODE07, p.LONGDESCRIPTION FROM (
SELECT p2.ITEMTYPEAFICODE,p2.SUBCODE01,p2.SUBCODE02,p2.SUBCODE03,p2.SUBCODE04,
p2.SUBCODE05,p2.SUBCODE06,p2.SUBCODE07  FROM PRODUCTIONDEMAND p 
LEFT OUTER JOIN PRODUCTIONRESERVATION p2 ON p.CODE =p2.ORDERCODE 
WHERE p.ITEMTYPEAFICODE ='KGF' AND p.SUBCODE01='".trim($rowdb21RBU['DECOSUBCODE01'])."' 
AND p.SUBCODE02 ='".trim($rowdb21RBU['DECOSUBCODE02'])."' AND p.SUBCODE03 ='".trim($rowdb21RBU['DECOSUBCODE03'])."' AND
p.SUBCODE04='".trim($rowdb21RBU['DECOSUBCODE04'])."' AND (p.PROJECTCODE ='".trim($rowdb21RBU['PROJECTCODE'])."' OR p.ORIGDLVSALORDLINESALORDERCODE  ='".trim($rowdb21RBU['PROJECTCODE'])."')
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
$stmt3RBU   = db2_exec($conn1,$sqlDB23RBU, array('cursor'=>DB2_SCROLLABLE));
$aiRBU=0;
$aRBU[0]="";
$aRBU[1]="";
$aRBU[2]="";
$aRBU[3]="";		
while($rowdb23RBU = db2_fetch_assoc($stmt3RBU)){
	$aRBU[$aiRBU]=$rowdb23RBU['LONGDESCRIPTION'];
	$aiRBU++;
}		
/*$sqlDB26R = " SELECT e.WIDTHGROSS AS LEBAR1,a.VALUEDECIMAL AS GSM1, e.DEMANDCODE  FROM ELEMENTSINSPECTION e 
LEFT OUTER JOIN ADSTORAGE a ON a.UNIQUEID =e.ABSUNIQUEID AND a.NAMENAME ='GSM'
WHERE e.ELEMENTITEMTYPECODE='KGF' AND e.DEMANDCODE='$rowdb21R[LOTCODE]'
GROUP BY e.WIDTHGROSS,a.VALUEDECIMAL,e.DEMANDCODE ";
$stmt6R   = db2_exec($conn1,$sqlDB26R, array('cursor'=>DB2_SCROLLABLE));
$rowdb26R = db2_fetch_assoc($stmt6R);*/

$sqlDB28RBU = " SELECT a.VALUEDECIMAL  FROM PRODUCT p 
LEFT OUTER JOIN ADSTORAGE a  ON a.UNIQUEID = p.ABSUNIQUEID 
WHERE p.SUBCODE01='".trim($rowdb21RBU['DECOSUBCODE01'])."' AND
p.SUBCODE02='".trim($rowdb21RBU['DECOSUBCODE02'])."' AND
p.SUBCODE03='".trim($rowdb21RBU['DECOSUBCODE03'])."' AND
p.SUBCODE04='".trim($rowdb21RBU['DECOSUBCODE04'])."' AND
a.NAMENAME ='Width' AND
p.ITEMTYPECODE ='KFF'  ";
$stmt8RBU   = db2_exec($conn1,$sqlDB28RBU, array('cursor'=>DB2_SCROLLABLE));
$rowdb28RBU = db2_fetch_assoc($stmt8RBU);	
$sqlDB29RBU = " SELECT a.VALUEDECIMAL  FROM PRODUCT p 
LEFT OUTER JOIN ADSTORAGE a  ON a.UNIQUEID = p.ABSUNIQUEID 
WHERE p.SUBCODE01='".trim($rowdb21RBU['DECOSUBCODE01'])."' AND
p.SUBCODE02='".trim($rowdb21RBU['DECOSUBCODE02'])."' AND
p.SUBCODE03='".trim($rowdb21RBU['DECOSUBCODE03'])."' AND
p.SUBCODE04='".trim($rowdb21RBU['DECOSUBCODE04'])."' AND
a.NAMENAME ='GSM' AND
p.ITEMTYPECODE ='KFF'  ";
$stmt9RBU   = db2_exec($conn1,$sqlDB29RBU, array('cursor'=>DB2_SCROLLABLE));
$rowdb29RBU = db2_fetch_assoc($stmt9RBU);		
if($rowdb22R1BU['LEGALNAME1']==""){$langgananBU="";}else{$langgananBU=$rowdb22R1BU['LEGALNAME1'];}
if($rowdb22R1BU['ORDERPARTNERBRANDCODE']==""){$buyerBU="";}else{$buyerBU=$rowdb22R1BU['ORDERPARTNERBRANDCODE'];}	
if($rowdb28RBU['VALUEDECIMAL']!=""){$lbr1=round($rowdb28RBU['VALUEDECIMAL']);}
if($rowdb29RBU['VALUEDECIMAL']!=""){$gsm11=round($rowdb29RBU['VALUEDECIMAL']);}
$knitt1="ITTI";		
  echo"<tr>
  	<td >$no</td>
	<td >".$rowdb21RBU['TRANSACTIONDATE']."</td>
    <td >$langgananBU</td>
    <td >$bon</td>
    <td >".$aRBU[0]."</td>
    <td >".$aRBU[1]."</td>
    <td >".$aRBU[2]."</td>
	<td >".$aRBU[3]."</td>
	<td >".$itemcRBU."</td>
	<td >".trim($rowdb21RBU['DECOSUBCODE04'])."</td>
	<td  align=right>".$lbr1."</td>
	<td  align=right>".$gsm11."</td>
	<td  align=right>".$rowdb21RBU['JML']."</td>
	<td  align=right>".number_format($rowdb21RBU['KG'],'2','.',',')."</td>
	<td >$knitt1</td>
	<td >".$rowdb21RBU['PROJECTCODE']."</td>
	<td >". $rowdb21RBU['NOMESIN']."</td>
	   </tr>";
	$totqt=$totqt+$rowdb21RBU['KG'];
	$totr=$totr+$rowdb21RBU['JML'];	
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
  <td colspan="6" style="text-align: center; vertical-align: middle;">Mengetahui :</td>
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


        


