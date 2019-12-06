<?php
// start the PHP Session
session_start();

// db connection file
require './db_inc.php';
// Account class file which contains all the authentication methods
require './account_class.php';

$account = new Account();

$account->login('test@rpi.edu', '1234567890');

?>