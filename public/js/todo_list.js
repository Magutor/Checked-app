(() => {
    'use strict'

    // Obtener el formulario
    const form = document.getElementById('todoForm')

    form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
            event.preventDefault()  // Evita el envío si inválido
            event.stopPropagation()
        }
        form.classList.add('was-validated')  // Añade estilos Bootstrap de validación
    }, false)
})();