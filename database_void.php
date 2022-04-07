<?php 
	$password = '';
		
	# Conecta a la base de datos y devuelve la conexión
	function database()
	{
		// Datos de la base de datos
		$usuario = "";
		$password = "";
		$servidor = "";
		$basededatos = "";

		// creacion de la conexion a la base de datos con mysql_connect()
		$conexion = mysqli_connect( $servidor, $usuario, $password ) or die ("No se ha podido conectar al servidor de Base de datos");

		// Seleccion del a base de datos a utilizar
		$db = mysqli_select_db( $conexion, $basededatos ) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );
		return $conexion;
	}
	
	# Devuelve los activos que tenemos en el momento
	function assets($conexion)
	{	
		$consulta = "SELECT * FROM crypto.assets WHERE date = (SELECT MAX(date) FROM crypto.assets)";
		$resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
				
		// Bucle while que recorre cada registro y muestra cada campo en la tabla.
		while ($columna = mysqli_fetch_array( $resultado )){
			if($columna['value']>0){
				echo "		<div class='ticker__item'>". $columna['value'] ." ". $columna['name'] ."</div>"."\n			";
			}
		}
		
	}
	
	#Devuelve las operaciones hechas
	function ops($conexion)
	{
		$consulta = "SELECT * FROM crypto.movements order by dateTs asc";
		$resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
		echo "<div id='ops'>";
		// Bucle while que recorre cada registro y muestra cada campo en la tabla.
		while ($columna = mysqli_fetch_array( $resultado ))
		{	
			echo "<div class='operation'>";
			echo "<div class='part1'>";
			echo "<img src='img/". $columna['Label'].".png' width='50' height='50'>"; 
			echo "<div>" . $columna['Label'] ."</div>";
			echo "</div>";
			echo "<div class='part2'>";
			echo "<p class='date'>". $columna['dateH'] ."</p>";
			echo "<div class='transaction'>";
			echo "<img src='img/Arrows/pre". $columna['Label'].".png' alt='' width='20' height='20'>";
			echo "<div class='currency'>". $columna['sentAmount'] ." ". $columna['sentCurrency'] ."</div>";
			echo "<img src='img/Arrows/post". $columna['Label'].".png' alt='' width='20' height='20'>";
			echo "<div class='currency'>". $columna['receivedAmount'] ." ". $columna['receivedCurrency'] ."</div>";
			echo "</div><button type='submit' class='info' value=".$columna['txHash'].">More Info</button></div></div>";
			echo "\n";
		}
		echo "</div>";	
	}
	
	function bals($conexion, $date)
	{	
		if ($_POST['date']==""){
			$date = "2021-04-26 23:59:59";
		}else{
			$date = $_POST['date']." 23:59:59";
		}
		
		$consulta1 = "SELECT name, sum(value) FROM crypto.assetsCalc where date<='".$date."' group by name";
		$consulta2 = "SELECT name, value FROM crypto.assets where date='".$date."'";

		$resultado = mysqli_query( $conexion, $consulta1 ) or die ( "Algo ha ido mal en la consulta '".$consulta1."' a la base de datos");
		$resultado2 = mysqli_query( $conexion, $consulta2 ) or die ( "Algo ha ido mal en la consulta  '".$consulta1."' a la base de datos");
		
		echo "<div id='bals'>";
		echo "<div id='calendar'>";
		echo "<form action='' method='POST'>";
		echo "<input type='date' id='date' name='date' value=".$date.">";
		echo "<input type='hidden' type='password' name='password' value=".$_POST['password'].">";
		echo "<input type='submit' name='submit' value='submit'>";
		echo "</form>";
		echo "</div>";
		
		echo "<div class='assetsCalc'>";
		echo "<h2>ASSETS CALCULATED</h2>";
		// Bucle while que recorre cada registro y muestra cada campo en la tabla.
		while ($columna = mysqli_fetch_array( $resultado ))
		{	
			if($columna['sum(value)']!=0){
				echo "<div>" . $columna['name'] .": ".$columna['sum(value)']."</div>";
			}			
		}
		
		echo "</div>";
		
		echo "<div class='assets'>";
		echo "<h2>ASSETS</h2>";	
		while ($columna = mysqli_fetch_array( $resultado2 ))
		{	
			if($columna['value']>0){
				echo "<div>" . $columna['name'] .": ".$columna['value']."</div>";	
			}
		}
		
		echo "</div></div>";			
	
	}
?>
