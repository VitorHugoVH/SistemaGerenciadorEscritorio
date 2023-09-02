<?php
// Destrua todas as variáveis de sessão
$_SESSION = array();

// Finalmente, destrua a sessão
session_destroy();

header("Location: ../login.php");
exit();
?>
