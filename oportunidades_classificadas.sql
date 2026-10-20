-- Women Forward | dados iniciais de oportunidades
-- Compatível com MySQL 8+ e MariaDB 10.4+ / phpMyAdmin
-- Data de curadoria: 15/10/2026
--
-- Pré-requisito: executar primeiro o schema do Guia SQL.
-- Esta query mantém o campo `pais` e acrescenta apenas o valor GLOBAL.
-- Cada registo de oportunidade fica associado à entidade indicada abaixo.

USE rota_tech;

-- 1. Permite oportunidades que não pertencem exclusivamente a PT ou BR.
ALTER TABLE oportunidades
  MODIFY pais ENUM('PT', 'BR', 'GLOBAL') NOT NULL;

-- 2. Garante as cinco categorias previstas no modelo.
INSERT INTO categorias (nome) VALUES
  ('Web'),
  ('Dados & IA'),
  ('Jogos'),
  ('Cibersegurança'),
  ('Liderança & Carreira')
ON DUPLICATE KEY UPDATE nome = VALUES(nome);

-- 3. Indique uma entidade já registada que será responsável pela curadoria.
-- O valor abaixo corresponde à entidade de teste criada no Guia SQL.
-- Antes de usar em produção, substitua-o pelo e-mail da entidade curadora.
SET @email_entidade_curadora = 'teste@womenforward.test';
SET @id_entidade_curadora = (
  SELECT id_entidade
  FROM entidades
  WHERE email = @email_entidade_curadora
  LIMIT 1
);

-- Confirmação: este SELECT deve devolver um id_entidade antes do INSERT seguinte.
SELECT @id_entidade_curadora AS id_entidade_curadora;

-- 4. Insere apenas links que conduzem a formação, evento, comunidade ou programa.
-- As colunas abaixo formam a correspondência: categoria, tipo, país, cidade,
-- formato e URL. Para GLOBAL, a cidade permanece NULL.
INSERT INTO oportunidades
  (id_categoria, id_entidade, titulo, descricao, tipo, pais, cidade, formato, url)
SELECT
  c.id_categoria,
  @id_entidade_curadora,
  dados.titulo,
  dados.descricao,
  dados.tipo,
  dados.pais,
  dados.cidade,
  dados.formato,
  dados.url
