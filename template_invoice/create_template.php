<?php
session_start();

include_once("koneksi.php");
include("func/function.php");

if ($_SESSION['level'] != 'admin') {
  die('<script>alert("Anda Bukan Admin");window.location = "logout.php";</script>');
}

if (!isset($_SESSION['username'])) {
  header('location:?login');
} else {
  $username = $_SESSION['username'];
}

?>
<html>

<head>
  <title>Tambah Data Template Struk</title>
  <link rel="stylesheet" type="text/css" href="assets/css/boostrap.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/drop.css">
  <script src="assets/js/jquery.slim.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/sweetalert.js"></script>

  <style>
    input[type=number] {
      -moz-appearance: textfield;
    }
  </style>

</head>

<body>

  <br>

  <div class="container">
    <div class="card">
      <div class="card-body">
        <h2>CREATE TEMPLATE STRUK</h2>
        <form action="?template-invoice=process-create" method="POST" enctype="multipart/form-data">
          <div class="col-md-12">
            <div class="form-group">
              <div>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group has-danger">
                  <label class="control-label">NAMA MODEL</label>
                  <input type="text" class="form-control form-control-danger" name="name" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group has-danger">
                  <label class="control-label">NAMA VENDOR</label>
                  <input type="text" class="form-control form-control-danger" name="vendor" required>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group has-success">
                  <b><label class="control-label">LOGO STRUK</label></b>
                  <input type="file" name="logo" class="form-control form-control-danger" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group has-success">
                  <b><label class="control-label">ALAMAT</label></b>
                  <textarea name="address" class="form-control"></textarea>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group has-success">
                  <b><label class="control-label">UCAPAN FOOTER STRUK</label></b>
                  <textarea name="greeting_receipt" class="form-control"></textarea>
                </div>
              </div>
            </div>


            <div class="float-right">
              <input type="submit" class="btn btn-outline-success" name="add" value="Tambahkan">
            </div>
            <div class="float-left">
              <a href="?data-customer=x" class="btn btn-success" role="button" aria-pressed="true">View Data Customer</a>
            </div>
        </form>

      </div>
    </div>
  </div>
  </div>
</body>
<script>
  document.addEventListener("wheel", (event) => {
    if (document.activeElement.type === "number") {
      document.activeElement.blur();
    }
  });
</script>

</html>