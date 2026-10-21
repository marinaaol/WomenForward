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
    <meta name="description" content="Women Forward — oportunidades em STEM para mulheres. Cursos, eventos, comunidades e estágios num só lugar.">
    <title><?= isset($titulo) ? htmlspecialchars($titulo) . ' · Women Forward' : 'Women Forward' ?></title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/app.js" defer></script>
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

    <div class="conta">
        <?php if ($autenticado): ?>
            <span>Olá, <?= htmlspecialchars($nomeEntidade ?? '') ?>!</span>
            <a href="dashboard.php">O meu painel</a>
            <a href="logout.php">Sair</a>
        <?php else: ?>
            <a href="registar.php">Criar conta</a>
            <a href="login.php">Iniciar sessão</a>
        <?php endif; ?>
    </div>
</header>

<main>
<?php if ($msg): ?>
    <div class="mensagem mensagem-<?= htmlspecialchars($msg['tipo']) ?>">
        <?= htmlspecialchars($msg['texto']) ?>
    </div>
<?php endif; ?>
