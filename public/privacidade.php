<?php
require_once __DIR__ . '/../includes/inicio.php';

$titulo = 'Política de Privacidade';
require __DIR__ . '/../includes/cabecalho.php';
?>

<article class="detalhe">
    <h1>Política de Privacidade</h1>
    <p><strong>Atualização:</strong> <time datetime="2026-10-24">24 de outubro de 2026</time></p>
    <p>Esta página é um exemplo académico. Os nomes e contactos identificados como fictícios foram criados apenas para a demonstração do projeto e não representam uma pessoa ou serviço real.</p>

    <h2>Responsável pelo Tratamento</h2>
    <p>Para efeitos deste exemplo, trata-se de um projeto de conclusão do Curso de Especialização Tecnológica em Programação e Sistemas de Informação ofertado pelo IEFP e ministrado no ISLA Gaia. Ano de desenvolvimento do site: 2026. O contacto de demonstração é <a href="mailto:privacidade@womenforward.test">privacidade@womenforward.test</a>. Este endereço usa o domínio reservado <code>.test</code> e não recebe mensagens.</p>

    <h2>Dados Tratados</h2>
    <h3>Visitantes</h3>
    <p>Pode consultar e pesquisar oportunidades sem criar uma conta. A aplicação não pede nome ou email para pesquisar nem cria um perfil de visitante. O servidor local pode registar informação técnica da ligação durante a execução; a aplicação não inclui ferramentas de análise ou publicidade.</p>
    <h3>Contas de Entidades</h3>
    <p>O registo de uma entidade recolhe nome, email, palavra-passe e a data de aceitação da política. A palavra-passe é guardada sob a forma de hash. A sessão de autenticação usa um cookie técnico necessário para manter o acesso à conta.</p>
    <h3>Oportunidades</h3>
    <p>As publicações podem incluir título, descrição, categoria, tipo, país, cidade, formato, data de início e ligação externa, além do nome da entidade. Estas informações são apresentadas aos visitantes. A entidade que submete uma publicação é responsável pela sua exatidão e atualização.</p>

    <h2>Finalidades e Base de Tratamento (exemplo académico)</h2>
    <ul>
        <li>Gerir o registo, a autenticação e a sessão da entidade;</li>
        <li>Apresentar e permitir a pesquisa das oportunidades;</li>
        <li>Manter o funcionamento técnico e a segurança da demonstração;</li>
        <li>Registar a aceitação desta política no momento do registo.</li>
    </ul>

    <h2>Conservação</h2>
    <p>A base de dados incluída no projeto contém registos de demonstração. Numa utilização real, os dados de uma conta seriam mantidos enquanto a conta estivesse ativa e eliminados após um pedido de encerramento, salvo obrigação legal de conservação.</p>

    <h2>Partilha e Ligações Externas</h2>
    <p>O projeto é executado localmente para demonstração e não tem um fornecedor de alojamento público configurado. As ligações para oportunidades podem encaminhar para sites externos, que têm políticas próprias.</p>

    <h2>Segurança</h2>
    <p>Na versão de demonstração, as palavras-passe são protegidas com hash, as consultas à base de dados usam instruções preparadas e as páginas de conta verificam a sessão e o token CSRF.</p>

    <h2>Direitos e Contacto</h2>
    <p>Num serviço real, pode solicitar acesso, retificação ou apagamento dos seus dados, bem como exercer os restantes direitos previstos na legislação aplicável. Para este exemplo académico, o contacto indicado é fictício e não recebe pedidos. Também pode obter informação sobre a autoridade de controlo em <a href="https://www.cnpd.pt/" target="_blank" rel="noopener noreferrer">Comissão Nacional de Proteção de Dados (CNPD)</a>.</p>

    <aside class="nota" aria-label="Aviso sobre o projeto">
        <strong>Nota:</strong> <i> O Women Forward é um projeto de conclusão do Curso de Especialização Tecnológica em Programação e Sistemas de Informação, desenvolvido para fins académicos e de demonstração. Os nomes, contactos e dados de exemplo não representam pessoas, entidades ou serviços reais.</i>
    </aside>
</article>

<?php require __DIR__ . '/../includes/rodape.php'; ?>
