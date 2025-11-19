<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login/loginadm.php");
    exit();
}

require '../phpbd/conexao.php';

$sql = "SELECT
              a.id,
              a.nome,
              a.email,
              p.nome_plano
            from alunos a
            LEFT JOIN planos p ON a.plano_id = p.id
            WHERE a.is_admin = 0
            ORDER BY a.nome ASC";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$alunos = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>




<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashboardstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="shortcut icon" href="../imagens/favicon.ico" type="image/x-icon">
    <title>Adm | Polofit</title>
</head>
<body>
    <div class="container-admin">
        <header class="admin-header">
            <div class="user-area">
                <img src="../imagens/LOGOPOLOFIT.PNG" alt="Logo PoloFIT">
        
        
                <h2>Painel Administrativo</h2>
        
                Olá, <?php echo htmlspecialchars($_SESSION['admin_nome']); ?></span>
                <a href="../phpbd/logout.php" class="btn-sair">Sair <i class="fa-solid fa-right-from-bracket"></i></a>
            </div>
        </header>
        
        <main class="card-tabela">
            <div class="topo-tabela">
                <h3>Gerenciar Alunos</h3>
            </div>
            <div class="tabela">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NOME</th>
                            <th>E-mail</th>
                            <th>PLANO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($alunos) > 0): ?>
                                <?php foreach ($alunos as $aluno): ?>
                                    <tr>
                                        <td>#<?php echo $aluno['id']; ?></td>
                                        <td>
                                            <div class="info-nome">
                                                <strong><?php echo htmlspecialchars($aluno['nome']); ?></strong>
                                            </div>
                                        </td>
                                        <td><?php echo htmlspecialchars($aluno['email']); ?></td>
                                        <td>
                                            <?php if ($aluno['nome_plano']): ?>
                                                <span class="badge-plano <?php echo strtolower($aluno['nome_plano']); ?>">
                                                    <?php echo htmlspecialchars($aluno['nome_plano']); ?>
                                                </span>
                                            <?php else: ?>
                                                <span class="badge-plano sem-plano">Sem Plano</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="acoes-btn">
                                                <a href="../admin/editar_aluno.php?id=<?php echo $aluno['id']; ?>" class="btn-editar" title="Editar"><i class="fa-solid fa-pen"></i></a>
                                                <a href="../admin/excluir_aluno.php?id=<?php echo $aluno['id']; ?>" class="btn-excluir" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir este aluno?');"><i class="fa-solid fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" style="text-align: center; padding: 20px;">Nenhum aluno encontrado.</td>
                                </tr>
                            <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

                    

</body>
<?php if (isset($_GET['msg']) && $_GET['msg'] == 'excluido_com_sucesso'): ?>
            <div class="msg-excluiiodo">✅ Aluno excluído com sucesso!</div>
        </div>
    <?php endif; ?>
    
    



<?php if (isset($_GET['msg']) && $_GET['msg'] == 'atualizado'): ?>
    <div style="background-color: #cce5ff; color: #004085; padding: 15px; margin: 20px auto; max-width: 1200px; border-radius: 8px; text-align: center; border: 1px solid #b8daff;">
        ✏️ Aluno atualizado com sucesso!
    </div>
<?php endif; ?>


</html>
