<?php
require dirname(__DIR__) . '/app/includes/inicio.php';
 
// Apaga os dados da sessão e destrói-a
$_SESSION = [];
session_destroy();
 
// Nova sessão, só para levar a mensagem até à página seguinte
session_start();
mensagem('sucesso', 'Sessão terminada. Até breve.');
header('Location: index.php');
exit; ?>
