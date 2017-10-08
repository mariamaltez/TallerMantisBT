<?php

session_start();
if (!isset($_SESSION["user"]) or empty($_SESSION["user"])) {
    header("Location: login.php");
	die();
}
header("Location: dashboard.php");

?>