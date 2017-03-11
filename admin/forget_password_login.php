<?php require_once('../Connections/conexao.php');

//LOGIN --------------------------------------------
// testa se algo foi enviado pelo formulário de login
if ((isset($_GET["email"])) && (isset($_GET["senha"]))) {

  $email = $_GET['email'];
  $password = $_GET['senha'];

  //Comando SQL de verificação de autenticação
  $sql = "SELECT * FROM admin WHERE email = '$email' AND senha = '$password'";

  $result = mysql_query($sql,$connection) or die ("Error in table selection.");
  $row = mysql_fetch_assoc($result); // recebe os dados do result

  if($row['ativo']!='N'){

    //Caso consiga logar cria a sessão
    if (mysql_num_rows ($result) > 0) {
      // session_start inicia a sessão
      session_start();

      $_SESSION['id_admin'] = $row['id_admin'];
      $_SESSION['email'] = $row['email'];
      $_SESSION['permission'] = $row['categoria'];

      //Redireciona para pagina de redefinição
      header('location:alterar_senha.php');
    }

    //Caso algo de errado (como senha inválida) redireciona para a página de autenticação
    else {
      //Destrói
      session_destroy();

      //Limpa
      unset ($_SESSION['id_admin']);
      unset ($_GET['email']);
      unset ($_GET['senha']);

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
