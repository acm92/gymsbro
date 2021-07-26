<?php

//Solo el propio usuario puede entrar aqui
comprobar_usuario();

$idcliente = convertir_HTML($idcliente);

$clientes = $mysqli->query("SELECT * FROM clientes WHERE id = '$idcliente'");
$rc = mysqli_fetch_array($clientes);



if(isset($enviar)){
	$nick = convertir_HTML($nick);
	$contraseña = convertir_HTML($contraseña);
	$nombre = convertir_HTML($nombre);

	$mysqli->query("UPDATE clientes SET username = '$nick', password = '$contraseña', name = '$nombre'  WHERE id = '$idcliente'");
	redir("?p=usuarios_registrados");

}

?>
<form method="post" action="" enctype="multipart/form-data">
	<div class="form-group">
		Nick:
		<input type="text" class="form-control" name="nick" value="<?=$rc['username']?>" placeholder="Nick de usuario"/>
	</div>


	<div class="form-group">
		Contraseña:
		<input type="text" class="form-control" name="contraseña" value="<?=$rc['password']?>" placeholder="Contraseña"/>
	</div>

	<div class="form-group">
		Nombre y Apellidos:
		<input type="text" class="form-control" name="nombre" value="<?=$rc['name']?>" placeholder="Nombre y Apellidos"/>
	</div>


	<br><br>

	<center>
	<div class="form-group">
		<button type="submit" class="btn btn-success" name="enviar"><i class="fa fa-check"></i>Modificar Usuario</button>
	</div>
	<a href="./">
		<button class="btn btn-success" ><i class="fa fa-check"></i>Volver</button>
	</a>
	</center>


<input type="hidden" name="idpro" value="<?=$id?>"/>

</form>