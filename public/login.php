<?php
require_once __DIR__ . '/../includes/inicio.php';
require_once __DIR__ . '/../includes/verificar_csrf.php';

// Impede que uma entidade já autenticada volte a aceder ao formulário de login.
if (esta_autenticado()) {
    header('Location: dashboard.php');
    exit;
}

// Estado inicial do formulário e mensagens devolvidas pela validação.
$erros = [];
$email = '';

if (!empty($_SESSION['flash_erro'])) {
    $erros[] = $_SESSION['flash_erro'];
    unset($_SESSION['flash_erro']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (limite_login_atingido()) {
        $erros[] = 'Foram feitas demasiadas tentativas. Aguarde 15 minutos e tente novamente.';
    } else {
        // Valida as credenciais e inicia a sessão da entidade.
        $email    = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        $stmt = $pdo->prepare(
            'SELECT id_entidade, nome, password_hash FROM entidades WHERE email = ?'
        );
        $stmt->execute([$email]);
        $utilizador = $stmt->fetch();

        if ($utilizador && password_verify($password, $utilizador['password_hash'])) {
            limpar_tentativas_login();
            session_regenerate_id(true);
            $_SESSION['id_entidade']   = (int) $utilizador['id_entidade'];
            $_SESSION['entidade_nome'] = $utilizador['nome'];

            mensagem('sucesso', 'Sessão iniciada. Olá, ' . $utilizador['nome'] . '!');
            header('Location: dashboard.php');
            exit;
        }

        registar_tentativa_login_falhada();
        $erros[] = 'O email ou a palavra-passe não correspondem. Tente novamente.';
    }
}

$titulo = 'Iniciar sessão';
require __DIR__ . '/../includes/cabecalho.php';
?>

<h1>Bem-vinda à área da sua entidade</h1>
<p>Entre para publicar e acompanhar as oportunidades da sua entidade.</p>

<?php require __DIR__ . '/../includes/erros.php'; ?>

<form method="post" action="login.php" class="form-auth">
    <?php require __DIR__ . '/../includes/csrf.php'; ?>
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
