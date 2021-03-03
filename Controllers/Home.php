<?php 
    /* Jacopo Beragnoli 5°IC */
class Home extends Controller {
    public static function CreateView($ViewName) {
        // Eseguiamo una query di prova dal database
        $risultato = DBManager::query("SELECT * FROM pietanza");
        require_once "Views/$ViewName.php";
    }
}
?>