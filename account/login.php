<?php require_once '../blocks/head.php'; ?>

<?php

  // session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: http://localhost/aapruebas/game_try/');
  }
  require '../connection/connection.php';

  if (!empty($_POST['nickname']) && !empty($_POST['password'])) {
    $records = $connection->prepare('SELECT account_id, account_nickname, account_password FROM account WHERE account_nickname = :nickname');
    $records->bindParam(':nickname', $_POST['nickname']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';
    
    if (is_countable($results) > 0 && password_verify($_POST['password'], $results['account_password'])) {
      $_SESSION['user_id'] = $results['account_id'];
      header("Location: http://localhost/aapruebas/game_try/account/profile");
    } else {
      $message = 'Sorry, those credentials do not match';
    }
  }

?>

<?php if(!empty($message)): ?>
    <p> <?= $message ?></p>
<?php endif; ?>

<form action="login" method="POST">
    <input name="nickname" type="text" placeholder="Enter your Nickname">
    <input name="password" type="password" placeholder="Enter your Password">
    <input type="submit" value="Login">
</form>

<p>Don't have an account? <a href="register">Create One!</a></p>

<?php require_once '../blocks/footer.php'; ?>
