<?php require_once '../blocks/head.php'; 

include_once '../getData/getCharacterInfo.php';

if(count($skills_result) > 0){ ?>

    <h1 class="page-title">Character Info</h1>

    <table class="character-table">
        <thead>
            <tr>
                <td>Name</td>
                <td>Gender</td>
                <td>Class</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach($skills_result as $player_data){ 
                
                if($player_data['character_class_id'] == '1') $player_data['character_class_id'] = "Mage"; 
                if($player_data['character_class_id'] == '2') $player_data['character_class_id'] = "Assassin"; 
                if($player_data['character_class_id'] == '3') $player_data['character_class_id'] = "Tank"; 

                ?>
                <tr>
                    <td><?= $player_data['character_name'] ?></td>
                    <td><?= $player_data['character_gender'] ?></td>
                    <td><?= $player_data['character_class_id'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    
    <table class="skills-table">
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
            <?php if(count($items_result) > 0){ ?>
            <?php foreach($skills_result as $player_data){ ?>
<tr>
                <td><?= $player_data['skill_vitality'] + $items_result[0]['item_attr_vit'] ?></td>
                <td><?= $player_data['skill_strength'] + $items_result[0]['item_attr_str'] ?></td>
                <td><?= $player_data['skill_speed'] + $items_result[0]['item_attr_spd'] ?></td>
                <td><?= $player_data['skill_evasiveness'] + $items_result[0]['item_attr_eva'] ?></td>
                <td><?= $player_data['skill_intelligence'] + $items_result[0]['item_attr_int'] ?></td>
                <td><?= $player_data['skill_luck'] + $items_result[0]['item_attr_luk'] ?></td>
                <td><?= $player_data['skill_armor'] + $items_result[0]['item_attr_arm'] ?></td>
                <td><?= $player_data['skill_magic_defense'] + $items_result[0]['item_attr_mdf'] ?></td>
                <td><?= $player_data['skill_critical_hit'] + $items_result[0]['item_attr_crt'] ?></td>
                <td><?= $player_data['skill_physical_attack'] + $items_result[0]['item_mgc_atk'] ?></td>
                <td><?= $player_data['skill_magic_attack'] + $items_result[0]['item_phy_atk'] ?></td>
            </tr>
        <?php }} else { ?>
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
    
    if(count($items_result) > 0){ ?>

<div class="items-container">
    <?php foreach ($items_result as $item_data) { ?>
        
        <div class="item-data">
            <?php echo
            '<div class="item-name">
                '.$item_data['item_name'].'
            </div>';
            ?>
        <?php foreach ($item_data as $item_skill => $val) {
            if($val > 0 ){ 
                if($item_skill != 'item_id'){ 
                if($item_skill == 'item_attr_vit') $item_skill = 'Vitality';
                if($item_skill == 'item_attr_str') $item_skill = 'Stength';
                if($item_skill == 'item_attr_spd') $item_skill = 'Speed';
                if($item_skill == 'item_attr_eva') $item_skill = 'Evasiveness';
                if($item_skill == 'item_attr_int') $item_skill = 'Intelligence';
                if($item_skill == 'item_attr_luk') $item_skill = 'Luck';
                if($item_skill == 'item_attr_arm') $item_skill = 'Armor';
                if($item_skill == 'item_attr_mdf') $item_skill = 'Magic Defense';
                if($item_skill == 'item_attr_crt') $item_skill = 'Critical Hit';
                if($item_skill == 'item_mgc_atk') $item_skill = 'Magic Attack';
                if($item_skill == 'item_phy_atk') $item_skill = 'Physical Attack'; 
                if($item_skill == 'item_body_head') $item_skill = 'Head'; 
                if($item_skill == 'item_body_neck') $item_skill = 'Neck'; 
                if($item_skill == 'item_body_eyes') $item_skill = 'Eyes'; 
                if($item_skill == 'item_body_face') $item_skill = 'Face'; 
                if($item_skill == 'item_body_chest') $item_skill = 'Chest'; 
                if($item_skill == 'item_body_legs') $item_skill = 'Legs'; 
                if($item_skill == 'item_body_feet') $item_skill = 'Feet'; 
                if($item_skill == 'item_body_back') $item_skill = 'Back'; 
                if($item_skill == 'item_body_left_hand') $item_skill = 'Left Hand'; 
                if($item_skill == 'item_body_right_hand') $item_skill = 'Right Hand'; 
                if($item_skill == 'item_body_both_hands') $item_skill = 'Two Handed'; 
                
            echo 
            '
            <div class="item-attr">        
                '.$item_skill.'
            </div>
            <div class="item-stat">
                '.$val.'
                </div>';
                ?>
<?php       }
        }
    }?>
</div>
<?php } ?>
</div>

<?php } ?>

    <p>
        Back to your <a href="../account/profile">account</a>
    </p>

<?php 

} else {
    $message = 'There was a problem while trying to get you Character info TT';
};

?>

<?php if(!empty($message)): ?>
    <p> <?= $message ?></p>
<?php endif; ?>


<?php require_once '../blocks/footer.php'; ?>