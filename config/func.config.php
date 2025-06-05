<?php
require("koneksi.php");
session_start();

function updateConfig($koneksi){

    if(isset($_POST['UpdateConfig'])){
        $judul = htmlspecialchars($_POST['judul']);
        $nama_file     = md5($_FILES['gambar']['name']);
        $tmp_file       = $_FILES['gambar']['tmp_name'];
        $tipe_file      = $_FILES['gambar']['type'];
        $ukuran_file    = $_FILES['gambar']['size'];

        $path = "dist/img/".$nama_file;
        

        if($tipe_file == "image/jpeg" || $tipe_file == "image/png"){

            if($ukuran_file <= 1000000){ 

                if(move_uploaded_file($tmp_file, $path)){ 

                    $result = $koneksi->query("UPDATE config set judul='$judul',image='$nama_file'");
                    if($result){ 

                        $_SESSION['success_updateimg'] = 1;
                        header("location:?config=index");
                    }else{
                        echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database";
                        echo "<br><a href='?config=index'>Kembali ke Form</a>";
                    }
                }else{
                    echo "Maaf, Gambar gagal untuk diupload.";
                    echo "<br><a href='?config=index'>Kembali ke Form</a>";
                }
            }else{
                echo "Maaf, Ukuran gambar yang diupload tidak boleh lebih dari 1MB";
                echo "<br><a href='?config=index'>Kembali ke Form</a>";
            }
        }else{
            echo "Maaf, Tipe gambar yang diupload harus JPG / JPEG / PNG.";
            echo "<br><a href='index.php'>Kembali ke Form</a>";
        }

    }
}

function prosesAPI($koneksi){

    if(isset($_POST['update'])) {
        $api = $_POST['api'];

        $result = $koneksi->query("UPDATE api set api='$api' ORDER BY id DESC LIMIT 1");

        if ($result == true){
            echo "<script>alert('Berhasil Update');document.location='?config=api'</script>";
        }
        else{
            echo "<script>alert('Gagal Update');document.location='?config=api'</script>";
        }
    }
}

function updateSetReceipt($koneksi){

    if(isset($_POST['update'])) {

        $greeting_footer = $_POST['greeting_footer'];
        $vendor = $_POST['vendor'];
        $address = $_POST['address'];

        $target_dir = "uploads/receipt/logo/";
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($_FILES["logo"]["name"], PATHINFO_EXTENSION));
		$check = getimagesize($_FILES["logo"]["tmp_name"]);

		if ($imageFileType != null) {

            if ($check === false) {
                $uploadOk = 0;
                echo "<script>alert('File bukan gambar.');document.location='?config=setting-receipt'</script>";
            }
            elseif ($_FILES["logo"]["size"] > 5000000) {
                $uploadOk = 0;
                echo "<script>alert('Maaf, file terlalu besar (lebih dari 5MB).');document.location='?config=setting-receipt'</script>";
            }
            elseif (!in_array($imageFileType, ["jpg", "jpeg", "png"])) {
                $uploadOk = 0;
                echo "<script>alert('Maaf, hanya file JPG, JPEG, & PNG yang diperbolehkan.');document.location='?config=setting-receipt'</script>";
            }
    
            if ($uploadOk === 1) {
    
                $newFileName = time() . '.' . $imageFileType;
                $target_file = $target_dir . $newFileName;

                $query = "SELECT path_featured_receipt FROM user WHERE id='1'";
                $result = $koneksi->query($query);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $oldFile = $row['path_featured_receipt'];

                    if (file_exists($oldFile)) {
                        unlink($oldFile);
                    }
                }
        
                if (move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file)) {

                    $query = "SELECT * FROM user WHERE id='1'";

                    $querys = $koneksi->query($query);

                    if ($querys->num_rows === true)
                    {
                        $_SESSION['fail'] = 1;
                        header("location:?config=setting-receipt");
                    } else {
                            
                        $result = $koneksi->query("UPDATE user SET name_vendor='$vendor', address='$address', path_featured_receipt='$target_file', greeting_footer_receipt='$greeting_footer' WHERE id='1'");
                        if ($result === true){
                        $_SESSION['succes_update'] = true;
                        header("location:?config=setting-receipt");

                        } else {
                            $_SESSION['fails'] = 2;
                            header("location:?config=setting-receipt");
                        }
                    }
        
                } else {
					echo "<script>alert('Maaf, terjadi kesalahan saat mengupload file anda.');document.location='?config=setting-receipt'</script>";
				}
			} else {
				echo "<script>alert('Maaf, file anda tidak dapat diupload.');document.location='?config=setting-receipt'</script>";
			}


        } else {
            $query = "SELECT * FROM user WHERE id='1'";

			$querys = $koneksi->query($query);

			if ($querys->num_rows === true)
			{
					$_SESSION['fail'] = 1;
					header("location:?config=setting-receipt");
			} else {
					
                $result = $koneksi->query("UPDATE user SET name_vendor='$vendor', address='$address', greeting_footer_receipt='$greeting_footer' WHERE id='1'");
                if ($result === true){
                $_SESSION['succes_update'] = true;
                header("location:?config=setting-receipt");

                } else {
                    $_SESSION['fails'] = 2;
                    header("location:?config=setting-receipt");
                }
			}

        }
        
    }
}

function clearTamper($koneksi){

    if(isset($_POST['submit'])) {

        $id = $_POST['id'];
        $meter = $_POST['meter'];
        $ch1 = curl_init();

        $headers  = [           
            'Content-Type: application/json'
        ];

        $postData = [

            "CompanyName" => "saitec",
            "UserName" => "Admin007",
            "PassWord" => "SAI123#",
            "CustomerId" => $id,
            "METER_ID" => $meter,

        ];

        curl_setopt($ch1, CURLOPT_URL,"http://www.server-api.stronpower.com/api/ClearTamper");
        curl_setopt($ch1, CURLOPT_POST, 1);
        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch1, CURLOPT_POSTFIELDS, json_encode($postData));           
        curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers);
        $result     = curl_exec ($ch1);
        $status     = curl_getinfo($ch1, CURLINFO_HTTP_CODE);
        
        curl_close ($ch1);

        if ($status == 200) {

            echo "<script>alert('Clear Tamper Meter Sudah Berhasil, Token = {$result}');document.location='?config=clear-tamper-meter'</script>";
        } else {
            echo "<script>alert('Gagal Clear Tamper Meter');document.location='?config=clear-tamper-meter'</script>";
        }

        

        


    }

}



?>
