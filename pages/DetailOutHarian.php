<?php
$Awal	= isset($_POST['tgl_awal']) ? $_POST['tgl_awal'] : '';
$Akhir	= isset($_POST['tgl_akhir']) ? $_POST['tgl_akhir'] : '';
?>
<!-- Main content -->
      <div class="container-fluid">		
		<div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Detail Laporan Harian Bagi Kain Greige Tgl <?php echo $_GET['tgl']; ?></h3>
				<!--<a href="pages/cetak/lapgkeluar_excel.php?awal=<?php echo $Awal;?>&akhir=<?php echo $Akhir;?>" class="btn bg-blue float-right" target="_blank">Cetak Excel</a>-->  
          </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-sm table-bordered table-striped" style="font-size: 13px; text-align: center;">
                  <thead>
                  <tr>
                    <th rowspan="2" valign="middle" style="text-align: center">No</th>
                    <th rowspan="2" valign="middle" style="text-align: center">TglKeluar</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Buyer</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Customer</th>
                    <th rowspan="2" valign="middle" style="text-align: center">ProjectCode</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Prod. Order</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Demand</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Item Code</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Lot</th>
                    <th colspan="4" valign="middle" style="text-align: center">Jenis Benang</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Warna</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Jenis Kain</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Qty</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Berat/Kg</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Project Awal</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Note</th>
                    <th rowspan="2" valign="middle" style="text-align: center">User</th>
                    </tr>
                  <tr>
                    <th valign="middle" style="text-align: center">1</th>
                    <th valign="middle" style="text-align: center">2</th>
                    <th valign="middle" style="text-align: center">3</th>
                    <th valign="middle" style="text-align: center">4</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php
	 
$no=1;   
$c=0;
$sql = mysqli_query($con," SELECT * FROM tblkeluarkain WHERE tgl_tutup='$_GET[tgl]' ORDER BY id ASC");		  
    while($r = mysqli_fetch_array($sql)){		
?>
	  <tr>
	  <td style="text-align: center"><?php echo $no;?></td>
	  <td style="text-align: center"><?php echo $r['tglkeluar']; ?></td>
	  <td style="text-align: left"><?php echo $r['buyer']; ?></td>
	  <td style="text-align: left"><?php echo $r['custumer']; ?></td>
	  <td style="text-align: center"><?php echo $r['projectcode']; ?></td>
	  <td style="text-align: center"><?php echo $r['prod_order']; ?></td>
	  <td><?php echo $r['demand']; ?></td>
      <td><?php echo $r['code']; ?></td> 
      <td style="text-align: center"><?php echo $r['lot']; ?></td>
      <td style="text-align: left"><?php echo $r['benang1']; ?></td>
      <td style="text-align: left"><?php echo $r['benang2']; ?></td>
      <td style="text-align: left"><?php echo $r['benang3']; ?></td>
      <td style="text-align: left"><?php echo $r['benang4']; ?></td>
      <td style="text-align: left"><?php echo $r['warna']; ?></td>
      <td style="text-align: left"><?php echo $r['jenis_kain']; ?></td>
      <td style="text-align: center"><?php echo $r['qty']; ?></td>
      <td style="text-align: right"><?php echo $r['berat']; ?></td>
      <td style="text-align: center"><?php echo $r['proj_awal']; ?></td>
      <td style="text-align: center"><?php echo $r['ket']; ?></td>
      <td style="text-align: center"><?php echo $r['userid']; ?></td>
      </tr>
	  				  
	<?php 
	 $no++; 
	$totRol=$totRol+$r['qty'];
	$totKG=$totKG+$r['berat'];	
	
	} ?>
				  </tbody>
     <tfoot>
	<tr>
	    <th style="text-align: center">&nbsp;</th>
	    <th style="text-align: center">&nbsp;</th>
	    <th style="text-align: left">&nbsp;</th>
	    <th style="text-align: left">&nbsp;</th>
	    <th style="text-align: center">&nbsp;</th>
	    <th style="text-align: center">&nbsp;</th>
	    <th>&nbsp;</th>
	    <th>&nbsp;</th>
	    <th style="text-align: center">&nbsp;</th>
	    <th style="text-align: left">&nbsp;</th>
	    <th style="text-align: left">&nbsp;</th>
	    <th style="text-align: left">&nbsp;</th>
	    <th style="text-align: left">&nbsp;</th>
	    <th style="text-align: left">&nbsp;</th>
	    <th style="text-align: left">Total</th>
	    <th style="text-align: center"><?php echo $totRol;?></th>
	    <th style="text-align: right"><?php echo number_format(round($totKG,2),2);?></th>
	    <th style="text-align: center">&nbsp;</th>
	    <th style="text-align: center">&nbsp;</th>
	    <th style="text-align: center">&nbsp;</th>
	    </tr>				
	 </tfoot>             
                </table>
              </div>
              <!-- /.card-body -->
        </div> 		
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
