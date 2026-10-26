<?php
require_once __DIR__ . '/../includes/inicio.php';
 
// Apaga os dados da sessão e destrói-a
$_SESSION = [];
session_destroy();
 
// Nova sessão, só para levar a mensagem até à página seguinte
iniciar_sessao_segura();
mensagem('sucesso', 'Sessão terminada. Até breve.');
header('Location: index.php');
exit; ?>
