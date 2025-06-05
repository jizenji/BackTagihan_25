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

  <style>
      input[type=number] {
      -moz-appearance: textfield;
      }
  </style>
  
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
            <h1>Generate Token Customer</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Generate Token</li>
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
              <form action="?input=prosesXX" method="post">
                
                  <div class="row pt-3">
                    <div class="col-md-5">
                      <div class="form-group has-danger">
                      <label class="control-label">ID Customer</label>
                        <select id="selects" class="form-control"  placeholder="Masukkan Nama Customer" autocomplete="off">
                                 
                        </select>
                        <input type="hidden" id="tex" class="form-control" style="border-radius:15px;"  placeholder="Masukkan Nama Customer" name="id_customer" autocomplete="off">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group has-danger">
                      <label class="control-label">Nama Customer</label>
                        <input type="text" id="nm_le" class="form-control" style="border-radius:15px;"  placeholder="Masukkan Nama Customer" name="nm_lengkap" autocomplete="off">
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="form-group has-danger">
                      <label class="control-label">Nomor Telepon</label>
                        <input type="number" id="telepon" class="form-control" style="border-radius:15px;"  placeholder="Masukkan Telepon" name="telepon" autocomplete="off">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group has-danger">
                      <label class="control-label">Alamat</label>
                        <input type="text" id="alamat" class="form-control" style="border-radius:15px;"  placeholder="Masukkan Alamat" name="alamat" autocomplete="off">
                      </div>
                    </div>
                  </div>
                <div class="row">
					<div class="col-md-5">
                      <div class="form-group has-danger">
                      <label class="control-label">Pilih Jenis Meter</label>
                      <select id="jen" class="form-control" style="border-radius:15px;" name="jenis" required>
                      <option>Pilih Meter</option> 
                      <option value="listrik">Listrik</option>
                      <option value="air">Air</option>
                      <option value="gas">Gas</option>
                      </select>
                      </div>
                    </div>
                  <div class="col-md-4">
                    <div class="form-group has-danger">
                      <label class="control-label">Meter ID</label>
                      <select class="form-control" style="border-radius:15px;" name="meter" required>
                      <option>Pilih Meter</option> 
                      <option id="dd1"></option>
                      <option id="dd2"></option>
                      <option id="dd3"></option>
                      <option id="dd4"></option>
                      </select>
                    </div>
                  </div>
                  
                </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group has-success">
                      <label class="control-label">Nilai Token</label><br>
                        <?php
                    $harga = $koneksi->query("SELECT * FROM hargacu");
                    ?>
                    <select id="dropdownList" class="form-control" style="border-radius:15px;" name="pricess" required>
                      <option value="" disabled selected>Pilih Nominal : </option>
                      <?php while($data = $harga->fetch_assoc() ){?>
                        <option value="<?= $data['total']; ?> <?= $data['ppn']; ?> <?= $data['kwh']; ?> <?= $data['id_harga'];  ?> "><?= $data['judul'];?> </option>
                      <?php } ?>
                    </select>
                    <input type="hidden" name="id_harga" id="id_harga">
                    <input type="hidden" name="kwh" id="result">
                    <input type="hidden" name="judul" id="resultj">
                    <input type="hidden" name="ppn" id="resultp">
                    <input type="hidden" name="price" id="resultn">
                      </div>
                    </div>
                  </div>
                  <br>
              <div class="float-left">
                <button type="submit" class="btn btn-info" style="border-radius:15px;" name="Submit"><i class="fas fa-plus" style="font-size:15px;"></i> Generate</button>
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

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">

    $(document).ready(function(){
      $('#dropdownList').on('change',function(){
        var optionText = $("#dropdownList option:selected").text();
        var data = optionText.split(" ")

        var optionVal = $("#dropdownList option:selected").val();
        var datas = optionVal.split(" ")

        $('#result').val(datas[2])

        $('#resultj').val(optionText)

        $('#resultp').val(datas[1])

        $('#resultn').val(datas[0])

        $('#id_harga').val(datas[3])
        
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

  $(document).ready(function () {
            $('#selects').select2({
                allowClear: true,
                placeholder: 'Cari Id Customer',
                ajax: {
                    dataType: 'json',
                    url: 'ajax.php',
                    delay: 800,
                    data: function (params) {
                        return {
                            search: params.term
                        }
                    },
                    processResults: function (data, page) {
                        return {
                            results: data,

                           
                        };
                        console.log(data['id']) 
                    },
                }
            })

            $('#selects').on('select2:select', function (e) {
              var data = e.params.data;
              var op = $('#selects').text();
              $('#tex').val(data['text']);
              $('#nm_le').val(data['nm_lengkap']);
              $('#telepon').val(data['telepon']);
              $('#alamat').val(data['alamat']);
              
           });
           
           $("#jen").change(function(){ 
      
          $.ajax({
            type: "POST", 
            url: "ajaxx.php", 
            data: {id : $("#tex").val(),jenis : $("#jen").val() }, 
            dataType: "json",
            beforeSend: function(e) {
              if(e && e.overrideMimeType) {
                e.overrideMimeType("application/json;charset=UTF-8");
              }
            },
            success: function(data){ 
                $('#dd1').text(data[0].metersatu);
                $('#dd2').text(data[0].meterdua);
                $('#dd3').text(data[0].metertiga);
                $('#dd4').text(data[0].meterempat);
            },
            error: function (xhr, ajaxOptions, thrownError) { 
              alert(thrownError); 
            }
          });
        });
        });

</script>
</body>
</html>
