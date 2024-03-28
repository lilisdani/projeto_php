<?php
session_start(); //Inicando uma sessão

//1-Conectar o Banco de Dados
include("conexao.php");
$conn=conectar();

//2- Verificar se os campos estão vazios
if(empty($_POST["email"]) || empty($_POST["senha"])){
    header("Location:login.html"); //Redirecionando para a página de login

    exit();
}

//3-Recuperando os dados do formulário
$email=$_POST['email'];
$senha=MD5($_POST['senha']);

//4-Criar uma Query no Banco de Dados para validar os dados do usuário.
$query = $conn->prepare("SELECT id FROM usuarios WHERE  email=:e and senha=:s");

//5-Validar os dados do usuário através do método bindValue
$query->bindValue(":e", $email);
$query->bindValue(":s", $senha);

//6-Executando a consulta com o método execute()
$query->execute();

//7-Armazenando o resultado da validação dos dados do usuário
$row=$query->rowCount();

//echo $row;

//8-Criando um Sistema de Login com Nível de Acesso
if($row==1){
    $verificar = $conn->query("SELECT *FROM usuarios");

    while ($linha = $verificar->fetch(PDO::FETCH_ASSOC)){
        if($linha['email'] == $email){
            $nivel = $linha['painel'];

            switch($nivel){
                case 'Administrador':
                    $_SESSION['usuario'] = $email;
                    header('Location: painel1.php');
                    exit();
                    break;
                case 'Professor':
                    $_SESSION['usuario'] = $email;
                    header('Location: painel2.php');
                    exit();
                    break;
                case 'Aluno':
                    $_SESSION['usuario'] = $email;
                    header('Location: painel3.php');
                    exit();
                    break;
                default:
                    $_SESSION['usuario'] = $email;
                    header('Location: painel4.php');
                    exit();
                    break;
            }
        }
    }
}else
{
    $_SESSION['nao_autenticado']=true;
    header('Location:login.php');
    exit();
}



//8-Criar um sistema de login simples com uma única sessão de usuário
/*
if($row==1){
    $_SESSION['usuario']=$email;
    header('Location:painel.php');
    exit();
}else{
    $_SESSION['nao_autenticado']=true;
    header('Location:login.php');
    exit();
}
*/



?>