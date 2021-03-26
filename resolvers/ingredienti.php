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

  static function GetIngredientiPerPietanza($idPietanza) {
    return DBManager::query("SELECT nome FROM ricetta r WHERE r.id_pietanza=$idPietanza");
  }

  static function InserisciIngredienti($nome_ingrediente, $celiachia){
    DBManager::query("INSERT INTO ingrediente VALUES('$nome_ingrediente', $celiachia)");
  }

  static function InserisciIngredientiPietanza($ingredienti, $idPietanza) {
    echo "rIcetta";
    $query = "INSERT INTO ricetta (id_pietanza, nome) VALUES ";
    $ultimoIngrediente = end($ingredienti);
    foreach($ingredienti as $ingrediente) {
      $query .= "(".$idPietanza.", '". $ingrediente ."')";
      strcmp($ultimoIngrediente, $ingrediente) != 0 ? $query .= "," : null;
    }
    return DBManager::query($query);
  }
}
?>
