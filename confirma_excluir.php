<?php
//1-Recebero id do usuário atraveis da URL
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

//2-Criar a mensagem de confirmação de exclusão
 echo "<br>";
 
 echo "<P style='color: #f00;'>Deseja realmente excluir esse usuário?</p>";

 echo"<a href='excluir.php?id=$id'> sim </a>  |  ";

 echo"<a href='listar2.php'> não </a>";




?>