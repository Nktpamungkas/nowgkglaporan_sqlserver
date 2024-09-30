<?php
mysqli_query($con, "INSERT INTO tbl_upload (`status`) 
				VALUES ('Open')");
echo "<script type=\"text/javascript\">
            alert(\"Data Berhasil Ditambah\");
            window.location = \"DataUpload\"
            </script>";
?>