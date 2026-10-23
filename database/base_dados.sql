-- ============================================================
--  WomenForward — cria a base de dados de raiz, com dados de exemplo
--  Importar no phpMyAdmin (separador Importar) ou na linha de comandos:
--  mysql -u root -p < base_dados.sql
-- ============================================================

-- Garante que os acentos são lidos corretamente, seja qual for o cliente
SET NAMES utf8mb4;

DROP DATABASE IF EXISTS womenforward;
CREATE DATABASE womenforward CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE womenforward;

-- Quem pode criar, atualizar e eliminar oportunidades depois de fazer registo e login
-- Lado "1" da relação: uma entidade tem várias oportunidades
CREATE TABLE entidades (
  id_entidade INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(120) NOT NULL,
  email VARCHAR(120) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  consentimento_em DATETIME NOT NULL
);

-- Lado "1" da relação: uma categoria tem várias oportunidades
CREATE TABLE categorias (
  id_categoria INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(50) NOT NULL,
  CONSTRAINT chk_categorias_nome
    CHECK (nome IN ('Web', 'Dados & IA', 'Jogos', 'Cibersegurança', 'Carreira & Liderança')),
  CONSTRAINT uq_categorias_nome UNIQUE (nome)
);

-- Lado "N" da relação: cada oportunidade pertence a uma entidade e a uma categoria
CREATE TABLE oportunidades (
  id_oportunidade INT AUTO_INCREMENT PRIMARY KEY,
  id_entidade INT NOT NULL,
  id_categoria INT NOT NULL,
  titulo VARCHAR(150) NOT NULL,
  descricao TEXT NOT NULL,
  tipo ENUM('curso', 'evento', 'comunidade', 'estágio') NOT NULL,
  formato ENUM('presencial', 'online', 'híbrido') NOT NULL,
  pais ENUM('PT', 'BR', 'GLOBAL') NOT NULL,
  cidade ENUM('Porto', 'Lisboa', 'São Paulo', 'Rio de Janeiro') NULL,
  url VARCHAR(255) NOT NULL UNIQUE,
  data_inicio DATE NULL,
  ativo BOOLEAN NOT NULL DEFAULT TRUE,
  criado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  atualizado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
    ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT fk_oportunidade_categoria
    FOREIGN KEY (id_categoria) REFERENCES categorias(id_categoria)
    ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT fk_oportunidade_entidade
    FOREIGN KEY (id_entidade) REFERENCES entidades(id_entidade)
    ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT chk_pais_cidade CHECK (
    cidade IS NULL
    OR (pais = 'PT' AND cidade IN ('Porto', 'Lisboa'))
    OR (pais = 'BR' AND cidade IN ('São Paulo', 'Rio de Janeiro'))
  )
);

-- Garante as cinco categorias previstas no modelo
INSERT INTO categorias (nome) VALUES
  ('Web'),
  ('Dados & IA'),
  ('Jogos'),
  ('Cibersegurança'),
  ('Carreira & Liderança');

