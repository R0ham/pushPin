<?php

$host = 'localhost';
$user = 'pushpin';
$dbpass = 'pushpin';
$schema = 'pushpin';

$pdo = NULL;

$dsn = 'mysql:host=' . $host . ';dbname=' . $schema;

// connection inside a try/catch block
try{
    $pdo = new PDO($dsn, $user, $dbpass);

    // enable exceptions on errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e){
    echo "DB connection failed";
    die();
}
?>