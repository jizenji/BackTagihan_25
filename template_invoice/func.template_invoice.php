<?php
require("koneksi.php");
session_start();
error_reporting(0);

function add($koneksi)
{

    if (isset($_POST['add'])) {

        $name = $_POST['name'];
        $greeting_footer = $_POST['greeting_receipt'];
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
            } elseif ($_FILES["logo"]["size"] > 5000000) {
                $uploadOk = 0;
                echo "<script>alert('Maaf, file terlalu besar (lebih dari 5MB).');document.location='?config=setting-receipt'</script>";
            } elseif (!in_array($imageFileType, ["jpg", "jpeg", "png"])) {
                $uploadOk = 0;
                echo "<script>alert('Maaf, hanya file JPG, JPEG, & PNG yang diperbolehkan.');document.location='?config=setting-receipt'</script>";
            }

            if ($uploadOk === 1) {

                $newFileName = time() . '.' . $imageFileType;
                $target_file = $target_dir . $newFileName;

                if (move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file)) {

                    $result = $koneksi->query("INSERT INTO template_invoice (name, name_vendor, address, greeting_footer_receipt, path_featured_receipt) VALUES ('$name','$vendor','$address','$greeting_footer','$target_file')");

                    if ($result === true) {
                        $_SESSION['succes_update'] = true;
                        header("location:?template-invoice=data");
                    } else {

                        $_SESSION['fails'] = 2;

                        header("location:?template-invoice=data");
                    }
                }
            }
        }
    }
}

function update($koneksi)
{

    if (isset($_POST['update'])) {

        $id = $_POST['id'];
        $name = $_POST['name'];
        $greeting_footer = $_POST['greeting_receipt'];
        $vendor = $_POST['name_vendor'];
        $address = $_POST['address'];

        $target_dir = "uploads/receipt/logo/";
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($_FILES["logo"]["name"], PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["logo"]["tmp_name"]);

        if ($imageFileType != null) {

            if ($check === false) {
                $uploadOk = 0;
                echo "<script>alert('File bukan gambar.');document.location='?config=setting-receipt'</script>";
            } elseif ($_FILES["logo"]["size"] > 5000000) {
                $uploadOk = 0;
                echo "<script>alert('Maaf, file terlalu besar (lebih dari 5MB).');document.location='?config=setting-receipt'</script>";
            } elseif (!in_array($imageFileType, ["jpg", "jpeg", "png"])) {
                $uploadOk = 0;
                echo "<script>alert('Maaf, hanya file JPG, JPEG, & PNG yang diperbolehkan.');document.location='?config=setting-receipt'</script>";
            }

            if ($uploadOk === 1) {

                $newFileName = time() . '.' . $imageFileType;
                $target_file = $target_dir . $newFileName;

                $query = "SELECT path_featured_receipt FROM template_invoice WHERE id='$id'";
                $result = $koneksi->query($query);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $oldFile = $row['path_featured_receipt'];

                    if (file_exists($oldFile)) {
                        unlink($oldFile);
                    }
                }

                if (move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file)) {

                    $query = "SELECT * FROM template_invoice WHERE id='$id'";

                    $querys = $koneksi->query($query);

                    if ($querys->num_rows === true) {
                        $_SESSION['fail'] = 1;
                        header("location:?template-invoice=data");
                    } else {

                        $result = $koneksi->query("UPDATE template_invoice SET name='$name', name_vendor='$vendor', address='$address', path_featured_receipt='$target_file', greeting_footer_receipt='$greeting_footer' WHERE id='$id'");
                        if ($result === true) {
                            $_SESSION['succes_update'] = true;
                            header("location:?template-invoice=data");
                        } else {
                            $_SESSION['fails'] = 2;
                            header("location:?template-invoice=data");
                        }
                    }
                } else {
                    echo "<script>alert('Maaf, terjadi kesalahan saat mengupload file anda.');document.location='?config=setting-receipt'</script>";
                }
            } else {
                echo "<script>alert('Maaf, file anda tidak dapat diupload.');document.location='?config=setting-receipt'</script>";
            }
        } else {
            $query = "SELECT * FROM template_invoice WHERE id='$id'";

            $querys = $koneksi->query($query);

            if ($querys->num_rows === true) {
                $_SESSION['fail'] = 1;
                header("location:?template-invoice=data");
            } else {

                $result = $koneksi->query("UPDATE template_invoice SET name='$name', name_vendor='$vendor', address='$address', greeting_footer_receipt='$greeting_footer' WHERE id='$id'");
                if ($result === true) {
                    $_SESSION['succes_update'] = true;
                    header("location:?template-invoice=data");
                } else {
                    $_SESSION['fails'] = 2;
                    header("location:?template-invoice=data");
                }
            }
        }
    }
}

function delete($koneksi){
    if (isset($_GET['id'])) {

        $id = (int)$_GET['id'];

        $query = "SELECT path_featured_receipt FROM template_invoice WHERE id='$id'";
        $result = $koneksi->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $oldFile = $row['path_featured_receipt'];

            if (file_exists($oldFile)) {
                unlink($oldFile);
            }
        }

		$result = $koneksi->query("DELETE FROM template_invoice WHERE id='$id'");
		if ($result === true) {
			$_SESSION['msg_delete'] = "Succes Delete  !!";
			$_SESSION['msg_type'] = "danger";
			header("location:?template-invoice=data");
		}else{
		    header("location:?template-invoice=data");
		}
	}else{
		echo "fail";
	}
}

