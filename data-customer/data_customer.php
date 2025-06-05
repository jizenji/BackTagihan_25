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

$result = $koneksi->query("SELECT * from data_customer");
?>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Data Customer | TOKEN</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
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
  } elseif (isset($_SESSION['succes_reset_login']) == 1) {
    echo "
    <script>
      swal('Success!', 'Anda Berhasil Reset Login !', 'success')
    </script>
    ";
    unset($_SESSION['succes_reset_login']);
  } elseif (isset($_SESSION['fail']) == 1) {
    echo "
    <script>
      swal('Error!', 'Data Belum Berhasil Diedit', 'error')
    </script>
    ";
    unset($_SESSION['fail']);
  } elseif (isset($_SESSION['fails']) == 2) {
    echo "
    <script>
      swal('Error!', 'Id Customer Tidak Boleh Sama', 'error')
    </script>
    ";
    unset($_SESSION['fails']);
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
              <h1>Data Customer</h1>

            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Data Customer</li>
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
                <h3 class="card-title">Data Customer</h3>

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

                <br>
                <div class="table-responsive">
                  <table id="example1" class="table table-striped">
                    <thead>
                      <tr>
                        <th class="text-nowrap">No</th>
                        <th class="text-nowrap">Id Customer</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th class="text-nowrap">Alamat</th>
                        <th class="text-nowrap">No Tlpn</th>
                        <th>Meter 1 (LISTRIK)</th>
                        <th>Meter 2 (LISTRIK)</th>
                        <th>Meter 3 (LISTRIK)</th>
                        <th>Meter 4 (LISTRIK)</th>
                        <th>Meter 1 (AIR)</th>
                        <th>Meter 2 (AIR)</th>
                        <th>Meter 3 (AIR)</th>
                        <th>Meter 4 (AIR)</th>
                        <th>Meter 1 (GAS)</th>
                        <th>Meter 2 (GAS)</th>
                        <th>Meter 3 (GAS)</th>
                        <th>Meter 4 (GAS)</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no = 1;
                      while ($data = mysqli_fetch_assoc($result)) {

                      ?>
                        <tr>
                          <td><?= $no++; ?></td>
                          <td class="text-nowrap"><?= $data['id_customer']; ?></td>
                          <td class="text-nowrap"><?= $data['nm_lengkap']; ?></td>
                          <td><?= $data['username'] ?></td>
                          <td><?= $data['password'] ?></td>
                          <td class="text-nowrap"><?= $data['alamat'] ?></td>
                          <td class="text-nowrap"><?= $data['telepon'] ?></td>
                          <td class="text-nowrap">
                            <?= $data['metersatul'] ?>
                            <?php if ($data['metersatul'] != "") {
                              if ($data['status_metersatul'] == "Active") { ?> (<a href="?data-customer=remote&meter=<?= $data['metersatul'] ?>&switch=off&type=metersatul" onclick="return confirm('Apakah yakin akan MEMATIKAN Meter ini?');"><i style="color: green; " class="fas fa-power-off"></i></a>) <?php } else { ?> (<a href="?data-customer=remote&meter=<?= $data['metersatul'] ?>&switch=on&type=metersatul" onclick="return confirm('Apakah yakin akan MENYALAKAN Meter ini?');"> <i style="color: red; " class="fas fa-power-off"></i> </a>) <?php } ?> <a href="?data-customer=refresh-conce&conce=<?= $data['concentratorid_metersatul'] ?>&type=metersatul" class="">Refresh</a> <?php } ?>
                          </td>
                          <td class="text-nowrap">
                            <?= $data['meterdual'] ?>
                            <?php if ($data['meterdual'] != "") {
                              if ($data['status_meterdual'] == "Active") { ?> (<a href="?data-customer=remote&meter=<?= $data['meterdual'] ?>&switch=off&type=meterdual" onclick="return confirm('Apakah yakin akan MEMATIKAN Meter ini?');"><i style="color: green; " class="fas fa-power-off"></i></a>) <?php } else { ?> (<a href="?data-customer=remote&meter=<?= $data['meterdual'] ?>&switch=on&type=meterdual" onclick="return confirm('Apakah yakin akan MENYALAKAN Meter ini?');"> <i style="color: red; " class="fas fa-power-off"></i> </a>) <?php } ?> <a href="?data-customer=refresh-conce&conce=<?= $data['concentratorid_meterdual'] ?>" class="">Refresh</a> <?php } ?>
                          </td>
                          <td class="text-nowrap">
                            <?= $data['metertigal'] ?>
                            <?php if ($data['metertigal'] != "") {
                              if ($data['status_metertigal'] == "Active") { ?> (<a href="?data-customer=remote&meter=<?= $data['metertigal'] ?>&switch=off&type=metertigal" onclick="return confirm('Apakah yakin akan MEMATIKAN Meter ini?');"><i style="color: green; " class="fas fa-power-off"></i></a>) <?php } else { ?> (<a href="?data-customer=remote&meter=<?= $data['metertigal'] ?>&switch=on&type=metertigal" onclick="return confirm('Apakah yakin akan MENYALAKAN Meter ini?');"> <i style="color: red; " class="fas fa-power-off"></i> </a>) <?php } ?> <a href="?data-customer=refresh-conce&conce=<?= $data['concentratorid_metertigal'] ?>" class="">Refresh</a> <?php } ?>
                          </td>
                          <td class="text-nowrap">
                            <?= $data['meterempatl'] ?>
                            <?php if ($data['meterempatl'] != "") {
                              if ($data['status_meterempatl'] == "Active") { ?> (<a href="?data-customer=remote&meter=<?= $data['meterempatl'] ?>&switch=off&type=meterempatl" onclick="return confirm('Apakah yakin akan MEMATIKAN Meter ini?');"><i style="color: green; " class="fas fa-power-off"></i></a>) <?php } else { ?> (<a href="?data-customer=remote&meter=<?= $data['meterempatl'] ?>&switch=on&type=meterempatl" onclick="return confirm('Apakah yakin akan MENYALAKAN Meter ini?');"> <i style="color: red; " class="fas fa-power-off"></i> </a>) <?php } ?> <a href="?data-customer=refresh-conce&conce=<?= $data['concentratorid_meterempatl'] ?>" class="">Refresh</a> <?php } ?>
                          </td>
                          <td class="text-nowrap">
                            <?= $data['metersatua'] ?>
                            <?php if ($data['metersatua'] != "") {
                              if ($data['status_metersatua'] == "Active") { ?> (<a href="?data-customer=remote&meter=<?= $data['metersatua'] ?>&switch=off&type=metersatua" onclick="return confirm('Apakah yakin akan MEMATIKAN Meter ini?');"><i style="color: green; " class="fas fa-power-off"></i></a>) <?php } else { ?> (<a href="?data-customer=remote&meter=<?= $data['metersatua'] ?>&switch=on&type=metersatua" onclick="return confirm('Apakah yakin akan MENYALAKAN Meter ini?');"> <i style="color: red; " class="fas fa-power-off"></i> </a>) <?php } ?> <a href="?data-customer=refresh-conce&conce=<?= $data['concentratorid_metersatua'] ?>" class="">Refresh</a> <?php } ?>
                          </td>
                          <td class="text-nowrap">
                            <?= $data['meterduaa'] ?>
                            <?php if ($data['meterduaa'] != "") {
                              if ($data['status_meterduaa'] == "Active") { ?> (<a href="?data-customer=remote&meter=<?= $data['meterduaa'] ?>&switch=off&type=meterduaa" onclick="return confirm('Apakah yakin akan MEMATIKAN Meter ini?');"><i style="color: green; " class="fas fa-power-off"></i></a>) <?php } else { ?> (<a href="?data-customer=remote&meter=<?= $data['meterduaa'] ?>&switch=on&type=meterduaa" onclick="return confirm('Apakah yakin akan MENYALAKAN Meter ini?');"> <i style="color: red; " class="fas fa-power-off"></i> </a>) <?php } ?> <a href="?data-customer=refresh-conce&conce=<?= $data['concentratorid_meterduaa'] ?>" class="">Refresh</a> <?php } ?>
                          </td>
                          <td class="text-nowrap">
                            <?= $data['metertigaa'] ?>
                            <?php if ($data['metertigaa'] != "") {
                              if ($data['status_metertigaa'] == "Active") { ?> (<a href="?data-customer=remote&meter=<?= $data['metertigaa'] ?>&switch=off&type=metertigaa" onclick="return confirm('Apakah yakin akan MEMATIKAN Meter ini?');"><i style="color: green; " class="fas fa-power-off"></i></a>) <?php } else { ?> (<a href="?data-customer=remote&meter=<?= $data['metertigaa'] ?>&switch=on&type=metertigaa" onclick="return confirm('Apakah yakin akan MENYALAKAN Meter ini?');"> <i style="color: red; " class="fas fa-power-off"></i> </a>) <?php } ?> <a href="?data-customer=refresh-conce&conce=<?= $data['concentratorid_metertigaa'] ?>" class="">Refresh</a> <?php } ?>
                          </td>
                          <td class="text-nowrap">
                            <?= $data['meterempata'] ?>
                            <?php if ($data['meterempata'] != "") {
                              if ($data['status_meterempata'] == "Active") { ?> (<a href="?data-customer=remote&meter=<?= $data['meterempata'] ?>&switch=off&type=meterempata" onclick="return confirm('Apakah yakin akan MEMATIKAN Meter ini?');"><i style="color: green; " class="fas fa-power-off"></i></a>) <?php } else { ?> (<a href="?data-customer=remote&meter=<?= $data['meterempata'] ?>&switch=on&type=meterempata" onclick="return confirm('Apakah yakin akan MENYALAKAN Meter ini?');"> <i style="color: red; " class="fas fa-power-off"></i> </a>) <?php } ?> <a href="?data-customer=refresh-conce&conce=<?= $data['concentratorid_meterempata'] ?>" class="">Refresh</a> <?php } ?>
                          </td>
                          <td class="text-nowrap">
                            <?= $data['metersatug'] ?>
                            <?php if ($data['metersatug'] != "") {
                              if ($data['status_metersatug'] == "Active") { ?> (<a href="?data-customer=remote&meter=<?= $data['metersatug'] ?>&switch=off&type=metersatug" onclick="return confirm('Apakah yakin akan MEMATIKAN Meter ini?');"><i style="color: green; " class="fas fa-power-off"></i></a>) <?php } else { ?> (<a href="?data-customer=remote&meter=<?= $data['metersatug'] ?>&switch=on&type=metersatug" onclick="return confirm('Apakah yakin akan MENYALAKAN Meter ini?');"> <i style="color: red; " class="fas fa-power-off"></i> </a>) <?php } ?> <a href="?data-customer=refresh-conce&conce=<?= $data['concentratorid_metersatug'] ?>" class="">Refresh</a> <?php } ?>
                          </td>
                          <td class="text-nowrap">
                            <?= $data['meterduag'] ?>
                            <?php if ($data['meterduag'] != "") {
                              if ($data['status_meterduag'] == "Active") { ?> (<a href="?data-customer=remote&meter=<?= $data['meterduag'] ?>&switch=off&type=meterduag" onclick="return confirm('Apakah yakin akan MEMATIKAN Meter ini?');"><i style="color: green; " class="fas fa-power-off"></i></a>) <?php } else { ?> (<a href="?data-customer=remote&meter=<?= $data['meterduag'] ?>&switch=on&type=meterduag" onclick="return confirm('Apakah yakin akan MENYALAKAN Meter ini?');"> <i style="color: red; " class="fas fa-power-off"></i> </a>) <?php } ?> <a href="?data-customer=refresh-conce&conce=<?= $data['concentratorid_meterduag'] ?>" class="">Refresh</a> <?php } ?>
                          </td>
                          <td class="text-nowrap">
                            <?= $data['metertigag'] ?>
                            <?php if ($data['metertigag'] != "") {
                              if ($data['status_metertigag'] == "Active") { ?> (<a href="?data-customer=remote&meter=<?= $data['metertigag'] ?>&switch=off&type=metertigag" onclick="return confirm('Apakah yakin akan MEMATIKAN Meter ini?');"><i style="color: green; " class="fas fa-power-off"></i></a>) <?php } else { ?> (<a href="?data-customer=remote&meter=<?= $data['metertigag'] ?>&switch=on&type=metertigag" onclick="return confirm('Apakah yakin akan MENYALAKAN Meter ini?');"> <i style="color: red; " class="fas fa-power-off"></i> </a>) <?php } ?> <a href="?data-customer=refresh-conce&conce=<?= $data['concentratorid_metertigag'] ?>" class="">Refresh</a> <?php } ?>
                          </td>
                          <td class="text-nowrap">
                            <?= $data['meterempatg'] ?>
                            <?php if ($data['meterempatg'] != "") {
                              if ($data['status_meterempatg'] == "Active") { ?> (<a href="?data-customer=remote&meter=<?= $data['meterempatg'] ?>&switch=off&type=meterempatg" onclick="return confirm('Apakah yakin akan MEMATIKAN Meter ini?');"><i style="color: green; " class="fas fa-power-off"></i></a>) <?php } else { ?> (<a href="?data-customer=remote&meter=<?= $data['meterempatg'] ?>&switch=on&type=meterempatg" onclick="return confirm('Apakah yakin akan MENYALAKAN Meter ini?');"> <i style="color: red; " class="fas fa-power-off"></i> </a>) <?php } ?> <a href="?data-customer=refresh-conce&conce=<?= $data['concentratorid_meterempatg'] ?>" class="">Refresh</a> <?php } ?>
                          </td>
                          <td>
                            <div class="d-flex">
                              <a href="#" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal<?= $data['id']; ?>"><i class="fas fa-edit"></i></a>&nbsp
                              <a class="btn btn-danger btn-sm text-nowrap" href="?data-customer=delete-x&id=<?= $data['id'] ?>" onclick="return confirm(`Yakin Delete?`)"><i class='fas fa-trash'></i></a>&nbsp

                            </div>
                          </td>
                        </tr>
                        <div class="modal fade" id="myModal<?= $data['id']; ?>" role="dialog">
                          <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title">Data Customer</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>
                              <div class="modal-body">
                                <form role="form" action="?data-customer=update-x" method="POST" enctype="multipart/form-data">
                                  <?php
                                  $id = $data['id'];
                                  $query_edit = $koneksi->query("SELECT * FROM data_customer WHERE id='$id'");

                                  while ($row = mysqli_fetch_array($query_edit)) {
                                  ?>
                                    <div class="form-group">
                                      <label>Id Customer</label>
                                      <input type="text" name="id_customer" class="form-control" value="<?= $row['id_customer']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                      <label>Nama</label>
                                      <input type="text" name="nm_lengkap" class="form-control" value="<?= $row['nm_lengkap']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Template Struk</label>
                                        <select name="template_id" class="form-control" required>
                                            <option value="">-- Pilih Model Struk --</option>
                                            <?php
                                            $resultt = $koneksi->query("SELECT * FROM template_invoice");
                                            while ($data = mysqli_fetch_assoc($resultt)) {
                                                $selected = ($data['id'] == $row['template_invoice_id']) ? 'selected' : '';
                                            ?>
                                                <option value="<?= $data['id']; ?>" <?= $selected; ?>><?= $data['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Username</label>
                                          <input type="text" name="username" class="form-control" value="<?= $row['username']; ?>" required>
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">

                                          <label>Password</label>
                                          <input type="text" name="password" class="form-control" value="<?= $row['password']; ?>" required>
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Alamat</label>
                                          <input type="text" name="alamat" class="form-control" value="<?= $row['alamat']; ?>" required>
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Telepon</label>
                                          <input type="number" name="telepon" class="form-control" value="<?= $row['telepon']; ?>" required>
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Meter 1 (LISTRIK)</label>
                                          <input type="number" name="meteronel" class="form-control" value="<?= $row['metersatul']; ?>" required>
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Concetrator Meter 1 (LISTRIK)</label>
                                          <input type="number" name="cnsmeteronel" class="form-control" value="<?= $row['concentratorid_metersatul']; ?>" required>
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Meter 2 (LISTRIK)</label>
                                          <input type="number" name="metertwol" class="form-control" value="<?= $row['meterdual']; ?>">
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Concetrator Meter 2 (LISTRIK)</label>
                                          <input type="number" name="cnsmetertwol" class="form-control" value="<?= $row['concentratorid_meterdual']; ?>">
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Meter 3 (LISTRIK)</label>
                                          <input type="number" name="meterthreel" class="form-control" value="<?= $row['metertigal']; ?>">
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Concetrator Meter 3 (LISTRIK)</label>
                                          <input type="number" name="cnsmeterthreel" class="form-control" value="<?= $row['concentratorid_metertigal']; ?>">
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Meter 4 (LISTRIK)</label>
                                          <input type="number" name="meterfourl" class="form-control" value="<?= $row['meterempatl']; ?>">
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Concetrator Meter 4 (LISTRIK)</label>
                                          <input type="number" name="cnsmeterfourl" class="form-control" value="<?= $row['concentratorid_meterempatl']; ?>">
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Meter 1 (AIR)</label>
                                          <input type="number" name="meteronea" class="form-control" value="<?= $row['metersatua']; ?>">
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Concetrator Meter 1 (AIR)</label>
                                          <input type="number" name="cnsmeteronea" class="form-control" value="<?= $row['concentratorid_metersatua']; ?>">
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Meter 2 (AIR)</label>
                                          <input type="number" name="metertwoa" class="form-control" value="<?= $row['meterduaa']; ?>">
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Concetrator Meter 2 (AIR)</label>
                                          <input type="number" name="cnsmetertwoa" class="form-control" value="<?= $row['concentratorid_meterduaa']; ?>">
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Meter 3 (AIR)</label>
                                          <input type="number" name="meterthreea" class="form-control" value="<?= $row['metertigaa']; ?>">
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Concetrator Meter 3 (AIR)</label>
                                          <input type="number" name="cnsmeterthreea" class="form-control" value="<?= $row['concentratorid_metertigaa']; ?>">
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Meter 4 (AIR)</label>
                                          <input type="number" name="meterfoura" class="form-control" value="<?= $row['meterempata']; ?>">
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Concetrator Meter 4 (AIR)</label>
                                          <input type="number" name="cnsmeterfoura" class="form-control" value="<?= $row['concentratorid_meterempata']; ?>">
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Meter 1 (GAS)</label>
                                          <input type="number" name="meteroneg" class="form-control" value="<?= $row['metersatug']; ?>">
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Concetrator Meter 1 (GAS)</label>
                                          <input type="number" name="cnsmeteroneg" class="form-control" value="<?= $row['concentratorid_metersatug']; ?>">
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Meter 2 (GAS)</label>
                                          <input type="number" name="metertwog" class="form-control" value="<?= $row['meterduag']; ?>">
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Concetrator Meter 2 (GAS)</label>
                                          <input type="number" name="cnsmetertwog" class="form-control" value="<?= $row['concentratorid_meterduag']; ?>">
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Meter 3 (GAS)</label>
                                          <input type="number" name="meterthreeg" class="form-control" value="<?= $row['metertigag']; ?>">
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Concetrator Meter 3 (GAS)</label>
                                          <input type="number" name="cnsmeterthreeg" class="form-control" value="<?= $row['concentratorid_metertigag']; ?>">
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Meter 4 (GAS)</label>
                                          <input type="number" name="meterfourg" class="form-control" value="<?= $row['meterempatg']; ?>">
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Concetrator Meter 4 (GAS)</label>
                                          <input type="number" name="cnsmeterfourg" class="form-control" value="<?= $row['concentratorid_meterempatg']; ?>">
                                        </div>
                                      </div>

                                    </div> <!--- end row -->
                                    <div class="modal-footer">
                                      <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                      <button type="submit" name="Update-x" class="btn btn-success">Update</button>
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
      </section>
      <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->

    <!-- Footer -->
    <?php include 'side/footer.php'; ?>
    <!-- End Footer -->

  </div>
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables -->
  <script src="plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
  <script>
    $(function() {
      $("#example1").DataTable({

      });
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });

    document.addEventListener("wheel", (event) => {
      if (document.activeElement.type === "number") {
        document.activeElement.blur();
      }
    });

    function previewImage(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          document.getElementById('preview').src = e.target.result;
        }

        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
</body>

</html>