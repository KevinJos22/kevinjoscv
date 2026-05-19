<?php include 'includes/header.php';?>

<section class="content-container">
    <div class="form-container">
        <h1 style="text-align: center;">Contáctame</h1>
        <p style="text-align: center;">Completa el formulario para comunicarte conmigo</p>

        <form id="formContacto">
            <div class="form-group">
                <label for="nombre">Nombre Completo</label>
                <input type="text" id="nombre" name="nombre" placeholder="Ej. Carlos Viteri" required>
                <span id="error-nombre" class="msj-error"></span>
            </div>

            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" placeholder="Ej. correo@gmail.com" required>
                <span id="error-email" class="msj-error"></span>
            </div>

            <div class="form-group">
                <label for="cedula">Cédula</label>
                <input type="text" id="cedula" name="cedula" maxlength="10" placeholder="10 dígitos" required>
                <span id="error-cedula" class="msj-error"></span>
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" id="telefono" name="telefono" maxlength="10" placeholder="10 dígitos" required>
                <span id="error-telefono" class="msj-error"></span>
            </div>

            <div class="form-group">
                <label for="mensaje">Mensaje (opcional)</label>
                <textarea id="mensaje" name="mensaje" rows="4" placeholder="Cuéntame..."></textarea>
                <span id="error-mensaje" class="msj-error"></span>
            </div>

            <button type="submit" id="enviar" class="btn-submit">Enviar Mensaje</button>
        </form>
    </div>
</section>

<?php include 'includes/footer.php';?>