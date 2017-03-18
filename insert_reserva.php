<style type="text/css">
#loading {
	position:absolute;
	top:50%;
	left:50%;
	margin-top:-50px;
	margin-left:-50px;
}
</style>
<!-- Font Awesome -->
<link rel="stylesheet" href="admin/dist/font-awesome-4.7.0/css/font-awesome.min.css">
<div id="loading">
	<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
	<span class="sr-only">Carregando...</span>
</div>

<?php
require_once('Connections/conexao.php');

//CADASTRO DE RESERVA
if ((isset($_POST["insert"])) && ($_POST["insert"] == "insert_reserve")) {
	$name = $_POST['name'];
	$name = addslashes($name);
  $date_reserve = $_POST['date_reserve'];
	$email = $_POST['email'];
	$time = $_POST['time'];
  $phone = $_POST['phone'];
  $people = $_POST['people'];
  $message = $_POST['message'];

	$query = "INSERT INTO reserva (nome, email, telefone, data_reserva, horario, n_pessoas, mensagem, status) VALUES ('$name', '$email', '$phone', '$date_reserve', '$time', '$people', '$message', '1')";
	// Executa a query
	$inserir = mysql_query($query);
	if ($inserir) {
		//Redireciona
		echo "<script>location.href='index.php?insert=success';</script>";
	} else {
		echo "<script>location.href='index.php?insert=erro';</script>";
	}
}

?>
