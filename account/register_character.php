<?php require_once '../blocks/head.php'; ?>

<?php
include '../connection/connection.php';

$message = '';

if(!empty($_POST['char_name']) && !empty($_POST['char_gender']) && !empty($_POST['char_class'])){
    $char_name = $_POST['char_name'];
    $char_gender = $_POST['char_gender'];
    $char_class = $_POST['char_class'];
    $id_account = (int) $_SESSION['user_id'];
    $power_60 = 60;
    $power_65 = 65;
    $power_70 = 70;
    $power_75 = 75;
    $power_80 = 80;
    $power_85 = 85;
    $power_90 = 90;
    $power_95 = 95;
    $power_100 = 100;
    $power_110 = 110;
    $power_115 = 115;
    $power_120 = 120;

    $sqlSkills = "INSERT INTO 
                 `game_try`.`character_skills` 
                 (`skill_vitality`, `skill_strength`, `skill_speed`, `skill_evasiveness`, `skill_intelligence`, `skill_luck`, `skill_armor`, `skill_magic_defense`, `skill_critical_hit`, `skill_magic_attack`, `skill_physical_attack`) 
                 VALUES (:skill_vit, :skill_str, :skill_spd, :skill_eva, :skill_int, :skill_luk, :skill_arm, :skill_mdf, :skill_crt, :skill_mgc, :skill_phs);";
    $skillStmt = $connection->prepare($sqlSkills);

    if($char_class == 'mage') {
        $skillStmt->bindParam(':skill_vit', $power_80);
        $skillStmt->bindParam(':skill_str', $power_100);
        $skillStmt->bindParam(':skill_spd', $power_80);
        $skillStmt->bindParam(':skill_eva', $power_90);
        $skillStmt->bindParam(':skill_int', $power_115);
        $skillStmt->bindParam(':skill_luk', $power_100);
        $skillStmt->bindParam(':skill_arm', $power_90);
        $skillStmt->bindParam(':skill_mdf', $power_75);
        $skillStmt->bindParam(':skill_crt', $power_100);
        $skillStmt->bindParam(':skill_mgc', $power_120);
        $skillStmt->bindParam(':skill_phs', $power_70);
    }  if ($char_class == 'tank'){
        $skillStmt->bindParam(':skill_vit', $power_110);
        $skillStmt->bindParam(':skill_str', $power_100);
        $skillStmt->bindParam(':skill_spd', $power_80);
        $skillStmt->bindParam(':skill_eva', $power_70);
        $skillStmt->bindParam(':skill_int', $power_85);
        $skillStmt->bindParam(':skill_luk', $power_100);
        $skillStmt->bindParam(':skill_arm', $power_110);
        $skillStmt->bindParam(':skill_mdf', $power_110);
        $skillStmt->bindParam(':skill_crt', $power_80);
        $skillStmt->bindParam(':skill_mgc', $power_65);
        $skillStmt->bindParam(':skill_phs', $power_85);
    }  if ($char_class == 'assassin'){
        $skillStmt->bindParam(':skill_vit', $power_80);
        $skillStmt->bindParam(':skill_str', $power_100);
        $skillStmt->bindParam(':skill_spd', $power_115);
        $skillStmt->bindParam(':skill_eva', $power_110);
        $skillStmt->bindParam(':skill_int', $power_100);
        $skillStmt->bindParam(':skill_luk', $power_100);
        $skillStmt->bindParam(':skill_arm', $power_90);
        $skillStmt->bindParam(':skill_mdf', $power_85);
        $skillStmt->bindParam(':skill_crt', $power_120);
        $skillStmt->bindParam(':skill_mgc', $power_95);
        $skillStmt->bindParam(':skill_phs', $power_95);
    }

    if($skillStmt->execute()){
        $sql_get_last_skills = "SELECT character_skills_id FROM character_skills ORDER BY character_skills_id DESC LIMIT 1;";
        $sql_get_last_skills_stmt = $connection->prepare($sql_get_last_skills);
        $sql_get_last_skills_stmt->execute();
        // var_dump($sql_get_last_skills_stmt->fetchColumn());
        $last_skills_id = $sql_get_last_skills_stmt->fetch();
        
        if($sql_get_last_skills_stmt->execute()){
            $sql = "INSERT INTO 
                `game_try`.`character` (`character_name`, `character_gender`, `character_class`, `character_skills_id`, `character_account_id`) 
                VALUES (:name, :gender, :class, :skillsid, :account);";
            $stmt = $connection->prepare($sql);
    
            $stmt->bindParam(':name', $char_name);
            $stmt->bindParam(':gender', $char_gender);
            $stmt->bindParam(':class', $char_class);
            $stmt->bindParam(':skillsid', $last_skills_id[0]);
            $stmt->bindParam(':account', $id_account);
            
            if($stmt->execute()){
                header("Location: http://localhost/aapruebas/game_try/account/profile");
            } else {
                $message = 'That character name is already in use :(';
            }
        };
    } else {
        $message = 'There has been an error while trying to create your character :(';
    };
}

?>

<form action="register_character" method="POST">
	<h1>Register a Character</h1>

    <input type="text" name="char_name" placeholder="Enter your nickname" required />

    <select name="char_gender">
        <option value="male">Male</option>
        <option value="female">Female</option>
    </select>

    <select name="char_class">
        <option value="mage">Mage</option>
        <option value="tank">Tank</option>
        <option value="assassin">Assassin</option>
    </select>

    <input type="submit" name="register-char-btn" value="create character" />

    <?php if(!empty($message)): ?>
    <p><?= $message; ?></p>
    <?php endif; ?>

	<p>
	    <a href="profile">Cancel</a>
	</p>
</form>

<?php require_once '../blocks/footer.php'; ?>