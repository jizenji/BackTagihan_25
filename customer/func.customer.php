<?php 
include 'koneksi.php';
session_start();
error_reporting(0);
require 'vendor/autoload.php';
require_once 'vendor/dompdf/dompdf/src/Autoloader.php'; 
use Dompdf\Dompdf;

date_default_timezone_set('Asia/Jakarta');

function loginCustomer($koneksi){
  if(isset($_POST['submit'])) {
    $username = addslashes($_POST['username']);
    $pass = $_POST['password'];
    $myToken = bin2hex(openssl_random_pseudo_bytes(24));
    $tanggal_sekarang = date("Y-m-d");
    $tgllogin = "UPDATE data_customer set last_login='$tanggal_sekarang' where username = '$username'";
    $sql = "SELECT data_customer.*,DATE_FORMAT(last_login,'%d %M %Y') as lastlogin FROM data_customer WHERE username = '$username'";
    $query = $koneksi->query($sql);
    $hasil = $query->fetch_assoc();
    if($query->num_rows == false) {
      $_SESSION['unregis'] = true;
      header('location:?part-customer=index');
    } else {
      if($pass <> $hasil['password']) {
        $_SESSION['wrong_password'] = true;
        header('location:?part-customer=login');
      }  else {  
           $result = $koneksi->query($tgllogin);
           $_SESSION['id_customer'] = $hasil['id_customer'];
           $_SESSION['username'] = $hasil['username'];
           $_SESSION['alamat'] = $hasil['alamat'];
           $_SESSION['telepon'] = $hasil['telepon'];
           $_SESSION['id_C'] = $hasil['id_C'];
           $_SESSION['id'] = $hasil['id'];
           $_SESSION['id_customer'] = $hasil['id_customer'];
           $_SESSION['nm_lengkap'] = $hasil['nm_lengkap'];
           $_SESSION['level'] = "customer";
           $_SESSION['succes_login'] = 1;
           $_SESSION['last_login'] = $hasil['last_login'];
           $_SESSION['token'] = $myToken;
           header('location:?part-customer=choice');
         }
       }
     }
   }

function choices() {
  $_SESSION['choice'] = $_GET['choice'];

  header('location:?part-customer=index');
}

function redChoices() {
  unset($_SESSION['choice']);
 
  header('location:?part-customer=choice');
}


function prosesVerif($koneksi){
  if (isset($_POST['proses-veriff'])) {

      $id = $_POST['id'];

      $query = "SELECT harga, ppn, admin, kwh FROM hargacu WHERE id_harga='$id'";
      $result = $koneksi->query($query);

      $row = $result->fetch_assoc();
      $price_token = $row['harga'];
      $ppn = $row['ppn'];
      $admin = $row['admin'];
      $kwh = $row['kwh'];
      $price = $_POST['price'];
      
      $id_c = $_POST['id_c'];
      $id_customer = $_POST['id_customer'];
      $jenis_meter = $_SESSION['choice'];
      $judul = $_POST['judul'];
      $meter = $_POST['meter'];
      $nama = $_POST['nama'];
      $alamat = $_POST['alamat'];
      $telepon = $_POST['telepon'];
      $stat = "pending";

      $time = date("his");
      $inv = 'INV-'.$time;

      $date = date('Y-m-d');
      $end_date = date('Y-m-d', strtotime($date . ' +1 day'));

      $result = $koneksi->query("INSERT INTO laporan_cu (id_C, id_for, id_customer, invoice, nama, alamat, telepon, jenis_meter, judul, meter, price, price_token, ppn , admin, amount, status, expire_at) VALUES ('$id_c', '$id', '$id_customer', '$inv', '$nama', '$alamat', '$telepon', '$jenis_meter', '$judul', '$meter', '$price', '$price_token', '$ppn', '$admin', '$kwh', '$stat', '$end_date')");

      if ($result === true) {
        echo "<script>alert('Konfirmasi Pembelian');document.location='?part-customer=confirm'</script>";
      } else {
        echo "fail";
      }
  }
}




