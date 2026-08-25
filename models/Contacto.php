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

    
}
?>