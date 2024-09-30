<!-- Main content -->
      <div class="container-fluid">		
		  <div class="card card-pink">
              <div class="card-header">
                <h3 class="card-title">Stock Tanggal <?php echo $_GET['tgl']; ?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
          <table id="example1" class="table table-sm table-bordered table-striped" style="font-size:13px;">
                  <thead>
                  <tr>
                    <th rowspan="2" style="text-align: center">Langganan</th>
                    <th rowspan="2" style="text-align: center">Buyer</th>
                    <th rowspan="2" style="text-align: center">Project Akhir</th>
                    <th rowspan="2" style="text-align: center">Project Awal</th>
                    <th rowspan="2" style="text-align: center">Tipe</th>
                    <th rowspan="2" style="text-align: center">No Item</th>
                    <th colspan="4" style="text-align: center">Jenis Benang</th>
                    <th rowspan="2" style="text-align: center">Lot</th>
                    <th rowspan="2" style="text-align: center">Roll</th>
                    <th rowspan="2" style="text-align: center">Weight</th>
                    <th rowspan="2" style="text-align: center">Satuan</th>
                    <th rowspan="2" style="text-align: center">Zone</th>
                    <th rowspan="2" style="text-align: center">Lokasi</th>
                  </tr>
                  <tr>
                    <th style="text-align: center">1</th>
                    <th style="text-align: center">2</th>
                    <th style="text-align: center">3</th>
                    <th style="text-align: center">4</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php				  
   $no=1;   
   $c=0;
   $sql = mysqli_query($con," SELECT * FROM tblopname WHERE tgl_tutup='$_GET[tgl]' ORDER BY id ASC");		  
    while($r = mysqli_fetch_array($sql)){
		
?>
	  <tr>
	  <td style="text-align: left"><?php echo $r['langganan']; ?></td>
      <td style="text-align: left"><?php echo $r['buyer']; ?></td>
      <td style="text-align: center"><?php echo $r['proj_akhir']; ?></td>
      <td style="text-align: center"><?php echo $r['proj_awal']; ?></td>
      <td style="text-align: center"><?php echo $r['tipe']; ?></td>
      <td style="text-align: center"><?php echo $r['no_item']; ?></td>
      <td style="text-align: left"><?php echo $r['benang_1']; ?></td>
      <td style="text-align: left"><?php echo $r['benang_2']; ?></td>
      <td style="text-align: left"><?php echo $r['benang_3']; ?></td>
      <td style="text-align: left"><?php echo $r['benang_4']; ?></td>
      <td style="text-align: center"><?php echo $r['lot'];;?></td>
      <td style="text-align: center"><?php echo $r['rol'];;?></td>
      <td style="text-align: right"><?php echo $r['weight'];;?></td>
      <td style="text-align: center"><?php echo $r['satuan'];;?></td>
      <td style="text-align: center"><?php echo $r['zone'];;?></td>
      <td style="text-align: center"><?php echo $r['lokasi'];;?></td>
      </tr>				  
<?php	$no++;
		$totrol=$totrol+$r['rol'];
		$totkg=$totkg+$r['weight'];
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
                    <td style="text-align: right">&nbsp;</td>
                    <td style="text-align: right">&nbsp;</td>
                    <td style="text-align: right">&nbsp;</td>
                    <td style="text-align: right">&nbsp;</td>
                    <td style="text-align: right"><strong>TOTAL</strong></td>
                    <td style="text-align: right"><strong><?php echo $totrol; ?></strong></td>
                    <td style="text-align: right"><strong><?php echo number_format(round($totkg,3),3); ?></strong></td>
                    <td style="text-align: center"><strong>KGs</strong></td>
                    <td style="text-align: right">&nbsp;</td>
                    <td style="text-align: center">&nbsp;</td>
                    </tr>
                  </tfoot>                  
                </table>
              </div>
              <!-- /.card-body -->
        </div>        
</div><!-- /.container-fluid -->
    <!-- /.content -->
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