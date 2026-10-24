<?php
require_once __DIR__ . '/../includes/inicio.php';

$titulo = 'Início';
require __DIR__ . '/../includes/cabecalho.php';
?>

<button onclick="topFunction()" id="myBtn" title="Voltar ao topo" aria-label="Voltar ao topo">
    <i class="fas fa-arrow-up" aria-hidden="true"></i>
</button>

<section class="hero" aria-labelledby="titulo-hero">
    <div class="container">
        <div class="hero-image">
        <div class="text-block">
            <h1>O seu caminho em tecnologia não tem de depender da sorte.</h1>
        </div>
        <img src="assets/images/women_hero.webp"
             alt="Grupo de mulheres em contexto de tecnologia"
             class="responsive">
        </div>     

        <p class="slogan">Learn. Build. Lead.</p>
    </div>
    <p>O Women Forward reúne cursos, eventos, comunidades e estágios em tecnologia num só lugar. Assim, pode encontrar oportunidades para aprender, começar, mudar de área ou avançar na carreira sem perder horas à procura.</p>
    <p>Acreditamos que, com mais informação, referências e apoio, cada mulher pode descobrir o caminho que faz sentido para si. Explore oportunidades e conheça comunidades que ajudam a abrir portas na tecnologia.</p>
    <p>Comece a pesquisar sem criar conta.</p>
    <a class="btn" href="oportunidades.php" id="btn-pesquisar">Encontrar oportunidades</a>
    <a class="btn secundario" href="stem.php#areas" id="btn-areas">Conhecer as áreas tech</a>
</section>

<section id="inicio" class="inicio">
    <h2>Menos procura. Mais apoio para avançar.</h2>
    <p>As oportunidades estão muitas vezes espalhadas por diferentes sites e redes. O Women Forward facilita a pesquisa e aproxima mulheres de cursos, eventos, comunidades e estágios — para que seja mais simples descobrir possibilidades e escolher o próximo passo.</p>
</section>

<section id="categorias" class="categorias">
    <h2>Explore áreas tech</h2>
    <article>
        <h3>Web</h3>
        <p>Crie para a internet: sites, aplicações e serviços que ligam pessoas e ideias.</p>
        <p><a class="btn secundario" href="oportunidades.php?categoria=Web">Ver oportunidades em Web</a></p>
    </article>
    <article>
        <h3>Dados &amp; IA</h3>
        <p>Descubra como os dados revelam padrões e como a inteligência artificial pode apoiar novas soluções.</p>
        <p><a class="btn secundario" href="oportunidades.php?categoria=Dados%20%26%20IA">Ver oportunidades em Dados &amp; IA</a></p>
    </article>
    <article>
        <h3>Jogos</h3>
        <p>Junte programação, design, narrativa e som para dar vida a experiências interativas.</p>
        <p><a class="btn secundario" href="oportunidades.php?categoria=Jogos">Ver oportunidades em Jogos</a></p>
    </article>
    <article>
        <h3>Cibersegurança</h3>
        <p>Aprenda a proteger sistemas, redes e informação num mundo cada vez mais conectado.</p>
        <p><a class="btn secundario" href="oportunidades.php?categoria=Ciberseguran%C3%A7a">Ver oportunidades em Cibersegurança</a></p>
    </article>
    <article>
        <h3>Carreira &amp; Liderança</h3>
        <p>Encontre oportunidades para crescer profissionalmente, partilhar experiências e liderar em tecnologia.</p>
        <p><a class="btn secundario" href="oportunidades.php?categoria=Carreira%20%26%20Lideran%C3%A7a">Ver oportunidades em Carreira &amp; Liderança</a></p>
    </article>
</section>

<section id="pesquisa">
    <h2>O que gostaria de explorar?</h2>

    <form method="get" action="oportunidades.php#resultados" class="formulario">
        <label for="categoria">Categoria</label>
        <select id="categoria" name="categoria">
            <option value="">Todas</option>
            <option value="Web">Web</option>
            <option value="Dados & IA">Dados & IA</option>
            <option value="Jogos">Jogos</option>
            <option value="Cibersegurança">Cibersegurança</option>
            <option value="Carreira & Liderança">Carreira & Liderança</option>
        </select>

        <label for="tipo">Oportunidade</label>
        <select id="tipo" name="tipo">
            <option value="">Todas</option>
            <option value="curso">Curso</option>
            <option value="evento">Evento</option>
            <option value="comunidade">Comunidade</option>
            <option value="estágio">Estágio</option>
        </select>

        <label for="pais">País</label>
        <select id="pais" name="pais">
            <option value="">Todos</option>
            <option value="PT">PT</option>
            <option value="BR">BR</option>
            <option value="GLOBAL">Global</option>
        </select>

        <label for="formato">Formato</label>
        <select id="formato" name="formato">
            <option value="">Todos</option>
            <option value="presencial">Presencial</option>
            <option value="online">Online</option>
            <option value="híbrido">Híbrido</option>
        </select>

        <button type="submit">Ver oportunidades</button>
    </form>
</section>

<section id="entidades" class="entidades">
    <h2>A sua entidade pode abrir novos caminhos.</h2>
    <p>Divulgue cursos, eventos, comunidades e estágios para que mais mulheres encontrem oportunidades para crescer em tecnologia.</p>

    <?php if (esta_autenticado()): ?>
        <p class="acoes">
            <a class="btn" href="oportunidade_form.php">Divulgar uma oportunidade</a>
            <a class="btn secundario" href="dashboard.php">Ir para o meu painel</a>
        </p>
    <?php else: ?>
        <p class="acoes">
            <a class="btn" href="registar.php">Divulgar uma oportunidade</a>
            <a class="btn secundario" href="login.php">Login</a>
        </p>
    <?php endif; ?>
</section>

<?php require __DIR__ . '/../includes/rodape.php'; ?>
