<?php
session_start();
require 'conexao.php';


if (!isset($_SESSION['aluno_id'])) {

    header("Location: ../login/login.php");
    exit();
}

if (isset($_GET['plano'])) {
    $plano_id = (int)$_GET['plano'];
    $aluno_id = $_SESSION['aluno_id'];

    $sql = "UPDATE alunos SET plano_id = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$plano_id, $aluno_id])) {

        header("Location: ../home/home.php?msg=plano_atualizado");
    } else {
        header("Location: ../home/home.php?erro=falha");
    }
} else {
    header("Location: ../home/home.php");
}
exit();
?>