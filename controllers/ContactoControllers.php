<?php

header("Access-Control-Allow-Origin: *"); // permite al navegador que acepte cualquier host
header("Content-Type: application/json; charset=UTF-8"); // encabezado para que se expecifique que las respuestas son json
header("Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS"); // definir los metodos que se usarán
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With"); // permite enviar json

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { // Si el navegador envía una petición de prueba (OPTIONS), responde OK y termina 
    http_response_code(200);
    exit();
}

// importamos la dirección de los archivos importantes
require_once("../config/Database.php"); // la conexion con la base de datos
require_once("../models/Contacto.php"); // el modelo donde tenemos los metodos

// instanciamos 
$database = new Database(); // base de datos
$conexion = $database->Conexion();
$contacto = new Contacto($conexion); // instanciamos el modelo y pasamos por medio del constructor la conexión con la base de datos para poder acceder a las consultas correctamente

$metodo = $_SERVER['request_method']; // variable para obtener la petición en el HTTPS y saber que hacer

if($metodo == "GET"){

}
else if($metodo == "POST"){

}
else if($metodo == "DELETE"){

}
else{
    
}
?>