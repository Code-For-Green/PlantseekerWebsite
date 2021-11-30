<?php

$host = 'localhost';
$dbname = 'cfg';
$user = 'cfg';
$password = 'zaq1@WSX';

$db = new PDO('mysql:host=' . $host . ';dbname=' . $dbname, $user, $password);
//$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);