<?php
declare(strict_types=1);

// Funções de sessão, autenticação e proteção CSRF partilhadas pelas páginas privadas.
// Normalmente a sessão é iniciada em inicio.php; esta verificação permite incluir este ficheiro isoladamente.

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Indica se existe uma entidade autenticada na sessão atual.
function esta_autenticado(): bool
{
    return isset($_SESSION['id_entidade']);
}

// Devolve o identificador da entidade autenticada, quando existir.
function entidade_id(): ?int
{
    return isset($_SESSION['id_entidade']) ? (int) $_SESSION['id_entidade'] : null;
}

// Devolve o nome da entidade autenticada, quando existir.
function entidade_nome(): ?string
{
    return $_SESSION['entidade_nome'] ?? null;
}

// Redireciona para o login quando uma página requer autenticação.
function exigir_login(): void
{
    if (!esta_autenticado()) {
        $_SESSION['flash_erro'] = 'Tens de iniciar sessão para ver essa página.';
        header('Location: login.php');
        exit;
    }
}

// Cria e valida o token que protege os formulários contra pedidos CSRF.
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
