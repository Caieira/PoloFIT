<?php

session_start();

require 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT id, nome, senha_crip FROM alunos WHERE email = ? AND is_admin = 1";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin && password_verify($senha, $admin['senha_crip'])) {

        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_nome'] = $admin['nome'];

        header("Location: ../home/dashboard.php"); 
        exit();

    } else {
        header("Location: ../login/loginadm.php?erro=1");
        exit();
    }
} else {
    header("Location: ../login/loginadm.php");
    exit();
}


?>