<?php 
	
	if (isset($eliminar)) {
		$eliminar = convertir_HTML($eliminar);
		$mysqli->query("DELETE FROM carrito WHERE id = '$eliminar'");
		redir("?p=carrito");
	}

	if (isset($id) && isset($modificar)) {
		
		$id = convertir_HTML($id);
		$modificar = convertir_HTML($modificar);

		$mysqli->query("UPDATE carrito SET cantidad = '$modificar' WHERE id = '$id'");
		alert("Cantidad modificada",1,'carrito');
	}

	if (isset($finalizar)) {

		$id_cliente = convertir_HTML($_SESSION['id_cliente']);

		$pedido_total = convertir_HTML($total_precio);

		//Introducimos la compra hecha por X usuario en la tabla compra
		//Funcion NOW() es una funcion predeterminada de Mysql para obtener la fecha actual y el 0 es para comprobar el estado del pedido
		$q = $mysqli->query("INSERT INTO compra (id_cliente, fecha, total, estado) VALUES ('$id_cliente', NOW(), '$pedido_total',0)");

		//Seleccionamos la ultima compra hecha del ultimo usuario
		$sc = $mysqli->query("SELECT * FROM compra WHERE id_cliente = '$id_cliente' ORDER BY id DESC LIMIT 1");
		$rc = mysqli_fetch_array($sc);

		//id de la ultima compra
		$ultima_compra = $rc['id'];

		//Una vez finalizada la compra, se vacia el carrito. Pero antes se insertara en la tabla producto_compra
		$q2 = $mysqli->query("SELECT * FROM carrito WHERE id_cliente = '$id_cliente'");
		while ($r2 = mysqli_fetch_array($q2)) {


			$sp1 = $mysqli->query("SELECT * FROM proteinas WHERE id = '".$r2['id_producto']."'");
			$sp2 = $mysqli->query("SELECT * FROM aminoacidos WHERE id = '".$r2['id_producto']."'");
			$sp3 = $mysqli->query("SELECT * FROM accesorios WHERE id = '".$r2['id_producto']."'");
			$sp4 = $mysqli->query("SELECT * FROM ropa WHERE id = '".$r2['id_producto']."'");
			$sp5 = $mysqli->query("SELECT * FROM vitaminas WHERE id = '".$r2['id_producto']."'");
			$sp6 = $mysqli->query("SELECT * FROM zapatillas WHERE id = '".$r2['id_producto']."'");
			$sp7 = $mysqli->query("SELECT * FROM pantalones WHERE id = '".$r2['id_producto']."'");
			$sp8 = $mysqli->query("SELECT * FROM control WHERE id = '".$r2['id_producto']."'");
			$sp9 = $mysqli->query("SELECT * FROM alimentos WHERE id = '".$r2['id_producto']."'");

			if(mysqli_num_rows($sp1)>0) 
				$rp = mysqli_fetch_array($sp1);

			if(mysqli_num_rows($sp2)>0)
				$rp = mysqli_fetch_array($sp2);	

			if(mysqli_num_rows($sp3)>0)
				$rp = mysqli_fetch_array($sp3);

			if(mysqli_num_rows($sp4)>0)
				$rp = mysqli_fetch_array($sp4);

			if(mysqli_num_rows($sp5)>0)
				$rp = mysqli_fetch_array($sp5);

			if(mysqli_num_rows($sp6)>0)
				$rp = mysqli_fetch_array($sp6);

			if(mysqli_num_rows($sp7)>0)
				$rp = mysqli_fetch_array($sp7);

			if(mysqli_num_rows($sp8)>0)
				$rp = mysqli_fetch_array($sp8);

			if(mysqli_num_rows($sp9)>0)
				$rp = mysqli_fetch_array($sp9);

			$total = $rp['price'];


			$mysqli->query("INSERT INTO productos_compra (id_compra, id_producto, cantidad, total) VALUES ('$ultima_compra', '".$r2['id_producto']."', '".$r2['cantidad']."','$total')");
		}

		//Vaciamos el carrito una vez hecha la compra.
		$mysqli->query("DELETE FROM carrito WHERE id_cliente = '$id_cliente'");
		alert("¡Compra realizada!",1,'carrito');
	}
?>

