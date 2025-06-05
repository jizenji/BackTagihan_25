<?php
session_start();
require("koneksi.php");
date_default_timezone_set('Asia/Jakarta');


function prosesLogin($koneksi){

  if(isset($_POST['submit'])) {
    error_reporting(0);
    $username = addslashes($_POST['username']);
    $pass = md5($_POST['password']);
    $tanggal_sekarang = date("Y-m-d");
    $tgllogin = "UPDATE user set last_login='$tanggal_sekarang' where username = '$username'";
    $sql = "SELECT user.*,DATE_FORMAT(last_login,'%d %M %Y') as lastlogin FROM user WHERE username = '$username'";
    $query = $koneksi->query($sql);
    $hasil = $query->fetch_assoc();
    // $tgl_login = date('Y-m-d');

    if($query->num_rows == false) {
        $_SESSION['unregis'] = true;
        header('location:?login');
    } else {
      if($pass <> $hasil['password']) {
          $_SESSION['wrong_password'] = true;
          header('location:?login');
      } else {
        $result = $koneksi->query($tgllogin);
        $_SESSION['username'] = $hasil['username'];
        $_SESSION['id'] = $hasil['id'];
        $_SESSION['gambar'] = $hasil['gambar'];
        $_SESSION['nama_lengkap'] = $hasil['nama_lengkap'];
        $_SESSION['level'] = "admin";
        $_SESSION['last_login'] = $hasil['lastlogin'];
        $_SESSION['succes_login'] = 1;
        // header('location:index.php');
        header('location:?home');
      }
    }
  }
}
               
?>