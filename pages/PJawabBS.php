<?php
$Awal	= isset($_POST['tgl_awal']) ? $_POST['tgl_awal'] : '';
$Akhir	= isset($_POST['tgl_akhir']) ? $_POST['tgl_akhir'] : '';
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
			  <button class="btn btn-primary" type="submit">Cari Data</button>
          </div>
		  <!-- /.card-body -->          
        </div>  
		</form>	
		<div class="card">
              <div class="card-header">
                <h3 class="card-title">Penanggung Jawab BS</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-sm table-bordered table-striped" style="font-size:13px;">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Counter</th>
                    <th>KG</th>
                    <th>BS Produksi</th>
                    <th>%</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php
	if( $Awal!="" and $Akhir!=""){				  
	$Tgl= " AND `tgl_inspek` BETWEEN '$Awal' AND '$Akhir' " ;
	$Tgl1= " `tgl_produksi` BETWEEN '$Awal' AND '$Akhir' " ;	
	}else{
		$Tgl= " AND `tgl_inspek` BETWEEN '2200-12-12' AND '2200-12-12' " ;
		$Tgl1= " `tgl_produksi` BETWEEN '2200-12-12' AND '2200-12-12' " ;
	}
		$sql=mysqli_query($con," SELECT a.nama,if(isnull(b.kg_bs),0,b.kg_bs) as kg_bs,if(isnull(c.counter),0,c.counter) as counter,if(isnull(c.berat),0,round(c.berat,2)) as berat FROM 
						( SELECT 
						nama,concat(shift,' ',nama) AS bs_leader 
						FROM tbl_operator2 WHERE jabatan='Leader' 
						ORDER BY shift,nama ASC) a 
					LEFT JOIN
						( SELECT bs_leader,sum(berat_awal) AS kg_bs 
						FROM tbl_inspeksi_detail_now WHERE ket_bs='BS Produksi' ".$Tgl." 
						GROUP BY bs_leader) b ON a.bs_leader=b.bs_leader
					LEFT JOIN 	
						( SELECT	
	IF(isnull(leader),'0',(
		sum(b.counter) + a.counter_akhir - a.counter_awal
	)) AS counter,	
	IF(isnull(leader),'0',(
		a.std_kg * (
			(
				sum(b.counter) + a.counter_akhir - a.counter_awal
			) / a.count_roll
		)
	)) AS berat,
	a.leader
FROM
	tbl_rajut_produksi_now a
LEFT JOIN tbl_rajut_produksi_detail_now b ON a.id = b.id_rajut
LEFT JOIN tbl_mesin_stop_now c ON a.id = c.id_rajut
WHERE ".$Tgl1." GROUP BY leader) c ON a.nama=c.leader ORDER BY a.nama ASC ");
   $no=1;   
   $c=0;
    while($rowd=mysqli_fetch_array($sql)){
		if($rowd['berat']>0){
		   $persen=round(($rowd['kg_bs']/$rowd['berat'])*100,2);
	   }else{
		   $persen=0;
	   }
	   ?>
	  <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $rowd['nama']; ?></td>
      <td><?php echo $rowd['counter']; ?></td>
      <td><?php echo $rowd['berat']; ?></td>
      <td><?php echo $rowd['kg_bs']; ?></td>
      <td><?php echo number_format($persen,2); ?></td>
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