<?php

include_once '../connection/connection.php';

$message = '';

$records = $connection->prepare('DELETE FROM `character` WHERE character_id = :char_id;');
$records->bindParam(':char_id', $_GET['id_char']);
if($records->execute()){
    header("Location: http://localhost/aapruebas/game_try/landing/succesfullyDeletedCharacter");
} else {
    $message = 'Your character was not deleted :(';
};
