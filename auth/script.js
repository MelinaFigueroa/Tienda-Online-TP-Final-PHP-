document.addEventListener('DOMContentLoaded', function () {
    // Manejo de formulario de registro
    const registerForm = document.querySelector('#registerModal form');
    registerForm.addEventListener('submit', async function (event) {
        event.preventDefault();
        const formData = new FormData(registerForm);
        try {
            const response = await fetch(registerForm.action, {
                method: 'POST',
                body: formData
            });
            const result = await response.json();
            if (result.success) {
                window.location.href = '../pages/home.php';
                alert(result.success || 'Registro exitoso, en breve sera redireccionado al inicio.');
            } else {
                alert(result.error || 'Error desconocido.');
            }
        } catch (error) {
            console.error('Error al registrar:', error);
            alert('Error desconocido. Por favor, intenta nuevamente más tarde.');
        }
    });

    // Manejo de formulario de login
    const loginForm = document.querySelector('#loginModal form');
    loginForm.addEventListener('submit', async function (event) {
        event.preventDefault();
        const formData = new FormData(loginForm);
        try {
            const response = await fetch(loginForm.action, {
                method: 'POST',
                body: formData
            });
            const result = await response.json();
            if (result.success) {
                window.location.href = '../pages/home.php';
            } else {
                alert(result.error || 'Error desconocido.');
            }
        } catch (error) {
            console.error('Error al iniciar sesión:', error);
            alert('Error desconocido. Por favor, intenta nuevamente más tarde.');
        }
    });

    // Función para mostrar/ocultar contraseña
    window.togglePassword = function () {
        const passwordInput = document.getElementById('password');
        passwordInput.type = (passwordInput.type === 'password') ? 'text' : 'password';
    };

    // Función para evaluar la fortaleza de la contraseña
    window.checkPasswordStrength = function (password) {
        const passwordStrength = document.getElementById('passwordStrength');
        let strength = '';
    
        if (password.length < 6 || !/[A-Za-z]/.test(password) || !/\d/.test(password) || !/[-!@#$%^&*(),.?":{}|<>]/.test(password)) {
            strength = '<span class="text-danger">Debe tener al menos 6 caracteres, incluido al menos 1 número y 1 carácter especial (-!@#$%^&*(),.?":{}|<>).</span>';
        } else if (password.length >= 6 && /[A-Za-z]/.test(password) && /\d/.test(password) && /[-!@#$%^&*(),.?":{}|<>]/.test(password)) {
            strength = '<span class="text-success">Contraseña válida.</span>';
        } else if (password.length >= 6 && (/[A-Za-z]/.test(password) || /\d/.test(password) || /[-!@#$%^&*(),.?":{}|<>]/.test(password))) {
            strength = '<span class="text-warning">Débil.</span>';
        } else {
            strength = '<span class="text-danger">Muy débil.</span>';
        }
        passwordStrength.innerHTML = strength;
    };
    
    
    // Evento para evitar cierre múltiple de alertas
    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('btn-close')) {
            const alertElement = document.querySelector('.alert');
            if (alertElement) {
                alertElement.remove();
            }
        }
    });
});

// Función para mostrar/ocultar contraseña (si aún se necesita)
function togglePassword() {
    const passwordInput = document.getElementById('password');
    passwordInput.type = (passwordInput.type === 'password') ? 'text' : 'password';
}