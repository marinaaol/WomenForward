<?php
declare(strict_types=1);

// NÃO inicia sessão — assume que o inicio.php já o fez.
// Se for incluído diretamente (sem inicio.php), inicia na mesma.

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Está autenticado?
function esta_autenticado(): bool
{
    return isset($_SESSION['id_entidade']);
}

// ID da entidade autenticada (ou null)
function entidade_id(): ?int
{
    return isset($_SESSION['id_entidade']) ? (int) $_SESSION['id_entidade'] : null;
}

// Nome da entidade autenticada (ou null)
function entidade_nome(): ?string
{
    return $_SESSION['entidade_nome'] ?? null;
}

// Bloqueia o acesso se não houver sessão iniciada
function exigir_login(): void
{
    if (!esta_autenticado()) {
        $_SESSION['flash_erro'] = 'Tens de iniciar sessão para ver essa página.';
        header('Location: login.php');
        exit;
    }
}

function token_csrf(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

function validar_token_csrf(?string $token): bool
{
    return is_string($token)
        && isset($_SESSION['csrf_token'])
        && hash_equals($_SESSION['csrf_token'], $token);
}
