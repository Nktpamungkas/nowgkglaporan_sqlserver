<?php
$tgl = $_GET['tgl'];
sqlsrv_query($con, "DELETE FROM dbnow_gkg.tblmasukkain WHERE tgl_tutup='$tgl'");

echo "<script type=\"text/javascript\">
            window.location = \"TutupInOutHarian\"
      </script>";
?>