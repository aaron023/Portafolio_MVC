<div class="formulario__campo">
    <label for="nombre" class="formulario__label">Nombre</label>
    <input type="text" class="formulario__input" id="nombre" name="nombre" placeholder="Nombre Proyecto" value="<?php echo $proyecto->nombre ?? ''; ?>">
</div>
<div class="formulario__campo">
    <label for="url" class="formulario__label">Url</label>
    <input type="text" class="formulario__input" id="url" name="url" placeholder="Url del proyecto" value="<?php echo $proyecto->url ?? ''; ?>">
</div>
<div class="formulario__campo">
    <label for="descripcion" class="formulario__label">Descripción</label>
    <textarea class="formulario__input" id="descripcion" name="descripcion" placeholder="Escribre la descripción del proyecto" rows="8" required><?php echo $proyecto->descripcion ?? ''; ?></textarea>
    <!-- <input type="text" class="formulario__input" id="descripcion" name="descripcion" placeholder="Descripción del proyecto" value="<?php echo $proyecto->descripcion ?? ''; ?>"> -->
</div>
<div class="formulario__campo">
    <label for="imagen" class="formulario__label">Imagen</label>
    <input type="file" class="formulario__input formulario__input--file" id="imagen" name="imagen">
</div>
<?php if(isset($proyecto->imagen_actual)) { ?>
    <p class="formulario__texto">Imagen Actual:</p>
    <div class="formulario__imagen">
        <picture>
            <source srcset="../../img/proyectos/<?php echo $proyecto->imagen; ?>.avif" type="image/avif">
            <source srcset="../../img/proyectos/<?php echo $proyecto->imagen; ?>.webp" type="image/webp">
            <img loading="lazy" src="../../img/proyectos/<?php echo $proyecto->imagen; ?>.jpg" alt="Imagen proyecto" width="500" height="300" />
        </picture>
    </div>
<?php } ?>