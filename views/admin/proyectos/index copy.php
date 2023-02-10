<h2 class="dashboard__heading"><?php echo $titulo ?></h2>

<div class="dashboard__contenedor-boton">
    <a href="/admin/proyectos/crear" class="dashboard__boton">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir Proyecto
    </a>
</div>

<div id="admin-proyectos">
    <?php if(!empty($proyectos)) { ?>    
        <?php foreach($proyectos as $proyecto) { ?>    
            <div class="dashboard__contenedor">  
                <div class="admin-proyecto">
                    <picture>
                        <!-- <source srcset="build/img/guitar-la.avif" type="image/avif"> -->
                        <source srcset="../img/proyectos/<?php echo $proyecto->imagen ?>.webp" type="image/webp">
                        <img loading="lazy" src="../img/proyectos/<?php echo $proyecto->imagen ?>.png" alt="" width="500" height="300" />
                    </picture>   
                    
                    <div class="admin-proyecto__informacion">
                        <h4 class="admin-proyecto__nombre"><?php echo $proyecto->nombre ?></h4>
                        <p class="admin-proyecto__descripcion"><?php echo $proyecto->descripcion ?></p>
                        <div class="admin-proyecto__detalle">
                            <p class="admin-proyecto__url"><span>URL:</span> <?php echo $proyecto->url; ?></p>
                            <p class="admin-proyecto__fecha"><span>Fecha:</span> <?php echo $proyecto->fecha_alta ?></p>
                        </div>
                        
                        <div class="admin-proyecto__acciones">
                            <a class="admin-proyecto__boton" href="/admin/proyectos/editar?id=<?php echo $proyecto->id; ?>">
                                <i class="fa-solid fa-user-pen"></i>
                                Editar
                            </a>
                            <?php if($proyecto->estatus === "1") { ?>
                                <form method="POST" action="/admin/proyectos/estatus">
                                    <input type="hidden" name="id" value="<?php echo $proyecto->id; ?>">
                                    <button class="admin-proyecto__boton admin-proyecto__boton--desactivar" type="submit">
                                        <i class="fa-solid fa-circle-xmark"></i>
                                        Desactivar
                                    </button>
                                </form>
                            <?php } else { ?>
                                <form method="POST" action="/admin/proyectos/estatus">
                                    <input type="hidden" name="id" value="<?php echo $proyecto->id; ?>">
                                    <button class="admin-proyecto__boton admin-proyecto__boton--activar" type="submit">
                                        <i class="fa-solid fa-circle-xmark"></i>
                                        Activar
                                    </button>
                                </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>   
        
    <?php } else { ?>   
        <div class="dashboard__contenedor"> 
            <p class="text-center">No hay Proyectos Aún</p>
        </div>
    <?php } ?>

    <?php echo $paginacion; ?>
</div>

