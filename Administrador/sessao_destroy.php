<?php
// Destrua todas as variáveis de sessão
$_SESSION = array();

// Finalmente, destrua a sessão
session_destroy();

// Redirecione o usuário para a página de login ou qualquer outra página após o logout
header("Location: ../login.php");
exit();
?>
