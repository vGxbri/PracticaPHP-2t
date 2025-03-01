<form method="POST" action="settings.php" class="formAjustes">
    <h2 class="titAjustes">Cambiar el nombre de usuario</h2>
    <input type="text" class="settings-input" name="usuario_nuevo" placeholder="Nuevo nombre de usuario" required>
    <?php
    if (isset($_SESSION['error_settings_user'])) {
        echo "<p style='color: #cc0000; display: flex; justify-content: center; margin-top: 0;'>".$_SESSION['error_settings_user']."</p>";
    }
    ?>
    <button type="submit" class="settings-submit" name="cambiar_usuario">Confirmar</button>
</form>
<form method="POST" action="settings.php" class="formAjustes">
    <h2 class="titAjustes">Cambia tu contraseña</h2>
    <input type="password" class="settings-input" name="contrasena_actual" placeholder="Contraseña actual" required>
    <input type="password" class="settings-input" name="nueva_contrasena" placeholder="Nueva contraseña" required>
    <input type="password" class="settings-input" name="nueva_contrasena_confirmar" placeholder="Repite la nueva contraseña" required>
    <?php
    if (isset($_SESSION['error_settings_pass'])) {
        echo "<p style='color: #cc0000; display: flex; justify-content: center; margin: 10px 0 0 0'>".$_SESSION['error_settings_pass']."</p>";
        unset($_SESSION['error_settings_pass']);
    }
    ?>
    <button type="submit" class="settings-submit" name="cambiar_contrasena">Confirmar</button>
</form>
<form method="POST" action="settings.php" class="formAjustes-eliminarCuenta">
    <?php
    if (isset($_SESSION['error_settings_delete'])) {
        echo "<p style='color: #cc0000; display: flex; justify-content: center; margin-top: 0;'>".$_SESSION['error_settings_delete']."</p>";
        unset($_SESSION['error_settings_delete']);
    }
    ?>
    <button type="submit" class="settings-submit-delete" name="eliminar_cuenta">Eliminar cuenta</button>
</form>

<?php
    unset($_SESSION['error_settings_user']);
?>
