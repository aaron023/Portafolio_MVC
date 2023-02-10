<?php

namespace Model;

class Configuraciones extends ActiveRecord {
    protected static $tabla = 'configuraciones';
    protected static $columnasDB = ['id','concepto','detalle'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->concepto = $args['concepto'] ?? '';
        $this->detalle = $args['detalle'] ?? '';
    }

    public function validar() {
        if(!$this->detalle) {
            self::$alertas['error'][] = "El texto no puedo ir vacío";
        }

        return self::$alertas;
    }
}