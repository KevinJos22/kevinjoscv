<?php
if(isset($_POST['subir_archivo'])) {
    // 1. Capturamos el nombre personalizado del formulario
    $nombre_usuario = $_POST['nombre_certificado'];
    $archivo = $_FILES['archivo_certificado'];
    
    // 2. Limpiamos el nombre (convertimos espacios y caracteres raros en guiones bajos)
    $nombre_limpio = preg_replace("/[^a-zA-Z0-9_-]/", "_", $nombre_usuario);
    
    // 3. Obtenemos la extensión del archivo original (para que no pierda su formato)
    $extension = pathinfo($archivo["name"], PATHINFO_EXTENSION);
    
    // 4. Creamos el nombre final: NombreUsuario_Timestamp.extensión
    $nombre_final = $nombre_limpio . "_" . time() . "." . $extension;
    
    // Configuración de directorio
    $directorio_destino = "uploads/";
    
    // Crear carpeta si no existe
    if (!file_exists($directorio_destino)) {
        mkdir($directorio_destino, 0777, true);
    }
    
    $ruta_final = $directorio_destino . $nombre_final;
    $permitidos = array("pdf", "jpg", "png", "jpeg");

    // 5. Validar formato y mover el archivo
    if(in_array(strtolower($extension), $permitidos)) {
        if(move_uploaded_file($archivo["tmp_name"], $ruta_final)) {
            // Éxito
            echo "<script>alert('¡Certificado subido como: " . $nombre_final . "'); window.location='cursos.php';</script>";
        } else {
            echo "Error al subir el archivo. Revisa los permisos de la carpeta.";
        }
    } else {
        echo "Formato no permitido. Solo PDF, JPG o PNG.";
    }
}
?>