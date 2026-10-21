<?php
// Ligação à base de dados.
$host = 'localhost';
$bd   = 'womenforward';
$user = 'root';
$pass = '';          
 
$pdo = new PDO("mysql:host=$host;dbname=$bd;charset=utf8mb4", $user, $pass);
 
// Se uma consulta falhar, o PDO lança uma exceção (em vez de falhar em silêncio)
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);