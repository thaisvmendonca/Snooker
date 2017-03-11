<?PHP
session_start();

//Caso o usuário não esteja autenticado, limpa os dados e redireciona
if ( !isset($_SESSION['email'])) {
    //Destroi a sessão
    session_destroy();

    //Limpa
    unset ($_SESSION['email']);

    //Redireciona para a página de autenticação
    header('location:login.php');
}
?>
