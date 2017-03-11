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
include 'verification_super.php';


// DELETAR PRODUTO
if (isset($_GET['id_produto']) && $_GET['id_produto'] != "") {
	$id = $_GET['id_produto'];

	$sql = sprintf("DELETE FROM produtos WHERE id_produto='$id'");

	mysql_select_db($database, $connection);
	$result = mysql_query($sql,$connection) or die ("Error in table selection.");

	echo "<script>location.href='listar_produtos.php?deletion=success';</script>";

}

?>
