<?php
    //Verificando se a sessão de usuário não existe
    //Caso seja verdadeiro, redirecionar para o login.
    if(!$_SESSION['usuario']){
        header('Location: login.php');
        exit();
    }
?>