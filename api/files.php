<?php

header('Content-Type: application/json');

$id = @$_GET['id'];

if (!$id) {
    http_response_code(500);
    echo json_encode([
        'error' => true,
        'status' => 500,
        'id' => $id,
        'message' => 'id is null',
    ]);
    die();
}

$uploaddir = '../files/' . $id;

if (!file_exists($uploaddir)) {
    http_response_code(404);
    echo json_encode([
        'error' => true,
        'status' => 404,
        'id' => $id,
        'message' => "Can't find directory",
        'dir' => $uploaddir
    ]);
    die();
}

if (!is_dir($uploaddir)) {
    http_response_code(500);
    echo json_encode([
        'error' => true,
        'status' => 500,
        'id' => $id,
        'message' => "Path is not directory",
        'dir' => $uploaddir
    ]);
    die();
}

$files = array_map(fn($value) => $uploaddir . '/' . $value, array_values(array_diff(scandir($uploaddir), array('.', '..'))));

echo json_encode([
    'error' => false,
    'status' => 200,
    'id' => $id,
    'message' => 'Success',
    'files' => $files
]);