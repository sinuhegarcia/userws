<?php 
  // Incluimos el archivo de configuración el cual posee las credenciales de conexión
  include 'config.php';

  // Se crea la clase de conexión y ejecución de consultas
  class db_model {

    // Variable de conexion
    public $conn;

    // La función constructora crea y abre la conexión al momento de instanciar esta clase
    function __construct() {
      $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME); // Los parametros de la funcion mysqli() son las constantes previamente declaradas en el archivo config.php
    }

    // Funcion para obtener un array de resultados
    // Solo se usara para las consultas de tipo SELECT
    function get_query($sql) {
      // Lee la cadena SQL recibida y ejecuta la consulta
      $result = $this->conn->query($sql);

      //$total_num_rows = $result->num_rows;

      // Hace el rrecorrido por el array de datos y lo guarda en la variable $rows
      
      while ($rows[] = $result->fetch_assoc());

      //$rows = array();
      //while ($row = $result->fetch_assoc()){
      //  if($row !== null){
      //    $rows[] = $row;
      //  }
      //};

      // Cierra la consulta
      $result->close();

      // Retorna el resultado obtenido
      return $rows;
    }

    // Funcion para hacer cambios dentro de la base de datos
    // Solo se usara para las consultas de tipo INSERT, UPDATE Y DELETE
    function set_query($sql) {
      // Lee la cadena SQL recibida y ejecuta la consulta
      $result = $this->conn->query($sql);

      // Retorna el resultado
      return $result;

    }

    // La función destructora cierra la conexión previamente abierta en el constructor
    function __destruct() {
      $this->conn->close();
    }
  }
?>

