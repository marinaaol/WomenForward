# Women Forward — exportação da base de dados

Exportação gerada em 20/10/2026 a partir da instância local MySQL 8.4.13.

## Ficheiros

- `womenforward_schema.sql` — estrutura da base de dados, sem registos.
- `categorias.csv` — categorias e respetivos identificadores.
- `entidades.csv` — entidades de demonstração; a coluna `password_hash` foi omitida.
- `oportunidades.csv` — oportunidades de demonstração, incluindo as chaves estrangeiras.

## Modelo e conteúdo

- `entidades` 1:N `oportunidades`: cada oportunidade pertence a uma entidade; uma entidade pode publicar várias oportunidades.
- `categorias` 1:N `oportunidades`: cada oportunidade pertence a uma categoria; uma categoria pode classificar várias oportunidades.
- Registos exportados: 5 categorias, 30 entidades e 30 oportunidades.

Os ficheiros CSV representam valores nulos como células vazias. Os endereços de email são dados de demonstração. A exportação não contém hashes de palavras-passe.
