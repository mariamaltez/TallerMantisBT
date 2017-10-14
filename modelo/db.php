<?php
error_reporting(E_ALL); 
ini_set('display_errors', '1');
/**
* Clase para la conexión y gestión de la base de datos
*/
class database
{
	private $conexion;
	/**
	* funcion conectar, conecta a la base de datos
	*/
	public function conectar()
	{
		if(!isset($this->conexion))
		{
			$username = "";
			$pwd = "";
			$hostname = "localhost";
			$base = "3m";
			$this->conexion = (mysqli_connect($hostname, $username, $pwd, $base)) || die(mysqli_error());
			mysqli_set_charset($this->conexion,'utf8');
		}
	}

	/**
	* funcion desconectar, desconecta la base de datos
	*/
	public function desconectar()
	{
		mysqli_close($this->conexion);
	}

	/**
	*
	*/ 
	public function ejecuta_query($query)
	{
		$resultado = mysqli_query($this->conexion, $query);
		if(!$resultado)
		{
			echo 'Error en query de MySQL: ' . mysqli_error();
			exit;
		} 
		return $resultado;
	}
}

/**
* Clase para administrar el login
*/
class login extends database
{
	public function logear($user = null, $pwd = null)
	{
		$md5_pwd = md5($pwd);
		$this->conectar();
		$query = $this->ejecuta_query("SELECT 1 AS respuesta FROM user WHERE username='$user' and pwd='$md5_pwd'");
		$this->desconectar();
		$respuesta = 0;
		if (mysqli_num_rows($query) > 0)
		{
			while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
			{
				$respuesta = $row["respuesta"];
			}
			mysqli_free_result($query);
		} 
		return $respuesta;
	}
}

