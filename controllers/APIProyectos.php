<?php

namespace Controllers;

use Classes\Paginacion;
use Classes\Respuesta;
use Model\Proyecto;

class APIProyectos {

    public static function proyectos() {

        $page = $_GET['page'];         
        $page = filter_var($page, FILTER_VALIDATE_INT);

        $registros_por_pagina = $_GET['per_page'];
        $registros_por_pagina = filter_var($registros_por_pagina, FILTER_VALIDATE_INT);

        if($registros_por_pagina < 4) {
            $registros_por_pagina = 3;
        }

        if(isset($_GET['estatus'])) {
            $total = Proyecto::total();
        } else {
            $total = Proyecto::total('estatus', '1');
        }

        if($registros_por_pagina > $total) {
            $registros_por_pagina = $total;
        }
        
        $paginacion = new Paginacion($page, $registros_por_pagina, $total);

        // Obtenemos los proyectos
        $array = ['estatus' => 1 ];
        $proyectos = Proyecto::paginar($registros_por_pagina, $paginacion->offset(), $array);

        $respuesta = new Respuesta($total, $proyectos);

        //$resultado = [$proyectos, $paginacion->paginacion()];

        


        echo json_encode($respuesta);
        //echo json_encode($resultado);

    }



}