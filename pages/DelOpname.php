<?php
$tgl = $_GET['tgl'];
mysqli_query($con, "DELETE FROM tblopname WHERE tgl_tutup='$tgl'");

echo "<script type=\"text/javascript\">
            window.location = \"TutupHarian\"
      </script>";
?>