<?php
require("koneksi.php");
session_start();
error_reporting(0);


function updateHarga($koneksi){
    if (isset($_POST['Update-x'])) {
        $id = $_POST['id_harga'];
        $judul = $_POST['judul'];
        $jenis = $_POST['type-meter'];
        $harga = $_POST['harga'];
        $ppn = $_POST['ppn'];
        $admin = $_POST['admin'];
        $kwh = $_POST['kwh'];
        $total = $harga+$ppn+$admin;
        
  
        $result = $koneksi->query("UPDATE hargacu SET judul='$judul',jenis='$jenis',harga='$harga',ppn='$ppn',admin='$admin',total='$total',kwh='$kwh' WHERE id_harga='$id'");
       
        if($result === true){
            $_SESSION['succes_update'] = 1;
            header("location:?data-harga=x");
        }else{
            header("location:?data-harga=x");
        }

    }else{
        echo "fail";
    }
}

function tambahHARGA($koneksi){
    if (isset($_POST['tambah-harga'])) {
        
        $judul = $_POST['judul'];
        $jenis = $_POST['type-meter'];
        $harga = $_POST['harga'];
        $ppn = $_POST['ppn'];
        $admin = $_POST['admin'];
        $kwh = $_POST['kwh'];
        $total = $harga+$ppn+$admin;

        $result = $koneksi->query("INSERT INTO hargacu (judul,jenis,harga,ppn,admin,total,kwh) VALUES ('$judul','$jenis','$harga','$ppn','$admin','$total','$kwh')");

    
        if ($result === true){
            echo "<script>alert('Berhasil Menambahkan Data Harga');document.location='?data-harga=x'</script>";
        } else {
            echo "<script>alert('Gagal Menambahkan Data Harga');document.location='?data-harga=add-pric'</script>";
            
        }

    }
        
}



function deleteHarga($koneksi){
    if (isset($_GET['id'])) {
		$id = (int)$_GET['id'];
		$result = $koneksi->query("DELETE FROM hargacu WHERE id_harga='$id'");
		if ($result === true) {
			$_SESSION['msg_delete'] = "Succes Delete  !!";
			$_SESSION['msg_type'] = "danger";
			header("location:?data-harga=x");
		}else{
		header("location:?data-harga=x");
		}
	}else{
		echo "fail";
	}
}



?>