<?php
require dirname(__DIR__) . '/includes/inicio.php';

$autenticado  = esta_autenticado();
$nomeEntidade = entidade_nome();
?>
<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Women Forward</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/app.js" defer></script>
    <!-- O atributo defer na tag <script> indica ao navegador que o script externo deve ser descarregado em paralelo, mas executado apenas depois que a página HTML terminar de ser analisada -->
</head>
<body>
    <header class="topo">
    <nav class="topo-menu topo-menu-esquerda" aria-label="Navegação principal — início e pesquisa">
        <a href="index.php">Início</a>
        <a href="pesquisar.html">Pesquisar</a>
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
        <section class="hero" aria-labelledby="titulo-hero">
            <h1 id="titulo-hero">A entrada em tech não devia depender de sorte.</h1>
            <p>Encontre num só lugar conteúdos para conhecer áreas tech, fazer transição de carreira ou atualizar a sua stack. Explore cursos, eventos, comunidades e oportunidades de entidades que promovem diversidade e ampliam o acesso de grupos sub-representados — incluindo mulheres — à tecnologia.</p>
            <p>O Women Forward é um espaço acolhedor de troca e apoio, com conteúdo feito por quem também vive experiências parecidas. Descubra novos caminhos com informação clara, referências próximas e acesso direto à entidade responsável por cada oportunidade.</p>
            <p>Aproveite e já faça sua pesquisa! Nem precisa criar conta.</p>
            <a class="btn" href="oportunidades.php" id="btn-pesquisar">Pesquisar oportunidades</a>
            <a class="btn secundario" href="areas.html" id="btn-divulgar">Explorar áreas tech</a>

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
                <p><a class="btn secundario" href="oportunidades.php?categoria=Web">Pesquisar oportunidades</a></p>
            </article>
            <article>
                <h3>Dados & IA</h3>
                <p>Descubra como os dados revelam padrões e como a inteligência artificial pode apoiar novas soluções.</p>
                <p><a class="btn secundario" href="oportunidades.php?categoria=Dados%20%26%20IA">Pesquisar oportunidades</a></p>
            </article>
            <article>
                <h3>Jogos</h3>
                <p>Junte programação, design, narrativa e som para dar vida a experiências interativas.</p>
                <p><a class="btn secundario" href="oportunidades.php?categoria=Jogos">Pesquisar oportunidades</a></p>
            </article>
            <article>
                <h3>Cibersegurança</h3>
                <p>Aprenda a proteger sistemas, redes e informação num mundo cada vez mais conectado.</p>
                <p><a class="btn secundario" href="oportunidades.php?categoria=Ciberseguran%C3%A7a">Pesquisar oportunidades</a></p>
            </article>
            <article>
                <h3>Carreira &amp; Liderança</h3>
                <p>Encontre oportunidades para crescer profissionalmente, partilhar experiências e liderar em tecnologia.</p>
                <p><a class="btn secundario" href="oportunidades.php?categoria=Carreira%20%26%20Lideran%C3%A7a">Pesquisar oportunidades</a></p>
            </article>
        </section>

        <section id="pesquisa">
            <h2>O que quer explorar?</h2>

            <form method="get" action="oportunidades.php">
                <h4>Categoria</h4>
                <select name="categoria">
                    <option value="">Todas</option>
                    <option value="Web">Web</option>
                    <option value="Dados & IA">Dados & IA</option>
                    <option value="Jogos">Jogos</option>
                    <option value="Cibersegurança">Cibersegurança</option>
                    <option value="Carreira & Liderança">Carreira & Liderança</option>
                </select>

                <h4>Oportunidades</h4>
                <select name="tipo">
                    <option value="">Todas</option>
                    <option value="curso">Curso</option>
                    <option value="evento">Evento</option>
                    <option value="comunidade">Comunidade</option>
                    <option value="estágio">Estágio</option>
                </select>

                <h4>País</h4>
                <select name="pais">
                    <option value="">Todos</option>
                    <option value="PT">PT</option>
                    <option value="BR">BR</option>
                    <option value="GLOBAL">Global</option>
                </select>

                <h4>Formato</h4>
                <label><input type="radio" name="formato" value=""> Todos</label>
                <label><input type="radio" name="formato" value="presencial"> Presencial</label>
                <label><input type="radio" name="formato" value="online"> Online</label>
                <label><input type="radio" name="formato" value="híbrido"> Híbrido</label>

                <button type="submit">Pesquisar</button>
            </form>
        </section>

        <section id="entidades" class="entidades">
            <h2>A sua entidade promove oportunidades em tecnologia?</h2>
            <p>Divulgue cursos, eventos, comunidades e estágios para ampliar o acesso de mulheres e outros grupos sub-representados à tecnologia.</p>
            <p><a href="registar.php" class="botao">Criar conta de entidade</a></p>
            <p>Já tens conta? <a href="login.php">Iniciar sessão</a></p>
        </section>

        <section id="publicos">
            <h2>O seu próximo passo, no seu ritmo</h2>
            <h3>Jovens · 16 - 24 anos</h3>
            <a class="btn" href="oportunidades.php" id="btn-jovens">Explorar oportunidades para começar</a>
            <h3>A dar o próximo passo</h3>
            <a class="btn secundario" href="oportunidades.php" id="btn-mulheres">Pesquisar oportunidades</a>
        </section>
    <?php require_once dirname(__DIR__) . '/includes/rodape.php'; ?>
