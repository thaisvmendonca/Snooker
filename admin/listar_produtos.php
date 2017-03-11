<?php
require_once('../Connections/conexao.php');
include 'verification.php';
//Seleciona os produtos
$sql = "SELECT id_produto, nome, preco, categoria, descricao, publicado, admin_id_admin, DATE_FORMAT(cadastro, '%d/%m/%Y às %T') as date_formatted FROM produtos";
$result_product = mysql_query($sql,$connection) or die ("Error in table selection.");
$row_product = mysql_fetch_assoc($result_product);
$totalRows_product = mysql_num_rows($result_product);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Listar produtos - Snnoker</title>
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
  <style type="text/css">
  #conteudo{ display:none; }
  .center{
    position:absolute;
    top:30%;
    left:60%;
    margin-top:-30px;
    margin-left:-50px;
  }
  </style>
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
          Listar produtos
        </h1>
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-sitemap"></i> Dashboard</a></li>
          <li class="active">Listar produtos</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div id="carregando" class="center">
          <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
          <span class="sr-only">Carregando...</span>
        </div>
        <!-- Box page  -->
        <div id="conteudo" class="box">
          <div class="box-body">

            <?php if ((isset($_GET["update"])) && ($_GET["update"] == "success")) { ?>
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Sucesso!</h4>
                As alterações feitas em <b>"<?php echo $_GET['name']; ?>"</b> foram salvas com sucesso.
              </div>
              <?php } ?>

            <?php if ((isset($_GET["deletion"])) && ($_GET["deletion"] == "success")) { ?>
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-trash"></i> Excluído!</h4>
                Produto excluído com sucesso.
              </div>
              <?php } ?>

              <?php if ($totalRows_product>0){ ?>

                <table id="example1" class="table table-bordered table-hover table-responsive">
                  <thead>
                    <tr>
                      <th class="text-center">Nome</th>
                      <th class="text-center">Preço</th>
                      <th class="text-center">Categoria</th>
                      <th class="text-center">Descrição</th>
                      <th class="text-center">Cadastro</th>
                      <th class="text-center">Última edição</th>
                      <th class="text-center">Publicado</th>
                      <th class="text-center">Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php do { ?>
                      <tr>
                        <td><?php echo $row_product['nome']; ?></td>
                        <td class="text-center">
                          <?php if($row_product['preco']!=NULL){
                            echo $row_product['preco'];
                          }
                          else{
                            echo 'Não informado';
                          }  ?>
                        </td>
                        <td class="text-center">
                          <?php
                          switch ($row_product['categoria']) {
                            case 'C':
                            echo "Cerveja";
                            break;
                            case 'D':
                            echo "Drink";
                            break;
                            case 'A':
                            echo "Aperitivo";
                            break;
                          }
                          ?>
                        </td>
                        <td class="text-center">
                          <?php if($row_product['descricao']!=NULL){
                            echo $row_product['descricao'];
                          }
                          else{
                            echo 'Não informado';
                          }  ?>
                        </td>
                        <td class="text-center"><?php echo $row_product['date_formatted']; ?></td>
                        <td class="text-center">
                          <?php
                          $id_admin = $row_product['admin_id_admin'];
                          $sql = "SELECT nome FROM admin WHERE id_admin=$id_admin";
                          $result_admin = mysql_query($sql,$connection) or die ("Error in table selection.");
                          $row_admin = mysql_fetch_assoc($result_admin); // recebe os dados do result
                          $totalRows_admin = mysql_num_rows($result_admin); // numero de registros encontrados
                          $first_name_admin = explode(" ", $row_admin['nome']);

                          if($totalRows_admin > 0){
                            echo $first_name_admin[0];
                          }
                          else{
                            echo 'Anônimo <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Admin foi excluído."></i>';
                          }
                          ?>
                        </td>
                        <td class="text-center">
                          <?php
                          if($row_product['publicado']!='N'){
                            echo "Sim";
                          }
                          else{
                            echo "<span class='c-red'>Não</span>";
                          }
                          ?>
                        </td>
                        <td class="text-center">
                          <a href="editar_produto.php?id=<?php echo $row_product['id_produto']; ?>" class="btn btn-info btn-xs"><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Editar"></i></a>
                          <?php if($row_logged['categoria']=='S'){ ?>
                            <a href="#" onclick="javascript: if (confirm('Essa ação é irreversível, tem certeza que deseja excluir esse produto?'))location.href='deletions.php?id_produto=<?php echo $row_product['id_produto']; ?>; ?>'" class="btn btn-danger btn-xs"><i class="fa fa-remove" data-toggle="tooltip" data-placement="top" title="Excluir"></i></a>
                            <?php } ?>
                          </td>
                        </tr>
                        <?php } while ($row_product = mysql_fetch_assoc($result_product)); ?>
                      </tbody>
                    </table>
                    <?php }
                    else{ ?>
                      <div class="text-center">
                        <h3>Nenhum produto foi cadastrado ainda, vamos começar?</h3>
                        <a class="btn btn-primary btn-lg" href="cad_produto.php" role="button">Cadastrar produto</a>
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

            <script>
            window.onload = function(){
              document.getElementById('conteudo').style.display = "block";
              setTimeout(function() {
                document.getElementById('carregando').style.display = "none";
              }, 2000);
            }
            </script>
          </body>
          </html>
