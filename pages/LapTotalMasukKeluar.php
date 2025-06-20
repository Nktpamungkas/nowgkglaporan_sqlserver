<?php
$Thn2			= isset($_POST['thn']) ? $_POST['thn'] : '';
$Bln2			= isset($_POST['bln']) ? $_POST['bln'] : '';
$Dept			= isset($_POST['dept']) ? $_POST['dept'] : '';
$Bulan			= $Thn2."-".$Bln2;
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
?>
<!-- Main content -->
      <div class="container-fluid">
		<form role="form" method="post" enctype="multipart/form-data" name="form1">  
		<div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Filter Per Bulan</h3>

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

		
		
		<div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Detail Laporan Harian Masuk Kain Greige</h3>
				<!--<a href="pages/cetak/lapgmasuk_excel1.php?awal=<?php echo $Awal;?>&akhir=<?php echo $Akhir;?>" class="btn bg-blue float-right" target="_blank">Cetak Excel</a>--> 
				<a href="pages/cetak/lapgtotal_masuk_excel.php?awal=<?php echo $Bulan; ?>" class="btn bg-blue float-right"
					target="_blank">Cetak Excel</a>
          </div>
              <!-- /.card-header -->
              <div class="card-body">
			<?php
	if($Bln2!="01"){
		if(strlen($BlnLalu)==1){$bl0="0".$BlnLalu;}else{$bl0=$BlnLalu;}
		$BlnLL=$Thn2."-".$bl0;
	}else{
		if(strlen($BlnLalu)==1){$bl0="0".$BlnLalu;}else{$bl0=$BlnLalu;}
		$BlnLL=$Thn."-".$bl0;
	}			  
	$sql = sqlsrv_query($con," SELECT TOP 1 
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

	$sqlM = sqlsrv_query($con," SELECT 
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

	$sqlK = sqlsrv_query($con," SELECT 
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

	$sqlT = sqlsrv_query($con," SELECT TOP 1 
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

		$keluarMati1 = "SELECT DISTINCT kg
		FROM (
			SELECT 
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
				ITXVIEWHEADERKNTORDER.ORIGDLVSALORDLINESALORDERCODE
		) hasil";

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
	<table id="example16" width="100%" class="table table-sm table-bordered table-striped" style="font-size: 11px; text-align: center;">
                  <thead>
                  <tr>
                    <th width="3%" rowspan="2" align="center" valign="middle">#</th>
                    <th width="16%" rowspan="2" align="center" valign="middle"><strong>Bulan <?php echo namabln($Bln2)." ".$Thn2; ?></strong></th>
                    <th colspan="2" valign="middle" style="text-align: center">Kain I</th>
                    <th width="18%" rowspan="2" valign="middle" style="text-align: center">Kain II</th>
                    <th width="16%" rowspan="2" valign="middle" style="text-align: center">Total</th>
                    </tr>
                  <tr>
                    <th width="22%" valign="middle" style="text-align: center">Stok Proses</th>
                    <th width="25%" valign="middle" style="text-align: center">Stok Mati</th>
                    </tr>
                  </thead>
                  <tbody>
		<?php
			$stock_bln_sebelumnya = round($r['kg'], 2) - round($stokmatiT['total_bulan_lalu'], 2);

			$stokTerima = round($datamasuk['TOTAL_QTY_MASUK'], 2) - round($rRMasuk['kg'], 2); // float
			$Rkg = round($rRMasuk['kg'], 2); // float
			$RBs = round($rowdb21_masuk['qty_kg_masuk'], 2); // float
			$total_masuk = $stokTerima + $Rkg + $RBs;


			$stokkeluar = round($rK['kg'], 2) - round($rRkeluar['kg'], 2);
			$stokkeluar_akhir = $stokkeluar - $totdatakeluarMati1;
			$Rkg_keluar = round($rRkeluar['kg'], 2);
			$Rkg_mati_keluar = round($rowdb21['qty_kg_keluar'], 2);
			$total_keluar = $stokkeluar + $Rkg_keluar + $Rkg_mati_keluar;

			$total_stock = $stock_bln_sebelumnya + $stokTerima - $stokkeluar_akhir;

			$stock_mati_bln_sekarang = round($stokmatiT['total_bulan_ini'], 2);

			$total_stock_saat_ini = $total_stock + $stock_mati_bln_sekarang;
		?>
	  <tr>
	    <td>1</td>
		<td><strong>Stok Bulan <?php if($Bln2!="01"){echo namabln($BlnLalu)." ".$Thn2;}else{echo namabln($BlnLalu)." ".$Thn;} ?></strong></td>
		<td align="center"><?php echo number_format(round($r['kg'], 2) - round($stokmatiT['total_bulan_lalu'],2), 2); ?></td>
		<td><?php echo number_format(round($stokmatiT['total_bulan_lalu'],2),2); ?></td>
		<td align="center">&nbsp;</td>
		<td align="right"><?php echo number_format(round($r['kg'],2),2); ?></td>
      </tr>	  
	 <tr>
		
	   <td>2</td>
	   <td><strong>Masuk Kain</strong></td>
		<td><?php echo number_format($stokTerima, 2) ?></td>
		</td>
		<td align="center">
		<?php
		echo isset($rowdb21_masuk['qty_kg_masuk']) ? number_format(round($rowdb21_masuk['qty_kg_masuk'], 2), 2) : '0.00';
		?>
		</td>
	    <td align="center"><?php echo number_format(round($rRMasuk['kg'], 2), 2); ?></td>
	    <td align="right"><?php echo number_format($total_masuk, 2) ?></td>

	    </tr>
	 <tr>
	   <td>3</td>
	   <td><strong>Keluar Kain</strong></td>
	   <td align="center"><?php echo number_format($stokkeluar_akhir,2); ?></td></td>
	   <td align="center">
		<?php
			echo isset($rowdb21['qty_kg_keluar']) ? number_format(round($rowdb21['qty_kg_keluar'], 2), 2) : '0.00';
			?>
		</td>	   
	   <td align="center"><?php echo number_format(round($rRkeluar['kg'],2),2); ?></td>
	   <td align="right"><?php echo number_format($total_keluar, 2); ?></td>
	   </tr>
	 <tr>
	   <td>4</td>
	   <td><strong>Stok</strong></td>
	   <td align="center"><?php echo number_format($total_stock, 2); ?></td>
	   <td><?php echo number_format(round($stokmatiT['total_bulan_ini'],2),2); ?></td>
	   <td align="center">&nbsp;</td>
	   <td align="right"><?php echo number_format($total_stock_saat_ini,2); ?></td>
	   </tr>
	 <tr>
	   <td>5</td>
	   <td><strong>Stok Opname <?php echo namabln($Bln2)." ".$Thn2; ?></strong></td>
	   <td align="center"><?php echo number_format($total_stock, 2); ?></td>
	   <td><?php echo number_format(round($stokmatiT['total_bulan_ini'],2),2); ?></td>
	   <td align="center">&nbsp;</td>
	   <td align="right"><?php echo number_format($total_stock_saat_ini,2); ?></td>
	   </tr>				
	</tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div> 
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