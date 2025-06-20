<?php
session_start();
if ($_SESSION['level'] != 'customer') {
  die('<script>alert("Anda Bukan Customer");window.location = "customer/logout.php";</script>');
}
 
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>LOGIN CUSTOMER </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,800">
    <script src="assets/js/sweetalert.js"></script>
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body style="background-color:#f5f8fa;">
  <?php
    if (isset($_SESSION['wrong_password']) == true){
      print "
        <script>
          swal('Oops!', 'Password salah,Silahkan Cek Kembali !', 'error')
        </script>
        ";
      unset($_SESSION['wrong_password']);
    }
  ?>
    
      <div class="container">
      <div style="margin-top: 150px">
      <center>
        <h3>Pilih Jenis Meteran Yang Ingin Diisi</h3><br>
      <div class="row">
            <div class="col">
            <a href="?part-customer=choices&choice=listrik"><img src="dist/img/choice/energy.png" alt="" style="width: 150px;"></a>
            </div>
            <div class="col" style="padding-right: -200px">
            <a href="?part-customer=choices&choice=air"><img src="dist/img/choice/water.png" alt="" style="width: 150px;"></a>
            </div>
        </div>
        <div class="row">
            <div class="col">
            <img src="dist/img/choice/solar.png" alt="" style="width: 150px;">
            </div>
            <div class="col">
            <a href="?part-customer=choices&choice=gas"><img src="dist/img/choice/gas.png" alt="" style="width: 150px;"></a>
            </div>
        </div>
      </center>
      </div>
      </div>
    <!-- JavaScript files-->
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <script>
      $.widget.bridge('uibutton', $.ui.button)
    </script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="plugins/chart.js/Chart.min.js"></script>
    <script src="plugins/sparklines/sparkline.js"></script>
    <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="plugins/summernote/summernote-bs4.min.js"></script>
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="dist/js/adminlte.js"></script>
    <script src="dist/js/pages/dashboard.js"></script>
    <script src="dist/js/demo.js"></script>
  </body>
</html>
