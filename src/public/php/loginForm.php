<?php
require ('loginFormCode.php');

if (isset($_SESSION['error_login']) || isset($_SESSION['error_register'])) {
    echo '<div class="auth-form-container" id="auth-form-container" style="display: flex">';
} else {
    echo '<div class="auth-form-container" id="auth-form-container" style="display: none">';
}
?>
    <div class="auth-form-wrapper">
        <a id="exitFormLogin">
            <svg id="exitFormIcon" xmlns="http://www.w3.org/2000/svg" width="40px" height="40px" viewBox="0 0 15 15"><path fill="#23cf5f" d="M3.64 2.27L7.5 6.13l3.84-3.84A.92.92 0 0 1 12 2a1 1 0 0 1 1 1a.9.9 0 0 1-.27.66L8.84 7.5l3.89 3.89A.9.9 0 0 1 13 12a1 1 0 0 1-1 1a.92.92 0 0 1-.69-.27L7.5 8.87l-3.85 3.85A.92.92 0 0 1 3 13a1 1 0 0 1-1-1a.9.9 0 0 1 .27-.66L6.16 7.5L2.27 3.61A.9.9 0 0 1 2 3a1 1 0 0 1 1-1c.24.003.47.1.64.27"/></svg>
        </a>
        <div class="auth-form-toggle">
            <button class="auth-form-toggle-btn active" data-form="login">Iniciar sesión</button>
            <button class="auth-form-toggle-btn" data-form="register">Crear cuenta</button>
        </div>
        <form method="POST" action="index.php" class="auth-form login-form">
            <h2 class="auth-form-title">¡Bienvenido de vuelta!</h2>
            <div class="auth-form-input-group">
                    <input type="text" class="auth-form-input" name="usuario_login" placeholder="Usuario" required>
            </div>
            <div class="auth-form-input-group">
                    <input type="password" class="auth-form-input" name="contrasena_login" placeholder="Contraseña" required>
            </div>
            <?php
            if (isset($_SESSION['error_login'])) {
                echo "<p style='color: #cc0000; display: flex; justify-content: center; margin-top: 0;'>".$_SESSION['error_login']."</p>";
            }
            ?>
            <?php if (isset($_COOKIE['intentos_fallidos']) && $_COOKIE['intentos_fallidos'] >= 3) { ?>
                <p style='color: #cc0000; display: flex; justify-content: center; margin-top: 0;'>Has excedido el número de intentos fallidos. Inténtalo más tarde.</p>
                <button type="submit" class="auth-form-submit" name="iniciar_sesion" disabled>Login</button>
            <?php } else { ?>
                <button type="submit" class="auth-form-submit" name="iniciar_sesion">Login</button>
            <?php } ?>
        </form>

        <form method="POST" action="index.php" class="auth-form register-form hidden">
            <h2 class="auth-form-title">Únete a nosotros</h2>
            <div class="auth-form-input-group">
                <input type="text" class="auth-form-input" name="nombre_completo" placeholder="Nombre completo / artístico" required>
            </div>
            <div class="auth-form-input-group">
                <input type="text" class="auth-form-input" name="usuario_registro" placeholder="Usuario" required>
            </div>
            <div class="auth-form-input-group">
                <input type="password" class="auth-form-input" name="contrasena_registro" placeholder="Contraseña" required>
            </div>
            <div class="checkbox-wrapper-46">
                <input type="checkbox" id="cbx-46" class="inp-cbx" name="es_artista"/>
                <label for="cbx-46" class="cbx">
                    <span>
                        <svg viewBox="0 0 12 10" height="10px" width="12px">
                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline></svg>
                    </span>
                    <span>¿Eres un artista?</span>
                </label>
            </div>
            <?php
            if (isset($_SESSION['error_register'])) {
                echo "<p style='color: #cc0000; display: flex; justify-content: center; margin-top: 0;'>".$_SESSION['error_register']."</p>";
            }
            ?>
            <button type="submit" class="auth-form-submit" name="registrar">Confirmar</button>
        </form>
    </div>
</div>

<?php
    unset($_SESSION['error_login']);
    unset($_SESSION['error_register']);
?>