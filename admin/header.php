<?php
$email_logged = $_SESSION['email'];
$sql = "SELECT nome, categoria, id_admin FROM admin WHERE email='$email_logged'";
$result = mysql_query($sql,$connection) or die ("Error in table selection.");
$row_logged = mysql_fetch_assoc($result); // recebe os dados do result
$totalRows_logged = mysql_num_rows($result); // numero de registros encontrados
$first_name_logged = explode(" ", $row_logged['nome']);
?>
<header class="main-header">
  <!-- Logo -->
  <a href="index.php" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini">Adm</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>Adm</b>Snooker</span>
  </a>

  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="../img/default.jpg" class="user-image" alt="User Image">
            <span class="hidden-xs"><?php echo $first_name_logged[0]; ?></span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="../img/default.jpg" class="img-circle" alt="User Image">

              <p>
                <?php echo $row_logged['nome']; ?>
                <small>
                  <?php
                  if($row_logged['categoria']=='S'){
                    echo "Super Admin";
                  }
                  else{
                    echo "Admin";
                  }
                  ?>
                </small>
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="editar_admin.php?id=<?php echo $row_logged['id_admin']; ?>" class="btn btn-default btn-flat"><i class="fa fa-edit"></i> Editar perfil</a>
              </div>
              <div class="pull-right">
                <a href="logout.php" class="btn btn-danger btn-flat"><i class="fa fa-sign-out"></i> Sair</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>

  </nav>
</header>
