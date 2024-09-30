<?php
$tgl = $_GET['tgl'];
mysqli_query($con, "DELETE FROM tblkeluarkain WHERE tgl_tutup='$tgl'");

echo "<script type=\"text/javascript\">
            window.location = \"TutupInOutHarian\"
      </script>";
?>