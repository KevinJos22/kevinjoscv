<?php include 'includes/header.php';?>

<section class="hero">
    <div class="hero-content">
        <h1>Certificados</h1>
        <p>Sube tus logros académicos y profesionales aquí.</p>

        <form action="subir_archivo.php" method="POST" enctype="multipart/form-data" class="upload-form">
            
            <input type="text" id="nombre_certificado" name="nombre_certificado" placeholder="Nombre del certificado" required>
            
            <input type="file" id="archivo_input" name="archivo_certificado" accept=".pdf, .jpg, .png" style="display: none;" onchange="document.getElementById('file-chosen').textContent = this.files[0].name">
            
            <div class="file-select-group">
                <label for="archivo_input" class="btn-secondary">Seleccionar Archivo</label>
                <span id="file-chosen">Ningún archivo seleccionado</span>
            </div>

            <button type="submit" class="btn-primary" name="subir_archivo">Subir Certificado</button>
        </form>
    </div>
    <img src="ASSETS/img/fotoperfil2.jpeg" alt="Kevin Ontaneda" class="profile-img">
</section>

<section class="content-container">
    <h2 style="text-align: center; margin-bottom: 30px;">Mis Certificados Cargados</h2>
    
    <div class="skills-grid">
        <?php
        $directorio = "uploads/";
        
        // Verificamos si existe la carpeta antes de intentar leerla
        if (is_dir($directorio)) {
            // Escaneamos el directorio y quitamos las referencias a carpetas ('.' y '..')
            $archivos = array_diff(scandir($directorio), array('.', '..'));
            
            if (count($archivos) > 0) {
                // Si hay archivos, creamos una card por cada uno
                foreach ($archivos as $archivo) {
                    echo '
                    <div class="card" style="width: 250px; text-align: center; display: flex; flex-direction: column; align-items: center;">
                        <i class="fas fa-file-pdf" style="font-size: 2.5rem; color: var(--accent); margin-bottom: 15px;"></i>
                        <h4 style="margin: 0 0 10px 0; word-break: break-all;">' . htmlspecialchars($archivo) . '</h4>
                        <a href="' . $directorio . $archivo . '" target="_blank" class="btn-primary" style="padding: 8px 20px; font-size: 0.9rem;">Ver Archivo</a>
                    </div>';
                }
            } else {
                echo '<p style="text-align: center; width: 100%;">No has subido ningún certificado aún.</p>';
            }
        } else {
            echo '<p style="text-align: center; width: 100%;">La carpeta de almacenamiento aún no está creada.</p>';
        }
        ?>
    </div>
</section>

<?php include 'includes/footer.php';?>