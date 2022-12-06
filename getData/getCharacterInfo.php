<?php

include_once '../connection/connection.php';

$message = '';

$query_get_char_skills = $connection->prepare(
    'SELECT *
    FROM 
        `character_skills`
    INNER JOIN `character`
        ON `character_skills`.character_skills_id = `character`.character_skills_id
    WHERE `character`.character_id = :char_id;');

$query_get_char_skills->bindParam(':char_id', $_GET['char_id']);
$query_get_char_skills->execute();
$skills_result = $query_get_char_skills->fetchAll(PDO::FETCH_ASSOC);

$query_get_char_items = $connection->prepare(
    'SELECT i.*
    FROM `item` AS i
    LEFT JOIN `character_item` AS ci
        ON i.item_id = ci.item_id
    WHERE ci.character_id = :char_id;'
);

$query_get_char_items->bindParam(':char_id', $_GET['char_id']);
$query_get_char_items->execute();
$items_result = $query_get_char_items->fetchAll(PDO::FETCH_ASSOC);