function prosesBuy($koneksi){
  if (isset($_POST['proses-b'])) {
    $nominal = $_POST['price'];
    $inv = $_POST['invoice'];

    $va           = '0000005720505555'; 
    $secret       = 'SANDBOX9A39CB4E-A455-4DF3-BDC3-18B94F82E28E-20211229102112'; 
    $url          = 'https://sandbox.ipaymu.com/api/v2/payment'; 
    $method       = 'POST'; 

    $body['product']    = ['Token Listrik'];
    $body['qty']        = ['1'];
    $body['price']      = [$nominal];
    $body['referenceId']  = $inv;
    $body['returnUrl']  = 'https://tagihan.bikinaja.id/?part-customer=history';
    $body['cancelUrl']  = 'https://tagihan.bikinaja.id/?part-customer=history';
    $body['notifyUrl']  = 'https://tagihan.bikinaja.id/?part-customer=notify';

    $jsonBody     = json_encode($body, JSON_UNESCAPED_SLASHES, $nominal);
    $requestBody  = strtolower(hash('sha256', $jsonBody));
    $stringToSign = strtoupper($method) . ':' . $va . ':' . $requestBody . ':' . $secret;
    $signature    = hash_hmac('sha256', $stringToSign, $secret);
    $timestamp    = Date('YmdHis');
    
    $ch = curl_init($url);

    $headers = array(
        'Accept: application/json',
        'Content-Type: application/json',
        'va: ' . $va,
        'signature: ' . $signature,
        'timestamp: ' . $timestamp
    );

    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, count($body));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonBody);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $err = curl_error($ch);
    $ret = curl_exec($ch);
    curl_close($ch);
    if($err) {
        echo $err;
    } else {

        //Response
        $ret = json_decode($ret);
        if($ret->Status == 200) {
            $sessionId  = $ret->Data->SessionID;
            $url        =  $ret->Data->Url;
            // echo json_encode($ret);die();
            // $price = $nominal;
            header('Location:' . $url);
        } else {
            echo "<script>alert('Proses Gagal, Cek Internet Anda!');document.location='?part-customer=confirm'</script>";
        }
    }

  }

}

function prosesNotify($koneksi){
  $data = file_get_contents('php://input');

  parse_str($data, $output);

  $code = $output['status_code'];
  
  
  if ($code == 1){

    $ref = $output['reference_id'];
    $status = $output['status'];
    $zero = date("d-m-Y ") . date("h:i:s a");

    $qry = $koneksi->query("SELECT * FROM laporan_cu WHERE invoice='$ref'");
    $fetch = $qry->fetch_array();

    if ($fetch['status'] == "pending") {

        $ch1 = curl_init();
        $headers  = [
                        
                        'Content-Type: application/json'
                    ];
        
        
        $postData1 = [
            
                "CompanyName" => "saitec",
                "UserName" => "Admin007",
                "PassWord" => "SAI123#",
                "MeterID" => $fetch['meter'],
                "is_vend_by_unit" => true,
                "Amount" => $fetch['amount']
        
        ];
        
        curl_setopt($ch1, CURLOPT_URL,"http://www.server-api.stronpower.com/api/VendingMeter");
        curl_setopt($ch1, CURLOPT_POST, 1);
        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch1, CURLOPT_POSTFIELDS, json_encode($postData1));           
        curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers);
        $token_api     = curl_exec ($ch1);
        $status     = curl_getinfo($ch1, CURLINFO_HTTP_CODE);
        
        curl_close ($ch1);

        $tp = json_decode($token_api);
      
        $resulttk = $tp[0]->Token;

        $ch2 = curl_init();

        $postData2 = [
                  
          "CompanyName" => "saitec",
          "UserName" => "Admin007",
          "PassWord" => "SAI123#",
          "MeterID" => $fetch['meter'],
          "Token" => $resulttk,

        ];

        curl_setopt($ch2, CURLOPT_URL,"http://www.server-api.stronpower.com/api/VendingMeterSendToken");
        curl_setopt($ch2, CURLOPT_POST, 1);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch2, CURLOPT_POSTFIELDS, json_encode($postData2));           
        curl_setopt($ch2, CURLOPT_HTTPHEADER, $headers);
        $responses     = curl_exec ($ch2);
        
        curl_close ($ch2);

        $query = $koneksi->query("UPDATE laporan_cu SET token='$resulttk', tanggal='$zero', status='diclaim', status_vending='false' WHERE invoice='$ref'");

        if ($responses == '"Recharge Successfully!"') {

          $querys = $koneksi->query("UPDATE laporan_cu SET status_vending='true' WHERE id='$ref'");
          echo "success inject";
        } else {
          echo "fail inject";
        }
    }

  }

  else {
    echo "fail";
  }


}

