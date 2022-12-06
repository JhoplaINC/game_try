<?php require_once '../blocks/head.php'; ?>

<?php

session_start();

session_unset();

session_destroy();

header('Location: http://localhost/aapruebas/game_try/account/login');

?>

<?php require_once '../blocks/footer.php'; ?>