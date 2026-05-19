<?php

date_default_timezone_set('America/Guayaquil');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombre   = $_POST['nombre'] ?? 'Sin nombre';
    $email    = $_POST['email'] ?? 'Sin email';
    $cedula   = $_POST['cedula'] ?? 'Sin cédula';
    $telefono = $_POST['telefono'] ?? 'Sin teléfono';
    $mensaje  = $_POST['mensaje'] ?? 'Sin mensaje';


    $fecha = date('Y-m-d H:i:s');
    $linea = "[$fecha] | NOMBRE: $nombre | CED: $cedula | EMAIL: $email | TEL: $telefono | MSJ: $mensaje" . PHP_EOL;


    if (file_put_contents("contactos_recibidos.txt", $linea, FILE_APPEND | LOCK_EX)) {
        echo "¡Éxito! Tu mensaje ha sido registrado en el servidor.";
    } else {
        
        http_response_code(500);
        echo "Error: No se pudo escribir en el archivo de contactos.";
    }
} else {
    
    echo "Acceso no autorizado.";
}
?>