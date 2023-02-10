

<header class="header">
    <div class="header__contenedor">
        <div class="header__contenido">
            <a href="/"><h1 class="header__logo"><?php echo $configuracion[0]->detalle; ?></h1></a>
            <p class="header__texto"><?php echo $configuracion[1]->detalle; ?></p>
        </div>
    </div>
</header>

<div class="barra">
    <div class="barra__contenido">
        <a href="/"> 
            <h2 class="barra__logo">AC<span>SoftWare</span></h2>        
        </a>
        <nav class="navegacion">
            <a href="" class="navegacion__enlace">Acerca de mí</a>
            <a href="" class="navegacion__enlace">Habilidades</a>
            <a href="/proyectos?page=1" class="navegacion__enlace">Proyectos</a>
            <a href="/contacto" class="navegacion__enlace">Contacto</a>
        </nav>
    </div>    
</div>