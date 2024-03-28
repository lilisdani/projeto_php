<?php
    session_start();
    session_destroy(); //Encerrar as sessões abertas

    header('Location:index.html');//Redirecionando o usuário para home

?>