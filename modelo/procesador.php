<?php
include("db.php");
$controlador = $_GET["controlador"];
$accion = $_GET["accion"];

if (!isset($controlador) or empty($controlador))
{
	echo '{"status":"error","mensaje":"no viene controlador"}';
	die();
} 
if (!isset($accion) or empty($accion))
{
	echo '{"status":"error","mensaje":"no viene accion"}';
	die();
} 

if ($controlador == 'projectController')
{
	$projects = new Project();
	if ($accion == 'getProjects'){
		$tsArray = $projects->getProjects();
		echo '{"status":"ok","mensaje":'.json_encode($tsArray,true).'}';
		die();
	}
	if ($accion == 'getAllProjects'){
		$tsArray = $projects->getAllProjects();
		echo '{"status":"ok","mensaje":'.json_encode($tsArray,true).'}';
		die();
	}
	if ($accion == 'getProject'){
		$idproject = $_GET["idproject"];
		if (!isset($idproject) or empty($idproject))
		{
			echo '{"status":"error","mensaje":"no viene id de projecto"}';
			die();
		} 
		$tsArray = $projects->getProject($idproject);
		echo '{"status":"ok","mensaje":'.json_encode($tsArray,true).'}';
		die();
	}
	if ($accion == 'moveTarea'){
		$idTarea = $_GET["idTarea"];
		$idColumn = $_GET["idColumn"];
		$idproject = $_GET["idproject"];
		if (!isset($idTarea) or empty($idTarea))
		{
			echo '{"status":"error","mensaje":"no viene idTarea"}';
			die();
		} 
		if (!isset($idColumn) or empty($idColumn))
		{
			echo '{"status":"error","mensaje":"no viene idColumn"}';
			die();
		} 
		if (!isset($idproject) or empty($idproject))
		{
			echo '{"status":"error","mensaje":"no viene idproject"}';
			die();
		} 
		$aux = $projects->moveTarea($idTarea, $idColumn, $idproject);
		echo '{"status":"ok","mensaje":'.$aux.'}';
		die();
	}
	if ($accion == 'getAutores') {
		$tsArray = $projects->getAutores();
		echo '{"status":"ok","mensaje":'.json_encode($tsArray,true).'}';
		die();
	}
	if ($accion == 'updateTarea'){
	 	$nombre = $_GET["nombre"];
	 	$descripcion = $_GET["descripcion"];
	 	$autor = $_GET["autor"];
	 	$idproject = $_GET["idproject"];
	 	$idTarea = $_GET["idTarea"];
	 	if (!isset($nombre) or empty($nombre))
		{
			echo '{"status":"error","mensaje":"no viene nombre"}';
			die();
		} 
		if (!isset($descripcion) or empty($descripcion))
		{
			echo '{"status":"error","mensaje":"no viene descripcion"}';
			die();
		} 
		if (!isset($autor) or empty($autor))
		{
			echo '{"status":"error","mensaje":"no viene autor"}';
			die();
		}
		if (!isset($idproject) or empty($idproject))
		{
			echo '{"status":"error","mensaje":"no viene idproject"}';
			die();
		} 
		if (!isset($idTarea) or empty($idTarea))
		{
			echo '{"status":"error","mensaje":"no viene idTarea"}';
			die();
		} 
		$aux = $projects->updateTarea($nombre, $descripcion, $autor, $idTarea, $idproject);
		echo '{"status":"ok","mensaje":'.$aux.'}';
		die();		
	 }
	 if ($accion == "crearTarea")
	 {
	 	$nombre = $_GET["nombre"];
	 	$descripcion = $_GET["descripcion"];
	 	$autor = $_GET["autor"];
	 	$idproject = $_GET["idproject"];
	 	if (!isset($nombre) or empty($nombre))
		{
			echo '{"status":"error","mensaje":"no viene nombre"}';
			die();
		} 
		if (!isset($descripcion) or empty($descripcion))
		{
			echo '{"status":"error","mensaje":"no viene descripcion"}';
			die();
		} 
		if (!isset($autor) or empty($autor))
		{
			echo '{"status":"error","mensaje":"no viene autor"}';
			die();
		}
		if (!isset($idproject) or empty($idproject))
		{
			echo '{"status":"error","mensaje":"no viene idproject"}';
			die();
		} 
		$aux = $projects->crearTarea($nombre, $descripcion, $autor, $idproject);
		echo '{"status":"ok","mensaje":'.$aux.'}';
		die();
	 }
	 if ($accion == "createProject")
	 {
	 	parse_str($_GET['datos'], $searcharray);

	 	$nombre = $searcharray["nombre"];
	 	$descripcion = $searcharray["descripcion"];
	 	$color = $searcharray["color"];
	 	$columnas = $searcharray["columnas"];
	 	$autor = $searcharray["autor"];
	 	$nombresColumnas = array();

	 	if (!isset($nombre) or empty($nombre))
		{
			echo '{"status":"error","mensaje":"no viene nombre"}';
			die();
		} 
		if (!isset($descripcion) or empty($descripcion))
		{
			echo '{"status":"error","mensaje":"no viene descripcion"}';
			die();
		} 
		if (!isset($color) or empty($color))
		{
			echo '{"status":"error","mensaje":"no viene color"}';
			die();
		} 
		if (!isset($columnas) or empty($columnas) or is_int ($columnas))
		{
			echo '{"status":"error","mensaje":"error en columnas"}';
			die();
		} 
		if (!isset($autor) or empty($autor))
		{
			echo '{"status":"error","mensaje":"no viene autor"}';
			die();
		} 
		for ($i = 1; $i <= $columnas; $i++) {
			if (!isset($searcharray["columna-".$i]) or empty($searcharray["columna-".$i])){
				echo '{"status":"error","mensaje":"nombre de la columna Nº'.$i.' vacío"}';
				die();
			}
		    $nombresColumnas["columna-".$i] = $searcharray["columna-".$i];
		}
		$aux = $projects->crearProyecto($nombre, $descripcion, $color, $columnas, $autor, $nombresColumnas);
		echo '{"status":"ok","mensaje":'.$aux.'}';
		die();
	 }
	 if ($accion == "deleteProject")
	 {
	 	$id = $_GET["id"];
	 	if (!isset($id) or empty($id))
		{
			echo '{"status":"error","mensaje":"no viene id"}';
			die();
		} 
		$aux = $projects->deleteProject($id);
		echo '{"status":"ok","mensaje":'.$aux.'}';
		die();
	 }
	 if ($accion == "deleteTarea")
	 {
	 	$id = $_GET["id"];
	 	if (!isset($id) or empty($id))
		{
			echo '{"status":"error","mensaje":"no viene id"}';
			die();
		} 
		$aux = $projects->deleteTarea($id);
		echo '{"status":"ok","mensaje":'.$aux.'}';
		die();

	 }
	 if($accion == "addHoraTarea")
	 {
	 	$horas = $_GET["horas"];
	 	$id = $_GET["id"];
	 	if (!isset($horas) or empty($horas))
		{
			echo '{"status":"error","mensaje":"no viene horas"}';
			die();
		} 
	 	if (!isset($id) or empty($id))
		{
			echo '{"status":"error","mensaje":"no viene id"}';
			die();
		} 
	 	$aux = $projects->addHoraTarea($horas, $id);
		echo '{"status":"ok","mensaje":'.$aux.'}';
		die();
	 }
}
?>










