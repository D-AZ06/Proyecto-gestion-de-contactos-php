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
        
        try{
            $cmdSQL = "select * from ". $this->tablas; // variable para la consulta sql

            $registro = $this->conexion -> prepare($cmdSQL); //sentencia PDO para preparar la consulta

            $registro->execute(); // ejecuta la consulta

            return $registro;
        }
        
        catch(Exception $excepcion){ // catch por si falla durante la consulta

            error_log("Error durante la consulta para obtener los contactos". $excepcion->getMessage());
            return false;
        }
    }

    public function guardarContactos(){ // Metodo para guardar contactos

        try{
            $cmdSQL = "insert into ". $this->tablas. " (nombreContacto, telefonoContacto, correoContacto) values 
            (:nombreContacto, :telefonoContacto, :correoContacto)";

            $registro = $this->conexion -> prepare($cmdSQL);

            // asociamos los parametros de la consulta junto con los del objeto
            $registro->bindParam(":nombreContacto", $this->nombreContacto);
            $registro->bindParam(":telefonoContacto", $this->telefonoContacto);
            $registro->bindParam(":correoContacto", $this->correoContacto);

            $registro->execute();

            return $registro;
        }
        
        catch(Exception $excepcion){
            
            error_log("Error para guardar contactos". $excepcion->getMessage());
            return false;
        }
    }

    public function eliminarContacto(){
        
        try{
            $cmdSQL = "delete from ". $this->tablas. " where idContacto = :idContacto";

            $registro = $this->conexion -> prepare($cmdSQL);

            $registro->bindParam(":idContacto", $this->idContacto);

            $registro->execute();

            return $registro;
        }

        catch(Exception $excepcion){

            error_log("Error al eliminar el contacto". $excepcion->getMessage());
            return false;
        }
    }
}
?>