<?php
require_once __DIR__ . '/../includes/inicio.php';

if (esta_autenticado()) {
    header('Location: dashboard.php');
    exit;
}

$erros = [];
$email = '';

if (!empty($_SESSION['flash_erro'])) {
    $erros[] = $_SESSION['flash_erro'];
    unset($_SESSION['flash_erro']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare(
        'SELECT id_entidade, nome, password_hash FROM entidades WHERE email = ?'
    );
    $stmt->execute([$email]);
    $utilizador = $stmt->fetch();

    if ($utilizador && password_verify($password, $utilizador['password_hash'])) {
        session_regenerate_id(true);
        $_SESSION['id_entidade']   = (int) $utilizador['id_entidade'];
        $_SESSION['entidade_nome'] = $utilizador['nome'];

        mensagem('sucesso', 'Sessão iniciada. Olá, ' . $utilizador['nome'] . '!');
        header('Location: dashboard.php');
        exit;
    }

    $erros[] = 'O email ou a palavra-passe não correspondem. Tente novamente.';
}

$titulo = 'Iniciar sessão';
require __DIR__ . '/../includes/cabecalho.php';
?>

<h1>Bem-vinda à área da sua entidade</h1>
<p>Entre para publicar e acompanhar as oportunidades da sua entidade.</p>

<?php require __DIR__ . '/../includes/erros.php'; ?>

<form method="post" action="login.php" class="form-auth">
    <label>Email
        <input type="email" name="email" required
               value="<?= htmlspecialchars($email) ?>">
    </label>

    <label>Palavra-passe
        <span class="password-field">
            <input type="password" id="password" name="password"
                   placeholder="Introduza a palavra-passe" required>
            <span class="password-toggle" role="button" tabindex="0"
                  aria-label="Mostrar ou esconder a palavra-passe">
                <i id="toggler" class="far fa-eye" aria-hidden="true"></i>
            </span>
        </span>
    </label>

    <button type="submit">Entrar na minha conta</button>
</form>

<p>Ainda não tem conta? <a href="registar.php">Criar conta</a>.</p>

<?php require __DIR__ . '/../includes/rodape.php'; ?>