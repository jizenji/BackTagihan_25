<?php
require("koneksi.php");
include 'func.absen.php';
session_start();
date_default_timezone_set('Asia/Jakarta');


if(!isset($_SESSION['username'])) {
   header('location:?part-customer=login');
} else {
   $username = $_SESSION['username'];
}

if ($_SESSION['level'] != 'customer') {
  die('<script>alert("Anda Bukan Customer");window.location = "customer/logout.php";</script>');
}

$config = $koneksi->query("SELECT * FROM config ORDER BY id_config desc");
          $resconfig = $config->fetch_array();

$waktu_skrng = date("H:i:s"); //timestamp
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="assets/js/sweetalert.js"></script>
  <title>Web Token</title>
</head>
<body class="hold-transition sidebar-mini" onload="startTime();">
<?php 
    if (isset($_SESSION['succes_izin']) == 1) {
      echo "
      <script> 
        swal('Success!', 'Anda Berhasil izin', 'success')
      </script>";
      unset($_SESSION['succes_izin']);
    }
?>
<div class="wrapper">
  <!-- navbar -->
  <?php include 'side/layout_customer/navbar_customer.php'; ?>
  <!-- End navbar -->

  <!-- Main Sidebar Container -->
  <?php include 'side/layout_customer/sidebar_customer.php'; ?>
  <!-- End Sidebar -->
<div class="content-wrapper">

