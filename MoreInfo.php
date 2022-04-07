if (isset($_POST['action'])) {
        select($_POST['action'])
    }

    function select($id) {
	$consulta = "SELECT * FROM crypto.movements order by dateTs asc";
	$resultado = mysqli_query(database(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");

        echo "The select function is called:".$id."|";
        exit;
    }

    