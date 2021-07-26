<?php
if(isset($_SESSION['id_cliente'])){
	redir("./");
}
	
if(isset($enviar)){

	if(!isset($politica)){
		alert("Debes aceptar la política de privacidad",0,'registro');
		die();
	}

	$username = convertir_HTML($username);
	$password = convertir_HTML($password);
	$cpassword = convertir_HTML($cpassword);
	$nombre = convertir_HTML($nombre);

	$q = $mysqli->query("SELECT * FROM clientes WHERE username = '$username'");

	if(mysqli_num_rows($q)>0){
		alert("Ya existe un usuario con ese nick",0,'registro');
		die();
	}

	if($password != $cpassword){
		alert("Las contraseñas no coinciden",0,'registro');
		die();
	}



	$mysqli->query("INSERT INTO clientes (username,password,name) VALUES ('$username','$password','$nombre')");


	$q2 = $mysqli->query("SELECT * FROM clientes WHERE username = '$username'");

	$r = mysqli_fetch_array($q2);

	$_SESSION['id_cliente'] = $r['id'];

	alert("Te has registrado satisfactoriamente",1,'principal');
	die();

}
	?>


	<center>
		<form method="post" action="">
			<div class="centrar_login">
				<label><h2><i class="fa fa-key"></i>  Registro</h2></label>
				<div class="form-group">
					<!--Autocomplete off para evitar que el navegador guarde la informacion-->
					<input type="text" autocomplete="off" class="form-control" placeholder="Usuario" name="username"/>
				</div>

				<div class="form-group">
					<input type="password" class="form-control" placeholder="Contraseña" name="password"/>
				</div>

				<div class="form-group">
					<input type="password" class="form-control" placeholder="Confirmar Contraseña" name="cpassword"/>
				</div>


				<div class="form-group">
					<input type="text" autocomplete="off" class="form-control" placeholder="Nombre" name="nombre"/>
				</div>

				<div class="form-group">
					<div class="form-check">
    				<input type="checkbox" class="form-check-input" name="politica">
    				&nbsp&nbsp&nbsp&nbsp
    				<label class="form-check-label" for="exampleCheck1">Acepto y confirmo la Política de Privacidad*</label>
  				</div>
				</div>

				<br>
				<div class="form-group">
					<button class="btn btn-submit" name="enviar" type="submit"><i class="fa fa-sign-in"></i>Registrate</button>
				</div>
			</div>
		</form>
	</center>
	<div>
					<label>GYM'SBRO</label> informa que los datos de carácter personal que me proporciones rellenando el presente formulario serán tratados por Ángel Ciudad Montalbán como responsable de esta web. La finalidad de la recogida y tratamiento de los datos personales que te solicitamos es para enviarte nuestras
publicaciones, promociones de productos y/o servicios y recursos exclusivos. La legitimación se realiza a través del consentimiento del interesado. Te
informamos que los datos que nos facilitas estarán ubicados en los servidores de 000WEBHOST a través de su empresa
Hostinger International, Ltd. ubicada en EEUU y acogida al EU-US Privacy Shield. Ver política de privacidad de Hostinger International, Ltd. El hecho de que no introduzcas los
datos de carácter personal que aparecen en el formulario como obligatorios podrá tener como consecuencia que no podamos atender tu solicitud. Podrás
ejercer tus derechos de acceso, rectificación,limitación y suprimir los datos en angelcld7@gmail.com así como el derecho a presentar una
reclamación ante una autoridad de control. Puede consultar nuestra política de privacidad <a href="?p=politica_privacidad">aquí</a>		
				</div>