function prosesClaim($koneksi){
  if (isset($_POST['proses'])) { 
    
      $session = $_POST['sessio'];
      $choice = $_POST['choice'];
      $querys = $koneksi->query("SELECT * FROM laporan_cu WHERE id_C='$session' ORDER BY id DESC LIMIT 1");

      $fetch = $querys->fetch_array();
     
      $kwh = $fetch['amount'];
      $price = $fetch['price'];
      $meter = $fetch['meter'];

      $ch1 = curl_init();
      $headers  = [
                      
                      'Content-Type: application/json'
                  ];
      
      
      $postData1 = [
          
              "CompanyName" => "saitec",
              "UserName" => "Admin007",
              "PassWord" => "SAI123#",
              "MeterID" => $meter,
              "is_vend_by_unit" => false,
              "Amount" => $kwh
      
      ];
      
      curl_setopt($ch1, CURLOPT_URL,"http://www.server-api.stronpower.com/api/VendingMeter");
      curl_setopt($ch1, CURLOPT_POST, 1);
      curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch1, CURLOPT_POSTFIELDS, json_encode($postData1));           
      curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers);
      $token_api     = curl_exec ($ch1);
      $status     = curl_getinfo($ch1, CURLINFO_HTTP_CODE);
      
      curl_close ($ch1);
      
      $tp = json_decode($token_api);
      
      $resulttk = $tp[0]->Token;

      $zero = date("l ").date("d-m-Y ") . date("h:i:s a");
      $sesi = $_SESSION['id'];
      $alamat = $_SESSION['alamat'];
      $telepon = $_SESSION['telepon'];
      $nama = $_SESSION['nm_lengkap'];
      $year = date("Y");     

        if($resulttk == '""'){
        
            echo "<script>alert('Gagal Generate, Silahkan Cek Koneksi Internet Anda/Invalid Token');document.location='?part-customer=claim'</script>";
          
        }

        
        else{
          
          $result = $koneksi->query("UPDATE laporan_cu SET id_C='$sesi', nama='$nama',alamat='$alamat',telepon='$telepon',meter='$meter',price='$price',rate='$rate',token='$resulttk',tanggal='$zero', status='diclaim', status_vending='false' ORDER BY id DESC LIMIT 1");
            echo "<script>alert('Berhasil Claim Token!');document.location='?part-customer=history'</script>";

            $apis = $koneksi->query("SELECT * FROM api ORDER BY id DESC LIMIT 1");

            while ($root = $apis->fetch_assoc()) {
              $api = $root['api'];
            }

          $ses = $_SESSION['id'];
          
          $sess = $koneksi->query("SELECT * FROM data_customer WHERE id='$ses'");
          while ($dat = $sess->fetch_assoc()) {
            $number=$dat['telepon'];
          }

            $curl = curl_init();

            $datas = $koneksi->query("SELECT * FROM laporan_cu ORDER BY id DESC LIMIT 1");
              
            while ($data = mysqli_fetch_assoc($datas)){

            $res = substr($data['token'], 1,24);
            $nama = $data['nama'];
            $trx = $data['trx'];
            $kata1 = "Selamat Pembelian Anda Berhasil..!!";
            $kata2 = "Id Meteran:";
            $kata3 = "No. Transaksi:";
            $kata4 = "Terima Kasih Telah Menggunakan tagihan.id";
            $kata5 = "Rp.";
            $kata6 = "/";
            $kata7 = "Kwh";
            $meter = $data['meter'];
            $price = $data['price'];
            $kwh = $data['amount'];
            

            }
                

            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://panel.rapiwha.com/send_message.php?apikey=".$api."&number=".$number."&text=".urlencode($kata1)."%0A".urlencode($nama)."%0A%0A".urlencode($kata2)."%20".urlencode($meter)."%0A".urlencode($kata3)."%20".urlencode($trx)."%0A".urlencode($kata5)."%20".urlencode($price)."%20".urlencode($kata6)."%20".urlencode($kwh)."%20".urlencode($kata7)."%0A"."Token:"."%20".urlencode($res)."%0A"."Tanggal:"."%20".urlencode($zero)."%0A%0A".urlencode($kata4),
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "GET",
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
              echo "cURL Error #:" . $err;
            } else {
              echo $response;
            }
          
        }

    }
  }

                              
