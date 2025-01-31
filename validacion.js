document.addEventListener("DOMContentLoaded", function() {
    // Obtener el formulario
    const form = document.querySelector('form');

    // Función para mostrar mensajes de error
    function mostrarError(message) {
        const errorDiv = document.createElement('div');
        errorDiv.classList.add('error');
        errorDiv.textContent = message;
        document.body.insertBefore(errorDiv, form);
        setTimeout(() => {
            errorDiv.remove();
        }, 5000);
    }

    // Función para validar el formulario antes de enviarlo
    form.addEventListener('submit', function(event) {
        // Evitar el envío del formulario
        event.preventDefault();

        // Limpiar mensajes de error previos
        const errores = document.querySelectorAll('.error');
        errores.forEach(error => error.remove());

        // Obtener los valores del formulario
        const nombre = document.querySelector('input[name="nombre"]').value.trim();
        const correo = document.querySelector('input[name="correo"]').value.trim();
        const edad = document.querySelector('input[name="edad"]').value.trim();
        const planBase = document.querySelector('select[name="plan_base"]').value;
        const paquetes = Array.from(document.querySelectorAll('select[name="paquetes[]"] option:checked'))
                               .map(option => option.value);
        const duracion = document.querySelector('select[name="duracion"]').value;

        // Validación de nombre
        if (nombre === '') {
            mostrarError('El nombre no puede estar vacío.');
            return;
        }

        // Validación de correo
        const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (!emailRegex.test(correo)) {
            mostrarError('Por favor, ingresa un correo electrónico válido.');
            return;
        }

        // Validación de edad 
        if (edad < 18) {
            if (!paquetes.includes('Infantil')) {
                mostrarError('Los menores de 18 años solo pueden contratar el paquete Infantil.');
                return;
            }
        }

        // Validación de paquetes
        if (planBase === "Básico" && paquetes.length > 1) {
            mostrarError('El plan Básico solo permite un paquete adicional.');
            return;
        }

        if (duracion === "Mensual" && paquetes.includes("Deporte")) {
            mostrarError('El paquete Deporte solo puede ser contratado si la duración es de 1 año.');
            return;
        }

        // Si todo está bien, enviamos el formulario
        form.submit();
    });
});
