-- Tabela adicional para sessões partilhadas entre funções Vercel.
CREATE TABLE IF NOT EXISTS sessoes (
    id VARCHAR(128) CHARACTER SET ascii COLLATE ascii_bin NOT NULL PRIMARY KEY,
    dados MEDIUMBLOB NOT NULL,
    expira_em DATETIME NOT NULL,
    INDEX idx_sessoes_expira (expira_em)
) ENGINE=InnoDB;
