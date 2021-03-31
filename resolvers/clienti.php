<?php
class ClientiResolver {
  static function getClienti() {
    return DBManager::query("SELECT * FROM cliente");
  }
  
  static function getClienteById(int $id) {
    return DBManager::query("SELECT * FROM cliente WHERE id_cliente=$id")[0];
  }
}
?>
