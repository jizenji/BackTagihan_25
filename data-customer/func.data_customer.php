<?php
require("koneksi.php");
session_start();

function updateX($koneksi){
	if (isset($_POST['Update-x'])) {
		$id = $_POST['id'];	
		$id_customer = $_POST['id_customer'];
		$username = $_POST['username'];
		$nama = htmlspecialchars($_POST['nm_lengkap']);
		$vendor = $_POST['vendor'];
		$password = $_POST['password'];
		$alamat = $_POST['alamat'];
		$telepon = $_POST['telepon'];

		$meterl1 = $_POST['meteronel'];
		$cnsmeterl1 = $_POST['cnsmeteronel'];

		$meterl2 = $_POST['metertwol'];
		$cnsmeterl2 = $_POST['cnsmetertwol'];

		$meterl3 = $_POST['meterthreel'];
		$cnsmeterl3 = $_POST['cnsmeterthreel'];

		$meterl4 = $_POST['meterfourl'];
		$cnsmeterl4 = $_POST['cnsmeterfourl'];

		$metera1 = $_POST['meteronea'];
		$cnsmetera1 = $_POST['cnsmeteronea'];

		$metera2 = $_POST['metertwoa'];
		$cnsmetera2 = $_POST['cnsmetertwoa'];

		$metera3 = $_POST['meterthreea'];
		$cnsmetera3 = $_POST['cnsmeterthreea'];

		$metera4 = $_POST['meterfoura'];
		$cnsmetera4 = $_POST['cnsmeterfoura'];

		$meterg1 = $_POST['meteroneg'];
		$cnsmeterg1 = $_POST['cnsmeteroneg'];

		$meterg2 = $_POST['metertwog'];
		$cnsmeterg2 = $_POST['cnsmetertwog'];

		$meterg3 = $_POST['meterthreeg'];
		$cnsmeterg3 = $_POST['cnsmeterthreeg'];

		$meterg4 = $_POST['meterfourg'];
		$cnsmeterg4 = $_POST['cnsmeterfourg'];

		$template_id = $_POST['template_id'];

		
		$query = "SELECT * FROM data_customer WHERE id_customer='$id_customer'";

		$querys = $koneksi->query($query);

		if ($querys->num_rows === true)
		{
				$_SESSION['fail'] = 1;
				header("location:?data-customer=x");
		} else {
				
				$result = $koneksi->query("UPDATE data_customer SET id_customer='$id_customer', template_invoice_id='$template_id', nm_lengkap='$nama', username='$username', password='$password', alamat='$alamat', telepon='$telepon', metersatul='$meterl1', concentratorid_metersatul='$cnsmeterl1', meterdual='$meterl2', concentratorid_meterdual='$cnsmeterl2', metertigal='$meterl3', concentratorid_metertigal='$cnsmeterl3', meterempatl='$meterl4', concentratorid_meterempatl='$cnsmeterl4', metersatua='$metera1', concentratorid_metersatua='$cnsmetera1', meterduaa='$metera2', concentratorid_meterduaa='$cnsmetera2', metertigaa='$metera3', concentratorid_metertigaa='$cnsmetera3', meterempata='$metera4', concentratorid_meterempata='$cnsmetera4', metersatug='$meterg1', concentratorid_metersatug='$cnsmeterg1', meterduag='$meterg2', concentratorid_meterduag='$cnsmeterg2', metertigag='$meterg3', concentratorid_metertigag='$cnsmeterg3', meterempatg='$meterg4', concentratorid_meterempatg='$cnsmeterg4' WHERE id='$id'");
				if ($result === true){
				$_SESSION['succes_update'] = true;
				header("location:?data-customer=x");

				} else {
					$_SESSION['fails'] = 2;
					header("location:?data-customer=x");
				}
		}
		
	} else {
		echo "tidak sesuai value";
	}
}

function deleteX($koneksi){
	if (isset($_GET['id'])) {
		$id = (int)$_GET['id'];
		$result = $koneksi->query("DELETE FROM data_customer where id='$id'");
		if ($result === true) {
			$_SESSION['msg_delete'] = "Succes Delete  !!";
			$_SESSION['msg_type'] = "danger";
			header("location:?data-customer=x");
		}else{
			header("location:?data-customer=x");
		}
	}else{
		echo "Failed";
	}
}

