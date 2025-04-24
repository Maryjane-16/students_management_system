<?php

session_start();

require_once "includes/isloggedin.php";

//unset all of the session variables
$_SESSION = [];

//Destroy the session
session_destroy();


header('Location: http://localhost:200/index.php');
exit();