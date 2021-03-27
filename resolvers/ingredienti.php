<?php
/* Jacopo Beragnoli 5°IC */
class IngredientiResolver {
  static function getNomeIngredienti() {
    $ingredienti = DBManager::query("SELECT * FROM ingrediente");
    $nomeIngredienti = array();
    foreach($ingredienti as $ingrediente) {
      $nomeIngredienti[] = $ingrediente['nome'];
    }
    return $nomeIngredienti;
  }

  static function getIngredientiPerPietanza($idPietanza) {
    return DBManager::query("SELECT nome FROM ricetta r WHERE r.id_pietanza=$idPietanza");
  }

  static function inserisciIngredienti($nome_ingrediente, $celiachia){
    DBManager::query("INSERT INTO ingrediente VALUES('$nome_ingrediente', $celiachia)");
  }

  static function eliminaIngredientiPietanza($id_pietanza) {
    DBManager::query("DELETE FROM ricetta WHERE id_pietanza=$id_pietanza");
  }

  static function inserisciIngredientiPietanza($ingredienti, $idPietanza) {
    $query = "INSERT INTO ricetta (id_pietanza, nome) VALUES ";
    $ultimoIngrediente = end($ingredienti);
    foreach($ingredienti as $ingrediente) {
      $query .= "(" . intval($idPietanza) . ", '". $ingrediente ."')";
      strcmp($ultimoIngrediente, $ingrediente) != 0 ? $query .= "," : null;
    }
    return DBManager::query($query);
  }
}
?>
