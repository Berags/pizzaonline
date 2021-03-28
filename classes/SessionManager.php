<?php
use Firebase\JWT\JWT;
require_once __DIR__ . '\..\vendor\autoload.php';

class SessionManager {
  const SECRET_KEY = 'MrjlavUAAN91FJqLxBSQO2Hxebt4xUL8YLGi1rfi'; // Chiave segreta

  static function login(string $username): string {
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

    $jwt = JWT::encode($payload, SessionManager::SECRET_KEY);

    return $jwt;
  }

  static function decode(string $jwt): array {
    try {
      $decoded = (array) JWT::decode($jwt, SessionManager::SECRET_KEY, array('HS256'));
    }catch(\Firebase\JWT\ExpiredException $e) {
      JWT::$leeway = 720000;

      $decoded = (array) JWT::decode($jwt, SessionManager::SECRET_KEY, ['HS256']);
      $issuedAt = new DateTimeImmutable();
      $expire =  $issuedAt->modify('+6 minutes')->getTimestamp();
      $decoded['iat'] = idate('U');
      $decoded['exp'] = idate('U', $expire);
      $_SESSION['username'] = JWT::encode($decoded, SessionManager::SECRET_KEY);
    }
    return $decoded;
  }
}
?>
