<?php
// include('../koneksi.php');

$config = $koneksi->query("SELECT * FROM config ORDER BY id_config desc");
          $resconfig = $config->fetch_array();
 ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<aside class="main-sidebar sidebar-light-primary elevation-4" id="auto_refresh">
  <a href="" class="brand-link border-bottom-0">
    <img src="dist/img/<?= $resconfig['image']?>" alt="Bakdat Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light"><b><?= $resconfig['judul'];?></b></span>
  </a>
  <div class="sidebar" >
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column nav-legacy" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item has-treeview ">
          <a href="./?home" <?php if (isset($_GET["home"])){echo 'class="nav-link active"'; }?> class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li  <?php if (isset($_GET["input"])){echo 'class="nav-item has-treeview menu-open"'; }?>  class="nav-item has-treeview">
          <a href="#" <?php if (isset($_GET["input"])){echo 'class="nav-link active"'; }?>  class="nav-link">
            <i class="nav-icon fas fa-edit"></i>
            <p>
              Generate Token
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="./?input=x"  class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Generate</p>
              </a>
            </li>
           
          </ul>
        </li>
<!---------------------->
        <li <?php if (isset($_GET["laporan"])){echo 'class="nav-item has-treeview menu-open"'; }?> class="nav-item has-treeview">
          <a href="#" <?php if (isset($_GET["laporan"])){echo 'class="nav-link active"'; }?> class="nav-link">
            <i class="nav-icon fas fa-folder-open"></i>
            <p>
              Laporan Transaksi
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="./?laporan=xl" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Laporan Admin Listrik</p>
              </a>
            </li>
          </ul>

          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="./?laporan=xa" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Laporan Admin Air</p>
              </a>
            </li>
          </ul>

          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="./?laporan=xg" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Laporan Admin Gas</p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="./?laporan=xi&choice=listrik" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Laporan Customer Listrik</p>
              </a>
            </li>
          </ul>

          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="./?laporan=xi&choice=air" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Laporan Customer Air</p>
              </a>
            </li>
          </ul>

          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="./?laporan=xi&choice=gas" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Laporan Customer Gas</p>
              </a>
            </li>
          </ul>
        </li>
<!---------------------->
        
        <!--  -->
       
        <!--  -->
        <li <?php if (isset($_GET["data-siswa"])){echo 'class="nav-item has-treeview menu-open"'; }?> class="nav-item has-treeview">
          <a href="#" <?php if (isset($_GET["data-siswa"])){echo 'class="nav-link active"'; }?> class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Data Customer
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="?data-customer=x" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Customer</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="?data-customer=create_data" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Create Data Customer</p>
              </a>
            </li>      
          </ul>
        </li>

        <li <?php if (isset($_GET["data-harga"])){echo 'class="nav-item has-treeview menu-open"'; }?> class="nav-item has-treeview">
          <a href="#" <?php if (isset($_GET["data-harga"])){echo 'class="nav-link active"'; }?> class="nav-link">
            <i class="nav-icon fas fa fa-dollar"></i>
            <p>
              Harga Customer
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="?data-harga=x" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Harga</p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="?data-harga=add-pric" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Create Data Harga</p>
              </a>
            </li>
          </ul>  
        </li>
        <li <?php if (isset($_GET["template-invoice"])){echo 'class="nav-item has-treeview menu-open"'; }?> class="nav-item has-treeview">
          <a href="#" <?php if (isset($_GET["template-invoice"])){echo 'class="nav-link active"'; }?> class="nav-link">
            <i class="nav-icon fas fa-folder-open"></i>
            <p>
              Template Struk
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="?template-invoice=data" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Template Struk</p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="?template-invoice=add-data" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Create Template Struk</p>
              </a>
            </li>
          </ul>  
        </li>
        <li <?php if (isset($_GET["config"])){echo 'class="nav-item has-treeview menu-open"'; }?> class="nav-item has-treeview">
          <a href="#" <?php if (isset($_GET["config"])){echo 'class="nav-link active"'; }?> class="nav-link">
            <i class="nav-icon fas fa-cogs"></i>
            <p>
              Pengaturan
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="?config=index" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Web ( Judul, Logo )</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="?config=api" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Api Whatsaap</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="?config=setting-receipt" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Struk</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="?config=clear-tamper-meter" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Clear Tamper Meter</p>
              </a>
            </li>         
          </ul>
        </li>
        
        <li class="nav-item has-treeview ">
            <a href="?page=kontak" <?php if (isset($_GET["page"])){echo 'class="nav-link active"'; }?> class="nav-link ">
              <i class="nav-icon fas fa-phone"></i>
              <p>Kontak</p>
            </a>
          </li>
        <li class="nav-item">
          <a href="logout.php" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>
              Logout
            </p>
          </a>
        </li>
          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
