<nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom-0">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>

      </ul>
      <ul class="navbar-nav ml-auto">
      
        <li class="nav-item mt-2">
          <div id="time"></div>
        </li>
     
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          <img src="dist/img/<?= $resconfig['image']?>" class="user-image img-circle elevation-2" alt="User Image">
          <span class="d-none d-md-inline"><?php $_SESSION['username']; ?> </span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <li class="user-header bg-info">
            <img src="dist/img/<?= $resconfig['image']?>" class="img-circle elevation-2" style="background-color: white;" alt="User Image">
              <p style="font-size:20">
                <?= $_SESSION['username']; ?> ( <?php echo "Customer"; ?> )
              </p>
              <p style="font-size:15">
                Last Login <?= $_SESSION['last_login'];?>
              </p>
          </li>
          <li class="user-footer">
            <a href="customer/logout.php" class="btn btn-default btn-flat float-right">Logout</a>
          </li>
        </ul>
      </li>

    </ul>
</nav>