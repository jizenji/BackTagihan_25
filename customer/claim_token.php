<?php
require("koneksi.php");
// error_reporting(0);
session_start();
date_default_timezone_set('Asia/Jakarta');

if ($_SESSION['level'] != 'customer') {
  die('<script>alert("Anda Bukan Customer");window.location = "siswa/logout.php";</script>');
}

if(!isset($_SESSION['username'])) {
   header('location:?part-customer=login');
} else {
   $username = $_SESSION['username'];
}



$config = $koneksi->query("SELECT * FROM config ORDER BY id_config desc");
          $resconfig = $config->fetch_array();

$waktu_skrng = date("H:i:s"); //timestamp
?>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>GENERATE | TOKEN</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" type="text/css" href="plugins/sweetalert2/sweetalert2.css">
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
  <script src="assets/js/sweetalert.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed sidebar-collapse">
  <?php
  if (isset($_SESSION['succes_input']) == 1) {
    echo "
    <script>
      swal('Success!', 'Anda Berhasil Input Data', 'success')
    </script>
    ";
    unset($_SESSION['succes_input']);
  }
  ?>
<div class="wrapper">
  <!-- navbar -->
  <?php include 'side/layout_customer/navbar_customer.php'; ?>
  <!-- End navbar -->

  <!-- Main Sidebar Container -->
    <?php include 'side/layout_customer/sidebar_customer.php'; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Claim Token</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Customer</li>
            </ol>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>
    
    <!-- Main content -->
    <section class="content">
      <div class="container">
        <div class="card card-primary">
          <div class="card-body">


                <?php

    $idss = $_SESSION['id'];
    $last = $koneksi->query("SELECT * FROM laporan_cu WHERE id_C='$idss' ORDER BY id DESC LIMIT 1");
    while($data = $last->fetch_assoc()) {
    $trx_id = $data['trx'];
    $status = $data['status'];
    $pato = $data['uniq'];
  }
  ?>

  <?php 
        if ($status == "berhasil"){

   ?>

   <form action="?part-customer=proses-claim" method="post">
     <h5>Pembayaran telah diproses, silahkan klik tombol Claim Token, untuk Claim Token.</h5>
     <br>
   <!--   <label class="control-label">Nomer Meter</label> -->
      <?php
      $id = $_SESSION['id'];
      // $id = 1;
      $nomer = $koneksi->query("SELECT * FROM data_customer WHERE id='$id'");
                        ?>
      <?php while($data = $nomer->fetch_array()){
        // $meter1 = $data['metersatu'];
        // $meter2 = $data['meterdua'];
        // $meter3 = $data['metertiga'];
        // $meter4 = $data['meterempat'];

        $dup = array_unique($data);

       ?>

       <?php

          if (!empty($dup[7])) {
            ?>
            
         <!--  <div>
          <input id="meter1" type="radio" name="meter" value="<?= $dup[7]; ?>"> <label for="meter1"><?= $dup[7]; ?></label>
          </div> -->

         
          <?php } ?>

          <?php  
          if (!empty($dup[8])) {
            ?>
            
          <!-- <div>
          <input id="meter2" type="radio" name="meter" value="<?= $dup[8]; ?>" >
          <label for="meter2"><?= $dup[8]; ?></label>
          </div> -->

         
          <?php } ?>

          <?php 
          if (!empty($dup[9])) {

        ?>
      <!-- <div>
          <input id="meter3" type="radio" name="meter" value="<?= $dup[9]; ?>" >
          <label for="meter3"><?= $dup[9]; ?></label>
      </div> -->
      
      <?php } ?>

         <?php 
          if (!empty($dup[10])) {
             # code...
           

        ?>
       
      
      <!-- <div>
          <input id="meter4" type="radio" name="meter" value="<?= $dup[10]; ?>"  >
          <label for="meter4"><?= $dup[10]; ?></label>
      </div> -->

    <?php } ?>
        
  <?php }
   $sess = $_SESSION['id'];
  $choice = $_SESSION['choice'];

  $meter = $koneksi->query("SELECT * FROM laporan_cu WHERE id_C=$sess ORDER BY id DESC LIMIT 1");

                    
      while($data = $meter->fetch_assoc()){

   ?>
      <input type="hidden" name="meter" value="<?= $data['meter'];?>">
      <input type="hidden" name="sessio" value="<?= $sess?>">
      <input type="hidden" name="choice" value="<?= $choice?>">
    <?php } ?>
      <br>
      <div style="">
          <input type="submit" name="proses" value="Claim" class="btn btn-info">
      </div>
    

    </form>
 <?php }
 
 else {
  echo '
  <center><h3>Silahkan selesaikan pembayaran anda/ Beli token di bagian menu Beli Token</h3></center>';
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
<script src="plugins/toastr/toastr.min.js"></script>
<script src="plugins/sweetalert2/sweetalert.js"></script>
<script src="plugins/sweetalert2/sweetalert.min.js"></script>
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
<script type="text/javascript">
  $(function() {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    $('.swalDefaultSuccess').click(function() {
      Toast.fire({
        type: 'success',
        title: 'ena'
      })
    });
    $('.swalDefaultInfo').click(function() {
      Toast.fire({
        type: 'info',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultError').click(function() {
      Toast.fire({
        type: 'error',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultWarning').click(function() {
      Toast.fire({
        type: 'warning',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultQuestion').click(function() {
      Toast.fire({
        type: 'question',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });

    $('.toastrDefaultSuccess').click(function() {
      toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.toastrDefaultInfo').click(function() {
      toastr.info('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.toastrDefaultError').click(function() {
      toastr.error('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.toastrDefaultWarning').click(function() {
      toastr.warning('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });

    $('.toastsDefaultDefault').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultTopLeft').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        position: 'topLeft',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultBottomRight').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        position: 'bottomRight',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultBottomLeft').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        position: 'bottomLeft',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultAutohide').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        autohide: true,
        delay: 750,
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultNotFixed').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        fixed: false,
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultFull').click(function() {
      $(document).Toasts('create', {
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        icon: 'fas fa-envelope fa-lg',
      })
    });
    $('.toastsDefaultFullImage').click(function() {
      $(document).Toasts('create', {
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        image: '../../dist/img/user3-128x128.jpg',
        imageAlt: 'User Picture',
      })
    });
    $('.toastsDefaultSuccess').click(function() {
      $(document).Toasts('create', {
        class: 'bg-success',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'ena ena'
      })
    });
    $('.toastsDefaultInfo').click(function() {
      $(document).Toasts('create', {
        class: 'bg-info',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'mantap'
      })
    });
    $('.toastsDefaultWarning').click(function() {
      $(document).Toasts('create', {
        class: 'bg-warning',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultDanger').click(function() {
      $(document).Toasts('create', {
        class: 'bg-danger',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultMaroon').click(function() {
      $(document).Toasts('create', {
        class: 'bg-maroon',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
  });

</script>
</body>
</html>
