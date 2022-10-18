<?php
session_start();
$_SESSION['LOGIN']=null;
$_SESSION['idUsuarioSessao']=null;
header("Location: index.php");
exit;
?>
