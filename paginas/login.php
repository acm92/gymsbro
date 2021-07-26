<?php 
	
	//Un cliente que ya ha ingresado, y quiere entrar en login, se le redirige a la
	//pagina principal index
	if (isset($_SESSION['id_cliente'])) {
		redir("./");	
	}

//Al haber pulsado el boton de ingresar usuario y contraseña, la variable enviar estara en set
if(isset($enviar)){
	$username = convertir_HTML($username);
	$password = convertir_HTML($password);

	//Hacemos una query en la tabla de clientes, para comprobar que efectivamente existen ese usuario y contraseña.
	$q = $mysqli->query("SELECT * FROM clientes WHERE username = '$username' AND password = '$password'");

	//Si la comprobacion anterior es verdadera, es decir la variable q no esta vacia, entonces guardamos esa informacion en la variable r e iniciamos sesion con la variable primaria id. Finalmente, redireccionamos.
	if(mysqli_num_rows($q)>0){
		$r = mysqli_fetch_array($q);
		$_SESSION['id_cliente'] = $r['id'];
		if (isset($return)) {
			redir("?p=".$return);
		} else {
			redir("./");	
		}
	} else {
		alert("Datos incorrectos. Vuelva a introducir los datos",0,'login');

	}

}

	?>
	<center>
		<!--El atributo method especifica el metodo http para enviar los datos del formulario-->
		<!--El metodo POST envia la informacion del formulario en el cuerpo del http.-->
		<form method ="post" action="">
			<div class="centrar_login">
				<label><h2><i class="fa fa-key"></i> Iniciar Sesión</h2></label>
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
