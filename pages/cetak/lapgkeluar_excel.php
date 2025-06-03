<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=greige_keluar" . date($_GET['awal']) . ".xls"); //ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
//disini script laporan anda
?>
<?php
$Awal = isset($_GET['awal']) ? $_GET['awal'] : '';
$Akhir = isset($_GET['akhir']) ? $_GET['akhir'] : '';
?>
<?php
ini_set("error_reporting", 1);
include "../../koneksi.php";
//--
//$act=$_POST['act'];
//$tgl=date("Y-m-d");
?>

<div style="display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
	<!-- Logo -->
	<div style="margin-right: 20px;">
		<!-- <img src="images/logo.png" alt="Logo" style="height: 80px;"> -->
	</div>

  <!-- Judul -->
  	<div style="text-align: center;">
      <h1 style="margin: 0;">LAPORAN HARIAN PEMBAGIAN KAIN GREIGE</h1>
      <h3 style="margin: 5px 0 0 0;">
          NO. FORM : FW - 19 - GKG - 03/05<br />
          HALAMAN :
      </h3>
      <!-- <p>NO. REVISI:<br/>TGL Terbit:</p> -->
	</div>
</div>

<div align="LEFT">TGL : <?php echo date($_GET['awal']); ?></div>
<table width="125%" border="1" align="Center">
  <tr align="center">

    <td rowspan="2" >No</td>
    <td rowspan="2" >Tgl Keluar</td>
    <td rowspan="2" >Langganan</td>
    <td colspan="4" >Jenis Benang</td>
    <td rowspan="2" >Jenis Kain</td>
    <td rowspan="2" >Celup</td>
    <td rowspan="2" >Roll</td>
    <td rowspan="2" >Quantity (KG)</td>
    <td rowspan="2" >Warna</td>
    <td rowspan="2" >No Card (Prod. Order)</td>
    <td rowspan="2" >Lot KK</td>
    <td rowspan="2" >No. Lot (Prod. Demand)</td>
    <td rowspan="2" >Knitt</td>
    <td rowspan="2" >Demand Knitt (LOT Balance)</td>
    <td rowspan="2" >Project Awal</td>
	<td rowspan="2" >Project Akhir</td>
     </tr>
  <tr align="center">
    <td >1</td>
    <td >2</td>
    <td >3</td>
    <td >4</td>
  </tr>
    <?php
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
	prj.PROJECTCODE AS PROJAWAL,
	prj1.PROJECTCODE AS PROJAWAL1,
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
    INTERNALDOCUMENTLINE.PROJECTCODE,
    STOCKTRANSACTION.ITEMELEMENTCODE
FROM
    INTERNALDOCUMENTLINE INTERNALDOCUMENTLINE
LEFT JOIN STOCKTRANSACTION STOCKTRANSACTION ON
    INTERNALDOCUMENTLINE.INTDOCPROVISIONALCOUNTERCODE = STOCKTRANSACTION.ORDERCOUNTERCODE
    AND INTERNALDOCUMENTLINE.INTDOCUMENTPROVISIONALCODE = STOCKTRANSACTION.ORDERCODE
    AND INTERNALDOCUMENTLINE.WAREHOUSECODE = STOCKTRANSACTION.LOGICALWAREHOUSECODE
    AND INTERNALDOCUMENTLINE.ORDERLINE = STOCKTRANSACTION.ORDERLINE
WHERE
    STOCKTRANSACTION.ORDERCOUNTERCODE = 'I02M50' ) prj ON prj.ITEMELEMENTCODE = STOCKTRANSACTION.ITEMELEMENTCODE
LEFT OUTER JOIN (
SELECT
    STOCKTRANSACTION.PROJECTCODE ,
    STOCKTRANSACTION.ITEMELEMENTCODE
FROM
    STOCKTRANSACTION STOCKTRANSACTION
WHERE STOCKTRANSACTION.TEMPLATECODE ='OPN'
GROUP BY
    STOCKTRANSACTION.PROJECTCODE,STOCKTRANSACTION.ITEMELEMENTCODE) prj1 ON prj1.ITEMELEMENTCODE = STOCKTRANSACTION.ITEMELEMENTCODE
