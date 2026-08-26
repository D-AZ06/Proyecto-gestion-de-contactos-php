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

    /* -------------------------- METODOS PRINCIPALES ----------------------------------------------------------------------*/

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

    public function guardarContactos($nombre, $telefono, $correo){ // Metodo para guardar contactos

        try{
            $cmdSQL = "insert into ". $this->tablas. " (nombreContacto, telefonoContacto, correoContacto) values 
            (:nombreContacto, :telefonoContacto, :correoContacto)";

            $registro = $this->conexion -> prepare($cmdSQL);

            // asociamos los parametros de la consulta junto con los del objeto
            $registro->bindParam(":nombreContacto", $nombre);
            $registro->bindParam(":telefonoContacto", $telefono);
            $registro->bindParam(":correoContacto", $correo);

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

    public function consultarPorParametro($nombre){

        try{
            $cmdSQL = "select * from ". $this->tablas. " where nombreContacto like :nombreContacto";

            $registro = $this->conexion -> prepare($cmdSQL);

            $nombreParametrizado = "%". $nombre. "%";

            $registro->bindParam(":nombreContacto", $nombreParametrizado);

            $registro->execute();

            return $registro;
        }
        
        catch(Exception $excepcion){
            
            error_log("Error durante la consulta". $excepcion->getMessage());
            return false;
        }
    }

    /* -------------------------- METODOS DE VALIDACIÓN ----------------------------------------------------------------------*/

    public function validarRegistrosVacios($registro){ // validar que al menos haya información que mostrar
        
        $resultado = count($registro); // se cuenta la cantidad de registros que hay 

        if($resultado === 0){ // si no hay retorna false
            return true;
        }
        else{ // si hay retorna true
            return false;
        }
    }

    public function validarCamposVacios($nombre, $telefono, $correo){

        if($nombre==null or $telefono==null or $correo==null){
            return true;
        }
        else{
            return false;
        }
    }

    public function validarTelefono($telefono){

        if(strlen($telefono)==10 and $telefono[0]=='3'){
            return true;
        }
        else{
            return false;
        }
    }

    public function validarCorreo($correo){

        if(filter_var($correo, FILTER_VALIDATE_EMAIL)==true){
            return true;
        }
        else{
            return false;
        }
    }

    public function numeroExistente($numero){

        $cmdSQL = "select count(*) as existe from ". $this->tablas. " where numeroContacto = :numeroContacto";

        $existeNumero = $this->conexion -> prepare($cmdSQL);

        $existeNumero ->bindParam(":numeroContacto", $numero);

        $existeNumero->execute();

        $existe =  $existeNumero->fetch(PDO::FETCH_ASSOC);

        if ($existe['existe'] > 0){ // si el número ya está registrado
            return true;  
        } 
        else{ // el número está disponible
            return false; 
        }
    }

    public function correoExistente($correo){

        $cmdSQL = "select count(*) as existe from ". $this->tablas. " where correoContacto = :correoContacto";

        $existeCorreo = $this->conexion -> prepare($cmdSQL);

        $existeCorreo ->bindParam(":correoContacto", $correo);

        $existeCorreo->execute();

        $existe =  $existeCorreo->fetch(PDO::FETCH_ASSOC);

        if ($existe['existe'] > 0){ // si el correo ya está registrado
            return true;  
        } 
        else{ // el correo está disponible
            return false; 
        }
    }
}
?>