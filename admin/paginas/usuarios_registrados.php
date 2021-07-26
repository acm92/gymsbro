<?php
comprobar_admin();

//$id = convertir_HTML($id);

$clientes = $mysqli->query("SELECT * FROM clientes ORDER BY id DESC");

if (isset($eliminar)) {
		$eliminar = convertir_HTML($eliminar);

		
		//Borramos todas las compras, el carrito y los productos de su compra de las tablas 'compra' y 'productos_compra'
		$q2 = $mysqli->query("SELECT * FROM compra WHERE id_cliente = '$eliminar' ");
		$r2 = mysqli_fetch_array($q2);
		
		$mysqli->query("DELETE FROM productos_compra WHERE id_compra = '".$r2['id']."'");
		$mysqli->query("DELETE FROM compra WHERE id_cliente = '$eliminar'");
		$mysqli->query("DELETE FROM carrito WHERE id_cliente = '$eliminar'");
		
		$mysqli->query("DELETE FROM clientes WHERE id = '$eliminar'");
		redir("?p=usuarios_registrados");
	}

?>
<h1>Usuarios registrados</h1><br>

<br>
<table class="table table-striped">
	<tr>
		<th>Nick del usuario</th>
		<th>Nombre y Apellidos</th>
		<th>Acciones</th>
	</tr>
	<?php
		while($rc = mysqli_fetch_array($clientes)){

			?>
				<tr>
					<td><?=$rc['username']?></td>
					<td><?=$rc['name']?></td>
					<td>
						<a href="?p=usuarios_registrados&eliminar=<?=$rc['id']?>"><i class="fa fa-times" title="Eliminar usuario"></i></a>
					</td>
				</tr>
			<?php
		}
	?>
</table>