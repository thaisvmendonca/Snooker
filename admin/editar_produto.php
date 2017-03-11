<?php
require_once('../Connections/conexao.php');
include 'verification.php';
$id_produto = $_GET['id'];
$sql = "SELECT * FROM produtos WHERE id_produto=$id_produto";
$result_product = mysql_query($sql,$connection) or die ("Error in table selection.");
$row_product = mysql_fetch_assoc($result_product);
$totalRows_product = mysql_num_rows($result_product);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Editar produto - Snooker</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="dist/font-awesome-4.7.0/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/style.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
  folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/select2.min.css">

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
          Editar produto
        </h1>
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-sitemap"></i> Dashboard</a></li>
          <li><a href="listar_produtos.php">Listar produtos</a></li>
          <li class="active">Editar produto</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <!-- Box cadastro -->
        <div class="row">
          <div class="col-md-6 col-md-offset-3">
            <!-- general form elements -->
            <div class="box box-primary">

                  <?php if ((isset($_GET["update"])) && ($_GET["update"] == "erro")) { ?>
                    <div class="alert alert-danger alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h4><i class="icon fa fa-ban"></i> Ops! Algo deu errado.</h4>
                      Desculpe, tente novamente. Caso o erro persista procure o suporte técnico.
                    </div>
                    <?php } ?>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form method="post" id="register" action="updates.php" enctype="multipart/form-data">
                      <div class="box-body">

                        <div class="form-group">
                          <label for="name">Nome</label>
                          <input type="text" class="form-control" name="name" id="name" placeholder="Nome do produto" value="<?php echo $row_product['nome']; ?>" maxlength="45">
                        </div>

                        <div class="form-group">
                          <label>Categoria</label>
                          <select class="form-control select2" name="category" style="width: 100%;">
                            <option value="C"<?php if($row_product['categoria']=='C') echo 'selected';?>>Cerveja</option>
                            <option value="D"<?php if($row_product['categoria']=='D') echo 'selected';?>>Drink</option>
                            <option value="A"<?php if($row_product['categoria']=='A') echo 'selected';?>>Aperitivos</option>
                          </select>
                        </div>

                        <div class="form-group">
                          <label for="tag">Descrição</label>
                          <input type="text" class="form-control" name="description" id="description" placeholder="Informe aqui os ingrdientes do produto." value="<?php echo $row_product['descricao']; ?>">
                        </div>

                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="name">Preço</label>
                              <input type="text" class="form-control" name="price" id="price" placeholder="R$ 0,00" maxlength="9" value="<?php echo $row_product['preco']; ?>">
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="published">Publicar agora?</label>
                              <div class="radio">
                                <label>
                                  <input type="radio" name="published" value="S" <?php if($row_product['publicado']=='S') echo 'checked';?>>
                                  Sim
                                </label>
                              </div>
                              <div class="radio">
                                <label>
                                  <input type="radio" name="published" value="N" <?php if($row_product['publicado']=='N') echo 'checked';?>>
                                  Não
                                </label>
                              </div>
                            </div>

                          </div>
                        </div>

                        <input type="hidden" name="registration_date" id="registration_date" value="<?php echo $row_product['cadastro']; ?>">
                        <input type="hidden" name="id_product" id="id_product" value="<?php echo $row_product['id_produto']; ?>">
                        <input type="hidden" name="update" id="update" value="update_product">

                      </div>
                      <!-- /.box-body -->

                      <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-check"></i> Salvar</button>
                      </div>
                    </form>
                  </div>
                  <!-- /.box -->
                </div>
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
        <!-- SlimScroll 1.3.0 -->
        <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <script src="dist/js/demo.js"></script>
        <!-- Select2 -->
        <script src="plugins/select2/select2.full.min.js"></script>
        <script src="plugins/mask-money/jquery.maskMoney.js"></script>
        <script>
        $(function () {
          //Initialize Select2 Elements
          $(".select2").select2();
        });
        </script>

        <script src="plugins/validation/jquery.validate.js" type="text/javascript"></script>
        <script>
        $(document).ready( function() {

          $("#register").validate({
            // Define as regras

            rules:{
              name:{
                required: true
              }

            },
            // Define as mensagens de erro para cada regra
            messages:{
              name:{
                required: "Por favor, informe o nome do produto."
              }

            },

            highlight: function(element) {
              $(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function(element) {
              $(element).closest('.form-group').removeClass('has-error');
            },
            errorElement: 'span',
            errorClass: 'help-block',
            errorPlacement: function(error, element) {
              if(element.parent('.input-group').length) {
                error.insertAfter(element.parent());
              } else {
                error.insertAfter(element);
              }
            }

          });

        });
        </script>

        <script type="text/javascript">
        $(function(){
          $("#price").maskMoney({symbol:'R$ ',
          showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
        })
        </script>

      </body>
      </html>
