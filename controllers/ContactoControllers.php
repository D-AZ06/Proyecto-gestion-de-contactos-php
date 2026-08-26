<?php
    header("Access-Control-Allow-Origin: *"); // permite al navegador que acepte cualquier host
    header("Content-Type: application/json; charset=UTF-8"); // encabezado para que se expecifique que las respuestas son json
    header("Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS"); // definir los metodos que se usarán
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With"); // permite enviar json

    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS'){ // Si el navegador envía una petición de prueba (OPTIONS), responde OK y termina 
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

    $metodo = $_SERVER['REQUEST_METHOD']; // variable para obtener la petición en el HTTPS y saber que hacer

    if($metodo == "GET"){ // metodo get para recibir o consultar la información en la bd

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

    else if($metodo == "POST"){ // metodo post para guardar la información en la bd
        
        $datosRecibidos = file_get_contents("php://input"); // recibimos el input del https
        $datosRecibidos = json_decode($datosRecibidos); // lo convertimos a JSON

        // extraemos cada dato individualmente de lo que se va a guardar
        $nombreContacto = $datosRecibidos->nombreContacto; 
        $telefonoContacto = $datosRecibidos->telefonoContacto;
        $correoContacto = $datosRecibidos->correoContacto;

        // variables para validar los campos y llamar sus respectivos metodos
        $camposVacios = $contacto->validarCamposVacios($nombreContacto, $telefonoContacto, $correoContacto); // llamamos al metodo que valida los campos vacios
        $telefonoValido = $contacto->validarTelefono($telefonoContacto); // validamos el numero de telefono
        $correoValido = $contacto->validarCorreo($correoContacto);
        $telefonoRepetido = $contacto->numeroExistente($telefonoContacto);
        $correoRepetido = $contacto->correoExistente($correoContacto);
        
        if($camposVacios==false){ // si no hay campos vacios continuamos
            
            if($telefonoValido == true){ // si el telefono es valido continuamos
                
                if($correoValido==true){ // si el correo es valido continuamos
                    
                    if($telefonoRepetido==false){ // si el número de telefono no está repetido continuamos

                        if($correoRepetido==false){ // si el correo no está repetido finalmente guardamos

                            http_response_code(201); // código de estado https para mostrar que todo salió bien
                            $contactosGuardados = $contacto->guardarContactos($nombreContacto, $telefonoContacto, $correoContacto); // llamamos el metdo
                            echo json_encode($contactosGuardados);
                        }

                        else{ // correo repetido
                            http_response_code(400); // codigo de estado https para mostrar mensaje de advertencia al usuario
                            echo json_encode(["mensaje" => "el correo ingresado ya se encuentra guardado"]);
                        }
                    }
                    else{ // número de telefono repetido
                        http_response_code(400); // codigo de estado https para mostrar mensaje de advertencia al usuario
                        echo json_encode(["mensaje" => "el número ingresado ya se encuentra guardado"]);
                    }  
                }
                else{ // correo no valido
                    http_response_code(400); // codigo de estado https para mostrar mensaje de advertencia al usuario
                    echo json_encode(["mensaje" => "el correo ingresado es invalido"]);
                }
            }
            else{ // numero de telefono no valido
                http_response_code(400); // codigo de estado https para mostrar mensaje de advertencia al usuario
                echo json_encode(["mensaje" => "número de telefono invalido"]);
            }
        }
        else{ // campos vacios
            http_response_code(400); // codigo de estado https para mostrar mensaje de advertencia al usuario
            echo json_encode(["mensaje" => "por favor, llene todos los campos correspondientes"]);
        }
    }
    else if($metodo == "DELETE"){

    }
    else{

    }
?>