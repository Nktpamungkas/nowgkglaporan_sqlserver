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
	$sql = mysqli_query($con," SELECT tgl_tutup,sum(rol) as rol,sum(weight) as kg FROM tblopname 
	WHERE DATE_FORMAT(tgl_tutup,'%Y-%m')='$BlnLL' GROUP BY tgl_tutup ORDER BY tgl_tutup DESC LIMIT 1");		  
    $r = mysqli_fetch_array($sql);
	$sqlM = mysqli_query($con," SELECT tgl_tutup,sum(qty) as rol,sum(berat) as kg FROM tblmasukkain 
	WHERE DATE_FORMAT(tgl_tutup,'%Y-%m')='$Bulan' GROUP BY DATE_FORMAT(tgl_tutup,'%Y-%m')");		  
    $rM = mysqli_fetch_array($sqlM);
	$sqlK = mysqli_query($con," SELECT tgl_tutup,sum(qty) as rol,sum(berat) as kg FROM tblkeluarkain 
	WHERE DATE_FORMAT(tgl_tutup,'%Y-%m')='$Bulan' GROUP BY DATE_FORMAT(tgl_tutup,'%Y-%m')");		  
    $rK = mysqli_fetch_array($sqlK);	
	$sqlT = mysqli_query($con," SELECT tgl_tutup,sum(rol) as rol,sum(weight) as kg 
	FROM tblopname WHERE DATE_FORMAT(tgl_tutup,'%Y-%m')='$Bulan'
	GROUP BY tgl_tutup ORDER BY tgl_tutup DESC LIMIT 1");		  
    $rT = mysqli_fetch_array($sqlT);		  
	?>			<table id="example16" width="100%" class="table table-sm table-bordered table-striped" style="font-size: 11px; text-align: center;">
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
	  <tr>
	    <td>1</td>
	  <td><strong>Stok Bulan <?php if($Bln2!="01"){echo namabln($BlnLalu)." ".$Thn2;}else{echo namabln($BlnLalu)." ".$Thn;} ?></strong></td>
	  <td align="right"><?php echo number_format(round($r['kg'],2),2); ?></td>
      <td>&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td align="right"><?php echo number_format(round($r['kg'],2),2); ?></td>
      </tr>	  
	 <tr>
	   <td>2</td>
	   <td><strong>Masuk Kain</strong></td>
	    <td align="right"><?php echo number_format(round($rM['kg'],2),2); ?></td>
	    <td>&nbsp;</td>
	    <td align="right">&nbsp;</td>
	    <td align="right"><?php echo number_format(round($rM['kg'],2),2); ?></td>
	    </tr>
	 <tr>
	   <td>3</td>
	   <td><strong>Keluar Kain</strong></td>
	   <td align="right"><?php echo number_format(round($rK['kg'],2),2); ?></td>
	   <td>&nbsp;</td>
	   <td align="right">&nbsp;</td>
	   <td align="right"><?php echo number_format(round($rK['kg'],2),2); ?></td>
	   </tr>
	 <tr>
	   <td>4</td>
	   <td><strong>Stok</strong></td>
	   <td align="right"><?php echo number_format(round($r['kg'],2)+(round($rM['kg'],2)-round($rK['kg'],2)),2); ?></td>
	   <td>&nbsp;</td>
	   <td align="right">&nbsp;</td>
	   <td align="right"><?php echo number_format(round($r['kg'],2)+(round($rM['kg'],2)-round($rK['kg'],2)),2); ?></td>
	   </tr>
	 <tr>
	   <td>5</td>
	   <td><strong>Stok Opname <?php echo namabln($Bln2)." ".$Thn2; ?></strong></td>
	   <td align="right"><?php echo number_format(round($rT['kg'],2),2); ?></td>
	   <td>&nbsp;</td>
	   <td align="right">&nbsp;</td>
	   <td align="right"><?php echo number_format(round($rT['kg'],2),2); ?></td>
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