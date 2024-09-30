<?php
$Awal	= isset($_POST['tgl_awal']) ? $_POST['tgl_awal'] : '';
$Akhir	= isset($_POST['tgl_akhir']) ? $_POST['tgl_akhir'] : '';
?>
<!-- Main content -->
      <div class="container-fluid">  		
		<div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Detail Laporan  Masuk Kain Greige Tgl <?php echo $_GET['tgl']; ?></h3>
				<!--<a href="pages/cetak/lapgmasuk_excel.php?awal=<?php echo $Awal;?>&akhir=<?php echo $Akhir;?>" class="btn bg-blue float-right" target="_blank">Cetak Excel</a>-->  
          </div>
              <!-- /.card-header -->
              <div class="card-body">				  
                <table id="example16" width="100%" class="table table-sm table-bordered table-striped" style="font-size: 11px; text-align: center;">
                  <thead>
                  <tr>
                    <th rowspan="2" valign="middle" style="text-align: center">No</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Tgl Masuk</th>
                    <th rowspan="2" valign="middle" style="text-align: center">No BON</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Buyer</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Customer</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Prod. Order</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Code</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Project</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Mesin Rajut</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Lot Benang</th>
                    <th colspan="2" valign="middle" style="text-align: center">Greige</th>
                    <th colspan="2" valign="middle" style="text-align: center">Kain Jadi</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Jenis Kain</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Lot</th>
                    <th colspan="4" valign="middle" style="text-align: center">Jenis Benang</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Qty</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Berat/Kg</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Block</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Balance</th>
                    <th rowspan="2" valign="middle" style="text-align: center">User</th>
                    </tr>
                  <tr>
                    <th valign="middle" style="text-align: center">Lebar</th>
                    <th valign="middle" style="text-align: center">Gramasi</th>
                    <th valign="middle" style="text-align: center">Lebar</th>
                    <th valign="middle" style="text-align: center">Gramasi</th>
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
$sql = mysqli_query($con," SELECT * FROM tblmasukkain_11 WHERE tgl_tutup='$_GET[tgl]' ORDER BY id ASC");		  
    while($r = mysqli_fetch_array($sql)){										   
			
?>
	  <tr>
	  <td style="text-align: center"><?php echo $no;?></td>
	  <td style="text-align: center"><?php echo $r['tgl_masuk']; ?></td>
      <td style="text-align: center"><?php echo $r['no_bon']; ?></td>
      <td style="text-align: left"><?php echo $r['buyer']; ?></td>
      <td style="text-align: left"><?php echo $r['customer']; ?></td>
      <td style="text-align: center"><?php echo $r['prod_order']; ?></td>
      <td><?php echo $r['code']; ?></td> 
      <td style="text-align: left"><?php echo $r['projectcode']; ?></td>
      <td style="text-align: left"><?php echo $r['mesin_rajut']; ?></td>
      <td style="text-align: center"><?php echo $r['lot_benang']; ?></td>
      <td style="text-align: left"><?php echo $r['lebar_g']; ?></td>
      <td style="text-align: left"><?php echo $r['gramasi_g']; ?></td>
      <td style="text-align: left"><?php echo $r['lebar_kj']; ?></td>
      <td style="text-align: left"><?php echo $r['gramasi_kj']; ?></td>
      <td style="text-align: left"><?php echo $r['jenis_kain']; ?></td>
      <td style="text-align: center"><?php echo $r['lot']; ?></td>
      <td style="text-align: left"><?php echo $r['benang1']; ?></td>
      <td style="text-align: left"><?php echo $r['benang2']; ?></td>
      <td style="text-align: left"><?php echo $r['benang3']; ?></td>
      <td style="text-align: left"><?php echo $r['benang4']; ?></td>
      <td style="text-align: right"><?php echo $r['qty']; ?></td>
      <td style="text-align: right"><?php echo $r['berat']; ?></td>
      <td><?php echo $r['blok']; ?></td>
      <td><?php echo $r['balance']; ?></td>
      <td><?php echo $r['userid']; ?></td>
      </tr>
	  				  
	<?php 
	 $no++; 
	$tMRol+=$r['qty'];
	$tMKG +=$r['berat'];
	} ?>
				  </tbody>
                  <tfoot>
	 <tr>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td>&nbsp;</td>
	    <td style="text-align: left">&nbsp;</td>
	    <td style="text-align: left">&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: left">&nbsp;</td>
	    <td style="text-align: left">&nbsp;</td>
	    <td style="text-align: left">&nbsp;</td>
	    <td style="text-align: left">&nbsp;</td>
	    <td style="text-align: left">&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: left">&nbsp;</td>
	    <td colspan="3" style="text-align: right"><strong>Total</strong></td>
	    <td style="text-align: right"><strong><?php echo $tMRol;?></strong></td>
	    <td style="text-align: right"><strong><?php echo number_format(round($tMKG,2),2);?></strong></td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
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



