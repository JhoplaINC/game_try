<?php require_once '../blocks/head.php'; ?>

<?php

  require '../connection/connection.php';
  
  if (isset($_SESSION['user_id'])) {
    $records = $connection->prepare('SELECT account_id, account_nickname, account_password FROM account WHERE account_id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }
?>

<?php if(!empty($user)): ?>
  <?php include '../getData/getPlayerData.php'; ?>
    <br> Welcome. <?= $user['account_nickname']; ?>
    <a href="logout">
        Logout
    </a>
    <a href="register_character">Regiter Character</a>
<?php else: 
    header("Location: http://localhost/aapruebas/game_try/account/login");
endif; ?>

<?php require_once '../blocks/footer.php'; ?>