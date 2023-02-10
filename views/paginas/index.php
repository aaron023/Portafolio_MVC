<section class="acerca">
    <h2 class="acerca__heading"><?php echo $configuracion[2]->detalle; ?></h2>
    <p class="acerca__descripcion"><?php echo $configuracion[3]->detalle; ?></p>

    <div class="acerca__contenido">
        <div class="acerca__grid acerca__contenedor">
            <div class="acerca__imagen">
                <picture>
                    <source srcset="build/img/software-developer.avif" type="image/avif">
                    <source srcset="build/img/software-developer.webp" type="image/webp">
                    <img loading="lazy" src="build/img/software-developer.jpg" alt="" width="500" height="300" />
                </picture>
            </div>
            <div class="acerca__contenido-texto">
                <?php 
                    $parrafos = explode("|", $configuracion[12]->detalle);
                    foreach($parrafos as $parrafo) {
                ?>
                    <p><?php echo $parrafo; ?></p>
                <?php
                    }
                ?>
            </div>
            
        </div>        
    </div>    
</section>
                
<section class="habilidades">
    <h2 class="habilidades__heading"><?php echo $configuracion[5]->detalle ?></h2>
    <p class="habilidades__descripcion"><?php echo $configuracion[6]->detalle ?></p>

    <div class="habilidad">
        <div class="habilidad__contenedor habilidad__grid">
        <div <?php aos_animacion(); ?> class="habilidad__icono">
                <img src="build/img/icons8-html-5.svg" alt="Imagen CSS">
            </div>
            <div <?php aos_animacion(); ?> class="habilidad__icono">
                <img src="build/img/icons8-css3.svg" alt="Imagen CSS">
            </div>
            <div <?php aos_animacion(); ?> class="habilidad__icono">
                <img src="build/img/icons8-javascript.svg" alt="Imagen CSS">
            </div>
            <div <?php aos_animacion(); ?> class="habilidad__icono">
                <img src="build/img/icons8-logo-php.svg" alt="Imagen CSS">
            </div>
            <div <?php aos_animacion(); ?> class="habilidad__icono">
                <img src="build/img/icons8-sass.svg" alt="Imagen CSS">
            </div>
            <div <?php aos_animacion(); ?> class="habilidad__icono">
                <img src="build/img/icons8-tailwind-css.svg" alt="Imagen CSS">
            </div>
            <div <?php aos_animacion(); ?> class="habilidad__icono">
                <img src="build/img/icons8-gulp.svg" alt="Imagen CSS">
            </div>
            <div <?php aos_animacion(); ?> class="habilidad__icono">
                <img src="build/img/icons8-git.svg" alt="Imagen CSS">
            </div>
            <div <?php aos_animacion(); ?> class="habilidad__icono">
                <img src="build/img/icons8-my-sql.svg" alt="Imagen CSS">
            </div>
            
            
        </div>
    </div>
</section>

<section class="proyectos">
    <h2 class="proyectos__heading"><?php echo $configuracion[7]->detalle ?></h2>
    <p class="proyectos__descripcion"><?php echo $configuracion[8]->detalle ?></p>

    <?php include_once __DIR__ . '/../templates/proyectos.php'; ?>

    <?php if(!empty($proyectos)) { ?>
        <div class="proyectos__enlace-contenedor">
            <a href="/proyectos" class="proyectos__enlace">Ver Todas las Páginas</a>
        </div>
    <?php } else {?>
        <h2>No hay proyectos</h2>
    <?php } ?>
</section>


<section class="ubicacion">
    <h2 class="proyectos__heading"><?php echo $configuracion[9]->detalle ?></h2>
    <div id="mapa" class="mapa"></div>
</section>

<section class="contacto">
    <h2 class="contacto__heading"><?php echo $configuracion[10]->detalle ?></h2>
    <p class="contacto__descripcion"><?php echo $configuracion[11]->detalle ?></p>


    <div class="contacto__formulario">
        <?php include_once __DIR__ . '/../templates/alertas.php' ?>
        <form method="POST" class="formulario">
            <?php include_once __DIR__ . '/contacto/formulario.php'; ?>
            <input class="formulario__submit" type="submit" value="Enviar">
        </form>
    </div>
    
</section>


