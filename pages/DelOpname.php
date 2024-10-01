<?php
$tgl = $_GET['tgl'];
sqlsrv_query($con, "DELETE FROM dbnow_gkg.tblopname WHERE tgl_tutup='$tgl'");

echo "<script type=\"text/javascript\">
            window.location = \"TutupHarian\"
      </script>";
?>