FROM (
  SELECT 'Web' AS categoria, '42 São Paulo — Formação em Engenharia de Software' AS titulo,
         'Formação gratuita e presencial em desenvolvimento de software; confirmar candidaturas no site.' AS descricao,
         'curso' AS tipo, 'BR' AS pais, 'São Paulo' AS cidade, 'presencial' AS formato,
         'https://www.42sp.org.br/' AS url
  UNION ALL SELECT 'Web', 'Tech Girls — Formação em TI e empregabilidade',
         'Formações em tecnologia para mulheres; confirmar turmas, cidades e requisitos diretamente com a organização.',
         'curso', 'BR', NULL, 'presencial', 'https://techgirls.com.br/'
  UNION ALL SELECT 'Web', 'PrograMaria — Formação e comunidade em tecnologia',
         'Iniciativas de aprendizagem e comunidade para mulheres na tecnologia; consultar a programação atual no site.',
         'comunidade', 'BR', NULL, 'online', 'https://www.programaria.org/'
  UNION ALL SELECT 'Dados & IA', 'WoMakersCode — Cursos, bootcamps e mentorias',
         'Ecossistema de capacitação, eventos e mentorias para mulheres na tecnologia; consultar programas disponíveis.',
         'comunidade', 'BR', NULL, 'hibrido', 'https://www.womakerscode.org/'
  UNION ALL SELECT 'Liderança & Carreira', 'Ladies in Tech — Liderança feminina em tecnologia',
         'Comunidade brasileira voltada à liderança feminina em tecnologia; consultar atividades e inscrições no site.',
         'comunidade', 'BR', NULL, 'hibrido', 'https://ladiesintech.com.br/'
  UNION ALL SELECT 'Web', 'Raparigas do Código — Comunidade e aprendizagem',
         'Comunidade portuguesa para aprendizagem e participação de raparigas e mulheres em tecnologia.',
         'comunidade', 'PT', NULL, 'hibrido', 'https://raparigasdocodigo.pt/'
  UNION ALL SELECT 'Web', 'Descodifica-te — Requalificação digital para mulheres',
         'Programa de requalificação digital para mulheres; confirmar edições, formato e requisitos no site.',
         'curso', 'PT', NULL, 'hibrido', 'https://descodificate.pt/'
  UNION ALL SELECT 'Web', '42 Porto — Formação em desenvolvimento de software',
         'Formação gratuita em programação e desenvolvimento de software; candidatura e processo seletivo no site.',
         'curso', 'PT', 'Porto', 'presencial', 'https://www.42porto.com/pt/'
  UNION ALL SELECT 'Dados & IA', 'Technovation Portugal — Programas e comunidade STEM',
         'Iniciativas e comunidade de aprendizagem STEM; consultar os programas em curso no site.',
         'comunidade', 'PT', NULL, 'hibrido', 'https://technovation.pt/'
  UNION ALL SELECT 'Liderança & Carreira', 'Portuguese Women in Tech — Comunidade profissional',
         'Comunidade e iniciativas de carreira para mulheres no ecossistema tecnológico português.',
         'comunidade', 'PT', NULL, 'hibrido', 'https://www.portuguesewomenintech.com/'
  UNION ALL SELECT 'Liderança & Carreira', 'Women in Tech Portugal — Comunidade e oportunidades',
         'Comunidade profissional para mulheres em tecnologia; consultar eventos e iniciativas disponíveis.',
         'comunidade', 'PT', NULL, 'hibrido', 'https://www.womenintech.pt/'
  UNION ALL SELECT 'Web', 'SheCodes — Workshops de programação',
         'Formações online de programação e desenvolvimento web; consultar modalidades e custos no site.',
         'curso', 'GLOBAL', NULL, 'online', 'https://www.shecodes.io/'
  UNION ALL SELECT 'Web', 'CodeWomen — Comunidade de aprendizagem',
         'Comunidade e recursos de aprendizagem em programação para mulheres; consultar condições no site.',
         'comunidade', 'GLOBAL', NULL, 'online', 'https://codewomen.plus/en/'
  UNION ALL SELECT 'Liderança & Carreira', 'Ladies Who Tech — Comunidade global',
         'Comunidade internacional para mulheres em tecnologia; consultar programas e eventos atuais no site.',
         'comunidade', 'GLOBAL', NULL, 'online', 'https://ladieswho.tech/eng'
  UNION ALL SELECT 'Liderança & Carreira', 'Hire Tech Ladies — Comunidade e carreira',
         'Comunidade e recursos de carreira para mulheres em tecnologia; consultar elegibilidade e serviços no site.',
         'comunidade', 'GLOBAL', NULL, 'online', 'https://www.hiretechladies.com/'
  UNION ALL SELECT 'Liderança & Carreira', 'WomenTech Global Conference',
         'Conferência e rede internacional de mulheres em tecnologia; confirmar edição, datas e formato no site.',
         'evento', 'GLOBAL', NULL, 'hibrido', 'https://www.womentech.net/women-tech-conference'
  UNION ALL SELECT 'Liderança & Carreira', 'Global Women Tech Leaders — Comunidade de liderança',
         'Rede global de liderança e ligação profissional para mulheres em tecnologia; consultar participação no site.',
         'comunidade', 'GLOBAL', NULL, 'online', 'https://www.globalwomentechleaders.com/'
  UNION ALL SELECT 'Web', 'MIT OpenCourseWare — Introductory Programming',
         'Coleção aberta de materiais de programação introdutória do MIT OpenCourseWare.',
         'curso', 'GLOBAL', NULL, 'online', 'https://ocw.mit.edu/collections/introductory-programming/'
  UNION ALL SELECT 'Web', 'Harvard Online — Catálogo de programação',
         'Catálogo de formações de programação; consultar disponibilidade e condições de cada curso.',
         'curso', 'GLOBAL', NULL, 'online', 'https://pll.harvard.edu/catalog?topics%5B702%5D=702&topics%5B715%5D=715&price%5B1%5D=1&max_price=&start_date=&keywords=&url='
  UNION ALL SELECT 'Liderança & Carreira', 'London Business School — Women in Leadership',
         'Formação executiva em liderança; consultar requisitos, preço, calendário e modalidade no site.',
         'curso', 'GLOBAL', NULL, 'hibrido', 'https://www.london.edu/executive-education/leadership/women-in-leadership'
  UNION ALL SELECT 'Liderança & Carreira', 'Cisco Live — IT Leadership Program',
         'Programa de liderança em TI associado ao Cisco Live; confirmar próxima edição e participação no site.',
         'evento', 'GLOBAL', NULL, 'hibrido', 'https://www.ciscolive.com/emea/learn/programs/it-leadership.html'
  UNION ALL SELECT 'Cibersegurança', 'Cisco Networking Academy — Introduction to Cybersecurity',
         'Curso introdutório de cibersegurança; consultar idioma, disponibilidade e requisitos de inscrição no site.',
         'curso', 'GLOBAL', NULL, 'online', 'https://www.netacad.com/courses/introduction-to-cybersecurity?courseLang=en-US'
  UNION ALL SELECT 'Cibersegurança', 'TryHackMe — Cyber Security Learning Roadmap',
         'Plataforma de aprendizagem prática com percursos e laboratórios de cibersegurança no navegador.',
         'curso', 'GLOBAL', NULL, 'online', 'https://tryhackme.com/hacktivities'
  UNION ALL SELECT 'Cibersegurança', 'Harvard Online — Cybersecurity Courses',
         'Catálogo de cursos de cibersegurança, incluindo opções online; consultar disponibilidade de cada curso.',
         'curso', 'GLOBAL', NULL, 'online', 'https://pll.harvard.edu/subject/cybersecurity'
  UNION ALL SELECT 'Jogos', 'Game Strategies — Formação com jogos e simuladores',
         'Plataforma de formação gamificada para equipas; a participação é orientada a organizações e requer demonstração.',
         'curso', 'GLOBAL', NULL, 'online', 'https://gamestrategies.io/en/'
  UNION ALL SELECT 'Jogos', 'CodeCombat — Programação através de jogos',
         'Plataforma de aprendizagem de programação através de jogos; consultar planos e condições no site.',
         'curso', 'GLOBAL', NULL, 'online', 'https://codecombat.com/'
  UNION ALL SELECT 'Jogos', '.NET — Learn game development',
         'Cursos, tutoriais e vídeos gratuitos para aprendizagem de desenvolvimento de jogos com .NET.',
         'curso', 'GLOBAL', NULL, 'online', 'https://dotnet.microsoft.com/en-us/learn/games'
  UNION ALL SELECT 'Jogos', 'Unity Learn — Desenvolvimento de jogos e 3D',
         'Cursos, projetos e tutoriais para desenvolvimento de jogos e experiências 3D em tempo real.',
         'curso', 'GLOBAL', NULL, 'online', 'https://learn.unity.com/'
  UNION ALL SELECT 'Jogos', 'Roblox Creator Hub — Criação de experiências',
         'Ponto de entrada para criação de experiências na plataforma Roblox; consultar recursos e requisitos no site.',
         'curso', 'GLOBAL', NULL, 'online', 'https://create.roblox.com/landing'
  UNION ALL SELECT 'Dados & IA', 'Claude Academy — AI Fluency e construção com IA',
         'Cursos e tutoriais gratuitos para utilização segura e eficaz de IA, incluindo conteúdos de construção com Claude.',
         'curso', 'GLOBAL', NULL, 'online', 'https://academy.claude.com/'
) AS dados
JOIN categorias AS c ON c.nome = dados.categoria
LEFT JOIN oportunidades AS existente ON existente.url = dados.url
WHERE @id_entidade_curadora IS NOT NULL
  AND existente.id_oportunidade IS NULL;

-- 5. Verificação final: mostra a classificação inserida.
SELECT
  o.titulo,
  c.nome AS categoria,
  o.tipo,
  o.pais,
  o.cidade,
  o.formato,
  o.url
FROM oportunidades AS o
JOIN categorias AS c ON c.id_categoria = o.id_categoria
WHERE o.id_entidade = @id_entidade_curadora
ORDER BY c.nome, o.titulo;

-- Fontes mantidas fora de `oportunidades` por serem artigos, rankings,
-- páginas institucionais, políticas públicas ou arquivo de encerramento:
-- Microsoft Code of Us / Women; Google’s initiative Women in Tech;
-- Women Who Code (encerrada); Women in Tech to Watch; Forbes Top Tech Women;
-- Women in Tech UK Top Women Leaders; Cloudera Women Leaders;
-- HopSkipDrive 10 Women Leading the Way; Technology Magazine Top 10;
-- Digital Strategy EU Women in Digital; WiDigital.
-- Estas referências podem integrar, futuramente, uma tabela própria `referencias`.
