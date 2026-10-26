<?php
require_once __DIR__ . '/../includes/inicio.php';
require_once __DIR__ . '/../includes/verificar_csrf.php';

exigir_login();

// Carrega a conta autenticada e as oportunidades relacionadas antes de mostrar a confirmação.
$id = entidade_id();

// Carrega os dados da entidade
$stmt = $pdo->prepare(
    'SELECT nome, email, password_hash FROM entidades WHERE id_entidade = ?'
);
$stmt->execute([$id]);
$ent = $stmt->fetch();

if (!$ent) {
    mensagem('erro', 'Conta não encontrada.');
    header('Location: logout.php');
    exit;
}

// Conta as oportunidades que serão apagadas
$stmt = $pdo->prepare(
    'SELECT COUNT(*) FROM oportunidades WHERE id_entidade = ?'
);
$stmt->execute([$id]);
$total_oportunidades = (int) $stmt->fetchColumn();

$erros = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password  = $_POST['password'] ?? '';
    $confirmar = isset($_POST['confirmar']);

    if (!$confirmar) {
        $erros[] = 'Tem de marcar a caixa de confirmação.';
    }
    if (!password_verify($password, $ent['password_hash'])) {
        $erros[] = 'A palavra-passe está incorreta.';
    }

    if (!$erros) {
        $pdo->beginTransaction();

        try {
            // 1. Apagar as oportunidades primeiro (ON DELETE RESTRICT obriga)
            $stmt = $pdo->prepare(
                'DELETE FROM oportunidades WHERE id_entidade = ?'
            );
            $stmt->execute([$id]);

            // 2. Apagar a entidade
            $stmt = $pdo->prepare(
                'DELETE FROM entidades WHERE id_entidade = ?'
            );
            $stmt->execute([$id]);

            $pdo->commit();
        } catch (Throwable $e) {
            $pdo->rollBack();
            $erros[] = 'Não foi possível eliminar a conta. Tente novamente.';
        }

        if (!$erros) {
            // Termina a sessão
            $_SESSION = [];
            session_destroy();
            session_start();
            mensagem('sucesso', 'Conta e oportunidades eliminadas. Até breve.');
            header('Location: index.php');
            exit;
        }
    }
}

$titulo = 'Eliminar conta';
require __DIR__ . '/../includes/cabecalho.php';
?>

<h1>Eliminar a minha conta</h1>

<p><strong>Esta ação é permanente e não pode ser desfeita.</strong></p>

<p>Serão eliminados:</p>
<ul>
    <li>A conta da entidade <strong><?= htmlspecialchars($ent['nome']) ?></strong> (<?= htmlspecialchars($ent['email']) ?>);</li>
    <li><strong><?= $total_oportunidades ?></strong> oportunidade(s) publicada(s) por esta entidade.</li>
</ul>

<?php require __DIR__ . '/../includes/erros.php'; ?>

<form method="post" action="entidade_apagar.php" class="form-auth">
    <?php require __DIR__ . '/../includes/csrf.php'; ?>

    <label>Palavra-passe atual (para confirmar)
        <input type="password" name="password" required>
    </label>

    <label class="check">
        <input type="checkbox" name="confirmar" value="1" required>
        Confirmo que quero eliminar definitivamente a minha conta e todas as oportunidades associadas.
    </label>

    <button type="submit" class="btn perigo">Eliminar a minha conta</button>
    <a class="btn secundario" href="dashboard.php">Cancelar</a>
</form>

<?php require __DIR__ . '/../includes/rodape.php'; ?>
