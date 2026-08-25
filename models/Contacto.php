<?php
Class Contacto{
    
    private $conexion;
    private $tablas = "contactos";

    public $idContacto;
    public $nombreContacto;
    public $telefonoContacto;
    public $correoContacto;

    public function __construct($db) // constructor de la base de datos
    {
        $this->conexion = $db;
    }

    public function obtenerContactos(){ // Metodo para obtener los contactos
        
        $cmdSQL = "select * from". $this->tablas; // variable para la consulta sql

        $registro = $this->conexion -> prepare($cmdSQL); //sentencia PDO

        $registro->execute(); // ejecuta la consulta

        return $registro; // retorna los resultados
    }
}
?>