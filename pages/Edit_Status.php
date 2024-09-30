<?php
include("../koneksi.php");
if($_POST){ 
	extract($_POST);
	$id = mysqli_real_escape_string($con,$_POST['id']);
	$sts = mysqli_real_escape_string($con,$_POST['sts']);
	if($sts=="Closed"){
		$tglClsd=" , tgl_closed=now() ";
	}else{
		$tglClsd=" , tgl_closed=NULL ";
	}
	mysqli_query($con, "UPDATE tbl_upload SET `status`='$sts' $tglClsd WHERE id='$id'");
	echo "<script type=\"text/javascript\">
            window.location = \"DataUpload\"
      </script>";
}
?>