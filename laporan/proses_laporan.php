<?php
require("koneksi.php");
require 'vendor/autoload.php';
require_once 'vendor/dompdf/dompdf/src/Autoloader.php'; 
use Dompdf\Dompdf;
use Dompdf\Options;
session_start();

function delete_x($koneksi){
	if(isset($_POST['delete'])){

        if(isset($_POST['pilih'])){
          
          foreach($_POST['pilih'] as $deleteid){
      
            $deleteUser = "DELETE FROM laporan_a WHERE id_laporan=".$deleteid;
            $tes = mysqli_query($koneksi,$deleteUser);

            $_SESSION['msg'] = "Succes Delete  !!";
			$_SESSION['msg_type'] = "danger";
			header("location:?laporan=x");
          }
        }
       
      }
    
      else {
          echo "fail but delete";
      }
}



function delete_xi($koneksi){
   
	if(isset($_POST['delete'])){

        if(isset($_POST['pilih'])){
          
          foreach($_POST['pilih'] as $deleteid){
      
            $deleteUser = "DELETE FROM laporan_cu WHERE id=".$deleteid;
            $tes = mysqli_query($koneksi,$deleteUser);

            $_SESSION['msg'] = "Succes Delete  !!";
			$_SESSION['msg_type'] = "danger";
			header("location:?laporan=xi");
          }
        }
       
      }
    
      else {
          echo "fail but delete";
      }

}

function export($koneksi) {

$id = $_GET['id'];

$resultt = $koneksi->query("SELECT * FROM laporan_a WHERE id_laporan='$id'");

$query = $koneksi->query("SELECT * FROM user WHERE id=1");
$fetch = $query->fetch_array();

$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$domainName = $_SERVER['HTTP_HOST'];
$merge = $protocol . $domainName;

while ($data = mysqli_fetch_assoc($resultt)){

if ($data['jenis_meter'] == "listrik") {
	$rest = "Kwh";
} else  {
	$rest = "M3";
}

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

?>
