<?php

header('Content-Type: application/json');

$name = $_POST['name'];
$description = $_POST['description'];
$file = $_FILES['file'];

// DATA TO DB

include('./database.php');
$sql = $db->prepare("INSERT INTO `$tablename` (`name`, `description`) VALUES (:name, :description)");
$sql->execute([
    'name' => $name,
    'description' => $description
]);
$id = $db->lastInsertId();

if (!$id || $id == 0) {
    http_response_code(500);
    echo json_encode([
        'error' => true,
        'status' => 500,
        'message' => 'Error inserting data',
        'id' => $id
    ]);
    die();
}

// SAVING FILES

$uploaddir = '../files/' . $id;

if (!file_exists($uploaddir)) {
    if (!mkdir($uploaddir, 0777, true)) {
        http_response_code(500);
        echo json_encode([
            'error' => true,
            'status' => 500,
            'message' => 'Failed to create directories',
            'id' => $id
        ]);
        die();
    }
}

$info = new SplFileInfo($file['name']);
$uploadfile = $uploaddir . '/' . generateRandomString() . '.' . $info->getExtension();

if (!move_uploaded_file($file['tmp_name'], $uploadfile)) {
    http_response_code(500);
    echo json_encode([
        'error' => true,
        'status' => 500,
        'message' => 'Failed to save file',
        'id' => $id
    ]);
    die();
}

echo json_encode([
    'error' => false,
    'status' => 200,
    'message' => 'Success',
    'plant' => [
        'id' => $id,
        'name' => $name,
        'description' => $description,
        'file' => $file
    ]
]);

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
