<?php

header('Content-Type: application/json');

include('./database.php');
$sql = $db->prepare("SELECT * FROM `$tablename`");
$sql->execute();
$plants = $sql->fetchAll(PDO::FETCH_ASSOC);

echo json_encode([
    'error' => false,
    'status' => 200,
    'message' => 'Success',
    'plants' => $plants
]);

/* Struktura:
[
    {
        "name": "",
        "description": "",
        "file": "http://...", <-- image
    },
    ...
]
*/