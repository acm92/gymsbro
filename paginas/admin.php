<?php 

//Al haber pulsado el boton de ingresar usuario y contraseña, la variable enviar estara en set
if(isset($enviar)){
	$username = convertir_HTML($username);
	$password = convertir_HTML($password);

	//Hacemos una query en la tabla de admins, para comprobar que efectivamente existen ese usuario y contraseña.
	$q = $mysqli->query("SELECT * FROM admins WHERE username = '$username' AND password = '$password'");

	//Si la comprobacion anterior es verdadera, es decir la variable q no esta vacia, entonces guardamos esa informacion en la variable r e iniciamos sesion con la variable primaria id. Finalmente, redireccionamos.
	if(mysqli_num_rows($q)>0){
		$r = mysqli_fetch_array($q);
		$_SESSION['id'] = $r['id'];
		redir("?p=admin");
	} else {
		alert("Se ha agregado al carrito",0,'admin');
	}

}



if(isset($_SESSION['id'])) { //si ya hay una sesion iniciada
	?>

	<a href="?p=agregar_producto">
		<button class ="btn btn-primary"><i class="fa fa-plus-circle"></i>Agregar Productos</button>
	</a>
	<a href="?p=tracking_admin">
		<button class ="btn btn-primary"><i class="fa fa-plus-circle"></i>Tracking de compras</button>
	</a>



	<?php
} else { //si no hay una sesion iniciada
	?>
	<center>
		<!--El atributo method especifica el metodo http para enviar los datos del formulario-->
		<!--El metodo POST envia la informacion del formulario en el cuerpo del http.-->
		<form method ="post" action="">
			<div class="centrar_login">
				<label><h2><i class="fa fa-key"></i> Iniciar sesión como Administrador</h2></label>
				<!--Formulario de Bootstrap para inicio de sesión-->
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Usuario" name="username">
				</div>

				<div class="form-group">
					<input type="password" class="form-control" placeholder="Contraseña" name="password">
				</div>
				<!--Botón aceptar-->
				<div class="form-group">
					<!--El boton al ser pulsado, la variable "enviar" estará en SET-->
					<button class="btn btn-submit" name="enviar" type="submit"><i class="fa fa-sign-in"></i>Aceptar</button>
				</div>
			</div>
		</form>
	</center>
<?php
}
?>