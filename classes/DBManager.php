<?php

/**
* Classe che permette la gestione della connessione tra Database
* e Server PHP. Include i metodi per la creazione di query.
*/
class DBManager
{
  private static $host     = 'mysql1.nuttyabouthosting.co.uk';    // Host dove viene mantenuto il Database
  private static $username = 'y1352_j.beragnoli';                 // Utente che si collegherà al Database
  private static $password = '3C8Xj8OWEM84_';                     // Password dell'utente
  private static $dbname   = 'y1352_pizzaonline';                 // Nome del Database
  
  /**
  * Funzione che permette di eseguire delle query
  * @param string $q la query sotto forma di stringa
  * @return array Il risultato della query
  */
  static function query(string $q): array {
    $con = mysqli_connect(self::$host, self::$username, self::$password, self::$dbname);
    // Controllo se è presente l'errore durante la connessione
    if(mysqli_connect_errno()) {
      die("Connessione fallita: ". mysqli_connect_error());
    }
    
    // Eseguiamo la query e la salviamo in una variabile
    $risultato = @mysqli_query($con, $q);
    
    // La ricerca da risultati?
    if(@mysqli_num_rows($risultato) == 0) {
      //Nessun risultato --> return;
      mysqli_close($con);
      return array();
    }
    
    // Creiamo l'array per il risultato
    $res = array();
    
    // Salviamo il risultato
    while($row = mysqli_fetch_array($risultato, MYSQLI_ASSOC)) {
      $res[] = $row;
    }
    
    // Chiudiamo la connessione per migliorare le performance
    mysqli_close($con);
    return $res;
  }
  
  /**
  * Funzione che permette di cambiare il nome del Database
  * @param string $dbname Il nuovo nome del Database
  */
  static function setDatabaseName(string $dbname): void {
    self::$dbname = $dbname;
  }
  
  /**
  * Funzione che permette di ottenere la connessione al Database
  * @return object la Connessione
  */
  static function getConnection() {
    return mysqli_connect(self::$host, self::$username, self::$password, self::$dbname);;
  }
  
  /**
  * Funzione che permette l'esecuzione di una query che permette di ottenere l'ultimo id inserito
  * @param string $q La query
  * @return mixed L'ultimo id inserito nel database
  */
  static function getLastInsertId(string $q): mixed {
    $con = mysqli_connect(self::$host, self::$username, self::$password, self::$dbname);
    // Controllo se è presente l'errore durante la connessione
    if(mysqli_connect_errno()) {
      die("Connessione fallita: ". mysqli_connect_error());
    }
    
    // Eseguiamo la query e la salviamo in una variabile
    $risultato = @mysqli_query($con, $q);
    
    // La ricerca da risultati?
    if(@mysqli_num_rows($risultato) == 0) {
      //Nessun risultato --> die();
      mysqli_close($con);
      return array();
    }
    
    // Ultimo id inserito
    return mysqli_insert_id($con);
  }
}
