<?php
include "./../../koneksi.php";

// Ambil parameter tanggal dari URL
$awalParam  = $_GET['awal']  ?? '';
$Bln2  = (new DateTime($awalParam))->format('m');
$Thn2  = (new DateTime($awalParam))->format('Y');

$Bulan			= $Thn2."-".$Bln2;
$namaFile = "Laporan Total Masuk Keluar Kain gudang-{$Bulan}.xls";

header("Content-type: application/vnd.ms-excel; charset=UTF-8");
header("Content-Disposition: attachment; filename=\"$namaFile\"");
header("Pragma: no-cache");
header("Expires: 0");

// $bulanTahun = strtoupper(date("F Y", strtotime($awalParam)));
$d = cal_days_in_month(CAL_GREGORIAN, $Bln2, $Thn2);
if($Thn2!="" and $Bln2!=""){
$Lalu 		= $Bln2-1;	
	if($Lalu=="0"){
	$BlnLalu="12";
	$Thn=$Thn2-1;	
	}else{
	$BlnLalu=$Lalu;
	}	
}
function namabln($b){
if($b=="01" or $b=="1"){ $Nbln="Januari";}
if($b=="02" or $b=="2"){ $Nbln="Febuari";}
if($b=="03" or $b=="3"){ $Nbln="Maret";}
if($b=="04" or $b=="4"){ $Nbln="April";}
if($b=="05" or $b=="5"){ $Nbln="Mei";}
if($b=="06" or $b=="6"){ $Nbln="Juni";}
if($b=="07" or $b=="7"){ $Nbln="Juli";}
if($b=="08" or $b=="8"){ $Nbln="Agustus";}
if($b=="09" or $b=="9"){ $Nbln="September";}
if($b=="10"){ $Nbln="Oktober";}
if($b=="11"){ $Nbln="November";}
if($b=="12"){ $Nbln="Desember";}	
	return $Nbln;
}

$total = 0;



?>
<html>
<head>
<meta charset="UTF-8">
</head>
<body>
<body>

    <div style="display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
        <!-- Logo (optional) -->
        <!--
        <div style="margin-right: 20px;">
            <img src="dist/img/indo.png" alt="Logo" style="height: 80px;">
        </div>
        -->

        <!-- Judul -->
        <div style="text-align: center;">
            <h3 style="margin: 0;"><strong> LAPORAN TOTAL MASUK / KELUAR STOCK KAIN GREIGE</strong></h3>
            <!-- <h5 style="margin: 10px 0;"><strong>BULAN <?php if($Bln2!="01"){echo namabln($Bln2)." ".$Thn2;}else{echo namabln($Bln2)." ".$Thn;} ?></strong></h5> -->
            <h5 style="margin: 10px 0;"><strong>No Form : FW-19-GKG-12/04</strong></h5>
            <h5 style="margin: 10px 0;"><strong>Halaman :</strong></h5>
        </div>
    </div>
<body>
        
