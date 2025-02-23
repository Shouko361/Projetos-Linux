document.addEventListener("DOMContentLoaded", function () {
    // Alternar visibilidade da senha
    document.querySelectorAll(".toggle-password").forEach(button => {
        button.addEventListener("click", function () {
            const inputId = this.getAttribute("data-target");
            const passwordField = document.getElementById(inputId);
            const icon = this.querySelector("i");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.remove("bi-eye-slash");
                icon.classList.add("bi-eye");
            } else {
                passwordField.type = "password";
                icon.classList.remove("bi-eye");
                icon.classList.add("bi-eye-slash");
            }
        });
    });

    // Gerar senha aleatória
    document.querySelectorAll(".generate-password").forEach(button => {
        button.addEventListener("click", function () {
            const inputId = this.getAttribute("data-target");
            const passwordField = document.getElementById(inputId);

            const chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()";
            let password = "";
            for (let i = 0; i < 32; i++) {
                password += chars.charAt(Math.floor(Math.random() * chars.length));
            }

            passwordField.value = password;
        });
    });
});
