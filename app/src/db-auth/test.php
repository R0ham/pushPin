<?php
// start the PHP Session
session_start();

// db connection file
require './db_inc.php';
// Account class file which contains all the authentication methods
require './account_class.php';

$account = new Account();

/* Insert a new account */
try{
    $newId = $account->addAccount('test@rpi.edu', '1234567890');
}
catch (Exception $e){
    echo $e->getMessage();
    die();
}

echo 'The new account ID is '. $newId;

?>