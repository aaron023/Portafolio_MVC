<?php

namespace Model;

class Proyecto extends ActiveRecord {
    protected static $tabla = 'proyectos';
    protected static $columnasDB = ['id','nombre','descripcion','imagen','url','fecha_alta','estatus'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->imagen = $args['imagen'] ?? ''; 
        $this->url = $args['url'] ?? '';
        $this->fecha_alta = $args['fecha_alta'] ?? date("Y-m-d H:i:s");
        $this->estatus = $args['estatus'] ?? 1;
    }

    public function validar()
    {
        if(!$this->nombre) {
            self::$alertas['error'][] = "El nombre es obligatorio";
        }
        if(!$this->url) {
            self::$alertas['error'][] = 'La ruta URL es obligatoria';
        }
        if(!$this->descripcion) {
            self::$alertas['error'][] = "La descripción es obligatoria";
        }
        if(!$this->imagen) {
            self::$alertas['error'][] = 'La imagen es obligatoria';
        }
        return self::$alertas;
    }
}