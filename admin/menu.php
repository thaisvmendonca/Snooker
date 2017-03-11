<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li>
        <a href="#">
          <i class="fa fa-cutlery"></i> <span>Cardápio</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="listar_produtos.php"><i class="fa fa-circle-o"></i> Listar produtos</a></li>
          <li><a href="cad_produto.php"><i class="fa fa-circle-o"></i> Cadastrar produto</a></li>
        </ul>
      </li>
      <?php if($row_logged['categoria']=='S'){ ?>
      <li>
        <a href="#">
          <i class="fa fa-user"></i> <span>Administradores</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="listar_admin.php"><i class="fa fa-circle-o"></i> Listar administradores</a></li>
          <li><a href="cad_admin.php"><i class="fa fa-circle-o"></i> Cadastrar administrador</a></li>
        </ul>
      </li>
      <?php } ?>
      <li>
        <a href="../" target="_blank">
          <i class="fa fa-external-link"></i> <span>Ir para o site</span>
        </a>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
