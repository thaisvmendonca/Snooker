<?php require_once('../Connections/conexao.php');

//LOGIN --------------------------------------------
// testa se algo foi enviado pelo formulário de login
if ((isset($_POST["login"])) && ($_POST["login"] == "login")) {

  $email = $_POST['email'];
  $password = md5($_POST['password']);

  //Comando SQL de verificação de autenticação
  $sql = "SELECT * FROM admin WHERE email = '$email' AND senha = '$password'";

  $result = mysql_query($sql,$connection) or die ("Error in table selection.");
  $row = mysql_fetch_assoc($result); // recebe os dados do result

  if($row['ativo']!='N'){

    //Caso consiga logar cria a sessão
    if (mysql_num_rows ($result) > 0) {
      // session_start inicia a sessão
      session_start();

      $_SESSION['id_admin'] = $row['id_admin']; // guarda o ID do admin
      $_SESSION['email'] = $row['email']; // guarda o email do admin
      $_SESSION['permission'] = $row['categoria']; // guarda a permissão do admin

      //Redireciona para o dashboard/
      header('location:index.php');
    }

    //Caso algo de errado (como senha inválida) redireciona para a página de autenticação
    else {
      //Limpa
      unset ($_POST['email']);
      unset ($_POST['password']);

      //Redireciona para a página de autenticação com mensagem de erro
      header('location:login.php?login=erro');

    }


  }
  else{
    // usuário bloqueado
    header('location:login.php?admin=blocked');
  }

}

//FIM DO LOGIN -------------------------------------
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login - Área administrativa</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="dist/font-awesome-4.7.0/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/style.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <b>Login</b> Administrativo
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Acesso restrito a equipe Snnoker!</p>
      <!-- mensagem email ou senha digitados errados -->
      <?php if ((isset($_GET["login"])) && ($_GET["login"] == "erro")) { ?>
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-ban"></i> Ops!</h4>
          Confira se digitou seu e-mail e senha corretamente e tente outra vez.
        </div>
        <?php } ?>

        <!-- caso admin esteja bloqueado -->
        <?php if ((isset($_GET["admin"])) && ($_GET["admin"] == "blocked")) { ?>
          <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i> Ops!</h4>
            Parece que sua conta foi desativada por um Super administrador.
          </div>
          <?php } ?>

          <!-- esqueci senha: Email não encontrado -->
          <?php if ((isset($_GET["forget_password"])) && ($_GET["forget_password"] == "erro")) { ?>
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-ban"></i> Ops!</h4>
              Não encontramos nenhum cadastro vinculado ao e-mail <b><?php echo $_GET['email']; ?></b>.
            </div>
            <?php } ?>
            <!-- esqueci senha: email encontrado, e mansagem enviada -->
            <?php if ((isset($_GET["forget_password"])) && ($_GET["forget_password"] == "success")) { ?>
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Yes!</h4>
                Confira a caixa de entrada do e-mail <b><?php echo $_GET['email']; ?></b>, enviamos um link de redefinição de senha para ele. Caso a mensagem não esteja em sua caixa de entrada, confira a caixa de spans.
              </div>
              <?php } ?>

              <!-- Formulario de Login -->
              <form action="login.php" method="post">
                <div class="form-group has-feedback">
                  <input type="email" class="form-control" name="email" placeholder="E-mail" required>
                  <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                  <input type="password" class="form-control" name="password" placeholder="Senha" required>
                  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <input type="hidden" name="login" value="login">
                <button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fa fa-sign-in"></i> Entrar</button>
              </form>

              <br><br>

              <a role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Esqueci senha <i class="fa fa-frown-o"></i></a><br>
              <div class="collapse" id="collapseExample">
                <div class="well">
                  <!-- Formulário esqueci senha -->
                  <form action="forget_password.php" method="post">
                    <div class="form-group has-feedback">
                      <label>Informe o e-mail cadastrado:</label>
                      <input type="email" class="form-control" name="email" placeholder="E-mail" required>
                      <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fa fa-send"></i> Enviar</button>
                  </form>
                </div>
              </div>
            </div>
            <!-- /.login-box-body -->
          </div>
          <!-- /.login-box -->

          <!-- jQuery 2.2.3 -->
          <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
          <!-- Bootstrap 3.3.6 -->
          <script src="bootstrap/js/bootstrap.min.js"></script>
        </body>
        </html>
