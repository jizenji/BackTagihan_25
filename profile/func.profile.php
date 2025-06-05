<?php
include_once("koneksi.php");
session_start();
if(!isset($_SESSION['username'])) {
   header('location:login');
} else {
   $username = $_SESSION['username'];
}

function updateProfile($koneksi){
   if (isset($_POST['UpdateProfile'])){
      $id = $_POST['id'];
      $username = $_POST['username'];
      $password = md5($_POST['password']);
       $nama_file     = md5($_FILES['gambar']['name']);
        $tmp_file       = $_FILES['gambar']['tmp_name'];
        $tipe_file      = $_FILES['gambar']['type'];
        $ukuran_file    = $_FILES['gambar']['size'];

        $path = "dist/img/".$nama_file;

        if($tipe_file == "image/jpeg" || $tipe_file == "image/png"){

            if($ukuran_file <= 1000000){ 

                if(move_uploaded_file($tmp_file, $path)){ 
      $result = $koneksi->query("UPDATE user SET username='$username',password='$password',gambar='$nama_file' WHERE id='$id'");


       if($result === true){ 

                        $_SESSION['success_updateimg'] = 1;
                        header("location:?profile=edit"); // Redirect ke halaman index.php
                        
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



 ?>
