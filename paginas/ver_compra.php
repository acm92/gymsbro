<?php
	comprobar_usuario('ver_compra');
	$id = convertir_HTML($id);

	$s = $mysqli->query("SELECT * FROM compra WHERE id = '$id' AND id_cliente = '".$_SESSION['id_cliente']."'");

	if(mysqli_num_rows($s)>0){

	$s = $mysqli->query("SELECT * FROM compra WHERE id = '$id'");
	$r = mysqli_fetch_array($s);

	$sc = $mysqli->query("SELECT * FROM clientes WHERE id = '".$r['id_cliente']."'");
	$rc = mysqli_fetch_array($sc);

	$nombre = $rc['name'];

?>

		<h3>
		Id de compra: #<span style="color:#08f"><?=$r['id']?></span><br><br>
		Fecha: <?=fecha($r['fecha'])?><br><br>
		Precio: <?=number_format($r['total'])?> <?=$moneda?><br><br>
		Estado: <?=estado($r['estado'])?><br><br>
		<br>
		</h3>
	<table class="table table-striped">
		<tr>
			<th>Nombre del producto</th>
			<th>Cantidad</th>
			<th>Precio</th>
			<th>Precio Total</th>
		</tr>
		<?php
			$sp = $mysqli->query("SELECT * FROM productos_compra WHERE id_compra = '$id'");
			while($rp=mysqli_fetch_array($sp)){

				$sp1 = $mysqli->query("SELECT * FROM proteinas WHERE id = '".$rp['id_producto']."'");
				$sp2 = $mysqli->query("SELECT * FROM aminoacidos WHERE id = '".$rp['id_producto']."'");
				$sp3 = $mysqli->query("SELECT * FROM accesorios WHERE id = '".$rp['id_producto']."'");
				$sp4 = $mysqli->query("SELECT * FROM ropa WHERE id = '".$rp['id_producto']."'");
				$sp5 = $mysqli->query("SELECT * FROM vitaminas WHERE id = '".$rp['id_producto']."'");
				$sp6 = $mysqli->query("SELECT * FROM zapatillas WHERE id = '".$rp['id_producto']."'");
				$sp7 = $mysqli->query("SELECT * FROM pantalones WHERE id = '".$rp['id_producto']."'");
				$sp8 = $mysqli->query("SELECT * FROM control WHERE id = '".$rp['id_producto']."'");
				$sp9 = $mysqli->query("SELECT * FROM alimentos WHERE id = '".$rp['id_producto']."'");

				if(mysqli_num_rows($sp1)>0){ 
					$rpro = mysqli_fetch_array($sp1);
				}

				if(mysqli_num_rows($sp2)>0){
					$rpro = mysqli_fetch_array($sp2);	
				}

				if(mysqli_num_rows($sp3)>0){
					$rpro = mysqli_fetch_array($sp3);
				}

				if(mysqli_num_rows($sp4)>0){
					$rpro = mysqli_fetch_array($sp4);
				}

				if(mysqli_num_rows($sp5)>0){
					$rpro = mysqli_fetch_array($sp5);
				}

				if(mysqli_num_rows($sp6)>0){
					$rpro = mysqli_fetch_array($sp6);
				}

				if(mysqli_num_rows($sp7)>0){
					$rpro = mysqli_fetch_array($sp7);
				}

				if(mysqli_num_rows($sp8)>0){
					$rpro = mysqli_fetch_array($sp8);
				}

				if(mysqli_num_rows($sp9)>0){
					$rpro = mysqli_fetch_array($sp9);
				}


					$nombre_producto = $rpro['name'];

					$preciototal = $rp['total'] * $rp['cantidad'];
			?>
						<tr>
							<td><?=$nombre_producto?></td>
							<td><?=$rp['cantidad']?></td>
							<td><?=$rp['total']?></td>
							<td><?=$preciototal?></td>
						</tr>
			<?php
			}
		} 
			?>
	</table>