<?php
declare(strict_types=1);

// Configuração única da ligação PDO usada por todas as páginas da aplicação.
$host = 'localhost';
$bd   = 'womenforward';
$user = 'root';
$pass = '';

$pdo = new PDO("mysql:host=$host;dbname=$bd;charset=utf8mb4", $user, $pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
