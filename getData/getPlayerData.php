<?php

include_once '../connection/connection.php';

$records = $connection->prepare('SELECT character_id, character_name, character_gender, character_class_id FROM `character` WHERE character_account_id = :id;');
$records->bindParam(':id', $_SESSION['user_id']);
$records->execute();
$results = $records->fetchAll(PDO::FETCH_ASSOC);

if(count($results) > 0){?>
    <table>
        <thead>
            <th>
                <tr>
                    <td>Character Name</td>
                    <td>Character Gender</td>
                    <td>Character Class</td>
                    <td>Actions</td>
                </tr>
            </th>
        </thead>
        <tbody>
        <?php foreach($results as $player_data){ 
            
            if($player_data['character_class_id'] == '1') $player_data['character_class_id'] = "Mage"; 
            if($player_data['character_class_id'] == '2') $player_data['character_class_id'] = "Assassin"; 
            if($player_data['character_class_id'] == '3') $player_data['character_class_id'] = "Tank"; 

            ?>
            <tr>
                <td><?= $player_data['character_name']; ?></td>
                <td><?= $player_data['character_gender']; ?></td>
                <td><?= $player_data['character_class_id']; ?></td>
                <td>
                    <!-- <button onClik="deleteModal()">
                        Delete Character
                    </button> -->
                    <form action="../character/update-character" method="GET">
                        <input type="hidden" name="char_id" value="<?= $player_data['character_id']; ?>">
                        <input type="hidden" name="char_name" value="<?= $player_data['character_name']; ?>">
                        <input type="submit" value="Update Character">
                    </form>
                    <form action="../character/character-info" method="GET">
                        <input type="hidden" name="char_id" value="<?= $player_data['character_id']; ?>">
                        <input type="submit" value="Character Info">
                    </form>
                </td>
            </tr>
            <?php }?>
        </tbody>
    </table>
    <?php }
    if(!$results){
    echo "no player";
    
}

?>
<div class="blur-background display-none"></div>
<div class="modal-container display-none">
    <div class="delete-modal display-none">
        <div class="delete-modal-header">
            <h5>Are you sure you want to delete your Character?</h5>
            <span class="close-modal">&times;</span>
        </div>
        <div class="delete-modal-body">
            <form action="../character/delete" method="GET">
                <input type="hidden" name="id_char" value="<?= $player_data['character_id']; ?>">
                <input type="submit" value="Delete Character">
                <button onClick="">Cancel</button>
            </form>
        </div>
    </div>
</div>