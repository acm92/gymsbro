<?php
comprobar_admin();
$id = convertir_HTML($id);
$s = $mysqli->query("SELECT * FROM compra WHERE id = '$id'");
$r = mysqli_fetch_array($s);

if(isset($modificar)){

	$estado = convertir_HTML($estado);

	$mysqli->query("UPDATE compra SET estado = '$estado' WHERE id = '$id'");
	redir("?p=tracking_admin");

}
?>
<h1>Modificar estado de compra</h1>
<br>
<form method="post" action="">
	<div class="form-group">
		<select class="form-control" name="estado">
			<option <?php if($r['estado'] == 0) { echo "selected"; } ?> value="0">Preparando paquete</option>
			<option <?php if($r['estado'] == 1) { echo "selected"; } ?> value="1">Entregando a empresa repartidora</option>
			<option <?php if($r['estado'] == 2) { echo "selected"; } ?> value="2">En camino</option>
			<option <?php if($r['estado'] == 3) { echo "selected"; } ?> vlaue="3">Entregado a cliente</option>
		</select>
	</div>
	<br>
	<div class="form-group">
		<input class="btn btn-primary" type="submit" value="Cambiar Estado" name="modificar"/>
	</div>
</form>