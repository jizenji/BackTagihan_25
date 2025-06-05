<?php
session_start();
include('koneksi.php');
// require('models/m_grafik_x.php');

// error_reporting(0);
if (isset($_SESSION['level']) != 'admin') {
    header('location:logout.php');
}

if(!isset($_SESSION['username'])) {
   header('location:?login');
} else {
   $username = $_SESSION['username'];
}

if ($_SESSION['level'] != 'admin') {
  die('<script>alert("Anda Bukan Admin");window.location = "logout.php";</script>');
}

?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <script src="plugins/chart.js/Chart.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="assets/js/sweetalert.js"></script>

</head>
<body class="hold-transition sidebar-mini">
  <?php
    if (isset($_SESSION['succes_login']) == 1) {
      echo "
      <script>
        swal('Yeeay!', 'Anda Berhasil Login,Selamat datang Kembali " . $_SESSION['username'] . " !!', 'success')
      </script>";
      unset($_SESSION['succes_login']);
    }
  ?>
<div class="wrapper">
  <!-- navbar -->
  <?php include 'side/nav_top.php'; ?>
  <!-- End navbar -->

  <!-- Main Sidebar Container -->

  <?php include 'side/side.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      
      <br>
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-4 col-6">

            <!-- small box -->
            <div class="small-box " style="border-radius:20px;background-color:#ffa0d2;">
              <div class="inner">
                <?php
                $sql_x = $koneksi->query("SELECT * FROM laporan_a");
                $jumlah_x = $sql_x->num_rows;
                ?>
                <h3 ><?php echo $jumlah_x ?></h3>
                <p ><b>TOTAL TRANSAKSI ADMIN</b></p>
              </div>
              <div class="icon">
                <i class="nav-icon fa fa-shopping-cart"></i>
              </div>
              <a href="./?laporan=xl" class="small-box-footer" style="border-radius:20px;"><span style='color:black;'>More info </span><i class="fas fa-arrow-circle-right" style='color:black'></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box" style="border-radius:20px;background-color:#efb1ff">
              <div class="inner">
                <?php
                $id = 0;
                // $ids = ;
                $idc = $id > 1; 
                $sql_xi = $koneksi->query("SELECT * FROM laporan_cu ");
                
                  $jumlah = $sql_xi->num_rows;
              
                ?>
                <h3><?php echo $jumlah ?></h3>
                <p><b>TOTAL TRANSAKSI CUSTOMER</b></p>
              </div>
              <div class="icon">
                <i class="nav-icon fa fa-shopping-cart"></i>
              </div>
              <a href="./?laporan=xi" class="small-box-footer" style="border-radius:20px;"><span style='color:black;'>More info </span> <i class="fas fa-arrow-circle-right" style='color:black'></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box" style="border-radius:20px;background-color:#51eaea">
              <div class="inner">
                <?php

                $sql_tot = $koneksi->query("SELECT * FROM data_customer");
                $total_seluruh = $sql_tot->num_rows;
                ?>

                <h3><?php echo $total_seluruh; ?></h3>
                <p><b>TOTAL SELURUH CUSTOMER</b></p>
              </div>
              <div class="icon">
                <i class="nav-icon fas fa-user-alt"></i>
              </div>
              <a href="./?data-customer=x" class="small-box-footer" style="border-radius:20px;"><span style='color:black;'>More info </span> <i class="fas fa-arrow-circle-right" style='color:black'></i></a>
            </div>
          </div>
        </div>
      </div>

            
  <div>
</section>

    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->

<!-- Footer -->
<?php include 'side/footer.php';?>
<!-- End Footer -->

</div>

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
