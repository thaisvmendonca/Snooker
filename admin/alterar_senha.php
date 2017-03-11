<?php
require_once('../Connections/conexao.php');
include 'verification.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Alterar senha - Snooker</title>
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
          Alterar senha
        </h1>
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-sitemap"></i> Dashboard</a></li>
          <li class="active">Alterar senha</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <!-- Box cadastro -->
        <div class="row">
          <div class="col-md-6 col-md-offset-3">
            <!-- general form elements -->
            <div class="box">

              <?php if ((isset($_GET["update"])) && ($_GET["update"] == "success")) { ?>
                <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h4><i class="icon fa fa-check"></i> Sucesso!</h4>
                  Sua senha foi alterada.
                </div>
                <?php } ?>

                <?php if ((isset($_GET["update"])) && ($_GET["update"] == "erro")) { ?>
                  <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i> Ops! Algo deu errado.</h4>
                    Desculpe, tente novamente. Caso o erro persista procure o suporte técnico.
                  </div>
                  <?php } ?>

                  <!-- /.box-header -->
                  <!-- form start -->
                  <form method="post" id="register" action="updates.php">
                    <div class="box-body">
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="password">Nova senha</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Digite a nova senha">
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="confirm_password">Confirme a senha</label>
                            <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Redigite a senha">
                          </div>
                        </div>

                      </div>
                      <input type="hidden" name="update" value="update_password">

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

        <div class="control-sidebar-bg"></div>

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

      <script src="plugins/validation/jquery.validate.js" type="text/javascript"></script>
      <script>
      $(document).ready( function() {

        $("#register").validate({
          // Define as regras

          rules:{
            password: {
              required: true,
              minlength: 4
            },
            confirm_password: {
              required: true,
              minlength: 4,
              equalTo: "#password"
            }

          },
          // Define as mensagens de erro para cada regra
          messages:{
            password: {
              required: "Por favor, escolha uma senha.",
              minlength: "A senha deve conter pelo menos 4 caracteres."
            },
            confirm_password: {
              required: "Por favor, digite a senha novamente.",
              minlength: "A senha deve conter pelo menos 4 caracteres.",
              equalTo: "A senha deve ser idêntica a digitada anteriormente."
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
    </body>
    </html>
