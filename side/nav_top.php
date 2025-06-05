<?php
require("koneksi.php"); 
 $id = $_SESSION['id'];
  $config = $koneksi->query("SELECT * FROM user WHERE id='$id'");
          $resconfig = $config->fetch_array();



 ?>
<nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom-0">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-align-left"></i></a>
      </li>
    </ul>

    <!----------------------------->
    <ul class="navbar-nav ml-auto">


      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          <img src="dist/img/<?= $resconfig['gambar'] ?>" class="user-image img-circle elevation-2" alt="User Image">
          <span class="d-none d-md-inline"><?php echo $username; ?></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <li class="user-header bg-info">
            <img src="dist/img/<?= $resconfig['gambar'] ?>" class="img-circle elevation-2" style="background-color: white;" alt="User Image">
              <p style="font-size:20">
                <?= $username; ?> ( <?= $_SESSION['level'] ?> )
              </p>
              <p style="font-size:15">
                Last Login <?= $_SESSION['last_login'];?>
              </p>

          </li>
          <li class="user-footer">
          <?php echo "<a href='?profile=edit&id=$_SESSION[id]' class='btn btn-default btn-flat'>Profile</a>";?>
            <a href="logout.php" class="btn btn-default btn-flat float-right">Logout</a>
          </li>
        </ul>
      </li>

    </ul>

    <!--------->
  </nav>
