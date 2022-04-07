<!DOCTYPE html>
	<head>
		<meta charset="utf-8" />
		<title>Crytpo Taxes</title>

		<meta content="Nombre del Autor" name="author" />
		<meta content="Descripción de la página" name="description" />
		<meta content="etiqueta1, etiqueta2, etiqueta3" name="keywords" />

		<link href="index.css" rel="stylesheet" type="text/css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="MoreInfo.js"></script>
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
			<!-- 
			<div id='lock'>
			    <p>Logueate</p>
			    <form method="post" action="">
				    <input class='log-in' type="password" name="password">
					<br>
					<input class='logbut' type="submit" value="Login">
			    </form>
            </div>		
			-->
			<div class='ticker-wrap'>
				<div class='ticker'>
					<div class='ticker__item'>Actual Assets:</div>
			<?php
				assets($conexion);
			?>
				</div>
			</div>
			<div id='lat'>
				<a class='but' href="?select=Movimientos">Movimientos</a>
				<a class='but' href="?select=Balance">Balances</a>
				<a class='but' href="javascript:void(0);">Más</a>
				<a class='but' href="selector($,"");">Más</a>
			</div>
			<?php
				
				if ($_GET['select'] == "Balance"){
					if ($_POST['date']){
						//call the function or execute the code
						bals($conexion, $_POST['date']);
					}else{
						bals($conexion,'');
					}
				}else{
					ops($conexion);
				}
			?>
			<?php 
			
				mysqli_close( $conexion );
			?>		
		</div>
	</body>		
</html>