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
            <h1>A entrada em tech não devia depender de sorte.</h1>
        </div>
        <img src="assets/images/women_hero.webp"
             alt="Grupo de mulheres em contexto de tecnologia"
             class="responsive">
        </div>     

        <p class="slogan">Learn. Build. Lead.</p>
    </div>


    <p>Encontre num só lugar conteúdos para conhecer áreas tech, fazer transição de carreira ou atualizar a sua stack. Explore cursos, eventos, comunidades e oportunidades de entidades que promovem diversidade e ampliam o acesso de mulheres à tecnologia.</p>
    <p>O Women Forward é um espaço acolhedor de troca e apoio, com conteúdo feito por quem também vive experiências parecidas. Descubra novos caminhos com informação clara, referências próximas e acesso direto à entidade responsável por cada oportunidade.</p>
    <p>Aproveite e já faça sua pesquisa! Nem precisa criar conta.</p>
    <a class="btn" href="pesquisar.php" id="btn-pesquisar">Pesquisar oportunidades</a>
    <a class="btn secundario" href="areas.php" id="btn-divulgar">Explorar áreas tech</a>
</section>

<section id="inicio" class="inicio">
    <h2>Um espaço para percursos diferentes</h2>
    <h3>Menos procura sem fim. Mais caminhos para explorar.</h3>
    <p>Cursos num site, eventos noutro, comunidades espalhadas pelas redes… Encontrar o que pode ajudar a avançar não devia parecer uma caça ao tesouro. O Women Forward aproxima informação, experiências e oportunidades para tornar a descoberta mais simples e dar clareza ao próximo passo.</p>
</section>

<section id="categorias" class="categorias">
    <h2>Explore áreas tech</h2>
    <article>
        <h3>Web</h3>
        <p>Crie para a internet: sites, aplicações e serviços que ligam pessoas e ideias.</p>
        <p><a class="btn secundario" href="pesquisar.php?categoria=Web">Pesquisar oportunidades</a></p>
    </article>
    <article>
        <h3>Dados &amp; IA</h3>
        <p>Descubra como os dados revelam padrões e como a inteligência artificial pode apoiar novas soluções.</p>
        <p><a class="btn secundario" href="pesquisar.php?categoria=Dados%20%26%20IA">Pesquisar oportunidades</a></p>
    </article>
    <article>
        <h3>Jogos</h3>
        <p>Junte programação, design, narrativa e som para dar vida a experiências interativas.</p>
        <p><a class="btn secundario" href="pesquisar.php?categoria=Jogos">Pesquisar oportunidades</a></p>
    </article>
    <article>
        <h3>Cibersegurança</h3>
        <p>Aprenda a proteger sistemas, redes e informação num mundo cada vez mais conectado.</p>
        <p><a class="btn secundario" href="pesquisar.php?categoria=Ciberseguran%C3%A7a">Pesquisar oportunidades</a></p>
    </article>
    <article>
        <h3>Carreira &amp; Liderança</h3>
        <p>Encontre oportunidades para crescer profissionalmente, partilhar experiências e liderar em tecnologia.</p>
        <p><a class="btn secundario" href="pesquisar.php?categoria=Carreira%20%26%20Lideran%C3%A7a">Pesquisar oportunidades</a></p>
    </article>
</section>

<section id="pesquisa">
    <h2>O que quer explorar?</h2>

    <form method="get" action="pesquisar.php#resultados" class="formulario">
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

        <button type="submit">Estou com sorte!</button>
    </form>
</section>

<section id="entidades" class="entidades">
    <h2>A sua entidade promove oportunidades em tecnologia?</h2>
    <p>Divulgue aqui cursos, eventos, comunidades e estágios para ampliar o acesso de mulheres e outros grupos sub-representados à tecnologia.</p>
    <p class="acoes">
        <a class="btn" href="registar.php">Criar conta de entidade</a>
        <a class="btn secundario" href="login.php">Iniciar sessão</a>
    </p>
</section>

<?php require __DIR__ . '/../includes/rodape.php'; ?>
