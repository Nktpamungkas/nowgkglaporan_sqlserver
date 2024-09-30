<?php
$Thn2			= isset($_POST['thn']) ? $_POST['thn'] : '';
$Bln2			= isset($_POST['bln']) ? $_POST['bln'] : '';
$Dept			= isset($_POST['dept']) ? $_POST['dept'] : '';
$Bulan			= $Thn2."-".$Bln2;
if($Thn2!="" and $Bln2!=""){
$d				= cal_days_in_month(CAL_GREGORIAN,$Bln2,$Thn2);
$Lalu 		= $Bln2-1;	
	if($Lalu=="0"){
	if(strlen($Lalu)==1){$bl0="0".$Lalu;}else{$bl0=$Lalu;}	
	$BlnLalu="12";	
	$Thn=$Thn2-1;
	$TBln=$Thn."-".$BlnLalu;	
	}else{
	if(strlen($Lalu)==1){$bl0="0".$Lalu;}else{$bl0=$Lalu;}	
	$BlnLalu=$bl0;
	$TBln=$Thn2."-".$BlnLalu;	
	}	
	
}
?>
<!-- Main content -->
      <div class="container-fluid">
		<form role="form" method="post" enctype="multipart/form-data" name="form1">  
		<div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Filter Data Gudang Greige</h3>

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
                <h3 class="card-title">Detail Laporan Harian Masuk Kain Greige Jam 23:00</h3>
				<!--<a href="pages/cetak/lapgmasuk_excel1.php?awal=<?php echo $Awal;?>&akhir=<?php echo $Akhir;?>" class="btn bg-blue float-right" target="_blank">Cetak Excel</a>-->  
          </div>
              <!-- /.card-header -->
              <div class="card-body">
			<?php	  
	$sql = mysqli_query($con," SELECT tgl_tutup,sum(rol) as rol,sum(weight) as kg FROM tblopname_11 
	WHERE DATE_FORMAT(tgl_tutup,'%Y-%m')='$TBln' GROUP BY tgl_tutup ORDER BY tgl_tutup DESC LIMIT 1 ");		  
    $r = mysqli_fetch_array($sql);
	?>			<strong>Sisa Stok Bulan Lalu Kain I : <?php echo number_format(round($r['kg'],3),3); ?> Kain II : 00.00 Total: <?php $total=$r['kg']+00.00; echo number_format(round($total,3),3);?></strong><br>
                <table id="example16" width="100%" class="table table-sm table-bordered table-striped" style="font-size: 11px; text-align: center;">
                  <thead>
                  <tr>
                    <th colspan="3" valign="middle" style="text-align: center">Masuk</th>
                    <th colspan="2" valign="middle" style="text-align: center">Keluar</th>
                    <th width="10%" rowspan="2" valign="middle" style="text-align: center">Retur Produksi</th>
                    <th width="8%" rowspan="2" valign="middle" style="text-align: center">Permintaan Potong, Tarikan Kain dan Hapus Stok</th>
                    <th width="8%" rowspan="2" valign="middle" style="text-align: center">Sisa</th>
                    <th width="8%" rowspan="2" valign="middle" style="text-align: center">Status</th>
                    <th width="8%" rowspan="2" valign="middle" style="text-align: center">Selisih</th>
                    </tr>
                  <tr>
                    <th width="6%" valign="middle" style="text-align: center">Tgl</th>
                    <th width="13%" valign="middle" style="text-align: center">Kain Masuk I</th>
                    <th width="13%" valign="middle" style="text-align: center">Kain Masuk II</th>
                    <th width="16%" valign="middle" style="text-align: center">Kain Bagi I</th>
                    <th width="13%" valign="middle" style="text-align: center">Kain Bagi II</th>
                    </tr>
                  </thead>
                  <tbody>
<?php for ($i = 1; $i <= $d; $i++){ 
	$sqlMasuk = mysqli_query($con," SELECT tgl_tutup,sum(qty) as rol,sum(berat) as kg FROM tblmasukkain_11 
	WHERE tgl_tutup='$Thn2-$Bln2-$i' and NOT ISNULL(no_bon) GROUP BY tgl_tutup ");	
	$rMasuk = mysqli_fetch_array($sqlMasuk);
	$sqlRMasuk = mysqli_query($con," SELECT tgl_tutup,sum(qty) as rol,sum(berat) as kg FROM tblmasukkain_11 
	WHERE tgl_tutup='$Thn2-$Bln2-$i' and ISNULL(no_bon) and NOT mesin_rajut ='maklun' GROUP BY tgl_tutup ");	
	$rRMasuk = mysqli_fetch_array($sqlRMasuk);
	$sqlMMasuk = mysqli_query($con," SELECT tgl_tutup,sum(qty) as rol,sum(berat) as kg FROM tblmasukkain_11 
	WHERE tgl_tutup='$Thn2-$Bln2-$i' and ISNULL(no_bon) and mesin_rajut ='maklun' GROUP BY tgl_tutup ");	
	$rMMasuk = mysqli_fetch_array($sqlMMasuk);
	$sqlKeluar = mysqli_query($con," SELECT tgl_tutup,sum(qty) as rol,sum(berat) as kg FROM tblkeluarkain_11 
	WHERE tgl_tutup='$Thn2-$Bln2-$i' AND NOT ISNULL(demand) GROUP BY tgl_tutup");		  
    $rKeluar = mysqli_fetch_array($sqlKeluar);
	$sqlPotong = mysqli_query($con," SELECT tgl_tutup,sum(qty) as rol,sum(berat) as kg FROM tblkeluarkain_11 
	WHERE tgl_tutup='$Thn2-$Bln2-$i' AND ISNULL(demand) GROUP BY tgl_tutup");		  
    $rPotong = mysqli_fetch_array($sqlPotong);
	if($i=="1"){
	$sisa+=$total+((round($rMasuk['kg'],3)+round($rRMasuk['kg'],3))-(round($rKeluar['kg'],3)+round($rPotong['kg'],3)));	
	}else{
	$sisa+=((round($rMasuk['kg'],3)+round($rMMasuk['kg'],3)+round($rRMasuk['kg'],3))-(round($rKeluar['kg'],3)+round($rPotong['kg'],3)));
	}
	$sqlOP = mysqli_query($con," SELECT tgl_tutup,sum(rol) as rol,sum(weight) as kg,DATE_FORMAT(now(),'%Y-%m-%d') as tgl 
FROM tblopname_11 WHERE tgl_tutup='$Thn2-$Bln2-$i' GROUP BY tgl_tutup");		  
    $rOP = mysqli_fetch_array($sqlOP);
	
	if(round($sisa)==round($sisa-$rOP['kg'])){
		$sts="<small class='badge badge-info'> OK</small>";
	}else if(round($sisa-$rOP['kg'])==0){
		$sts="<small class='badge badge-success'> OK</small>";
	}else{
		$sts="<small class='badge badge-warning'><i class='fas fa-exclamation-triangle text-white blink_me'></i> Tidak OK</small>";
	}
	
					  ?>
	  <tr>
	  <td><?php echo $i; ?></td>
	  <td align="right"><?php echo number_format(round($rMasuk['kg'],2),2); ?></td>
      <td align="right"><?php echo number_format(round($rMMasuk['kg'],2),2); ?></td>
      <td align="right"><?php echo number_format(round($rKeluar['kg'],2),2); ?></td>
      <td>&nbsp;</td>
      <td align="right"><?php echo number_format(round($rRMasuk['kg'],2),2); ?></td>
      <td align="right"><?php echo number_format(round($rPotong['kg'],2),2); ?></td>
      <td align="right"><strong><?php echo number_format(round($sisa,3),3); ?></strong></td>
      <td align="right"><strong><?php echo $sts; ?></strong></td>
      <td align="right"><strong><?php echo number_format(round($sisa,3)-round($rOP['kg'],3),3); ?></strong></td>
      </tr>
	  				  
	<?php 
	 $no++; 
	$tM+=round($rMasuk['kg'],3);
	$tN+=round($rMMasuk['kg'],3);
	$tK+=round($rKeluar['kg'],3);
	$tR+=round($rRMasuk['kg'],3);
	$tP+=round($rPotong['kg'],3);
	} 
	$tS=($total+$tM+$tR+$tN)-($tK+$tP+$tH);
					  ?>
				  </tbody>
                  <tfoot>
	 <tr>
	   <td><strong>Total</strong></td>
	    <td align="right"><strong><?php echo number_format(round($tM,2),2); ?></strong></td>
	    <td align="right"><strong><?php echo number_format(round($tN,2),2); ?></strong></td>
	    <td align="right"><strong><?php echo number_format(round($tK,2),2); ?></strong></td>
	    <td>&nbsp;</td>
	    <td align="right"><strong><?php echo number_format(round($tR,2),2); ?></strong></td>
	    <td align="right"><strong><?php echo number_format(round($tP,2),2); ?></strong></td>
	    <td align="right"><strong><?php echo number_format(round($tS,3),3); ?></strong></td>
	    <td align="right">&nbsp;</td>
	    <td align="right">&nbsp;</td>
	    </tr>				
					</tfoot>
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