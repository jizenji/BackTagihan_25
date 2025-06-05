<?php
require 'koneksi.php';
$config = $koneksi->query("SELECT * FROM config ORDER BY id_config desc");
          $resconfig = $config->fetch_array();
?>
<footer class="main-footer">
    <strong>Copyright &copy; 2020 <a href="http://member.tagihan.id"><?= $resconfig['judul']; ?>	&#10084; tagihan.id</a>.</strong>
    All rights reserved.
 </footer>