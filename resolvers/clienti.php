<?php
/**
* Classe che gestisce le interrogazioni dal database per i clienti
*/
class ClientiResolver {
  
  /**
  * Funzione che permette di ottenere tutti i clienti
  * @return array l'array di clienti
  */
  static function getClienti(): array {
    return DBManager::query("SELECT * FROM cliente");
  }
  
  /**
  * Funzione che permette di ottenere tutti i dati da un cliente specifico
  * @param int $id l'id del cliente
  * @return array il cliente selezionato
  */
  static function getClienteById(int $id): array {
    return DBManager::query("SELECT * FROM cliente WHERE id_cliente=$id")[0];
  }
}
