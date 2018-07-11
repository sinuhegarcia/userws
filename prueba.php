<?php
	include "core/config.php";

	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	$sql = 'SELECT Id, Usuario, Clave, Status from usuario ';
	$result = $conn->query($sql);

    $total_num_rows = $result->num_rows;

    // Hace el rrecorrido por el array de datos y lo guarda en la variable $rows
    echo "Total rows: ".$total_num_rows."<br/>";
    $rows = array();
    while ($row = $result->fetch_assoc()){
    	if($row !== null){
    		$rows[] = $row;
    	}
    };

    //print_r($rows);
    echo json_encode($rows, JSON_PRETTY_PRINT)."<br/>";
    //var_dump($rows);
    // Cierra la consulta
    $result->close();


    //Analisis de REQUEST_URI
    $arr = explode("/",$_SERVER['REQUEST_URI']);
    echo json_encode($arr, JSON_PRETTY_PRINT)."<br/>";

    echo end($arr) > 0 ? "Es mayor a cero" : "No es mayor a cero";

    $bodyRequest = file_get_contents("php://input");

    $array = json_decode($bodyRequest,true);
    $array_keys = array_keys($array);
    $array_values = array_values($array);

    echo "Keys: <br/>";
    print_r($array_keys);
    echo "Values: <br/>";
    print_r($array_values);
    echo "RenderizeData:"."<br/>";
 	echo renderizeData($array_keys,$array_values);

    function renderizeData($keys, $values) {
      $str = '';
	  switch ($_SERVER['REQUEST_METHOD']) {
	   case 'POST':
	    # code...
	     foreach ($keys as $key => $value) {
	      if($key == count($keys) - 1) {
	       $str = $str . $value . ") VALUES (";

	       foreach ($values as $key => $value) {
	        if($key == count($values) - 1) {
	         $str = $str . "'" . $value . "')";
	        } else {
	         $str = $str . "'" . $value . "',";
	        }
	        
	       }
	      } else {
	       if($key == 0) {
	        $str = $str . "(" . $value . ",";
	       } else {
	        $str = $str . $value . ",";
	       }
	       
	      }
	     }

	     return $str;
	    break;
	   case 'PUT':
	    foreach ($keys as $key => $value) {
	     if($key == count($keys) - 1) {
	      $str = $str . $value . "='" . $values[$key] . "'"; 
	     } else {
	      $str = $str . $value . "='" . $values[$key] . "',"; 
	     }
	    }
	    return $str;
	    break;
  }}
?>