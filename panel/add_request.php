<?php

$name = $_POST['name'];
$description = $_POST['description'];
$file = $_FILES['file'];

$uploaddir = './';
$uploadfile = $uploaddir . basename($file['name']);

move_uploaded_file($file['tmp_name'], $uploadfile);

echo $name . ' : '. $description;