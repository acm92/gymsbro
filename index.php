<!--Incluimos archivos de configuracion-->
<?php 
include "configs/config.php";
include "configs/funciones.php";

//Si no existe la pagina $p, automaticamente iniciará la principal
if(!isset($p)){
	$p = "principal";
} else {
	$p = $p;
}

?>

<!DOCTYPE html>
<html>
<head>
	<!--Cargamos estilo propio, de bootstrap, fontawesome y scripts-->
	<link rel="stylesheet" href="css/estilo.css?v=3.6.8"/>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.css"/>
	<link rel="stylesheet" href="fontawesome/css/all.css"/>
	<link href="css/prettyPhoto.css" rel="stylesheet">
	<link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="fontawesome/js/all.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/app.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	<title>GYMBRO</title>
</head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<body>
	<!--La cabecera-->
	
	<div class="header-section">
    <div class="header">
        <a href="?p=principal">GYM'SBRO®</a>
    </div>

    <div class="header2">
    	<a class="fb-ic mr-3 header2" href="?p=secreto" role="button"><i class="fab fa-lg fa-facebook-f"></i></a>
    	<a class="ins-ic mr-3" role="button"><i class="fab fa-lg fa-instagram"></i></a>
    	<a class="tw-ic mr-3" role="button"><i class="fab fa-lg fa-twitter"></i></a>
    	<a class="email-ic mr-3" role="button"><i class="far fa-lg fa-envelope"></i></a>
    </div>

    <div class="usuario">
        <?php 
				if (isset($_SESSION['id_cliente'])) {
			?>
				<a href="?p=mis_compras"><?=nombre_cliente($_SESSION['id_cliente'])?></a>
				<a href="?p=carrito"><i class="fa fa-shopping-cart"></i></a>
				<a href="?p=cerrar_sesion">Cerrar Sesión</a>
			
			<?php
				} else {
					?>
					<a href="?p=login">Iniciar Sesión</a>
					<a href="?p=registro">Registrarse</a>
					<?php
				}
			?>
    </div>
</div>


	<!--Menú de opciones-->
	<div>

			<!--Enlaces, redireccionados por su modulo de JS
			<a href="?p=proteinas">Proteínas</a>
			<a href="?p=alimentos">Alimentos y Snacks</a>
			<a href="?p=vitaminas">Vitaminas y Minerales</a>
			<a href="?p=control">Control de Peso</a>
			<a href="?p=aminoacidos">Aminoácidos</a>
			<a href="?p=ropa">Camisetas y Tops</a>
			<a href="?p=pantalones">Pantalones</a>
			<a href="?p=zapatillas">Zapatillas</a>
			<a href="?p=accesorios">Accesorios</a>-->
		<nav style="margin-bottom:0px;"class="navbar navbar-expand-lg navbar-dark bg-dark">
		  <!--Boton responsive-->
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>
		  <div>
		  	<div class="collapse navbar-collapse" id="navbarText">
		    	<ul class="navbar-nav mr-auto">
		      		<li class="nav-item">
		        		<a class="nav-link active" href="?p=proteinas">Proteínas</a>
		      		</li>
		      		<li class="nav-item">
		        		<a class="nav-link active" href="?p=alimentos">Alimentos y Snacks</a>
		      		</li>
		      		<li class="nav-item">
		        		<a class="nav-link active" href="?p=vitaminas">Vitaminas y Minerales</a>
		      		</li>
		      		<li class="nav-item">
		        		<a class="nav-link active" href="?p=control">Control de Peso</a>
		      		</li>
		      		<li class="nav-item">
		        		<a class="nav-link active" href="?p=aminoacidos">Aminoácidos</a>
		      		</li>
		      		<li class="nav-item">
		        		<a class="nav-link active" href="?p=ropa">Camisetas y Tops</a>
		      		</li>
		      		<li class="nav-item">
		        		<a class="nav-link active" href="?p=pantalones">Pantalones</a>
		      		</li>
		      		<li class="nav-item">
		        		<a class="nav-link active" href="?p=zapatillas">Zapatillas</a>
		      		</li>
		      		<li class="nav-item">
		        		<a class="nav-link active" href="?p=accesorios">Accesorios</a>
		      		</li>
		    	</ul>
		  	</div>
		  </div>
		</nav>
	</div>


	
	
	<!--Se cargarán todas las paginas en el cuerpo php creadas dentro de la carpeta "paginas"-->
	
	<div class="container-xl">
		<div class= "cuerpo">
		<?php

			if(file_exists("paginas/".$p.".php")){
				include "paginas/".$p.".php";
			} else {
				echo "No se ha encontrado la pagina <b>".$p."</b> <a href='./'>Volver</a>";
			}

		?>
	</div>	
	</div>

	
	<footer class="footer">
	<div class="footer">Copyright
		<a href="admin/">Angel Ciudad Montalbán</a> &copy; <?=date("Y")?>
		<br><br> 
		<a href="?p=politica_privacidad">Política de Privacidad</a>
	</div>	
	</footer>
	


</body> 
</html>
