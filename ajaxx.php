<?php
require("koneksi.php");

$id   = isset($_POST['id']) ? $_POST['id'] : '';
$jenis   = isset($_POST['jenis']) ? $_POST['jenis'] : '';

$meter_column = '';
if ($jenis == 'air') {
    $meter_column = 'metersatua';
} elseif ($jenis == 'gas') {
    $meter_column = 'metersatug';
} else {
    $meter_column = 'metersatul'; // default listrik
}

$list = array();

if($meter_column != '') {
    // If customer ID is provided, filter by customer, else get all
    if($id != '') {
        $query = "SELECT `$meter_column` FROM data_customer WHERE id_customer = '".$id."' AND `$meter_column` IS NOT NULL AND `$meter_column` != '' ORDER BY `$meter_column`";
    } else {
        $query = "SELECT `$meter_column` FROM data_customer WHERE `$meter_column` IS NOT NULL AND `$meter_column` != '' ORDER BY `$meter_column`";
    }
    $qu = mysqli_query($koneksi, $query);
    if(!$qu) {
        die("Query Error : ".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
    }
    $meters = array();
    while($row = mysqli_fetch_array($qu)) {
        $meters[] = $row[$meter_column];
    }
    // Remove duplicates
    $meters = array_unique($meters);
    // Prepare for JSON
    foreach($meters as $meter) {
        $list[] = $meter;
    }
}
echo json_encode(['results' => $list]);
?>