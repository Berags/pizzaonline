<?php 
    /* Jacopo Beragnoli 5°IC */
class IngredientiResolver {
    static function GetNomeIngredienti() {
        $ingredienti = DBManager::query("SELECT * FROM ingrediente");
        $nomeIngredienti = array();
        foreach($ingredienti as $ingrediente) {
            $nomeIngredienti[] = $ingrediente["nome"];
        }
        return $nomeIngredienti;
    }

    static function InserisciIngredientiPietanza($ingredienti, $idPietanza) {
        $query = "INSERT INTO ricetta VALUES ";
        $ultimoIngrediente = end($ingredienti);
        foreach($ingredienti as $ingrediente) {
            $query .= "(".$idPietanza.", '". $ingrediente ."')";
            strcmp($ultimoIngrediente, $ingrediente) != 0 ? $query .= "," : null;
        }
        // TODO: Aggiungere DBManger::query($query);
        echo $query;
    }
}
?>