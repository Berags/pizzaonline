<?php
/* Jacopo Beragnoli 5°IC */
class AccountResolver {
  static function getUserFromUsername(string $username) {
    return DBManager::query("SELECT * FROM account WHERE username='$username' LIMIT 1");
  }
}
?>
