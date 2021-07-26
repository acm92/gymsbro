<?php  

	if(isset($agregar) && isset($cantidad)){
		
		$id_producto = convertir_HTML($agregar);
		$cantidad = convertir_HTML($cantidad);
		$id_cliente = convertir_HTML($_SESSION['id_cliente']);


		$v = $mysqli->query("SELECT * FROM carrito WHERE id_cliente = '$id_cliente' AND id_producto = '$id_producto'");
		if(mysqli_num_rows($v)>0) {

			//Se actualiza la cantidad
			$q = $mysqli->query("UPDATE carrito SET cantidad = cantidad + $cantidad WHERE id_cliente = '$id_cliente' AND id_producto = '$id_producto'");

		} else {

			//Se mete en el carrito
			$q = $mysqli->query("INSERT INTO carrito (id_cliente, id_producto, cantidad, caracteristica) VALUES ('$id_cliente', '$id_producto', '$cantidad', '$caracteristica')");
		}

		alert("Se ha agregado al carrito",1,'accesorios');
		//redir("?p=accesorios");
	}

	
	//Variable de la busqueda
	if(isset($busq)){
	$q = $mysqli->query("SELECT * FROM accesorios WHERE name like '%$busq%'");
	
	}else{
		$q = $mysqli->query("SELECT * FROM accesorios ORDER BY id DESC");
	}

	//Barra de busqueda
	?>
	<form method="post" action="">
		<div class="row">
			<div class="col-md-5">
				<div class="form-group">
					<input type="text" class="form-control" name="busq" placeholder="Coloca el nombre del producto"/>
				</div>
			</div>
			<div class="col-md-2">
				<button type="submit" class="btn btn-prmiary" name="buscar"><i class="fa fa-serch"></i> Buscar</button>
			</div>
		</div>
	</form>
<?php


	//$q = $mysqli->query("SELECT * FROM accesorios ORDER BY id DESC");
	while($r=mysqli_fetch_array($q)){
		?>
			<div class="producto">
				
				<div> 
					<img class="img_producto" src="productos/accesorios/<?=$r['imagen']?>"/>
				</div>
				
				<div class="name_producto">
					<?=$r['name']?>
				</div>
				<div class="precio">
					<?=$r['price']?> <?=$moneda?>
					<!--En el boton de agregar carrito se identifica el producto con su id, y se añadira al carrito con la funcion de JS agregar_carrito() pasandole por parametro su id unica-->
					
				</div>

					<?php
						//Si el usuario no ha iniciado sesion, no vera el icono
						//del carrito 
						if (isset($_SESSION['id_cliente'])) {
					?>		
							<!--Cantidad de producto-->
							Cantidad: <input type="number" id="canti<?=$r['id']?>" name="canti" class="cantidad" value="1">
							<button class="btn btn-primary float-right" onclick="agregar_carrito('<?=$r['id']?>');"><i class="fa fa-shopping-cart"></i></button>
					<?php
						}
					?>
				
				<div>
				</div>
			</div>
		<?php
	}
?>

<script type="text/javascript">
	
	function agregar_carrito(id_producto) {

			cantid =  $("#canti"+id_producto).val();
			var caracteristica = "";

			if(cantid.length>0) {
				window.location = "?p=accesorios&agregar="+id_producto+"&cantidad="+cantid+"&caracteristica="+caracteristica;
			}
	}
</script>