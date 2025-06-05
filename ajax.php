<?php
require("koneksi.php");

$search = isset($_GET['search']) ? $_GET['search'] : '';

$list = array();
$key = 0;

if($search != '') {
    $data = "SELECT * FROM data_customer WHERE id_customer LIKE '%".$search."%' OR nm_lengkap LIKE '%".$search."%' ORDER BY id_customer ASC";
    $qu = mysqli_query($koneksi, $data);
    if(!$qu) {
        die("Query Error : ".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
    }
    while($row = mysqli_fetch_array($qu)) {
        $list[$key]['id'] = $row['id'];
        $list[$key]['id_customer'] = $row['id_customer'];
        $list[$key]['text'] = $row['id_customer'] . ' - ' . $row['nm_lengkap'];
        $list[$key]['nm_lengkap'] = $row['nm_lengkap'];
        $list[$key]['telepon'] = $row['telepon'];  
        $list[$key]['alamat'] = $row['alamat']; 
        $key++;
    }
}

echo json_encode(['results' => $list]);
?>