<?php
require_once __DIR__ . '/../includes/inicio.php';

$titulo = 'Início';
require __DIR__ . '/../includes/cabecalho.php';
?>

<section class="hero" aria-labelledby="titulo-hero">
    <div class="container">
        <div class="hero-image">
            <div class="text-block">
                <h1>O seu caminho em tecnologia não tem de depender da sorte.</h1>
                <a class="btn hero-cta" href="#pesquisa">Ver Oportunidades</a>
            </div>
            <div class="hero-photo">
                <img src="assets/images/women_hero.webp"
                     alt="Grupo de mulheres em contexto de tecnologia"
                     class="responsive">
            </div>
        </div>     

        <p class="slogan">Learn. Build. Lead.</p>
    </div>
    <p>O Women Forward reúne cursos, eventos, comunidades e estágios em tecnologia num só lugar. Assim, pode encontrar oportunidades para aprender, começar, mudar de área ou avançar na carreira sem perder horas à procura.</p>
    <p>Acreditamos que, com mais informação, referências e apoio, cada mulher pode descobrir o caminho que faz sentido para si. Explore oportunidades e conheça comunidades que ajudam a abrir portas na tecnologia.</p>
    <p>Comece a pesquisar sem criar conta.</p>
    <a class="btn secundario" href="#categorias" id="btn-areas">Conhecer as Áreas Tech</a>
</section>

<section id="pesquisa">
    <h2>O que gostaria de explorar?</h2>

    <form method="get" action="oportunidades.php#resultados" class="formulario">
        <div class="campo-pesquisa">
            <label for="categoria">Categoria</label>
            <select id="categoria" name="categoria">
                <option value="">Todas</option>
                <option value="Web">Web</option>
                <option value="Dados & IA">Dados & IA</option>
                <option value="Jogos">Jogos</option>
                <option value="Cibersegurança">Cibersegurança</option>
                <option value="Carreira & Liderança">Carreira & Liderança</option>
            </select>
        </div>

        <div class="campo-pesquisa">
            <label for="tipo">Oportunidade</label>
            <select id="tipo" name="tipo">
                <option value="">Todas</option>
                <option value="curso">Curso</option>
                <option value="evento">Evento</option>
                <option value="comunidade">Comunidade</option>
                <option value="estágio">Estágio</option>
            </select>
        </div>

        <div class="campo-pesquisa">
            <label for="pais">País</label>
            <select id="pais" name="pais">
                <option value="">Todos</option>
                <option value="PT">PT</option>
                <option value="BR">BR</option>
                <option value="GLOBAL">Global</option>
            </select>
        </div>

        <div class="campo-pesquisa">
            <label for="formato">Formato</label>
            <select id="formato" name="formato">
                <option value="">Todos</option>
                <option value="presencial">Presencial</option>
                <option value="online">Online</option>
                <option value="híbrido">Híbrido</option>
            </select>
        </div>

        <button type="submit">Ver Oportunidades</button>
    </form>
</section>

<section id="inicio" class="inicio">
    <h2>Menos procura. Mais apoio para avançar.</h2>
    <p>As oportunidades estão muitas vezes espalhadas por diferentes sites e redes. O Women Forward facilita a pesquisa e aproxima mulheres de cursos, eventos, comunidades e estágios — para que seja mais simples descobrir possibilidades e escolher o próximo passo.</p>
    <div class="inicio-imagem-container apoio-image-container">
        <img class="inicio-imagem apoio-image"
            src="assets/images/women_stairs2.webp"
            alt="Uma mulher mais velha ensina algo a uma mulher mais jovem num escritório.">
    </div>
</section>

