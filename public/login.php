<?php
require dirname(__DIR__) . '/app/includes/inicio.php';
 
$erros = [];
$email = '';
 
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
 
$titulo = 'Iniciar sessão · Women Forward';
require dirname(__DIR__) . '/app/includes/cabecalho.php';
?>
 
<h1>Aceda à área da sua entidade</h1>
<p>Entre para gerir as oportunidades divulgadas pela sua entidade.</p>
 
<?php if ($erros): ?>
    <ul class="erros">
        <?php foreach ($erros as $e): ?>
            <li><?= htmlspecialchars($e) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
 
<form method="post" action="login.php" class="form-auth">
    <label>Email
        <input type="email" name="email" required
               value="<?= htmlspecialchars($email) ?>">
    </label>
 
    <label>Palavra-passe
        <input type="password" name="password" required>
    </label>
 
    <button type="submit">Iniciar sessão</button>
</form>
 
<p>Ainda não tem conta de entidade? <a href="registar.php">Registe-se aqui</a>.</p>
 
<?php require dirname(__DIR__) . '/app/includes/rodape.php'; ?>
