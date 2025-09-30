<!DOCTYPE html>
<html lang="pt=br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academia PoloFIT</title>
    <link rel="shortcut icon" href="../imagens/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="loginstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
</head>

<body>
    <?php

    if (isset($_GET['erro'])) {

        echo '<p style="color: red; text-align: center;">E-mail ou senha inválidos. Tente novamente.</p>';
    }
    ?>

    <div class="titulo">
        <label for=""><img src="../imagens/logo polofit.png" alt="Logo 2 da PoloFIT"></label>
    </div>


    <form action="../phpbd/verificar_login.php" method="post">


        <div class="dados">

            <div class="logologin">
                <img src="../imagens/LOGOPOLOFIT.png" alt="">
            </div>

            <div class="dadosdados">
                <label for="email">E-mail</label>
                <br>
                <div class="input-container">
                    <input type="email" name="email" id="" placeholder="Informe seu e-mail" required><i
                        class="fa-solid fa-envelope"></i>
                </div>
                <br>
                <label for="senha">Senha</label>
                <br>
                <div class="input-container">
                    <input type="password" name="senha" id="senha" placeholder="Digite sua senha" required
                        pattern=".{4,16}" title="Sua senha deve ter entre 4 e 16 caracteres."><i
                        class="fa-solid fa-key"></i>
                </div>
                <br>
                <button type="submit">Logar</button>
                <a href="esqueceu_senha.php">Esqueceu sua senha?</a>
            </div>

        </div>

    </form>

</body>

</html>