<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>

<div class="dashboard__contenedor-boton">
    <a href="/admin/configuracion" class="dashboard__boton">
        <i class="fa-solid fa-circle-arrow-left"></i>
        Volver
    </a>
</div>

<div class="dashboard__formulario">
    <?php include_once __DIR__ . './../../templates/alertas.php';  ?>
    <form method="POST" class="formulario">
        <div class="formulario__campo">
            <label for="descripcion" class="formulario__label"><?php echo $configuracion->concepto; ?></label>
            <input type="hidden" name="id" value="<?php echo $configuracion->id; ?>">
            <input type="hidden" name="concepto" value="<?php echo $configuracion->concepto; ?>">
            <textarea class="formulario__input" id="detalle" name="detalle" placeholder="Escribre la descripción para <?php echo $configuracion->concepto; ?>" rows="8"><?php echo $configuracion->detalle; ?></textarea>
        </div>
        <input class="formulario__submit formulario__submit--registrar" type="submit" value="Editar Configuración">
    </form>
</div>