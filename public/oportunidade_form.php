<?php
require_once __DIR__ . '/../includes/inicio.php';
require_once __DIR__ . '/../includes/verificar_csrf.php';

exigir_login();

$id       = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$a_editar = $id && $id > 0;
$id_ent   = entidade_id();

$op = [
    'titulo'       => '',
    'descricao'    => '',
    'tipo'         => 'curso',
    'formato'      => 'online',
    'pais'         => 'GLOBAL',
    'cidade'       => '',
    'url'          => '',
    'data_inicio'  => '',
    'ativo'        => 1,
    'id_categoria' => 1,
];

if ($a_editar) {
    $stmt = $pdo->prepare(
        'SELECT * FROM oportunidades WHERE id_oportunidade = ? AND id_entidade = ?'
    );
    $stmt->execute([$id, $id_ent]);
    $existente = $stmt->fetch();

    if (!$existente) {
        mensagem('erro', 'Oportunidade não encontrada ou não pertence à sua entidade.');
        header('Location: dashboard.php');
        exit;
    }

    $op = array_merge($op, $existente);
}

$erros = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $op['titulo']       = trim($_POST['titulo'] ?? '');
    $op['descricao']    = trim($_POST['descricao'] ?? '');
    $op['tipo']         = $_POST['tipo'] ?? 'curso';
    $op['formato']      = $_POST['formato'] ?? 'online';
    $op['pais']         = $_POST['pais'] ?? 'GLOBAL';
    $op['cidade']       = ($_POST['cidade'] ?? '') !== '' ? $_POST['cidade'] : null;
    $op['data_inicio']  = ($_POST['data_inicio'] ?? '') !== '' ? $_POST['data_inicio'] : null;
    $op['ativo']        = isset($_POST['ativo']) ? 1 : 0;
    $op['id_categoria'] = (int) ($_POST['id_categoria'] ?? 0);

    // URL: lê e normaliza
    $op['url'] = trim($_POST['url'] ?? '');
    if ($op['url'] !== '' && !preg_match('~^https?://~i', $op['url'])) {
        $op['url'] = 'https://' . ltrim($op['url'], '/');
    }

    // Validações
    if ($op['titulo'] === '' || mb_strlen($op['titulo']) > 150) {
        $erros[] = 'O título é obrigatório (até 150 caracteres).';
    }
    if ($op['descricao'] === '') {
        $erros[] = 'A descrição é obrigatória.';
    }
    if (!in_array($op['tipo'], ['curso', 'evento', 'comunidade', 'estágio'], true)) {
        $erros[] = 'Tipo inválido.';
    }
    if (!in_array($op['formato'], ['presencial', 'online', 'híbrido'], true)) {
        $erros[] = 'Formato inválido.';
    }
    if (!in_array($op['pais'], ['PT', 'BR', 'GLOBAL'], true)) {
        $erros[] = 'País inválido.';
    }

    // URL: obrigatório + sintaxe válida + tem de ter http(s):// e domínio
    if ($op['url'] === '') {
        $erros[] = 'Indique o endereço (URL) da oportunidade.';
    } elseif (
        !filter_var($op['url'], FILTER_VALIDATE_URL)
        || !preg_match('~^https?://[^\s]+\.[^\s]+$~i', $op['url'])
    ) {
        $erros[] = 'Introduza um URL válido (ex.: https://www.exemplo.com ou www.exemplo.com).';
    }

    // Consistência país ↔ cidade
    $cidades_validas = [
        'PT' => ['Porto', 'Lisboa'],
        'BR' => ['São Paulo', 'Rio de Janeiro'],
    ];
    if ($op['pais'] === 'GLOBAL' && $op['cidade'] !== null) {
        $erros[] = 'Para oportunidades GLOBAIS, não indique cidade.';
    }
    if (isset($cidades_validas[$op['pais']])) {
        if ($op['cidade'] !== null
            && !in_array($op['cidade'], $cidades_validas[$op['pais']], true)) {
            $erros[] = 'Cidade incompatível com o país selecionado.';
        }
    }

    // URL único (na BD)
    if (!$erros) {
        $sqlU = 'SELECT 1 FROM oportunidades WHERE url = ?';
        $paramsU = [$op['url']];
        if ($a_editar) {
            $sqlU .= ' AND id_oportunidade <> ?';
            $paramsU[] = $id;
        }
        $stmt = $pdo->prepare($sqlU);
        $stmt->execute($paramsU);
        if ($stmt->fetch()) {
            $erros[] = 'Já existe outra oportunidade com esse URL.';
        }
    }

    if (!$erros) {
        if ($a_editar) {
            $stmt = $pdo->prepare(
                'UPDATE oportunidades
                 SET id_categoria = ?, titulo = ?, descricao = ?, tipo = ?,
                     formato = ?, pais = ?, cidade = ?, url = ?, data_inicio = ?, ativo = ?
                 WHERE id_oportunidade = ? AND id_entidade = ?'
            );
            $stmt->execute([
                $op['id_categoria'], $op['titulo'], $op['descricao'], $op['tipo'],
                $op['formato'], $op['pais'], $op['cidade'], $op['url'],
                $op['data_inicio'], $op['ativo'], $id, $id_ent,
            ]);
            mensagem('sucesso', 'Oportunidade atualizada com sucesso.');
        } else {
            $stmt = $pdo->prepare(
                'INSERT INTO oportunidades
                    (id_entidade, id_categoria, titulo, descricao, tipo,
                     formato, pais, cidade, url, data_inicio, ativo)
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'
            );
            $stmt->execute([
                $id_ent, $op['id_categoria'], $op['titulo'], $op['descricao'], $op['tipo'],
                $op['formato'], $op['pais'], $op['cidade'], $op['url'],
                $op['data_inicio'], $op['ativo'],
            ]);
            mensagem('sucesso', 'Oportunidade publicada.');
        }

        header('Location: dashboard.php');
        exit;
    }
}

