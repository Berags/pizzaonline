<?php 
    /* Jacopo Beragnoli 5°IC */
    class Route {
        public static $valid_routes = array();

        public static function set($route, $function) {
            // Aggiungiamo le route valide al nostro array
            self::$valid_routes[] = $route;

            // Se la route cha abbiamo ricevuto è valida mostriamo la pagina
            if($_GET["url"] == $route) {
                $function->__invoke();
                return;
            }
        }
    }
?>