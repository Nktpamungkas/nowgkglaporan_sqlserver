<?php require_once 'header.php'; ?>
<title><?php $title = "PPC - Filter Memo Penting"; echo $title; ?></title>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="nav-icon fas fa-search"></i> FILTER PENCARIAN MEMO PENTING PPC</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label>No Bon Order:</label>
                                    <input type="text" name="no_order" class="form-control input-sm" value="<?php if (isset($_POST['submit'])){ echo $_POST['no_order']; } ?>">
                                </div>
                                <div class="col-sm-2">
                                    <label>Dari Tanggal:</label>
                                    <div class="input-group date input-sm" id="reservationdate"  data-target-input="nearest">
                                        <input type="date" name="tgl1" class="form-control" id="tgl1" value="<?php if (isset($_POST['submit'])){ echo $_POST['tgl1']; } ?>">
                                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label>Sampai Tanggal:</label>
                                    <div class="input-group date input-sm" id="reservationdate2" data-target-input="nearest">
                                        <input type="date" name="tgl2" class="form-control" id="tgl2" value="<?php if (isset($_POST['submit'])){ echo $_POST['tgl2']; } ?>">
                                        <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <button type="submit" name="submit" class="btn btn-primary">Cari data</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <br>
                        <?php if (isset($_POST['submit'])) : ?>
                            <a href="ppc_memopenting-excel.php?no_order=<?= $_POST['no_order']; ?>&tgl1=<?= $_POST['tgl1']; ?>&tgl2=<?= $_POST['tgl2']; ?>">CETAK KE EXCEL</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if (isset($_POST['submit'])) : ?>
    <section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="memo-penting" class="table table-responsive table-bordered table-striped">
                            <thead>
                                <tr align="center">
                                    <th>TGL TERIMA ORDER</th>
                                    <th>PELANGGAN</th>
                                    <th>NO. ORDER</th>
                                    <th>NO. PO</th>
                                    <th>KETERANGAN PRODUCT</th>
                                    <th>LEBAR</th>
                                    <th>GRAMASI</th>
                                    <th>WARNA</th>
                                    <th>NO WARNA</th>
                                    <th>DELIVERY</th>
                                    <th>ROLL</th>
                                    <th>BRUTO/BAGI KAIN</th>
                                    <th>NETTO</th>
                                    <th>DELAY</th>
                                    <th>NO DEMAND</th>
                                    <th>NO KARTU KERJA</th>
                                </tr>
                            </thead>
                            <tbody> 
                                <?php 
                                    ini_set("error_reporting", 1);
                                    session_start();
                                    require_once "koneksi.php";
                                    $no_order = $_POST['no_order'];
                                    $tgl1     = $_POST['tgl1'];
                                    $tgl2     = $_POST['tgl2'];
                                    $query = "SELECT 
                                                i.ORDERDATE AS ORDERDATE,
                                                TRIM(ip.LANGGANAN) || '|' || TRIM(ip.BUYER) AS PELANGGAN,
                                                i.PROJECTCODE AS NO_ORDER,
                                                ik.EXTERNALREFERENCE AS NO_PO,
                                                TRIM(i.SUBCODE01) || '-' || TRIM(i.SUBCODE02) || '-' || TRIM(i.SUBCODE03) || '-' || TRIM(i.SUBCODE04) || '-' ||
                                                TRIM(i.SUBCODE05) || '-' || TRIM(i.SUBCODE06) || '-' || TRIM(i.SUBCODE07) || '-' || TRIM(i.SUBCODE08) AS KETERANGAN_PRODUCT,
                                                CASE
                                                    WHEN a_kff.VALUEDECIMAL IS NULL THEN a_fkf.VALUEDECIMAL 
                                                    ELSE a_kff.VALUEDECIMAL
                                                END AS LEBAR,
                                                CASE
                                                    WHEN REGEXP_SUBSTR(i.SUBCODE04, '([^-]*)-?', 1, 2, '', 1) = '' THEN a.VALUEDECIMAL 
                                                    ELSE REGEXP_SUBSTR(i.SUBCODE04, '([^-]*)-?', 1, 2, '', 1)
                                                END AS GRAMASI,
                                                i.WARNA AS WARNA,
                                                i.SUBCODE05 AS NO_WARNA,
                                                s.DELIVERYDATE AS DELIVERY,
                                                s2.ROLL AS ROLL,
                                                s3.QTY_BAGIKAIN AS QTY_BAGIKAIN,
                                                in2.USERPRIMARYQUANTITY AS NETTO,
                                                CASE
                                                    WHEN Days(now()) - Days(Timestamp_Format(s.DELIVERYDATE, 'YYYY-MM-DD')) < 0 THEN 0
                                                    ELSE Days(now()) - Days(Timestamp_Format(s.DELIVERYDATE, 'YYYY-MM-DD'))
                                                END	AS DELAY,
                                                i.PRODUCTIONORDERCODE AS NO_KK,
                                                i.DEAMAND AS DEMAND,
                                                i.SUBCODE01,i.SUBCODE02,i.SUBCODE03,i.SUBCODE04,i.ORDERLINE,i.PROGRESSSTATUS
                                            FROM ITXVIEWKK i 
                                            LEFT JOIN ITXVIEW_PELANGGAN ip ON ip.ORDPRNCUSTOMERSUPPLIERCODE = i.ORDPRNCUSTOMERSUPPLIERCODE AND ip.CODE = i.PROJECTCODE 
                                            LEFT JOIN ITXVIEW_KGBRUTO ik ON ik.PROJECTCODE = i.PROJECTCODE 
                                                                        AND ik.ORIGDLVSALORDERLINEORDERLINE = i.ORIGDLVSALORDERLINEORDERLINE  
                                                                        AND ik.CODE = i.DEAMAND 
                                            -- LEBAR KFF
                                            LEFT JOIN PRODUCT p_kff ON p_kff.SUBCODE01 = i.SUBCODE01 AND p_kff.SUBCODE02 = i.SUBCODE02
                                                                AND p_kff.SUBCODE03 = i.SUBCODE03 AND p_kff.SUBCODE04 = i.SUBCODE04 
                                                                AND p_kff.SUBCODE05 = i.SUBCODE05 AND p_kff.SUBCODE06 = i.SUBCODE06 
                                                                AND p_kff.SUBCODE07 = i.SUBCODE07 AND p_kff.SUBCODE08 = i.SUBCODE08 
                                                                AND p_kff.SUBCODE09 = i.SUBCODE09 AND p_kff.SUBCODE10 = i.SUBCODE10
                                                                AND p_kff.ITEMTYPECODE = i.ITEMTYPEAFICODE 
                                                                AND p_kff.ITEMTYPECODE = 'KFF'
                                            LEFT JOIN ADSTORAGE a_kff ON a_kff.UNIQUEID = p_kff.ABSUNIQUEID AND a_kff.NAMENAME = 'Width'
                                            -- LEBAR FKF
                                            LEFT JOIN PRODUCT p_fkf ON p_fkf.SUBCODE01 = i.SUBCODE01 AND p_fkf.SUBCODE02 = i.SUBCODE02
                                                                AND p_fkf.SUBCODE03 = i.SUBCODE03 AND p_fkf.SUBCODE04 = i.SUBCODE04 
                                                                AND p_fkf.SUBCODE05 = i.SUBCODE05 AND p_fkf.SUBCODE06 = i.SUBCODE06 
                                                                AND p_fkf.SUBCODE07 = i.SUBCODE07 AND p_fkf.SUBCODE08 = i.SUBCODE08 
                                                                AND p_fkf.SUBCODE09 = i.SUBCODE09 AND p_fkf.SUBCODE10 = i.SUBCODE10
                                                                AND p_fkf.ITEMTYPECODE = i.ITEMTYPEAFICODE 
                                                                AND p_fkf.ITEMTYPECODE = 'FKF'
                                            LEFT JOIN ADSTORAGE a_fkf ON a_fkf.UNIQUEID = p_fkf.ABSUNIQUEID AND a_fkf.NAMENAME = 'Width'
                                            -- GRAMASI KFF
                                            LEFT JOIN PRODUCT p ON p.SUBCODE01 = i.SUBCODE01 AND p.SUBCODE02 = i.SUBCODE02
                                                                AND p.SUBCODE03 = i.SUBCODE03 AND p.SUBCODE04 = i.SUBCODE04 
                                                                AND p.SUBCODE05 = i.SUBCODE05 AND p.SUBCODE06 = i.SUBCODE06 
                                                                AND p.SUBCODE07 = i.SUBCODE07 AND p.SUBCODE08 = i.SUBCODE08 
                                                                AND p.SUBCODE09 = i.SUBCODE09 AND p.SUBCODE10 = i.SUBCODE10
                                                                AND p.ITEMTYPECODE = i.ITEMTYPEAFICODE 
                                                                AND p.ITEMTYPECODE = 'KFF'
                                            LEFT JOIN ADSTORAGE a ON a.UNIQUEID = p.ABSUNIQUEID AND a.NAMENAME = 'GSM'
                                            LEFT JOIN SALESORDERDELIVERY s ON s.PROJECTCODE = i.PROJECTCODE AND s.SALESORDERLINEORDERLINE = i.ORDERLINE 
                                            LEFT JOIN (SELECT count(*) AS ROLL, s2.PRODUCTIONORDERCODE FROM STOCKTRANSACTION s2 GROUP BY s2.PRODUCTIONORDERCODE) s2 ON s2.PRODUCTIONORDERCODE = i.PRODUCTIONORDERCODE 
                                            LEFT JOIN (SELECT SUM(s3.USERPRIMARYQUANTITY) AS QTY_BAGIKAIN, s3.PRODUCTIONORDERCODE FROM STOCKTRANSACTION s3 GROUP BY s3.PRODUCTIONORDERCODE) s3 ON s3.PRODUCTIONORDERCODE = i.PRODUCTIONORDERCODE
                                            LEFT JOIN ITXVIEW_NETTO in2 ON in2.CODE = i.DEAMAND AND in2.SALESORDERLINESALESORDERCODE = i.PROJECTCODE";
                                            $groupby = "GROUP BY 
                                                        i.ORDERDATE,
                                                        ip.LANGGANAN,
                                                        ip.BUYER,
                                                        i.PROJECTCODE,
                                                        ik.EXTERNALREFERENCE,
                                                        i.SUBCODE01,i.SUBCODE02,i.SUBCODE03,i.SUBCODE04,
                                                        i.SUBCODE05,i.SUBCODE06,i.SUBCODE07,i.SUBCODE08,
                                                        a_kff.VALUEDECIMAL,
                                                        a_fkf.VALUEDECIMAL,
                                                        a_kff.VALUEDECIMAL,
                                                        a.VALUEDECIMAL,
                                                        i.WARNA,
                                                        s.DELIVERYDATE,
                                                        s2.ROLL,
                                                        s3.QTY_BAGIKAIN,
                                                        in2.USERPRIMARYQUANTITY,
                                                        i.PRODUCTIONORDERCODE,
                                                        i.DEAMAND,
                                                        i.ORDERLINE,
                                                        i.PROGRESSSTATUS";
                                    if ($no_order) {
                                        $sqlDB2="$query WHERE i.PROGRESSSTATUS <> '6' AND i.PROJECTCODE = '$no_order' $groupby";
                                    } else {
                                        $sqlDB2="$query WHERE i.PROGRESSSTATUS <> '6' AND i.ORDERDATE BETWEEN '$tgl1' AND '$tgl2' $groupby";
                                    }
                                    $stmt=db2_exec($conn1,$sqlDB2);
                                    while ($rowdb2 = db2_fetch_assoc($stmt)) {
                                ?>
                                    <tr>
                                        <td><?= $rowdb2['ORDERDATE']; ?></td>
                                        <td><?= $rowdb2['PELANGGAN']; ?></td>
                                        <td><?= $rowdb2['NO_ORDER']; ?></td>
                                        <td><?= $rowdb2['NO_PO']; ?></td>
                                        <td><?= $rowdb2['KETERANGAN_PRODUCT']; ?></td>
                                        <td><?= number_format($rowdb2['LEBAR'],0); ?></td>
                                        <td><?= number_format($rowdb2['GRAMASI'],0); ?></td>
                                        <td><?= $rowdb2['WARNA']; ?></td>
                                        <td><?= $rowdb2['NO_WARNA']; ?></td>
                                        <td><?= $rowdb2['DELIVERY']; ?></td>
                                        <td><?= $rowdb2['ROLL']; ?></td>
                                        <td><?= number_format($rowdb2['QTY_BAGIKAIN'],2); ?></td>
                                        <td><?= number_format($rowdb2['NETTO'],0); ?></td>
                                        <td><?= $rowdb2['DELAY']; ?></td>
                                        <td><a href="http://10.0.0.10/laporan/ppc_filter_steps.php?demand=<?= $rowdb2['DEMAND']; ?>"><?= $rowdb2['DEMAND']; ?></a></td>
                                        <td><?= $rowdb2['NO_KK']; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php require_once 'footer.php'; ?>