<?php
require_once '../blocks/head.php';
include_once '../connection/connection.php';

$message = '';

$char_id = $_GET['char_id'];
$char_nick = $_GET['char_name'];

if(!empty($_POST['nickname'])){
    $new_nick = $_POST['nickname'];
    
    $update_query = $connection->prepare('UPDATE `character` SET character_name=:nick WHERE character_id=:id');
    $update_query->bindParam(':nick', $new_nick);
    $update_query->bindParam(':id', $char_id);
    if($update_query->execute()){
         
        var_dump($update_query->execute());
        
    } else {
        $message = 'Was not possible to change your Nickname';
    }

} ?>

<p>Current character name: <span><?= $char_nick; ?></span></p>

<form action="update-character" method="POST">
    <input name="nickname" type="text" placeholder="Enter your new Nickname">
    <input type="submit" value="Update">
</form>

<p>
    Back to your <a href="../account/profile">account</a>
</p>

<?php if(!empty($message)): ?>
    <p> <?= $message ?></p>
<?php endif; ?>


<?php require_once '../blocks/footer.php'; ?>