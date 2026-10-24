<?php
require_once __DIR__ . '/../includes/inicio.php';

$titulo = 'Para entidades';
require __DIR__ . '/../includes/cabecalho.php';
?>

<h1>A Sua Entidade Pode Abrir Novos Caminhos Na Tecnologia</h1>
<p>Partilhe cursos, eventos, comunidades e estágios com pessoas que procuram aprender, crescer ou iniciar um percurso em tecnologia. Mantenha as informações atualizadas para que cada oportunidade continue útil.</p>

<h2>Informação Clara, Confiança Partilhada</h2>
<p>A entidade que publica é responsável pela exatidão das informações, pelos requisitos de participação e pela sua atualização. O Women Forward reúne as oportunidades; antes de participar, confirme sempre os detalhes na fonte oficial.</p>

<h2>Publique e Acompanhe As Suas Oportunidades</h2>

<?php if (esta_autenticado()): ?>
    <p>Está autenticada como <strong><?= htmlspecialchars(entidade_nome() ?? '') ?></strong>. Pode divulgar novas oportunidades ou gerir as que já publicou.</p>
    <p class="acoes">
        <a class="btn" href="oportunidade_form.php">Divulgar uma oportunidade</a>
        <a class="btn secundario" href="dashboard.php">Ir para o meu painel</a>
    </p>
<?php else: ?>
    <p>Crie uma conta para publicar oportunidades e gerir os anúncios da sua entidade no seu próprio painel.</p>
    <p class="acoes">
        <a class="btn" href="registar.php">Criar conta e divulgar oportunidades</a>
        <a class="btn secundario" href="login.php">Já tem conta? Entrar</a>
    </p>
<?php endif; ?>

<?php require __DIR__ . '/../includes/rodape.php'; ?>