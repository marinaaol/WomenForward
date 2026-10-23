# Women Forward

**Learn. Build. Lead.**

Women Forward é o projeto de conclusão do Curso de Especialização Tecnológica em Programação e Sistemas de Informação ofertado pelo IEFP e ministrado no ISLA Gaia. O projeto visa empoderar o acesso às informações de qualidade para mulheres que visam a carreira tech. É uma plataforma web criada para tornar cursos, eventos, comunidades e estágios em tecnologia mais fáceis de descobrir, permitindo pesquisar oportunidades por categoria, tipo, país e cidade.

## Problema

O acesso a oportunidades de formação e carreira em tecnologia é fragmentado. Para mulheres que estão a iniciar, a mudar de área ou a preparar-se para liderar, encontrar informação confiável e relevante pode exigir muito tempo e não oferecer um caminho claro.

A proposta responde também à desigualdade de género em STEM. A UNESCO indica que mulheres representam 35% das pessoas graduadas em STEM, valor que se mantém inalterado há uma década. Women Forward procura ampliar informação, referências e oportunidades para fortalecer autonomia, participação e liderança feminina.

## Proposta

- Pesquisa pública de oportunidades com filtros correlacionados.
- Registo de entidades para criar, editar e remover as suas próprias oportunidades.
- Percurso de marca: **Learn · Build · Lead**.

## Público

Pessoas a partir dos 16 anos, com foco em mulheres que procuram estudar, desenvolver experiência e avançar em áreas STEM, especialmente IT. A plataforma acolhe também entidades que divulgam oportunidades.

## Funcionalidades da primeira versão

| Área          | Entrega |
| Pesquisa      | Filtros por categoria, oportunidade, país, cidade e formato |
| Categorias    | Web, Dados & IA, Jogos, Cibersegurança e Carreira & Liderança |
| Oportunidades | Cursos, eventos, comunidades e estágios |
| Entidades     | Registo, autenticação e CRUD das próprias oportunidades |
| Privacidade   | Consentimento explícito e tratamento mínimo de dados |

## Modelo de dados

Categorias 1:N oportunidades
Entidades 1:N oportunidades

Não existe relação direta entre categorias e entidades: ambas relacionam-se através de oportunidades.

## Tecnologias

- HTML, CSS e JavaScript
- PHP 8.2+ com PDO

## Como pôr a funcionar

1. Instalar o XAMPP 8.2 e arrancar o Apache e o MySQL.
2. Copiar esta pasta para C:\xampp\htdocs e mudar-lhe o nome para "womenforward".
3. Abrir http://localhost/phpmyadmin, separador Importar, e escolher o ficheiro base_dados.sql.
4. Copiar `.env.example` para `.env` e preencher `DB_HOST`, `DB_PORT`, `DB_NAME`, `DB_USER` e `DB_PASSWORD`. A configuração local documentada é `127.0.0.1:3306`, base `womenforward`, utilizador `root` sem palavra-passe. O `.env` não é versionado.
5. Abrir http://localhost/womenforward

Utilizador de teste: womenforward@demo.test / Demo1234