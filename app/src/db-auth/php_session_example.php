<?php

/* Start the Session */
session_start();

/* Is the client authenticated? */
$auth = FALSE;

/* Check the Session array to see if this client is already authenticated */
if (array_key_exists('auth', $_SESSION))
{
   $auth = TRUE;
}
else
{
   /* Check the request string for user and password */
   $user = '';
   $passwd = '';
   
   if (array_key_exists('user', $_REQUEST))
   {
      $user = $_REQUEST['user'];
   }
   
   if (array_key_exists('passwd', $_REQUEST))
   {
      $passwd = $_REQUEST['passwd'];
   }
   
   /* Example authentication */
   if (($user == 'user') && ($passwd == 'passwd'))
   {
      $auth = TRUE;
      
      /* Save the authorized state in the Session array */
      $_SESSION['auth'] = TRUE;
   }
}

if ($auth)
{
   echo 'Here is your private content.';
}
else
{
   /* Show the login form */
   ?>
   
   Please login:<br>
   <form method="POST">
   <input type="text" name="user">
   <input type="password" name="passwd">
   <input type="submit" value="Log-in">
   </form>
   
   <?php
}