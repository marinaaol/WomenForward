<?php
// Mantém links antigos funcionais e encaminha a pesquisa para a rota canónica.
$filtrosPermitidos = ['q', 'categoria', 'tipo', 'pais', 'cidade', 'formato'];
$filtros = array_intersect_key($_GET, array_flip($filtrosPermitidos));
$query = http_build_query($filtros);

header(
    'Location: oportunidades.php' . ($query !== '' ? '?' . $query : '') . '#resultados',
    true,
    302
);
exit;
