<?php

/**
*
*/
class DBManager
{
  private static $host     = 'yvu4xahse0smimsc.chr7pe7iynqr.eu-west-1.rds.amazonaws.com';
  private static $username = 'mb7rpe1o7m4u6cmq';
  private static $password = 'nhgom5v67jvi177c';
  private static $dbname   = 'm2dkc4hle2f2zgx1';
  
  static function query($q) {
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
      return;
    }
    
    // Creiamo l'array per il risultato
    $res = array();
    
    // Salviamo il risultato
    while($row = mysqli_fetch_array($risultato, MYSQLI_ASSOC)) {
      $res[] = $row;
    }
    
    mysqli_close($con);
    return $res;
  }
  
  static function setDatabaseName($dbname) {
    self::$dbname = $dbname;
  }
  
  static function getConnection() {
    return mysqli_connect(self::$host, self::$username, self::$password, self::$dbname);;
  }
  
  static function getLastInsertId($q) {
    $con = mysqli_connect(self::$host, self::$username, self::$password, self::$dbname);
    // Controllo se è presente l'errore durante la connessione
    if(mysqli_connect_errno()) {
      die("Connessione fallita: ". mysqli_connect_error());
    }
    
    // Eseguiamo la queri e la salviamo in una variabile
    $risultato = @mysqli_query($con, $q);
    
    // La ricerca da risultati?
    if(@mysqli_num_rows($risultato) == 0) {
      //Nessun risultato --> die();
    }
    
    return mysqli_insert_id($con);
  }
}
?>
