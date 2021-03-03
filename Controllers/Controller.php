<?php 
    /* Jacopo Beragnoli 5°IC */

/**
 * Super classe dei controller
 * Contiene i metodi necessari al MVC per funzionare
 */
class Controller {
    /**
     * CreateView
     * Esegue il render della view associata
     * @param [string] $ViewName
     * @return void
     */
    public static function CreateView($ViewName) {
        // Richiamiamo il file all'interno della Views
        require_once "Views/$ViewName.php";
    }
}
?>