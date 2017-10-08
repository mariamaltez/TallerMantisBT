<?php
session_start();
if (!isset($_SESSION["user"]) or empty($_SESSION["user"])) {
    header("Location: login.php");
	die();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard 3M</title>
	<meta charset="UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<link rel="stylesheet" href="css/dashboard.css?v=<?php echo date('His');?>" crossorigin="anonymous">

	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="js/controller_dashboard.js?v=<?php echo date('His');?>"></script>
</head>
<body>
<div class="container">
	<div class="row row-1">
		<h1 class="text-center">Dashboard 3M</h1>
	</div>
	<div class="row row-2">
		<h4>Acciones</h4>
		<a class="btn btn-default admin_usuarios" href="admin_user.php" role="button">Administrar usuarios</a>
		<a class="btn btn-default admin_usuarios" href="admin_project.php" role="button">Administrar proyectos</a>
		<a class="btn btn-danger admin_usuarios" href="logout.php" role="button">Cerrar Sesión</a>
	</div>
	<div class="row row-3">
		<h4>Seleccionar pizarra</h4>
		<form class="form-inline" action="pizarra.php" method="GET">
			<div class="form-group">
				<label style="float: left;vertical-align: middle;margin-right: 15px;" for="nombres_proyectos control-label">Proyectos</label>
				<select class="form-control nombres_proyectos col-md-4" id="nombres_proyectos" name="project">
				</select>
			</div>
			<button type="submit" class="btn btn-default">Ir a la pizarra</button>
		</form>
		

	</div>
</div>
</body>
</html>