-- Entidades de exemplo com email fictício e password comum (Demo1234)
-- Entidade de teste: womenforward@demo.test / Demo1234
INSERT INTO entidades (nome, email, password_hash, consentimento_em) VALUES
  ('Harvard Online', 'harvard@womenforward.test', '$2y$12$wtvyr7Br21NfSwx8lFD1EujFE1Q/5l4NumFPTF4aZ5OVbvUr4/V2m', '2025-10-03 09:14:22'),
  ('TryHackMe', 'tryhackme@womenforward.test', '$2y$12$wtvyr7Br21NfSwx8lFD1EujFE1Q/5l4NumFPTF4aZ5OVbvUr4/V2m', '2025-10-19 16:47:05'),
  ('Cisco Networking Academy', 'cisconetacad@womenforward.test', '$2y$12$wtvyr7Br21NfSwx8lFD1EujFE1Q/5l4NumFPTF4aZ5OVbvUr4/V2m', '2025-11-07 11:32:40'),
  ('Claude Academy', 'claudeacademy@womenforward.test', '$2y$12$wtvyr7Br21NfSwx8lFD1EujFE1Q/5l4NumFPTF4aZ5OVbvUr4/V2m', '2025-11-21 08:05:13'),
  ('Technovation Portugal', 'technovation@womenforward.test', '$2y$12$wtvyr7Br21NfSwx8lFD1EujFE1Q/5l4NumFPTF4aZ5OVbvUr4/V2m', '2025-12-02 19:23:57'), 
  ('WoMakersCode', 'womakerscode@womenforward.test', '$2y$12$wtvyr7Br21NfSwx8lFD1EujFE1Q/5l4NumFPTF4aZ5OVbvUr4/V2m', '2025-12-15 14:11:08'),
  ('Roblox Creator Hub', 'roblox@womenforward.test', '$2y$12$wtvyr7Br21NfSwx8lFD1EujFE1Q/5l4NumFPTF4aZ5OVbvUr4/V2m', '2026-01-05 10:38:29'), 
  ('Unity Learn', 'unitylearn@womenforward.test', '$2y$12$wtvyr7Br21NfSwx8lFD1EujFE1Q/5l4NumFPTF4aZ5OVbvUr4/V2m', '2026-01-18 17:52:44'),
  ('.NET (Microsoft)', 'dotnet@womenforward.test', '$2y$12$wtvyr7Br21NfSwx8lFD1EujFE1Q/5l4NumFPTF4aZ5OVbvUr4/V2m', '2026-02-01 07:29:16'),
  ('CodeCombat', 'codecombat@womenforward.test', '$2y$12$wtvyr7Br21NfSwx8lFD1EujFE1Q/5l4NumFPTF4aZ5OVbvUr4/V2m', '2026-02-14 21:03:51'),
  ('Game Strategies', 'gamestrategies@womenforward.test', '$2y$12$wtvyr7Br21NfSwx8lFD1EujFE1Q/5l4NumFPTF4aZ5OVbvUr4/V2m', '2026-02-27 12:40:33'),
  ('Cisco Live', 'ciscolive@womenforward.test', '$2y$12$wtvyr7Br21NfSwx8lFD1EujFE1Q/5l4NumFPTF4aZ5OVbvUr4/V2m', '2026-03-11 15:18:02'),
  ('London Business School', 'londonbs@womenforward.test', '$2y$12$wtvyr7Br21NfSwx8lFD1EujFE1Q/5l4NumFPTF4aZ5OVbvUr4/V2m', '2026-03-24 09:57:47'),
  ('Global Women Tech Leaders', 'globalwtl@womenforward.test', '$2y$12$wtvyr7Br21NfSwx8lFD1EujFE1Q/5l4NumFPTF4aZ5OVbvUr4/V2m', '2026-04-06 18:26:11'),
  ('WomenTech Global Conference','womentech@womenforward.test', '$2y$12$wtvyr7Br21NfSwx8lFD1EujFE1Q/5l4NumFPTF4aZ5OVbvUr4/V2m', '2026-04-19 13:09:38'),
  ('Hire Tech Ladies', 'hiretechladies@womenforward.test', '$2y$12$wtvyr7Br21NfSwx8lFD1EujFE1Q/5l4NumFPTF4aZ5OVbvUr4/V2m', '2026-05-02 20:44:55'),
  ('Ladies Who Tech', 'ladieswhotech@womenforward.test', '$2y$12$wtvyr7Br21NfSwx8lFD1EujFE1Q/5l4NumFPTF4aZ5OVbvUr4/V2m', '2026-05-16 06:31:20'),
  ('Women in Tech Portugal', 'womenintechpt@womenforward.test', '$2y$12$wtvyr7Br21NfSwx8lFD1EujFE1Q/5l4NumFPTF4aZ5OVbvUr4/V2m', '2026-05-29 11:15:09'),
  ('Portuguese Women in Tech', 'portuguesewit@womenforward.test', '$2y$12$wtvyr7Br21NfSwx8lFD1EujFE1Q/5l4NumFPTF4aZ5OVbvUr4/V2m', '2026-06-10 22:07:41'),
  ('Ladies in Tech', 'ladiesintech@womenforward.test', '$2y$12$wtvyr7Br21NfSwx8lFD1EujFE1Q/5l4NumFPTF4aZ5OVbvUr4/V2m', '2026-06-23 14:53:27'),
  ('MIT OpenCourseWare', 'mitocw@womenforward.test', '$2y$12$wtvyr7Br21NfSwx8lFD1EujFE1Q/5l4NumFPTF4aZ5OVbvUr4/V2m', '2026-07-05 08:48:14'),
  ('CodeWomen', 'codewomen@womenforward.test', '$2y$12$wtvyr7Br21NfSwx8lFD1EujFE1Q/5l4NumFPTF4aZ5OVbvUr4/V2m', '2026-07-19 16:22:36'),
  ('SheCodes', 'shecodes@womenforward.test', '$2y$12$wtvyr7Br21NfSwx8lFD1EujFE1Q/5l4NumFPTF4aZ5OVbvUr4/V2m', '2026-08-01 10:04:52'),
  ('42 Porto', '42porto@womenforward.test', '$2y$12$wtvyr7Br21NfSwx8lFD1EujFE1Q/5l4NumFPTF4aZ5OVbvUr4/V2m', '2026-08-14 19:37:18'),
  ('Descodifica-te', 'descodificate@womenforward.test', '$2y$12$wtvyr7Br21NfSwx8lFD1EujFE1Q/5l4NumFPTF4aZ5OVbvUr4/V2m', '2026-08-27 07:56:03'),
  ('Raparigas do Código', 'raparigasdocodigo@womenforward.test', '$2y$12$wtvyr7Br21NfSwx8lFD1EujFE1Q/5l4NumFPTF4aZ5OVbvUr4/V2m', '2026-09-09 12:41:29'),
  ('PrograMaria', 'programaria@womenforward.test', '$2y$12$wtvyr7Br21NfSwx8lFD1EujFE1Q/5l4NumFPTF4aZ5OVbvUr4/V2m', '2026-09-22 15:26:47'),
  ('Tech Girls', 'techgirls@womenforward.test', '$2y$12$wtvyr7Br21NfSwx8lFD1EujFE1Q/5l4NumFPTF4aZ5OVbvUr4/V2m', '2026-10-04 09:03:11'),
  ('42 São Paulo', '42sp@womenforward.test', '$2y$12$wtvyr7Br21NfSwx8lFD1EujFE1Q/5l4NumFPTF4aZ5OVbvUr4/V2m', '2026-10-13 17:48:55'),
  ('Entidade de Teste', 'womenforward@demo.test', '$2y$12$wtvyr7Br21NfSwx8lFD1EujFE1Q/5l4NumFPTF4aZ5OVbvUr4/V2m', '2025-10-08 10:00:00');

