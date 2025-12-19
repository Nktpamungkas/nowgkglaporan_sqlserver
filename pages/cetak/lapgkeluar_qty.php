<?php
$namaFile = 'Laporan bulanan pembagian kain greige.xls';
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=$namaFile");
header("Pragma: no-cache");
header("Expires: 0");
//disini script laporan anda
include "./../../koneksi.php";
?>

<?php
ini_set("error_reporting", 1);
session_start();
include "koneksi.php";
$ip_num = $_SERVER['REMOTE_ADDR'];
$os     = $_SERVER['HTTP_USER_AGENT'];
$ipaddress = $_SERVER['REMOTE_ADDR'];
?>

<?php
$Awal    = isset($_GET['awal']) ? $_GET['awal'] : '';
$Akhir    = isset($_GET['akhir']) ? $_GET['akhir'] : '';

function replace_nonbreaking_space($data)
{
    return str_replace("\xC2\xA0", " ", $data);
}

function cek_tanggal($ins_tgl)
{
    if (! empty($ins_tgl)) {
        $benchmark_date = new DateTime($ins_tgl);
        return $benchmark_date->format('d-M-y');
    } else {
        return "";
    }
}
?>

<body>
    <?php
    if (!empty($Awal)) {
        $timestamp = strtotime($Awal);
        $bulanTahun = date('F Y', $timestamp);
        $bulanIndonesia = [
            'January' => 'Januari',
            'February' => 'Februari',
            'March' => 'Maret',
            'April' => 'April',
            'May' => 'Mei',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'Agustus',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'November',
            'December' => 'Desember',
        ];
        $bulanTahun = strtr($bulanTahun, $bulanIndonesia);
    }
    ?>

    <div style="display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
        <!-- Logo (optional) -->
        <!--
        <div style="margin-right: 20px;">
            <img src="dist/img/indo.png" alt="Logo" style="height: 80px;">
        </div>
        -->

        <!-- Judul -->
        <div style="text-align: center;">
            <h3 style="margin: 0; text-decoration: underline;"><strong>LAPORAN BULANAN PEMBAGIAN KAIN GREIGE</strong></h3>
            <h5 style="margin: 10px 0; color:red; text-decoration: underline;"><strong>KAIN GREIGE AMBIL PO SELESAI!!!</strong></h5>
            <h5 style="margin: 10px 0;"><strong>No Form : FW-19-GKG-13/04</strong></h5>
            <h5 style="margin: 10px 0;"><strong>Halaman :</strong></h5>
        </div>
    </div>

    <body>

        <div align="LEFT"><?php echo $bulanTahun; ?></div>

        <table width="125%" border="1" align="Center">
            <tr align="center">
                <td rowspan="2">No</td>
                <td rowspan="2">Langganan</td>
                <td rowspan="2">No Order</td>
                <td colspan="4">Jenis Benang</td>
                <td rowspan="2">Jenis Kain</td>
                <td rowspan="2">Roll</td>
                <td rowspan="2">Quantity (KG)</td>
                <td rowspan="2">Warna</td>
                <td rowspan="2">No Card(Prod. Order)</td>
                <td rowspan="2">Lot KK</td>
                <td rowspan="2">No Lot Demand</td>
                <td rowspan="2">Knitt</td>
                <td rowspan="2">Knitt Order</td>
                <td rowspan="2">Ket</td>
                <td rowspan="2">Tgl</td>
            </tr>
            <tr align="center">
                <td>1</td>
                <td>2</td>
                <td>3</td>
                <td>4</td>
            </tr>

            <?php
            $mysqlBS = "SELECT 
            tso.id,
            DATE(tso.tanggal) AS tanggal,
            SUM(tsjd.qty_keluar_detail) AS qty_kg,
            COUNT(tsjd.id) AS qty_roll,
            GROUP_CONCAT(DISTINCT tb.nama SEPARATOR ', ') AS nama_barang
            FROM tbl_sj_out tso
            JOIN tbl_sj_out_detail tsjd ON tso.id = tsjd.sj_out_id 
            JOIN tbl_surat_jalan_detail tsd ON tsjd.detail_id_surat_jalan = tsd.id
            JOIN tbl_barang_bs tb ON tsd.barang_bs_id = tb.id
            WHERE DATE(tso.tanggal) BETWEEN '$Awal' AND '$Akhir'
            GROUP BY tso.id, DATE(tso.tanggal)
            ORDER BY tso.id ASC";
            $stmtbs = mysqli_query($congkg, $mysqlBS);

            if ($stmtbs === false) {
                die('Query Error: ' . mysqli_error($congkg));
            }

            $no = 1;
            $totqty_kg = 0;
            $totroll = 0;
            $totstok = 0;

            while ($rowdb21 = mysqli_fetch_assoc($stmtbs)) {
                $knitt1 = "ITTI";
                echo "
                <tr>
                    <td>$no</td>
                    <td>{$knitt1}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{$rowdb21['qty_roll']}</td>
                    <td>" . number_format($rowdb21['qty_kg'], 2, ',', '.') . "</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>$knitt1</td>
                    <td>" . ($rowdb21['nama_barang'] == 'BS-A' ? 'KAIN POTONGAN' : $rowdb21['nama_barang']) . "</td>
                    <td></td>
                    <td>{$rowdb21['tanggal']}</td>
                </tr>";
                $no++;
                $totroll += $rowdb21['qty_roll'];
                $totqty_kg += $rowdb21['qty_kg'];
            }
            ?>
            <?php
            $totstok += $totqty_kg;
            ?>

            <tr align="right">
                <td colspan="9" style="text-align: left;"><b>Total</b></td>
                <td><b><?php echo number_format($totstok, '2', '.', ','); ?></b></td>
                <td colspan="8">&nbsp;</td>
            </tr>
        </table>

        <table></table>
        <table></table>

        <table width="125%" border="1" align="Center">
            <?php
            $no = 1;
            $sqlDB21 = " SELECT  
                LANGGANAN, PROJECTCODE, UPPER(DESCRIPTION_) AS DESCRIPTION_, LOTCODE,
                BENANG1, BENANG2, BENANG3, BENANG4, WARNA, SUMMARIZEDDESCRIPTION, QTY_DUS,
                QTY_KG, PROJAWAL, ID_ADDRESS, TRANSACTIONDATE, PRODUCTIONDEMANDCODE, ORDERCODE, KODEBENANG
                FROM 
                    dbnow_gkg.tbl_keluar_greige
                WHERE 
                    TRANSACTIONDATE BETWEEN '$Awal' AND '$Akhir' AND (
                    LOTCODE LIKE '%/19' OR
                    LOTCODE LIKE '%/20' OR
                    LOTCODE LIKE '%/21'
                ) and ID_ADDRESS = '$ipaddress'
                GROUP BY 
                    LANGGANAN, PROJECTCODE, UPPER(DESCRIPTION_), LOTCODE,
                    BENANG1, BENANG2, BENANG3, BENANG4, WARNA, SUMMARIZEDDESCRIPTION, QTY_DUS,
                    QTY_KG, PROJAWAL, ID_ADDRESS, TRANSACTIONDATE, PRODUCTIONDEMANDCODE, ORDERCODE, KODEBENANG";
            $stmt1 = sqlsrv_query($con, $sqlDB21);

            if ($stmt1 === false) {
                die(print_r(sqlsrv_errors(), true));
            }

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
                    <td>{$rowdb21['LANGGANAN']}</td>
                    <td></td>
                    <td>{$rowdb21['BENANG1']}</td>
                    <td>{$rowdb21['BENANG2']}</td>
                    <td>{$rowdb21['BENANG3']}</td>
                    <td>{$rowdb21['BENANG4']}</td>
                    <td>{$kodeBenang}</td>
                    <td>{$rowdb21['QTY_DUS']}</td>
                    <td>" . number_format($rowdb21['QTY_KG'], 2, ',', '.') . "</td>
                    <td>{$rowdb21['WARNA']}</td>
                    <td>{$orderCode}</td>
                    <td>{$descriptionFormatted}</td>
                    <td>{$productionDemandCode}</td>
                    <td>{$knitt1}</td>
                    <td>{$lotCode}</td>
                    <td>{$rowdb21['PROJECTCODE']}</td>
                    <td>{$rowdb21['TRANSACTIONDATE']}</td>
                </tr>";

                $no++;
                $totqt += $rowdb21['QTY_KG'];
                $totr += $rowdb21['QTY_DUS'];
            }
            ?>

            <?php
            $sqlDB21 = " SELECT  
            TRANSACTIONDATE,
            BUYER, 
            LANGGANAN,
            PROJECTCODE,
            ORDERCODE,
            LOTCODE,
            ROLL,
            QTY_KG,
            NOTE,
            PROJAWAL,
            CREATIONUSER,
            ID_ADDRESS
            FROM 
                dbnow_gkg.tbl_keluar_greige2
            WHERE 
                TRANSACTIONDATE BETWEEN '$Awal' AND '$Akhir' AND (
                LOTCODE LIKE '%/19' OR
                LOTCODE LIKE '%/20' OR
                LOTCODE LIKE '%/21'
            ) and ID_ADDRESS = '$ipaddress'";
            $stmt1 = sqlsrv_query($con, $sqlDB21);

            if ($stmt1 === false) {
                die(print_r(sqlsrv_errors(), true));
            }

            while ($rowdb21 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC)) {
                $kodeBenang = $rowdb21['KODEBENANG'];
                $parts = explode(' ', $kodeBenang);
                $celup = isset($parts[3]) ? $parts[3] : '';

                $knitt1 = "ITTI";

                $qty_kg_formatted = number_format((float)$rowdb21['QTY_KG'], 2);

                $orderCode = "'" . $rowdb21['ORDERCODE'];
                $descriptionFormatted = "'" . $rowdb21['DESCRIPTION_'];
                // $productionDemandCode = "'" . $rowdb21['PRODUCTIONDEMANDCODE'];
                $lotCode = "'" . $rowdb21['LOTCODE'];
                echo "
                <tr>
                    <td>$no</td>
                    <td>{$rowdb21['LANGGANAN']}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{$rowdb21['ORDERCODE']}</td>
                    <td>{$rowdb21['ROLL']}</td>
                    <td>" . number_format($rowdb21['QTY_KG'], 2, ',', '.') . "</td>
                    <td></td>
                    <td>'</td>
                    <td>'</td>
                    <td>'</td>
                    <td>{$knitt1}</td>
                    <td>{$lotCode}</td>
                    <td>{$rowdb21['NOTE']}</td>
                    <td>{$rowdb21['TRANSACTIONDATE']}</td>
                </tr>
            ";

                $no++;
                $totqt += $rowdb21['QTY_KG'];
                $totr += $rowdb21['ROLL'];
            }
            ?>

            <?php
            $tot = $totqt + $totKG1;
            ?>

            <tr align="right">
                <td colspan="9" style="text-align: left;"><b>Total</b></td>
                <td><b><?php echo number_format($tot, '2', '.', ','); ?></b></td>
                <td colspan="8">&nbsp;</td>
            </tr>
        </table>

        <table></table>

        <table>
            <?php
            $totall = $totstok + $tot;
            ?>

            <tr align="right">
                <td colspan="9" style="text-align: left;"><b>Total</b></td>
                <td><b><?php echo number_format($totall, '2', '.', ','); ?></b></td>
                <td colspan="6">&nbsp;</td>
            </tr>
        </table>

        <table></table>

        <table style="width: auto;" border="1">
            <tr>
                <td colspan="5"></td>
                <td colspan="5" style="text-align: center; vertical-align: middle;">Dibuat Oleh :</td>
                <td colspan="4" style="text-align: center; vertical-align: middle;">Diperiksa Oleh :</td>
                <td colspan="4" style="text-align: center; vertical-align: middle;">Mengetahui :</td>
            </tr>
            <tr>
                <td colspan="5" style="text-align: center; vertical-align: middle;">Nama</td>
                <td colspan="5" style="text-align: center; vertical-align: middle;"></td>
                <td colspan="4" style="text-align: center; vertical-align: middle;"></td>
                <td colspan="4" style="text-align: center; vertical-align: middle;"></td>
            </tr>
            <tr>
                <td colspan="5" style="text-align: center; vertical-align: middle;">Jabatan</td>
                <td colspan="5" style="text-align: center; vertical-align: middle;"></td>
                <td colspan="4" style="text-align: center; vertical-align: middle;"></td>
                <td colspan="4" style="text-align: center; vertical-align: middle;"></td>
            </tr>
            <tr>
                <td colspan="5" style="text-align: center; vertical-align: middle;">Tanggal</td>
                <td colspan="5" style="text-align: center; vertical-align: middle;"></td>
                <td colspan="4" style="text-align: center; vertical-align: middle;"></td>
                <td colspan="4" style="text-align: center; vertical-align: middle;"></td>
            </tr>
            <tr>
                <td colspan="5" style="text-align: center; vertical-align: middle;">Tanda Tangan</td>
                <td colspan="5" style="text-align: center; vertical-align: middle;"><br><br><br><br></td>
                <td colspan="4" style="text-align: center; vertical-align: middle;"></td>
                <td colspan="4" style="text-align: center; vertical-align: middle;"></td>
            </tr>
        </table>