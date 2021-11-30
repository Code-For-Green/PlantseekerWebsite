<?php

header('Content-Type: application/json');

include('./database.php');
$sql = $db->prepare("SELECT * FROM `plants`");
$sql->execute();
$plants = $sql->fetchAll(PDO::FETCH_ASSOC);

echo json_encode([
    'error' => false,
    'status' => 200,
    'message' => 'Success',
    'plants' => $plants
]);