WHERE (STOCKTRANSACTION.ITEMTYPECODE ='KGF' OR STOCKTRANSACTION.ITEMTYPECODE ='FKG') and STOCKTRANSACTION.LOGICALWAREHOUSECODE ='M021' AND
STOCKTRANSACTION.ONHANDUPDATE > 1 AND TRANSACTIONDATE BETWEEN '$Awal' AND '$Akhir' AND NOT STOCKTRANSACTION.ORDERCODE IS NULL
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
	prj1.PROJECTCODE,
	ITXVIEWHEADERKNTORDER.ORIGDLVSALORDLINESALORDERCODE,
	ITXVIEWHEADERKNTORDER.PROJECTCODE,
	ITXVIEWHEADERKNTORDER.PRODUCTIONDEMANDCODE,
	ITXVIEWHEADERKNTORDER.LEGALNAME1,
	FULLITEMKEYDECODER.SUMMARIZEDDESCRIPTION
";
$stmt1 = db2_exec($conn1, $sqlDB21, array('cursor' => DB2_SCROLLABLE));
$no = 1;
while ($rowdb21 = db2_fetch_assoc($stmt1)) {
    if ($rowdb21['LOGICALWAREHOUSECODE'] == 'M501') {$knitt = 'LT2';} else if ($rowdb21['LOGICALWAREHOUSECODE'] = 'P501') {$knitt = 'LT1';}
    if ($rowdb21['PROJECTCODE'] != "") {$project = $rowdb21['PROJECTCODE'];} else { $project = substr($rowdb21['ORIGDLVSALORDLINESALORDERCODE'], 0, 10);}
    $kdbenang = trim($rowdb21['DECOSUBCODE01']) . " " . trim($rowdb21['DECOSUBCODE02']) . " " . trim($rowdb21['DECOSUBCODE03']) . " " . trim($rowdb21['DECOSUBCODE04']) . " " . trim($rowdb21['DECOSUBCODE05']) . " " . trim($rowdb21['DECOSUBCODE06']) . " " . trim($rowdb21['DECOSUBCODE07']) . " " . trim($rowdb21['DECOSUBCODE08']);
    $sqlDB22 = " SELECT SALESORDER.CODE, SALESORDER.EXTERNALREFERENCE, SALESORDER.ORDPRNCUSTOMERSUPPLIERCODE,
		ITXVIEWAKJ.LEGALNAME1, ITXVIEWAKJ.ORDERPARTNERBRANDCODE, ITXVIEWAKJ.LONGDESCRIPTION
		FROM DB2ADMIN.SALESORDER SALESORDER LEFT OUTER JOIN DB2ADMIN.ITXVIEWAKJ
       	ITXVIEWAKJ ON SALESORDER.CODE=ITXVIEWAKJ.CODE
		WHERE SALESORDER.CODE='$project' ";
    $stmt2 = db2_exec($conn1, $sqlDB22, array('cursor' => DB2_SCROLLABLE));
    $rowdb22 = db2_fetch_assoc($stmt2);
    if (strlen(trim($rowdb21['LOTCODE'])) == "8") {$Wlot = " AND ( p.PROJECTCODE ='" . trim($rowdb21['PROJAWAL']) . "' OR p.ORIGDLVSALORDLINESALORDERCODE ='" . trim($rowdb21['PROJAWAL']) . "' OR p.CODE='" . trim($rowdb21['LOTCODE']) . "' ) ";} else { $Wlot = " AND ( p.PROJECTCODE ='" . trim($project) . "' OR p.ORIGDLVSALORDLINESALORDERCODE ='" . trim($project) . "' ) ";}

    $sqlDB23 = " SELECT p.SUBCODE01,p.SUBCODE02,p.SUBCODE03,p.SUBCODE04,p.SUBCODE05,p.SUBCODE06,p.SUBCODE07, p.LONGDESCRIPTION FROM (
SELECT p2.ITEMTYPEAFICODE,p2.SUBCODE01,p2.SUBCODE02,p2.SUBCODE03,p2.SUBCODE04,
p2.SUBCODE05,p2.SUBCODE06,p2.SUBCODE07  FROM PRODUCTIONDEMAND p
LEFT OUTER JOIN PRODUCTIONRESERVATION p2 ON p.CODE =p2.ORDERCODE
WHERE p.ITEMTYPEAFICODE ='KGF' AND p.SUBCODE01='" . trim($rowdb21['DECOSUBCODE01']) . "'
AND p.SUBCODE02 ='" . trim($rowdb21['DECOSUBCODE02']) . "' AND p.SUBCODE03 ='" . trim($rowdb21['DECOSUBCODE03']) . "' AND
p.SUBCODE04='" . trim($rowdb21['DECOSUBCODE04']) . "' $Wlot
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
    $stmt3 = db2_exec($conn1, $sqlDB23, array('cursor' => DB2_SCROLLABLE));
    $ai = 0;
    $a[0] = "";
    $a[1] = "";
    $a[2] = "";
    $a[3] = "";
    while ($rowdb23 = db2_fetch_assoc($stmt3)) {
        $a[$ai] = $rowdb23['LONGDESCRIPTION'];
        $ai++;
    }
    $sqlDB24 = " SELECT ugp.LONGDESCRIPTION AS WARNA,pr.LONGDESCRIPTION,p.PRODUCTIONORDERCODE,pd.SUBCODE01,pd.SUBCODE02,pd.SUBCODE03,
	pd.SUBCODE04,pd.SUBCODE05,pd.SUBCODE06,pd.SUBCODE07,pd.SUBCODE08,pd.INTERNALREFERENCE,
	LISTAGG(DISTINCT  TRIM(pd.CODE),', ') AS PRODUCTIONDEMANDCODE,pd.DESCRIPTION
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
WHERE (pd.PROJECTCODE ='$project' OR pd.ORIGDLVSALORDLINESALORDERCODE ='$project') AND p.PRODUCTIONORDERCODE='$rowdb21[ORDERCODE]'
	GROUP BY pr.LONGDESCRIPTION,p.PRODUCTIONORDERCODE,pd.SUBCODE01,pd.SUBCODE02,pd.SUBCODE03,
	pd.SUBCODE04,pd.SUBCODE05,pd.SUBCODE06,pd.SUBCODE07,pd.SUBCODE08,pd.INTERNALREFERENCE,ugp.LONGDESCRIPTION,pd.DESCRIPTION ";
    $stmt4 = db2_exec($conn1, $sqlDB24, array('cursor' => DB2_SCROLLABLE));
    $rowdb24 = db2_fetch_assoc($stmt4);

    $sqlDB25 = "
SELECT CASE WHEN PROJECTCODE <> '' THEN PROJECTCODE ELSE ORIGDLVSALORDLINESALORDERCODE  END  AS PROJECT FROM PRODUCTIONDEMAND WHERE CODE='" . $rowdb21['LOTCODE'] . "'
";
    $stmt5 = db2_exec($conn1, $sqlDB25, array('cursor' => DB2_SCROLLABLE));
    $rowdb25 = db2_fetch_assoc($stmt5);
    if ($rowdb21['PROJAWAL'] != "") {$proj = $rowdb21['PROJAWAL'];} else if ($rowdb25['PROJECT'] != "") {$proj = $rowdb25['PROJECT'];} else { $proj = $rowdb24['INTERNALREFERENCE'];}
    if ($rowdb21['PROJECTCODE'] != "") {$projc = $rowdb21['PROJECTCODE'];} else { $projc = $rowdb21['ORIGDLVSALORDLINESALORDERCODE'];}

    if ($rowdb22['LEGALNAME1'] == "") {$langganan = "";} else { $langganan = $rowdb22['LEGALNAME1'];}
    if ($rowdb22['ORDERPARTNERBRANDCODE'] == "") {$buyer = "";} else { $buyer = $rowdb22['ORDERPARTNERBRANDCODE'];}
    $knitt1 = "ITTI";
    if ($rowdb24['PRODUCTIONDEMANDCODE'] != "") {$dmndno = $rowdb24['PRODUCTIONDEMANDCODE'];} else { $dmndno = $rowdb21['PRODUCTIONDEMANDCODE'];}
    echo "

	 <tr >
	 <td >$no</td>
	 <td >" . $rowdb21['TRANSACTIONDATE'] . "</td>
	 <td >$langganan</td>
	 <td >" . $a[0] . "</td>
	 <td >" . $a[1] . "</td>
	 <td >" . $a[2] . "</td>
	 <td >" . $a[3] . "</td>
	 <td >" . $kdbenang . "</td>
	 <td >" . $rowdb21['DECOSUBCODE04'] . "</td>
	 <td align=right>" . $rowdb21['QTY_DUS'] . "</td>
	 <td align=right>" . number_format($rowdb21['QTY_KG'], '2', '.', ',') . "</td>
	 <td >" . $rowdb24['WARNA'] . "</td>
	 <td >'" . $rowdb21['ORDERCODE'] . "</td>
	 <td >'" . $rowdb24['DESCRIPTION'] . "</td>
	 <td >'" . $dmndno . "</td>
	 <td >$knitt1</td>
	 <td >'" . $rowdb21['LOTCODE'] . "</td>
	 <td >" . $proj . "</td>
	 <td >" . $projc . "</td>
	 </tr>
	 ";
    $no++;
    $totqt = $totqt + $rowdb21['QTY_KG'];
    $totr = $totr + $rowdb21['QTY_DUS'];
}
?>
  <tr align="right">
  	<td colspan="9"  ><b>Total</b></td>
  	<td ><b><?php echo number_format($totr, '2', '.', ','); ?></b></td>
  	<td ><b><?php echo number_format($totqt, '2', '.', ','); ?></b></td>
  	<td >&nbsp;</td>
	<td colspan="7" >&nbsp;</td>
	</tr>

