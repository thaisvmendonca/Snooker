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
<link rel="stylesheet" href="dist/font-awesome-4.7.0/css/font-awesome.min.css">
<div id="loading">
  <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
  <span class="sr-only">Carregando...</span>
</div>

<?php
require_once('../Connections/conexao.php'); //conexao com o banco
include 'verification.php'; //arquivo que verifica se admin esta logado

if(isset($_GET['id_reserva']) AND $_GET['id_reserva']!=NULL){ //teste se foi passado um id de reserva

  $id_reserva = $_GET['id_reserva'];

  //Seleciona os dados da reserva que esta sendo confirmada
  $sql = "SELECT * FROM reserva WHERE id_reserva='$id_reserva'";
  $result_reserve = mysql_query($sql,$connection) or die ("Error in table selection.");
  $row_reserve = mysql_fetch_assoc($result_reserve);
  $totalRows_reserve = mysql_num_rows($result_reserve);

  if($row_reserve['status']==1){
    $subject = 'Reserva pendente';
  }
  else if($row_reserve['status']==2){
    $subject = 'Reserva confirmada';
  }
  else if($row_reserve['status']==3){
    $subject = 'Reserva cancelada';
  }

  /* email que irá disparar a msg */
  $emailsender='thaisvmendonca@gmail.com';

  /* Verifica qual é o sistema operacional do servidor para ajustar o cabeçalho de forma correta.  */
  if(PATH_SEPARATOR == ";") $quebra_linha = "\r\n"; //Se for Windows
  else $quebra_linha = "\n"; //Se não for Windows"

  // Passando os dados da reserva para as variaveis abaixo
  $nome = $row_reserve['nome'];
  $data_reserva = $row_reserve['data_reserva'];
  $horario = $row_reserve['horario'];
  $n_pessoas = $row_reserve['n_pessoas'];
  $emaildestinatario = $row_reserve['email'];
  $nomeremetente     = 'Snooker Sport Pub';
  $emailremetente    = 'thaisvmendonca@gmail.com';
  $assunto           = $subject;
  $mensagemHTML = '<b>De: '.$nomeremetente.'</b><br/>
  <b>Responder para: '.$emailremetente.'</b><br/>
  <p>
  Olá '.$nome.'.<br/>
  Status da reserva: '.$subject.'<br/>
  Data: '.$data_reserva.'<br/>
  Horário: '.$horario.'<br>
  Nº de pessoas na mesa: '.$n_pessoas.'<br/>

  Agradecemos a preferência!
  </p>';

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
  echo "<script>alert('Um E-mail de confirmação foi enviado para o cliente.');</script>";
  echo "<script>location.href='index.php';</script>";

}
/* se nenhum email for informado, exibe msg de erro */
else{
  echo "<script>alert('ERRO.');</script>";
  echo "<script>location.href='index.php'</script>";
}
?>