function delete_his($koneksi){
  if(isset($_POST['delete'])){

    if(isset($_POST['pilih'])){
      
      foreach($_POST['pilih'] as $deleteid){
  
        $deleteUser = "DELETE FROM laporan_cu WHERE id=".$deleteid;
        $tes = mysqli_query($koneksi,$deleteUser);

        $_SESSION['msg'] = "Succes Delete  !!";
        $_SESSION['msg_type'] = "danger";
        header("location:?part-customer=history");
      }
    }
   
  }

  else {
      echo "fail but delete";
  }
}

function export($koneksi) {

  $id = $_GET['id'];
  $id_customer = $_SESSION['id'];
  
  $resultt = $koneksi->query("SELECT * FROM laporan_cu WHERE id='$id'");

  $query_d = $koneksi->query("SELECT * FROM data_customer WHERE id='$id_customer'");
  $fetch_d = $query_d->fetch_array();

  $template_id = $fetch_d['template_invoice_id'];

  $query = $koneksi->query("SELECT * FROM template_invoice WHERE id='$template_id'");
  $fetch = $query->fetch_array();

  $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
  $domainName = $_SERVER['HTTP_HOST'];
  $merge = $protocol . $domainName;
  
  while ($data = mysqli_fetch_assoc($resultt)){
  
  if ($data['jenis_meter'] == "listrik") {
    $rest = "Kwh";
  } elseif ($data['jenis_meter'] == "air") {
    $rest = "M3";
  }

  $total = $data['ppn'] + $data['price'];
  
  $html = '
  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Tagihan</title>
    <style>
        body {
          width: 58mm; 
          margin: 0 auto;
          padding: 10px;
          box-sizing: border-box; 
        }
        .all {
            border: 1px solid black;
            padding: 5px;
            box-sizing: border-box; 
        }
        header {
            text-align: center;
        }
        header img {
            display: block;
            margin: 0 auto;
            width: 100px;
        }
        header h3 {
            margin: 0;
        }
        header h3, header h6 {
          margin: 0;
          word-wrap: break-word; 
          word-break: break-all;
        }
        main {
            display: block;
        }
        .isi, .isi-2 {
            display: inline-block;
            vertical-align: top;
        }
        .isi {
            width: 34%;
        }
        .isi-2 {
            width: 60%;
        }
        p {
            font-size: 8.5px;
            margin: 0; 
        }
        .total {
            text-align: center;
            font-size: 18px;
        }
        .total h5 {
            margin: 10px;
            font-size: 12px;
        }
        .token {
            text-align: center;
        }
        .token h3 {
            margin: 10px;
            font-size: 12px;
        }
        .thx p {
            text-align: center;
        }
        header, main, footer {
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>

	<div class="all">
		<header>
			<img src="'.$merge.'/'.$fetch['path_featured_receipt'].'">
			<h3>'.$fetch['name_vendor'].'</h3>
      <h6>'.$fetch['address'].'</h6>
		</header>
	
		<hr>
	
		<main id="main-content">
			<div class="isi">
				<p>Tanggal Transaksi </p>
				<p>ID Pelanggan</p>
				<p>Jenis Meteran</p>
				<p>Jumlah/'.$rest.'  </p>
				<p>Harga </p>
				<p>PPN </p>
				<p>Admin </p>
			</div>
			<div class="isi-2">
				<p id="tanggal-transaksi">: '.$data['tanggal'].' </p>
				<p id="id-pelanggan">: '.$data['meter'].' </p>
				<p id="jenis-meteran">: '.$data['jenis_meter'].'</p>
				<p id="jumlah-kwh">: '.$data['amount'].'</p>
				<p id="harga">: '.number_format($data['price_token'], 0, ',', '.').'</p>
				<p id="ppn">: '.number_format($data['ppn'], 0, ',', '.').'</p>
				<p id="admin">: '.number_format($data['admin'], 0, ',', '.').'</p>
			</div>
		</main>
	
		<hr>
	
		<footer>
			<div class="total">
				<h5>Total Pembayaran</h5>
				<h5 id="total-pembayaran">'.number_format($data['price'], 0, ',', '.').'</h5>
			</div>
			<hr>
			<div class="token">
				<h3>TOKEN</h3>
				<h3 id="token-value">'.$data['token'].'</h3>
			</div>
			<hr>
			<div class="thx">
				<p>'.$fetch['greeting_footer_receipt'].'</p>
			</div>
		</footer>
	</div>

    <script src="dist/tes.js">

</body>
</html>

  
  '
  
  ;
  
  }
  
  $dompdf = new Dompdf();
  $dompdf->loadHtml($html);
  $dompdf->set_option('isRemoteEnabled', TRUE);
  $dompdf->setPaper('A4', 'potrait');
  $dompdf->render();
  $dompdf->stream();
  
  }

function processCheck($koneksi) {

  $meter = $_POST['meter'];

  $ch1 = curl_init();
  $headers  = [
                  
                  'Content-Type: application/json'
      ];

	$postData1 = [

    "CompanyName" => "saitec",
    "UserName" => "Admin007",
    "PassWord" => "123456",
    "MeterId" => $meter

	];

	curl_setopt($ch1, CURLOPT_URL,"http://www.server-api.stronpower.com/api/QueryMeterDataRealTime");
	curl_setopt($ch1, CURLOPT_POST, 1);
	curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch1, CURLOPT_POSTFIELDS, json_encode($postData1));           
	curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers);
	$data     = curl_exec ($ch1);
	$status     = curl_getinfo($ch1, CURLINFO_HTTP_CODE);
	
	curl_close ($ch1);

  $regex_on = '/Residual_Amount : ([\d.]+) kWh/';
  $regex_tw = '/Cumulative_Total_kWh_Consumption : ([\d.]+) kWh/';
  $regex_th = '/Cumulative_Purchased_Amount : ([\d.]+) kWh/';
  $regex_fr = '/Cover_State : (.)/';

  preg_match($regex_on, $data, $result_on);
  preg_match($regex_tw, $data, $result_tw);
  preg_match($regex_th, $data, $result_th);
  preg_match($regex_fr, $data, $result_fr);

  if ($result_fr[1] == "N") {
      $_SESSION['success_check'] = 1;
      $_SESSION['result_on'] = $result_on[1];
      $_SESSION['result_tw'] = $result_tw[1];
      $_SESSION['result_th'] = $result_th[1];
      echo '<script>document.location="?part-customer=check-meter"</script>';
  } else {
      $_SESSION['success_check'] = 2;
      echo '<script>document.location="?part-customer=check-meter"</script>';
  }

}


