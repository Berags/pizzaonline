<?php

/**
 * 
 */
class DBManager
{
    public static $host     = "mysql1.nuttyabouthosting.co.uk";
    public static $username = "y1352_j.beragnoli";
    public static $password = "3C8Xj8OWEM84_";
	public static $dbname   = "y1352_pizzaonline";

	function __construct($host, $user, $password) {
		$this->host = $host;
        $this->username = $user;
        $this->password = $password;
	}

	static function query($q) {

        // Connessione al database
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
            die("Nessun risultato!");
        }

        // Creiamo l'array per il risultato
        $res = array();

        // Salviamo il risultato
        while($row = mysqli_fetch_array($risultato, MYSQLI_ASSOC)) {
            $res[] = $row;
        }

	    return $res;
    }

    static function setDatabaseName($dbname) {
        self::$dbname = $dbname;
    }

    static function getConnection() {
        return mysqli_connect(self::$host, self::$username, self::$password, self::$dbname); 
    }
}
?>