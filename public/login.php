<?php
require 'includes/inicio.php';
 
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
 
    $erros[] = 'Email ou password errados.';
}
 
$titulo = 'Iniciar sessão';
require 'includes/cabecalho.php';
?>
 
<h1>Iniciar sessão</h1>
 
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
 
    <label>Password
        <input type="password" name="password" required>
    </label>
 
    <button type="submit">Entrar</button>
</form>
 
<p>Ainda não tens conta? <a href="registar.php">Criar conta</a></p>
 
<?php require 'includes/rodape.php'; ?>