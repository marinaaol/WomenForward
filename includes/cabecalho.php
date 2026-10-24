<?php
require_once __DIR__ . '/inicio.php';

$msg          = ler_mensagem();
$autenticado  = esta_autenticado();
$nomeEntidade = entidade_nome();
?>
<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Women Forward — oportunidades em STEM para mulheres. Cursos, eventos, comunidades e estágios num só lugar.">
    <title><?= isset($titulo) ? htmlspecialchars($titulo) . ' · Women Forward' : 'Women Forward' ?></title>
    <link rel="stylesheet" href="assets/css/style.css?v=<?= filemtime(__DIR__ . '/../public/assets/css/style.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="assets/js/app.js?v=<?= filemtime(__DIR__ . '/../public/assets/js/app.js') ?>" defer></script>
</head>
<body>
<header class="topo">
    <a class="marca" href="index.php" aria-label="Women Forward — página inicial">
        <img src="assets/images/logo-women-forward.svg" alt="Women Forward">
    </a>

    <button
        class="menu-toggle"
        type="button"
        aria-label="Abrir menu"
        aria-expanded="false"
        aria-controls="menu-principal"
    >
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
    </button>

    <nav class="nav-principal" id="menu-principal" aria-label="Navegação principal">
        <a href="oportunidades.php">Pesquisar</a>
        <a href="stem.php">Mulheres na STEM</a>
        <a href="entidades.php">Para Entidades</a>

        <?php if ($autenticado): ?>
            <a class="nav-login" href="dashboard.php">Olá, <?= htmlspecialchars($nomeEntidade ?? '') ?></a>
            <a href="logout.php">Sair</a>
        <?php else: ?>
            <a class="nav-login" href="login.php">Login</a>
        <?php endif; ?>
    </nav>
</header>

<main>
<?php if ($msg): ?>
    <div class="msg <?= htmlspecialchars($msg['tipo']) ?>">
        <?= htmlspecialchars($msg['texto']) ?>
    </div>
<?php endif; ?>
