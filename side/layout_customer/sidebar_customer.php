<aside class="main-sidebar sidebar-light-primary elevation-4">

    <a href="" class="brand-link border-bottom-0">
      <img src="dist/img/<?= $resconfig['image']?>" alt="Bakdat Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><b><?= $resconfig['judul'];?></b></span>
      
    </a>

    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item has-treeview ">
            <a href="?part-customer=swChoices" class="nav-link ">
              <i class="nav-icon fas fa-home"></i>
              <p>Dashboard </p>
            </a>
          </li>
          <!-- <li class="nav-item has-treeview ">
            <a href="?absen-siswa=izin" class="nav-link ">
              <i class="nav-icon fas fa-edit"></i>
              <p>Izin</p>
            </a>
          </li> -->
          
          <li class="nav-item has-treeview ">
            <a href="?part-customer=buy" class="nav-link ">
              <i class="nav-icon fas fa fa-bolt"></i>
              <p>Beli Token</p>
            </a>
          </li>
          
          <!-- <li class="nav-item has-treeview ">
            <a href="?part-customer=claim" class="nav-link ">
              <i class="nav-icon fas fa fa-check"></i>
              <p>Claim Token</p>
            </a>
          </li> -->
          <li class="nav-item has-treeview ">
            <a href="?part-customer=history" class="nav-link ">
              <i class="nav-icon fa fa-history"></i>
              <p>History Pembelian</p>
            </a>
          </li>
          <li class="nav-item has-treeview ">
            <a href="?part-customer=check-meter" class="nav-link ">
              <i class="nav-icon fas fa fa-bolt"></i>
              <p>Cek Meteran</p>
            </a>
          </li>
          <!-- <li class="nav-item has-treeview ">
            <a href="?part-customer=setting-receipt" class="nav-link ">
              <i class="nav-icon fas fa-cogs"></i>
              <p>Pengaturan Struk</p>
            </a>
          </li> -->
          <li class="nav-item has-treeview ">
            <a href="?part-customer=kontak" class="nav-link ">
              <i class="nav-icon fas fa-phone"></i>
              <p>Kontak</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="customer/logout.php" class="nav-link">
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