<?php
session_start();
unset($_SESSION["email"]); // limpa a variável
session_destroy(); // destroi a sessao
header("location: login.php"); // vai para a pagina de login
?>
