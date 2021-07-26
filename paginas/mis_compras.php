<?php
comprobar_usuario('mis_compras');
$s = $mysqli->query("SELECT * FROM compra WHERE id_cliente = '".$_SESSION['id_cliente']."' ORDER BY fecha DESC");
if(mysqli_num_rows($s)>0){
	?>
	<h1>Mis compras</h1>

	<table class="table table-stripe">
		<tr>
			<th>Fecha</th>
			<th>Total</th>
			<td>Estado</td>
			<td>Detalles</td>
		</tr>

	<?php
	while($r=mysqli_fetch_array($s)){
		?>
		<tr>
			<td><?=fecha($r['fecha'])?></td>
			<td><?=number_format($r['total'])?> <?=$moneda?></td>
			<td><?=estado($r['estado'])?></td>
			<td>
				<a href="?p=ver_compra&id=<?=$r['id']?>">
					<i class="fa fa-eye"></i>
				</a>
			</td>
		</tr>
		<?php
	}
	?>
	</table>

	<?php
}else{
	?>
	<center>
		<h1>¡Vaya! Ésto esta un poco vacío...</h1>
		<br><br>
		Todavía no has realizado ninguna compra.
	</center>
	
	<?php
}