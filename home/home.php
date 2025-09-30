<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
    <link rel="shortcut icon" href="../imagens/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="homestyle.css">
</head>
<body>
    <?php
    session_start();

    if (!isset($_SESSION["aluno_id"])) {
        header("../login/login.php");
    }

    ?>
    <div class="navbar-container">
        <div class="navbar-esquerda">
            <img src="../imagens/LOGOPOLOFIT.png" alt="" class="logo">
            <div class="opcoes">
                <a href="#">PLANOS</a>
                <a href="#">MODALIDADES</a>
                <a href="#">LOCALIDADES</a>
                <a href="../phpbd/logout.php">SAIR</a>
            </div>
        </div>
        
    </div>
</body>
</html>