function realtimeVend($koneksi) {

  $id = $_GET['id'];
	$token = $_GET['tkn'];
  $meter = $_GET['meter'];

  $ch1 = curl_init();
  $headers  = [
                  
                  'Content-Type: application/json'
      ];

	$postData1 = [
            
		"CompanyName" => "saitec",
		"UserName" => "Admin007",
		"PassWord" => "123456",
		"MeterID" => $meter,
		"Token" => $token,

	];

	curl_setopt($ch1, CURLOPT_URL,"http://www.server-api.stronpower.com/api/VendingMeterSendToken");
	curl_setopt($ch1, CURLOPT_POST, 1);
	curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch1, CURLOPT_POSTFIELDS, json_encode($postData1));           
	curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers);
	$token_api     = curl_exec ($ch1);
	$status     = curl_getinfo($ch1, CURLINFO_HTTP_CODE);
	
	curl_close ($ch1);

  $ch2 = curl_init();

	$postData2 = [

    "CompanyName" => "saitec",
    "UserName" => "Admin007",
    "PassWord" => "123456",
    "MeterId" => $meter

	];

	curl_setopt($ch2, CURLOPT_URL,"http://www.server-api.stronpower.com/api/QueryMeterDataRealTime");
	curl_setopt($ch2, CURLOPT_POST, 1);
	curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch2, CURLOPT_POSTFIELDS, json_encode($postData2));           
	curl_setopt($ch2, CURLOPT_HTTPHEADER, $headers);
	$data     = curl_exec ($ch2);
	
	curl_close ($ch2);

  $regex_on = '/Residual_Amount : ([\d.]+) kWh/';
  $regex_tw = '/Cumulative_Total_kWh_Consumption : ([\d.]+) kWh/';
  $regex_th = '/Cumulative_Purchased_Amount : ([\d.]+) kWh/';
  $regex_fr = '/Cover_State : (.)/';

  preg_match($regex_on, $data, $result_on);
  preg_match($regex_tw, $data, $result_tw);
  preg_match($regex_th, $data, $result_th);
  preg_match($regex_fr, $data, $result_fr);

  if ($token_api == '"Recharge Successfully!"') {

    $result = $koneksi->query("UPDATE laporan_cu SET status_vending='true' WHERE id='$id'");
    echo '<script>alert("Realtime Isi Berhasil \nKWh Meter : '.$result_on[1].'\nPemakaian : '.$result_tw[1].'\nTotal KWh Meter : '.$result_th[1].'\nStatus : Normal");document.location="?part-customer=history"</script>';
  } else {

    echo "<script>alert('Realtime Isi Gagal, Silahkan Isi Manual');document.location='?part-customer=history'</script>";
  }

}