<section id="categorias" class="categorias">
    <h1>Explore Áreas Tech</h1>
    <article class="cartao-categoria">
        <div class="cartao-categoria-imagem">
            <img src="assets/images/notebook_detail.webp" alt="Detalhe de um notebook">
            <span class="cartao-categoria-etiqueta">Web</span>
        </div>
        <div class="cartao-categoria-conteudo">
            <h1 class="cartao-categoria-chamada">Criar para a internet</h1>
            <p class="cartao-categoria-descricao">Crie sites, aplicações e serviços que ligam pessoas e ideias.</p>
            <a class="btn secundario" href="oportunidades.php?categoria=Web">Ver Oportunidades</a>
        </div>
    </article>
    <article class="cartao-categoria">
        <div class="cartao-categoria-imagem">
            <img src="assets/images/wireframe/categoria-dados.webp" alt="Telemóvel apresenta informação meteorológica durante uma viagem">
            <span class="cartao-categoria-etiqueta">Dados &amp; IA</span>
        </div>
        <div class="cartao-categoria-conteudo">
            <h1 class="cartao-categoria-chamada">Padrões que revelam caminhos</h1>
            <p class="cartao-categoria-descricao">Descubra como os dados e a inteligência artificial apoiam novas soluções.</p>
            <a class="btn secundario" href="oportunidades.php?categoria=Dados%20%26%20IA">Ver Oportunidades</a>
        </div>
    </article>
    <article class="cartao-categoria">
        <div class="cartao-categoria-imagem">
            <img src="assets/images/wireframe/categoria-jogos.webp" alt="Jovem cria um jogo no computador com rascunhos à sua frente">
            <span class="cartao-categoria-etiqueta">Jogos</span>
        </div>
        <div class="cartao-categoria-conteudo">
            <h1 class="cartao-categoria-chamada">Ideias que ganham movimento</h1>
            <p class="cartao-categoria-descricao">Junte programação, design, narrativa e som em experiências interativas.</p>
            <a class="btn secundario" href="oportunidades.php?categoria=Jogos">Ver Oportunidades</a>
        </div>
    </article>
    <article class="cartao-categoria">
        <div class="cartao-categoria-imagem">
            <img src="assets/images/wireframe/categoria-ciberseguranca.webp" alt="Painéis de monitorização numa sala de controlo">
            <span class="cartao-categoria-etiqueta">Cibersegurança</span>
        </div>
        <div class="cartao-categoria-conteudo">
            <h1 class="cartao-categoria-chamada">Proteção para o mundo ligado</h1>
            <p class="cartao-categoria-descricao">Aprenda a proteger sistemas, redes e informação num mundo conectado.</p>
            <a class="btn secundario" href="oportunidades.php?categoria=Ciberseguran%C3%A7a">Ver Oportunidades</a>
        </div>
    </article>
    <article class="cartao-categoria">
        <div class="cartao-categoria-imagem">
            <img src="assets/images/meeting_online.webp" alt="Pessoas participam numa reunião online">
            <span class="cartao-categoria-etiqueta">Carreira &amp; Liderança</span>
        </div>
        <div class="cartao-categoria-conteudo">
            <h1 class="cartao-categoria-chamada">Crescer com outras pessoas</h1>
            <p class="cartao-categoria-descricao">Encontre oportunidades para crescer, partilhar experiências e liderar.</p>
            <a class="btn secundario" href="oportunidades.php?categoria=Carreira%20%26%20Lideran%C3%A7a">Ver Oportunidades</a>
        </div>
    </article>
</section>

<section id="entidades" class="chamada-entidades">
    <div class="chamada-entidades-conteudo">
        <p class="etiqueta-visual">Para entidades</p>
        <h1>Sua Entidade Faz a Diferença</h1>
        <p class="chamada-entidades-introducao">Divulgue cursos, eventos, comunidades e estágios para que mais mulheres encontrem oportunidades para crescer em tecnologia.</p>

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

        <div class="chamada-entidades-iniciativas">
            <h2>Aprender também é partilhar o que se constrói.</h2>
            <p>Encontros, apresentações e workshops aproximam ideias de pessoas e comunidades.</p>
            <a class="ligacao-visual" href="oportunidades.php?tipo=evento">Ver iniciativas e eventos →</a>
        </div>
    </div>
    <div class="chamada-entidades-imagem iniciativas-pitch-container">
        <img class="iniciativas-pitch" src="assets/images/wireframe/iniciativas-pitch.webp"
             alt="Equipa apresenta um projecto de jogo a uma audiência num evento">
    </div>
</section>

<?php require __DIR__ . '/../includes/rodape.php'; ?>
