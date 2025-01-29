# Proyecto PHP Puro

## 🔥 PHP Versión 8.2.12 y PostgreSQL Versión 16.3 🔥

Este documento proporciona una guía paso a paso para configurar y ejecutar un proyecto PHP puro utilizando XAMPP y PostgreSQL como base de datos.

## Requisitos Previos
Antes de comenzar, asegúrate de tener instalados los siguientes programas en tu sistema:

1. [XAMPP](https://www.apachefriends.org/es/index.html) (Apache y PHP)
2. [PostgreSQL](https://www.postgresql.org/download/)
3. [pgAdmin](https://www.pgadmin.org/) (Opcional, para administrar la base de datos visualmente)
4. Extensión `pdo_pgsql` habilitada en PHP

## Configuración del Entorno
### 1. Habilitar PostgreSQL en PHP
Por defecto, XAMPP no viene con PostgreSQL activado. Para habilitarlo:

1. Ve al directorio de instalación de XAMPP (`C:\xampp\php` o `/opt/lampp/etc` en Linux).
2. Abre el archivo `php.ini` con un editor de texto.
3. Busca las siguientes líneas y descoméntalas (elimina `;` al inicio si lo tienen):
   ```ini
   extension=pdo_pgsql
   extension=pgsql
   ```
4. Guarda los cambios y reinicia Apache desde el panel de control de XAMPP.

### 2. Crear la Base de Datos en PostgreSQL

1. Abre `pgAdmin` o usa `psql`.
2. Crea una nueva base de datos con el siguiente comando:
   ```sql
   CREATE DATABASE nombre_base_datos;
   ```
### 3. Configurar la Conexión en PHP
En el archivo config.php que esta en el directorio raíz del proyecto, cambia las credenciales:

```php
<?php
$host = "localhost";
$dbname = "nombre_base_datos";
$user = "usuario_contraseña";
$password = "tu_contraseña";

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    echo "Conexión exitosa a PostgreSQL.";
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
```

### 4. Iniciar el Servidor Apache con XAMPP
1. Abre el panel de XAMPP.
2. Inicia el servicio `Apache`.
3. Accede a `http://localhost/nombre_proyecto/` desde tu navegador.

### 5. Ejecutar el Proyecto
Coloca los archivos PHP en la carpeta `htdocs` de XAMPP (`C:\xampp\htdocs\nombre_proyecto` en Windows o `/opt/lampp/htdocs/nombre_proyecto` en Linux).

Para probar la conexión a la base de datos, accede a `http://localhost/nombre_proyecto/config.php`.
