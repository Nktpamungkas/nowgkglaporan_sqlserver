<?php
    $namaFile = 'greige_masuk_qty.xls';
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
?>

<?php

$Awal	= isset($_GET['awal']) ? $_GET['awal'] : '';
$Akhir	= isset($_GET['akhir']) ? $_GET['akhir'] : '';


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
            <h3 style="margin: 0;"><strong>LAPORAN PEMASUKAN KAIN GREIGE (QTY ONLY)</strong></h3>
            <h5 style="margin: 10px 0;"><strong>BULAN <?php echo $bulanTahun; ?></strong></h5>
            <h5 style="margin: 10px 0;"><strong>No Form : FW-19-GKG-06/04</strong></h5>
            <h5 style="margin: 10px 0;"><strong>Halaman :</strong></h5>
        </div>
    </div>
<body>

<!-- <div align="LEFT">TGL : <?php echo date($_GET['tanggal1']); ?></div> -->

<?php
    $sqlGabungan = "SELECT
            T.TRANSACTIONDATE,
            SUM(T.QTY_NONFK) AS QTY_KG,
            SUM(T.QTY_FK) AS QTY_FK
        FROM (
            -- ITTI NON FK
            SELECT
                CAST(STOCKTRANSACTION.TRANSACTIONDATE AS DATE) AS TRANSACTIONDATE,
                STOCKTRANSACTION.WEIGHTNET AS QTY_NONFK,
                0 AS QTY_FK
            FROM INTERNALDOCUMENT
            LEFT JOIN INTERNALDOCUMENTLINE ON
                INTERNALDOCUMENT.PROVISIONALCOUNTERCODE = INTERNALDOCUMENTLINE.INTDOCPROVISIONALCOUNTERCODE
                AND INTERNALDOCUMENT.PROVISIONALCODE = INTERNALDOCUMENTLINE.INTDOCUMENTPROVISIONALCODE
            LEFT JOIN STOCKTRANSACTION ON
                INTERNALDOCUMENTLINE.INTDOCUMENTPROVISIONALCODE = STOCKTRANSACTION.ORDERCODE
                AND INTERNALDOCUMENTLINE.ORDERLINE = STOCKTRANSACTION.ORDERLINE
            WHERE
                STOCKTRANSACTION.TEMPLATECODE = '204'
                AND STOCKTRANSACTION.LOGICALWAREHOUSECODE = 'M021'
                AND STOCKTRANSACTION.TRANSACTIONDATE BETWEEN '$Awal' AND '$Akhir'
                AND INTERNALDOCUMENTLINE.ORDERLINE IS NOT NULL
                AND INTERNALDOCUMENTLINE.SUBCODE02 NOT IN ('FKP', 'FKY', 'FJQ')

            UNION ALL

            -- Knitt DLL (non FK)
            SELECT
                CAST(s.TRANSACTIONDATE AS DATE) AS TRANSACTIONDATE,
                s.BASEPRIMARYQUANTITY AS QTY_NONFK,
                0 AS QTY_FK
            FROM STOCKTRANSACTION s
            LEFT JOIN ADSTORAGE a ON a.UNIQUEID = s.ABSUNIQUEID AND a.NAMENAME = 'StatusRetur'
            WHERE
                s.TRANSACTIONDATE BETWEEN '$Awal' AND '$Akhir'
                AND s.ITEMTYPECODE = 'KGF'
                AND s.LOGICALWAREHOUSECODE = 'M021'
                AND s.TEMPLATECODE = 'OPN'
                AND a.VALUESTRING = '1'

            UNION ALL

            -- ITTI FK
            SELECT
                CAST(st.TRANSACTIONDATE AS DATE) AS TRANSACTIONDATE,
                0 AS QTY_NONFK,
                st.BASEPRIMARYQUANTITY AS QTY_FK
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
                AND st.TRANSACTIONDATE BETWEEN '$Awal' AND '$Akhir'
                AND INTERNALDOCUMENTLINE.ORDERLINE IS NOT NULL
                AND INTERNALDOCUMENTLINE.SUBCODE02 IN ('FKP', 'FKY', 'FJQ')
        ) T
        GROUP BY T.TRANSACTIONDATE
        ORDER BY T.TRANSACTIONDATE
    ";

    $stmt = db2_exec($conn1, $sqlGabungan, ['cursor' => DB2_SCROLLABLE]);

    // Query CWD
    $sqlCWD = "SELECT 
            CAST(s.TRANSACTIONDATE AS DATE) AS TRANSACTIONDATE,
            SUM(s.BASEPRIMARYQUANTITY) AS QTY_CWD
        FROM STOCKTRANSACTION s
        LEFT JOIN ADSTORAGE a ON a.UNIQUEID = s.ABSUNIQUEID AND a.NAMENAME = 'StatusRetur'
        WHERE 
            s.TRANSACTIONDATE BETWEEN '$Awal' AND '$Akhir'
            AND s.ITEMTYPECODE = 'KGF'
            AND s.LOGICALWAREHOUSECODE = 'M021'
            AND s.TEMPLATECODE = 'OPN'
            AND a.VALUESTRING = '2'
            AND s.PROJECTCODE LIKE '%CWD%'
        GROUP BY CAST(s.TRANSACTIONDATE AS DATE)
    ";

    $stmtCWD = db2_exec($conn1, $sqlCWD, ['cursor' => DB2_SCROLLABLE]);

    // Ambil data CWD
    $cwdTotals = [];
    while ($rowCWD = db2_fetch_assoc($stmtCWD)) {
        $tgl = substr($rowCWD['TRANSACTIONDATE'], 0, 10);
        $cwdTotals[$tgl] = (float)$rowCWD['QTY_CWD'];
    }

    $tanggalTotals = [];
    $totalQty = 0;
    $totalFK = 0;
    $totalCWD = 0;

    while ($row = db2_fetch_assoc($stmt)) {
        $tanggal = substr($row['TRANSACTIONDATE'], 0, 10);
        $qty_kg = (float)$row['QTY_KG'];
        $qty_fk = (float)$row['QTY_FK'];
        $qty_cwd = $cwdTotals[$tanggal] ?? 0;

        $tanggalTotals[$tanggal] = [
            'qty_kg' => $qty_kg,
            'qty_fk' => $qty_fk,
            'qty_cwd' => $qty_cwd,
        ];

        $totalQty += $qty_kg;
        $totalFK += $qty_fk;
        $totalCWD += $qty_cwd;
    }

    $start = new DateTime($Awal);
    $end = new DateTime($Akhir);

    while ($start <= $end) {
        $tanggal = $start->format('Y-m-d');

        if (!isset($tanggalTotals[$tanggal])) {
            $qty_cwd = $cwdTotals[$tanggal] ?? 0;
            $tanggalTotals[$tanggal] = [
                'qty_kg' => 0,
                'qty_fk' => 0,
                'qty_cwd' => $qty_cwd,
            ];
            $totalCWD += $qty_cwd;
        }

        $start->modify('+1 day');
    }

    ksort($tanggalTotals);