<h1><i class="fa fa-shopping-cart"></i> Carrito</h1>
<br><br>
<!--Tabla de bootstrap, con sus table rows y table headers-->
<table class="table table-striped">
	<tr>
		<th>Nombre del producto</th>
		<th>Características</th>
		<th>Cantidad</th>
		<th>Precio por unidad</th>
		<th>Precio Total</th>
		<th>Acción</th>
	</tr>
<?php
	
	//Segun el id de un cliente especifico, se mostraran los productos de ese cliente
	//Uniendo la primary key id_cliente de la tabla cliente 
	//con la foreign key de id_cliente de la tabla carrito


	//id de productos:

	/*Pantalones: 10+ id
	Accesorios: 20 + id
	Proteinas:  40 + id
	Aminoacidos: 60 + id
	Alimentos: 80 +id
	Vitaminas: 100 + id
	Ropa: 120 + id
	Zapatillas: 140 + id
	Control de peso: 160 + id*/

	$id_cliente = convertir_HTML($_SESSION['id_cliente']); 
	$q = $mysqli->query("SELECT * FROM carrito WHERE id_cliente = '$id_cliente'");
	$total_precio = 0;
	//Recorremos las tablas en busca de los productos pedidos por x cliente
		$añadido = 0;

	while($r = mysqli_fetch_array($q)){

		//Hacemos un request de id_producto de la tabla carrito con $r, comparandolo con el
		//propio id del producto
		$q2 = $mysqli->query("SELECT * FROM proteinas WHERE id = '".$r['id_producto']."'");
		$q3 = $mysqli->query("SELECT * FROM aminoacidos WHERE id = '".$r['id_producto']."'");
		$q4 = $mysqli->query("SELECT * FROM accesorios WHERE id = '".$r['id_producto']."'");
		$q5 = $mysqli->query("SELECT * FROM ropa WHERE id = '".$r['id_producto']."'");
		$q6 = $mysqli->query("SELECT * FROM vitaminas WHERE id = '".$r['id_producto']."'");
		$q7 = $mysqli->query("SELECT * FROM zapatillas WHERE id = '".$r['id_producto']."'");
		$q8 = $mysqli->query("SELECT * FROM pantalones WHERE id = '".$r['id_producto']."'");
		$q9 = $mysqli->query("SELECT * FROM control WHERE id = '".$r['id_producto']."'");
		$q10 = $mysqli->query("SELECT * FROM alimentos WHERE id = '".$r['id_producto']."'");

    	
	    	if(mysqli_num_rows($q2)>0 && $añadido == 0){

	    		$r2 = mysqli_fetch_array($q2);

	    		$nombre_producto = $r2['name'];
	    		$cantidad = $r['cantidad'];
	    		$precio_unidad = $r2['price'];
	    		$caracteristica = $r['caracteristica'];
	    		$precio_total = $cantidad * $precio_unidad;

	    		$total_precio = $total_precio + $precio_total;

	    		?>
				<tr>
					<td><?=$nombre_producto?></td>
					<td><?=$caracteristica?></td>
					<td><?=$cantidad?></td>
					<td><?=$precio_unidad?> <?=$moneda?></td>
					<td><?=$precio_total?> <?=$moneda?></td>
					<td>
						<a onclick="modificar('<?=$r['id']?>')" href="#"><i class="fa fa-edit" title="Modificar cantidad en carrito"></i></a>
						<a href="?p=carrito&eliminar=<?=$r['id']?>"><i class="fa fa-times" title="Eliminar"></i></a>
					</td>
				</tr>

				<?php
				$añadido == 1;
			}

			if(mysqli_num_rows($q3)>0 && $añadido == 0){

				$r2 = mysqli_fetch_array($q3);

	    		$nombre_producto = $r2['name'];
	    		$cantidad = $r['cantidad'];
	    		$precio_unidad = $r2['price'];
	    		$caracteristica = $r['caracteristica'];
	    		$precio_total = $cantidad * $precio_unidad;

	    		$total_precio = $total_precio + $precio_total;

	    		?>
				<tr>
					<td><?=$nombre_producto?></td>
					<td><?=$caracteristica?></td>
					<td><?=$cantidad?></td>
					<td><?=$precio_unidad?> <?=$moneda?></td>
					<td><?=$precio_total?> <?=$moneda?></td>
					<td>
						<a onclick="modificar('<?=$r['id']?>')" href="#"><i class="fa fa-edit" title="Modificar cantidad en carrito"></i></a>
						<a href="?p=carrito&eliminar=<?=$r['id']?>"><i class="fa fa-times" title="Eliminar"></i></a>
					</td>
				</tr>

				<?php
				$añadido == 1;
			}

			if(mysqli_num_rows($q4)>0 && $añadido == 0){

				$r2 = mysqli_fetch_array($q4);

	    		$nombre_producto = $r2['name'];
	    		$cantidad = $r['cantidad'];
	    		$precio_unidad = $r2['price'];
	    		$caracteristica = $r['caracteristica'];
	    		$precio_total = $cantidad * $precio_unidad;

	    		$total_precio = $total_precio + $precio_total;

	    		?>
				<tr>
					<td><?=$nombre_producto?></td>
					<td><?=$caracteristica?></td>
					<td><?=$cantidad?></td>
					<td><?=$precio_unidad?> <?=$moneda?></td>
					<td><?=$precio_total?> <?=$moneda?></td>
					<td>
						<a onclick="modificar('<?=$r['id']?>')" href="#"><i class="fa fa-edit" title="Modificar cantidad en carrito"></i></a>
						<a href="?p=carrito&eliminar=<?=$r['id']?>"><i class="fa fa-times" title="Eliminar"></i></a>
					</td>
				</tr>

				<?php
				

				$añadido == 1;
			}

			if(mysqli_num_rows($q5)>0 && $añadido == 0){

				$r2 = mysqli_fetch_array($q5);

	    		$nombre_producto = $r2['name'];
	    		$cantidad = $r['cantidad'];
	    		$precio_unidad = $r2['price'];
	    		$caracteristica = $r['caracteristica'];
	    		$precio_total = $cantidad * $precio_unidad;

	    		$total_precio = $total_precio + $precio_total;

	    		?>
				<tr>
					<td><?=$nombre_producto?></td>
					<td><?=$caracteristica?></td>
					<td><?=$cantidad?></td>
					<td><?=$precio_unidad?> <?=$moneda?></td>
					<td><?=$precio_total?> <?=$moneda?></td>
					<td>
						<a onclick="modificar('<?=$r['id']?>')" href="#"><i class="fa fa-edit" title="Modificar cantidad en carrito"></i></a>
						<a href="?p=carrito&eliminar=<?=$r['id']?>"><i class="fa fa-times" title="Eliminar"></i></a>
					</td>
				</tr>

				<?php
				

				$añadido == 1;
			}

			if(mysqli_num_rows($q6)>0 && $añadido == 0){

				$r2 = mysqli_fetch_array($q6);

	    		$nombre_producto = $r2['name'];
	    		$cantidad = $r['cantidad'];
	    		$precio_unidad = $r2['price'];
	    		$caracteristica = $r['caracteristica'];
	    		$precio_total = $cantidad * $precio_unidad;

	    		$total_precio = $total_precio + $precio_total;

	    		?>
				<tr>
					<td><?=$nombre_producto?></td>
					<td><?=$caracteristica?></td>
					<td><?=$cantidad?></td>
					<td><?=$precio_unidad?> <?=$moneda?></td>
					<td><?=$precio_total?> <?=$moneda?></td>
					<td>
						<a onclick="modificar('<?=$r['id']?>')" href="#"><i class="fa fa-edit" title="Modificar cantidad en carrito"></i></a>
						<a href="?p=carrito&eliminar=<?=$r['id']?>"><i class="fa fa-times" title="Eliminar"></i></a>
					</td>
				</tr>

				<?php
				

				$añadido == 1;
			}

			if(mysqli_num_rows($q7)>0 && $añadido == 0){

				$r2 = mysqli_fetch_array($q7);

	    		$nombre_producto = $r2['name'];
	    		$cantidad = $r['cantidad'];
	    		$precio_unidad = $r2['price'];
	    		$caracteristica = $r['caracteristica'];
	    		$precio_total = $cantidad * $precio_unidad;

	    		$total_precio = $total_precio + $precio_total;

	    		?>
				<tr>
					<td><?=$nombre_producto?></td>
					<td><?=$caracteristica?></td>
					<td><?=$cantidad?></td>
					<td><?=$precio_unidad?> <?=$moneda?></td>
					<td><?=$precio_total?> <?=$moneda?></td>
					<td>
						<a onclick="modificar('<?=$r['id']?>')" href="#"><i class="fa fa-edit" title="Modificar cantidad en carrito"></i></a>
						<a href="?p=carrito&eliminar=<?=$r['id']?>"><i class="fa fa-times" title="Eliminar"></i></a>
					</td>
				</tr>

				<?php
				

				$añadido == 1;
			}

			if(mysqli_num_rows($q8)>0 && $añadido == 0){

				$r2 = mysqli_fetch_array($q8);

	    		$nombre_producto = $r2['name'];
	    		$cantidad = $r['cantidad'];
	    		$precio_unidad = $r2['price'];
	    		$caracteristica = $r['caracteristica'];
	    		$precio_total = $cantidad * $precio_unidad;

	    		$total_precio = $total_precio + $precio_total;

	    		?>
				<tr>
					<td><?=$nombre_producto?></td>
					<td><?=$caracteristica?></td>
					<td><?=$cantidad?></td>
					<td><?=$precio_unidad?> <?=$moneda?></td>
					<td><?=$precio_total?> <?=$moneda?></td>
					<td>
						<a onclick="modificar('<?=$r['id']?>')" href="#"><i class="fa fa-edit" title="Modificar cantidad en carrito"></i></a>
						<a href="?p=carrito&eliminar=<?=$r['id']?>"><i class="fa fa-times" title="Eliminar"></i></a>
					</td>
				</tr>

				<?php
				

				$añadido == 1;
			}

			if(mysqli_num_rows($q9)>0 && $añadido == 0){

				$r2 = mysqli_fetch_array($q9);

	    		$nombre_producto = $r2['name'];
	    		$cantidad = $r['cantidad'];
	    		$precio_unidad = $r2['price'];
	    		$caracteristica = $r['caracteristica'];
	    		$precio_total = $cantidad * $precio_unidad;

	    		$total_precio = $total_precio + $precio_total;

	    		?>
				<tr>
					<td><?=$nombre_producto?></td>
					<td><?=$caracteristica?></td>
					<td><?=$cantidad?></td>
					<td><?=$precio_unidad?> <?=$moneda?></td>
					<td><?=$precio_total?> <?=$moneda?></td>
					<td>
						<a onclick="modificar('<?=$r['id']?>')" href="#"><i class="fa fa-edit" title="Modificar cantidad en carrito"></i></a>
						<a href="?p=carrito&eliminar=<?=$r['id']?>"><i class="fa fa-times" title="Eliminar"></i></a>
					</td>
				</tr>

				<?php
				

				$añadido == 1;
			}

			if(mysqli_num_rows($q10)>0 && $añadido == 0){

				$r2 = mysqli_fetch_array($q10);

	    		$nombre_producto = $r2['name'];
	    		$cantidad = $r['cantidad'];
	    		$precio_unidad = $r2['price'];
	    		$caracteristica = $r['caracteristica'];
	    		$precio_total = $cantidad * $precio_unidad;

	    		$total_precio = $total_precio + $precio_total;

	    		?>
				<tr>
					<td><?=$nombre_producto?></td>
					<td><?=$caracteristica?></td>
					<td><?=$cantidad?></td>
					<td><?=$precio_unidad?> <?=$moneda?></td>
					<td><?=$precio_total?> <?=$moneda?></td>
					<td>
						<a onclick="modificar('<?=$r['id']?>')" href="#"><i class="fa fa-edit" title="Modificar cantidad en carrito"></i></a>
						<a href="?p=carrito&eliminar=<?=$r['id']?>"><i class="fa fa-times" title="Eliminar"></i></a>
					</td>
				</tr>

				<?php
				

				$añadido == 1;
			}

		$añadido == 0;
	}
?>
</table>
<br>

<h2>Precio total de pedido: <b class="text-green"><?=$total_precio?> <?=$moneda?></b></h2>
<!--Para finalizar la compra-->

<?php

	if($total_precio != 0) {
?>

	<form method="post" action="">
		<!--Variable oculta total_precio, con el precio total del pedido. Es hidden para evitar poder ser modificada-->
		<input type="hidden" name="total_precio" value="<?=$total_precio?>">
	<button class="btn btn-primary" type="submit" name="finalizar"><i class= "fa fa-check"></i> Finalizar Compra</button>
	</form>

<?php		
	}				
?>

<script type="text/javascript">
	
	function modificar(idproducto) {
		var nueva_cant = prompt("Indica la nueva cantidad");

		if (nueva_cant > 0) {

			window.location ="?p=carrito&id="+idproducto+"&modificar="+nueva_cant;
		}
	}
</script>

