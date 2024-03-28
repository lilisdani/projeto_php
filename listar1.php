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
    <div style="width:100%;">
        <h1 style="float: left;">Listar Registros</h1>
        <h1 style="float: right;"><a href="cadastro.php">Cadastrar</a></h1>
    </div>

    <hr style="width:100%;">
    <br>

    <?php
        //2-Preparando a consulta de registro de usuários
        $query_usuarios = $conn->prepare("SELECT id, matricula, nome, email, estatus, dtcadastro FROM usuarios ORDER BY dtcadastro DESC");

        //3-Executando a consulta
        $query_usuarios->execute();
    ?>
    <!--Criando uma Tabela para organizar os registros-->
    <br>
   
    <table style="width: 100%; margin: 15px auto;">
        <thead>
            <tr><!--Primeira linha da tabela-->
                <th style="background-color: #E6E6FA; padding: 10px;">ID</th>
                <th style="background-color: #E6E6FA; padding: 10px;">Matrícula</th>
                <th style="background-color: #E6E6FA; padding: 10px;">Nome</th>
                <th style="background-color: #E6E6FA; padding: 10px;">E-mail</th>
                <th style="background-color: #E6E6FA; padding: 10px;">Estatus</th>
                <th style="background-color: #E6E6FA; padding: 10px;">Data cadastro</th>
                <th style="background-color: #E6E6FA; padding: 10px;">Ações</th>
            </tr>
        </thead>
    

    <?php
    //4-Verificando se encontrou registros no Banco de Dados
    if($query_usuarios->rowCount() != 0){

        //5-Transformando em um Array Associativo e Percorrendo com While
        while($rowusuarios = $query_usuarios->fetch(PDO::FETCH_ASSOC)){
            echo "<tr align=center>"; //Criando a 2ª linha da tabela
                extract($rowusuarios);
                echo "<td>" . $id . "</td>";
                echo "<td>" . $matricula . "</td>";
                echo "<td>" . $nome . "</td>";
                echo "<td>" . $email . "</td>";
                echo "<td>" . $estatus . "</td>";
                echo "<td>" . date("d/m/Y H:i:s", strtotime($dtcadastro)) ."</td>";
                echo "<td><a href=#>[Editar]</a> <a href=#>[Excluir]</a> </td>";
            echo "</tr>";
        }
    ?>
    <!--Encerrar a tabela-->
    </table>

    <?php
    }else{
        echo "<p style='color:red;'>Erro: Usuário não encontrado</p>";
    }

    ?>
    
</body>
</html>