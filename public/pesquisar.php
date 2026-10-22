<?php
require_once __DIR__ . '/../includes/inicio.php';

$filtros = [
    'q'         => trim($_GET['q'] ?? ''),
    'categoria' => trim($_GET['categoria'] ?? ''),
    'tipo'      => trim($_GET['tipo'] ?? ''),
    'pais'      => trim($_GET['pais'] ?? ''),
    'cidade'    => trim($_GET['cidade'] ?? ''),
    'formato'   => trim($_GET['formato'] ?? ''),
];

$condicoes  = ['o.ativo = TRUE'];
$parametros = [];

if ($filtros['q'] !== '') {
    $condicoes[] = '(o.titulo LIKE :q OR o.descricao LIKE :q)';
    $parametros['q'] = '%' . $filtros['q'] . '%';
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

$sql = 'SELECT o.id_oportunidade, o.titulo, o.descricao, o.tipo, o.pais, o.cidade, o.formato,
               o.url, o.data_inicio, e.nome AS entidade, c.nome AS categoria
        FROM oportunidades o
        JOIN entidades  e ON e.id_entidade  = o.id_entidade
        JOIN categorias c ON c.id_categoria = o.id_categoria
        WHERE ' . implode(' AND ', $condicoes) . '
        ORDER BY o.data_inicio IS NULL, o.data_inicio, o.titulo';
$consulta = $pdo->prepare($sql);
$consulta->execute($parametros);
$oportunidades = $consulta->fetchAll();

$categorias = $pdo->query('SELECT nome FROM categorias ORDER BY nome')->fetchAll(PDO::FETCH_COLUMN);

$titulo = 'Pesquisar oportunidades';
require __DIR__ . '/../includes/cabecalho.php';
?>

<h1>Encontre oportunidades que abrem caminhos.</h1>
<p>Pesquise cursos, eventos, comunidades e estágios em Portugal e no Brasil. Combine os filtros para descobrir opções que façam sentido para os seus interesses, o momento da sua carreira e o formato que prefere.</p>

<section aria-labelledby="como-funciona">
    <h2 id="como-funciona">Como funciona</h2>
    <ol>
        <li>Escolha o que quer explorar e aplique os filtros.</li>
        <li>Compare as oportunidades que correspondem à sua pesquisa.</li>
        <li>Leia os detalhes e confirme requisitos, datas e condições com a entidade responsável.</li>
        <li>Consulte a fonte oficial para saber como participar.</li>
    </ol>
</section>

<form method="get" action="pesquisar.php#resultados" class="formulario">
    <label for="q">O que procura? (opcional)</label>
    <input id="q" name="q" type="search" placeholder="Ex.: programação, transição de carreira, dados"
           value="<?= htmlspecialchars($filtros['q'], ENT_QUOTES, 'UTF-8') ?>">

    <label for="categoria">Área tech</label>
    <select id="categoria" name="categoria">
        <option value="">Todas as categorias</option>
        <?php foreach ($categorias as $cat): ?>
            <option value="<?= htmlspecialchars($cat, ENT_QUOTES, 'UTF-8') ?>"
                <?= $filtros['categoria'] === $cat ? 'selected' : '' ?>>
                <?= htmlspecialchars($cat, ENT_QUOTES, 'UTF-8') ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="tipo">Tipo de oportunidade</label>
    <select id="tipo" name="tipo">
        <option value="">Todos os tipos</option>
        <?php foreach (['curso' => 'Curso', 'evento' => 'Evento', 'comunidade' => 'Comunidade', 'estágio' => 'Estágio'] as $v => $r): ?>
            <option value="<?= $v ?>" <?= $filtros['tipo'] === $v ? 'selected' : '' ?>><?= $r ?></option>
        <?php endforeach; ?>
    </select>

    <label for="pais">País</label>
    <select id="pais" name="pais">
        <option value="">Todos</option>
        <?php foreach (['PT' => 'Portugal', 'BR' => 'Brasil', 'GLOBAL' => 'Global'] as $v => $r): ?>
            <option value="<?= $v ?>" <?= $filtros['pais'] === $v ? 'selected' : '' ?>><?= $r ?></option>
        <?php endforeach; ?>
    </select>

    <label for="cidade">Cidade</label>
    <select id="cidade" name="cidade">
        <option value="">Todas as cidades</option>
        <?php foreach (['Porto' => 'PT', 'Lisboa' => 'PT', 'São Paulo' => 'BR', 'Rio de Janeiro' => 'BR'] as $c => $p): ?>
            <option value="<?= htmlspecialchars($c, ENT_QUOTES, 'UTF-8') ?>"
                    data-pais="<?= $p ?>"
                <?= $filtros['cidade'] === $c ? 'selected' : '' ?>>
                <?= htmlspecialchars($c, ENT_QUOTES, 'UTF-8') ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="formato">Formato</label>
    <select id="formato" name="formato">
        <option value="">Todos os formatos</option>
        <?php foreach (['presencial' => 'Presencial', 'online' => 'Online', 'híbrido' => 'Híbrido'] as $v => $r): ?>
            <option value="<?= $v ?>" <?= $filtros['formato'] === $v ? 'selected' : '' ?>><?= $r ?></option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Encontrar oportunidades</button>
    <a href="pesquisar.php">Limpar filtros</a>
</form>

<section aria-live="polite" aria-labelledby="titulo-resultados" id="resultados">
    <h2 id="titulo-resultados">Resultados (<?= count($oportunidades) ?>)</h2>

    <?php if (!$oportunidades): ?>
        <p class="vazio">Ainda não encontrámos oportunidades com estes filtros. Experimente retirar um filtro ou procurar noutra cidade.</p>
    <?php else: ?>
        <p>As oportunidades são divulgadas pelas entidades responsáveis. Confirme datas, requisitos e disponibilidade através do respetivo link oficial.</p>
        <?php
        $logosOportunidades = [
            '42 São Paulo' => '42-sao-paulo.png',
            '42 Porto' => '42-porto.png',
            'Claude Academy' => 'claude-academy.png',
            'CodeWomen' => 'codewomen.png',
            'Game Strategies' => 'game-strategies.png',
            'Harvard Online' => 'harvard-university.png',
            'Hire Tech Ladies' => 'tech-ladies.png',
            'Portuguese Women in Tech' => 'portuguese-women-in-tech.png',
            'PrograMaria' => 'programaria.png',
            'SheCodes' => 'shecodes.png',
            'Tech Girls' => 'tech-girls.png',
            'Unity Learn' => 'unity.png',
            'WomenTech Global Conference' => 'womentech-global-conference.png',
            'MIT OpenCourseWare' => 'mit-opencourseware.svg',
            'London Business School' => 'london-business-school.svg',
            '.NET' => 'net-conf.png',
            'Cisco Live' => 'cisco-live.png',
            'Cisco Networking Academy' => 'cisco-networking-academy.png',
            'CodeCombat' => 'codecombat.png',
            'Descodifica-te' => 'descodifica-te.png',
            'TryHackMe' => 'tryhackme.png',
            'Global Women Tech Leaders' => 'global-women-tech-leaders.png',
            'Ladies Who Tech' => 'ladies-who-tech.png',
            'Ladies in Tech' => 'ladies-in-tech.png',
            'Raparigas do Código' => 'raparigas-do-codigo.png',
            'Roblox Creator Hub' => 'roblox-creator-hub.png',
            'Technovation Portugal' => 'technovation-girls-portugal.png',
            'WoMakersCode' => 'womakers-code.png',
            'Women in Tech Portugal' => 'women-in-tech-portugal.png',
        ];
        $logosComBranco = [
            'game-strategies.png', 'tech-ladies.png', 'tryhackme.png',
            'ladies-in-tech.png', 'roblox-creator-hub.png', 'global-women-tech-leaders.png',
            'women-in-tech-portugal.png',
        ];
        $logosComFundoBranco = ['net-conf.png', 'descodifica-te.png', 'harvard-university.png', 'raparigas-do-codigo.png', 'claude-academy.png'];
        ?>
        <div class="grelha-oportunidades">
            <?php foreach ($oportunidades as $op): ?>
                <?php
                // Constrói o link para o detalhe, preservando os filtros atuais + origem
                $query = array_filter([
                    'id'        => $op['id_oportunidade'],
                    'origem'    => 'pesquisar',
                    'q'         => $filtros['q'],
                    'categoria' => $filtros['categoria'],
                    'tipo'      => $filtros['tipo'],
                    'pais'      => $filtros['pais'],
                    'cidade'    => $filtros['cidade'],
                    'formato'   => $filtros['formato'],
                ], fn($v) => $v !== '');
                ?>
                <?php
                $partesTitulo = preg_split('/\s+[—-]\s+/u', $op['titulo'], 2);
                $tituloPrincipal = trim($partesTitulo[0]);
                $subtitulo = isset($partesTitulo[1]) ? trim($partesTitulo[1]) : '';
                $arquivoLogo = $logosOportunidades[$tituloPrincipal] ?? null;
                $classesLogo = [];
                if (in_array($arquivoLogo, ['42-porto.png', ...$logosComFundoBranco], true)) {
                    $classesLogo[] = 'cartao-logo-sem-fundo';
                }
                if (in_array($arquivoLogo, $logosComBranco, true)) {
                    $classesLogo[] = 'cartao-logo-cor-escura';
                }
                if ($arquivoLogo === 'raparigas-do-codigo.png') {
                    $classesLogo[] = 'cartao-logo-simbolo';
                }
                ?>
                <article class="cartao cartao-oportunidade">
                    <div class="cartao-cabecalho">
                        <?php if ($arquivoLogo): ?>
                            <img class="cartao-logo<?= $classesLogo ? ' ' . implode(' ', $classesLogo) : '' ?>"
                                 src="assets/images/oportunidades/<?= htmlspecialchars($arquivoLogo, ENT_QUOTES, 'UTF-8') ?>"
                                 alt="" loading="lazy">
                        <?php endif; ?>

                        <div class="cartao-titulos">
                            <h3><?= htmlspecialchars($tituloPrincipal, ENT_QUOTES, 'UTF-8') ?></h3>

                            <?php if ($subtitulo !== ''): ?>
                                <p class="subtitulo-oportunidade">
                                    <?= htmlspecialchars($subtitulo, ENT_QUOTES, 'UTF-8') ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="cartao-detalhes">
                        <p class="cartao-resumo"><?= htmlspecialchars($op['descricao'], ENT_QUOTES, 'UTF-8') ?></p>
                        <p><?= htmlspecialchars($op['categoria'], ENT_QUOTES, 'UTF-8') ?> · <?= htmlspecialchars(ucfirst($op['tipo']), ENT_QUOTES, 'UTF-8') ?></p>
                        <p>
                            <?= htmlspecialchars($op['entidade'], ENT_QUOTES, 'UTF-8') ?>
                            · <?= htmlspecialchars($op['pais'], ENT_QUOTES, 'UTF-8') ?>
                            <?= $op['cidade'] ? ' · ' . htmlspecialchars($op['cidade'], ENT_QUOTES, 'UTF-8') : '' ?>
                            · <?= htmlspecialchars(ucfirst($op['formato']), ENT_QUOTES, 'UTF-8') ?>
                        </p>
                        <?php if ($op['data_inicio']): ?>
                            <p>Início: <?= htmlspecialchars(date('d/m/Y', strtotime($op['data_inicio'])), ENT_QUOTES, 'UTF-8') ?></p>
                        <?php endif; ?>
                        <div class="cartao-acoes">
                            <a class="botao-cartao botao-detalhes" href="oportunidade_ver.php?<?= htmlspecialchars(http_build_query($query)) ?>">Ver detalhes</a>
                            <a class="botao-cartao botao-fonte-oficial" href="<?= htmlspecialchars($op['url'], ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener noreferrer">
                                <span>Fonte oficial</span>
                                <svg aria-hidden="true" viewBox="0 0 16 19" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7 18C7 18.5523 7.44772 19 8 19C8.55228 19 9 18.5523 9 18H7ZM8.70711 0.292893C8.31658 -0.0976311 7.68342 -0.0976311 7.29289 0.292893L0.928932 6.65685C0.538408 7.04738 0.538408 7.68054 0.928932 8.07107C1.31946 8.46159 1.95262 8.46159 2.34315 8.07107L8 2.41421L13.6569 8.07107C14.0474 8.46159 14.6805 8.46159 15.0711 8.07107C15.4616 7.68054 15.4616 7.04738 15.0711 6.65685L8.70711 0.292893ZM9 18L9 1H7L7 18H9Z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<?php require __DIR__ . '/../includes/rodape.php'; ?>
