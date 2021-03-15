<?php 
    /* Jacopo Beragnoli 5°IC */
class PietanzeResolver {
    static function GetMenu() {
        return DBManager::query("SELECT * FROM pietanza");
    }

    static function GetPizzaById($id) {
        return DBManager::query("SELECT * FROM pietanza WHERE id_pietanza=$id");
    }
    
    static function InserisciPietanza($nomePietanza, $descrizione, $tipo, $prezzo) {
        DBManager::query("INSERT INTO pietanza VALUES (".$nomePietanza.",".$descrizione.",".$tipo.",".$prezzo.")");
        /*
            TODO:
            - Ottenere l'id dell'ultima pietanza inserita
        */
        echo DBManager::query("select LAST_INSERT_ID()");
    }
}
?>