<br>
    <section class="content">
        <div class="container">
            <div class="col-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline card-info">
                            <div class="card-header">
                                <h2 class="card-title">
                                Payment Proses 
                                </h2>
                            </div>

                            <div align="center">
                              
                                
                                
                                <br>
                                <h1> Terima Kasih</h1>
                                
                                <!-- <?= $_GET['trx_id'] ? "id_transaksi :  $_GET[trx_id] <br>" : NULL; ?>
                                <?= $_GET['status'] ? "Status :  $_GET[status] <br>" : NULL; ?> -->
                                <li>Pembayaran Sedang Diproses ( Jika Sudah Melakukan Pembayaran Silahkan Input Nomer Meter Dibagian Menu Claim Token!! )</li>
                                <li>Jika Ada Problem Silahkan Hubungi Admin</li><br>



                                <?php
                                // $trx = $_GET['trx_id'];
                                // $status = $_GET['status'];
                                // $uniq = $_GET['uniqamount'];  
                                // $row = $koneksi->query("UPDATE laporan_cu SET status='$status',uniq='$uniq',trx='$trx' ORDER BY id DESC LIMIT 1");

                                // if ($status == "pending"){
                                    
                                        
                                //         $apis = $koneksi->query("SELECT * FROM api ORDER BY id DESC LIMIT 1");
                                //         while ($ale = $apis->fetch_assoc()) {
                                //           $api = $ale['api'];
                                //         }
                                        
                                //         $ses = $_SESSION['id'];
                                      
                                     
                                //       while ($dat = $sess->fetch_assoc()) {
                                //         $number=$dat['telepon'];
                                //       }

                                //         $curl = curl_init();

                                //         $datas = $koneksi->query("SELECT * FROM laporan_cu ORDER BY id DESC LIMIT 1");
                                          
                                //         while ($data = mysqli_fetch_assoc($datas)){
                  
                                //         $res = substr($data['token'], 1,24);
                                //         $nama = $_SESSION['nm_lengkap'];
                                //         $trx = $data['trx'];
                                //         $kata1 = "Terima Kasih Telah Bertransaksi Dengan tagihan.id";
                                //         $kata3 = "No. Transaksi:";                                       
                                //         $kata5 = "Rp.";
                                //         $kata6 = "/";
                                //         $kata7 = "Kwh";
                                //         $kata8 = "Segera Melakukan Pembayaran, Untuk Mendapatkan Token.";
                                //         $kata9 = "Transaksi Akan Kami Hapus Dalam 1x24 Jam.";
                                //         $kata10 = "Terima Kasih.";
                                //         $price = $data['price'];
                                //         $kwh = $data['amount'];
                                //         $zero = date("l ").date("d-m-Y ") . date("h:i:s a");
                                        
                                //         }
                                      
                                                                        

                                //         curl_setopt_array($curl, array(
                                //         CURLOPT_URL => "https://panel.rapiwha.com/send_message.php?apikey=".$api."&number=".$number."&text=".urlencode($kata1)."%0A".urlencode($nama)."%0A%0A".urlencode($kata2)."%20".urlencode($meter)."%0A".urlencode($kata3)."%20".urlencode($trx)."%0A".urlencode($kata5)."%20".urlencode($price)."%20".urlencode($kata6)."%20".urlencode($kwh)."%20".urlencode($kata7)."%0A"."Tanggal:"."%20".urlencode($zero)."%0A%0A".urlencode($kata8)."%0A%0A".urlencode($kata9)."%0A".urlencode($kata10),
                                //           CURLOPT_RETURNTRANSFER => true,
                                //           CURLOPT_ENCODING => "",
                                //           CURLOPT_MAXREDIRS => 10,
                                //           CURLOPT_TIMEOUT => 30,
                                //           CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                //           CURLOPT_CUSTOMREQUEST => "GET",
                                //         ));

                                //         $response = curl_exec($curl);
                                //         $err = curl_error($curl);

                                //         curl_close($curl);
                                        
                                        
                                              
                                // }
                //                  elseif ($status == "gagal") {
                //                   $apis = $koneksi->query("SELECT * FROM api ORDER BY id DESC LIMIT 1");
                //                         while ($ale = $apis->fetch_assoc()) {
                //                           $api = $ale['api'];
                //                         }
                                        
                //                         $ses = $_SESSION['id'];
                                      
                                     
                //                       while ($dat = $sess->fetch_assoc()) {
                //                         $number=$dat['telepon'];
                //                       }

                //                         $curl = curl_init();

                //                         $datas = $koneksi->query("SELECT * FROM laporan_cu ORDER BY id DESC LIMIT 1");
                                          
                //                         while ($data = mysqli_fetch_assoc($datas)){
                  
                //                         $res = substr($data['token'], 1,24);
                //                         $nama = $_SESSION['nm_lengkap'];
                //                         $trx = $data['trx'];
                //                         $kata1 = "Transaksi Gagal";
                //                         $kata3 = "No. Transaksi:";                                       
                //                         $kata5 = "Rp.";
                //                         $kata6 = "/";
                //                         $kata7 = "Kwh";
                //                         $kata8 = "Silahkan Menghubungi Admin, Dibagian Menu Kontak Admin";
                //                         $kata10 = "Terima Kasih.";
                //                         $price = $data['price'];
                //                         $kwh = $data['amount'];
                //                         $zero = date("l ").date("d-m-Y ") . date("h:i:s a");
                                        
                // }
                                      
                                                                        

                //                         curl_setopt_array($curl, array(
                //                         CURLOPT_URL => "https://panel.rapiwha.com/send_message.php?apikey=".$api."&number=".$number."&text=".urlencode($kata1)."%0A".urlencode($nama)."%0A%0A".urlencode($kata2)."%20".urlencode($meter)."%0A".urlencode($kata3)."%20".urlencode($trx)."%0A".urlencode($kata5)."%20".urlencode($price)."%20".urlencode($kata6)."%20".urlencode($kwh)."%20".urlencode($kata7)."%0A"."Tanggal:"."%20".urlencode($zero)."%0A%0A".urlencode($kata8)."%0A%0A".urlencode($kata10),
                //                           CURLOPT_RETURNTRANSFER => true,
                //                           CURLOPT_ENCODING => "",
                //                           CURLOPT_MAXREDIRS => 10,
                //                           CURLOPT_TIMEOUT => 30,
                //                           CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                //                           CURLOPT_CUSTOMREQUEST => "GET",
                //                         ));

                //                         $response = curl_exec($curl);
                //                         $err = curl_error($curl);

                //                         curl_close($curl);

                                       
                //                 }
                                 ?>
                                
                            </div>
                        </div>
                    </div>
                    <!-- /.col-->
                </div>
                <!-- ./row -->
            </div>
        </div>
    </section>

</div>




  <!-- Footer -->
  <?php include 'side/footer.php';?>
  <!-- End Footer -->
</div>
<script>
function startTime() {
  var today = new Date();
  var h = today.getHours();
  var m = today.getMinutes();
  var s = today.getSeconds();
  m = checkTime(m);
  s = checkTime(s);
  document.getElementById('time').innerHTML =
  h + ":" + m + ":" + s;
  var t = setTimeout(startTime, 500);
}
function checkTime(i) {
  if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
  return i;
}
</script>
<script src="plugins/geo/geoPosition.js" type="text/javascript" charset="utf-8"></script>
<script src="plugins/geo/geoPositionSimulator.js" type="text/javascript" charset="utf-8"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/demo.js"></script>
</body>
</html>
