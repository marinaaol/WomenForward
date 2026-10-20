<?php
require dirname(__DIR__) . '/app/includes/inicio.php';

if (!esta_autenticado()) {
    mensagem('erro', 'Inicie sessão para aceder à área da sua entidade.');
    header('Location: login.php');
    exit;
}

$id = entidade_id();

$stmt = $pdo->prepare(
    'SELECT o.id_oportunidade, o.titulo, o.tipo, o.pais, o.ativo, c.nome AS categoria
     FROM oportunidades o
     JOIN categorias c ON c.id_categoria = o.id_categoria
     WHERE o.id_entidade = ?
     ORDER BY o.criado_em DESC'
);
$stmt->execute([$id]);
$minhas = $stmt->fetchAll();

$titulo = 'Área da entidade · Women Forward';
require dirname(__DIR__) . '/app/includes/cabecalho.php';
?>

<h1>Olá, <?= htmlspecialchars(entidade_nome() ?? '') ?>!</h1>
<p><a href="logout.php">Terminar sessão</a></p>

<h2>Oportunidades da sua entidade</h2>

<?php if (!$minhas): ?>
    <p>Ainda não publicou oportunidades. Quando estiver disponível, poderá gerir aqui as iniciativas da sua entidade.</p>
<?php else: ?>
    <table>
        <thead>
            <tr><th>Título</th><th>Categoria</th><th>Tipo</th><th>País</th><th>Ativo</th></tr>
        </thead>
        <tbody>
            <?php foreach ($minhas as $op): ?>
                <tr>
                    <td><?= htmlspecialchars($op['titulo']) ?></td>
                    <td><?= htmlspecialchars($op['categoria']) ?></td>
                    <td><?= htmlspecialchars($op['tipo']) ?></td>
                    <td><?= htmlspecialchars($op['pais']) ?></td>
                    <td><?= $op['ativo'] ? 'Sim' : 'Não' ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<p><a href="index.php">Voltar à página inicial</a></p>

<?php require dirname(__DIR__) . '/app/includes/rodape.php'; ?>