?>

<table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse; width: 90%;">
    <thead style="background-color: #e0e0e0;">
        <tr>
            <th style="text-align: center">Tanggal</th>              
            <th style="text-align: center">ITTI</th>        
            <th style="text-align: center">FLAT KNIT (ITTI)</th>         
            <th style="text-align: center">Knitt DLL</th>
            <th style="text-align: center">Total</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $grandTotalBaris = 0;

        foreach ($tanggalTotals as $tgl => $data): 
            $totalBaris = $data['qty_kg'] + $data['qty_fk'] + $data['qty_cwd'];
            $grandTotalBaris += $totalBaris;
        ?>
            <tr>
                <td><?= htmlspecialchars($tgl) ?></td>
                <td style="text-align: right;"><?= number_format($data['qty_kg'], 2, '.', ',') ?></td>
                <td style="text-align: right;"><?= number_format($data['qty_fk'], 2, '.', ',') ?></td>
                <td style="text-align: right;"><?= number_format($data['qty_cwd'], 2, '.', ',') ?></td>
                <td style="text-align: right;"><?= number_format($totalBaris, 2, '.', ',') ?></td>
            </tr>
        <?php endforeach; ?>
        <tr style="background-color: #f2f2f2;">
            <td><strong>Total</strong></td>
            <td style="text-align: right;"><strong><?= number_format($totalQty, 2, '.', ',') ?></strong></td>
            <td style="text-align: right;"><strong><?= number_format($totalFK, 2, '.', ',') ?></strong></td>
            <td style="text-align: right;"><strong><?= number_format($totalCWD, 2, '.', ',') ?></strong></td>
            <td style="text-align: right;"><strong><?= number_format($grandTotalBaris, 2, '.', ',') ?></strong></td>
        </tr>
    </tbody>
