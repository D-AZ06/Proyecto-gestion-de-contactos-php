/* 
1. FETCH = metodo para recibir peticiones del https (GET, POST) y devuelve un promise
2. THEN = es que le recibe el promise de FECHT 
        1- El primero recibe la respuesta cruda
        2- El segundo lo transforma en formato legigle(JSON)
3. innerHTML = propiedad para leer o cambiar contenido en un html 
4. forEach = metodo para recorrer arreglos
5. `` = se usa `` en vez de '' para poder interpolar valores
6. += = permite no solo asígnar sino acumular
*/

fetch('../../controllers/ContactoControllers.php') // obtiene la solicitud del https para mandarla a la api/controlador php
    .then(respuesta=>respuesta.json()) // primero recibe la respuesta del https y la convirte en formato json
    .then(contactos=>{ // segundo usa los datos ya convertidos
        console.log(contactos); // obtenemos la lista de contactos de controllers

        // asignamos a la variable tabla el id de nuestra tabla en el html
        const tabla = document.getElementById('tablaContactos');

        tabla.innerHTML = ''; // dejamos la tabla del html limpia antes de iniciar

        if(contactos.length()===0){
            tabla.innerHTML = `
                <tr>
                    <td colspan="4" style="text-align: center;">
                    No hay contactos registrados
                    </td>
                </tr>
            `;
        }
        else {
            contactos.forEach(contacto => {
                tabla.innerHTML += `
                    <tr>
                        <td>${contacto.nombreContacto}</td>
                        <td>${contacto.telefonoContacto}</td>
                        <td>${contacto.correoContacto}</td>
                        <td><button><i class="bi bi-trash"></i></button></td>
                    </tr>
                `;    
            });
        }
});