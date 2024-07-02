document.addEventListener("DOMContentLoaded", function () {
    let loginForm = document.querySelector("form.Registro");

    loginForm.addEventListener("submit", function (event) {
        event.preventDefault();

        // Obtener referencias a los campos de usuario y contraseña
        let usuarioInput = document.querySelector("#bt1");
        let contrasenaInput = document.querySelector("#bt2");

        // Obtener los valores de los campos
        let usuario = usuarioInput.value.trim();
        let contrasena = contrasenaInput.value.trim();

        // Validar si ambos campos están completos
        if (usuario === "" || contrasena === "") {
            alert("Por favor, complete todos los campos.");
            return; 
        } else{
            loginForm.submit();
        }
    }); 
});
