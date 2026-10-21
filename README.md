# Women Forward

**Learn. Build. Lead.**

Women Forward é o projeto de conclusão do Curso  de Especialização Tecnológica em Programação e Sistemas de Informação ofertado pelo IEFP e ministrado no ISLA Gaia. O projeto visa empoderar o acesso às informações de qualidade para mulheres que visam a carreira tech. É uma plataforma web criada para tornar cursos, eventos, comunidades e estágios em tecnologia mais fáceis de descobrir, permitindo pesquisar oportunidades por categoria, tipo, país e cidade.

## Problema

O acesso a oportunidades de formação e carreira em tecnologia é fragmentado. Para mulheres que estão a iniciar, a mudar de área ou a preparar-se para liderar, encontrar informação confiável e relevante pode exigir muito tempo e não oferecer um caminho claro.

A proposta responde também à desigualdade de género em STEM. A [UNESCO](https://www.unesco.org/en/gender-equality/education/stem) indica que mulheres representam 35% das pessoas graduadas em STEM, valor que se mantém inalterado há uma década. Women Forward procura ampliar informação, referências e oportunidades para fortalecer autonomia, participação e liderança feminina.

## Proposta

- Pesquisa pública de oportunidades com filtros correlacionados.
- Registo de entidades para criar, editar e remover as suas próprias oportunidades.
- Recomendações futuras baseadas num questionário com opções limitadas.
- Percurso de marca: **Learn · Build · Lead**.

## Público

Pessoas a partir dos 16 anos, com foco em mulheres que procuram estudar, desenvolver experiência e avançar em áreas STEM, especialmente IT. A plataforma acolhe também entidades que divulgam oportunidades.

## Funcionalidades da primeira versão

| Área          | Entrega |

| Pesquisa      | Filtros por categoria, oportunidade, país, cidade e formato |
| Categorias    | Web, Dados & IA, Jogos, Cibersegurança e Carreira & Liderança |
| Oportunidades | Cursos, eventos, comunidades e estágios |
| Entidades     | Registo e autenticação; CRUD das próprias oportunidades em desenvolvimento |
| Privacidade   | Consentimento explícito e tratamento mínimo de dados |

## Modelo de dados

Categorias 1:N oportunidades  
Entidades 1:N oportunidades

Não existe relação direta entre categorias e entidades: ambas relacionam-se através de oportunidades.

## Tecnologias previstas

- HTML, CSS e JavaScript
- PHP com PDO
- MySQL ou MariaDB
- phpMyAdmin para criação e testes da base de dados

## Execução em servidor local

O projeto combina páginas públicas em HTML, processamento em PHP e uma base de dados MySQL/MariaDB. A pesquisa é pública; o registo e a gestão de oportunidades destinam-se às entidades.

### Requisitos obrigatórios

| Componente                  | Requisito |

| Sistema operativo           | Linux, macOS ou Windows 10/11 |
| PHP                         | PHP 8.2 ou superior, disponível no terminal, com pdo_mysql e mbstring ativos |
| Base de dados               | MySQL 8.0 ou superior, ou MariaDB 10.6 ou superior, na porta 3306 |
| Ferramenta de base de dados | phpMyAdmin para importar e testar o script SQL |
| Servidor de desenvolvimento | Servidor embutido do PHP; não requer Apache, Nginx, Node.js ou Composer na primeira versão |

### Estrutura do repositório

    config/db.php             # ligação PDO e leitura local do .env
    includes/                 # autenticação e partes reutilizáveis das páginas
    database/base_dados.sql   # esquema e dados iniciais
    public/                   # única pasta servida pelo servidor web
      index.php
      pesquisar.html
      oportunidades.php
      oportunidade_ver.php
      login.php
      registar.php
      logout.php
      areas.html, entidades.html, stem.html, privacidade.html
      assets/css/style.css
      assets/js/app.js
      assets/images/           # imagens e logótipo usados nas páginas
    .env.example               # exemplo sem credenciais reais
    .env                      # configuração local, ignorada pelo Git

`dashboard.php` está na pasta pública por legado, mas a sua função fica fora do desenvolvimento ativo até o CRUD estar pronto. As pastas `config/`, `includes/` e `database/` não devem ser servidas diretamente pelo navegador.

O ficheiro .env é local, não é versionado e contém apenas os dados de ligação. O ficheiro .env.example é versionado sem palavras-passe.

### Configuração de ligação

    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_NAME=womenforward
    DB_USER=root
    DB_PASSWORD=

### Procedimento único de arranque

1. Instalar e iniciar MySQL ou MariaDB.
2. Copiar `.env.example` para `.env` e preencher os dados locais de ligação. O `.env` não deve ser enviado ao GitHub.
3. Importar `database/base_dados.sql` pelo phpMyAdmin. O script cria a base `womenforward`, as tabelas e dados demonstrativos; importe-o uma única vez numa base ainda não criada.
4. No diretório raiz do repositório, executar:

    php -S 127.0.0.1:8000 -t public

Abrir http://127.0.0.1:8000 no navegador. Este comando é igual em Linux, macOS e Windows, desde que `php -v` funcione no terminal. No Windows, executar o comando em PowerShell ou Prompt de Comando depois de adicionar o diretório do PHP à variável PATH.

Antes de arrancar, confirmar php -v, php -m (deve listar pdo_mysql e mbstring) e que a base de dados aceita ligações em 127.0.0.1:3306.

## Equipa

- Beatriz Neves — Funcionalidades: CRUD (lógica), pesquisa e filtros e validação.
- Marina Oliveira — Interface: HTML/CSS, JavaScript, páginas de listagem e detalhe, formulários e acessibilidade.
- Paulo Primo — Base de Dados: autenticação e segurança (PDO), sessões e controlo de acesso.

## Marca

Nome: **Women Forward**  
Slogan: **Learn. Build. Lead.**

A marca usa percursos, blocos e grelhas como elementos visuais de fácil aplicação na web. O guia de marca está disponível em dist/women-forward.html.
