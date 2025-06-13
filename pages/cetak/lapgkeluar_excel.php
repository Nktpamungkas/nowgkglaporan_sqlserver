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
      <h1 >LAPORAN HARIAN PEMBAGIAN KAIN GREIGE</h1>
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
          TRANSACTIONDATE,
          LANGGANAN,
          PROJECTCODE,
          ORDERCODE,
          PRODUCTIONDEMANDCODE,
          KODEBENANG,
          DESCRIPTION_,
          LOTCODE,
          BENANG1,
          BENANG2,
          BENANG3,
          BENANG4,
          WARNA,
          SUMMARIZEDDESCRIPTION,
          QTY_DUS,
          QTY_KG,
          PROJAWAL
        FROM 
          dbnow_gkg.tbl_keluar_greige
        WHERE TRANSACTIONDATE BETWEEN '$Awal' AND '$Akhir'
      ";

      $stmt1 = sqlsrv_query($con, $sqlDB21);

      if ($stmt1 === false) {
          die(print_r(sqlsrv_errors(), true));
      }

      $no = 1;
      $totqt = 0;
      $totr = 0;

      while ($rowdb21 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC)) {

          $kodeBenang = $rowdb21['KODEBENANG'];
          $parts = explode(' ', $kodeBenang);
          $celup = isset($parts[3]) ? $parts[3] : '';

          $knitt1 = "ITTI";

          $qty_kg_formatted = number_format((float)$rowdb21['QTY_KG'], 2);

          $orderCode = "'" . $rowdb21['ORDERCODE'];
          $descriptionFormatted = "'" . $rowdb21['DESCRIPTION_'];
          $productionDemandCode = "'" . $rowdb21['PRODUCTIONDEMANDCODE'];
          $lotCode = "'" . $rowdb21['LOTCODE'];

          echo "
          <tr>
              <td>$no</td>
              <td>{$rowdb21['TRANSACTIONDATE']}</td>
              <td>{$rowdb21['LANGGANAN']}</td>
              <td>{$rowdb21['BENANG1']}</td>
              <td>{$rowdb21['BENANG2']}</td>
              <td>{$rowdb21['BENANG3']}</td>
              <td>{$rowdb21['BENANG4']}</td>
              <td>{$kodeBenang}</td>
              <td>{$celup}</td>
              <td>{$rowdb21['QTY_DUS']}</td>
              <td>{$qty_kg_formatted}</td>
              <td>{$rowdb21['WARNA']}</td>
              <td>{$orderCode}</td>
              <td>{$descriptionFormatted}</td>
              <td>{$productionDemandCode}</td>
              <td>{$knitt1}</td>
              <td>{$lotCode}</td>
              <td>{$rowdb21['PROJAWAL']}</td>
              <td>{$rowdb21['PROJECTCODE']}</td>
          </tr>
          ";

          $no++;
          $totqt += $rowdb21['QTY_KG'];
          $totr += $rowdb21['QTY_DUS'];
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
  <td colspan="7" style="text-align: center; vertical-align: middle;">Mengetahui :</td>
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
