<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/img/logo.jpg">
    <link rel="stylesheet" href="assets/css/stylelogin.css">
    <title>Tecnologias Web - HTML e CSS</title>
</head>
<body>
    <header>

    </header>

    <main class="conteudo">
        <section class="container">
            <div class="logo">
                <a href="index.html"><img src="assets/img/logo.jpg"></a>
            </div>

            <h1 class="titulo1">Sistema Acadêmico</h1>
            <h3 class="titulo2">Acesse o sistema</h3>
            
            <!-- Verificando  se a sessão existe com a função ISSET -->
            <?php
                if(isset($_SESSION['nao_autenticado'])):
            ?>

            <!--Menssagem de erro-->
            <div class="notification is-danger" align="center">
                <p style="color:red">Erro: Usuário ou senha inválidos.</p>
            </div>

            <?php
                endif; //Fechando o IF

                //Destruindo a sessão com a função UNSET
                unset($_SESSION['nao_autenticado']);
            ?>


            <!--Início do formulário-->
            <form action="scriptlogin.php" method="post" id="form_login">
                <div>
                    <label>Login <br></label>
                    <input type="email" name="email" placeholder="E-mail do usuário">
                </div>
                <div>
                    <label>Senha <br></label>
                    <input type="password" name="senha" placeholder="Senha">
                </div>
                <div class="botao">
                    <button type="submit">Entrar</button>
                </div>
            </form><!--Fím do formulário-->

            <div class="conta">
                <h4 style="text-align: center;">Ainda não tem conta? <a href="cadastro.html">Faça seu cadastro!</a></h4>
            </div>
            
        </section>

    </main>

    <footer class="footer-box">
        <h2>&copy; Senac Amazonas</h2>
        <p>Versão: 1.0.000 - AMBIENTE DE PRODUÇÃO: AM</p>
        <p>Todos os direitos reservados</p>
    </footer>
</body>
</html>