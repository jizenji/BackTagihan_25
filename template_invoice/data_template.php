<?php
session_start();

include_once("koneksi.php");
include("func/function.php");

if ($_SESSION['level'] != 'admin') {
  die('<script>alert("Anda Bukan Admin");window.location = "logout.php";</script>');
}

if (!isset($_SESSION['username'])) {
  header('location:login.php');
} else {
  $username = $_SESSION['username'];
}

?>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Data Template Struk | WEB TOKEN</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" type="text/css" href="plugins/sweetalert2/sweetalert2.css">
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="assets/js/sweetalert.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <style>
    input[type=number] {
      -moz-appearance: textfield;
    }
  </style>
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
  <div class="wrapper">

    <!-- navbar -->
    <?php include 'side/nav_top.php'; ?>
    <!-- End navbar -->

    <!-- Main Sidebar Container -->
    <?php include 'side/side.php'; ?>
    <!-- End Sidebar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Data Template Struk</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Data Template Struk</li>
              </ol>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Template Struk</h3>
              </div>
              <div class="card-body">
                <?php if (isset($_SESSION['msg_delete'])) : ?>
                  <div class="alert alert-<?= $_SESSION['msg_type'] ?>">
                    <?php
                    echo $_SESSION['msg_delete'];
                    unset($_SESSION['msg_delete']);
                    ?>
                  </div>
                <?php endif ?>

                <div class="table-responsive">
                  <table id="example1" class="table table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Model</th>
                        <th>Nama Vendor</th>
                        <th>Foto</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no = 1;
                      $resultt = $koneksi->query("SELECT * FROM template_invoice");
                      while ($data = mysqli_fetch_assoc($resultt)) {
                      ?>
                        <tr>
                          <td><?= $no++; ?></td>
                          <td><?= $data['name']; ?></td>
                          <td><?= $data['name_vendor']; ?></td>
                          <td><img src="<?php echo $data['path_featured_receipt']; ?>" style="width: 100px"></td>
                          <td>
                            <div class="d-flex">
                              <a href="#" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal<?= $data['id']; ?>"><i class="fas fa-edit"></i></a>&nbsp
                              <a class="btn btn-danger btn-sm text-nowrap" href="?template-invoice=delete&id=<?= $data['id'] ?>" onclick="return confirm(`Yakin Delete?`)"><i class='fas fa-trash'></i></a>
                            </div>
                          </td>
                        </tr>
                        <div class="modal fade" id="myModal<?= $data['id']; ?>" role="dialog">
                          <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title">Data Harga Customer </h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>
                              <div class="modal-body">
                                <form role="form" action="?template-invoice=proccess-update" method="POST" enctype="multipart/form-data">
                                  <?php
                                  $id = $data['id'];
                                  $query_edit = $koneksi->query("SELECT * FROM template_invoice WHERE id='$id'");

                                  while ($row = mysqli_fetch_array($query_edit)) {
                                  ?>

                                    <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Nama Model</label>
                                          <input type="text" name="name" class="form-control" value="<?= $row['name']; ?>" required>
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Nama Vendor</label>
                                          <input type="text" name="name_vendor" class="form-control" value="<?= $row['name_vendor']; ?>" required>
                                        </div>
                                      </div>
                                      <div class="col-md-12">
                                        <div class="form-group">
                                          <label>Alamat</label>
                                          <textarea name="address" class="form-control" required><?= $row['address']; ?></textarea>
                                        </div>
                                      </div>
                                      <div class="col-md-12">
                                        <div class="form-group">
                                          <label>UCAPAN FOOTER STRUK</label>
                                          <textarea name="greeting_receipt" class="form-control"><?= $row['greeting_footer_receipt']; ?></textarea>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-12">
                                        <div class="form-group">
                                          <label>Logo</label>
                                          <input type="file" name="logo" class="form-control">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                      <button type="submit" name="update" class="btn btn-success">Update</button>
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                  <?php } ?>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Footer -->
    <?php include 'side/footer.php'; ?>
    <!-- End Footer -->

  </div>
  <script>
    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
      return true;
    }
  </script>
  </script>
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
  <script src="plugins/datatables/jquery.dataTables.js"></script>
  <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
  <script src="plugins/sweetalert2/sweetalert.js"></script>
  <script src="plugins/sweetalert2/sweetalert.min.js"></script>
  <script src="dist/js/adminlte.min.js"></script>
  <script src="dist/js/demo.js"></script>
  <script>
    $(function() {
      $("#example1").DataTable();
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": true
      });
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
      bsCustomFileInput.init();
    });

    document.addEventListener("wheel", (event) => {
      if (document.activeElement.type === "number") {
        document.activeElement.blur();
      }
    });
  </script>

</body>

</html>