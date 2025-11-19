<?php
session_start();
require '../phpbd/conexao.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: loginadm.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $datanasc = $_POST['datanasc'];
    $plano_id = $_POST['plano_id'];


    if (empty($plano_id)) {
        $plano_id = NULL;
    }

    $sql = "UPDATE alunos SET nome = ?, email = ?, datanasc = ?, plano_id = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$nome, $email, $datanasc, $plano_id, $id])) {
        header("Location: ../home/dashboard.php?msg=atualizado");
    } else {
        header("Location: ../home/dashboard.php?erro=erro_ao_atualizar");
    }
}
?>