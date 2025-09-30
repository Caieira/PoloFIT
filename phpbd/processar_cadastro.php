<?php

session_start();

require('conexao.php');

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$datanasc = $_POST['datanasc'];

$data_objeto = DateTime::createFromFormat('d/m/Y', $datanasc);

if ($data_objeto) {
    $datanasc = $data_objeto->format('Y-m-d');
} else {
    die("Formato de data inválido. Use DD/MM/AAAA.");
}

if (empty($nome) || empty($email) || empty($senha) || empty($_POST['datanasc'])) {
    die('Todos campos são obrigatórios.');
}

if (strlen($senha) < 4 || strlen($senha) > 16) {
    die("A senha deve ter entre 4 e 16 caracteres.");
}

$senha_crip = password_hash($senha, PASSWORD_DEFAULT);

$sql = 'INSERT INTO alunos (nome, datanasc, email, senha_crip) VALUES (?, ?, ?, ?)';

try {
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$nome, $datanasc, $email, $senha_crip])) {
        $novo_aluno_id = $pdo->lastInsertId();
        $_SESSION['aluno_id'] = $novo_aluno_id;
        $_SESSION['aluno_nome'] = $nome;

        header("Location:../home/home.php");
        exit();
    } else {
        die("Erro ao cadastrar, tente novamente.");
    }
} catch (PDOException $e) {
    if ($e->getCode() == "23000") {
        die("Erro: Email ja cadastrado, use outro.");
    } else {
        die("Erro ao conectar a base de dados: " . $e->getMessage());
    }

}

?>