<!DOCTYPE html>
<html>
<head>
	<title>Login 3M</title>

	<meta charset="UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<link rel="stylesheet" href="css/login.css?v=<?php echo date('His');?>" crossorigin="anonymous">
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="js/controller.js?v=<?php echo date('His');?>"></script>
</head>
<body>
<div class="container">
	<div class="row">
		<h1 class="text-center" style="margin:100px 0 50px 0;">Bienvenido a 3M</h1>
	</div>
	<div class="row">
		<form class="col-md-4 col-md-offset-4"  action="procesa_login.php" method="post">
			<div class="form-group">
				<label for="user_name">User name</label>
				<input type="text" class="form-control" id="user_name" placeholder="User name" name="user_name">
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" class="form-control" id="password" placeholder="Password" name="password">
			</div>
			<button type="submit" class="btn btn-default">Entrar</button>
		</form>
	</div>
</div>
</body>
</html>