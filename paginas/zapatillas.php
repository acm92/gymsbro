<?php  

	if(isset($agregar) && isset($cantidad)){
		
		$id_producto = convertir_HTML($agregar);
		$cantidad = convertir_HTML($cantidad);
		$id_cliente = convertir_HTML($_SESSION['id_cliente']);


		//Comprobamos uno de los productos de proteinas ya se encuentra en el carrito 
		$v = $mysqli->query("SELECT * FROM carrito WHERE id_cliente = '$id_cliente' AND id_producto = '$id_producto' AND caracteristica = '$caracteristica'");
		if(mysqli_num_rows($v)>0) {

			//Se actualiza la cantidad
			$q = $mysqli->query("UPDATE carrito SET cantidad = cantidad + $cantidad WHERE id_cliente = '$id_cliente' AND id_producto = '$id_producto' AND caracteristica = '$caracteristica'");

		} else {

			//Se mete en el carrito
			$q = $mysqli->query("INSERT INTO carrito (id_cliente, id_producto, cantidad, caracteristica) VALUES ('$id_cliente', '$id_producto', '$cantidad', '$caracteristica')");
		}

		
		alert("Se ha agregado al carrito",1,'zapatillas');
	}

	if(isset($busq)){
	$q = $mysqli->query("SELECT * FROM zapatillas WHERE name like '%$busq%'");
	
	}else{
		$q = $mysqli->query("SELECT * FROM zapatillas ORDER BY id DESC");
	}

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


	//De la tabla proteinas, almacenamos en forma de array sus datos.
	$q = $mysqli->query("SELECT * FROM zapatillas ORDER BY id DESC");
	while($r=mysqli_fetch_array($q)){
		?>
			<div class="producto">
				
				<div> 
					<img class="img_producto" src="productos/zapatillas/<?=$r['imagen']?>"/>
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
							<!--Boton de agregar a carrito-->
							<button class="btn btn-primary float-right" onclick="agregar_carrito('<?=$r['id']?>','talla');"><i class="fa fa-shopping-cart"></i></button>
					<?php
						}
					?>
				
				<div>

					<?php
						//Si el usuario no ha iniciado sesion, no vera los diferentes sabores
						if (isset($_SESSION['id_cliente'])) {
					?>
							Talla: 
							<select id="talla_<?=$r['id']?>">
						  		<option value="EU36">EU 36</option>
						  		<option value="EU37">EU 37</option>
						  		<option value="EU38">EU 38</option>
						  		<option value="EU39">EU 39</option>
						  		<option value="EU40">EU 40</option>
						  		<option value="EU41">EU 41</option>
						  		<option value="EU42">EU 42</option>
						  		<option value="EU43">EU 43</option>
						  		<option value="EU44">EU 44</option>
						  		<option value="EU45">EU 45</option>
						  		<option value="EU46">EU 46</option>
						  		<option value="EU47">EU 47</option>
							</select>
					<?php
						} 
					?>
				</div>
			</div>
		<?php
	}
?>

<script type="text/javascript">
	
	function agregar_carrito(id_producto, talla) {

			cantid =  $("#canti"+id_producto).val();
			var opcion = document.getElementById("talla_"+id_producto);
			var tallaZapas = opcion.options[opcion.selectedIndex].value;

			if(cantid.length>0) {
				window.location = "?p=zapatillas&agregar="+id_producto+"&cantidad="+cantid+"&caracteristica="+tallaZapas;
			}
	}
</script>