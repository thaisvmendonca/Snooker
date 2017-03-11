<?php
require_once('../Connections/conexao.php');

if(isset($_POST['email'])){
  $email=$_POST['email'];
  $sql = "SELECT nome, email, senha FROM admin WHERE email='$email'";
  $result = mysql_query($sql,$connection) or die ("Error in table selection.");
  $row_user = mysql_fetch_assoc($result);
  $totalRows_user = mysql_num_rows($result);
  $user_name = $row_user['nome'];
  $password = $row_user['senha'];

  if($totalRows_user > 0){
    /* envia email para o usuário */
    $emailsender='thaisvmendonca@gmail.com';

    /* Verifica qual Ã©o sistema operacional do servidor para ajustar o cabeÃ§alho de forma correta.  */
    if(PATH_SEPARATOR == ";") $quebra_linha = "\r\n"; //Se for Windows
    else $quebra_linha = "\n"; //Se "nÃƒÂ£o for Windows"

    // Passando os dados obtidos pelo formulÃ¡rio para as variÃ¡veis abaixo
    $nomeremetente     = 'Equipe Cante!';
    $emailremetente    = 'thaisvmendonca@gmail.com';
    $assunto           = 'Redefinir senha - Cante!';
    $emaildestinatario = $_POST['email'];
    $mensagemHTML = '<h3>Olá '.$user_name.'!</h3>
    <p>
    <h2>
    <a href="http://AQUIOLINK/admin/forget_password_login.php?email='.$email.'&senha='.$password.'">
    Clique aqui para redefinir sua senha.
    </a>
    </h2>
    <br/><br/>
    Equipe Cante!
    </p>';

    /* Montando o cabeÃƒÂ§alho da mensagem */
    $headers = "MIME-Version: 1.1" .$quebra_linha;
    $headers .= "Content-type: text/html; charset=iso-8859-1" .$quebra_linha;
    // Perceba que a linha acima contÃ©m "text/html", sem essa linha, a mensagem nÃ£o chegarÃ¡ formatada.
    $headers .= "From: " . $emailsender.$quebra_linha;
    $headers .= "Reply-To: Mensagem automática, não responder." . $quebra_linha;
    // Note que o e-mail do remetente serÃ¡ usado no campo Reply-To (Responder Para)

    /* Enviando a mensagem */

    if(!mail($emaildestinatario, $assunto, $mensagemHTML, $headers ,"-r".$emailsender)){ // Se for Postfix
      $headers .= "Return-Path: " . $emailsender . $quebra_linha; // Se "nÃ£o for Postfix"
      mail($emaildestinatario, $assunto, $mensagemHTML, $headers );
    }

    /* Fim do envio de email */

    echo "<script>location.href='login.php?forget_password=success&email=$email'</script>";

  }
  else{
    echo "<script>location.href='login.php?forget_password=erro&email=$email'</script>";
  }
}
else{
  echo "<script>location.href='login.php'</script>";
}
?>
