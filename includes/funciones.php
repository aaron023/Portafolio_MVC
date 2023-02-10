<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function aos_animacion() : void {
    $efectos = ['fade-up','fade-down','fade-left','fade-right','flip-left','flip-right','zoom-in','zoom-in-up','zoom-in-down','zoom-out'];
    $efecto = array_rand($efectos, 1);
    echo ' data-aos="' . $efectos[$efecto] . '" ';
}

function is_admin() : bool {
    if(!isset($_SESSION)) {
        session_start();
    }
    return isset($_SESSION['admin']) && !empty($_SESSION['admin']);
}