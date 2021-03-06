<?php 
    /* Jacopo Beragnoli 5°IC */
class PietanzeResolver {
    static function GetMenu() {
        $menu = DBManager::query("SELECT * FROM pietanza;");
        return $menu;
    }
}
?>