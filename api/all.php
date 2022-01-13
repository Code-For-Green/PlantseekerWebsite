<?php

header('Content-Type: application/json');

include('./database.php');
$sql = $db->prepare("SELECT * FROM `$tablename`");
$sql->execute();
$plants = [];

foreach ($sql->fetchAll(PDO::FETCH_ASSOC) as $plant) {
    $uploaddir = '../files/' . $plant['id'];

    if (file_exists($uploaddir) && is_dir($uploaddir)) {
        $plant['files'] = $files = array_map(fn($value) => $uploaddir . '/' . $value, array_values(array_diff(scandir($uploaddir), array('.', '..'))));
    }

    $plants[] = $plant;
}

echo json_encode([
    'error' => false,
    'status' => 200,
    'message' => 'Success',
    'plants' => $plants
]);

/* Struktura:
{
    "error": false,
    "status": 200,
    "message": "Success",
    "plants": [
        {
            "id": 3,
            "name": "",
            "description": "",
            "files": [
                ""
            ]
        }
    ]
}
*/
