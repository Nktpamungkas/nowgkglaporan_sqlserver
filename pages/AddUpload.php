<?php
sqlsrv_query($con, "INSERT INTO dbnow_gkg.tbl_upload ([status]) 
				VALUES ('Open')");

echo "<script type=\"text/javascript\">
            alert(\"Data Berhasil Ditambah\");
            window.location = \"DataUpload\"
            </script>";
?>