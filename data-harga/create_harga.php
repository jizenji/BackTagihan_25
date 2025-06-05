<?php
session_start();

include_once("koneksi.php");
include("func/function.php");

if ($_SESSION['level'] != 'admin') {
  die('<script>alert("Anda Bukan Admin");window.location = "logout.php";</script>');
}

if(!isset($_SESSION['username'])) {
   header('location:?login');
} else {
   $username = $_SESSION['username'];
}
?>
<html>
<head>
    <title>Tambah User Customer</title>
    <link rel="stylesheet" type="text/css" href="assets/css/boostrap.min.css">
		<link rel="stylesheet" type="text/css" href="assets/css/drop.css">
		<script src="assets/js/jquery.slim.min.js"></script>
		<script src="assets/js/popper.min.js"></script>
		<script src="assets/js/bootstrap.min.js" ></script>
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
        <h2>HARGA TOKEN CUSTOMER</h2>
        <form action="?data-harga=pros-pric" method="POST">
          <div class="col-md-12">
            <div class="form-group">
              <div>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group has-danger">
                <label class="control-label">JUDUL HARGA</label>
                  <input type="text" class="form-control form-control-danger" name="judul" required  >
                </div>
            </div>
            <div class="col-md-6">
              <div class="form-group has-danger">
                <label class="control-label">JENIS METERAN</label>
                <select class="form-control" name="type-meter" required>
                  <option value="">-- Select Jenis Meteran --</option>
                  <option value="listrik">Listrik</option>
                  <option value="air">Air</option>
                  <option value="gas">Gas</option>
                  <!-- <option value="solar">Solar</option> -->
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group has-success">
                <label class="control-label">HARGA TOKEN</label>
                  <input type="number" class="form-control form-control-danger" name="harga"  required >
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group has-success">
                  <label class="control-label">BIAYA PPN</label>
                    <input type="number" class="form-control form-control-danger" name="ppn"  required >  
                  </div>
                </div>
                <div class="col-md-6">
                <div class="form-group has-success">
                  <label class="control-label">BIAYA ADMIN</label>
                    <input type="number" class="form-control form-control-danger" name="admin"  required >     
                  </div>
                </div>
                

                <div class="col-md-6">
                <div class="form-group has-success">
                  <label class="control-label">NOMINAL TOKEN</label>
                    <input type="number" class="form-control form-control-danger" name="kwh"  required >     
                  </div>
                </div>
              </div>
               
       
        <div class="float-right">
                  <input type="submit" class="btn btn-outline-success" name="tambah-harga" value="Tambahkan">
              </div>
              <div class="float-left">
                  <a href="?data-harga=x" class="btn btn-success" role="button" aria-pressed="true">View Data Harga</a>
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