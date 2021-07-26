<?php
	
	//Si no eres admin, no puedes entrar a esta pagina
	comprobar_admin();

	//Introdcimos datos de un nuevo producto en la base de datos
	if(isset($enviar)) {

		$name = convertir_HTML($name);
		$price = convertir_HTML($price);
		$tabla1 = convertir_HTML($tabla1);

		$imagen ="";

		//Añadimos la imagen del producto a su carpeta correspondiente,
		//Dependiendo del valor que le dimos a $tabla
		//Al nombre de la imagen se le añade un numero aleatorio para evitar conflictos de nombres
		if(is_uploaded_file($_FILES['imagen']['tmp_name'])) {
			$imagen = $name.rand(0,1000).".png";
			move_uploaded_file($_FILES['imagen']['tmp_name'], "../productos/$tabla1/".$imagen);
		}

		$mysqli->query("INSERT INTO $tabla1 (name,price,imagen) VALUES ('$name', '$price', '$imagen')");
		alert("Producto agregado");
		redir("?p=agregar_producto");
	}

	if(isset($eliminar)) {

		$tabla2 = convertir_HTML($tabla2);

		$mysqli->query("DELETE FROM $tabla2 WHERE id = '$eliminar'");
		redir("?p=agregar_producto");
	
	}


?>

<h1>Agregar Productos</h1>
<br><br>

<!--Para permitir el envío de archivos a través de un formulario.-->
<form method="post" action="" enctype="multipart/form-data">
	
	<!--Seleccionamos el tipo de producto, y se guardara en la variable $tabla.-->
	<div class="form-group">
		<select name="tabla1">
	  		<option value="proteinas">Proteínas</option>
	  		<option value="alimentos">Alimentos y Snacks</option>
	  		<option value="vitaminas">Vitaminas y Minerales</option>
	  		<option value="control">Control de Peso</option>
	  		<option value="aminoacidos">Aminoacidos</option>
	  		<option value="ropa">Camisetas y Tops</option>
	  		<option value="accesorios">Accesorios</option>
	  		<option value="zapatillas">Zapatillas</option>
	  		<option value="pantalones">Pantalones</option>
		</select>
	</div>


	<div class="form-group">
		<input type="text" class="form-control" name="name" placeholder="Nombre del producto">
	</div>

	<div class="form-group">
		<input type="text" class="form-control" name="price" placeholder="Precio">
	</div>

	<label>Imagen del producto</label>

	<div class="form-group">
		<input type="file" class="form-control" name="imagen" placeholder="Imagen del producto">
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-success" name="enviar"><i class="fa fa-check"></i>Agregar Producto</button>
	</div>	

</form><br>
<br>

<table class="table table-striped">

	<h1>Proteinas</h1>

	<tr>
		<th>Nombre</th>
		<th>Precio</th>
		<th>Imagen</th>
		<th>Acciones</th>
	</tr>

	<?php

	//, ropa, alimentos, vitaminas, zapatillas, aminoacidos, accesorios, control, pantalones
		$prod = $mysqli->query("SELECT * FROM proteinas ORDER BY id DESC");
		while($rp=mysqli_fetch_array($prod)){

			?>
				<tr>
					<td><?=$rp['name']?></td>
					<td><?=$rp['price']?></td>

					<td><img src="../productos/proteinas/<?=$rp['imagen']?>" class="imagen_carrito"/></td>
					<td>
						
						<a style="color:#08f" href="?p=modificar_producto&tabla2=proteinas&id=<?=$rp['id']?>"><i class="fa fa-edit"></i></a>
						&nbsp;
						<a style="color:#08f" href="?p=agregar_producto&tabla2=proteinas&eliminar=<?=$rp['id']?>"><i class="fa fa-times"></i></a>

					</td>
				</tr>
			<?php
		}
	?>

</table>

