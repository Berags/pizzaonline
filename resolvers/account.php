<?php
/* Jacopo Beragnoli 5°IC */
class AccountResolver {
  static function GetUserFromUsername(string $username) {
    ?>
    <script>
    console.table(<?php echo json_encode(DBManager::query("SELECT * FROM account WHERE username='$username'")[0]);
    ?>)
    </script>
    <?php
    return DBManager::query("SELECT * FROM account WHERE username='$username' LIMIT 1");
  }
}
?>
