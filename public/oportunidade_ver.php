<?php
require dirname(__DIR__) . '/app/includes/inicio.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id || $id < 1) {
    http_response_code(400);
    $oportunidade = null;
} else {
    $consulta = $pdo->prepare(
        'SELECT o.id_oportunidade, o.titulo, o.descricao, o.tipo, o.pais,
                o.cidade, o.formato, o.data_inicio, o.url, e.nome AS entidade,
                c.nome AS categoria
         FROM oportunidades o
         JOIN entidades e ON e.id_entidade = o.id_entidade
         JOIN categorias c ON c.id_categoria = o.id_categoria
         WHERE o.id_oportunidade = :id AND o.ativo = TRUE'
    );
    $consulta->execute(['id' => $id]);
    $oportunidade = $consulta->fetch();

    if (!$oportunidade) {
        http_response_code(404);
    }
}

$titulo = $oportunidade
    ? $oportunidade['titulo'] . ' · Women Forward'
    : 'Oportunidade não encontrada · Women Forward';
require dirname(__DIR__) . '/app/includes/cabecalho.php';
?>

<?php if (!$oportunidade): ?>
    <h1>Oportunidade não encontrada</h1>
    <p>Não foi possível encontrar esta oportunidade. Pode ter sido removida ou já não estar disponível.</p>
    <a href="pesquisar.html">Voltar à pesquisa</a>
<?php else: ?>
    <article class="detalhe">
        <p><?= htmlspecialchars($oportunidade['categoria'], ENT_QUOTES, 'UTF-8') ?> · <?= htmlspecialchars(ucfirst($oportunidade['tipo']), ENT_QUOTES, 'UTF-8') ?></p>
        <h1><?= htmlspecialchars($oportunidade['titulo'], ENT_QUOTES, 'UTF-8') ?></h1>
        <p><?= nl2br(htmlspecialchars($oportunidade['descricao'], ENT_QUOTES, 'UTF-8')) ?></p>

        <dl>
            <dt>Entidade</dt>
            <dd><?= htmlspecialchars($oportunidade['entidade'], ENT_QUOTES, 'UTF-8') ?></dd>
            <dt>Local</dt>
            <dd><?= htmlspecialchars($oportunidade['pais'], ENT_QUOTES, 'UTF-8') ?><?= $oportunidade['cidade'] ? ' · ' . htmlspecialchars($oportunidade['cidade'], ENT_QUOTES, 'UTF-8') : '' ?></dd>
            <dt>Formato</dt>
            <dd><?= htmlspecialchars(ucfirst($oportunidade['formato']), ENT_QUOTES, 'UTF-8') ?></dd>
            <?php if ($oportunidade['data_inicio']): ?>
                <dt>Data de início</dt>
                <dd><?= htmlspecialchars($oportunidade['data_inicio'], ENT_QUOTES, 'UTF-8') ?></dd>
            <?php endif; ?>
        </dl>

        <p><a class="btn" href="<?= htmlspecialchars($oportunidade['url'], ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener noreferrer">Consultar a fonte oficial</a></p>
        <p><small>Esta informação foi fornecida pela entidade responsável. Antes de se inscrever ou participar, confirme requisitos, datas e condições na fonte oficial.</small></p>
    </article>
<?php endif; ?>

<?php require dirname(__DIR__) . '/app/includes/rodape.php'; ?>
