<?php
/* Jacopo Beragnoli 5°IC */
class PietanzeResolver {
  static function getMenu() {
    return DBManager::query("SELECT * FROM pietanza WHERE visibile=1");
  }

  static function getPizzaById($id) {
    return DBManager::query("SELECT * FROM pietanza WHERE id_pietanza=$id AND visibile=1");
  }

  static function getId($nomePietanza) {
    return DBManager::query("SELECT id_pietanza FROM pietanza WHERE nome='" . $nomePietanza . "'");
  }

  static function inserisciPietanza($nomePietanza, $descrizione, $tipo, $prezzo, $imgpath) {
    $query = "INSERT INTO pietanza (nome, descrizione, tipo, prezzo, imgpath) VALUES ('$nomePietanza', '$descrizione','$tipo','$prezzo', '$imgpath')";
    return DBManager::getLastInsertId($query);
  }

  static function modificaPietanza($id, $nomePietanza, $descrizione, $tipo, $prezzo, $imgpath) {
    return DBManager::query("UPDATE pietanza SET nome='$nomePietanza', descrizione='$descrizione', tipo='$tipo', prezzo='$prezzo', imgpath='$imgpath' WHERE id_pietanza=$id");
  }

  static function eliminaPietanza($id) {
    return DBManager::query("UPDATE pietanza SET visibile=0 WHERE id_pietanza=$id");
  }

  static function getImmaginePietanza($id) {
    return DBManager::query("SELECT imgpath FROM pietanza WHERE id_pietanza=$id")[0];
  }
}
?>
