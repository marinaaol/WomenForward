<?php
require_once __DIR__ . '/../includes/inicio.php';

$titulo = 'Mulheres na STEM';
require __DIR__ . '/../includes/cabecalho.php';
?>



<section id="problema">
    <h1>Maior Diversidade Possibilita Novos Caminhos</h1>
    <p>A UNESCO estima que as mulheres representam 35% das pessoas graduadas em STEM no mundo, proporção que se manteve estável durante uma década. Este dado global ajuda a perceber por que é importante tornar a informação, as referências e as oportunidades mais acessíveis.</p>
    <p>A falta de representação não significa falta de capacidade. O acesso a oportunidades, referências e informação clara também influencia quem consegue descobrir estas áreas e construir nelas o seu percurso.</p>
</section>

<section>
    <div class="imagem-stem-container">
        <img class="imagem-stem" src="assets/images/women_ages.webp" alt="Grupo de 5 mulheres com idades e representatividades diversas.">
    </div>
</section>

<section class="stem-introducao">
    <h2>Há muitos caminhos para fazer parte da tecnologia</h2>
    <p>STEM - sigla em inglês que reúne <b>Ciência, Tecnologia, Engenharia e Matemática</b>. São áreas que nos ajudam a fazer perguntas, criar ferramentas e resolver problemas — e há muitas maneiras de fazer parte delas. Conheça algumas das áreas que pode explorar no Women Forward.</p>
</section>

<section id="areas" class="categorias areas-stem">
    <h2>Conheça Mais Sobre as Áreas Tech</h2>

    <article class="cartao-categoria">
        <div class="cartao-categoria-imagem">
            <img src="assets/images/notebook_detail.webp" alt="Detalhe de um notebook">
            <span class="cartao-categoria-etiqueta">Web</span>
        </div>
        <div class="cartao-categoria-conteudo">
            <h3 id="web" class="cartao-categoria-chamada">Criar para a internet</h3>
            <p class="cartao-categoria-descricao">Sites, aplicações e serviços online começam com ideias e ganham forma na web. Descubra oportunidades para aprender, criar e pôr os seus projetos em prática.</p>
            <a class="btn secundario" href="oportunidades.php?categoria=Web">Explorar Oportunidades</a>
        </div>
    </article>

    <article class="cartao-categoria">
        <div class="cartao-categoria-imagem">
            <img src="assets/images/wireframe/categoria-dados.webp" alt="Telemóvel apresenta informação meteorológica durante uma viagem">
            <span class="cartao-categoria-etiqueta">Dados &amp; IA</span>
        </div>
        <div class="cartao-categoria-conteudo">
            <h3 id="dados-ia" class="cartao-categoria-chamada">Padrões que revelam caminhos</h3>
            <p class="cartao-categoria-descricao">Os dados ajudam-nos a compreender informação. A inteligência artificial identifica padrões e pode apoiar diferentes tarefas. Explore cursos, eventos e comunidades ligados a estas áreas.</p>
            <a class="btn secundario" href="oportunidades.php?categoria=Dados%20%26%20IA">Explorar Oportunidades</a>
        </div>
    </article>

    <article class="cartao-categoria">
        <div class="cartao-categoria-imagem">
            <img src="assets/images/wireframe/categoria-jogos.webp" alt="Jovem cria um jogo no computador com rascunhos à sua frente">
            <span class="cartao-categoria-etiqueta">Jogos</span>
        </div>
        <div class="cartao-categoria-conteudo">
            <h3 id="jogos" class="cartao-categoria-chamada">Ideias que ganham movimento</h3>
            <p class="cartao-categoria-descricao">Um jogo junta programação, design, narrativa, som e testes. Há espaço para muitos talentos — descubra como o seu pode fazer parte.</p>
            <a class="btn secundario" href="oportunidades.php?categoria=Jogos">Explorar Oportunidades</a>
        </div>
    </article>

    <article class="cartao-categoria">
        <div class="cartao-categoria-imagem">
            <img src="assets/images/wireframe/categoria-ciberseguranca.webp" alt="Painéis de monitorização numa sala de controlo">
            <span class="cartao-categoria-etiqueta">Cibersegurança</span>
        </div>
        <div class="cartao-categoria-conteudo">
            <h3 id="ciberseguranca" class="cartao-categoria-chamada">Proteção para o mundo ligado</h3>
            <p class="cartao-categoria-descricao">Proteger sistemas, redes e informação é essencial num mundo conectado. Descubra oportunidades para aprender segurança digital e conhecer os desafios da área.</p>
            <a class="btn secundario" href="oportunidades.php?categoria=Ciberseguran%C3%A7a">Explorar Oportunidades</a>
        </div>
    </article>

    <article class="cartao-categoria">
        <div class="cartao-categoria-imagem">
            <img src="assets/images/meeting_online.webp" alt="Pessoas participam numa reunião online">
            <span class="cartao-categoria-etiqueta">Carreira &amp; Liderança</span>
        </div>
        <div class="cartao-categoria-conteudo">
            <h3 id="carreira-lideranca" class="cartao-categoria-chamada">Crescer com outras pessoas</h3>
            <p class="cartao-categoria-descricao">Crescer também é trocar experiências, abrir espaço a novas ideias e liderar. Explore oportunidades para desenvolver o seu percurso profissional em tecnologia.</p>
            <a class="btn secundario" href="oportunidades.php?categoria=Carreira%20%26%20Lideran%C3%A7a">Explorar Oportunidades</a>
        </div>
    </article>
</section>


<?php require __DIR__ . '/../includes/rodape.php'; ?>
