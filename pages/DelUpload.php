<?php
$idUp = $_GET['id'];
mysqli_query($con, "DELETE FROM tbl_stokfull WHERE id_upload='$idUp'");
mysqli_query($con, "DELETE FROM tbl_upload WHERE id='$idUp'");

echo "<script type=\"text/javascript\">
            window.location = \"DataUpload\"
      </script>";
?>