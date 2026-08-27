<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Gestión de Contactos</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>
    <body>
        <script src="../main.js" async defer></script>

        <header>
            <h1>Gestión de Contactos <i class="bi bi-clipboard-minus"></i> </h1> 
        </header>

        <nav>
            <a href="#contactos" class="btn-navegacion">
                Lista contactos
                <i class="bi bi-person"></i>
            </a>
                
            <a href="#agregar" class="btn-navegacion">
                Agregar contactos
                <i class="bi bi-person-add"></i>
            </a>
        </nav>

        <main>

            <section id="contactos">
                <h2>Lista de Contactos</h2>
                <div class="buscarContacto">
                    <p>Buscar Contacto</p>
                    <input type="text" id="buscarNombre" placeholder="Buscar por nombre">
                    <button id="buscar">
                        Buscar 
                        <i class="bi bi-search"></i>
                    </button>
                </div>
                <div>
                    <table>
                        <thead>
                            <tr>
                                <th> <i class="bi bi-person-vcard"></i> Nombre</th>
                                <th> <i class="bi bi-telephone"></i> Teléfono</th>
                                <th> <i class="bi bi-envelope"></i> Correo</th>
                                <th> <i class="bi bi-pencil-square"></i> Acciones</th>
                            </tr>
                        </thead>    
                        <tbody id="tablaContactos"></tbody>
                    </table>
                </div>

            </section>     

            <section id="agregar">
                <div class="cardAgregar">
                    <h2>Agregar Contactos</h2>

                    <p>Nombre</p> <input type="text" id="ingresarNombre" placeholder="ingresa el nombre">
                    <p>Telefono</p> <input type="tel" id="ingresarTelefono" placeholder="ingresa el número de telefono">
                    <p>Correo</p> <input type="email" id="ingresarCorreo" placeholder="ingresa el correo">
                    <button id="guardarContacto">
                        Guardar Contacto
                    </button>
                </div>
            </section>
        </main>

    </body>
</html>