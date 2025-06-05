<?php
include_once("koneksi.php");
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
 <?php $thisPage = "input"; ?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Struk | TOKEN</title>
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
  } elseif (isset($_SESSION['succes_update']) == true) {
    echo "
    <script>
      swal('Success!', 'Anda Berhasil Update Data', 'success')
    </script>
    ";
    unset($_SESSION['succes_update']);
  }

  $result = $koneksi->query("SELECT * FROM user WHERE id=1");

  while ($data = $result->fetch_assoc()) {
    $vendor = $data['name_vendor'];
    $address = $data['address'];
    $logo = $data['path_featured_receipt'];
    $greeting_footer = $data['greeting_footer_receipt'];
  }
  ?>
<div class="wrapper">
  <!-- navbar -->
  <?php include 'side/nav_top.php'; ?>
  <!-- End navbar -->

  <!-- Main Sidebar Container -->
    <?php include 'side/side.php'; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pengaturan Struk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Struk</li>
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
              <form action="?config=update-sett-receipt" method="post" enctype="multipart/form-data">
                  <div class="row pt-3">
                    <div class="col-md-5">
                      <div class="form-group has-danger">
                      <label class="control-label">Nama Vendor</label>
                        <input type="text" class="form-control" style="border-radius:15px;" placeholder="Masukkan Nama Vendor" name="vendor" value="<?php echo $vendor; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row pt-3">
                    <div class="col-md-5">
                      <div class="form-group has-danger">
                        <label class="control-label" style="display: inline-block; margin-right: 5px;">Logo Struk</label><span style="color: red; display: inline-block;">*Disarankan UK 250px x 250px</span><br>
                        <img id="preview" src="<?php echo $logo; ?>" alt="Preview" style="max-width: 250px; max-height: 250px; margin-top: 10px;"><br><br>
                        <input type="file" class="form-control" style="border-radius:15px;" name="logo" onchange="previewImage(this)">
                      </div>
                    </div>
                  </div>
                  <div class="row pt-3">
                    <div class="col-md-5">
                      <div class="form-group has-danger">
                      <label class="control-label">Alamat</label>
                        <textarea name="address" class="form-control" style="border-radius:15px;" placeholder="Masukkan Alamat" autocomplete="off" ><?php echo $address; ?></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row pt-3">
                    <div class="col-md-5">
                      <div class="form-group has-danger">
                      <label class="control-label">Ucapan Footer</label>
                        <textarea name="greeting_footer" class="form-control" style="border-radius:15px;" placeholder="Masukkan Ucapan Footer" autocomplete="off" ><?php echo $greeting_footer; ?></textarea>
                      </div>
                    </div>
                  </div>
              <div class="float-left">
                <button type="submit" class="btn btn-info" style="border-radius:15px;" name="update"><i class="fas fa-plus" style="font-size:15px;"></i> Update</button>
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
<script src="plugins/toastr/toastr.min.js"></script>
<script src="plugins/sweetalert2/sweetalert.js"></script>
<script src="plugins/sweetalert2/sweetalert.min.js"></script>
<script src="dist/js/demo.js"></script>

<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">

    $(document).ready(function(){
      $('#dropdownList').on('change',function(){
        var optionText = $("#dropdownList option:selected").text();
        var data = optionText.split(" ")

        $('#result').val(data[6])
        
      });
    });

    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                document.getElementById('preview').src = e.target.result;
            }

            reader.readAsDataURL(input.files[0]);
        }
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
