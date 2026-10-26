<?php
require_once __DIR__ . '/../includes/inicio.php';
require_once __DIR__ . '/../includes/verificar_csrf.php';

exigir_login();

// Confirma que a oportunidade indicada pertence à entidade autenticada antes de a remover.
$id     = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$id_ent = entidade_id();

if (!$id || $id < 1) {
    mensagem('erro', 'Oportunidade inválida.');
    header('Location: dashboard.php');
    exit;
}

$stmt = $pdo->prepare(
    'SELECT id_oportunidade, titulo FROM oportunidades
     WHERE id_oportunidade = ? AND id_entidade = ?'
);
$stmt->execute([$id, $id_ent]);
$op = $stmt->fetch();

if (!$op) {
    mensagem('erro', 'Oportunidade não encontrada ou não pertence à sua entidade.');
    header('Location: dashboard.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare(
        'DELETE FROM oportunidades WHERE id_oportunidade = ? AND id_entidade = ?'
    );
    $stmt->execute([$id, $id_ent]);

    mensagem('sucesso', 'Oportunidade removida.');
    header('Location: dashboard.php');
    exit;
}

$titulo = 'Remover oportunidade';
require __DIR__ . '/../includes/cabecalho.php';
?>

<h1>Remover oportunidade</h1>
<p>Quer mesmo remover <strong><?= htmlspecialchars($op['titulo']) ?></strong>? Esta ação não pode ser desfeita.</p>

<form method="post" action="oportunidade_apagar.php?id=<?= (int) $id ?>" class="form-auth">
    <?php require __DIR__ . '/../includes/csrf.php'; ?>
    <button type="submit" class="btn perigo">Remover oportunidade</button>
    <a class="btn secundario" href="dashboard.php">Manter oportunidade</a>
</form>

<?php require __DIR__ . '/../includes/rodape.php'; ?>
