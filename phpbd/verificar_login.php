<?php

session_start();

require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = 'SELECT id, nome, senha_crip FROM alunos WHERE email=?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $aluno = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($aluno && password_verify($senha, $aluno['senha_crip'])) {

        $_SESSION['aluno_id'] = $aluno['id'];
        $_SESSION['aluno_nome'] = $aluno['nome'];

        header('Location: ../home/home.php');
        exit();

    } else {
        header('Location: ../login/login.php?erro=1');
        exit();
    }

} else {
    header('Location: ../login/login.php');
    exit();
}
?>