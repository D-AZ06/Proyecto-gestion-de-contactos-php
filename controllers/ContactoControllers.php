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

        // validamos que el get viene para consultar por parametros y así saber a que metodo llamar
        $validarParametro = isset($_GET['nombre']);
        $validarParametro2 = !empty($_GET['nombre']);
        
        if($validarParametro==true and $validarParametro2==true){ // se van a consultar por parametros
            
            $nombreContacto = $contacto->consultarPorParametro($_GET['nombre']);
            $nombreContacto = $nombreContacto->fetchAll(PDO::FETCH_ASSOC);

            $nombreNoEncontrado = $contacto->validarRegistrosVacios($nombreContacto);

            if($nombreNoEncontrado==false){ 
                echo json_encode($nombreContacto);
            }
            else{ 
                echo json_encode(["mensaje" => "No se encontraron contactos con ese nombre"]);
            }
        }

        else{ // como no es una consulta parametrizada, se obtienen todos los contactos
            
            $conctactosObtenidos = $contacto->obtenerContactos(); // obtenemos los conctatos con el metodo en el model y la conexión en la bd
            $conctactosObtenidos = $conctactosObtenidos->fetchAll(PDO::FETCH_ASSOC); // convertimos la misma variable en un arreglo para guardar mejor la información

            $registroVacio = $contacto->validarRegistrosVacios($conctactosObtenidos); // validamos que no esté vacio y haya al menos 1 registro

            if($registroVacio==false){ // si no hay registros vacios
                echo json_encode($conctactosObtenidos);
            }
            else{ // si, si hay registros vacios
                echo json_encode(["mensaje" => "No se encontraron contactos"]);
            }
            
        }

    }
    else if($metodo == "POST"){

    }
    else if($metodo == "DELETE"){

    }
    else{

    }
?>