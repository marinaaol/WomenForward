<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($titulo ?? 'Women Forward', ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="topo">
    <nav class="topo-menu topo-menu-esquerda" aria-label="Navegação principal — início e pesquisa">
        <a href="index.php">Início</a>
        <a href="pesquisar.html">Pesquisar</a>
    </nav>
    <a class="marca" href="index.php" aria-label="Women Forward — início">
        <img src="images/logo-women-forward.svg" alt="Women Forward">
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
    <?php unset($_SESSION['msg']); ?>
<?php endif; ?>
