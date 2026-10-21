<?php
require_once __DIR__ . '/inicio.php';

$autenticado  = esta_autenticado();
$nomeEntidade = entidade_nome();
$msg          = ler_mensagem();
?>
<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Women Forward — oportunidades em STEM para mulheres. Cursos, eventos, comunidades e estágios num só lugar.">
    <title><?= isset($titulo) ? htmlspecialchars($titulo) . ' · Women Forward' : 'Women Forward' ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="assets/js/app.js" defer></script>
</head>
<body>
<header class="topo">
    <nav class="topo-menu topo-menu-esquerda" aria-label="Navegação — início e pesquisa">
        <a href="index.php">Início</a>
        <a href="pesquisar.php">Pesquisar</a>
    </nav>
    <a class="marca" href="index.php" aria-label="Women Forward — início">
        <img src="assets/images/logo-women-forward.svg" alt="Women Forward">
    </a>
    <nav class="topo-menu topo-menu-direita" aria-label="Navegação — áreas e entidades">
        <a href="areas.php">Áreas Tech</a>
        <a href="stem.php">Mulheres na STEM</a>
        <a href="entidades.php">Para Entidades</a>
    </nav>
</header>

<div class="barra-conta">
    <?php if ($autenticado): ?>
        <span>Olá, <?= htmlspecialchars($nomeEntidade ?? '') ?>!</span>
        <a href="dashboard.php">O meu painel</a>
        <a href="logout.php">Sair</a>
    <?php else: ?>
        <a href="registar.php">Criar conta</a>
        <a href="login.php">Iniciar sessão</a>
    <?php endif; ?>
</div>

<main>
<?php if ($msg): ?>
    <div class="msg <?= htmlspecialchars($msg['tipo']) ?>">
        <?= htmlspecialchars($msg['texto']) ?>
    </div>
<?php endif; ?>