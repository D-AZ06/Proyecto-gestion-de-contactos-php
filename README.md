# Proyecto gestión de contactos con PHP
Aplicación web de gestión de contactos desarrollada bajo arquitectura **MVC en PHP** y un **frontend en ReactJS** 
permite registrar, listar, filtrar y eliminar contactos 

**Estado del proyecto:** Actualmente solo permite la visualización de los contactos registrados, sin embargo el backend con el resto de la lógica está desarrollado


---

# Requisitos y versiones:
**1. Servidor Web:** Apache (XAMPP v 3.3.0)

**2. Base de Datos:** MySQL Ver 15.1 Distrib 10.4.32-MariaDB

**3. Backend:**  PHP V 8.2.12

**4. Frontend:** HTML5, CSS3, JavaScript(ES6+), Bootstrap Icons (y ReactJS)


---

# Instrucciones para la instalación

1. **Clonar el repositorio**:
  Abre la terminal de comando y ejecuta:
  git clone https://github.com/D-AZ06/Proyecto-gestion-de-contactos-php.git

2. **Mover la carpeta del proyecto al directorio de tu servidor local(XAMMP)**:
  Copia o mueve la carpeta del proyecto dentro del directorio de tu servidor XAMPP
  C:\xampp\htdocs\Proyecto-gestion-de-contactos-ph
  Además de asegurarse que el servidor esté activado desde XAMMP CONTROL PANEL

3. **Configurar la base de datos**:
  Abre tu navegador e ingresa a phpMyAdmin (http://localhost/phpmyadmin), crea una nueva base de datos llamada: gestion_contactos
  Después haces clic en la pestaña Importar y selecciona el archivo SQL ubicado en la raíz del proyecto: script.sql

4. *Abrir la aplicación en el navegador*:
  Una vez configurado todo, ingresa a la siguiente dirección en el navegador:
  http://localhost/Proyecto-gestion-de-contactos-php

Con esto ya puedes visualizar el proyecto


---

# Estructura del Proyecto (MVC)
├── config/        # Configuración de conexión a la base de datos

├── controllers/   # Lógica de negocio y manejo de peticiones

├── models/        # Interacción con la base de datos (Consultas SQL)

├── views/         # Interfaz de usuario (HTML/JS/React)

├── script.sql     # Script de creación de la base de datos y tablas

└── index.php      # Punto de entrada de la aplicación
