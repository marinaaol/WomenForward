<?php
require_once __DIR__ . '/../includes/inicio.php';

$titulo = 'Início';
require __DIR__ . '/../includes/cabecalho.php';
?>

<section class="hero" aria-labelledby="titulo-hero">
    <h1 id="titulo-hero">A entrada em tech não devia depender de sorte.</h1>
    <p>Encontre num só lugar conteúdos para conhecer áreas tech, fazer transição de carreira ou atualizar a sua stack. Explore cursos, eventos, comunidades e oportunidades de entidades que promovem diversidade e ampliam o acesso de grupos sub-representados — incluindo mulheres — à tecnologia.</p>
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

<section id="problema">
    <h2>O cenário STEM</h2>
    <h3>Mais informação pode abrir novos caminhos.</h3>
    <p>A UNESCO indica que as mulheres representam 35% das pessoas graduadas em STEM no mundo — uma proporção que não se alterou em dez anos. Este é um dado global, não uma estatística específica de Portugal ou do Brasil. Ele ajuda a mostrar por que iniciativas que aproximam mulheres da informação, da aprendizagem e das oportunidades são importantes.</p>
    <p>A falta de representação não é falta de capacidade. O acesso a oportunidades, referências e informação clara também influencia quem consegue explorar e permanecer nestas áreas.</p>
</section>

<section id="solucao">
    <h2>A solução</h2>
    <h2>Informação, experiências e oportunidades num só lugar.</h2>
    <p>Explore conteúdos para conhecer áreas tech, fazer transição de carreira ou atualizar a sua stack. Compare cursos, eventos, comunidades e oportunidades divulgadas por entidades que promovem diversidade e ampliam o acesso de grupos sub-representados, incluindo mulheres, à tecnologia. Confirme os requisitos e as condições diretamente com a entidade responsável.</p>
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

    <form method="get" action="pesquisar.php" class="formulario">
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

        <button type="submit">Pesquisar</button>
    </form>
</section>

<section id="entidades" class="entidades">
    <h2>A sua entidade promove oportunidades em tecnologia?</h2>
    <p>Divulgue cursos, eventos, comunidades e estágios para ampliar o acesso de mulheres e outros grupos sub-representados à tecnologia.</p>
    <p class="acoes">
        <a class="btn" href="registar.php">Criar conta de entidade</a>
        <a class="btn secundario" href="login.php">Iniciar sessão</a>
    </p>
</section>

<section id="publicos">
    <h2>O seu próximo passo, no seu ritmo</h2>
    <h3>Jovens · 16 - 24 anos</h3>
    <a class="btn" href="pesquisar.php" id="btn-jovens">Explorar oportunidades para começar</a>
    <h3>A dar o próximo passo</h3>
    <a class="btn secundario" href="pesquisar.php" id="btn-mulheres">Pesquisar oportunidades</a>
</section>

<?php require __DIR__ . '/../includes/rodape.php'; ?>