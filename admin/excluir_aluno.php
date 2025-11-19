<?php
session_start();
require '../phpbd/conexao.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login/loginadm.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    if ($id == $_SESSION['admin_id']) {
        header("Location: ../home/dashboard.php?erro=voce_nao_pode_se_excluir");
        exit();
    }

    $sql = "DELETE FROM alunos WHERE id = ?";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$id])) {
        header("Location: ../home/dashboard.php?msg=excluido_com_sucesso");
    } else {
        header("Location: ../home/dashboard.php?erro=erro_ao_excluir");
    }
} else {
    header("Location: ../home/dashboard.php");
}

exit();
?>