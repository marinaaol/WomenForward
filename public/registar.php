<?php
require dirname(__DIR__) . '/includes/inicio.php';

$erros = [];
$nome  = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome      = trim($_POST['nome'] ?? '');
    $email     = trim($_POST['email'] ?? '');
    $password  = $_POST['password'] ?? '';
    $password2 = $_POST['password2'] ?? '';

    // 1. Validar no servidor
    if ($nome === '' || mb_strlen($nome) > 120) {
        $erros[] = 'Indique o nome da entidade (até 120 caracteres).';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros[] = 'Introduza um endereço de email válido.';
    }
    if (strlen($password) < 8) {
        $erros[] = 'A palavra-passe deve ter pelo menos 8 caracteres.';
    }
    if ($password !== $password2) {
        $erros[] = 'As palavras-passe não coincidem.';
    }
    if (!isset($_POST['consentimento'])) {
        $erros[] = 'Aceite a política de privacidade para continuar.';
    }

    // 2. O email não pode estar repetido
    if (!$erros) {
        $stmt = $pdo->prepare('SELECT id_entidade FROM entidades WHERE email = ?');
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $erros[] = 'Já existe uma conta associada a esse email.';
        }
    }

    // 3. Guardar: a password nunca é guardada, só o seu hash
    if (!$erros) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare(
            'INSERT INTO entidades (nome, email, password_hash, consentimento_em)
             VALUES (?, ?, ?, NOW())'
        );
        $stmt->execute([$nome, $email, $hash]);

        mensagem('sucesso', 'Conta criada. Já pode iniciar sessão.');
        header('Location: login.php');
        exit;
    }
}

$titulo = 'Registar entidade · Women Forward';
require dirname(__DIR__) . '/includes/cabecalho.php';
?>

<h1>Registe a sua entidade</h1>
<p>Divulgue cursos, eventos, comunidades e estágios em tecnologia. Mantenha as informações atualizadas para que mais pessoas encontrem a sua iniciativa.</p>

<?php if ($erros): ?>
    <ul class="erros">
        <?php foreach ($erros as $e): ?>
            <li><?= htmlspecialchars($e) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form method="post" action="registar.php" class="form-auth">
    <label>Nome da entidade
        <input type="text" name="nome" maxlength="120" required
               value="<?= htmlspecialchars($nome) ?>">
    </label>

    <label>Email
        <input type="email" name="email" required
               value="<?= htmlspecialchars($email) ?>">
    </label>

    <label>Palavra-passe (mínimo de 8 caracteres)
        <input type="password" name="password" minlength="8" required>
    </label>

    <label>Confirme a palavra-passe
        <input type="password" name="password2" minlength="8" required>
    </label>

    <label class="check">
        <input type="checkbox" name="consentimento" value="1" required>
        Aceito a política de privacidade e o tratamento dos meus dados.
    </label>

    <button type="submit">Registar entidade</button>
</form>

<p>Já tem conta? <a href="login.php">Inicie sessão</a>.</p>

<?php require dirname(__DIR__) . '/includes/rodape.php'; ?>
