<?php
session_start();
require '../phpbd/conexao.php';


if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login/loginadm.php");
    exit();
}


if (!isset($_GET['id'])) {
    header("Location: ../home/dashboard.php");
    exit();
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM alunos WHERE id = ?");
$stmt->execute([$id]);
$aluno = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$aluno) {
    header("Location: ../home/dashboard.php?erro=aluno_nao_encontrado");
    exit();
}


$stmt_planos = $pdo->query("SELECT * FROM planos");
$planos = $stmt_planos->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Aluno - PoloFIT</title>
    <link rel="stylesheet" href="../login/cadastrostyle.css">
    <link rel="shortcut icon" href="../imagens/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
</head>
<body>
    <main class="container-login">
        <section class="container-formulario-login">
            <h2 style="color: #4682B4; font-family: 'LemonRegular'; margin-bottom: 20px;">EDITAR ALUNO</h2>

            <form action="atualizar_aluno.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $aluno['id']; ?>">

                <label for="nome">Nome completo:</label>
                <div class="input-container">
                    <input type="text" name="nome" value="<?php echo htmlspecialchars($aluno['nome']); ?>" required>
                    <i class="fa-solid fa-user"></i>
                </div>
                
                <label for="email">E-mail:</label>
                <div class="input-container">
                    <input type="email" name="email" value="<?php echo htmlspecialchars($aluno['email']); ?>" required>
                    <i class="fa-solid fa-envelope"></i>
                </div>

                <label for="datanasc">Data de Nascimento:</label>
                <div class="input-container">
                    <input type="date" name="datanasc" value="<?php echo $aluno['datanasc']; ?>" required>
                </div>

                <label for="plano">Plano:</label>
                <div class="input-container" style="height: auto;">
                    <select name="plano_id" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ccc;">
                        <option value="">Selecione um plano...</option>
                        <?php foreach ($planos as $plano): ?>
                            <option value="<?php echo $plano['id']; ?>" 
                                <?php echo ($aluno['plano_id'] == $plano['id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($plano['nome_plano']); ?> - R$ <?php echo $plano['preco']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="acoes-login">
                    <button type="submit" style="width: 100%;">Salvar Alterações</button>
                </div>
                
                <a href="../home/dashboard.php" style="margin-top: 15px; text-align: center; display: block;">Cancelar</a>

            </form>
        </section>
    </main>
</body>
</html>