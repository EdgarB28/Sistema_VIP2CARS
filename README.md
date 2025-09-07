1. Nombre del proyecto

VIP2CARS - Sistema CRUD de Vehículos y Clientes

2. Descripción

Este proyecto es un sistema web desarrollado en PHP para registrar y gestionar información de vehículos y sus Clientes asociados, perteneciente a la empresa automotriz VIP2CARS. Permite:

Registrar, modificar y eliminar datos de vehículos y clientes.

Mantener un historial organizado de los vehículos de la empresa.

Acceder a la información de manera rápida y segura.

3. Requisitos

-PHP >= 8.0
-Composer
-Servidor web (XAMPP, WAMP, etc.)
-Base de datos MySQL o
-Extensiones PHP habilitadas [PHP.ini] (obligatroio)
    *pdo_mysql
    *fileinfo
    *mbstring
    *zip

4. Instalación
    4.1. Clonar el repositorio
    4.2. Instalar dependencias con Composer -> composer install
    4.2. Configurar la base de datos -> Copia el archivo de ejemplo .env.example y renómbralo a .env
    4.3. Configurar conexión a la base de datos en el archivo config.php
    4.4. Levantar el servidor local y acceder al proyecto

5. Tecnologías utilizadas
-PHP
-Laravel
-MySQL
-HTML/CSS/Bootstrap 
-JavaScript / jQuery 

6. Consideraciones Adicionales:
-El php.ini del disco "C" debe estar descomentado los siguientes valores : 
fileinfo , mysqli , mysqlnd, pdo_mysql, git