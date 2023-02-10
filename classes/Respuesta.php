<?php 

namespace Classes;

class Respuesta {
    public $totalHits;
    public $hits;

    public function __construct($totalHits, $hits)
    {
        $this->totalHits = $totalHits;
        $this->hits = $hits;
    }


}



