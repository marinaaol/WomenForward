<?php
require_once __DIR__ . '/../includes/inicio.php';

if (esta_autenticado()) {
    header('Location: dashboard.php');
    exit;
}

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

$titulo = 'Criar conta de entidade · Women Forward';
require __DIR__ . '/../includes/cabecalho.php';
?>



<?php require __DIR__ . '/../includes/erros.php'; ?>

<form method="post" action="registar.php" class="form-auth">
    <div class="card">
        <div class="card-image">
            <h2 class="card-heading">
                Divulgue as Oportunidades da Sua Entidade
            </h2>
        </div>
        <p>Crie a sua conta para partilhar cursos, eventos, comunidades e estágios com quem procura crescer em tecnologia.</p>

        <form class="card-form">
            <div class="input">
                <label class="input-label"> Nome da entidade </label>
                <input type="text" name="nome" maxlength="120" required
               value="<?= htmlspecialchars($nome) ?>">
            </div>
            <div class="input">
                <label class="input-label">Email</label>
                <input type="email" name="email" required
               value="<?= htmlspecialchars($email) ?>">
            </div>
            <div class="input">
                <label class="input-label">Palavra-passe (mínimo de 8 caracteres)</label>
                <input type="password" name="password" minlength="8" required>
            </div>
            <div class="input">
                <label class="input-label">Confirme a palavra-passe</label>
                <input type="password" name="password2" minlength="8" required>
            </div>
            
                <label class="check check-consentimento">
                    <input type="checkbox" name="consentimento" value="1" required>
                    <span>Aceito a <a href="privacidade.php">política de privacidade</a> e o tratamento dos meus dados.</span>
                </label>
            
             <div class="action">
                <button class="action-button"> Criar conta da minha entidade</button>
            </div>
        </form>
    </div>



<p>Já tem conta? <a href="login.php">Entre na sua conta</a>.</p>

<?php require __DIR__ . '/../includes/rodape.php'; ?>
