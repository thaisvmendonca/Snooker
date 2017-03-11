<?PHP

//Caso o usuário não seja super admmin
if ($_SESSION['permission']!='S') {

    //Redireciona
    header('location:restrito.php');
}
?>
