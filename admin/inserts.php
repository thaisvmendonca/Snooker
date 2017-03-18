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

//CADASTRO DE ADMIN
if ((isset($_POST["insert"])) && ($_POST["insert"] == "insert_admin")) {
	$name = $_POST['name'];
	$name = addslashes($name); // funcao que permite apostrofo
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$category = $_POST['permission'];

	$query = "INSERT INTO admin (nome, email, senha, categoria, ativo) VALUES ('$name', '$email', '$password', '$category', 'S')";
	// Executa a query
	$inserir = mysql_query($query);
	if ($inserir) {
		//Redireciona
		echo "<script>location.href='listar_admin.php?insert=success';</script>";
	} else {
		echo "<script>location.href='cad_admin.php?insert=erro';</script>";
	}
}

//CADASTRO DE PRODUTO
if ((isset($_POST["insert"])) && ($_POST["insert"] == "insert_product")) {
	$name = $_POST['name'];
	$name = addslashes($name);
	$category = $_POST['category'];
	$description = $_POST['description'];
	$description = addslashes($description);
	$price = $_POST['price'];
	$published = $_POST['published'];
	$admin = $_SESSION['id_admin'];

	$query = "INSERT INTO produtos (nome, categoria, descricao, preco, publicado, admin_id_admin) VALUES ('$name', '$category', '$description', '$price', '$published', '$admin')";
	// Executa a query
	$inserir = mysql_query($query);
	if ($inserir) {
		//Redireciona
		echo "<script>location.href='cad_produto.php?insert=success';</script>";
	} else {
		//echo mysql_error();
		echo "<script>location.href='cad_produto.php?insert=erro';</script>";
	}
}

?>