function createProses($koneksi)
{
    if (isset($_POST['tambah-user']))
    {
		$idcustomer = $_POST['id_customer'];
		$employe = $_POST['nm_lengkap'];
		$vendor = $_POST['vendor'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$telepon = $_POST['telepon'];
		$alamat = $_POST['alamat'];


		$meterol = $_POST['meteronel'];
		$cnsmeterol = $_POST['cnsmeteronel'];

		$meteril = $_POST['metertwol'];
		$cnsmeteril = $_POST['cnsmetertwol'];

		$meterel = $_POST['meterthreel'];
		$cnsmeterel = $_POST['cnsmeterthreel'];

		$meterul = $_POST['meterfourl'];
		$cnsmeterul = $_POST['cnsmeterfourl'];


		$meteroa = $_POST['meteronea'];
		$cnsmeteroa = $_POST['cnsmeteronea'];


		$meteria = $_POST['metertwoa'];
		$cnsmeteria = $_POST['cnsmetertwoa'];


		$meterea = $_POST['meterthreea'];
		$cnsmeterea = $_POST['cnsmeterthreea'];


		$meterua = $_POST['meterfoura'];
		$cnsmeterua = $_POST['cnsmeterfoura'];


		$meterog = $_POST['meteroneg'];
		$cnsmeterog = $_POST['cnsmeteroneg'];


		$meterig = $_POST['metertwog'];
		$cnsmeterig = $_POST['cnsmetertwog'];


		$metereg = $_POST['meterthreeg'];
		$cnsmetereg = $_POST['cnsmeterthreeg'];


		$meterug = $_POST['meterfourg'];
		$cnsmeterug = $_POST['cnsmeterfourg'];

		$template_id = $_POST['template_id'];
			
		$result = $koneksi->query("INSERT INTO data_customer (id_customer, template_invoice_id, nm_lengkap, name_vendor, alamat, username, password, telepon, metersatul, concentratorid_metersatul, meterdual, concentratorid_meterdual, metertigal, concentratorid_metertigal, meterempatl, concentratorid_meterempatl, metersatua, concentratorid_metersatua, meterduaa, concentratorid_meterduaa, metertigaa, concentratorid_metertigaa, meterempata, concentratorid_meterempata, metersatug, concentratorid_metersatug, meterduag, concentratorid_meterduag, metertigag, concentratorid_metertigag, meterempatg, concentratorid_meterempatg) VALUES ('$idcustomer', '$template_id', '$employe', '$vendor', '$alamat', '$username', '$password', '$telepon', '$meterol', '$cnsmeterol', '$meteril', '$cnsmeteril', '$meterel', '$cnsmeterel', '$meterul', '$cnsmeterul', '$meteroa', '$cnsmeteroa', '$meteria', '$cnsmeteria', '$meterea', '$cnsmeterea', '$meterua', '$cnsmeterua', '$meterog', '$cnsmeterog', '$meterig', '$cnsmeterig', '$metereg', '$cnsmetereg', '$meterug', '$cnsmeterug')");

		if ($result === true) {
			echo "<script>alert('Berhasil Menambahkan User');document.location='?data-customer=x'</script>";
		} else {
			echo "<script>alert('Gagal Menambahkan User');document.location='?data-customer=x'</script>";
		}	
			
	}
	
}

function refreshMeter($koneksi) {
	$conce = $_GET['conce'];
	$type = $_GET['type'];

	$ch1 = curl_init();
	$postData1 = [
   
		"CompanyName" => "saitec",
		"UserName" => "Admin007",
		"PassWord" => "123456",
		"ConcentratorId" => $conce

	];

	$headers  = [
                    
		'Content-Type: application/json'
	];

	curl_setopt($ch1, CURLOPT_URL,"http://www.server-api.stronpower.com/api/QueryConcentratorInfo");
	curl_setopt($ch1, CURLOPT_POST, 1);
	curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch1, CURLOPT_POSTFIELDS, json_encode($postData1));           
	curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers);
	$token_api     = curl_exec ($ch1);
	$status     = curl_getinfo($ch1, CURLINFO_HTTP_CODE);
	
	curl_close ($ch1);

	$result = json_decode($token_api, true);

	if ($status == 200) {

		if ($result[0]['Online'] == "true") {

			echo "<script>alert('Server Online..!');document.location='?data-customer=x'</script>";
		} else {

			echo "<script>alert('Maaf Server Offline..!');document.location='?data-customer=x'</script>";
		}
	} else {
		echo "<script>alert('Maaf Server Offline..!');document.location='?data-customer=x'</script>";
	}

}

function switchMeter($koneksi) {

	$meter = $_GET['meter'];
	$switch = $_GET['switch'];
	$type = $_GET['type'];

	$ch1 = curl_init();

	$postData1 = [
            
		"CompanyName" => "saitec",
		"UserName" => "Admin007",
		"PassWord" => "123456",
		"MeterID" => $meter,
		"Switch" => $switch

	];

	$headers  = [
                    
		'Content-Type: application/json'
	];


	curl_setopt($ch1, CURLOPT_URL,"http://www.server-api.stronpower.com/api/RemotelySwitch");
	curl_setopt($ch1, CURLOPT_POST, 1);
	curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch1, CURLOPT_POSTFIELDS, json_encode($postData1));           
	curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers);
	$token_api     = curl_exec ($ch1);
	$status     = curl_getinfo($ch1, CURLINFO_HTTP_CODE);
	
	curl_close ($ch1);

	echo $token_api;

	if ($token_api === '"Successfully"') {

		if ($switch == "on") {
			$res = "Active";
			$wor = "Meteran telah berhasil di NYALAKAN..!!";
		} else {
			$res = "Deactive";
			$wor = "Meteran telah berhasil di MATIKAN..!!";
		}

		$result = $koneksi->query("UPDATE data_customer SET status_$type='$res' WHERE $type='$meter'");

		echo "<script>alert('.$wor.');document.location='?data-customer=x'</script>";
	} else {
		echo "<script>alert('Maaf Server Offline..!');document.location='?data-customer=x'</script>";
	}

}

?>