-- Oportunidades de Exemplo
INSERT INTO oportunidades (id_categoria, id_entidade, titulo, descricao, tipo, pais, cidade, formato, url) VALUES

  -- Web
  (1, 29, '42 São Paulo — Formação em Engenharia de Software', 'Formação gratuita e presencial em desenvolvimento de software.', 'curso', 'BR', 'São Paulo', 'presencial', 'https://www.42sp.org.br/'),
  (1, 28, 'Tech Girls — Formação em TI e empregabilidade', 'Formações em tecnologia para mulheres; confirmar turmas, cidades e requisitos diretamente com a organização.', 'curso', 'BR', NULL, 'presencial', 'https://techgirls.com.br/'),
  (1, 27, 'PrograMaria — Formação e comunidade em tecnologia', 'Iniciativas de aprendizagem e comunidade para mulheres na tecnologia; consultar a programação atual no site.', 'comunidade', 'BR', NULL, 'online', 'https://www.programaria.org/'),
  (1, 26, 'Raparigas do Código — Comunidade e aprendizagem', 'Comunidade portuguesa para aprendizagem e participação de raparigas e mulheres em tecnologia.', 'comunidade', 'PT', NULL, 'online', 'https://raparigasdocodigo.pt/'),
  (1, 25, 'Descodifica-te — Requalificação digital para mulheres', 'Programa de requalificação digital para mulheres; confirmar edições, formato e requisitos no site.', 'curso', 'PT', NULL, 'online', 'https://descodificate.pt/'),
  (1, 24, '42 Porto — Formação em desenvolvimento de software', 'Formação gratuita em programação e desenvolvimento de software; candidatura e processo seletivo no site.', 'curso', 'PT', 'Porto', 'presencial', 'https://www.42porto.com/pt/'),
  (1, 23, 'SheCodes — Workshops de programação', 'Formações online de programação e desenvolvimento web; consultar modalidades e custos no site.', 'curso', 'GLOBAL', NULL, 'online', 'https://www.shecodes.io/'),
  (1, 22, 'CodeWomen — Comunidade de aprendizagem', 'Comunidade e recursos de aprendizagem em programação para mulheres; consultar condições no site.', 'comunidade', 'GLOBAL', NULL, 'online', 'https://codewomen.plus/en/'),
  (1, 21, 'MIT OpenCourseWare — Introductory Programming', 'Coleção aberta de materiais de programação introdutória do MIT OpenCourseWare.', 'curso', 'GLOBAL', NULL, 'online', 'https://ocw.mit.edu/collections/introductory-programming/'),
  (1, 1, 'Harvard Online — Catálogo de programação', 'Catálogo de formações de programação; consultar disponibilidade e condições de cada curso.', 'curso', 'GLOBAL', NULL, 'online', 'https://pll.harvard.edu/catalog?topics%5B702%5D=702&topics%5B715%5D=715&price%5B1%5D=1&max_price=&start_date=&keywords=&url='),

  -- Dados & IA
  (2, 6, 'WoMakersCode — Cursos, bootcamps e mentorias', 'Ecossistema de capacitação, eventos e mentorias para mulheres na tecnologia; consultar programas disponíveis.', 'comunidade', 'BR', NULL, 'online', 'https://www.womakerscode.org/'),
  (2, 5, 'Technovation Portugal — Programas e comunidade STEM', 'Iniciativas e comunidade de aprendizagem STEM; consultar os programas em curso no site.', 'comunidade', 'PT', NULL, 'online', 'https://technovation.pt/'),
  (2, 4, 'Claude Academy — AI Fluency e construção com IA', 'Cursos e tutoriais gratuitos para utilização segura e eficaz de IA, incluindo conteúdos de construção com Claude.', 'curso', 'GLOBAL', NULL, 'online', 'https://academy.claude.com/'),

  -- Jogos
  (3, 11, 'Game Strategies — Formação com jogos e simuladores', 'Plataforma de formação gamificada para equipas; a participação é orientada a organizações e requer demonstração.', 'curso', 'GLOBAL', NULL, 'online', 'https://gamestrategies.io/en/'),
  (3, 10, 'CodeCombat — Programação através de jogos', 'Plataforma de aprendizagem de programação através de jogos; consultar planos e condições no site.', 'curso', 'GLOBAL', NULL, 'online', 'https://codecombat.com/'),
  (3, 9, '.NET — Learn game development', 'Cursos, tutoriais e vídeos gratuitos para aprendizagem de desenvolvimento de jogos com .NET.', 'curso', 'GLOBAL', NULL, 'online', 'https://dotnet.microsoft.com/en-us/learn/games'),
  (3, 8, 'Unity Learn — Desenvolvimento de jogos e 3D', 'Cursos, projetos e tutoriais para desenvolvimento de jogos e experiências 3D em tempo real.', 'curso', 'GLOBAL', NULL, 'online', 'https://learn.unity.com/'),
  (3, 7, 'Roblox Creator Hub — Criação de experiências', 'Ponto de entrada para criação de experiências na plataforma Roblox; consultar recursos e requisitos no site.', 'curso', 'GLOBAL', NULL, 'online', 'https://create.roblox.com/landing'),

  -- Cibersegurança
  (4, 3, 'Cisco Networking Academy — Introduction to Cybersecurity', 'Curso introdutório de cibersegurança; consultar idioma, disponibilidade e requisitos de inscrição no site.', 'curso', 'GLOBAL', NULL, 'online', 'https://www.netacad.com/courses/introduction-to-cybersecurity?courseLang=en-US'),
  (4, 2, 'TryHackMe — Cyber Security Learning Roadmap', 'Plataforma de aprendizagem prática com percursos e laboratórios de cibersegurança no navegador.', 'curso', 'GLOBAL', NULL, 'online', 'https://tryhackme.com/hacktivities'),
  (4, 1, 'Harvard Online — Cybersecurity Courses', 'Catálogo de cursos de cibersegurança, incluindo opções online; consultar disponibilidade de cada curso.', 'curso', 'GLOBAL', NULL, 'online', 'https://pll.harvard.edu/subject/cybersecurity'),

  -- Carreira & Liderança
  (5, 20, 'Ladies in Tech - Liderança feminina em tecnologia', 'Comunidade brasileira voltada à liderança feminina em tecnologia; consultar atividades e inscrições no site.', 'comunidade', 'BR', NULL, 'online', 'https://ladiesintech.com.br/'),
  (5, 19, 'Portuguese Women in Tech — Comunidade profissional', 'Comunidade e iniciativas de carreira para mulheres no ecossistema tecnológico português.', 'comunidade', 'PT', NULL, 'online', 'https://www.portuguesewomenintech.com/'),
  (5, 18, 'Women in Tech Portugal — Comunidade e oportunidades', 'Comunidade profissional para mulheres em tecnologia; consultar eventos e iniciativas disponíveis.', 'comunidade', 'PT', NULL, 'online', 'https://www.womenintech.pt/'),
  (5, 17, 'Ladies Who Tech — Comunidade global', 'Comunidade internacional para mulheres em tecnologia; consultar programas e eventos atuais no site.', 'comunidade', 'GLOBAL', NULL, 'online', 'https://ladieswho.tech/eng'),
  (5, 16, 'Hire Tech Ladies — Comunidade e carreira', 'Comunidade e recursos de carreira para mulheres em tecnologia; consultar elegibilidade e serviços no site.', 'comunidade', 'GLOBAL', NULL, 'online', 'https://www.hiretechladies.com/'),
  (5, 15, 'WomenTech Global Conference', 'Conferência e rede internacional de mulheres em tecnologia; confirmar edição, datas e formato no site.', 'evento', 'GLOBAL', NULL, 'online', 'https://www.womentech.net/women-tech-conference'),
  (5, 14, 'Global Women Tech Leaders — Comunidade de liderança', 'Rede global de liderança e ligação profissional para mulheres em tecnologia; consultar participação no site.', 'comunidade', 'GLOBAL', NULL, 'online', 'https://www.globalwomentechleaders.com/'),
  (5, 13, 'London Business School — Women in Leadership', 'Formação executiva em liderança; consultar requisitos, preço, calendário e modalidade no site.', 'curso', 'GLOBAL', NULL, 'online', 'https://www.london.edu/executive-education/leadership/women-in-leadership'),
  (5, 12, 'Cisco Live — IT Leadership Program', 'Programa de liderança em TI associado ao Cisco Live; confirmar próxima edição e participação no site.', 'evento', 'GLOBAL', NULL, 'online', 'https://www.ciscolive.com/emea/learn/programs/it-leadership.html');
