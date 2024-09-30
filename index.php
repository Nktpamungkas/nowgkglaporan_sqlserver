<?php
session_start();
//include config
include"koneksi.php";
ini_set("error_reporting", 1);

//request page
$page = isset($_GET['p'])?$_GET['p']:'';
$act  = isset($_GET['act'])?$_GET['act']:'';
$id   = isset($_GET['id'])?$_GET['id']:'';
$page = strtolower($page);
?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>NOWgkg | <?php if ($_GET['p']!="") {
    echo ucwords($_GET['p']);
} else {
    echo "Home";
}?></title>

  <!-- Google Font: Source Sans Pro -->
  <!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">-->
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">	
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">	
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">	
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">	  
  <!-- Theme style -->
  <style>
	  .blink_me {
  animation: blinker 1s linear infinite;
}

@keyframes blinker {
  50% {
    opacity: 0;
  }
}
	</style>
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="icon" type="image/png" href="dist/img/ITTI_Logo index.ico">	
</head>
<body class="hold-transition sidebar-collapse layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-dark navbar-blue">
    <div class="container">
      <a href="Home" class="navbar-brand">
        <img src="dist/img/ITTI_Logo 2021.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">NOW<strong>gkg Laporan</strong></span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="Home" class="nav-link">Home</a>
          </li>
		  <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Full Check</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="CheckStock" class="dropdown-item">Check Stock</a></li>
			  <li><a href="DataUpload" class="dropdown-item">Data Upload</a></li>	
			</ul>
          </li>	
		  <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Laporan Masuk</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">              
			  <li><a href="MasukKainGreigeHarian" class="dropdown-item">Masuk Kain Greige</a></li>			  	
			</ul>
          </li>
		  <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Laporan Keluar</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">              
			  <li><a href="KeluarKainGreigeHarian" class="dropdown-item">Keluar Kain Greige Bagi Kain</a></li>
			</ul>
          </li>
		  <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Stock Opname</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="TutupHarian" class="dropdown-item">Tutup Transaksi Harian</a></li>
			  <li><a href="TutupInOutHarian" class="dropdown-item">Tutup Transaksi In-Out Harian</a></li>
			  <li><a href="TutupHarian11" class="dropdown-item">Tutup Transaksi Harian (Jam 11)</a></li>
			  <li><a href="TutupInOutHarian11" class="dropdown-item">Tutup Transaksi In-Out Harian (Jam 11)</a></li>	
			</ul>
          </li>	
		  <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Laporan Stok</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">              
			  <li><a href="LapStokHarian" class="dropdown-item">Lap Stok Harian</a></li>
			  <li><a href="LapStokHarian11" class="dropdown-item">Lap Stok Harian (Jam 11)</a></li>	
			  <li><a href="LapStokBulanan" class="dropdown-item">Lap Stok Bulanan</a></li>	
			  <li><a href="LapTotalMasukKeluar" class="dropdown-item">Lap Total Masuk dan Keluar</a></li>
			  <li><a href="LapBulananBagiKain" class="dropdown-item">Lap Bulanan Pembagian Kain</a></li>
			  <li><a href="LapSisaKainGreige" class="dropdown-item">Lap Sisa Kain Greige (Stok Mati)</a></li>
			  <li><a href="LapMasukPerKNT" class="dropdown-item">Lap Masuk Per KNT</a></li>
			  <li><a href="LapStokLegacy" class="dropdown-item">Lap Stok Legacy</a></li>	
			</ul>
          </li>	
        </ul>
      
      </div>
      
    </div>
  </nav>
  <!-- /.navbar -->
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
	<section class="content">  
    <div class="content">
     <?php
          if (!empty($page) and !empty($act)) {
              $files = 'pages/'.$page.'.'.$act.'.php';
          } elseif (!empty($page)) {
              $files = 'pages/'.$page.'.php';
          } else {
              $files = 'pages/home.php';
          }

          if (file_exists($files)) {
              include($files);
          } else {
              include_once("blank.php");
          }
          ?>
		
    </div>
	</section>	
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Indo Taichen Textile Industy
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; <?php echo date("Y");?> <a href="">DIT</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- bs-custom-file-input -->
<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>	
<!-- InputMask -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- DataTables  & Plugins -->
  <script src="plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="plugins/jszip/jszip.min.js"></script>
  <script src="plugins/pdfmake/pdfmake.min.js"></script>
  <script src="plugins/pdfmake/vfs_fonts.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>	
