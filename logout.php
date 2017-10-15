<?php
session_start();
if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    header('Location: login.php');
	die();
}
session_destroy();

<<<<<<< HEAD

header("Location: login.php?codigo=2");

=======

header('Location: login.php?codigo=2');

>>>>>>> 609ccfa458f5b7f7a120bed89c6367d55e87f441
