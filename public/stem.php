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
    <h2>Há muitos caminhos para fazer parte da tecnologia</h2>
    <p>STEM reúne Ciência, Tecnologia, Engenharia e Matemática. São áreas que nos ajudam a fazer perguntas, criar ferramentas e resolver problemas — e há muitas maneiras de fazer parte delas. Conheça algumas das áreas que pode explorar no Women Forward.</p>
    <img class="imagem-stem" src="assets/images/wireframe/stem-workshop.webp" alt="Participantes colaboram numa actividade prática de prototipagem tecnológica">
</section>

<section id="areas">
    <h2>Conheça Mais Sobre as Áreas Tech</h2>

    <article>
        <h3 id="web">WEB</h3>
        <p>Sites, aplicações e serviços online começam com ideias e ganham forma na web. Descubra oportunidades para aprender, criar e pôr os seus projetos em prática.</p>
        <p><a class="btn secundario" href="oportunidades.php?categoria=Web">Explorar oportunidades em Web</a></p>
    </article>

    <article>
        <h3 id="dados-ia">DADOS &amp; IA</h3>
        <p>Os dados ajudam-nos a compreender informação. A inteligência artificial identifica padrões e pode apoiar diferentes tarefas. Explore cursos, eventos e comunidades ligados a estas áreas.</p>
        <p><a class="btn secundario" href="oportunidades.php?categoria=Dados%20%26%20IA">Explorar oportunidades em Dados &amp; IA</a></p>
    </article>

    <article>
        <h3 id="jogos">JOGOS</h3>
        <p>Um jogo junta programação, design, narrativa, som e testes. Há espaço para muitos talentos — descubra como o seu pode fazer parte.</p>
        <p><a class="btn secundario" href="oportunidades.php?categoria=Jogos">Explorar oportunidades em Jogos</a></p>
    </article>

    <article>
        <h3 id="ciberseguranca">CIBERSEGURANÇA</h3>
        <p>Proteger sistemas, redes e informação é essencial num mundo conectado. Descubra oportunidades para aprender segurança digital e conhecer os desafios da área.</p>
        <p><a class="btn secundario" href="oportunidades.php?categoria=Ciberseguran%C3%A7a">Explorar oportunidades em Cibersegurança</a></p>
    </article>

    <article>
        <h3 id="carreira-lideranca">CARREIRA &amp; LIDERANÇA</h3>
        <p>Crescer também é trocar experiências, abrir espaço a novas ideias e liderar. Explore oportunidades para desenvolver o seu percurso profissional em tecnologia.</p>
        <p><a class="btn secundario" href="oportunidades.php?categoria=Carreira%20%26%20Lideran%C3%A7a">Explorar oportunidades em Carreira &amp; Liderança</a></p>
    </article>
</section>

<section aria-labelledby="titulo-perfis-stem">
    <h2 id="titulo-perfis-stem">Tecnologia faz-se em equipa e em diferentes fases da vida.</h2>
    <div class="cartoes-stem">
        <article class="cartao-visual">
            <img src="assets/images/wireframe/detalhe-equipa-tech.webp" alt="Colegas colaboram numa tarefa tecnológica no escritório">
            <div>
                <h3>Colaboração no trabalho</h3>
                <p>Uma janela para o quotidiano das equipas que criam e mantêm tecnologia.</p>
                <a class="ligacao-visual" href="oportunidades.php">Explorar oportunidades →</a>
            </div>
        </article>
        <article class="cartao-visual">
            <img src="assets/images/wireframe/perfis-diversos.webp" alt="Mulheres de diferentes idades partilham um momento de colaboração">
            <div>
                <h3>Mais do que um ponto de entrada</h3>
                <p>Aprender, mudar de área ou avançar na carreira pode acontecer em momentos diferentes.</p>
                <a class="ligacao-visual" href="oportunidades.php?categoria=Carreira%20%26%20Lideran%C3%A7a">Conhecer percursos →</a>
            </div>
        </article>
    </div>
</section>

<section>
    <h2>Aprender · Construir · Liderar</h2>
    <p>Estes são caminhos possíveis, não etapas obrigatórias. Pode começar, mudar de área, retomar os estudos ou avançar na carreira em diferentes momentos da vida.</p>
</section>

<section id="solucao">
    <h2>O Women Forward Aproxima Oportunidades</h2>
    <p>Explore opções para conhecer áreas tech, mudar de carreira ou atualizar competências. Compare cursos, eventos, comunidades e estágios e confirme os requisitos diretamente com a entidade responsável.</p>
    <p><a class="btn" href="oportunidades.php">Ver Minhas Oportunidades</a></p>
</section>



<?php require __DIR__ . '/../includes/rodape.php'; ?>
