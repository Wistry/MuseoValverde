document.addEventListener("DOMContentLoaded", function () {
    let registerForm = document.querySelector("form.RegistrarUser");

    registerForm.addEventListener("submit", function (event) {
        event.preventDefault();
        clearErrorMessages();

        // Obtener referencias a los campos de usuario y contraseña
        let nombreInput = document.querySelector("#nombre");
        let usuarioInput = document.querySelector("#usuario");
        let contrasenaInput = document.querySelector("#contrasena");
        let confirmarContrasenaInput = document.querySelector("#confirmar_contrasena");
        let emailInput = document.querySelector("#email");
        let telefonoInput = document.querySelector("#telefono");
    
        // Obtener los valores de los campos
        let nombre = nombreInput.value.trim();
        let usuario = usuarioInput.value.trim();
        let contrasena = contrasenaInput.value.trim();
        let confirmarContrasena = confirmarContrasenaInput.value.trim();
        let email = emailInput.value.trim();
        let telefono = telefonoInput.value.trim();
    
        // Mensaje de error
        let mensajeError = document.createElement("strong");
        mensajeError.style.color = "red";

        // Validar si algún campo está vacío
        if (nombre === ""){
            mensajeError.textContent = "Por favor, ingrese un nombre.";
            nombreInput.parentElement.insertBefore(mensajeError, nombreInput);
            return; 
        } else if (usuario === "") {
            mensajeError.textContent = "Por favor, ingrese un nombre de usuario.";
            usuarioInput.parentElement.insertBefore(mensajeError, usuarioInput);
            return; 
        } else if (contrasena === "") {
            mensajeError.textContent = "Por favor, ingrese una contraseña.";
            contrasenaInput.parentElement.insertBefore(mensajeError, contrasenaInput);
            return; 
        } else if (confirmarContrasena === "") {
            mensajeError.textContent = "Por favor, confirme su contraseña.";
            confirmarContrasenaInput.parentElement.insertBefore(mensajeError, confirmarContrasenaInput);
            return; 
        } else if (email === "") {
            mensajeError.textContent = "Por favor, ingrese un correo electrónico.";
            emailInput.parentElement.insertBefore(mensajeError, emailInput);
            return; 
        } else if (telefono === "") {
            mensajeError.textContent = "Por favor, ingrese un número de teléfono.";
            telefonoInput.parentElement.insertBefore(mensajeError, telefonoInput);
            return; 
        }

        // Validar si las contraseñas no coinciden
        if (contrasena !== confirmarContrasena) {
            mensajeError.textContent = "Las contraseñas no coinciden.";
            confirmarContrasenaInput.parentElement.insertBefore(mensajeError, confirmarContrasenaInput);
            return; 
        }

        // Validar si es un email valido
        if (!email.includes("@")) {
            mensajeError.textContent = "Por favor, ingrese un correo electrónico válido.";
            emailInput.parentElement.insertBefore(mensajeError, emailInput);
            return; 
        }
        
        //Validar si es un numero de telefono valido
        if (telefono.length != 9 || isNaN(telefono)) {
            mensajeError.textContent = "Por favor, ingrese un número de teléfono válido. Ejemplo 555555555";
            telefonoInput.parentElement.insertBefore(mensajeError, telefonoInput);
            return; 
        }
        registerForm.submit();
    }); 

    // Función para eliminar todos los mensajes de error existentes
    function clearErrorMessages() {
        let mensajesError = document.querySelectorAll("strong");
        mensajesError.forEach(function (mensaje) {
            mensaje.remove();
        });
    }
});
