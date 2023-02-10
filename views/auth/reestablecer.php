<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__descripcion">Coloca tu nuevo password</p>
    <?php require_once __DIR__ . '/../templates/alertas.php' ?>

    <?php if($token_valido) { ?>
        <div class="reestablecer__formulario">            
            <form method="POST" class="formulario">
                <div class="formulario__campo">
                    <label for="password" class="formulario__label">Nuevo Password</label>
                    <input type="password" name="password" id="password" class="formulario__input" placeholder="Tu nuevo password">
                </div>
                <input type="submit" class="formulario__submit" value="Guardar Password">
            </form>
            <div class="acciones">
                <a href="/login" class="acciones__enlace">¿Ya tienes cuenta? Iniciar Sesión</a>
                <a href="/registro" class="acciones__enlace">¿Aún no tienes cuenta? Obtener una</a>        
            </div>            
        </div>
    <?php } ?>
    



</main>