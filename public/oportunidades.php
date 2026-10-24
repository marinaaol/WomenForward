<?php
require dirname(__DIR__) . '/includes/inicio.php';

$filtros = [
    'q' => trim($_GET['q'] ?? ''),
    'categoria' => trim($_GET['categoria'] ?? ''),
    'tipo' => trim($_GET['tipo'] ?? ''),
    'pais' => trim($_GET['pais'] ?? ''),
    'cidade' => trim($_GET['cidade'] ?? ''),
    'formato' => trim($_GET['formato'] ?? ''),
];

$condicoes = ['o.ativo = TRUE'];
$parametros = [];

if ($filtros['q'] !== '') {
    $condicoes[] = '(o.titulo LIKE :titulo OR o.descricao LIKE :descricao)';
    $parametros['titulo'] = '%' . $filtros['q'] . '%';
    $parametros['descricao'] = '%' . $filtros['q'] . '%';
}
if ($filtros['categoria'] !== '') {
    $condicoes[] = 'c.nome = :categoria';
    $parametros['categoria'] = $filtros['categoria'];
}
if ($filtros['tipo'] !== '') {
    $condicoes[] = 'o.tipo = :tipo';
    $parametros['tipo'] = $filtros['tipo'];
}
if ($filtros['pais'] !== '') {
    $condicoes[] = 'o.pais = :pais';
    $parametros['pais'] = $filtros['pais'];
}
if ($filtros['cidade'] !== '') {
    $condicoes[] = 'o.cidade = :cidade';
    $parametros['cidade'] = $filtros['cidade'];
}
if ($filtros['formato'] !== '') {
    $condicoes[] = 'o.formato = :formato';
    $parametros['formato'] = $filtros['formato'];
}

$sql = 'SELECT o.id_oportunidade, o.titulo, o.descricao, o.url, o.tipo, o.pais,
               o.cidade, o.formato, o.data_inicio, e.nome AS entidade,
               c.nome AS categoria
        FROM oportunidades o
        JOIN entidades e ON e.id_entidade = o.id_entidade
        JOIN categorias c ON c.id_categoria = o.id_categoria
        WHERE ' . implode(' AND ', $condicoes) . '
        ORDER BY o.data_inicio IS NULL, o.data_inicio, o.titulo';
$consulta = $pdo->prepare($sql);
$consulta->execute($parametros);
$oportunidades = $consulta->fetchAll();
$categorias = $pdo->query('SELECT nome FROM categorias ORDER BY nome')->fetchAll(PDO::FETCH_COLUMN);

$titulo = 'Pesquisar oportunidades · Women Forward';
require dirname(__DIR__) . '/includes/cabecalho.php';
?>

<h1>Encontre Oportunidades Para o Seu Próximo Passo</h1>

<form method="get" action="oportunidades.php" class="formulario">
    <label for="q">O que procura?</label>
    <input id="q" name="q" type="search" value="<?= htmlspecialchars($filtros['q'], ENT_QUOTES, 'UTF-8') ?>">

    <label for="categoria">Categoria</label>
    <select id="categoria" name="categoria">
        <option value="">Todas as categorias</option>
        <?php foreach ($categorias as $categoria): ?>
            <option value="<?= htmlspecialchars($categoria, ENT_QUOTES, 'UTF-8') ?>" <?= $filtros['categoria'] === $categoria ? 'selected' : '' ?>>
                <?= htmlspecialchars($categoria, ENT_QUOTES, 'UTF-8') ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="tipo">Oportunidade</label>
    <select id="tipo" name="tipo">
        <option value="">Todos os tipos</option>
        <?php foreach (['curso' => 'Curso', 'evento' => 'Evento', 'comunidade' => 'Comunidade', 'estágio' => 'Estágio'] as $valor => $rotulo): ?>
            <option value="<?= $valor ?>" <?= $filtros['tipo'] === $valor ? 'selected' : '' ?>><?= $rotulo ?></option>
        <?php endforeach; ?>
    </select>

    <label for="pais">País</label>
    <select id="pais" name="pais">
        <option value="">Portugal, Brasil ou Global</option>
        <?php foreach (['PT' => 'Portugal', 'BR' => 'Brasil', 'GLOBAL' => 'Global'] as $valor => $rotulo): ?>
            <option value="<?= $valor ?>" <?= $filtros['pais'] === $valor ? 'selected' : '' ?>><?= $rotulo ?></option>
        <?php endforeach; ?>
    </select>

    <label for="cidade">Cidade</label>
    <select id="cidade" name="cidade">
        <option value="">Todas as cidades</option>
        <?php foreach (['Porto' => 'PT', 'Lisboa' => 'PT', 'São Paulo' => 'BR', 'Rio de Janeiro' => 'BR'] as $cidade => $paisCidade): ?>
            <option value="<?= htmlspecialchars($cidade, ENT_QUOTES, 'UTF-8') ?>" data-pais="<?= $paisCidade ?>" <?= $filtros['cidade'] === $cidade ? 'selected' : '' ?>>
                <?= htmlspecialchars($cidade, ENT_QUOTES, 'UTF-8') ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="formato">Formato</label>
    <select id="formato" name="formato">
        <option value="">Todos os formatos</option>
        <?php foreach (['presencial' => 'Presencial', 'online' => 'Online', 'híbrido' => 'Híbrido'] as $valor => $rotulo): ?>
            <option value="<?= $valor ?>" <?= $filtros['formato'] === $valor ? 'selected' : '' ?>><?= $rotulo ?></option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Mostrar Oportunidades</button>
    <a href="oportunidades.php">Limpar Pesquisa</a>
</form>

<section aria-live="polite" aria-labelledby="titulo-resultados" id="resultados">
    <h2 id="titulo-resultados">Oportunidades Encontradas (<?= count($oportunidades) ?>)</h2>
    <?php if (!$oportunidades): ?>
        <p class="vazio">Não encontrámos oportunidades com estes filtros. Experimente ajustar a pesquisa ou remover algum filtro.</p>
    <?php else: ?>
        <p>As oportunidades são divulgadas pelas entidades responsáveis. Antes de se inscrever, confirme datas, requisitos e disponibilidade na fonte oficial.</p>
        <?php $origemCartoes = 'oportunidades'; require dirname(__DIR__) . '/includes/grelha_oportunidades.php'; ?>
    <?php endif; ?>
</section>

<p>Combine os filtros para encontrar cursos, eventos, comunidades e estágios alinhados com os seus interesses, o momento da sua carreira e o formato que prefere.</p>

<?php require dirname(__DIR__) . '/includes/rodape.php'; ?>
