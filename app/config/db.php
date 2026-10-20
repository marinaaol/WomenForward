<?php
declare(strict_types=1);

// Lê as configurações locais do ficheiro .env, sem dependências externas.
$rootPath = dirname(__DIR__, 2);
$envPath = $rootPath . '/.env';
$settings = [];

if (is_readable($envPath)) {
    foreach (file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        $line = trim($line);
        if ($line === '' || str_starts_with($line, '#') || !str_contains($line, '=')) {
            continue;
        }

        [$key, $value] = explode('=', $line, 2);
        $settings[trim($key)] = trim(trim($value), "\\\"'");
    }
}

$setting = static function (string $key, ?string $default = null) use ($settings): string {
    $fromEnvironment = getenv($key);
    if ($fromEnvironment !== false) {
        return $fromEnvironment;
    }

    if (array_key_exists($key, $settings)) {
        return $settings[$key];
    }

    if ($default !== null) {
        return $default;
    }

    throw new RuntimeException("Configuração obrigatória ausente: {$key}. Copie .env.example para .env.");
};

$host = $setting('DB_HOST', '127.0.0.1');
$port = $setting('DB_PORT', '3306');
$database = $setting('DB_NAME');
$user = $setting('DB_USER');
$password = $setting('DB_PASSWORD', '');

$pdo = new PDO(
    "mysql:host={$host};port={$port};dbname={$database};charset=utf8mb4",
    $user,
    $password,
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]
);
