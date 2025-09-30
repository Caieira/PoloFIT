<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar senha</title>
    <link rel="shortcut icon" href="../imagens/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="loginstyle.css">
</head>

<body>
    <div class="dados">
        <h1>Recuperar senha</h1>
        <p>Digite o email associado a conta para envio do link de redefinição.</p>

        <form action="../phpbd/solicitar_reset.php" method="post">
            <label for="email">E-mail</label>

            <div class="input-esqueceu">
                <input type="email" name="email" placeholder="Informe seu e-mail" required>
                <button type="submit">Enviar</button>
            </div>
            <br>

        </form>
        <br>
        <a href="login.php">Voltar a página de login</a>

    </div>
</body>

</html>