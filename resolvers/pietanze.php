<?php
/**
* Classe che gestisce le interrogazioni dal database per le pietanze
*/
class PietanzeResolver {
  /**
  * Funzione che permette di ottenere tutte le pietanze visibili
  * @return array l'array associativo per le pietanze
  */
  static function getMenu(): array {
    return DBManager::query("SELECT * FROM pietanza WHERE visibile=1");
  }
  
  /**
  * Funzione che permette di ottenere una pietanza dal suo id
  * @param int $id l'id della pietanza
  * @return array la pietanza selezionata
  */
  static function getPizzaById($id) {
    return DBManager::query("SELECT * FROM pietanza WHERE id_pietanza=$id AND visibile=1");
  }
  
  /**
  * Funzione che permette di ottenere l'id di una pietanza dal suo nome
  * @param string $nomePietanza l'id del cliente
  * @return array l'id della pietanza
  */
  static function getId(string $nomePietanza): array {
    return DBManager::query("SELECT id_pietanza FROM pietanza WHERE nome='" . $nomePietanza . "'");
  }
  
  /**
  * Funzione che permette di inserire una pietanza
  * @param string $nomePietanza il nome della nuova pietanza
  * @param string $descrizione la descrizione della nuova pietanza
  * @param string $tipo il tipo della pietanza (rossa, bianca o senza glutine)
  * @param float $prezzo il prezzo della nuova Pietanza
  * @param string $imgpath il nome del file caricato
  * @return array array vuoto
  */
  static function inserisciPietanza(
    string $nomePietanza,
    string $descrizione,
    string $tipo,
    float $prezzo,
    string $imgpath
  ) {
    $query = "INSERT INTO pietanza (nome, descrizione, tipo, prezzo, imgpath) VALUES ('$nomePietanza', '$descrizione','$tipo','$prezzo', '$imgpath')";
    return DBManager::getLastInsertId($query);
  }
  
  /**
  * Funzione che permette di modificare una pietanza
  * @param string $nomePietanza il nuovo nome della pietanza
  * @param string $descrizione la descrizione della pietanza
  * @param string $tipo il tipo della pietanza (rossa, bianca o senza glutine)
  * @param float $prezzo il prezzo della Pietanza
  * @param string $imgpath il nome del file caricato
  * @return array array vuoto
  */
  static function modificaPietanza(
    int $id,
    string $nomePietanza,
    string $descrizione,
    string $tipo,
    float $prezzo,
    string $imgpath
  ) {
    return DBManager::query("UPDATE pietanza SET nome='$nomePietanza', descrizione='$descrizione', tipo='$tipo', prezzo='$prezzo', imgpath='$imgpath' WHERE id_pietanza=$id");
  }
  
  /**
  * Funzione che permette di "eliminare" una pietanza
  * @param int $id l'id della pietanza
  * @return array array vuoto
  */
  static function eliminaPietanza(int $id) {
    return DBManager::query("UPDATE pietanza SET visibile=0 WHERE id_pietanza=$id");
  }
  
  static function getImmaginePietanza($id) {
    return DBManager::query("SELECT imgpath FROM pietanza WHERE id_pietanza=$id")[0];
  }
}
