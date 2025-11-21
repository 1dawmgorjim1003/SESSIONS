<?php
//INICIALIZACIÓN DE ENTORNO
function bootstrap() {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

//FUNCIONES DE DEBUGUEO
function dump($var){
    echo '<pre>'.print_r($var,1).'</pre>';
}

//LÓGICA NEGOCIO
function counterCookies() {
    //Definición de cookie que almacena las visitas
    $nameCookie = 'visitsCounter';

    // Verificación de existencia de cookie
    if (!isset($_COOKIE[$nameCookie])) {
        /* Si no existe, se crea con valor 1 por defecto.
        y se inicializa el contador a 1*/
        setcookie($nameCookie,1);
        $visitsCounter = 1;
    } else {
        /* Si existe, se incrementa en 1 el contador de visitas
        y se actualiza el valor de la cookie*/
        $visitsCounter = $_COOKIE[$nameCookie]+1;
        setcookie($nameCookie,$visitsCounter);
    }
    return $visitsCounter;
}

$dataCookie = counterCookies();

//LÓGICA PRESENTACIÓN
function getCookieMarkup($dataCookie) {
    return '<p> Número de visitas del usuario: '. $dataCookie . '<p>';
}

$cookieMarkup = getCookieMarkup($dataCookie);
?>