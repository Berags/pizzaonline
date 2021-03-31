<?php
header("Content-Type: application/json; charset=UTF-8");
include_once "../classes/DBManager.php";
include_once "../resolvers/clienti.php";
echo json_encode(ClientiResolver::getClienti());
?>
