<?php

 //inicilalizar a sessão
 session_start();
//1-Conectar com o Banco de Dados
include("conexao.php");
$conn = conectar();

//2-Receber o ID do usuário através da URL, utilizando o método GET
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

//3-Verificando se existe um ID, caso não exista, retornar para listar2.php
if(empty($id))
{
    $_SESSION['msg'] = "<p style='color:#f00;text-align:center;'>Erro: Usuário não encontrado</p>";
    header("Location: listar2.php");
}

//4-Pesquisar no Banco de Dados pelo id do usuário selecionado
$query_usuario = "SELECT id, matricula, nome, email, estatus, dtcadastro FROM usuarios WHERE id = $id LIMIT 1";

//5-Preparando a query
$result_usuario = $conn->prepare($query_usuario);

//6-Executando a nossa consulta
$result_usuario->execute();

//7-Verificando se encontrou usuário no Banco de Dados
if(($result_usuario) and ($result_usuario->rowCount() !=0))
{
    $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC); //Armazenando os dados em um array associativo
}else{
    $_SESSION['msg'] = "<p style='color:#f00;'>Erro: Usuário não encontrado</p>";
    header("Location: listar2.php");
}



?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualização de registros</title>

    <style>
        .edicao{
            width:100%;
            max-width: 700px;
            margin: 10px auto;
            background-color: rgb(219, 218, 218);
            padding: 20px;
            border-radius: 5px;
            margin-top: 10px;
            font-family: Arial; 
        }

        input{
            width: 90%;
            padding: 10px 5px;
            border-radius: 5px;
            outline-color: #cdf;
        }

        label{
            font-weight: bold;
        }

        .atualizar{
            text-align: center;
            outline-color: #cdf;
        }

        header{
            text-align:center;
            padding-bottom: 20px;
            padding-top: 20px;
        }
    </style>
</head>
<body>
    <?php
        //8-Recebendo dados do formulário através do Método POST
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
        //9-Verifica se o usuário clicou no botão "Atualizar"
        if(!empty($dados['EditUsuario']))
        {
            $empty_input = false; //Aplicando algumas validações

            array_map('trim', $dados); //Retirando os espaços em branco no início e no final

            //10-Verificando se há algum campo em branco
            if(in_array("",$dados))
            {
                $empty_input = true;
                echo"<p style='color:#f00;'>Erro: é necessário preencher TODOS os campos!!!</p>";

            //11-Verificando se a estrutura e-mail informada pelo usuário é válida
            }elseif(!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)){

                $empty_input = true;
                echo"<p style='color:#f00;'>Erro: é necessário preencher com o e-mail válido!!!</p>";

            }

            //12-Verificar se não há erros. Se verdadeiro, atualizar o Banco de dados
            if(!$empty_input)
            {
                //Implementar o UPDATE no Banco de Dados
                $query_up_usuario = "UPDATE usuarios SET matricula=:matricula, nome=:nome, email=:email, estatus=:estatus WHERE id=:id";

                //Preparando a Query de atualização
                $edit_usuario = $conn->prepare($query_up_usuario);
                //13 passando os valores do array de $dados para os pseudo-nomes
                $edit_usuario->bindparam(':matricula',$dados['matricula'],PDO::PARAM_INT);
                $edit_usuario->bindparam(':nome',$dados['nome'],PDO::PARAM_STR);
                $edit_usuario->bindparam(':email',$dados['email'],PDO::PARAM_STR);
                $edit_usuario->bindparam(':estatus',$dados['estatus'],PDO::PARAM_STR);
                $edit_usuario->bindparam(':id',$id,PDO::PARAM_INT);

                //14-verificando se aexecução da query de atualiazação foi realizada com sucesso

                if($edit_usuario->execute()){
                    $_SESSION['msg']="<p style ='color:green;'> Usuário atualizado com sucesso </p>";
                    header("Location: listar2.php");

                }else{
                    echo"<p style='color:#f00;'> Usuário não atualizado </p>";
                }

            }
        }

    ?>
    <header>
        <h1>Edição de Registros</h1>
    </header>

    <!-----------------------------------Criando o formulário para edição de registros----------------------------------->
    <div class="edicao">
        <form action="" method="POST">
            <label>Matrícula: </label><br>
            <input type="int" name="matricula" id="matricula" placeholder="Digite uma matrícula" value="<?php
            //verificar se os dados de atualiazação veio do formulário.
            if(isset($dados ['matricula'])){
                echo $dados['matricula'];
              //verificar se os dados de atualização veio do banco de dados.
            } else if(isset($row_usuario['matricula'])) {
                  echo $row_usuario['matricula'];


            }
            
            ?>"><br><br>

            <label>Nome: </label><br>
            <input type="text" name="nome" id="nome" placeholder="Digite seu Nome completo" value="<?php

            //verificar se os dados de atualiazação veio do formulário.
            if(isset($dados ['nome'])){
                echo $dados['nome'];
              //verificar se os dados de atualização veio do banco de dados.
            } else if(isset($row_usuario['nome'])) {
                  echo $row_usuario['nome'];


            }
            
            
            ?>"><br><br>

            <label>E-mail: </label><br>
            <input type="email" name="email" id="email" placeholder="Digite o melhor e-mail" value="<?php
            //verificar se os dados de atualiazação veio do formulário.
            if(isset($dados ['email'])){
                echo $dados['email'];
              //verificar se os dados de atualização veio do banco de dados.
            } else if(isset($row_usuario['email'])) {
                  echo $row_usuario['email'];


            }
            
            
            
            ?>"><br><br>

            <label>Status: </label><br>
            <input type="text" name="estatus" id="estatus" value="<?php
            //verificar se os dados de atualiazação veio do formulário.
            if(isset($dados ['estatus'])){
                echo $dados['estatus'];
              //verificar se os dados de atualização veio do banco de dados.
            } else if(isset($row_usuario['estatus'])) {
                  echo $row_usuario['estatus'];


            }
            
            ?>"><br><br><br>

            <div class="atualizar">
                <input type="submit" value="Atualizar" name="EditUsuario">
            </div>
        </form>
    </div>
    <!---------------------------------------------Fim do formulário----------------------------------------------------->
    
</body>
</html>