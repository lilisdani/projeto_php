<?php
    session_start();  //Iniciando uma sessão

    //Chamando um script para verificar a existencia de uma sessão
    include('scriptverificalogin.php');

?>

<!--Mostrar o nome do usuário logado-->
<div align="right">
    <h2>Olá, <?php echo $_SESSION['usuario']; ?> </h2>
</div>


<nav align="right">
     <!--Link para listar usuários-->
     <h3><a href="listar2.php">Listar Usuários</a></h3>

    <!--Link para encerrar a sessão do usuário-->
    <h3><a href="scriptlogout.php">Logout</a></h3>
</nav>

<div align="center"><br><br>
    <h1>Painel do Administrador</h1>
</div>