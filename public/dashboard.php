<?php
require_once __DIR__ . '/../includes/inicio.php';

exigir_login();

// Carrega apenas as oportunidades publicadas pela entidade da sessão atual.
$id = entidade_id();

$stmt = $pdo->prepare(
    'SELECT o.id_oportunidade, o.titulo, o.tipo, o.pais, o.ativo,
            o.criado_em, c.nome AS categoria
     FROM oportunidades o
     JOIN categorias c ON c.id_categoria = o.id_categoria
     WHERE o.id_entidade = ?
     ORDER BY o.criado_em DESC'
);
$stmt->execute([$id]);
$minhas = $stmt->fetchAll();

$titulo = 'Área da entidade';
require __DIR__ . '/../includes/cabecalho.php';
?>

<h1>Olá, <?= htmlspecialchars(entidade_nome() ?? '') ?>!</h1>

<p class="acoes">
    <a class="btn" href="oportunidade_form.php">+ Divulgar oportunidade</a>
    <a class="btn secundario" href="logout.php">Sair da conta</a>
    <a class="btn secundario perigo" href="entidade_apagar.php">Eliminar conta</a>
</p>

<h2 id="resultados">As oportunidades da sua entidade</h2>

<?php if (!$minhas): ?>
    <p>Ainda não publicou oportunidades. Partilhe a primeira para que mais pessoas a possam encontrar.</p>
<?php else: ?>
    <table class="tabela">
        <thead>
            <tr>
                <th>Título</th>
                <th>Categoria</th>
                <th>Tipo</th>
                <th>País</th>
                <th>Ativo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($minhas as $op): ?>
                <tr>
                    <td><?= htmlspecialchars($op['titulo']) ?></td>
                    <td><?= htmlspecialchars($op['categoria']) ?></td>
                    <td><?= htmlspecialchars($op['tipo']) ?></td>
                    <td><?= htmlspecialchars($op['pais']) ?></td>
                    <td><?= $op['ativo'] ? 'Sim' : 'Não' ?></td>
                    <td class="acoes-tabela">
                        <a href="oportunidade_ver.php?id=<?= (int) $op['id_oportunidade'] ?>&origem=dashboard">Ver</a>
                        <a href="oportunidade_form.php?id=<?= (int) $op['id_oportunidade'] ?>">Editar</a>
                        <a href="oportunidade_apagar.php?id=<?= (int) $op['id_oportunidade'] ?>" class="perigo">Remover</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<p><a href="index.php">← Voltar à página inicial</a></p>

<?php require __DIR__ . '/../includes/rodape.php'; ?>