</table>
<table></table>

<?php
    $sql = "SELECT
        SUM(s.BASEPRIMARYQUANTITY) AS RETURN_PRODUKSI
        FROM STOCKTRANSACTION s
        LEFT JOIN ADSTORAGE a ON
            a.UNIQUEID = s.ABSUNIQUEID
            AND a.NAMENAME = 'StatusRetur'
        WHERE
            s.TRANSACTIONDATE BETWEEN ? AND ?
            AND s.ITEMTYPECODE = 'KGF'
            AND s.LOGICALWAREHOUSECODE = 'M021'
            AND s.TEMPLATECODE = 'OPN'
            AND a.VALUESTRING IN ('1','2')
            AND s.LOTCODE NOT LIKE ?
            AND s.LOTCODE NOT LIKE ?
            AND s.LOTCODE NOT LIKE ?
            AND (s.PROJECTCODE NOT LIKE ? OR s.PROJECTCODE IS NULL)
    ";

    $stmt = db2_prepare($conn1, $sql);
    if (!$stmt) {
        echo "Query prepare error: " . db2_stmt_errormsg();
        return;
    }

    $params = [$Awal, $Akhir, '%19%', '%/20', '%/21', '%CWD%'];
    if (!db2_execute($stmt, $params)) {
        echo "Query execute error: " . db2_stmt_errormsg($stmt);
        return;
    }

    echo "<tr><th>Retur Produksi : </th></tr>";
    while ($row = db2_fetch_assoc($stmt)) {
        echo "<td style=\"text-align: right;\">" . number_format((float)$row['RETURN_PRODUKSI'], 2, '.', ',') . "</td>";
        echo "</tr>";
    }
    echo "</table>";
?>

<table></table>

<table style="width: auto;" border="1">
    <tr>
        <td colspan="2"></td>
        <td style="text-align: center; vertical-align: middle;">Dibuat Oleh :</td>
        <td style="text-align: center; vertical-align: middle;">Diperiksa Oleh :</td>
        <td style="text-align: center; vertical-align: middle;">Mengetahui :</td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: center; vertical-align: middle;">Nama</td>
        <td style="text-align: center; vertical-align: middle;"></td>
        <td style="text-align: center; vertical-align: middle;"></td>
        <td style="text-align: center; vertical-align: middle;"></td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: center; vertical-align: middle;">Jabatan</td>
        <td style="text-align: center; vertical-align: middle;"></td>
        <td style="text-align: center; vertical-align: middle;"></td>
        <td style="text-align: center; vertical-align: middle;"></td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: center; vertical-align: middle;">Tanggal</td>
        <td style="text-align: center; vertical-align: middle;"></td>
        <td style="text-align: center; vertical-align: middle;"></td>
        <td style="text-align: center; vertical-align: middle;"></td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: center; vertical-align: middle;">Tanda Tangan</td>
        <td style="text-align: center; vertical-align: middle;"><br><br><br><br></td>
        <td style="text-align: center; vertical-align: middle;"></td>
        <td style="text-align: center; vertical-align: middle;"></td>
    </tr>
</table>