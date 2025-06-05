<?php
error_reporting(0);
require("koneksi.php");
session_start();

if ($_SESSION['level'] != 'admin') {
  die('<script>alert("Anda Bukan Admin");window.location = "logout.php";</script>');
}

if(!isset($_SESSION['username'])) {
   header('location:login.php');
} else {
   $username = $_SESSION['username'];
}
 ?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Config | TOKEN</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <script src="assets/js/sweetalert.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<?php
if (isset($_SESSION['succes_update']) == true) {
  echo "
  <script>
    swal('Success!', 'Anda Berhasil Update Data', 'success')
  </script>
  ";
  unset($_SESSION['succes_update']);
}
?>
<?php
  $result = $koneksi->query("SELECT * FROM config ");
  $pengaturan = $result->fetch_array();
?>
<div class="wrapper">
  <?php include 'side/nav_top.php'; ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
    <?php include 'side/side.php'; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Config edit</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">config-edit</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <!-- Main content -->
    <section class="content ">
      <div class="container">
        <div class="card">
          <div class="card-body ">
              <form action="?config=update-config" enctype="multipart/form-data" method="post">
                <div class="col-md-12">
                  <div class="form-group">
                    <div>
                  </div>
                </div>
                <span style='color:red;'>*</span> <label for=""> gambar harus 96x96</label>

                  <div class="row d-flex justify-content-center">
                      <!-- <label class="control-label">JUDUL</label> -->
                      <img src="dist/img/<?= $pengaturan['image']?>" style='width:10%'>
                  </div>
                  <br>
                  <div align='center'>
                    <input type="file" name="gambar" >
                  </div>
                <br>
                <div class="row d-flex justify-content-center">
                  <div class="col-md-4">
                    <div class="form-group has-danger">
                      <label>Judul</label>
                      <input type="text" class="form-control" name="judul" value='<?= $pengaturan['judul']?>' required>
                    </div>
                    
                  <!-- <input type="hidden" name="id" value=<?php echo $_GET['id']; ?>> -->
                  <input type="submit" class="btn btn-primary" name="UpdateConfig" value="Update">
                </div>
              </div>
            </form>

              </div>
            </div>
          </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!-- Footer -->
<?php include 'side/footer.php';?>
<!-- End Footer -->

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/demo.js"></script>
<script>
    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
      return true;
    }
  </script>
<script type="text/javascript">
$(document).ready(function () {
  bsCustomFileInput.init();
});
</script>
</body>
</html>
