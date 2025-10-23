<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar senha</title>
    <link rel="shortcut icon" href="../imagens/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="cadastrostyle.css">
</head>
<body>

    <img src="../imagens/logo polofit.png" alt="" class="logo-titulo">

    <div class="container-cadastro">
        <div class="container-formulario">
            
            
            <form action="../phpbd/solicitar_reset.php" method="post" class="formulario-esqueci">
            <h1>Recuperar senha</h1>
            <p>Digite o email associado a conta para envio do link de redefinição.</p>
                <label for="email">E-mail</label>
                <div class="input-container">
                    <input type="email" name="email" placeholder="Informe seu e-mail" required>
                    
                </div>
                <button type="submit">Enviar</button>
                
                <a href="login.php">Voltar a página de login</a>
            </form>
            <br>
            
        </div>
    </div>
</body>
</html>