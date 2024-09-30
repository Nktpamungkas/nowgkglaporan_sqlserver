<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
    $modal_id=$_GET['id'];
	
	
?>
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
			<form class="form-horizontal" name="modal_popup" data-toggle="validator" method="post" action="UbahStatus" enctype="multipart/form-data">  
            <div class="modal-header">
              <h5 class="modal-title">Update Status</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
			<input type="hidden" id="id" name="id" value="<?php echo $modal_id;?>">	
			<div class="form-group row">
               <label for="sts" class="col-md-1">Status</label>               
                 <select class="form-control select2bs4" style="width: 100%;" name="sts">
				   <option value="">Pilih</option>	 
					<?php 
					  $sqlZ=mysqli_query($con," SELECT * FROM tbl_upload WHERE id='$modal_id'"); 
					  $rZ=mysqli_fetch_array($sqlZ);
					 ?>
                    <option value="Open" <?php if($rZ['status']=="Open"){ echo "SELECTED"; }?>>Open</option>
					<option value="Closed" <?php if($rZ['status']=="Closed"){ echo "SELECTED"; }?>>Closed</option>  
                  </select>			   
            </div>   	
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary btn-sm">Save changes</button>			  	
            </div>
			</form>	
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
               
<script>
  $(function () {	 
	$('.select2sts').select2({
    placeholder: "Select a status",
    allowClear: true
});   
  });
</script>
