<?php
$Zone = isset($_POST['zone']) ? $_POST['zone'] : '';
$Lokasi = isset($_POST['lokasi']) ? $_POST['lokasi'] : '';
$Barcode = substr($_POST['barcode'], -13);
?>

<?php
$sqlCek1 = sqlsrv_query($con, "SELECT COUNT(*) as jml FROM	dbnow_gkg.tbl_stokfull sf
	LEFT JOIN dbnow_gkg.tbl_upload tu ON tu.id=sf.id_upload  
	WHERE tu.status='Open' and sf.status='ok' and sf.zone='$Zone' AND sf.lokasi='$Lokasi'");

$ck1 = sqlsrv_fetch_array($sqlCek1);

$sqlCek2 = sqlsrv_query($con, "SELECT COUNT(*) as jml FROM	dbnow_gkg.tbl_stokfull sf
	LEFT JOIN dbnow_gkg.tbl_upload tu ON tu.id=sf.id_upload  
	WHERE tu.status='Open' and sf.status='belum cek' and sf.zone='$Zone' AND sf.lokasi='$Lokasi'");

$ck2 = sqlsrv_fetch_array($sqlCek2);

if ($_POST['cek'] == "Cek" or $_POST['cari'] == "Cari") {
	//if (strlen($_POST['barcode'])==13){

	$sqlCek = sqlsrv_query($con, "SELECT COUNT(*) as jml, sf.id_upload FROM dbnow_gkg.tbl_stokfull sf
		LEFT JOIN dbnow_gkg.tbl_upload tu ON tu.id=sf.id_upload  
		WHERE tu.status='Open' AND zone='$Zone' AND lokasi='$Lokasi' AND SN='$Barcode' GROUP BY sf.id_upload");

	$ck = sqlsrv_fetch_array($sqlCek);

	if ($Zone == "" and $Lokasi == "") {
		echo "<script>alert('Zone atau Lokasi belum dipilih');</script>";
	} else if (
		$Barcode != "" and strlen($Barcode) == 13 and (substr($Barcode, 0, 2) == "15" or substr($Barcode, 0, 2) == "16" or
			substr($Barcode, 0, 2) == "17" or substr($Barcode, 0, 2) == "18" or
			substr($Barcode, 0, 2) == "19" or substr($Barcode, 0, 2) == "20" or
			substr($Barcode, 0, 2) == "21" or substr($Barcode, 0, 2) == "22" or
			substr($Barcode, 0, 2) == "23" or
			substr($Barcode, 0, 3) == "000" or substr($Barcode, 0, 2) == "00" or
			substr($Barcode, 0, 2) == "80" or substr($Barcode, 0, 2) == "90")
	) {
		if ($ck['jml'] > 0) {
			$sqlData = sqlsrv_query($con, "UPDATE dbnow_gkg.tbl_stokfull SET 
				status='ok',
				tgl_cek=GETDATE()
				WHERE id_upload='$ck[id_upload]' AND zone='$Zone' AND lokasi='$Lokasi' AND SN='$Barcode'");

			$sqlCek1 = sqlsrv_query($con, "SELECT COUNT(*) as jml FROM	dbnow_gkg.tbl_stokfull WHERE status='ok' and zone='$Zone' AND lokasi='$Lokasi'");
			$ck1 = sqlsrv_fetch_array($sqlCek1);

			$sqlCek2 = sqlsrv_query($con, "SELECT COUNT(*) as jml FROM	dbnow_gkg.tbl_stokfull WHERE status='belum cek' and zone='$Zone' AND lokasi='$Lokasi'");
			$ck2 = sqlsrv_fetch_array($sqlCek2);
		} else {
			$sqlDB21 = " SELECT WHSLOCATIONWAREHOUSEZONECODE, WAREHOUSELOCATIONCODE, CREATIONDATETIME,BASEPRIMARYQUANTITYUNIT FROM 
				BALANCE b WHERE (b.ITEMTYPECODE='KGF' OR b.ITEMTYPECODE='FKG') AND b.LOGICALWAREHOUSECODE='M021' AND b.ELEMENTSCODE='$Barcode' ";

			$stmt1 = db2_exec($conn1, $sqlDB21, array('cursor' => DB2_SCROLLABLE));
			$rowdb21 = db2_fetch_assoc($stmt1);

			$lokasiAsli = trim($rowdb21['WHSLOCATIONWAREHOUSEZONECODE']) . "-" . trim($rowdb21['WAREHOUSELOCATIONCODE']);
			$tglMasuk = substr($rowdb21['CREATIONDATETIME'], 0, 10);
			$KGnow = round($rowdb21['BASEPRIMARYQUANTITYUNIT'], 2);

			if ($lokasiAsli != "-") {
				echo "<script>alert('Data Roll ini dilokasi $lokasiAsli');</script>";
				if ($Zone != "" and $Lokasi != "") {
					$Where = " AND sf.zone='$Zone' AND sf.lokasi='$Lokasi' ";
				} else {
					$Where = " AND sf.zone='$Zone' AND sf.lokasi='$Lokasi' ";
				}

				$sql = sqlsrv_query($con, " SELECT sf.* FROM dbnow_gkg.tbl_stokfull sf
					LEFT JOIN dbnow_gkg.tbl_upload tu ON tu.id=sf.id_upload  
					WHERE tu.status='Open' $Where ");
				$rowd = sqlsrv_fetch_array($sql);

				/*$sqlDataE=sqlsrv_query($con,"INSERT INTO tbl_stokloss SET 
							   lokasi='$Lokasi',
							   lokasi_asli='$lokasiAsli',
							   KG='$KGnow',
							   zone='$Zone',
							   SN='$Barcode',
							   tgl_masuk='$tglMasuk',
							   id_upload='$rowd[id_upload]',
							   tgl_cek=GETDATE()");*/
			} else {
				echo "<script>alert('SN tidak OK');</script>";
				if ($Zone != "" and $Lokasi != "") {
					$Where = " AND sf.zone='$Zone' AND sf.lokasi='$Lokasi' ";
				} else {
					$Where = " AND sf.zone='$Zone' AND sf.lokasi='$Lokasi' ";
				}
				$sql = sqlsrv_query($con, " SELECT sf.* FROM dbnow_gkg.tbl_stokfull sf
					LEFT JOIN dbnow_gkg.tbl_upload tu ON tu.id=sf.id_upload  
					WHERE tu.status='Open' $Where ");
				$rowd = sqlsrv_fetch_array($sql);

				$sqlDataE = sqlsrv_query($con, "INSERT INTO dbnow_gkg.tbl_stokloss 
					(lokasi,lokasi_asli,KG,zone,SN,tgl_masuk,id_upload,tgl_cek)
					VALUES ('$Lokasi','$lokasiAsli','$KGnow','$Zone','$Barcode',
					'$tglMasuk','$rowd[id_upload]',GETDATE())");
			}

			$sqlCek1 = sqlsrv_query($con, "SELECT COUNT(*) as jml, sf.id_upload FROM dbnow_gkg.tbl_stokfull sf
				LEFT JOIN dbnow_gkg.tbl_upload tu ON tu.id=sf.id_upload  
				WHERE tu.status='Open' AND SN='$Barcode' GROUP BY sf.id_upload");

			$ck1 = sqlsrv_fetch_array($sqlCek1);

			if ($ck1['jml'] > 0) {
				/*$sqlDataE=sqlsrv_query($con,"INSERT INTO tbl_stokloss SET 
								   lokasi='$Lokasi',
								   lokasi_asli='$lokasiAsli',
								   KG='$KGnow',
								   zone='$Zone',
								   SN='$Barcode',
								   tgl_masuk='$tglMasuk',
								   id_upload='$ck1[id_upload]',
								   tgl_cek=GETDATE()");*/

				$sqlData1 = sqlsrv_query($con, "UPDATE dbnow_gkg.tbl_stokfull SET 
						status='ok',
						zone='$Zone',
						lokasi='$Lokasi',
						tgl_cek=GETDATE()
						WHERE id_upload='$ck1[id_upload]' AND SN='$Barcode'");
			}
		}
	} else if ($Barcode == "") {
		//barcode masih kosong
	} else {
		echo "<script>alert('SN tidak ditemukan');</script>";
	}

}
?>

<!-- Main content -->
<div class="container-fluid">
	<form role="form" method="post" enctype="multipart/form-data" name="form1">
		<div class="card card-default">
			<div class="card-header">
				<h3 class="card-title">Filter Data</h3>

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
					<label for="zone" class="col-md-1">Zone</label>
					<div class="input-group input-group-sm">
					<select class="form-control select2bs4" style="width: 80%;" name="zone">
						<option value="">Pilih</option>
						<?php $sqlZ = sqlsrv_query($con, " SELECT * FROM dbnow_gkg.tbl_zone order by nama ASC");
						while ($rZ = sqlsrv_fetch_array($sqlZ)) {
							?>
							<option value="<?php echo $rZ['nama']; ?>" <?php if ($rZ['nama'] == $Zone) {
								  echo "SELECTED";
							  } ?>>
								<?php echo $rZ['nama']; ?>
							</option>
						<?php } ?>
					</select>
					<span class="input-group-append">
						<button type="button" class="btn btn-warning btn-flat" data-toggle="modal" data-target="#DataZone"><i class="fa fa-plus"></i> </button>
				  </span>
				 </div>
				</div>
				<div class="form-group row">
					<label for="lokasi" class="col-md-1">Location</label>
					<div class="input-group input-group-sm">
					<select class="form-control select2bs4" style="width: 80%;" name="lokasi">
						<option value="">Pilih</option>
						<?php $sqlL = sqlsrv_query($con, " SELECT * FROM dbnow_gkg.tbl_lokasi WHERE zone='$Zone' order by nama ASC");
						while ($rL = sqlsrv_fetch_array($sqlL)) {
							?>
							<option value="<?php echo $rL['nama']; ?>" <?php if ($rL['nama'] == $Lokasi) {
								  echo "SELECTED";
							  } ?>>
								<?php echo $rL['nama']; ?>
							</option>
						<?php } ?>
					</select>
					<span class="input-group-append">
                   	  	<button type="button" class="btn btn-warning btn-flat" data-toggle="modal" data-target="#DataLokasi"><i class="fa fa-plus"></i> </button>
               		</span>
				  </div>
				</div>
				<button class="btn btn-info" type="submit" value="Cari" name="cari">Cari Data</button>
			</div>

			<!-- /.card-body -->

		</div>
		<!--	</form>
		<form role="form" method="post" enctype="multipart/form-data" name="form2">-->
		<div class="card card-default">

			<!-- /.card-header -->
			<div class="card-body">
				<div class="form-group row">
					<label for="barcode" class="col-md-1">Barcode</label>
					<input type="text" class="form-control" name="barcode" placeholder="SN / Elements" id="barcode" on
						autofocus>
				</div>
				<button class="btn btn-primary" type="submit" name="cek" value="Cek">Check</button>

			</div>

			<!-- /.card-body -->

		</div>
	</form>
	<div class="card">
		<div class="card-header">
			<h3 class="card-title">Stock</h3>
		</div>
		<!-- /.card-header -->
		<div class="card-body">
			<strong>Stok OK Sesuai Tempat</strong> <small class='badge badge-success'> <?php echo $ck1['jml']; ?> roll
			</small><br>
			<strong>Stok belum Cek</strong> <small class='badge badge-danger'> <?php echo $ck2['jml']; ?> roll </small>
			<table id="example1" class="table table-sm table-bordered table-striped" style="font-size:13px;">
				<thead>
					<tr>
						<th style="text-align: center">SN</th>
						<th style="text-align: center">Kg</th>
						<th style="text-align: center">Status</th>
						<th style="text-align: center">Lokasi</th>
						<th style="text-align: center">NOW</th>
						<th style="text-align: center">Lot</th>
						<th style="text-align: center">Itemno</th>
						<th style="text-align: center">Project</th>
						<th style="text-align: center">Ket.</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if ($Zone != "" and $Lokasi != "") {
						$Where = " AND sf.zone='$Zone' AND sf.lokasi='$Lokasi' ";
					} else {
						$Where = " AND sf.zone='$Zone' AND sf.lokasi='$Lokasi' ";
					}

					if ($Shift != "") {
						$Shft = " AND a.shft='$Shift' ";
					} else {
						$Shft = " ";
					}

					$sql = sqlsrv_query($con, " SELECT sf.* FROM dbnow_gkg.tbl_stokfull sf
	LEFT JOIN dbnow_gkg.tbl_upload tu ON tu.id=sf.id_upload  
	WHERE tu.status='Open' $Where ");

					$no = 1;
					$c = 0;

					while ($rowd = sqlsrv_fetch_array($sql)) {

						$sqlDB22 = " SELECT WHSLOCATIONWAREHOUSEZONECODE, WAREHOUSELOCATIONCODE FROM 
	BALANCE b WHERE (b.ITEMTYPECODE='KGF' or b.ITEMTYPECODE='FKG') AND b.ELEMENTSCODE='$rowd[SN]' ";
						$stmt2 = db2_exec($conn1, $sqlDB22, array('cursor' => DB2_SCROLLABLE));
						$rowdb22 = db2_fetch_assoc($stmt2);
						$lokasiBalance = trim($rowdb22['WHSLOCATIONWAREHOUSEZONECODE']) . "-" . trim($rowdb22['WAREHOUSELOCATIONCODE']);
						?>
						<tr>
							<td style="text-align: center"><?php echo $rowd['SN']; ?></td>
							<td style="text-align: right"><?php echo $rowd['KG']; ?></td>
							<td style="text-align: center"><small
									class='badge <?php if ($rowd['status'] == "ok") {
										echo "badge-success";
									} else if ($rowd['status'] == "belum cek") {
										echo "badge-danger";
									} ?>'>
									<?php echo $rowd['status']; ?></small></td>
							<td style="text-align: center"><?php echo $rowd['zone'] . "-" . $rowd['lokasi']; ?></td>
							<td style="text-align: center"><?php echo $lokasiBalance; ?></td>
							<td style="text-align: center"><?php echo $rowd['lot']; ?></td>
							<td style="text-align: center"><?php echo $rowd['itemno']; ?></td>
							<td style="text-align: center"><?php echo $rowd['project']; ?></td>
							<td style="text-align: center">
								<?php if ($lokasiBalance == "-") {
									echo "<small class='badge badge-danger'>Sudah Keluar</small>";
								} ?>
							</td>
						</tr>
						<?php

						$no++;
					} ?>
				</tbody>

			</table>
		</div>
		<!-- /.card-body -->
	</div>
	<div class="card">
		<div class="card-header">
			<h3 class="card-title">ReCheck Stock </h3>
		</div>
		<!-- /.card-header -->
		<div class="card-body">
			<table id="example3" class="table table-sm table-bordered table-striped" style="font-size:13px;">
				<thead>
					<tr>
						<th style="text-align: center">SN</th>
						<th style="text-align: center">KG</th>
						<th style="text-align: center">Lokasi Scan</th>
						<th style="text-align: center">Lokasi Asli(Data)</th>
						<th style="text-align: center">Tgl Masuk</th>
						<th style="text-align: center">Keterangan</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if ($Zone != "" and $Lokasi != "") {
						$Where = " AND sl.zone='$Zone' AND sl.lokasi='$Lokasi' ";
					} else {
						$Where = " AND sl.zone='$Zone' AND sl.lokasi='$Lokasi' ";
					}

					$sql1 = sqlsrv_query($con, "  SELECT DISTINCT 
													sl.SN,
													sl.KG,
													sl.zone,
													sl.lokasi,
													sl.status,
													sl.lokasi_asli,
													STRING_AGG(CASE 
														WHEN sl.tgl_masuk = '1900-01-01' THEN NULL 
														ELSE sl.tgl_masuk 
													END, ', ') AS tgl_masuk,  -- Menggabungkan tanggal dengan koma sebagai pemisah
													sl.id_upload,
													COUNT(sl.SN) AS jmlscn 
												FROM 
													dbnow_gkg.tbl_stokloss sl
												LEFT JOIN 
													dbnow_gkg.tbl_upload tu ON tu.id = sl.id_upload
												WHERE 
													tu.status = 'Open'
													$Where
												GROUP BY  
													sl.SN, 
													sl.KG, 
													sl.zone, 
													sl.lokasi, 
													sl.status, 
													sl.lokasi_asli, 
													sl.id_upload
												");

					$no = 1;
					$c = 0;

					while ($rowd1 = sqlsrv_fetch_array($sql1)) {
						if (strlen($rowd1['SN']) != "13") {
							$ketSN = "jumlah Karakter di SN tidak Sesuai";
						} else {
							$ketSN = "";
						}

						if ($rowd1['jmlscn'] > 1) {
							$ketSCN = "Jumlah Scan " . $rowd1['jmlscn'] . " kali";
						} else {
							$ketSCN = "";
						}

						if ($rowd1['tgl_masuk'] == "0000-00-00" || $rowd1['tgl_masuk'] == "") {
							$tglmsk = ""; // Anggap null
						} else {
							$tglmsk = $rowd1['tgl_masuk'];
						}
						?>
						<tr>
							<td style="text-align: center"><?php echo $rowd1['SN']; ?></td>
							<td style="text-align: center"><?php echo $rowd1['KG']; ?></td>
							<td style="text-align: center"><?php echo $rowd1['zone'] . "-" . $rowd1['lokasi']; ?></td>
							<td style="text-align: center"><?php echo $rowd1['lokasi_asli']; ?></td>
							<td style="text-align: center"><?php echo cek($tglmsk); ?></td>
							<td style="text-align: center"><small class='badge <?php if ($rowd1['status'] == "tidak ok") { 
								echo "badge-warning";} ?>'>
								<i class='fas fa-exclamation-triangle text-default blink_me'></i>
									<?php echo $rowd1['status']; ?></small> <?php echo $ketSN . ", " . $ketSCN; ?> </td>
						</tr>

						<?php
						$no++;
					}
					?>
				</tbody>
			</table>
		</div><!-- /.card-body -->
	</div><!-- /.container-fluid -->
</div><!-- /.content -->
<div class="modal fade" id="DataZone">
	<div class="modal-dialog">
		<form class="form-horizontal" name="modal_popup" data-toggle="validator" method="post" action="" enctype="multipart/form-data">
			<div class="modal-content">            
				<div class="modal-header">
					<h4 class="modal-title">Input Data Zone</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
					<span aria-hidden="true">&times;</span>
				</div>
				<div class="modal-body">
					<input type="hidden" id="id" name="id">
					<div class="form-group">
					<label for="zone1" class="col-md-3 control-label">Zone</label>
					<div class="col-md-12">
					<input type="text" class="form-control" id="zone1" name="zone1" maxlength="3" required>
					<span class="help-block with-errors"></span>
					</div>
					</div>				  
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<input type="submit" value="Save changes" name="simpan_zone" class="btn btn-primary" >
					</div>	  
			</div>
		</form>				
	</div>
</div>
<div class="modal fade" id="DataLokasi">
    <div class="modal-dialog">
		<form class="form-horizontal" name="modal_popup" data-toggle="validator" method="post" action="" enctype="multipart/form-data">
			<div class="modal-content">            
				<div class="modal-header">
					<h4 class="modal-title">Input Data Lokasi</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
					<span aria-hidden="true">&times;</span>
				</div>
				<div class="modal-body">
					<input type="hidden" id="id" name="id">
					<div class="form-group">
						<label for="zone" class="col-md-3 control-label">Zone</label>
						<div class="col-md-12">                 
							<select class="form-control select2bs4" name="zone2" required>
								<option value="">Pilih</option>	 
								<?php $sqlZ=sqlsrv_query($con, " SELECT * FROM dbnow_gkg.dbnow_gkg.tbl_zone ORDER BY nama ASC"); 
								while($rZ=sqlsrv_fetch_array($sqlZ)){
								?>
								<option value="<?php echo $rZ['nama'];?>"><?php echo $rZ['nama'];?></option>
								<?php  } ?>
							</select>			  
							<span class="help-block with-errors"></span>
						</div>
					</div>
					<div class="form-group">
						<label for="lokasi1" class="col-md-3 control-label">Lokasi</label>
						<div class="col-md-12">
							<input type="text" class="form-control" id="lokasi1" name="lokasi1" maxlength="10" required>
							<span class="help-block with-errors"></span>
						</div>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<input type="submit" value="Save changes" name="simpan_lokasi" class="btn btn-primary" >
				</div>	  
			</div>
		</form>				
    </div>
</div>
<?php 
if ($_POST['simpan_zone'] == "Save changes") {
    $zone1 = strtoupper($_POST['zone1']);

    // Query pakai sintaks SQL Server + parameterized query
    $sql = "INSERT INTO dbnow_gkg.dbnow_gkg.tbl_zone (nama) VALUES (?)";
    $params = array($zone1);

    $sqlData1 = sqlsrv_query($con, $sql, $params);

    if ($sqlData1) {
        echo "<script>window.location='CheckStock';</script>";
    } else {
        // tampilkan error jika gagal
        die(print_r(sqlsrv_errors(), true));
    }
}

if ($_POST['simpan_lokasi'] == "Save changes") {
    $zone2   = strtoupper($_POST['zone2']);
    $lokasi2 = strtoupper($_POST['lokasi1']);

    // Gunakan sintaks SQL Server dan parameter binding
    $sql = "INSERT INTO dbnow_gkg.dbnow_gkg.tbl_lokasi (nama, zone) VALUES (?, ?)";
    $params = array($lokasi2, $zone2);

    $sqlData1 = sqlsrv_query($con, $sql, $params);

    if ($sqlData1) {
        echo "<script>window.location='CheckStock';</script>";
    } else {
        // tampilkan error detail jika gagal
        die(print_r(sqlsrv_errors(), true));
    }
}
?>
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