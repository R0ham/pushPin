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

/* ====================================================
    Edit an account
=======================================================*/

/*
$accountId = 1;

try{
    $account->editAccount($accountID, 'myNewName', 'newPasswd', TRUE);
}
catch (Exception $e){
	echo $e->getMessage();
	die();
}

echo 'Account edit successful.';
*/

/* Edit an account */
/*
$accountId = 1;

try{
	$account->deleteAccount($accountId);
}
catch (Exception $e){
	echo $e->getMessage();
	die();
}

echo 'Account delete successful.';
*/

/* ====================================================
   Login with username and password. 
=======================================================*/
/*
$login = FALSE;

try{
	$login = $account->login('myUserName', 'myPassword');
}
catch (Exception $e){
	echo $e->getMessage();
	die();
}

if ($login){
	echo 'Authentication successful.';
	echo 'Account ID: ' . $account->getId() . '<br>';
	echo 'Account name: ' . $account->getName() . '<br>';
}
else{
	echo 'Authentication failed.';
}
*/


/* ====================================================
    session login
=======================================================*/

/*
$login = FALSE;

try{
	$login = $account->sessionLogin();
}
catch (Exception $e){
	echo $e->getMessage();
	die();
}

if ($login){
	echo 'Authentication successful.';
	echo 'Account ID: ' . $account->getId() . '<br>';
	echo 'Account name: ' . $account->getName() . '<br>';
}
else{
	echo 'Authentication failed.';
}
*/

?>