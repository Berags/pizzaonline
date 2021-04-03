<?php
use Firebase\JWT\JWT;
require_once __DIR__ . '\..\vendor\autoload.php';

/**
* Classe che permette la gestione delle sessioni
*/
class SessionManager {
  // Chiave segreta utilizzata nella creazione del JWT
  const SECRET_KEY = 'MrjlavUAAN91FJqLxBSQO2Hxebt4xUL8YLGi1rfi';
  
  /**
  * Funzione che permette la creazione di un token JWT
  * @param string $username L'username da salvare nel JWT
  * @return string Restituisce il JWT sotto il formato di stringa
  */
  public static function login(string $username): string {
    $issuedAt   = new DateTimeImmutable();
    $expire     = $issuedAt->modify('+6 minutes')->getTimestamp();
    $serverName = "pizzaonline";
    $payload = array(
      'iss' => $serverName,         // Nome del server che genera il JWT
      'iat' => idate('U'),          // Issued At: l'esatto istante in cui viene generato il JWT
      'nbf' => idate('U'),          // Not Before: ora minima di eliminazione del JWT
      'exp' => idate('U', $expire), // Expire: istante di tempo di eliminazione
      'username' => $username       // Dati da immagazzinare nel JWT
    );
    
    // Creazione del JWT
    $jwt = JWT::encode($payload, SessionManager::SECRET_KEY);
    
    return $jwt;
  }
  
  /**
  * Funzione che permette il refresh e decode del JWT
  * @param string $jwt Il JWT sotto formato stringa da decodificare o da refreshare
  * @return array Rappresentazione sotto forma di Array del JWT
  */
  public static function decode(string $jwt): array {
    try {
      // Decodifica del JWT, se è scaduto viene generato un nuovo Token
      $decoded = (array) JWT::decode($jwt, SessionManager::SECRET_KEY, array('HS256'));
    }catch(\Firebase\JWT\ExpiredException $e) {
      // JWT scaduto
      $decoded = SessionManager::refresh($jwt);
    }
    return $decoded;
  }
  
  /**
  * Funzione che permette il refresh del token
  * @param string $jwt Il Token da refreshare
  * @return string Il token sotto il formato di stringa valido
  */
  private static function refresh(string $jwt): array {
    JWT::$leeway = 720000; // Impostiamo il tempo del server con un gap di 720000 secondi
    // in modo tale da poter generare un nuovo token con gli stessi dati (username)
    
    $decoded  = (array) @JWT::decode($jwt, SessionManager::SECRET_KEY, ['HS256']); // Decodifica del JWT, non vengono mostrati gli errori
    $issuedAt = new DateTimeImmutable();                          // Data attuale
    $expire   =  $issuedAt->modify('+6 minutes')->getTimestamp(); // Data attuale + 6 minuti, durata del nuovo JWT
    
    // Modifichiamo i valori di iat (issuedAt) e exp (expired) per creare un nuovo JWT con durata di 6 minuti
    $decoded['iat'] = idate('U');
    $decoded['exp'] = idate('U', $expire);
    $_SESSION['username'] = @JWT::encode($decoded, SessionManager::SECRET_KEY); // Creazione del nuovo JWT
    return $decoded;
  }
}