</table>

<table></table>
<table></table>

<table style="width: auto;" border="1">
     <tr>
  <td colspan="4"></td>
  <td colspan="3" style="text-align: center; vertical-align: middle;">Dibuat Oleh :</td>
  <td colspan="5" style="text-align: center; vertical-align: middle;">Diperiksa Oleh :</td>
  <td colspan="7" style="text-align: center; vertical-align: middle;">Mengertahui :</td>
</tr>
<tr>
  <td colspan="4" style="text-align: center; vertical-align: middle;">Nama</td>
  <td colspan="3" style="text-align: center; vertical-align: middle;"></td>
  <td colspan="5" style="text-align: center; vertical-align: middle;"></td>
  <td colspan="7" style="text-align: center; vertical-align: middle;"></td>
</tr>
<tr>
  <td colspan="4" style="text-align: center; vertical-align: middle;">Jabatan</td>
  <td colspan="3" style="text-align: center; vertical-align: middle;"></td>
  <td colspan="5" style="text-align: center; vertical-align: middle;"></td>
  <td colspan="7" style="text-align: center; vertical-align: middle;"></td>
</tr>
<tr>
  <td colspan="4" style="text-align: center; vertical-align: middle;">Tanggal</td>
  <td colspan="3" style="text-align: center; vertical-align: middle;"></td>
  <td colspan="5" style="text-align: center; vertical-align: middle;"></td>
  <td colspan="7" style="text-align: center; vertical-align: middle;"></td>
</tr>
<tr>
  <td colspan="4" style="text-align: center; vertical-align: middle;">Tanda Tangan</td>
  <td colspan="3" style="text-align: center; vertical-align: middle;"><br><br><br><br></td>
  <td colspan="5" style="text-align: center; vertical-align: middle;"></td>
  <td colspan="7" style="text-align: center; vertical-align: middle;"></td>
</tr>
</table>

</table>





