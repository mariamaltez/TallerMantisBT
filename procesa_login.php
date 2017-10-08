<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("modelo/db.php");

$user = $_POST["user_name"];
$password = $_POST["password"];

if (!isset($user) or empty($user) or !isset($password) or empty($password))
{
	header("Location: login.php");
	die();
}

//se sacan los ; para evitar el sql injection
$user = str_replace(';','',$user);
$password = str_replace(';','',$password);

$login = new login();
$aux = $login->logear($user,$password);
if ($aux == 1){
	session_start();
	$_SESSION["user"] = $user;
	header("Location: dashboard.php");
}else{
	header("Location: login.php?codigo=1");
}

?>