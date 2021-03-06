<?php
require_once('../Connections/conexao.php');
include 'verification.php';

//Seleciona quantidade de produtos
$sql = "SELECT id_produto FROM produtos";
$result_product = mysql_query($sql,$connection) or die ("Error in table selection.");
$row_product = mysql_fetch_assoc($result_product);
$totalRows_product = mysql_num_rows($result_product);

//Seleciona reservas
$date = date('d-m-Y');
$sql = "SELECT * FROM reserva WHERE data_reserva>='$date'";
$result_reserve = mysql_query($sql,$connection) or die ("Error in table selection.");
$row_reserve = mysql_fetch_assoc($result_reserve);
$totalRows_reserve = mysql_num_rows($result_reserve);

//Ve se os preços devem ser exibidos no cardápio
$sql = "SELECT exibir FROM exibir_precos";
$result_view_prices = mysql_query($sql,$connection) or die ("Error in table selection.");
$row_view_prices = mysql_fetch_assoc($result_view_prices);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard - Snooker!</title>
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
          Dashboard
        </h1>
      </section>

      <!-- Main content -->
      <section class="content">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-light-blue"><i class="fa fa-calendar"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Reservas de mesa</span>
                <span class="info-box-number"><?php echo $totalRows_reserve; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-red"><i class="fa fa-cutlery"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Produtos no cardápio</span>
                <span class="info-box-number"><?php echo $totalRows_product; ?></span>
                <div class="input-group-btn">
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <?php if($row_view_prices['exibir']=='S'){
                      echo 'Preços no cardápio (Sim)';
                    }
                    else{
                      echo 'Preços no cardápio (Não)';
                    }
                    ?>
                    <span class="fa fa-caret-down"></span></button>
                    <ul class="dropdown-menu">
                      <li><a href="updates.php?view=S">Sim</a></li>
                      <li><a href="updates.php?view=N">Não</a></li>
                    </ul>
                  </div>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->

          </div>

          <!-- Box page  -->
          <div class="box">
            <div class="box-body">

              <?php if ($totalRows_reserve>0){ ?>

                <table id="example1" class="table table-bordered table-hover table-responsive">
                  <thead>
                    <tr>
                      <th class="text-center">id</th>
                      <th class="text-center">Nome</th>
                      <th class="text-center">E-mail</th>
                      <th class="text-center">Telefone</th>
                      <th class="text-center">Mensagem</th>
                      <th class="text-center">Data/hora</th>
                      <th class="text-center">Nº de pessoas</th>
                      <th class="text-center">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php do { ?>
                      <tr>
                        <td class="text-center"><?php echo $row_reserve['id_reserva']; ?></td>
                        <td class="text-center"><?php echo $row_reserve['nome']; ?></td>
                        <td class="text-center"><?php echo $row_reserve['email']; ?></td>
                        <td class="text-center"><?php echo $row_reserve['telefone']; ?></td>
                        <td class="text-center"><?php echo $row_reserve['mensagem']; ?></td>
                        <td class="text-center"><?php echo $row_reserve['data_reserva']; ?> às <?php echo $row_reserve['horario']; ?></td>
                        <td class="text-center"><?php echo $row_reserve['n_pessoas']; ?></td>
                        <td class="text-center">
                          <div class="input-group-btn">
                            <?php if($row_reserve['status']==1){ ?>
                              <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                                Pendente
                                <?php }
                                else if($row_reserve['status']==2){ ?>
                                  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                    Confirmado
                                    <?php }
                                    else if($row_reserve['status']==3){ ?>
                                      <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                                        Cancelado
                                        <?php }
                                        ?>
                                        <span class="fa fa-caret-down"></span></button>
                                        <ul class="dropdown-menu">
                                          <li><a href="updates.php?reserve=1&id=<?php echo $row_reserve['id_reserva']; ?>">Pendente</a></li>
                                          <li><a href="updates.php?reserve=2&id=<?php echo $row_reserve['id_reserva']; ?>">Confirmar</a></li>
                                          <li><a href="updates.php?reserve=3&id=<?php echo $row_reserve['id_reserva']; ?>">Cancelar</a></li>
                                        </ul>
                                      </div>
                                    </td>
                                  </tr>
                                  <?php } while ($row_reserve = mysql_fetch_assoc($result_reserve)); ?>
                                </tbody>
                              </table>
                              <?php }
                              else{ ?>
                                <div class="text-center">
                                  <h3>Nenhuma reserva foi solicitada ainda.</h3>
                                </div>
                                <?php }?>
                              </div>
                              <!-- /.box-body -->
                            </div>


                            <!-- /.row -->
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
                      <!-- Sparkline -->
                      <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
                      <!-- SlimScroll 1.3.0 -->
                      <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
                      <!-- AdminLTE for demo purposes -->
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