<table class="table table-striped">

	<h1>Alimentos y Snacks</h1>

	<tr>
		<th>Nombre</th>
		<th>Precio</th>
		<th>Imagen</th>
		<th>Acciones</th>
	</tr>

	<?php

	//, ropa, alimentos, vitaminas, zapatillas, aminoacidos, accesorios, control, pantalones
		$prod = $mysqli->query("SELECT * FROM alimentos");
		while($rp=mysqli_fetch_array($prod)){

			?>
				<tr>
					<td><?=$rp['name']?></td>
					<td><?=$rp['price']?></td>

					<td><img src="../productos/alimentos/<?=$rp['imagen']?>" class="imagen_carrito"/></td>
					<td>
						
						<a style="color:#08f" href="?p=modificar_producto&tabla2=alimentos&id=<?=$rp['id']?>"><i class="fa fa-edit"></i></a>
						&nbsp;
						<a style="color:#08f" href="?p=agregar_producto&tabla2=alimentos&eliminar=<?=$rp['id']?>"><i class="fa fa-times"></i></a>

					</td>
				</tr>
			<?php
		}
	?>

</table>

<table class="table table-striped">

	<h1>Vitaminas y Minerales</h1>

	<tr>
		<th>Nombre</th>
		<th>Precio</th>
		<th>Imagen</th>
		<th>Acciones</th>
	</tr>

	<?php

	//, ropa, alimentos, vitaminas, zapatillas, aminoacidos, accesorios, control, pantalones
		$prod = $mysqli->query("SELECT * FROM vitaminas");
		while($rp=mysqli_fetch_array($prod)){

			?>
				<tr>
					<td><?=$rp['name']?></td>
					<td><?=$rp['price']?></td>

					<td><img src="../productos/vitaminas/<?=$rp['imagen']?>" class="imagen_carrito"/></td>
					<td>
						
						<a style="color:#08f" href="?p=modificar_producto&tabla2=vitaminas&id=<?=$rp['id']?>"><i class="fa fa-edit"></i></a>
						&nbsp;
						<a style="color:#08f" href="?p=agregar_producto&tabla2=vitaminas&eliminar=<?=$rp['id']?>"><i class="fa fa-times"></i></a>

					</td>
				</tr>
			<?php
		}
	?>

</table>

<table class="table table-striped">

	<h1>Control de Peso</h1>

	<tr>
		<th>Nombre</th>
		<th>Precio</th>
		<th>Imagen</th>
		<th>Acciones</th>
	</tr>

	<?php

	//, ropa, alimentos, vitaminas, zapatillas, aminoacidos, accesorios, control, pantalones
		$prod = $mysqli->query("SELECT * FROM control");
		while($rp=mysqli_fetch_array($prod)){

			?>
				<tr>
					<td><?=$rp['name']?></td>
					<td><?=$rp['price']?></td>

					<td><img src="../productos/control/<?=$rp['imagen']?>" class="imagen_carrito"/></td>
					<td>
						
						<a style="color:#08f" href="?p=modificar_producto&tabla2=control&id=<?=$rp['id']?>"><i class="fa fa-edit"></i></a>
						&nbsp;
						<a style="color:#08f" href="?p=agregar_producto&tabla2=control&eliminar=<?=$rp['id']?>"><i class="fa fa-times"></i></a>

					</td>
				</tr>
			<?php
		}
	?>

</table>

<table class="table table-striped">

	<h1>Aminoácidos</h1>

	<tr>
		<th>Nombre</th>
		<th>Precio</th>
		<th>Imagen</th>
		<th>Acciones</th>
	</tr>

	<?php

	//, ropa, alimentos, vitaminas, zapatillas, aminoacidos, accesorios, control, pantalones
		$prod = $mysqli->query("SELECT * FROM aminoacidos");
		while($rp=mysqli_fetch_array($prod)){

			?>
				<tr>
					<td><?=$rp['name']?></td>
					<td><?=$rp['price']?></td>

					<td><img src="../productos/aminoacidos/<?=$rp['imagen']?>" class="imagen_carrito"/></td>
					<td>
						
						<a style="color:#08f" href="?p=modificar_producto&tabla2=aminoacidos&id=<?=$rp['id']?>"><i class="fa fa-edit"></i></a>
						&nbsp;
						<a style="color:#08f" href="?p=agregar_producto&tabla2=aminoacidos&eliminar=<?=$rp['id']?>"><i class="fa fa-times"></i></a>

					</td>
				</tr>
			<?php
		}
	?>

</table>