function updateSetReceipt($koneksi){

  if(isset($_POST['update'])) {

      $greeting_footer = $_POST['greeting_footer'];
      $vendor = $_POST['vendor'];
      $address = $_POST['address'];
      $id = $_POST['id'];

      $target_dir = "uploads/receipt/logo/";
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($_FILES["logo"]["name"], PATHINFO_EXTENSION));
      $check = getimagesize($_FILES["logo"]["tmp_name"]);

  if ($imageFileType != null) {

          if ($check === false) {
              $uploadOk = 0;
              echo "<script>alert('File bukan gambar.');document.location='?part-customer=setting-receipt'</script>";
          }
          elseif ($_FILES["logo"]["size"] > 5000000) {
              $uploadOk = 0;
              echo "<script>alert('Maaf, file terlalu besar (lebih dari 5MB).');document.location='?part-customer=setting-receipt'</script>";
          }
          elseif (!in_array($imageFileType, ["jpg", "jpeg", "png"])) {
              $uploadOk = 0;
              echo "<script>alert('Maaf, hanya file JPG, JPEG, & PNG yang diperbolehkan.');document.location='?part-customer=setting-receipt'</script>";
          }
  
          if ($uploadOk === 1) {
  
              $newFileName = time() . '.' . $imageFileType;
              $target_file = $target_dir . $newFileName;

              $query = "SELECT path_featured_receipt FROM data_customer WHERE id='$id'";
              $result = $koneksi->query($query);

              if ($result->num_rows > 0) {
                  $row = $result->fetch_assoc();
                  $oldFile = $row['path_featured_receipt'];

                  if (file_exists($oldFile)) {
                      unlink($oldFile);
                  }
              }
      
              if (move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file)) {

                  $query = "SELECT * FROM data_customer WHERE id='$id'";

                  $querys = $koneksi->query($query);

                  if ($querys->num_rows === true)
                  {
                      $_SESSION['fail'] = 1;
                      header("location:?part-customer=setting-receipt");
                  } else {
                          
                      $result = $koneksi->query("UPDATE data_customer SET name_vendor='$vendor', alamat='$address', path_featured_receipt='$target_file', greeting_footer_receipt='$greeting_footer' WHERE id='$id'");
                      if ($result === true){
                      $_SESSION['succes_update'] = true;
                      header("location:?part-customer=setting-receipt");

                      } else {
                          $_SESSION['fails'] = 2;
                          header("location:?part-customer=setting-receipt");
                      }
                  }
      
              } else {
                echo "<script>alert('Maaf, terjadi kesalahan saat mengupload file anda.');document.location='?part-customer=setting-receipt'</script>";
              }
            } else {
              echo "<script>alert('Maaf, file anda tidak dapat diupload.');document.location='?part-customer=setting-receipt'</script>";
            }

      } else {
          $query = "SELECT * FROM data_customer WHERE id='$id'";

          $querys = $koneksi->query($query);

          if ($querys->num_rows === true)
          {
              $_SESSION['fail'] = 1;
              header("location:?part-customer=setting-receipt");
          } else {
              
              $result = $koneksi->query("UPDATE data_customer SET name_vendor='$vendor', alamat='$address', greeting_footer_receipt='$greeting_footer' WHERE id='$id'");
              if ($result === true){
              $_SESSION['succes_update'] = true;
              header("location:?part-customer=setting-receipt");

              } else {
                  $_SESSION['fails'] = 2;
                  header("location:?part-customer=setting-receipt");
              }
          }

      }
      
  }
}






 ?>