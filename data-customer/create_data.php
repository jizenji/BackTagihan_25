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
  <title>Tambah Data Customer</title>
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
        <h2>CREATE USER CUSTOMER</h2>
        <form action="?data-customer=proses-create" method="POST" enctype="multipart/form-data">
          <div class="col-md-12">
            <div class="form-group">
              <div>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group has-danger">
                  <label class="control-label">ID CUSTOMER</label>
                  <input type="text" class="form-control form-control-danger" name="id_customer" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group has-danger">
                  <label class="control-label">NAMA CUSTOMER</label>
                  <input type="text" class="form-control form-control-danger" name="nm_lengkap" required>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group has-danger">
                  <label class="control-label">TEMPLATE STRUK</label>
                  <select name="template_id" class="form-control" required>
                    <option value="">-- Pilih Model Struk --</option>
                    <?php
                    $resultt = $koneksi->query("SELECT * FROM template_invoice");
                    while ($data = mysqli_fetch_assoc($resultt)) {
                    ?>

                      <option value="<?= $data['id']; ?>"><?= $data['name']; ?></option>

                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group has-success">
                  <label class="control-label">USERNAME</label>
                  <input type="text" class="form-control form-control-danger" name="username" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group has-success">
                  <label class="control-label">PASSWORD</label>
                  <input type="text" class="form-control form-control-danger" name="password" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group has-success">
                  <label class="control-label">ALAMAT</label>
                  <input type="text" class="form-control form-control-danger" name="alamat" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group has-success">
                  <label class="control-label">TELEPON</label>
                  <input type="number" class="form-control form-control-danger" name="telepon" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group has-success">
                  <label class="control-label">METER 1 (LISTRIK)</label>
                  <input type="number" class="form-control form-control-danger" name="meteronel" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group has-success">
                  <label class="control-label">CONCETRATOR ID METER 1 (LISTRIK)</label>
                  <input type="number" class="form-control form-control-danger" name="cnsmeteronel" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group has-success">
                  <label class="control-label">METER 2 (LISTRIK)</label>
                  <input type="number" class="form-control form-control-danger" name="metertwol">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group has-success">
                  <label class="control-label">CONCETRATOR ID METER 2 (LISTRIK)</label>
                  <input type="number" class="form-control form-control-danger" name="cnsmetertwol">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group has-success">
                  <label class="control-label">METER 3 (LISTRIK)</label>
                  <input type="number" class="form-control form-control-danger" name="meterthreel">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group has-success">
                  <label class="control-label">CONCETRATOR ID METER 3 (LISTRIK)</label>
                  <input type="number" class="form-control form-control-danger" name="cnsmeterthreel">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group has-success">
                  <label class="control-label">METER 4 (LISTRIK)</label>
                  <input type="number" class="form-control form-control-danger" name="meterfourl">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group has-success">
                  <label class="control-label">CONCETRATOR ID METER 4 (LISTRIK)</label>
                  <input type="number" class="form-control form-control-danger" name="cnsmeterfourl">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group has-success">
                  <label class="control-label">METER 1 (AIR)</label>
                  <input type="number" class="form-control form-control-danger" name="meteronea">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group has-success">
                  <label class="control-label">CONCETRATOR ID METER 1 (AIR)</label>
                  <input type="number" class="form-control form-control-danger" name="cnsmeteronea">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group has-success">
                  <label class="control-label">METER 2 (AIR)</label>
                  <input type="number" class="form-control form-control-danger" name="metertwoa">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group has-success">
                  <label class="control-label">CONCETRATOR ID METER 2 (AIR)</label>
                  <input type="number" class="form-control form-control-danger" name="cnsmetertwoa">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group has-success">
                  <label class="control-label">METER 3 (AIR)</label>
                  <input type="number" class="form-control form-control-danger" name="meterthreea">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group has-success">
                  <label class="control-label">CONCETRATOR ID METER 3 (AIR)</label>
                  <input type="number" class="form-control form-control-danger" name="cnsmeterthreea">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group has-success">
                  <label class="control-label">METER 4 (AIR)</label>
                  <input type="number" class="form-control form-control-danger" name="meterfoura">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group has-success">
                  <label class="control-label">CONCETRATOR ID METER 4 (AIR)</label>
                  <input type="number" class="form-control form-control-danger" name="cnsmeterfoura">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group has-success">
                  <label class="control-label">METER 1 (GAS)</label>
                  <input type="number" class="form-control form-control-danger" name="meteroneg">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group has-success">
                  <label class="control-label">CONCETRATOR ID METER 1 (GAS)</label>
                  <input type="number" class="form-control form-control-danger" name="cnsmeteroneg">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group has-success">
                  <label class="control-label">METER 2 (GAS)</label>
                  <input type="number" class="form-control form-control-danger" name="metertwog">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group has-success">
                  <label class="control-label">CONCETRATOR ID METER 2 (GAS)</label>
                  <input type="number" class="form-control form-control-danger" name="cnsmetertwog">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group has-success">
                  <label class="control-label">METER 3 (GAS)</label>
                  <input type="number" class="form-control form-control-danger" name="meterthreeg">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group has-success">
                  <label class="control-label">CONCETRATOR ID METER 3 (GAS)</label>
                  <input type="number" class="form-control form-control-danger" name="cnsmeterthreeg">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group has-success">
                  <label class="control-label">METER 4 (GAS)</label>
                  <input type="number" class="form-control form-control-danger" name="meterfourg">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group has-success">
                  <label class="control-label">CONCETRATOR ID METER 4 (GAS)</label>
                  <input type="number" class="form-control form-control-danger" name="cnsmeterfourg">
                </div>
              </div>
            </div>



            <div class="float-right">
              <input type="submit" class="btn btn-outline-success" name="tambah-user" value="Tambahkan">
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