<table class="table table-striped">

	<h1>Camisetas y Tops</h1>

	<tr>
		<th>Nombre</th>
		<th>Precio</th>
		<th>Imagen</th>
		<th>Acciones</th>
	</tr>

	<?php

	//, ropa, alimentos, vitaminas, zapatillas, aminoacidos, accesorios, control, pantalones
		$prod = $mysqli->query("SELECT * FROM ropa");
		while($rp=mysqli_fetch_array($prod)){

			?>
				<tr>
					<td><?=$rp['name']?></td>
					<td><?=$rp['price']?></td>

					<td><img src="../productos/ropa/<?=$rp['imagen']?>" class="imagen_carrito"/></td>
					<td>
						
						<a style="color:#08f" href="?p=modificar_producto&tabla2=ropa&id=<?=$rp['id']?>"><i class="fa fa-edit"></i></a>
						&nbsp;
						<a style="color:#08f" href="?p=agregar_producto&tabla2=ropa&eliminar=<?=$rp['id']?>"><i class="fa fa-times"></i></a>

					</td>
				</tr>
			<?php
		}
	?>

</table>

<table class="table table-striped">

	<h1>Pantalones</h1>

	<tr>
		<th>Nombre</th>
		<th>Precio</th>
		<th>Imagen</th>
		<th>Acciones</th>
	</tr>

	<?php

	//, ropa, alimentos, vitaminas, zapatillas, aminoacidos, accesorios, control, pantalones
		$prod = $mysqli->query("SELECT * FROM pantalones");
		while($rp=mysqli_fetch_array($prod)){

			?>
				<tr>
					<td><?=$rp['name']?></td>
					<td><?=$rp['price']?></td>

					<td><img src="../productos/pantalones/<?=$rp['imagen']?>" class="imagen_carrito"/></td>
					<td>
						
						<a style="color:#08f" href="?p=modificar_producto&tabla2=pantalones&id=<?=$rp['id']?>"><i class="fa fa-edit"></i></a>
						&nbsp;
						<a style="color:#08f" href="?p=agregar_producto&tabla2=pantalones&eliminar=<?=$rp['id']?>"><i class="fa fa-times"></i></a>

					</td>
				</tr>
			<?php
		}
	?>

</table>

<table class="table table-striped">

	<h1>Zapatillas</h1>

	<tr>
		<th>Nombre</th>
		<th>Precio</th>
		<th>Imagen</th>
		<th>Acciones</th>
	</tr>

	<?php

	//, ropa, alimentos, vitaminas, zapatillas, aminoacidos, accesorios, control, pantalones
		$prod = $mysqli->query("SELECT * FROM zapatillas");
		while($rp=mysqli_fetch_array($prod)){

			?>
				<tr>
					<td><?=$rp['name']?></td>
					<td><?=$rp['price']?></td>

					<td><img src="../productos/zapatillas/<?=$rp['imagen']?>" class="imagen_carrito"/></td>
					<td>
						
						<a style="color:#08f" href="?p=modificar_producto&tabla2=zapatillas&id=<?=$rp['id']?>"><i class="fa fa-edit"></i></a>
						&nbsp;
						<a style="color:#08f" href="?p=agregar_producto&tabla2=zapatillas&eliminar=<?=$rp['id']?>"><i class="fa fa-times"></i></a>

					</td>
				</tr>
			<?php
		}
	?>

</table>

<table class="table table-striped">

	<h1>Accesorios</h1>

	<tr>
		<th>Nombre</th>
		<th>Precio</th>
		<th>Imagen</th>
		<th>Acciones</th>
	</tr>

	<?php

	//, ropa, alimentos, vitaminas, zapatillas, aminoacidos, accesorios, control, pantalones
		$prod = $mysqli->query("SELECT * FROM accesorios");
		while($rp=mysqli_fetch_array($prod)){

			?>
				<tr>
					<td><?=$rp['name']?></td>
					<td><?=$rp['price']?></td>

					<td><img src="../productos/accesorios/<?=$rp['imagen']?>" class="imagen_carrito"/></td>
					<td>
						
						<a style="color:#08f" href="?p=modificar_producto&tabla2=accesorios&id=<?=$rp['id']?>"><i class="fa fa-edit"></i></a>
						&nbsp;
						<a style="color:#08f" href="?p=agregar_producto&tabla2=accesorios&eliminar=<?=$rp['id']?>"><i class="fa fa-times"></i></a>

					</td>
				</tr>
			<?php
		}
	?>

</table>
