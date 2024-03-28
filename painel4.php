<?php
    session_start();  //Iniciando uma sessão

    //Chamando um script para verificar a existencia de uma sessão
    include('scriptverificalogin.php');

?>

<!--Mostrar o nome do usuário logado-->
<div align="right">
    <h2>Olá, <?php echo $_SESSION['usuario']; ?> </h2>
</div>

<!--Link para encerrar a sessão do usuário-->
<nav align="right">
    <h3><a href="scriptlogout.php">Logout</a></h3>
</nav>

<div align="center"><br><br>
    <h1>Usuário sem nível de acesso</h1>
    <h2>Por favor, entre em contato com o administrador!</h2>
</div>