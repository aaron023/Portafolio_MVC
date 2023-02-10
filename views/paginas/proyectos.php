<main class="proyectos">
    <h2 class="proyectos__heading">Proyectos</h2>
    <p class="proyectos__descripcion">Todos mis proyectos</p>

    <?php if(!empty($proyectos)) { ?>
        <?php include_once __DIR__ . '/../templates/proyectos.php'; ?>
        <div class="proyectos__contenedor">
            <?php echo $paginacion; ?>
        </div>
    <?php } else { ?>
        <h2>No hay proyectos</h2>
    <?php } ?>
</main>