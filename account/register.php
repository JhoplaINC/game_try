<?php require_once '../blocks/head.php'; ?>

<?php
include '../connection/connection.php';

$message = '';

if(!empty($_POST['nickname']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm-password'])){
    $nickname = $_POST['nickname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $con_password = $_POST['confirm-password'];

    if($password != $con_password){
        $message = 'Your passwords does not match';
    } else {
        $sql = 'INSERT INTO account (account_nickname, account_email, account_password) VALUES (:nickname, :email, :password)';
        $stmt = $connection->prepare($sql);
    
        $pass_hash = password_hash($password, PASSWORD_BCRYPT);
    
        $stmt->bindParam(':nickname', $nickname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $pass_hash);
        
        if($stmt->execute()){
            header("Location: http://localhost/aapruebas/game_try/account/succesfullyCreatedAccount");
        } else {
            $message = 'That email is already in use, please, enter a different email';
        }
    }
}

?>

<form action="register" method="POST">
	
	<h1>create a new account</h1>

		<input type="text" name="nickname" placeholder="Enter your nickname" required />

		<input type="email" name="email" placeholder="Enter your email" required />

		<input type="password" name="password" placeholder="Enter your password" required />

		<input type="password" name="confirm-password" placeholder="Confirm your password"  />
	
		<input type="submit" name="register-btn" value="create account" />

		<?php if(!empty($message)): ?>
			<p><?= $message; ?></p>
		<?php endif; ?>

	<p>
		Already have an account? <a href="login">Login here</a>
	</p>
</form>

<?php require_once '../blocks/footer.php'; ?>