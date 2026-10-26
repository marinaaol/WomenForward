<?php
declare(strict_types=1);

// Funções de sessão, autenticação e proteção CSRF partilhadas pelas páginas privadas.

// Inicia a sessão com cookies protegidos. Em HTTP local, o atributo Secure fica
// desativado para permitir o desenvolvimento; em HTTPS, é aplicado automaticamente.
function iniciar_sessao_segura(): void
{
    if (session_status() !== PHP_SESSION_NONE) {
        return;
    }

    $usaHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || (int) ($_SERVER['SERVER_PORT'] ?? 0) === 443
        || (getenv('VERCEL') === '1' && ($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '') === 'https');

    ini_set('session.use_strict_mode', '1');
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'secure' => $usaHttps,
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    session_start();
}

// Expira sessões inativas ao fim de 30 minutos.
function aplicar_expiracao_sessao(): void
{
    $duracaoMaxima = 30 * 60;
    $ultimaAtividade = $_SESSION['ultima_atividade'] ?? null;

    if (is_int($ultimaAtividade) && time() - $ultimaAtividade > $duracaoMaxima) {
        $_SESSION = [];
        session_destroy();
        iniciar_sessao_segura();
        session_regenerate_id(true);
    }

    $_SESSION['ultima_atividade'] = time();
}

iniciar_sessao_segura();
aplicar_expiracao_sessao();

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

// Limita tentativas falhadas no navegador atual, sem guardar credenciais na sessão.
function limite_login_atingido(): bool
{
    $limite = 5;
    $janelaEmSegundos = 15 * 60;
    $tentativas = $_SESSION['login_tentativas'] ?? ['quantidade' => 0, 'inicio' => time()];

    if (time() - (int) $tentativas['inicio'] >= $janelaEmSegundos) {
        unset($_SESSION['login_tentativas']);
        return false;
    }

    return (int) $tentativas['quantidade'] >= $limite;
}

function registar_tentativa_login_falhada(): void
{
    $janelaEmSegundos = 15 * 60;
    $tentativas = $_SESSION['login_tentativas'] ?? ['quantidade' => 0, 'inicio' => time()];

    if (time() - (int) $tentativas['inicio'] >= $janelaEmSegundos) {
        $tentativas = ['quantidade' => 0, 'inicio' => time()];
    }

    $tentativas['quantidade'] = (int) $tentativas['quantidade'] + 1;
    $_SESSION['login_tentativas'] = $tentativas;
}

function limpar_tentativas_login(): void
{
    unset($_SESSION['login_tentativas']);
}
