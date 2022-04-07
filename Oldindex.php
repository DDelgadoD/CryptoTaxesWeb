<!DOCTYPE html>
	<head>
		<meta charset="utf-8" />
		<title>Crytpo Taxes</title>

		<meta content="Nombre del Autor" name="author" />
		<meta content="Descripción de la página" name="description" />
		<meta content="etiqueta1, etiqueta2, etiqueta3" name="keywords" />

		<link href="index.css" rel="stylesheet" type="text/css">
	</head>
	
	<body>
		<?php 
			include 'database.php';
			$conexion = database(); 
		?>		
		<div id='warpper'>
			<div id='title'>
				<img src='img/Head.gif' alt= 'CRYPTO TAXES' width=60%>
			</div>
			<?php 
				if ($_POST['password'] != $password) {
			?>
			<div id='lock'>
			    <p>Logueate</p>
			    <form name="form" method="post" action="">
				    <input class='log-in' type="password" name="password">
					<br>
					<input class='logbut' type="submit" value="Login">
			    </form>
            </div>		
			<?php }else{ ?>
			<div class='ticker-wrap'>
				<div class='ticker'>
					<div class='ticker__item'>Actual Assets:</div>
			<?php 
				assets($conexion);
			?>
				</div>
			</div>
			<div id='lat'>
				<a class='but' href="javascript:void(0);">Movimientos</a>
				<a class='but' href="javascript:void(0);">Balances</a>
				<a class='but' href="javascript:void(0);">Más</a>
				<a class='but' href="javascript:void(0);">Más</a>
			</div>
			<?php
				ops($conexion);
			?>
			<?php 
			} 
				mysqli_close( $conexion );
			?>		
		</div>
	</body>		
</html>