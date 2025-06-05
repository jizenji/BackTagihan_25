<?php
require("koneksi.php");
error_reporting(0);
session_start();
date_default_timezone_set('Asia/Jakarta');


if(!isset($_SESSION['username'])) {
   header('location:?part-customer=login');
} else {
   $username = $_SESSION['username'];
}

if ($_SESSION['level'] != 'siswa') {
  die('<script>alert("Anda Bukan Admin");window.location = "siswa/logout.php";</script>');
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
  <title>Absen Siswa</title>
</head>
<body class="hold-transition sidebar-mini" onload="startTime();">
<?php 
    if (isset($_SESSION['succes_izin']) == 1) {
      echo "
      <script> 
        swal('Success!', 'Anda Berhasil izin', 'success')
      </script>";
      unset($_SESSION['succes_izin']);
    }
?>
<div class="wrapper">
  <!-- navbar -->
  <?php include 'side/layout_siswa/navbar_siswa.php'; ?>
  <!-- End navbar -->

  <!-- Main Sidebar Container -->
  <?php include 'side/layout_siswa/sidebar_siswa.php'; ?>
  <!-- End Sidebar -->
<div class="content-wrapper">

<br>
<br>

    <section class="content">
        <div class="container">
            <div class="col-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline card-info">
                            <div class="card-header">
                                <h2 class="card-title">
                                Payment Cancel 
                                </h2>
                            </div><br>
                            <div align="center">
                                <img src="dist/img/undraw_cancel.svg" alt="" style="width:40%"><br><br>
                                <?php
                                $trx_id = $_GET['trx_id'];
                                $status = $_GET['status'];

                                
                                
                                
                                ?>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-->
                </div>
                <!-- ./row -->
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
