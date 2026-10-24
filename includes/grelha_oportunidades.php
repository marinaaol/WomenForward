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
            'origem'    => $origemCartoes,
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
        <article class="cartao cartao-oportunidade" tabindex="0">
            <div class="cartao-flip-inner">
                <div class="cartao-face cartao-frente" aria-hidden="false">
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
                </div>

                <div class="cartao-face cartao-verso" aria-hidden="true" inert>
                    <div class="cartao-titulos cartao-verso-titulo">
                        <h3><?= htmlspecialchars($tituloPrincipal, ENT_QUOTES, 'UTF-8') ?></h3>

                        <?php if ($subtitulo !== ''): ?>
                            <p class="subtitulo-oportunidade">
                                <?= htmlspecialchars($subtitulo, ENT_QUOTES, 'UTF-8') ?>
                            </p>
                        <?php endif; ?>
                    </div>
                    <div class="cartao-detalhes">
                        <div class="cartao-informacoes">
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
                        </div>
                        <div class="cartao-acoes">
                            <a class="botao-cartao botao-detalhes" href="oportunidade_ver.php?<?= htmlspecialchars(http_build_query($query)) ?>">Saiba Mais</a>
                            <a class="botao-cartao botao-fonte-oficial" href="<?= htmlspecialchars($op['url'], ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener noreferrer">
                                <span>Site</span>
                                <svg aria-hidden="true" viewBox="0 0 16 19" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7 18C7 18.5523 7.44772 19 8 19C8.55228 19 9 18.5523 9 18H7ZM8.70711 0.292893C8.31658 -0.0976311 7.68342 -0.0976311 7.29289 0.292893L0.928932 6.65685C0.538408 7.04738 0.538408 7.68054 0.928932 8.07107C1.31946 8.46159 1.95262 8.46159 2.34315 8.07107L8 2.41421L13.6569 8.07107C14.0474 8.46159 14.6805 8.46159 15.0711 8.07107C15.4616 7.68054 15.4616 7.04738 15.0711 6.65685L8.70711 0.292893ZM9 18L9 1H7L7 18H9Z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    <?php endforeach; ?>
</div>
