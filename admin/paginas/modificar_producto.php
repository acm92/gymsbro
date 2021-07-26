<?php

//Si no eres admin, no puedes entrar a esta pagina
comprobar_admin();

$id = convertir_HTML($id);
$tabla2 = convertir_HTML($tabla2);

$q = $mysqli->query("SELECT * FROM $tabla2 WHERE id = '$id'");
$rq = mysqli_fetch_array($q);



if(isset($enviarImagen)){
	
	$imagen ="";
	$name = convertir_HTML($name);

		//Añadimos la imagen del producto a su carpeta correspondiente,
		//Dependiendo del valor que le dimos a $tabla2
		//Al nombre de la imagen se le añade un numero aleatorio para evitar conflictos de nombres
		if(is_uploaded_file($_FILES['imagen']['tmp_name'])) {
			$imagen = $name.rand(0,1000).".png";
			move_uploaded_file($_FILES['imagen']['tmp_name'], "productos/$tabla2/".$imagen);
		}

	$mysqli->query("UPDATE $tabla2 SET imagen = '$imagen' WHERE id = '$idpro'");
}

if(isset($enviar)){
	$idpro = convertir_HTML($idpro);
	$name = convertir_HTML($name);
	$price = convertir_HTML($price);

	$mysqli->query("UPDATE $tabla2 SET name = '$name', price = '$price' WHERE id = '$idpro'");
	redir("?p=agregar_producto");

}

?>
<form method="post" action="" enctype="multipart/form-data">
	<div class="form-group">
		Nombre del producto:
		<input type="text" class="form-control" name="name" value="<?=$rq['name']?>" placeholder="Nombre del producto"/>
	</div>


	<div class="form-group">
		Precio:
		<input type="text" class="form-control" name="price" value="<?=$rq['price']?>" placeholder="Precio del producto"/>
	</div>

	<div class="form-group">
		Imagen del producto:
		<input type="file" class="form-control" name="imagen" placeholder="Imagen del producto">
		<button type="submit" class="btn btn-success" style="background: black" name="enviarImagen"><i class="fa fa-check"></i>Subir Imagen</button>
	</div>


	<br><br>

	<center>
	<div class="form-group">
		<button type="submit" class="btn btn-success" name="enviar"><i class="fa fa-check"></i>Modificar Producto</button>
	</div>
	</center>


<input type="hidden" name="idpro" value="<?=$id?>"/>

</form>