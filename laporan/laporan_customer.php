<?php
include_once("koneksi.php");
include("func/function.php");
date_default_timezone_set("Asia/Jakarta"); 

session_start();

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
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Laporan Transaksi | TOKEN</title>
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
  .no-sort::after { 
	opacity: 0;
    content:unset;
}

.no-sort { 
  	opacity: 0;
    content:unset; 
}
  </style>
</head>
<body class="hold-transition sidebar-mini">
  <?php
  if (isset($_SESSION['msg_update']) == true) {
    echo "
    <script>
      swal('Success!', 'Anda Berhasil Update Data', 'success')
    </script>
    ";
    unset($_SESSION['msg_update']);
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
            <h1>Laporan Transaksi Customer</h1>
          </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Laporan Transaksi <?= $_GET['choice']; ?></li>
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
           
              <h3 class="card-title">Laporan Transaksi</h3>
              
              
            </div>
             <?php if (isset($_SESSION['msg'])): ?>
                <div class="alert alert-<?=$_SESSION['msg_type']?>">
                  <?php
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                  ?>
                </div>
              <?php endif ?>
           
        <!------------------END-REPORT----------------------->
        <br>
        <br>
        <form id="sub" action="?laporan=delete-xi" method="POST" >

        <input type="submit" name="delete" class="btn btn-danger" value="Hapus Data" style="float:right;" onclick="return confirm(`Yakin Delete?`)">
        <div class="table-responsive">
          <table id="example1" class="table table-striped">
            <thead>
              <tr>
                  <th>No</th>
                  <th>Nomor Transaksi</th>
                  <th>Meter ID</th>
                  <th>ID Customer</th>
                  <th>Nama Customer</th>
                  <th>Alamat</th>
                  <th>Telepon</th>
                  <th>Jenis Meter</th>
                  <th>Nominal</th>
                  <th>Kwh/M2/M3</th>
                  <th>Token</th>
                  <th>Waktu/Tanggal</th>
                  <th>Status</th>
                  <!-- <th>Export</th> -->
                  
                  <th><input type="checkbox" id="check-all" value="<?= $data['id']; ?>"></td></th>
              </tr>
            </thead>
            <tbody>
              <?php
                $no = 1;
                $choice = $_GET['choice'];
                $resultt = $koneksi->query("SELECT * FROM laporan_cu WHERE jenis_meter='$choice' ORDER BY id DESC");

                while ($data = mysqli_fetch_assoc($resultt)){
                  
                  $token = substr($data['token'], 1,24);
                  

              ?>
              <tr>
                <!-- <?php
                echo "<pre>"; 
                print_r($data);
                 ?> -->
              
                <td><?= $no++; ?></td>
                <td class='text-nowrap'><?= $data['trx']; ?></td>
                <td class='text-nowrap'><?= $data['meter']; ?></td>
                <td class='text-nowrap'><?= $data['id_customer']; ?></td>
                <td class='text-nowrap'><?= $data['nama']; ?></td>
                <td class='text-nowrap'><?= $data['alamat']; ?></td>
                <td class='text-nowrap'><?= $data['telepon']; ?></td>
                <td class='text-nowrap'><?= $data['jenis_meter']; ?></td>
                <td>Rp. <?= number_format($data['price'], 0, ',', '.');?></td>
                <td><?= $data['amount'] ?></td>
                <td class='text-nowrap'><?= $data['token'] ?></td>
                <td class='text-nowrap'><?= $data['tanggal']; ?></td>
                

                <?php
                  if ($data['status'] == "pending")
                  {
                ?>
                <td style="color: #f1c40f;">PENDING</td>
                <?php
                  }         
                else if ($data['status'] == "berhasil")
                {
                ?>
                <td style="color: green;">BERHASIL</td>
                <?php
                }

                else if ($data['status'] == "diclaim")
                {
                ?>
                <td style="color: green;">SUDAH DICLAIM</td>
                <?php
                }

                else 
                {
                ?>
                <td style="color: red;">EXPIRED</td>

                <?php
                }
                
                ?>
                <!-- <td>
                  <div class="d-flex">
                    <a class="btn btn-success btn-sm text-nowrap" href="?laporan=export&id=<?= $data['id']?>"><i class='fas fa-file-export'></i></a>&nbsp
                    
                  </div>
                </td> -->

        
                <td><input type="checkbox" class="check-item" name="pilih[]" id="check-all" value="<?= $data['id']; ?>"></td>
              

               
                
               
              </tr>
              <?php
             
                }
                
              ?>
              
             



          
             
             
             
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  </form>
</section>
    <!-- /.content -->
</div>
  <!-- /.content-wrapper -->

<!-- Footer -->
<?php include 'side/footer.php';?>
<!-- End Footer -->

</div>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="plugins/sweetalert2/sweetalert.js"></script>
<script src="plugins/sweetalert2/sweetalert.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/demo.js"></script>
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": true,

      'columnDefs': [{ 'orderable': false, 'targets': 0 }],
    });
  });
</script>
<script type="text/javascript">
$(document).ready(function () {
  bsCustomFileInput.init();

  $("#check-all").click(function(){ 
  if($(this).is(":checked"))    
  $(".check-item").prop("checked", true); 
  else     
  $(".check-item").prop("checked", false);  
  });

});


</script>
</body>
</html>
