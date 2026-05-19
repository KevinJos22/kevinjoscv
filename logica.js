document.addEventListener("DOMContentLoaded", () => {

    // --- 1. MODO OSCURO ---
    const btnTheme = document.querySelector('#theme-toggle');
    const body = document.body;

    const temaGuardado = localStorage.getItem('theme');
    if (temaGuardado === 'dark') {
        body.classList.add('dark-mode');
        if (btnTheme) btnTheme.textContent = "☀️";
    }

    btnTheme?.addEventListener('click', () => {
        body.classList.toggle('dark-mode');
        const esOscuro = body.classList.contains('dark-mode');
        localStorage.setItem('theme', esOscuro ? 'dark' : 'light');
        btnTheme.textContent = esOscuro ? "☀️" : "🌙";
    });

    // --- 2. FORMULARIO Y VALIDACIONES ---
    const form = document.getElementById("formContacto"); // Coincide con el ID del nuevo contacto.php
    if (form) {
        const nombre = document.getElementById("nombre");
        const email = document.getElementById("email");
        const cedula = document.getElementById("cedula");
        const telefono = document.getElementById("telefono");

        // Restringir a solo números en tiempo real
        [cedula, telefono].forEach(input => {
            input.addEventListener("input", () => {
                input.value = input.value.replace(/\D/g, "").slice(0, 10);
            });
        });

        form.addEventListener("submit", (e) => {
            e.preventDefault();

            // Limpiar errores visuales previos (si usas los spans)
            document.querySelectorAll('.msj-error').forEach(el => el.textContent = "");

            // Validación de Cédula
            if (!validar_cedula(cedula.value)) {
                mostrarError(cedula, "Cédula ecuatoriana inválida", "error-cedula");
                return;
            }

            // Validación de Teléfono
            if (telefono.value.length < 10) {
                mostrarError(telefono, "El teléfono debe tener 10 dígitos", "error-telefono");
                return;
            }

            // --- ENVÍO AJAX (FETCH) ---
            const datos = new FormData(form);

            fetch('guardar_contacto.php', {
                method: 'POST',
                body: datos
            })
            .then(res => res.text())
            .then(respuesta => {
                alert("¡Formulario enviado correctamente! 🚀\n" + respuesta);
                form.reset();
            })
            .catch(error => {
                console.error("Error:", error);
                alert("Hubo un error al enviar los datos.");
            });
        });
    }

    // --- 3. FUNCIONES DE APOYO ---

    function mostrarError(input, mensaje, spanId) {
        // Opción A: Usar los span que pusimos en el HTML
        const span = document.getElementById(spanId);
        if (span) {
            span.textContent = mensaje;
        } else {
            // Opción B: Usar globos nativos del navegador como respaldo
            input.setCustomValidity(mensaje);
            input.reportValidity();
            input.setCustomValidity(""); 
        }
    }

    function validar_cedula(ced) {
        if (!/^\d{10}$/.test(ced)) return false;
        let digitos = ced.split('').map(Number);
        let provincia = parseInt(ced.substring(0, 2));
        if (provincia < 1 || provincia > 24) return false;

        let suma = 0;
        for (let i = 0; i < 9; i++) {
            let valor = digitos[i] * (i % 2 === 0 ? 2 : 1);
            if (valor > 9) valor -= 9;
            suma += valor;
        }
        let total = (10 - (suma % 10)) % 10;
        return total === digitos[9];
    }
});

// --- 4. ANIMACIONES DE SCROLL ---
const animarReveal = () => {
    const elementos = document.querySelectorAll(".reveal");
    elementos.forEach((el) => {
        const posicion = el.getBoundingClientRect().top;
        if (posicion < window.innerHeight - 100) {
            el.classList.add("active");
        }
    });
};

window.addEventListener("scroll", animarReveal);
window.addEventListener("load", animarReveal);

console.log("Bienvenido al portafolio de Melany 🚀");