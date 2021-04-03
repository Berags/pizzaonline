<?php

/**
* Classe che gestisce le interrogazioni dal database per gli utenti
*/
class AccountResolver {
  /**
  * Permette di ottenere un utente dall'username
  * @param string $username l'username
  * @return mixed ritorna o l'oggetto utente oppure array vuoto
  */
  static function getUserFromUsername(string $username): array {
    return DBManager::query("SELECT * FROM account WHERE username='$username' LIMIT 1");
  }
}
