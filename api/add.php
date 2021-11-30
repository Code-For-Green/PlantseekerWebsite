<?php

$name = $_POST['name'];
$description = $_POST['description'];
$file = $_FILES['file'];

$id = 1;
$uploaddir = '../files/' . $id;

if (!file_exists($uploaddir)) {
    if (!mkdir($uploaddir, 0777, true)) {
        die('Failed to create directories...');
    }
}

$info = new SplFileInfo($file['name']);
$uploadfile = $uploaddir . '/' . generateRandomString() . '.' . $info->getExtension();

if (!move_uploaded_file($file['tmp_name'], $uploadfile)) {
    die('Failed to save file...');
}

header('Content-Type: application/json');
echo json_encode([
    'name' => $name,
    'description' => $description,
    'file' => $file
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