<?php
require("koneksi.php");
error_reporting(0);
session_start();
date_default_timezone_set('Asia/Jakarta');

if(!isset($_SESSION['username'])) {
   header('location:?customer=login');
} else {
   $username = $_SESSION['username'];
}

if ($_SESSION['level'] != 'customer') {
  die('<script>alert("Anda Bukan Customer");window.location = "logout.php";</script>');
}

$config = $koneksi->query("SELECT * FROM config ORDER BY id_config desc");
          $resconfig = $config->fetch_array();

$waktu_skrng = date("H:i:s");

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
  <title>Dashboard Customer</title>
</head>
<body class="hold-transition sidebar-mini" onload="startTime();">
    <?php 
if (isset($_SESSION['succes_login']) == 1) {
      echo "
      <script>
        swal('Yeeay!', 'Anda Berhasil Login,Selamat datang Kembali   " . $_SESSION['username'] . " !!', 'success')
      </script>";
      unset($_SESSION['succes_login']);
    } 
  ?>

<div class="wrapper">
  <!-- navbar -->
  <?php include 'side/layout_customer/navbar_customer.php'; ?>
  <!-- End navbar -->

  <!-- Main Sidebar Container -->
  <?php include 'side/layout_customer/sidebar_customer.php'; ?>
  <!-- End Sidebar -->


  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div align="center">
          <br>
          <h3 align="center">hi,<?= $_SESSION['nm_lengkap'] ?></h3>
          
          <br>
     
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
<script>
var x = document.getElementById("demo");

var options = {
  timeout: 0,
  enableHighAccuracy: true,
  maximumAge: Infinity
};

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition, showError,options);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
  x.innerHTML = "Latitude: " + position.coords.latitude + 
  "<br>Longitude: " + position.coords.longitude;
  $('#demo_kordinat').val( position.coords.latitude + ',' +  position.coords.longitude)
}

function showError(error) {
  switch(error.code) {
    case error.PERMISSION_DENIED:
      x.innerHTML = "User denied the request for Geolocation."
      break;
    case error.POSITION_UNAVAILABLE:
      x.innerHTML = "Location information is unavailable."
      break;
    case error.TIMEOUT:
      x.innerHTML = "The request to get user location timed out."
      break;
    case error.UNKNOWN_ERROR:
      x.innerHTML = "An unknown error occurred."
      break;
  }
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
