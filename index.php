<?php

session_start();
if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    header('Location: login.php');
	die();
}
<<<<<<< HEAD
header("Location: dashboard.php");
=======
header('Location: dashboard.php');
>>>>>>> 609ccfa458f5b7f7a120bed89c6367d55e87f441