<table></table>
<?php
if ($Bln2 != "01") {
    if (strlen($BlnLalu) == 1) {
        $bl0 = "0" . $BlnLalu;
    } else {
        $bl0 = $BlnLalu;
    }
    $BlnLL = $Thn2 . "-" . $bl0;
} else {
    if (strlen($BlnLalu) == 1) {
        $bl0 = "0" . $BlnLalu;
    } else {
        $bl0 = $BlnLalu;
    }
    $BlnLL = $Thn . "-" . $bl0;
}
$sql = sqlsrv_query($con, " SELECT TOP 1 
												tgl_tutup, 
												SUM(rol) AS rol, 
												SUM(weight) AS kg 
											FROM 
												dbnow_gkg.tblopname 
											WHERE 
												FORMAT(tgl_tutup, 'yyyy-MM') = '$BlnLL' 
											GROUP BY 
												tgl_tutup 
											ORDER BY 
												tgl_tutup DESC;
 ");
$r = sqlsrv_fetch_array($sql);

$sqlM = sqlsrv_query($con, " SELECT 
												FORMAT(tgl_tutup, 'yyyy-MM') AS tgl_tutup, 
												SUM(qty) AS rol, 
												SUM(berat) AS kg 
											FROM 
												dbnow_gkg.tblmasukkain 
											WHERE 
												FORMAT(tgl_tutup, 'yyyy-MM') = '$Bulan' 
											GROUP BY 
												FORMAT(tgl_tutup, 'yyyy-MM');
 ");
$rM = sqlsrv_fetch_array($sqlM);

$sqlK = sqlsrv_query($con, " SELECT 
												FORMAT(tgl_tutup, 'yyyy-MM') AS tgl_tutup, 
												SUM(qty) AS rol, 
												SUM(berat) AS kg 
											FROM 
												dbnow_gkg.tblkeluarkain 
											WHERE format(tgl_tutup, 'yyyy-MM') = '$Bulan' 
											-- and demand IS NOT NULL
											GROUP BY 
												FORMAT(tgl_tutup, 'yyyy-MM');
");
$rK = sqlsrv_fetch_array($sqlK);

$sqlT = sqlsrv_query($con, " SELECT TOP 1 
												tgl_tutup, 
												SUM(rol) AS rol, 
												SUM(weight) AS kg 
											FROM 
												dbnow_gkg.tblopname 
											WHERE 
												FORMAT(tgl_tutup, 'yyyy-MM') = '$Bulan' 
											GROUP BY 
												tgl_tutup 
											ORDER BY 
												tgl_tutup DESC;
 ");
$rT = sqlsrv_fetch_array($sqlT);

$sqlRMasuk = sqlsrv_query($con, " SELECT format(tgl_tutup, 'yyyy-MM')  as tgl_tutup, 
													SUM(qty) AS rol, 
													SUM(berat) AS kg 
												FROM dbnow_gkg.tblmasukkain 
												WHERE FORMAT(tgl_tutup, 'yyyy-MM') = '$Bulan'
												AND no_bon IS NULL 
												-- AND mesin_rajut = 'maklun' 
												AND (
													projectcode LIKE '%CWD%' 
													OR projectcode IS NULL
												)
												AND (
													mesin_rajut IS NULL 
													OR mesin_rajut = 'retur'
													)
												GROUP BY format(tgl_tutup, 'yyyy-MM'); ");
$rRMasuk = sqlsrv_fetch_array($sqlRMasuk);

$sqlRkeluar = sqlsrv_query($con, " SELECT 
											FORMAT(tgl_tutup, 'yyyy-MM') as tgl_tutup,
											SUM(qty) AS rol,
											SUM(berat) AS kg 
										FROM 
											dbnow_gkg.tblkeluarkain 
										WHERE 
											FORMAT(tgl_tutup, 'yyyy-MM') = '$Bulan' 
											AND demand IS NOT NULL 
											AND projectcode LIKE '%CWD%'
										GROUP BY 
											FORMAT(tgl_tutup, 'yyyy-MM'); ");
$rRkeluar = sqlsrv_fetch_array($sqlRkeluar);

$stokmati = sqlsrv_query($con, "WITH MaxTutup AS (
				SELECT 
					(SELECT MAX(tgl_tutup) 
					FROM Stock_mati_gkg 
					WHERE proj_awal LIKE '%/%' 
					AND FORMAT(tgl_tutup, 'yyyy-MM') = '$Bulan') AS tgl_bulan_ini,
					
					(SELECT MAX(tgl_tutup) 
					FROM Stock_mati_gkg 
					WHERE proj_awal LIKE '%/%' 
					AND FORMAT(tgl_tutup, 'yyyy-MM') = '$BlnLL') AS tgl_bulan_lalu
			)
			SELECT 
				(SELECT SUM(kgs) 
				FROM Stock_mati_gkg 
				WHERE proj_awal LIKE '%/%' 
				AND tgl_tutup = tgl_bulan_ini) AS total_bulan_ini,

				(SELECT SUM(kgs) 
				FROM Stock_mati_gkg 
				WHERE proj_awal LIKE '%/%' 
				AND tgl_tutup = tgl_bulan_lalu) AS total_bulan_lalu
			FROM MaxTutup
		");
$stokmatiT = sqlsrv_fetch_array($stokmati);

$sqlKainMati2 = sqlsrv_query($con, " SELECT 
		FORMAT(tgl_tutup, 'yyyy-MM') AS tgl_tutup, 
		SUM(qty) AS rol, 
		SUM(berat) AS kg 
	FROM 
		dbnow_gkg.tblkeluarkain 
	WHERE format(tgl_tutup, 'yyyy-MM') = '$Bulan' 
	 and demand IS NULL and lot like '%/%'
	GROUP BY 
		FORMAT(tgl_tutup, 'yyyy-MM') ");
$rKainMati2 = sqlsrv_fetch_array($sqlKainMati2);

$mysqlBSMasuk = "SELECT 
--             tsj.id,
				DATE_FORMAT(tsj.tanggal, '%Y-%m') AS tanggal_bulan,
				SUM(tsjd.qty_masuk) AS qty_kg_masuk,
				COUNT(tsjd.id) AS qty_roll
			, GROUP_CONCAT(DISTINCT tb.nama SEPARATOR ', ') AS nama_barang
			FROM 
				tbl_surat_jalan tsj 
			LEFT JOIN 
				tbl_surat_jalan_detail tsjd ON tsjd.surat_jalan_id = tsj.id 
			JOIN 
				tbl_barang_bs tb ON tsjd.barang_bs_id = tb.id
			WHERE 
				DATE_FORMAT(tsj.tanggal, '%Y-%m') = '$Bulan'
			GROUP BY 
				DATE_FORMAT(tsj.tanggal, '%Y-%m')"
;
$stmtbsmasuk = mysqli_query($congkg, $mysqlBSMasuk);
$rowdb21_masuk = mysqli_fetch_assoc($stmtbsmasuk);

$mysqlBS = " SELECT 
				DATE_FORMAT(tso.tanggal, '%Y-%m') AS tanggal,
				SUM(tsjd.qty_keluar_detail) AS qty_kg_keluar,
				COUNT(tsjd.id) AS qty_roll,
				GROUP_CONCAT(DISTINCT tb.nama ORDER BY tb.nama SEPARATOR ', ') AS nama_barang
			FROM 
				tbl_sj_out tso
			JOIN 
				tbl_sj_out_detail tsjd ON tso.id = tsjd.sj_out_id 
			JOIN 
				tbl_surat_jalan_detail tsd ON tsjd.detail_id_surat_jalan = tsd.id
			JOIN 
				tbl_barang_bs tb ON tsd.barang_bs_id = tb.id
			WHERE 
				DATE_FORMAT(tso.tanggal, '%Y-%m') = '$Bulan'
			GROUP BY  
				DATE_FORMAT(tso.tanggal, '%Y-%m')
			ORDER BY  
				DATE_FORMAT(tso.tanggal, '%Y-%m')
			";
$stmtbs = mysqli_query($congkg, $mysqlBS);
$rowdb21 = mysqli_fetch_assoc($stmtbs);

$keluarMati1 = " SELECT 
				STOCKTRANSACTION.LOTCODE,
				COUNT(STOCKTRANSACTION.BASEPRIMARYQUANTITY) AS QTY_DUS,
				SUM(STOCKTRANSACTION.BASEPRIMARYQUANTITY) AS kg,
				ITXVIEWHEADERKNTORDER.ORIGDLVSALORDLINESALORDERCODE,
				STOCKTRANSACTION.TRANSACTIONDATE
			FROM DB2ADMIN.STOCKTRANSACTION STOCKTRANSACTION
			LEFT OUTER JOIN (
				SELECT
					ITXVIEWHEADERKNTORDER.PRODUCTIONORDERCODE,
					LISTAGG(DISTINCT TRIM(ITXVIEWHEADERKNTORDER.ORIGDLVSALORDLINESALORDERCODE), ', ') AS ORIGDLVSALORDLINESALORDERCODE,
					LISTAGG(DISTINCT TRIM(ITXVIEWHEADERKNTORDER.PRODUCTIONDEMANDCODE), ', ') AS PRODUCTIONDEMANDCODE,
					LISTAGG(DISTINCT TRIM(ITXVIEWHEADERKNTORDER.PROJECTCODE), ', ') AS PROJECTCODE
				FROM DB2ADMIN.ITXVIEWHEADERKNTORDER
				GROUP BY ITXVIEWHEADERKNTORDER.PRODUCTIONORDERCODE
			) ITXVIEWHEADERKNTORDER
				ON ITXVIEWHEADERKNTORDER.PRODUCTIONORDERCODE = STOCKTRANSACTION.ORDERCODE
			LEFT OUTER JOIN DB2ADMIN.FULLITEMKEYDECODER FULLITEMKEYDECODER
				ON STOCKTRANSACTION.FULLITEMIDENTIFIER = FULLITEMKEYDECODER.IDENTIFIER
			WHERE 
				(STOCKTRANSACTION.ITEMTYPECODE = 'KGF' OR STOCKTRANSACTION.ITEMTYPECODE = 'FKG')
				AND STOCKTRANSACTION.LOGICALWAREHOUSECODE = 'M021'
				AND STOCKTRANSACTION.ONHANDUPDATE > 1
				AND VARCHAR_FORMAT(STOCKTRANSACTION.TRANSACTIONDATE, 'YYYY-MM') = '$Bulan'
				AND STOCKTRANSACTION.ORDERCODE IS NOT NULL
				AND STOCKTRANSACTION.LOTCODE LIKE '%/%'
			GROUP BY
				STOCKTRANSACTION.LOTCODE,
				STOCKTRANSACTION.TRANSACTIONDATE,
				ITXVIEWHEADERKNTORDER.ORIGDLVSALORDLINESALORDERCODE";

$stmtkeluarMati1 = db2_exec($conn1, $keluarMati1, ['cursor' => DB2_SCROLLABLE]);
$totdatakeluarMati1 = 0;

// echo "<pre>";
while ($rowmati = db2_fetch_assoc($stmtkeluarMati1)) {
    // print_r($rowmati);

    // Pastikan field 'KG' ada dan valid
    if (isset($rowmati['KG'])) {
        // Tambahkan ke total (konversi ke float dulu untuk memastikan penjumlahan numerik)
        $totdatakeluarMati1 += (float) $rowmati['KG'];
    }
}
// echo "</pre>";

// Tampilkan total summary KG
// echo "<b>Total KG: </b>" . number_format($totdatakeluarMati1, 3);

$masuk = " SELECT 
(
    -- QTY KG
    (
        SELECT COALESCE(SUM(STOCKTRANSACTION.WEIGHTNET), 0)
        FROM INTERNALDOCUMENT
        LEFT JOIN INTERNALDOCUMENTLINE ON
            INTERNALDOCUMENT.PROVISIONALCOUNTERCODE = INTERNALDOCUMENTLINE.INTDOCPROVISIONALCOUNTERCODE
            AND INTERNALDOCUMENT.PROVISIONALCODE = INTERNALDOCUMENTLINE.INTDOCUMENTPROVISIONALCODE
            AND INTERNALDOCUMENTLINE.DESTINATIONWAREHOUSECODE = 'M021'
        LEFT JOIN STOCKTRANSACTION ON
            INTERNALDOCUMENTLINE.INTDOCUMENTPROVISIONALCODE = STOCKTRANSACTION.ORDERCODE
            AND INTERNALDOCUMENTLINE.ORDERLINE = STOCKTRANSACTION.ORDERLINE
        WHERE
            STOCKTRANSACTION.TEMPLATECODE = '204'
            AND STOCKTRANSACTION.LOGICALWAREHOUSECODE = 'M021'
            AND VARCHAR_FORMAT(STOCKTRANSACTION.TRANSACTIONDATE, 'YYYY-MM') = '$Bulan'
            AND INTERNALDOCUMENTLINE.ORDERLINE IS NOT NULL
    )
    +
    -- QTY NONFK
    (
        SELECT COALESCE(SUM(s.BASEPRIMARYQUANTITY), 0)
        FROM STOCKTRANSACTION s
        LEFT JOIN ADSTORAGE a ON a.UNIQUEID = s.ABSUNIQUEID AND a.NAMENAME = 'StatusRetur'
        WHERE
            VARCHAR_FORMAT(s.TRANSACTIONDATE, 'YYYY-MM') = '$Bulan'
            AND s.ITEMTYPECODE = 'KGF'
            AND s.LOGICALWAREHOUSECODE = 'M021'
            AND s.TEMPLATECODE = 'OPN'
            AND a.VALUESTRING = '1'
    )
    +
    -- QTY FK
    (
        SELECT COALESCE(SUM(st.BASEPRIMARYQUANTITY), 0)
        FROM INTERNALDOCUMENT
        LEFT JOIN INTERNALDOCUMENTLINE ON
            INTERNALDOCUMENT.PROVISIONALCOUNTERCODE = INTERNALDOCUMENTLINE.INTDOCPROVISIONALCOUNTERCODE
            AND INTERNALDOCUMENT.PROVISIONALCODE = INTERNALDOCUMENTLINE.INTDOCUMENTPROVISIONALCODE
        LEFT JOIN STOCKTRANSACTION st ON
            INTERNALDOCUMENTLINE.INTDOCUMENTPROVISIONALCODE = st.ORDERCODE
            AND INTERNALDOCUMENTLINE.ORDERLINE = st.ORDERLINE
        WHERE
            st.TEMPLATECODE = '204'
            AND st.LOGICALWAREHOUSECODE = 'M021'
            AND VARCHAR_FORMAT(st.TRANSACTIONDATE, 'YYYY-MM') = '$Bulan'
            AND INTERNALDOCUMENTLINE.ORDERLINE IS NOT NULL
            AND INTERNALDOCUMENTLINE.SUBCODE02 IN ('FKP', 'FKY', 'FJQ')
    )
    +
    -- QTY CWD
    (
        SELECT COALESCE(SUM(s.BASEPRIMARYQUANTITY), 0)
        FROM STOCKTRANSACTION s
        LEFT JOIN ADSTORAGE a ON a.UNIQUEID = s.ABSUNIQUEID AND a.NAMENAME = 'StatusRetur'
        WHERE 
            VARCHAR_FORMAT(s.TRANSACTIONDATE, 'YYYY-MM') = '$Bulan'
            AND s.ITEMTYPECODE = 'KGF'
            AND s.LOGICALWAREHOUSECODE = 'M021'
            AND s.TEMPLATECODE = 'OPN'
            AND a.VALUESTRING = '2'
            AND s.PROJECTCODE LIKE '%CWD%'
    )
) AS TOTAL_QTY_MASUK
FROM SYSIBM.SYSDUMMY1;

    ";

$stmtmasuk = db2_exec($conn1, $masuk, ['cursor' => DB2_SCROLLABLE]);
$datamasuk = db2_fetch_assoc($stmtmasuk);

?>	

<!-- <div align="LEFT">TGL : <?php echo date($_GET['tanggal1']); ?></div> -->
<table width="125%" border="1" align="Center">
<tr>
    <th width="3%" rowspan="2" align="center" valign="middle">#</th>
    <th width="25%" rowspan="2" colspan="2"><strong>Bulan <?php echo namabln($Bln2) . " " . $Thn2; ?></strong></th>
    <th colspan="2" valign="middle" colspan="4" style="text-align: center">Kain I</th>
    <th width="36%" rowspan="2" valign="middle" style="text-align: center">Kain II</th>
    <th width="32%" rowspan="2" colspan="2" valign="middle" style="text-align: center">Total</th>
    </tr>
    <tr>
        <th width="22%" colspan="2" valign="middle" style="text-align: center">Stok Proses</th>
        <th width="25%" colspan="2" valign="middle" style="text-align: center">Stok Mati</th>
    </tr>
</table>
<table width="125%" border="1" align="center">
    <?php
    $stock_bln_sebelumnya = round($r['kg'], 2) - round($stokmatiT['total_bulan_lalu'], 2);

    $stokTerima = round($datamasuk['TOTAL_QTY_MASUK'], 2) - round($rRMasuk['kg'], 2);
    $Rkg = round($rRMasuk['kg'], 2);
    $RBs = round($rowdb21_masuk['qty_kg_masuk'], 2);
    $total_masuk = $stokTerima + $Rkg + $RBs;

    $stokkeluar = round($rK['kg'], 2) ;

    $Rkg_keluar = round($rRkeluar['kg'], 2);
    $Rkg_mati_keluar = round($rowdb21['qty_kg_keluar'], 2);
    $keluarMati2 = round($rKainMati2['kg'], 2);
    $stokkeluar_akhir = $stokkeluar - $Rkg_keluar- $totdatakeluarMati1- $keluarMati2;
    
    $total_keluar = $stokkeluar_akhir + $Rkg_keluar + $Rkg_mati_keluar;

    $total_stock = $stock_bln_sebelumnya + $stokTerima - $stokkeluar_akhir;
    $stock_mati_bln_sekarang = round($stokmatiT['total_bulan_ini'], 2);
    $total_stock_saat_ini = $total_stock + $stock_mati_bln_sekarang;


    $totalKeluar_mati = $totdatakeluarMati1 + $keluarMati2 + $Rkg_mati_keluar;
    ?>

    <tr>
        <td>1</td>
        <td colspan="2"><strong>Stok Bulan
                <?php echo ($Bln2 != "01") ? namabln($BlnLalu) . " " . $Thn2 : namabln($BlnLalu) . " " . $Thn; ?>
            </strong></td>
        <td align='center' colspan="2"><?php echo number_format($stock_bln_sebelumnya, 2); ?></td>
        <td align='center' colspan="2"><?php echo number_format(round($stokmatiT['total_bulan_lalu'], 2), 2); ?></td>
        <td align='center'>&nbsp;</td>
        <td align='right' colspan="2"><strong><?php echo number_format(round($r['kg'], 2), 2); ?></strong></td>
    </tr>

    <tr>
        <td>2</td>
        <td colspan="2"><strong>Masuk Kain</strong></td>
        <td align="center" colspan="2"><?php echo number_format($stokTerima, 2); ?></td>
        <td align='center' colspan="2">
            <?php echo isset($rowdb21_masuk['qty_kg_masuk']) ? number_format($RBs, 2) : '0.00'; ?>
        </td>
        <td align="center"><?php echo number_format($Rkg, 2); ?></td>
        <td align="right" colspan="2"><strong><?php echo number_format($total_masuk, 2); ?></strong></td>
    </tr>

    <tr>
        <td>3</td>
        <td colspan="2"><strong>Keluar Kain</strong></td>
        <td align="center" colspan="2" ><?php echo number_format($stokkeluar_akhir, 2); ?></td>
        <td align='center' colspan="2">
            <?php
            echo number_format($totalKeluar_mati, 2);
            ?>     
        </td>
        <td align="center"><?php echo number_format($Rkg_keluar, 2); ?></td>
        <td align="right" colspan="2"><strong><?php echo number_format($total_keluar, 2); ?></strong></td>
    </tr>

    <tr>
        <td>4</td>
        <td colspan="2"><strong>Stok</strong></td>
        <td align="center" colspan="2"><?php echo number_format($total_stock, 2); ?></td>
        <td align='center' colspan="2"><?php echo number_format($stock_mati_bln_sekarang, 2); ?></td>
        <td align="center">&nbsp;</td>
        <td align="right" colspan="2"><strong><?php echo number_format($total_stock_saat_ini, 2); ?></strong></td>
    </tr>

    <tr>
        <td rowspan="2" style="vertical-align: middle; text-align: center;">5</td>
        <td align='center' colspan="2"><strong>Stok Opname</strong></td>
        <td align='center' colspan="2">&nbsp;</td>
        <td align='center' colspan="2">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="right" colspan="2">&nbsp;</td>
    </tr>
    <tr>
        <td align="center" colspan="2"><strong>Bulan <?php echo namabln($Bln2) . " " . $Thn2; ?></strong></td>
        <td align='center' colspan="2"><strong><?php echo number_format($total_stock, 2); ?></strong></td>
        <td align='center' colspan="2"><strong><?php echo number_format($stock_mati_bln_sekarang, 2); ?></strong></td>
        <td align="center">&nbsp;</td>
        <td align="right" colspan="2"><strong><?php echo number_format($total_stock_saat_ini, 2); ?></strong></td>
    </tr>
</table>


    
<table></table>
<table></table>

<table style="width: auto;" border="1">
     <tr>
  <td colspan="3"></td>
  <td colspan="2" style="text-align: center; vertical-align: middle;">Dibuat Oleh :</td>
  <td colspan="3" style="text-align: center; vertical-align: middle;">Diperiksa Oleh :</td>
  <td colspan="2" style="text-align: center; vertical-align: middle;">Mengetahui :</td>
</tr>
<tr>
  <td colspan="3" style="text-align: center; vertical-align: middle;">Nama</td>
  <td colspan="2" style="text-align: center; vertical-align: middle;"></td>
  <td colspan="3" style="text-align: center; vertical-align: middle;"></td>
  <td colspan="2" style="text-align: center; vertical-align: middle;"></td>
</tr>
<tr>
  <td colspan="3" style="text-align: center; vertical-align: middle;">Jabatan</td>
  <td colspan="2" style="text-align: center; vertical-align: middle;"></td>
  <td colspan="3" style="text-align: center; vertical-align: middle;"></td>
  <td colspan="2" style="text-align: center; vertical-align: middle;"></td>
</tr>
<tr>
  <td colspan="3" style="text-align: center; vertical-align: middle;">Tanggal</td>
  <td colspan="2" style="text-align: center; vertical-align: middle;"></td>
  <td colspan="3" style="text-align: center; vertical-align: middle;"></td>
  <td colspan="2" style="text-align: center; vertical-align: middle;"></td>
</tr>
<tr>
  <td colspan="3" style="text-align: center; vertical-align: middle;">Tanda Tangan</td>
  <td colspan="2" style="text-align: center; vertical-align: middle;"><br><br><br><br></td>
  <td colspan="3" style="text-align: center; vertical-align: middle;"></td>
  <td colspan="2" style="text-align: center; vertical-align: middle;"></td>
</tr>
</table>

</table>

</body>
</html>
