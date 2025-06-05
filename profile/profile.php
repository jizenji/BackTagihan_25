<?php
require("koneksi.php");
session_start();
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
  <title>Edit | Web Token</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sideabar-mini">
<?php
  $id = $_SESSION['id'];

  $result = $koneksi->query("SELECT * FROM user WHERE id='$id'");
  while($profile = $result->fetch_assoc()){
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
            <h1>Edit Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container">
        <div class="card">
          <div class="card-body">
              <form action="?profile=update-profile" enctype="multipart/form-data" method="post">
                <div class="col-md-12">
                  <div class="form-group">
                    <div>
                  </div>
                </div>
                <span style='color:red;'>*</span> <label for=""> gambar harus 96x96</label>

                  <div class="row d-flex justify-content-center">
                  
                      <!-- <label class="control-label">JUDUL</label> -->
                    <img src="dist/img/<?= $profile['gambar']?>" style='width:10%'>
                  </div>
                  <br>
                  <div align='center'>
                    <input type="file" name="gambar" >
                  </div>
                  <br>
                  <div class="row ">

                    <div class="col-md-6">
                      <div class="form-group has-danger">
                      <label class="control-label">Username</label>
                        <input type="text"  class="form-control"  name="username" value=<?php echo $profile['username']; ?>>
                      </div>
                    </div>
                  </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group has-danger">
                      <label class="control-label">Password</label>
                        <input type="password" class="form-control" name="password"  placeholder="New Password" required>
                      </div>
                    <div>
                </div>
              <div class="float-left">
                <input type="hidden" name="id" value=<?php echo $_SESSION['id']; ?>>

                <input type="submit" class="btn btn-primary" name="UpdateProfile" value="Update">
              </div>
            </form>
            <?php
              }
            ?>
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

<script type="text/javascript">
$(document).ready(function () {
  bsCustomFileInput.init();
});
</script>
</body>
</html>
