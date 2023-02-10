<section class="contacto">
    <h2 class="contacto__heading">Contacto</h2>
    <p class="contacto__descripcion">Ingresa tus datos y nos pondremos en contacto contigo</p>


    <div class="contacto__formulario">
        <?php include_once __DIR__ . '/../templates/alertas.php' ?>
        <!-- <?php if($alerta) { ?>
            <p class="alerta alerta__"><?php echo $alerta; ?></p>
        <?php } ?> -->
        <form method="POST" class="formulario">
            <?php include_once __DIR__ . '/../paginas/contacto/formulario.php'; ?>
            <input class="formulario__submit" type="submit" value="Enviar">
        </form>
    </div>
    
</section>
