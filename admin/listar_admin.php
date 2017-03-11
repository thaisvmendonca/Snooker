<?php
require_once('../Connections/conexao.php');
include 'verification.php';
//Seleciona os admin
$sql = "SELECT * FROM admin";
$result_admin = mysql_query($sql,$connection) or die ("Error in table selection.");
$row_admin = mysql_fetch_assoc($result_admin);
$totalRows_admin = mysql_num_rows($result_admin);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Listar administradores - Snooker</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="dist/font-awesome-4.7.0/css/font-awesome.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/style.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
  folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <?php include 'header.php'; ?>
    <?php include 'menu.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Listar administradores
        </h1>
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-sitemap"></i> Dashboard</a></li>
          <li class="active">Listar administradores</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <!-- Box page  -->
        <div class="box">
          <div class="box-body">

            <?php if ((isset($_GET["insert"])) && ($_GET["insert"] == "success")) { ?>
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Uhul!</h4>
                Administrador cadastrado com sucesso.
              </div>
              <?php } ?>

              <?php if ((isset($_GET["update"])) && ($_GET["update"] == "success")) { ?>
                <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h4><i class="icon fa fa-check"></i> Yes!</h4>
                  As alterações feita em <b>"<?php echo $_GET['name']; ?>"</b> foram salvas com sucesso.
                </div>
                <?php } ?>

                <?php if ($totalRows_admin>0){ ?>

                  <table id="example1" class="table table-bordered table-hover table-responsive">
                    <thead>
                      <tr>
                        <th class="text-center">Nome</th>
                        <th class="text-center">E-mail</th>
                        <th class="text-center">Permissão</th>
                        <th class="text-center">Ativo</th>
                        <?php if($row_logged['categoria']=='S'){ ?>
                          <th class="text-center">Ações</th>
                          <?php } ?>
                        </tr>
                      </thead>
                      <tbody>
                        <?php do { ?>
                          <tr>
                            <td class="text-center"><?php echo $row_admin['nome']; ?></td>
                            <td class="text-center"><?php echo $row_admin['email']; ?></td>
                            <td class="text-center">
                              <?php
                              if($row_admin['categoria']=='S'){
                                echo "Super admin";
                              }
                              else{
                                echo "Admin";
                              }
                              ?>
                            </td>
                            <td class="text-center">
                              <?php
                              if($row_admin['ativo']=='S'){
                                echo "<span class='c-green'>Sim</span>";
                              }
                              else{
                                echo "<span class='c-red'>Não</span>";
                              }
                              ?>
                            </td>
                            <?php if($row_logged['categoria']=='S'){ ?>
                              <td class="text-center">
                                <a href="editar_admin.php?id=<?php echo $row_admin['id_admin']; ?>" class="btn btn-info btn-xs"><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Editar"></i></a>
                              </td>
                              <?php } ?>
                            </tr>
                            <?php } while ($row_admin = mysql_fetch_assoc($result_admin)); ?>
                          </tbody>
                        </table>
                        <?php }
                        else{ ?>
                          <div class="text-center">
                            <h3>Nenhum administrador foi cadastrado ainda, vamos começar?</h3>
                            <a class="btn btn-primary btn-lg" href="cad_admin.php" role="button">Cadastrar administrador</a>
                          </div>
                          <?php }?>
                        </div>
                        <!-- /.box-body -->
                      </div>

                      <!-- box page -->
                    </section>
                    <!-- /.content -->
                  </div>
                  <!-- /.content-wrapper -->

                  <?php include 'footer.php'; ?>

                </div>
                <!-- ./wrapper -->

                <!-- jQuery 2.2.3 -->
                <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
                <!-- Bootstrap 3.3.6 -->
                <script src="bootstrap/js/bootstrap.min.js"></script>
                <!-- FastClick -->
                <script src="plugins/fastclick/fastclick.js"></script>
                <!-- AdminLTE App -->
                <script src="dist/js/app.min.js"></script>
                <!-- SlimScroll 1.3.0 -->
                <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
                <script src="dist/js/demo.js"></script>
                <!-- DataTables -->
                <script src="plugins/datatables/jquery.dataTables.min.js"></script>
                <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
                <script>
                $(function () {
                  $("#example1").DataTable();
                  $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false
                  });
                });
                </script>
              </body>
              </html>
