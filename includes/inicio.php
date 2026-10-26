<?php
// Inicialização comum: sessão protegida, ligação à base de dados e autenticação.
require __DIR__ . '/../config/db.php';
if (getenv('VERCEL') === '1') {
    require __DIR__ . '/sessao_mysql.php';
    session_set_save_handler(new SessaoMySQL($pdo), true);
}
require __DIR__ . '/auth.php';

// Guarda uma mensagem temporária para mostrar na página seguinte.

function mensagem(string $tipo, string $texto): void
{
    $_SESSION['msg'] = ['tipo' => $tipo, 'texto' => $texto];
}

function ler_mensagem(): ?array
{
    if (empty($_SESSION['msg'])) {
        return null;
    }
    $msg = $_SESSION['msg'];
    unset($_SESSION['msg']);
    return $msg;
}
