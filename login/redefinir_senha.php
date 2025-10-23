<?php
require '../phpbd/conexao.php';

$token_valido = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $nova_senha = $_POST['senha'];
    $senha_confirmacao = $_POST['senha_confirmacao'];
    
    if ($nova_senha !== $senha_confirmacao) {
        die("As senhas não coincidem.");
    }
    if (strlen($nova_senha) < 4 || strlen($nova_senha) > 16) {
        die("A nova senha deve ter entre 4 e 16 caracteres.");
    }

    $token_hash = hash("sha256", $token);
    
    $stmt = $pdo->prepare("SELECT id FROM alunos WHERE reset_token_hash = ? AND reset_token_expires_at > NOW()");
    $stmt->execute([$token_hash]);
    $user = $stmt->fetch();

    if ($user) {
        $nova_senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);
        
        $stmt = $pdo->prepare("UPDATE alunos SET senha_crip = ?, reset_token_hash = NULL, reset_token_expires_at = NULL WHERE id = ?");
        $stmt->execute([$nova_senha_hash, $user['id']]);

        header('Location: senha_redefinida.php');
        exit;
    } else {
        die("Token inválido ou expirado. Por favor, solicite um novo link.");
    }
}

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $token_hash = hash("sha256", $token);

    $stmt = $pdo->prepare("SELECT id FROM alunos WHERE reset_token_hash = ? AND reset_token_expires_at > NOW()");
    $stmt->execute([$token_hash]);
    $user = $stmt->fetch();
    
    if ($user) {
        $token_valido = true;
    }
}

if (!$token_valido) {
    die("<h1>Link Inválido ou Expirado</h1><p>O link de redefinição de senha é inválido ou já expirou. Por favor, <a href='esqueceu_senha.php'>solicite um novo</a>.</p>");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
    <link rel="stylesheet" href="cadastrostyle.css">
    <link rel="shortcut icon" href="../imagens/favicon.ico" type="image/x-icon">
</head>
<body>
    <div class="container-formulario">
        <img src="../imagens/LOGOPOLOFIT.png" alt="" class="logo-polo">
        <h1>Crie sua Nova Senha</h1>
        <form method="POST">
            <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
            
            <label for="senha">Nova Senha</label>

            <div class="input-container">
                <input type="password" name="senha" required></div>
            
            <label for="senha_confirmacao">Confirme a Nova Senha</label>
            <div class="input-container">
                <input type="password" name="senha_confirmacao" required>
            </div>
            
            <button type="submit">Redefinir Senha</button>
        </form>
    </div>
</body>
</html>