/**
* Clase para administrar los proyectos
*/
class Project extends database
{
	public function getProjects()
	{
		$this->conectar();
		$query = $this->ejecuta_query("SELECT id,nombre FROM project");
		$this->desconectar();
		if (mysqli_num_rows($query) > 0)
		{
			$arr = [];
			while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
			{
				$arr[] = $row;
			}
			mysqli_free_result($query);
			return $arr;
		} else {
			return null;
		}
	}
	public function getAllProjects()
	{
		$this->conectar();
		$query = $this->ejecuta_query("SELECT a.id, a.nombre, a.descripcion, a.columnas, a.color, a.estado, b.username  FROM project a JOIN user b ON a.propietario = b.id");
		$this->desconectar();
		if (mysqli_num_rows($query) > 0)
		{
			$arr = [];
			while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
			{
				$arr[] = $row;
			}
			mysqli_free_result($query);
			return $arr;
		} else {
			return null;
		}
	}
	public function getAutores(){
		$this->conectar();
		$query = $this->ejecuta_query("SELECT username FROM user");
		$this->desconectar();
		if (mysqli_num_rows($query) > 0)
		{
			$arr = [];
			while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
			{
				$arr[] = $row;
			}
			mysqli_free_result($query);
			return $arr;
		} else {
			return null;
		}
	}
	public function moveTarea($idTarea = null, $idColumn = null, $idproject)
	{
		$this->conectar();
		$query = $this->ejecuta_query("UPDATE tarea SET columna='$idColumn' WHERE id='$idTarea' and id_project='$idproject'");
		$this->desconectar();
		if ($query == 1){
			return $query;
		}else{
			return null;
		}
	}
	public function updateTarea($nombre = null, $descripcion = null, $autor = null, $idTarea = null, $idproject = null)
	{
		$this->conectar();
		$query = $this->ejecuta_query("UPDATE tarea SET nombre='$nombre', descripcion='$descripcion', propietario=(SELECT id FROM user WHERE username='$autor') WHERE id='$idTarea' and id_project='$idproject'");
		$this->desconectar();
		if ($query == 1){
			return $query;
		}else{
			return null;
		}

	}
	public function crearTarea($nombre = null, $descripcion = null, $autor = null, $idproject = null)
	{
		$this->conectar();
		$query = $this->ejecuta_query("INSERT INTO tarea (id_project, nombre, descripcion, columna, propietario, estado)  VALUES ('$idproject','$nombre','$descripcion',1,(SELECT id FROM user WHERE username='$autor'),1)");
		$this->desconectar();
		if ($query == 1){
			return $query;
		}else{
			return null;
		}
	}
	public function getProject($idProject = null)
	{
		$this->conectar();
		$projectInfo = $this->ejecuta_query("SELECT * FROM project WHERE id='$idProject'");
		$tareasProject = $this->ejecuta_query("SELECT a.id, a.nombre, a.descripcion, a.columna, b.username, b.perfil, a.tiempo FROM (SELECT * FROM tarea WHERE id_project='$idProject') a JOIN user b on a.propietario = b.id;");
		$columnsName = $this->ejecuta_query("SELECT * FROM columnas WHERE id_project = '$idProject' ORDER BY orden;");
		$this->desconectar();
		$arr = [];
		if (mysqli_num_rows($projectInfo) > 0)
		{
			while($row=mysqli_fetch_array($projectInfo,MYSQLI_ASSOC))
			{
				$arr['projectInfo'] = $row;
			}
			mysqli_free_result($projectInfo);
		}
		if (mysqli_num_rows($tareasProject) > 0)
		{
			while($row=mysqli_fetch_array($tareasProject,MYSQLI_ASSOC))
			{
				$arr['tareasProject'][] = $row;
			}
			mysqli_free_result($tareasProject);
		} 
		if (mysqli_num_rows($columnsName) > 0)
		{
			while($row=mysqli_fetch_array($columnsName,MYSQLI_ASSOC))
			{
				$arr['columnsName'][] = $row;
			}
			mysqli_free_result($columnsName);
			return $arr;
		}
	}
	public function crearProyecto($nombre = null, $descripcion = null, $color = null, $columnas = null, $autor = null, $nombresColumnas = null)
	{
		$this->conectar();
		$query = $this->ejecuta_query("INSERT INTO project(nombre, descripcion, columnas, color, estado, propietario) VALUES ('$nombre', '$descripcion', '$columnas', '$color', 1, (SELECT id FROM user WHERE username='$autor'))");
		$query = $this->ejecuta_query("SELECT max(id) AS maximo FROM project");
		$this->desconectar();
		$respuesta = 0;
		if (mysqli_num_rows($query) > 0)
		{
			while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
			{
				$respuesta = $row["maximo"];
			}
			mysqli_free_result($query);
		} 
		if ($respuesta == 0) {
			return 0;
			die();
		}
		for ($i = 1; $i <= $columnas; $i++) {
				$nombreCol = $nombresColumnas["columna-".$i];
				$query = $this->ejecuta_query("INSERT INTO columnas(id_project, nombre_columna, orden) VALUES ('$respuesta', '$nombreCol', '$i')");
		}
		return 1;
	}
	public function deleteProject($id = null)
	{
		$this->conectar();
		$query = $this->ejecuta_query("DELETE FROM project WHERE id='$id'");
		$query = $this->ejecuta_query("DELETE FROM tarea WHERE id_project='$id'");
		$query = $this->ejecuta_query("DELETE FROM columnas WHERE id_project='$id'");
		$this->desconectar();
		if ($query == 1){
			return $query;
		}else{
			return null;
		}
	}
	public function deleteTarea($id = null)
	{
		$this->conectar();
		$query = $this->ejecuta_query("DELETE FROM tarea WHERE id='$id'");
		$this->desconectar();
		if ($query == 1){
			return $query;
		}else{
			return null;
		}

	}
	public function addHoraTarea($horas = null, $id = null)
	{
		$this->conectar();
		$query = $this->ejecuta_query("UPDATE tarea set tiempo = (tiempo + '$horas') WHERE id='$id'");
		$this->desconectar();
		if ($query == 1){
			return $query;
		}else{
			return null;
		}
	}

}







