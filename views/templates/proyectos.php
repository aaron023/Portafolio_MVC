<div class="proyectos__grid">
    <?php if(!empty($proyectos)) { ?>
        <?php foreach($proyectos as $proyecto) { ?>                
            <div <?php aos_animacion(); ?> class="proyecto">
                <picture>
                    <source srcset="img/proyectos/<?php echo $proyecto->imagen ?>.avif" type="image/avif">
                    <source srcset="img/proyectos/<?php echo $proyecto->imagen ?>.webp" type="image/webp">
                    <img loading="lazy" src="img/proyectos/<?php echo $proyecto->imagen ?>.png" alt="" width="500" height="300" />
                </picture>   
                <div class="proyecto__informacion">
                    <h4 class="proyecto__nombre"><?php echo $proyecto->nombre ?></h4>
                    <p class="proyecto__descripcion"><?php echo $proyecto->descripcion ?></p>
                    <!-- <div class="tecnologia">
                        <img class="tecnologia__icono" src="build/img/icons8-html-5.svg" alt="Logo HTML5">
                        <img class="tecnologia__icono" src="build/img/icons8-css3.svg" alt="Logo CSS3">
                        <img class="tecnologia__icono" src="build/img/icons8-sass.svg" alt="Logo SASS">
                    </div> -->
                    <a href="<?php echo $proyecto->url ?>" target="_blank" class="proyecto__enlace">Ver Página</a>
                </div>
            </div>
        <?php } ?>
    <?php } ?>
</div>