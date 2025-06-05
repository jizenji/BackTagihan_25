<?php
require("koneksi.php");
// error_reporting(0);
session_start();
date_default_timezone_set('Asia/Jakarta');

if ($_SESSION['level'] != 'customer') {
  die('<script>alert("Anda Bukan Customer");window.location = "customer/logout.php";</script>');
}



$config = $koneksi->query("SELECT * FROM config ORDER BY id_config desc");
          $resconfig = $config->fetch_array();

$waktu_skrng = date("H:i:s"); //timestamp
?>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CEK METERAN | TOKEN</title>
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
  if (isset($_SESSION['success_check']) == 1) {
    echo '
    <script>
      swal("Success!", "'.$_SESSION['desc_check'].'", "success")
    </script>
    ';
    // unset($_SESSION['success_check']);
    // unset($_SESSION['desc_check']);
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
            <h1>Cek Meteran</h1>
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
              <form action="?part-customer=process-check" method="post">
              
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group has-success">
                        <?php
                        $ids = $_SESSION['id'];
                        $choice = $_SESSION['choice'];
                        
                        $meter = $koneksi->query("SELECT * FROM data_customer WHERE id='$ids'");
                        ?>
                        
                        <br>
                        <label class="control-label">Nomor Meter</label><br>
                        <select id="dropdownList" class="form-control" style="border-radius:15px;" name="meter" required>
                        <option value="" disabled selected>Pilih Nomor Meter : </option>
                        <?php while($data = $meter->fetch_array() ){

                            if ($choice == "listrik") {
                            $meter1 = $data['metersatul'];
                            $meter2 = $data['meterdual'];
                            $meter3 = $data['metertigal'];
                            $meter4 = $data['meterempatl'];
                            } elseif ($choice == "air") {
                            $meter1 = $data['metersatua'];
                            $meter2 = $data['meterduaa'];
                            $meter3 = $data['metertigaa'];
                            $meter4 = $data['meterempata'];
                            } elseif ($choice == "gas") {
                            $meter1 = $data['metersatug'];
                            $meter2 = $data['meterduag'];
                            $meter3 = $data['metertigag'];
                            $meter4 = $data['meterempatg'];
                            } 

                            $dup = array_unique($data);

                            if ($meter1 != null) {    
                              ?>
                              <option value="<?= $meter1;  ?>"><?= $meter1;?> </option>
                              <?php } else {
                                  
                              } 
  
                            if ($meter2 != null) {  
                            ?>
                            
                            <option value="<?= $meter2;  ?>"><?= $meter2;?> </option>
                            <?php } else {
                                
                            } 

                            if ($meter3 != null) { 
                            ?>
                            <option value="<?= $meter3;  ?>"><?= $meter3;?> </option>

                            <?php } else {
                                
                            } 

                            if ($meter4 != null) { 
                            ?>
                              <option value="<?= $meter4;  ?>"><?= $meter4;?> </option>
                          <?php } else { } } ?>
                        </select>  
                        <br>
                
                    <div class="float-left">
                        <button type="submit" class="btn btn-info" style="border-radius:15px;" name="proses-veriff"><i class="fas fa-plus" style="font-size:15px;"></i> Cek</button>
                    </div><br><br><br>
                  
            </form>
            
              </div>
            </div>
          </div>
          <?php
          if (isset($_SESSION['success_check']) == 1) {
 
          ?>
  
          <p>==============================================</p>
          <h4>Hasil Cek Meter</h4>
          <b><p>KWh Meter       :<?php echo $_SESSION['result_on']; ?></p></b>
          <b><p>Pemakaian       :<?php echo $_SESSION['result_th']; ?></p></b>
          <b><p>Total KWh Meter : <?php echo $_SESSION['result_tw']; ?></p></b>
          <p><b>Status          : Normal</b></p>

           <?php 
           unset($_SESSION['success_check']);
           unset($_SESSION['result_on']);
           unset($_SESSION['result_th']);
           unset($_SESSION['result_tw']); 
           } elseif (isset($_SESSION['success_check']) == 2)  {



           ?>
          <p>==============================================</p>
          <h4>Maaf Server Offline</h4>

           <?php unset($_SESSION['success_check']); } ?>
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

  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">

    $(document).ready(function(){
      $('#dropdownList').on('change',function(){
        var optionText = $("#dropdownList option:selected").val();
        var text = $("#dropdownList option:selected").text();
        var data = optionText.split(" ")

        var option = $("#dropdownList option:selected").val();
        var datas = option.split(" ")

        $('#result').val(data[2])
        $('#id_harga').val(datas[1])
        $('#resultj').val(text)
        $('#resultp').val(data[3])



      });
    });
    </script>

<script type="text/javascript">
$(document).ready(function () {
  bsCustomFileInput.init();
});
</script>
<script type="text/javascript">
  $(function() {
   

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
