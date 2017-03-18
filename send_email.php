<style type="text/css">
#loading {
	position:absolute;
	top:50%;
	left:50%;
	margin-top:-50px;
	margin-left:-50px;
}
</style>

<!-- Font Awesome (loading icon) -->
<link rel="stylesheet" href="admin/dist/font-awesome-4.7.0/css/font-awesome.min.css">
<div id="loading">
	<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
	<span class="sr-only">Carregando...</span>
</div>

<?php
if(isset($_POST['email']) AND $_POST['email']!=NULL){
/* email que irá disparar a msg */
$emailsender='thaisvmendonca@gmail.com';

/* Verifica qual é o sistema operacional do servidor para ajustar o cabeçalho de forma correta.  */
if(PATH_SEPARATOR == ";") $quebra_linha = "\r\n"; //Se for Windows
else $quebra_linha = "\n"; //Se não for Windows"

// Passando os dados obtidos pelo formulário de contato para as variáveis abaixo
$nomeremetente     = $_POST['name'];
$emailremetente    = $_POST['email'];
$assunto           = $_POST['subject'];
$mensagem          = $_POST['message'];
$emaildestinatario = 'thaisvmendonca@gmail.com';
$mensagemHTML = '<b>De: '.$nomeremetente.'</b><br/>
<b>Responder para: '.$emailremetente.'</b><br/>
<p>'.$mensagem.'</p>';

/* Montando o cabeçalho da mensagem */
$headers = "MIME-Version: 1.1" .$quebra_linha;
$headers .= "Content-type: text/html; charset=iso-8859-1" .$quebra_linha;
// Perceba que a linha acima contém "text/html", sem essa linha, a mensagem não chegará formatada.
$headers .= "From: " . $emailsender.$quebra_linha;
$headers .= "Reply-To: " . $emailremetente . $quebra_linha;
// Note que o e-mail do remetente será usado no campo Reply-To (Responder Para)

/* Enviando a mensagem */

if(!mail($emaildestinatario, $assunto, $mensagemHTML, $headers ,"-r".$emailsender)){
  $headers .= "Return-Path: " . $emailsender . $quebra_linha;
  mail($emaildestinatario, $assunto, $mensagemHTML, $headers );
}

/* Fim do envio de email */

/* Exibe msg de sucesso e redireciona para o site */
echo "<script>alert('Sucesso! Sua mensagem foi enviada, em breve entraremos em contato.');</script>";
echo "<script>location.href='index.php';</script>";

}
/* se nenhum email for informado, exibe msg de erro */
else{
  echo "<script>alert('ERRO.');</script>";
  echo "<script>location.href='index.html'</script>";
}
?>
