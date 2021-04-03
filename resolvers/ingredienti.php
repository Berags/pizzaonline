<?php
/**
* Classe che gestisce le interrogazioni dal database per gli ingredienti
*/
class IngredientiResolver {
  /**
  * Funzione che permette di ottenere tutti gli ingredienti
  * @return array tutti gli ingredienti
  */
  static function getNomeIngredienti(): array {
    $ingredienti = DBManager::query("SELECT * FROM ingrediente");
    $nomeIngredienti = array();
    foreach($ingredienti as $ingrediente) {
      $nomeIngredienti[] = $ingrediente['nome'];
    }
    return $nomeIngredienti;
  }
  
  /**
  * Funzione che permette di ottenere tutti gli ingredienti di una pietanza
  * @param int $idPietanza l'id della pietanza
  * @return array tutti gli ingredienti della pietanza
  */
  static function getIngredientiPerPietanza(int $idPietanza): array {
    return DBManager::query("SELECT nome FROM ricetta r WHERE r.id_pietanza=$idPietanza");
  }
  
  /**
  * Funzione che permette di inserire un ingrediente nel database
  * @param string $nome_ingrediente il nome dell'ingrediente da inserire
  * @param bool $celiachia l'ingrediente è per celiachi o no?
  * @return array array vuoto
  */
  static function inserisciIngredienti(string $nome_ingrediente, bool $celiachia) {
    DBManager::query("INSERT INTO ingrediente VALUES('$nome_ingrediente', $celiachia)");
  }
  
  /**
  * Funzione che permette di eliminare tutti gli ingredienti di una pietanza
  * @param int $idPietanza l'id della pietanza
  * @return array array vuoto
  */
  static function eliminaIngredientiPietanza(int $id_pietanza) {
    DBManager::query("DELETE FROM ricetta WHERE id_pietanza=$id_pietanza");
  }
  
  /**
  * Funzione che permette di inserire tutti gli ingredienti di una pietanza nella tabella "ricetta"
  * @param array $ingredienti l'array di ingredienti da inserire
  * @param int $idPietanza l'id della pietanza
  * @return array array vuoto
  */
  static function inserisciIngredientiPietanza(array $ingredienti, int $idPietanza) {
    $query = "INSERT INTO ricetta (id_pietanza, nome) VALUES ";
    $ultimoIngrediente = end($ingredienti);
    
    // Creiamo la stringa della query per inserire tutti i valori con una sola chiamata al database
    foreach($ingredienti as $ingrediente) {
      $query .= "(" . intval($idPietanza) . ", '". $ingrediente ."')";
      strcmp($ultimoIngrediente, $ingrediente) != 0 ? $query .= "," : null;
    }
    return DBManager::query($query);
  }
}
