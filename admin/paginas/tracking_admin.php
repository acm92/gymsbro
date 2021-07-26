<?php
comprobar_admin();

// 0 Recien comprado
// 1 Preparando compra
// 2 En camino
// 3 Entregado

$s = $mysqli->query("SELECT * FROM compra WHERE estado != 3");

if(isset($eliminar)){
	$eliminar = convertir_HTML($eliminar);

	$mysqli->query("DELETE FROM productos_compra WHERE id_compra = '$eliminar'");

	$mysqli->query("DELETE FROM compra WHERE id = '$eliminar'");
	redir("?p=tracking_admin");

}


?>

<h1>Trackings</h1><br><br>

<table class="table table-stripe">
	<tr>
		<th>Cliente</th>
		<th>Fecha</th>
		<th>Total</th>
		<th>Estado</th>
		<th>Acciones</th>
	</tr>
<?php
	while($r=mysqli_fetch_array($s)){

		$sc = $mysqli->query("SELECT * FROM clientes WHERE id = '".$r['id_cliente']."'");
		$rc = mysqli_fetch_array($sc);
		$cliente = $rc['name'];


		if($r['estado'] == 0){
			$status = "Preparando paquete";
		}elseif($r['estado']==1){
			$status = "Entregando a empresa repartidora";
		}elseif($r['estado'] == 2){
			$status = "En camino";
		}elseif($r['estado'] == 3){
			$status = "Entregado a cliente";
		}else{
			$status = "Indefinido";
		}

		$fecha = fecha($r['fecha']);


		?>
		<tr>
			<td><?=$cliente?></td>
			<td><?=$fecha?></td>
			<td><?=$r['total']?> <?=$moneda?></td>
			<td><?=$status?></td>
			<td>
				<a  style="color:#08f" href="?p=tracking_admin&eliminar=<?=$r['id']?>">
					<i class="fa fa-times"></i>
				</a>
				&nbsp; &nbsp;
				<a  style="color:#08f" href="?p=manejar_estado&id=<?=$r['id']?>">
					<i class="fa fa-edit"></i>
				</a>
				&nbsp; &nbsp;
				<a  style="color:#08f" href="?p=ver_compra&id=<?=$r['id']?>">
					<i class="fa fa-eye"></i>
				</a>
			</td>
		</tr>
		<?php
	}
?>
</table>