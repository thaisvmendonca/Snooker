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
<link rel="stylesheet" href="dist/font-awesome-4.7.0/css/font-awesome.min.css">
<div id="loading">
	<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
	<span class="sr-only">Carregando...</span>
</div>

<?php
require_once('../Connections/conexao.php');
include 'verification.php';

// EDITAR ADMIN
if ((isset($_POST["update"])) && ($_POST["update"] == "update_admin")) {
	$id_admin = $_POST['id_admin'];
	$name = $_POST['name'];
	$name = addslashes($name);
	$email = $_POST['email'];
	$category = $_POST['category'];
	$active = $_POST['active'];
	$registration_date = $_POST['registration_date'];

	// update
	$query = "UPDATE admin SET nome='$name', email='$email', categoria='$category', ativo='$active', cadastro='$registration_date' WHERE id_admin='$id_admin'";
	// Executa a query
	$inserir = mysql_query($query);
	if ($inserir) {
		//Redireciona
		echo "<script>location.href='listar_admin.php?name=$name&update=success';</script>";
	} else {
		echo mysql_error();
		//echo "<script>location.href='editar_admin.php?id=$id_admin&update=erro';</script>";
	}
}

// ALTERAR SENHA
if ((isset($_POST["update"])) && ($_POST["update"] == "update_password")) {
	$id_admin = $_SESSION['id_admin'];
	$password = md5($_POST['password']);

	// update
	$query = "UPDATE admin SET senha='$password' WHERE id_admin='$id_admin'";
	// Executa a query
	$inserir = mysql_query($query);
	if ($inserir) {
		//Redireciona
		echo "<script>location.href='alterar_senha.php?update=success';</script>";
	} else {
		echo "<script>location.href='alterar_senha.php?update=erro';</script>";
	}
}

// EDITAR PRODUTO
if ((isset($_POST["update"])) && ($_POST["update"] == "update_product")) {
	$id_product = $_POST['id_product'];
	$name = $_POST['name'];
	$name = addslashes($name);
	$category = $_POST['category'];
	$description = $_POST['description'];
	$description = addslashes($description);
	$price = $_POST['price'];
	$published = $_POST['published'];
	$registration_date = $_POST['registration_date'];

	// update
	$query = "UPDATE produtos SET nome='$name', categoria='$category', descricao='$description', preco='$price', publicado='$published', cadastro='$registration_date' WHERE id_produto='$id_product'";
	// Executa a query
	$inserir = mysql_query($query);
	if ($inserir) {
		//Redireciona
		echo "<script>location.href='listar_produtos.php?name=$name&update=success';</script>";
	} else {
		echo "<script>location.href='editar_produto.php?id=$id_product&update=erro';</script>";
	}
}

// EXIBIR PREÇO
if (isset($_GET["view"])) {
	$view = $_GET['view'];

	// update
	$query = "UPDATE exibir_precos SET exibir='$view'";
	// Executa a query
	$inserir = mysql_query($query);
	if ($inserir) {
		//Redireciona
		echo "<script>location.href='index.php';</script>";
	} else {
		echo "<script>location.href='index.php?update=erro';</script>";
	}
}

// GERENCIAR RESERVAS
if (isset($_GET["reserve"])) {
	$reserve = $_GET['reserve'];
	$id_reserva = $_GET['id'];

	// update
	$query = "UPDATE reserva SET status='$reserve' WHERE id_reserva='$id_reserva'";
	// Executa a query
	$inserir = mysql_query($query);
	if ($inserir) {
		//Redireciona
		echo "<script>location.href='index.php';</script>";
	} else {
		echo "<script>location.href='index.php?update=erro';</script>";
	}
}

?>
