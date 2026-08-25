<?php
header("Content-Type: application/json"); // encabezado para que se expecifique que las respuestas son json

class Database{
    
    private $host = "localhost";
    private $db = "contactos";
    private $usuario = "root";
    private $contraseña = "";
    public $conexion;

    public function Conexion(){
        
        $this -> conexion = null;

        try {
            $dns = "mysql:host=". $this->host. ";port=3306;dbname=". $this->db. ";charset=utf8"; // cadena de conexión, host, puerto, nombre db y codificación
            $this -> conexion = new PDO($dns, $this->usuario, $this->contraseña); // instancia dns, usuario y contraseña
        }

        catch(PDOException $excepcion){
            echo json_encode(["Error" => "Error en la conexión". $excepcion->getMessage()]);
        }

        return $this -> conexion; 
    }
}
?>