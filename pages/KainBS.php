<?php
$Awal	= isset($_POST['tgl_awal']) ? $_POST['tgl_awal'] : '';
$Akhir	= isset($_POST['tgl_akhir']) ? $_POST['tgl_akhir'] : '';
$Shift	= isset($_POST['shift']) ? $_POST['shift'] : '';
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
               <label for="tgl_awal" class="col-md-1">Tgl Awal</label>
               <div class="col-md-2">  
                 <div class="input-group date" id="datepicker1" data-target-input="nearest">
                    <div class="input-group-prepend" data-target="#datepicker1" data-toggle="datetimepicker">
                      <span class="input-group-text btn-info">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    <input name="tgl_awal" value="<?php echo $Awal;?>" type="text" class="form-control form-control-sm" id=""  autocomplete="off" required>
                 </div>
			   </div>	
            </div>
				 <div class="form-group row">
                    <label for="tgl_akhir" class="col-md-1">Tgl Akhir</label>
					<div class="col-md-2">  
                    <div class="input-group date" id="datepicker2" data-target-input="nearest">
                    <div class="input-group-prepend" data-target="#datepicker2" data-toggle="datetimepicker">
                      <span class="input-group-text btn-info">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    <input name="tgl_akhir" value="<?php echo $Akhir;?>" type="text" class="form-control form-control-sm"  autocomplete="off" required>
                  </div>
					</div>	
                  </div>
			      <div class="form-group row">
                  <label class="col-md-1">Shift</label>
				  <div class="col-md-2">	  
                  <select class="form-control select2bs4" name="shift">
                    <option value="">ALL</option>
                    <option value="1" <?php if($Shift=="1"){echo "Selected";}?>>1</option>
                    <option value="2" <?php if($Shift=="2"){echo "Selected";}?>>2</option>
                    <option value="3" <?php if($Shift=="3"){echo "Selected";}?>>3</option>
                  </select>
				  </div>  
                </div>
			  <button class="btn btn-primary" type="submit">Cari Data</button>
          </div>
		  
		  <!-- /.card-body -->
          
        </div> 
			</form>  
		<div class="card">
              <div class="card-header">
                <h3 class="card-title">Kain BS</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-sm table-bordered table-striped" style="font-size:13px;">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>No Mc</th>
                    <th>Shift</th>
                    <th>Inspektor</th>
                    <th>PO</th>
                    <th>NoArt</th>
                    <th>KGs</th>
                    <th>Jenis Benang</th>
                    <th>Jenis BS</th>
                    <th>Nama</th>
                    <th>Leader</th>
                    <th>Tanggal</th>
                    <th>Defect</th>
                    <th>Keterangan</th>
                    <th>NoDemand</th>
                  </tr>
                  </thead>
                  <tbody>
				  <?php
	if( $Awal!="" and $Akhir!=""){				  
	$Tgl= " AND `tgl_inspek` BETWEEN '$Awal' AND '$Akhir' " ;
	}else{
		$Tgl= " AND `tgl_inspek` BETWEEN '2200-12-12' AND '2200-12-12' " ;
	}
	if($Shift!=""){
		$Shft=" AND a.shift='$Shift' ";
	}else{
		$Shft=" ";
	}
		$sql=mysqli_query($con," SELECT
IF (
       (berat_awal>berat),
       'BS',''
 ) AS gradeid,
  (berat_awal-berat)as brt,b.no_po,b.no_artikel,b.jenis_benang,no_mc,a.shift as shft,a.`user` as nama,a.grup,a.jns_bs,tgl_inspek as tgl_masuk,a.jam_ptg,a.ket,b.dept,
 a.ket_bs,a.bs_nm,a.bs_leader,a.demandno
 FROM
       tbl_inspeksi_now b
 INNER JOIN  tbl_inspeksi_detail_now a ON b.id=a.id_inspeksi
 WHERE
 IF (
       (berat_awal>berat),
       'BS',''
 )='BS' $Tgl $Shft
ORDER BY a.shift,tgl_inspek asc ");
   $no=1;   
   $c=0;
    while($rowd=mysqli_fetch_array($sql)){
	   ?>
	  <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $rowd['no_mc']; ?></td>
      <td><?php echo $rowd['shft']; ?></td>
      <td><?php echo $rowd['nama']; ?></td>
      <td><?php echo $rowd['no_po']; ?></td>
      <td><?php echo $rowd['no_artikel']; ?></td>
      <td><?php echo $rowd['brt']; ?></td>
      <td><?php echo $rowd['jenis_benang']; ?></td>
      <td><?php if($rowd['ket_bs']=="BS Mekanik"){echo "Setelan";}else if($rowd['ket_bs']=="BS Produksi"){echo "Produksi";} else if($rowd['ket_bs']=="BS Lain"){echo "Lain-Lain";} ?></td>
      <td><?php echo $rowd['bs_nm']; ?></td>
      <td><?php echo $rowd['bs_leader']; ?></td>
      <td><?php echo $rowd['tgl_masuk']; ?></td>
      <td><?php echo $rowd['jns_bs']; ?></td>
      <td><?php echo $rowd['ket']; ?></td>
      <td><?php echo $rowd['demandno']; ?></td>	  
	  </tr>				  
	<?php 
	 $no++;} ?>
				  </tbody>
                  <!--<tfoot>
                  <tr>
                    <th>No</th>
                    <th>No Mc</th>
                    <th>Sft</th>
                    <th>User</th>
                    <th>Operator</th>
					<th>Leader</th>
                    <th>NoArt</th>
                    <th>TgtCnt (100%)</th>
                    <th>Rpm</th>
                    <th>Cnt/Roll</th>
					<th>Jam Kerja</th>
				    <th>Count</th>
				    <th>Count</th>
				    <th>RL</th>
				    <th>Kgs</th>
				    <th>Grp</th>
      				<th>Tgt Grp (%)</th>
      				<th>Eff (%)</th>
      				<th>Hasil (%)</th>  
				    <th>Kd</th>
				    <th>Min</th>
				    <th>Kd</th>
				    <th>Min</th>
				    <th>Kd</th>
				    <th>Min</th> 
					<th>Tanggal</th>
      				<th>Keterangan</th>
                  </tr>
                  </tfoot>-->
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