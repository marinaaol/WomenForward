<?php
require_once __DIR__ . '/../includes/inicio.php';

$id     = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$origem = $_GET['origem'] ?? '';
$op     = null;

if ($id && $id > 0) {
    $consulta = $pdo->prepare(
        'SELECT o.id_oportunidade, o.titulo, o.descricao, o.tipo, o.pais,
                o.cidade, o.formato, o.data_inicio, o.url, o.criado_em, o.atualizado_em,
                e.nome AS entidade, e.email AS entidade_email,
                c.nome AS categoria
         FROM oportunidades o
         JOIN entidades  e ON e.id_entidade  = o.id_entidade
         JOIN categorias c ON c.id_categoria = o.id_categoria
         WHERE o.id_oportunidade = :id AND o.ativo = TRUE'
    );
    $consulta->execute(['id' => $id]);
    $op = $consulta->fetch();
}

// ------- Código HTTP correto -------
if (!$id || $id < 1) {
    http_response_code(400);   // pedido mal formado (sem id ou id inválido)
} elseif (!$op) {
    http_response_code(404);   // id válido mas não existe (ou está inativo)
}

// ------- Constrói o link de regresso com base na origem -------
$voltar_url   = 'oportunidades.php#resultados';
$voltar_label = 'Voltar aos resultados';

if ($origem === 'dashboard' && esta_autenticado()) {
    // Entidade logada, veio do painel
    $voltar_url   = 'dashboard.php#resultados';
    $voltar_label = 'Voltar ao meu painel';
} elseif (in_array($origem, ['pesquisar', 'oportunidades'], true)) {
    // Veio da pesquisa — repõe os filtros que vieram no URL
    $filtros = [
        'q'         => $_GET['q']         ?? '',
        'categoria' => $_GET['categoria'] ?? '',
        'tipo'      => $_GET['tipo']      ?? '',
        'pais'      => $_GET['pais']      ?? '',
        'cidade'    => $_GET['cidade']    ?? '',
        'formato'   => $_GET['formato']   ?? '',
    ];
    $filtros = array_filter($filtros, fn($v) => $v !== '');

    $voltar_url = $origem . '.php';
    if ($filtros) {
        $voltar_url .= '?' . http_build_query($filtros);
    }
    $voltar_url   .= '#resultados';
    $voltar_label  = 'Voltar aos resultados';
}

$titulo = $op ? $op['titulo'] : 'Oportunidade não encontrada';
require __DIR__ . '/../includes/cabecalho.php';
?>

<?php if (!$op): ?>
    <h1>Não encontrámos esta oportunidade</h1>
    <p>Pode ter sido removida ou já não estar disponível.</p>
    <a href="<?= htmlspecialchars($voltar_url) ?>"><?= htmlspecialchars($voltar_label) ?></a>
<?php else: ?>
    <article class="detalhe">
    <p><?= htmlspecialchars($op['categoria'], ENT_QUOTES, 'UTF-8') ?> · <?= htmlspecialchars(ucfirst($op['tipo']), ENT_QUOTES, 'UTF-8') ?></p>
    <?php
        $partesTitulo = preg_split('/\s+[—-]\s+/u', $op['titulo'], 2);
        $tituloPrincipal = trim($partesTitulo[0]);
        $subtitulo = isset($partesTitulo[1]) ? trim($partesTitulo[1]) : '';
    ?>

    <h1><?= htmlspecialchars($tituloPrincipal, ENT_QUOTES, 'UTF-8') ?></h1>

    <?php if ($subtitulo !== ''): ?>
        <h2 class="subtitulo-oportunidade">
            <?= htmlspecialchars($subtitulo, ENT_QUOTES, 'UTF-8') ?>
        </h2>
    <?php endif; ?>
    <p><?= nl2br(htmlspecialchars($op['descricao'], ENT_QUOTES, 'UTF-8')) ?></p>

    <dl>
        <dt>Entidade</dt>
        <dd><?= htmlspecialchars($op['entidade'], ENT_QUOTES, 'UTF-8') ?></dd>
        <dt>Local</dt>
        <dd><?= htmlspecialchars($op['pais'], ENT_QUOTES, 'UTF-8') ?><?= $op['cidade'] ? ' · ' . htmlspecialchars($op['cidade'], ENT_QUOTES, 'UTF-8') : '' ?></dd>
        <dt>Formato</dt>
        <dd><?= htmlspecialchars(ucfirst($op['formato']), ENT_QUOTES, 'UTF-8') ?></dd>
        <?php if ($op['data_inicio']): ?>
            <dt>Data de início</dt>
            <dd><?= htmlspecialchars($op['data_inicio'], ENT_QUOTES, 'UTF-8') ?></dd>
        <?php endif; ?>
        </dl>

        <p>
            <a class="botao-fonte-oficial" href="<?= htmlspecialchars($op['url'], ENT_QUOTES, 'UTF-8') ?>"
               target="_blank" rel="noopener noreferrer">Consultar oportunidade na fonte oficial</a>
        </p>

        <p><small>Esta informação foi fornecida pela entidade responsável. Confirme requisitos, datas e condições na fonte oficial antes de se inscrever ou participar.</small></p>

        <p><a href="<?= htmlspecialchars($voltar_url) ?>">← <?= htmlspecialchars($voltar_label) ?></a></p>
    </article>
<?php endif; ?>

<?php require __DIR__ . '/../includes/rodape.php'; ?>