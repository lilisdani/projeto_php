<?php
    //1-Realizando a conexão com o Banco de Dados
    include("conexao.php");
    $conn=conectar();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar registros</title>
</head>
<body>
    <h1 align="center">Listar Registros</h1>
    <hr>

    <?php
    //2-Preparando a consulta de registro de usuários
    $query_usuarios = $conn->prepare("SELECT id, matricula, nome, email, estatus, dtcadastro FROM usuarios");

    //3-Executando a consulta
    $query_usuarios->execute(); 

    //4-Verificando se encontrou registros no Banco de Dados
    if($query_usuarios->rowCount() != 0){

        //5-Transformando em um Array Associativo e Percorrendo com While
        while($rowusuarios = $query_usuarios->fetch(PDO::FETCH_ASSOC)){

            extract($rowusuarios);
            echo "ID: $id <br>";
            echo "Matricula: $matricula <br>";
            echo "Nome: $nome <br>";
            echo "E-mail: $email <br>";
            echo "Estatus: $estatus <br>";
            echo "Data: " . date("d/m/Y H:i:s", strtotime($dtcadastro)) ."<br><br>";
        }
    }else{
        echo "<p style='color:red;'>Erro: Usuário não encontrado</p>";
    }

    ?>
    
</body>
</html>