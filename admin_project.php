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
	<title>Administrador de Proyectos</title>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/admin_project.css?v=<?php echo date('His');?>" crossorigin="anonymous">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/controller_admin_proyect.js?v=<?php echo date('His');?>"></script>
    <script type="text/javascript" src="js/jscolor.js?v=<?php echo date('His');?>"></script>
</head>
<body>
<div class="container">
	<div class="row">
		<h1 class="text-center">Administrador de Proyectos</h1>
	</div>
	<hr>
	<div class="row col-md-12" style="margin: 20px 0;">
        <button type="button" class="btn btn-success col-md-2 col-md-offset-1 crearProyecto" data-toggle="modal" data-target="#myModal">Crear nuevo proyecto</button>
        <a class="btn btn-primary col-md-1 col-md-offset-6" href="dashboard.php" role="button"><span class="glyphicon glyphicon-chevron-left"></span>Volver</a>
    </div>
	<div class="row">
		<table class="table table-striped tabla_proyectos">
			<thead>
				<tr>
					<th style="display: none;">id</th>
					<th>Acciones</th>
					<th>Nombre</th>
					<th>Descripción</th>
					<th>Nº Columnas</th>
					<th>Color</th>
					<th>Propietario</th>
				</tr>
			</thead>
			<tbody>
				
			</tbody>
		</table>
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Crear nuevo proyecto</h4>
      </div>
      <div class="modal-body">
            <form class="form-new">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre">
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripcion</label>
                    <input type="text" class="form-control" id="descripcion" placeholder="Descripción" name="descripcion">
                </div>
                <div class="form-group">
                    <label for="descripcion">Color</label>
                    <input class="jscolor form-control" id="color" name="color" value="ffffff" placeholder="FFFFFF">
                </div>
                <div class="form-group" id="ncol">
                    <label for="columnas">Cantidad Columnas</label>
                    <input type="text" class="form-control" id="columnas" placeholder="Nº Columnas" name="columnas">
                </div>
                <div class="form-group">
                    <label for="autor ">Propietario</label>
                    <select class="form-control autor" id="autor" name="autor">
                        <option >Seleccione..</option>
                    </select>
                </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="createProject">Crear Proyecto</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>