<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | PoloFIT</title>
    <link rel="stylesheet" href="cadastrostyle.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="shortcut icon" href="../imagens/favicon.ico" type="image/x-icon">
</head>
<body>

    <img src="../imagens/logo polofit.png" alt="" class="logo-titulo">

    <main class="container-login">

        <section class="container-formulario-login">
            <img src="../imagens/LOGOPOLOFIT.png" alt="" class="logo-polo">
            
            <?php
            
            if (isset($_GET['erro'])) {
                echo '<p class="mensagem-erro">E-mail ou senha inválidos.</p>';
            }
            ?>

            <form action="../phpbd/verificar_login.php" method="POST">
                
                <label for="email">E-mail:</label>
                <div class="input-container">
                    <input type="email" id="email" name="email" placeholder="Informe seu e-mail" required>
                    <i class="fa-solid fa-envelope"></i>
                </div>
                
                <label for="senha">Senha:</label>
                <div class="input-container">
                    <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
                    <i class="fa-solid fa-key"></i>
                </div>

                <a href="esqueceu_senha.php">Esqueceu sua senha?</a>
                <a href="cadastrar.html">Não é nosso aluno? Cadastre-se!</a>

                <button type="submit">Logar</button>
            </form>
            

                
        </section>

    </main>
</body>
</html>