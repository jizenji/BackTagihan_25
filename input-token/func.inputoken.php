<?php 
require("koneksi.php");
error_reporting(0);
date_default_timezone_set("Asia/Jakarta"); 

session_start();

function inputX($koneksi){

    if (isset($_POST['Submit'])) {
    $meter = $_POST['meter'];
    $id_customer = $_POST['id_customer'];
    $nama = $_POST['nm_lengkap'];
    $price = $_POST['price'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    $amount = $_POST['kwh'];
    $ch1 = curl_init();
    $headers  = [
                    
                    'Content-Type: application/json'
                ];
    $postData1 = [
        
            "CompanyName" => "saitec",
            "UserName" => "Admin007",
            "PassWord" => "SAI123#",
            "MeterID" => $meter,
            "is_vend_by_unit" => "false",
            "Amount" => $amount
              
            
        
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

    $ress = $tp[0]->Token;
    
    $zero = date("l ").date("d-m-Y ") . date("h:i:s a");

    if ($ress !== null){
    $result = $koneksi->query("INSERT INTO laporan_a (meter,id_customer,nm_lengkap,price,rate,amount,token,tanggal,alamat,telepon) VALUES ('$meter','$id_customer','$nama','$price','$rate','$amount','$ress','$zero','$alamat','$telepon')");
    echo "<script>alert('Berhasil Generate!');document.location='?laporan=x'</script>";

    }else{
    echo "<script>alert('Gagal Generate');document.location='?input=x'</script>";
    }
    }

}

function inputXX($koneksi){

    if (isset($_POST['Submit'])) {

        $id_harga = $_POST['id_harga'];

        $query = "SELECT harga, ppn, admin, kwh, total FROM hargacu WHERE id_harga='$id_harga'";
        $result = $koneksi->query($query);

        $row = $result->fetch_assoc();

        $meter = $_POST['meter'];
        $id_customer = $_POST['id_customer'];
        $nama = $_POST['nm_lengkap'];
        $price_token = $row['harga'];
        $price = $row['total'];
        $alamat = $_POST['alamat'];
        $telepon = $_POST['telepon'];
        $amount = $row['kwh'];
        $jenis = $_POST['jenis'];
        $judul = $_POST['judul'];
        $ppn = $row['ppn'];
        $admin = $row['admin'];
        $ch1 = curl_init();
        $headers  = [
                        
                        'Content-Type: application/json'
                    ];
        
    
        $postData1 = [
            
                "CompanyName" => "saitec",
                "UserName" => "Admin007",
                "PassWord" => "SAI123#",
                "MeterID" => $meter,
                "is_vend_by_unit" => true,
                "Amount" => $amount
        
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

        $ress = $tp[0]->Token;
        
        $zero = date("d-m-Y ") . date("h:i:s a");

        if ($ress !== null){
            $result = $koneksi->query("INSERT INTO laporan_a (jenis_meter, judul,meter, id_customer, nm_lengkap, price, price_token, rate, ppn, admin, amount, token, tanggal, alamat, telepon) VALUES ('$jenis','$judul','$meter','$id_customer','$nama','$price', '$price_token', '$rate','$ppn', '$admin','$amount','$ress','$zero','$alamat','$telepon')");
            if ($jenis == "air"){
                echo "<script>alert('Berhasil Generate!');document.location='?laporan=xa'</script>";
            } elseif ($jenis == "gas") {
                echo "<script>alert('Berhasil Generate!');document.location='?laporan=xg'</script>";
            } else {
                echo "<script>alert('Berhasil Generate!');document.location='?laporan=xl'</script>";
            }
            

            }else{
            echo "<script>alert('Gagal Generate');document.location='?input=x'</script>";
            }
    }
}

function daftar($koneksi)
{
    $cari   = $_GET['search'];

    //jika tidak ada data yang dicari
    if($cari == null){
        echo "data kosong";
    
    //jika ada data yang dicari
    }else{
        //cari sesuai kata yang diketik
        $data   = mysqli_query($koneksi, "SELECT * FROM customer WHERE id_customer LIKE '%$cari%'");

        $list = array();
        $key=0;

        //lakukan looping untuk menampilkan data yang sesuai
        while($row = mysqli_fetch_assoc($data)) {
            $list[$key]['id'] = $row['id'];
            $list[$key]['telepon'] = $row['telepon'];  
            $list[$key]['metersatu'] = $row['metersatu'];
            $list[$key]['alamat'] = $row['alamat']; 
            $key++;
        }

        //data ditampilkan dalam bentuk json
        echo json_encode($list);
    }
}

 ?>


