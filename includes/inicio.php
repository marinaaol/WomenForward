<?php // Lista de erros da validação no servidor (se houver) ?>
<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require __DIR__ . '/../config/db.php';
require __DIR__ . '/auth.php';

//Guarda uma mensagem flash para mostrar na próxima página. Tipo: 'sucesso' | 'erro' | 'info'

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