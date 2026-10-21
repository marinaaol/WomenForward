<?php
require __DIR__ . '/inicio.php';

$autenticado  = esta_autenticado();
$nomeEntidade = entidade_nome();
$msg          = ler_mensagem();
?>
<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($titulo ?? 'Women Forward', ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header class="topo">
    <h1 class="logo">
        <a href="index.php" aria-label="Women Forward - Início">Women Forward</a>
    </h1>

    <nav aria-label="Navegação Principal">
        <ul class="nav-links">
            <li><a href="index.php">Início</a></li>
            <li><a href="pesquisar.php">Explorar Oportunidades</a></li>
            <li><a href="stem.php">Stem e Participação</a></li>
            <li><a href="index.php#entidades">Para Entidades</a></li>
        </ul>
    </nav>

    <a class="marca" href="index.php" aria-label="Women Forward — início">
        <img src="assets/images/logo-women-forward.svg" alt="Women Forward">
    </a>
    <nav class="topo-menu topo-menu-direita" aria-label="Navegação principal — áreas e entidades">
        <a href="areas.html">Áreas Tech</a>
        <a href="stem.html">Mulheres na STEM</a>
        <a href="entidades.html">Para Entidades</a>
    </nav>
</header>
<main>
<?php if (isset($_SESSION['msg'])): ?>
    <div class="msg <?= htmlspecialchars($_SESSION['msg']['tipo'], ENT_QUOTES, 'UTF-8') ?>">
        <?= htmlspecialchars($_SESSION['msg']['texto'], ENT_QUOTES, 'UTF-8') ?>

    </div>
<?php endif; ?>
