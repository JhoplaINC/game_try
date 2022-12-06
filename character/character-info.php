<?php require_once '../blocks/head.php'; 

include_once '../getData/getCharacterInfo.php';

if(count($skills_result) > 0){ ?>
    <table>
        <thead>
            <tr>
                <td>Character Name</td>
                <td>Character Gender</td>
                <td>Character Class</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach($skills_result as $player_data){ ?>
            <tr>
                <td><?= $player_data['character_name'] ?></td>
                <td><?= $player_data['character_gender'] ?></td>
                <td><?= $player_data['character_class'] ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <td>Skill Vitality</td>
                <td>Skill Strength</td>
                <td>Skill Speed</td>
                <td>Skill Evasiveness</td>
                <td>Skill Intelligence</td>
                <td>Skill Luck</td>
                <td>Skill Armor</td>
                <td>Skill Magic defense</td>
                <td>Skill Critical hit</td>
                <td>Skill Physical attack</td>
                <td>Skill Magic attack</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach($skills_result as $player_data){ ?>
            <tr>
                <td><?= $player_data['skill_vitality'] ?></td>
                <td><?= $player_data['skill_strength'] ?></td>
                <td><?= $player_data['skill_speed'] ?></td>
                <td><?= $player_data['skill_evasiveness'] ?></td>
                <td><?= $player_data['skill_intelligence'] ?></td>
                <td><?= $player_data['skill_luck'] ?></td>
                <td><?= $player_data['skill_armor'] ?></td>
                <td><?= $player_data['skill_magic_defense'] ?></td>
                <td><?= $player_data['skill_critical_hit'] ?></td>
                <td><?= $player_data['skill_physical_attack'] ?></td>
                <td><?= $player_data['skill_magic_attack'] ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    
    <?php
    
    if(count($items_result) > 0){ 
        
        foreach ($items_result as $item_data) {
            foreach ($item_data as $item_skill => $val) {
                
                if($val > 0){
                    echo $item_skill . ' ' . $val . '<br />';
                }
            }
        }


       /* <div class="items-container">
            <?php foreach ($items_result as $item_data) { ?>
                <div class="item-data">
                    <div class="item-head">
                        <?= $item_data['item_name'] ?>
                    </div>
                    <div class="item-body">
                        <?= $item_data['item_id'] ?>
                    </div>
                    <div class="item-footer">
    
                    </div>
                </div>
            <?php } ?>
        </div>*/
     } ?>

    <p>
        Back to your <a href="../account/profile">account</a>
    </p>

<?php } else {
    $message = 'There was a problem while trying to get you Character info TT';
};

?>

<?php if(!empty($message)): ?>
    <p> <?= $message ?></p>
<?php endif; ?>


<?php require_once '../blocks/footer.php'; ?>