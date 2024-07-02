document.addEventListener("DOMContentLoaded", function () {
    // Función para mostrar mensajes de error
    function mostrarError(elemento, mensaje) {
        let mensajeError = document.createElement("p");
        mensajeError.style.color = "red";
        mensajeError.style.fontSize = "14px"; 
        mensajeError.textContent = mensaje;
        elemento.parentElement.insertBefore(mensajeError, elemento);
    }

    // Función para eliminar mensajes de error
    function eliminarErrores(formulario) {
        let mensajesError = formulario.querySelectorAll("p");
        mensajesError.forEach(function (mensaje) {
            mensaje.remove();
        });
    }

    // Validar formulario de añadir obra
    let formAniadirObra = document.getElementById("form-aniadir-obra");
    formAniadirObra.addEventListener("submit", function (event) {
        event.preventDefault();
        eliminarErrores(formAniadirObra);

        let tituloInput = document.getElementById("tituloaniadir");
        let autorInput = document.getElementById("autoraniadir");
        let fechaInput = document.getElementById("fechaaniadir");
        let descripcionInput = document.getElementById("descripcionaniadir");
        let rutaInput = document.getElementById("rutaaniadir");
        let temaInput = document.getElementById("temaaniadir");

        let titulo = tituloInput.value.trim();
        let autor = autorInput.value.trim();
        let fecha = fechaInput.value.trim();
        let descripcion = descripcionInput.value.trim();
        let ruta = rutaInput.value.trim();
        let tema = temaInput.value.trim();

        if (titulo === "") {
            mostrarError(tituloInput, "Por favor, ingrese un título.");
            return;
        }
        else if (autor === "") {
            mostrarError(autorInput, "Por favor, ingrese un autor.");
            return;
        }
        else if (fecha === "") {
            mostrarError(fechaInput, "Por favor, ingrese una fecha.");
            return;
        }
        else if (descripcion === "") {
            mostrarError(descripcionInput, "Por favor, ingrese una descripción.");
            return;
        }
        else if (ruta === "") {
            mostrarError(rutaInput, "Por favor, seleccione una foto.");
            return;
        }
        else if (tema === "") {
            mostrarError(temaInput, "Por favor, ingrese un tema.");
            return;
        }

        //Validar fecha
        let regexFecha = /^\d{4}-\d{2}-\d{2}$/;
        if (!regexFecha.test(fecha)) {
            mostrarError(fechaInput, "Por favor, ingrese una fecha correcta. EJEMPLO: 2001-01-17 ");
            return;
        }
        formAniadirObra.submit();
    });

    // Validar formulario de modificar obra
    let formModificarObra = document.getElementById("form-modificar-obra");
    formModificarObra.addEventListener("submit", function (event) {
        event.preventDefault();
        eliminarErrores(formModificarObra);

        let fechaInput = document.getElementById("fecha");
        let fecha = fechaInput.value.trim();

        let regexFecha = /^\d{4}-\d{2}-\d{2}$/;
        if (!regexFecha.test(fecha) && fecha !== "") {
            mostrarError(fechaInput, "Por favor, ingrese una fecha correcta. EJEMPLO: 2001-01-17 ");
            return;
        }
        formModificarObra.submit();
    });
});