$categorias = $pdo->query('SELECT id_categoria, nome FROM categorias ORDER BY nome')->fetchAll();

$titulo = $a_editar ? 'Editar oportunidade' : 'Divulgar oportunidade';
require __DIR__ . '/../includes/cabecalho.php';
?>

<h1><?= $a_editar ? 'Editar oportunidade' : 'Divulgar uma oportunidade' ?></h1>

<?php require __DIR__ . '/../includes/erros.php'; ?>

<form method="post"
      action="oportunidade_form.php<?= $a_editar ? '?id=' . (int) $id : '' ?>"
      class="formulario">
    <?php require __DIR__ . '/../includes/csrf.php'; ?>

    <label for="titulo">Título
        <input id="titulo" name="titulo" maxlength="150" required
               value="<?= htmlspecialchars($op['titulo']) ?>">
    </label>

    <label for="descricao">Descrição
        <textarea id="descricao" name="descricao" rows="6" required><?= htmlspecialchars($op['descricao']) ?></textarea>
    </label>

    <label for="id_categoria">Categoria
        <select id="id_categoria" name="id_categoria" required>
            <?php foreach ($categorias as $c): ?>
                <option value="<?= (int) $c['id_categoria'] ?>"
                    <?= (int) $op['id_categoria'] === (int) $c['id_categoria'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($c['nome']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label>

    <label for="tipo">Tipo
        <select id="tipo" name="tipo" required>
            <?php foreach (['curso', 'evento', 'comunidade', 'estágio'] as $t): ?>
                <option value="<?= $t ?>" <?= $op['tipo'] === $t ? 'selected' : '' ?>><?= ucfirst($t) ?></option>
            <?php endforeach; ?>
        </select>
    </label>

    <label for="formato">Formato
        <select id="formato" name="formato" required>
            <?php foreach (['presencial', 'online', 'híbrido'] as $f): ?>
                <option value="<?= $f ?>" <?= $op['formato'] === $f ? 'selected' : '' ?>><?= ucfirst($f) ?></option>
            <?php endforeach; ?>
        </select>
    </label>

    <label for="pais">País
        <select id="pais" name="pais" required>
            <?php foreach (['PT' => 'Portugal', 'BR' => 'Brasil', 'GLOBAL' => 'Global'] as $v => $r): ?>
                <option value="<?= $v ?>" <?= $op['pais'] === $v ? 'selected' : '' ?>><?= $r ?></option>
            <?php endforeach; ?>
        </select>
    </label>

    <label for="cidade">Cidade (opcional)
        <select id="cidade" name="cidade">
            <option value="">Sem cidade</option>
            <?php foreach (['Porto' => 'PT', 'Lisboa' => 'PT', 'São Paulo' => 'BR', 'Rio de Janeiro' => 'BR'] as $c => $p): ?>
                <option value="<?= htmlspecialchars($c) ?>" data-pais="<?= $p ?>"
                    <?= $op['cidade'] === $c ? 'selected' : '' ?>>
                    <?= htmlspecialchars($c) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label>

    <label for="url">URL oficial
        <input id="url" name="url" type="text" required
               placeholder="Ex.: https://exemplo.com/oportunidade"
               value="<?= htmlspecialchars($op['url']) ?>">
    </label>

    <label for="data_inicio">Data de início (opcional)
        <input id="data_inicio" name="data_inicio" type="date"
               value="<?= htmlspecialchars($op['data_inicio'] ?? '') ?>">
    </label>

    <label class="check">
        <input type="checkbox" name="ativo" value="1" <?= $op['ativo'] ? 'checked' : '' ?>>
        Oportunidade ativa (visível na pesquisa)
    </label>

    <button type="submit"><?= $a_editar ? 'Guardar alterações' : 'Publicar oportunidade' ?></button>
    <a href="dashboard.php">Cancelar</a>
</form>

<?php require __DIR__ . '/../includes/rodape.php'; ?>