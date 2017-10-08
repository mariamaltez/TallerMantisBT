<?php
session_start();
if (!isset($_SESSION["user"]) or empty($_SESSION["user"])) {
    header("Location: login.php");
        die();
}
$project_id = $_GET["project"];
if (!isset($project_id) or empty($project_id))
{
    header("Location: dashboard.php");
    die();
} 
?>
<!DOCTYPE html>
<html>
<head>
        <title>Pizarra 3M</title>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/pizarra.css?v=<?php echo date('His');?>" crossorigin="anonymous">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/controller_pizarra.js?v=<?php echo date('His');?>"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script>window.id_project=<?php echo $project_id; ?></script>
</head>
<body>
<div class="container">
        <div class="row col-md-12">
                <h1 class="text-center title-project"></h1>
                <h4 class="subtitle-project"></h4>
        </div>
        <div class="row col-md-12" style="margin: 20px 0;">
            <button type="button" class="btn btn-success col-md-2 col-md-offset-1 crearTarea" data-toggle="modal" data-target="#myModal2">Crear nueva tarea</button>
            <a class="btn btn-primary col-md-1 col-md-offset-6" href="dashboard.php" role="button"><span class="glyphicon glyphicon-chevron-left"></span>Volver</a>
        </div>
        <div class="row col-md-12">
            <div class="board col-md-10 col-md-offset-1">
            </div>
        </div>
        <div class="row">
            
        </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Editar Tarea</h4>
      </div>
      <div class="modal-body">
            <form>
                <input style="display: none;" type="text" class="form-control" id="idTarea" placeholder="idTarea" name="idTarea">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre">
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripcion</label>
                    <input type="text" class="form-control" id="descripcion" placeholder="Descripción" name="descripcion">
                </div>
                <div class="form-group">
                    <label for="autor ">Asignado a:</label>
                    <select class="form-control autor" id="autor" name="autor">
                        <option >Seleccione..</option>
                    </select>
                </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="updateTarea" >Actualizar Tarea</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
  <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Crear nueva tarea</h4>
        </div>
        <div class="modal-body">
            <form>
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre">
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripcion</label>
                    <input type="text" class="form-control" id="descripcion" placeholder="Descripción" name="descripcion">
                </div>
                <div class="form-group">
                    <label for="autor ">Asignado a:</label>
                    <select class="form-control autor" id="autor" name="autor">
                        <option >Seleccione..</option>
                    </select>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" id="guardarTarea" >Guardar Tarea</button>
        </div>
      </div>
      
    </div>
  </div>

</body>
</html>