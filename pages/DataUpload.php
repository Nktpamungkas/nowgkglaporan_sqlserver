<?php
$Buyer1		= isset($_POST['buyer']) ? $_POST['buyer'] : '';
$Project	= isset($_POST['project']) ? $_POST['project'] : '';
$POno		= isset($_POST['pono']) ? $_POST['pono'] : '';
$Item		= isset($_POST['itemno']) ? $_POST['itemno'] : '';
$NoWarna	= isset($_POST['warnano']) ? $_POST['warnano'] : '';
$Zone		= isset($_POST['zone']) ? $_POST['zone'] : '';
?>
<!-- Main content -->
      <div class="container-fluid">
		  
	    <div class="card card-pink">
              <div class="card-header">
                <h3 class="card-title">Detail Data Upload</h3>
				<a href="AddUpload" class="btn btn-success float-right"><i class="fa far-plus"> </i>Add Upload</a>  
          </div>
              <!-- /.card-header -->
              <div class="card-body">
          <table id="example4" class="table table-sm table-bordered table-striped" style="font-size:13px;">
                  <thead>
                  <tr>
                    <th style="text-align: center">No</th>
                    <th style="text-align: center">Tgl Upload</th>
                    <th style="text-align: center">Nama File</th>
                    <th style="text-align: center">Lokasi</th>
					<th style="text-align: center">Project</th>  
                    <th style="text-align: center">Data</th>
                    <th style="text-align: center">Belum Cek</th>
                    <th style="text-align: center">Sudah Cek</th>
                    <th style="text-align: center">Tgl Close</th>
                    <th style="text-align: center">Status</th>
                    <th style="text-align: center">Upload</th>
                    <th style="text-align: center">Hapus</th>
                    </tr>
                  
                  </thead>
                  <tbody>
				  <?php
					$no=1; 
					$sql=mysqli_query($con,"SELECT * FROM tbl_upload ORDER BY id DESC");					  
	  				while($rowd=mysqli_fetch_array($sql)){
						$sql1=mysqli_query($con,"SELECT COUNT(*) AS JML, sum(if(`status`='belum cek',1,0)) as bcek,sum(if(`status`='ok',1,0)) as scek, group_concat(distinct  lokasi SEPARATOR ', ') as lokasi, group_concat(distinct  project SEPARATOR ', ') as project FROM tbl_stokfull WHERE id_upload='$rowd[id]'");					  
	  					$rowd1=mysqli_fetch_array($sql1);
						if($rowd['status']=="Open" and $rowd1['scek']==0){
							$stts="<small class='badge badge-success '><i class='far fa-clock'></i> Open</small>";
						}else if($rowd['status']=="Open" and $rowd1['scek']>0 and $rowd1['JML']>$rowd1['scek']){
							$stts="<small class='badge badge-warning'><i class='far fa-clock'></i> Open, In Progress</small>";
						}else{
							$stts="<a href='#' id='".$rowd['id']."' class='show_editstatus'><small class='badge badge-danger'><i class='far fa-clock'></i> Closed</small></a>";
						}
		  		  ?>
				  	<tr>
                    <td style="text-align: center"><?php echo $no;?></td>
                    <td style="text-align: center"><?php echo $rowd['tgl_upload'];?></td>
                    <td style="text-align: center"><?php echo $rowd['nama_file'];?></td>
                    <td style="text-align: left"><?php echo $rowd1['lokasi'];?></td>
					<td style="text-align: left"><?php echo $rowd1['project'];?></td>	
                    <td style="text-align: center"><?php echo $rowd1['JML'];?></td>
                    <td style="text-align: center"><?php echo $rowd1['bcek'];?></td>
                    <td style="text-align: center"><?php echo $rowd1['scek'];?></td>
                    <td style="text-align: center"><?php echo $rowd['tgl_closed'];?></td>
                    <td style="text-align: center"><?php echo $stts;?></td>
                    <td style="text-align: center"><a href="UploadData-<?php echo $rowd['id'];?>" class="btn btn-xs btn-warning <?php if($rowd1['JML']>0){ echo "disabled";}?> " ><small class="fas fa-plus"> </small></a></td>
                    <td style="text-align: center"><a href="#" class="btn btn-xs btn-danger <?php if($rowd1['JML']==0){ echo "disabled";}?>" onclick="confirm_delete('DelUpload-<?php echo $rowd['id'] ?>');" ><small class="fas fa-trash"> </small></a></td>
                  </tr>	 
				<?php
						$no++;
					} 
				?>
				  </tbody>
                <tfoot>
                  </tfoot>  
                </table>
            </div>
              <!-- /.card-body -->
        </div>        
</div><!-- /.container-fluid -->
    <!-- /.content -->

<div id="EditStatusUpload" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>

<div class="modal fade" id="delBuyer" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content" style="margin-top:100px;">
                  <div class="modal-header">
					<h4 class="modal-title">INFOMATION</h4>  
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    
                  </div>
					<div class="modal-body">
						<h5 class="modal-title" style="text-align:center;">Are you sure to delete this information ?</h5>
					</div>	
                  <div class="modal-footer justify-content-between">
                    <a href="#" class="btn btn-danger" id="delete_link">Delete</a>
                    <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                  </div>
                </div>
              </div>
            </div>

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
<script type="text/javascript">
              function confirm_delete(delete_url) {
                $('#delBuyer').modal('show', {
                  backdrop: 'static'
                });
                document.getElementById('delete_link').setAttribute('href', delete_url);
              }
</script>