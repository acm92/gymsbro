<?php 


	//Variables de conexion de servidor de MYSQL Server
	$host_mysql = "localhost";
	$user_mysql = "root";
	$pass_mysql = "";
	$db_mysql = "tienda";
	

	//Conectamos a nuestro servidor de base de datos
	//Variable sin funcion
	$mysqli = mysqli_connect($host_mysql,$user_mysql,$pass_mysql,$db_mysql);

	//Si no existe la base de datos tienda, aparecera un error
	// mysqli_select_db($conexion,"tienda") or die("No existe la base de datos");


	//Convierte caracteres especiales en entidades HTML
	function convertir_HTML($var) {

		htmlspecialchars($var);

		return $var;
	}

	//Para redireccionar a una pagina URL especifica. Debemos usar el tag script de HTML, por lo que debemos cerrar PHP un momento.
	function redir($var) {

		?>
		<script>
			window.location="<?=$var?>";
		</script>
		<?php  
		die();
	}

	//Alerta de Sweet Alert, se abre una ventanita en el navegador.
	//Dependiendo del tipo de alerta: error, exito. Se le pasara el tipo por parametro y el icono cambiara
	function alert($txt, $tipo,$url) {
		
		//Hay 4 tipos de iconos, "error", "exito", "info" y "warning"

		if($tipo==0){
		$t = "error";
		}elseif($tipo==1){
			$t = "success";
		}elseif($tipo==2){
			$t = "info";
		}else{
			$t = "info";
		}

	//Se muestra el script, y mediante window.location se vuelve a la pagina indicada por la variable $url
	echo '<script>swal({ title: "Alerta", text: "'.$txt.'", icon: "'.$t.'"});';
	echo '$(".swal-button").click(function(){ window.location="?p='.$url.'"; });';
	echo '</script>';

	}

	//Para comprobar si es el admin el que esta realizando tareas de admin.
	//Si no, se vuelve a la pagina principal.
	function comprobar_admin(){
		if(!isset($_SESSION['id'])){

			//En este caso index.php
			redir("./");
		}
	}

	//Comprobar si el cliente ha iniciado sesion
	function comprobar_usuario($url){
		if (!isset($_SESSION['id_cliente'])) {
			redir("?p=login&return=$url");
		} else {

		}
	}

	function comprobar_usuario_booleano($url){
		if (!isset($_SESSION['id_cliente'])) {
			return false;
		} else {
			return true;
		}
	}

	//Mostrar el usuario registrado que ha iniciado sesion
	function nombre_cliente($id_cliente){

		//Conectamos a la base de datos
		$mysqli = connect();

		$q = $mysqli->query("SELECT * FROM clientes WHERE id = '$id_cliente'");
		$r = mysqli_fetch_array($q);
		return $r['username'];
	}

	function connect() {

		//Variables de conexion de servidor de MYSQL Server
		$host_mysql = "localhost";
		$user_mysql = "root";
		$pass_mysql = "";
		$db_mysql = "tienda";

		$mysqli = mysqli_connect($host_mysql,$user_mysql,$pass_mysql,$db_mysql);

		return $mysqli;
	}

	//explode() es una funcion de PHP usada para separar un string en diferentes strings
	function fecha($fecha){
	$e = explode("-",$fecha);

	$year = $e[0];
	$month = $e[1];
	$e2 = explode(" ",$e[2]);
	$day = $e2[0];
	$time = $e2[1];

	$e3 = explode(":",$time);
	$hour = $e3[0];
	$mins = $e3[1];

	return $day."/".$month."/".$year." ".$hour.":".$mins;

}

function estado($id_estado){
		if($id_estado == 0){
			$status = "Preparando paquete";
		}elseif($id_estado==1){
			$status = "Entregando a empresa repartidora";
		}elseif($id_estado == 2){
			$status = "En camino";
		}elseif($id_estado == 3){
			$status = "Entregado a cliente";
		}else{
			$status = "Indefinido";
		}

		return $status;

}

//La variable id para SESSION solo se asigna a los admins
function nombre_admin_conectado() {

	$id = $_SESSION['id'];

	$mysqli = connect();

	$q = $mysqli->query("SELECT * FROM admins WHERE id = '$id'");
	$r = mysqli_fetch_array($q);

	return $r['name'];
}


?>