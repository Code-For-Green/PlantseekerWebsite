<?php

$name = $_POST['name'];
$description = $_POST['description'];
$file = $_FILES['file'];

$uploaddir = './';
$uploadfile = $uploaddir . basename($file['name']);

if (move_uploaded_file($file['tmp_name'], $uploadfile)) {
    // success
}

header('Content-Type: application/json');
echo json_encode([
    'name' => $name,
    'description' => $description,
    'file' => $file
]);