<!-- Bootstrap Switch -->
<script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- BS-Stepper -->
<script src="plugins/bs-stepper/js/bs-stepper.min.js"></script>
<!-- dropzonejs -->
<script src="plugins/dropzone/min/dropzone.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["excel", "pdf"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');	 
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
	$("#example3").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false, "searching": true,
      "buttons": ["excel", "pdf"]
    }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');  
	$("#example4").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false, "searching": false,
      "buttons": ["excel", "pdf"]
    }).buttons().container().appendTo('#example4_wrapper .col-md-6:eq(0)');
	$("#example5").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false, "searching": false,
      "buttons": ["excel", "pdf"]
    }).buttons().container().appendTo('#example5_wrapper .col-md-6:eq(0)'); 
	$("#example6").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false, "searching": true,
      "buttons": ["excel", "pdf"]
    }).buttons().container().appendTo('#example6_wrapper .col-md-6:eq(0)'); 
	$("#example7").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false, "searching": true,
      "buttons": ["excel", "pdf"]
    }).buttons().container().appendTo('#example7_wrapper .col-md-6:eq(0)'); 
	$("#example8").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false, "searching": false,
      "buttons": ["excel", "pdf"]
    }).buttons().container().appendTo('#example8_wrapper .col-md-6:eq(0)'); 
	$("#example9").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false, "searching": false,
      "buttons": ["excel", "pdf"]
    }).buttons().container().appendTo('#example9_wrapper .col-md-6:eq(0)');
	$("#example10").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false, "searching": false,
      "buttons": ["excel", "pdf"]
    }).buttons().container().appendTo('#example10_wrapper .col-md-6:eq(0)');
	$("#example11").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false, "searching": false,
      "buttons": ["excel", "pdf"]
    }).buttons().container().appendTo('#example11_wrapper .col-md-6:eq(0)');  
	$("#example13").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false, "pageLength": 20,
      "buttons": ["copy", "csv", "excel", "pdf"]
    }).buttons().container().appendTo('#example12_wrapper .col-md-6:eq(0)'); 
	$('#example14').DataTable({
	  "paging": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "responsive": true,
	  "scrollX": true,
      "scrollY": '150px',
	  "buttons": ["copy", "excel", "pdf", "print", "colvis"]	
    }).buttons().container().appendTo('#example14_wrapper .col-md-6:eq(0)');
	$('#example15').DataTable({
	  "paging": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "responsive": true,
	  "scrollX": true,
      "scrollY": '150px',
	  "buttons": ["copy", "excel", "pdf", "print", "colvis"]	
    }).buttons().container().appendTo('#example15_wrapper .col-md-6:eq(0)'); 
	$('#example16').DataTable({
	  "paging": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "responsive": true,
	  "scrollX": true,
      "scrollY": '450px',
	  "buttons": ["copy", "excel", "pdf", "print", "colvis"]	
    }).buttons().container().appendTo('#example16_wrapper .col-md-6:eq(0)');
	$('#example17').DataTable({
	  "paging": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "responsive": true,
	  "scrollX": true,
      "scrollY": '150px',
	  "buttons": ["copy", "excel", "pdf", "print", "colvis"]	
    }).buttons().container().appendTo('#example17_wrapper .col-md-6:eq(0)');
	$('#example18').DataTable({
	  "paging": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "responsive": true,
	  "scrollX": true,
      "scrollY": '150px',
	  "buttons": ["copy", "excel", "pdf", "print", "colvis"]	
    }).buttons().container().appendTo('#example18_wrapper .col-md-6:eq(0)');  
  });
</script>
<script>
	$(function () {
		
	//Initialize Select2 Elements
    $('.select2').select2()	
	//Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })	
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
	//Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });
});		
</script>	
<script>	
$(document).on('click', '.show_editstatus', function(e) {
    var m = $(this).attr("id");
    $.ajax({
      url: "pages/show_editstatus.php",
      type: "GET",
      data: {
        id: m,
      },
      success: function(ajaxData) {
        $("#EditStatusUpload").html(ajaxData);
        $("#EditStatusUpload").modal('show', {
          backdrop: 'true'
        });
      }
    });
  });	

$(document).on('click', '.show_detail', function(e) {
    var m = $(this).attr("id");
    $.ajax({
      url: "pages/show_detail.php",
      type: "GET",
      data: {
        id: m,
      },
      success: function(ajaxData) {
        $("#DetailShow").html(ajaxData);
        $("#DetailShow").modal('show', {
          backdrop: 'true'
        });
      }
    });
  });
  $(document).on('click', '.show_pergerakan_detail', function(e) {
    var m = $(this).attr("id");
    $.ajax({
      url: "pages/show_pergerakan_detail.php",
      type: "GET",
      data: {
        id: m,
      },
      success: function(ajaxData) {
        $("#DetailPergerakanShow").html(ajaxData);
        $("#DetailPergerakanShow").modal('show', {
          backdrop: 'true'
        });
      }
    });
  });	
</script>	
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>	
</body>
</html>
