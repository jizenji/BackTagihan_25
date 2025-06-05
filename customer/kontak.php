<?php
require("koneksi.php");
error_reporting(0);
session_start();
date_default_timezone_set('Asia/Jakarta');

if ($_SESSION['level'] != 'customer') {
  die('<script>alert("Anda Bukan Customer");window.location = "siswa/logout.php";</script>');
}

if(!isset($_SESSION['username'])) {
   header('location:?absen-siswa=login');
} else {
   $username = $_SESSION['username'];
}



$config = $koneksi->query("SELECT * FROM config ORDER BY id_config desc");
          $resconfig = $config->fetch_array();

$waktu_skrng = date("H:i:s"); //timestamp
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="assets/js/sweetalert.js"></script>
  <title>Kontak Admin</title>
</head>
<body class="hold-transition sidebar-mini" onload="startTime();">

<div class="wrapper">
  <!-- navbar -->
  <?php include 'side/layout_customer/navbar_customer.php'; ?>
  <!-- End navbar -->

  <!-- Main Sidebar Container -->
  <?php include 'side/layout_customer/sidebar_customer.php'; ?>
  <!-- End Sidebar -->
<div class="content-wrapper">

<br>
    <section class="content">
        <div class="container">
            <div class="col-12">
                <section class="content">
                    <div class="card">
                        <div class="card-body">
                            <div class="card bg-light">
                                <div class="card-header text-muted border-bottom-0">
                                Kontak Admin
                                </div>
                                <hr>
                                <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-7">
                                    <h2 class="lead"><b>Admin</b></h2><br>
                                    <p class="text-muted text-sm"><b>About: </b> Aplikasi  </p>
                                    <ul class="ml-3 mb-0 fa-ul text-muted">
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address:</li><br>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone /  Whatsapp: +639084276055 </li>
                                    </ul>
                                    </div>
                                    <div class="col-5 text-center">
                                    <img src="dist/img/avatar04.png" alt="" class="img-circle img-fluid">
                                    </div>
                                </div>
                                </div>
                                <div class="card-footer">
                                  <div class="text-right">
                                    <a href="https://api.whatsapp.com/send?phone=639084276055&text=Hallo%20Admin" class="btn btn-sm bg-teal">
                                    <i class="fas fa-comments"></i>
                                    </a>
                                      
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</div>


  <!-- Footer -->
  <?php include 'side/footer.php';?>
  <!-- End Footer -->
</div>
<script>
function startTime() {
  var today = new Date();
  var h = today.getHours();
  var m = today.getMinutes();
  var s = today.getSeconds();
  m = checkTime(m);
  s = checkTime(s);
  document.getElementById('time').innerHTML =
  h + ":" + m + ":" + s;
  var t = setTimeout(startTime, 500);
}
function checkTime(i) {
  if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
  return i;
}
</script>
<script src="plugins/geo/geoPosition.js" type="text/javascript" charset="utf-8"></script>
<script src="plugins/geo/geoPositionSimulator.js" type="text/javascript" charset="utf-8"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/demo.js"></script>
</body>
</html>
