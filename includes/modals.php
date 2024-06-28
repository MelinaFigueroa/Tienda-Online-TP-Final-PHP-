<!-- Modal de Registro -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">Registrarse</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="../auth/register.php">
                    <div class="mb-4">
                        <label for="username" class="form-label">Usuario</label>
                        <input type="text" name="username" id="username" placeholder="Ingrese su correo" required class="form-control">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">Contraseña</label>
                        <div class="input-group">
                            <input type="password" name="password" id="password" placeholder="Ingrese su clave" required class="form-control" oninput="checkPasswordStrength(this.value)">
                            <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()">Ver</button>
                        </div>
                        <small id="passwordHelp" class="form-text text-muted">La contraseña debe tener al menos 6 caracteres, una letra, un número y un carácter especial (-, !@#$%^&*()-,.?":{}|<>).</small>
                        <div id="passwordStrength" class="mt-2"></div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Registrarse</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Login -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Iniciar Sesión</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="../auth/login.php">
                    <div class="mb-4">
                        <label for="username" class="form-label">Usuario</label>
                        <input type="text" name="username" id="username" placeholder="Ingrese su correo" required class="form-control">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">Contraseña</label>
                        <div class="input-group">
                            <input type="password" name="password" id="password" placeholder="Ingrese su clave" required class="form-control">
                            <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()">Ver</button>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../auth/script.js"></script>