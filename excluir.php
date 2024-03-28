
<?php

session_start();
ob_start(); //limpar o banco de memoria

//1-conectando com o banco de dados
include("conexao.php");
$conn = conectar();

//2-Recebero id do usuário atraveis da URL
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);


//3-Verificando se existe um ID, caso não exista, retornar para listar2.php
if(empty($id))
{
    $_SESSION['msg'] = "<p style='color:#f00;text-align:center;'>Erro: Usuário não encontrado</p>";
    header("Location: listar2.php");
}

//4-Pesquisar no Banco de Dados pelo id do usuário selecionado
$query_usuario = "SELECT id FROM usuarios WHERE id = $id LIMIT 1";

//5- Preparar a query (consulta)
$result_usuario = $conn-> prepare($query_usuario);

//6-Executar a consultar
$result_usuario->execute();

//7- Verificar se encontrou um usuário no banco de dados
if($result_usuario->rowCount() != 0){
    // Excluir o registro no banco de dados
 $query_del_usuario = "DELETE FROM usuarios WHERE id=$id";
 // preparando a exclusão
 $result_del_usuario = $conn->prepare($query_del_usuario);
 // Realizar a execução da exclusão
if($result_del_usuario->execute()){

     //enviando a msg de exclusão para documento lister2
    $_SESSION['msg'] = "<p style='color: green; text-align: center;'>Usuário excluido com sucesso</p>";
    header("Location: listar2.php");

} else{
    $_SESSION['msg'] = "<p style='color: #f00; text-align: center;'>Usuário não excluido</p>";
    header("Location: listar2.php");

}



} else{

    // retorno para usuário
    $_SESSION['msg'] = "<p style='color: #f00; text-align: center;'>Usuário não encontrado</p>";
    header("Location: listar2.php");

}








?>