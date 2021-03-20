<?php 
if(!isset($_POST["id"])) header("location: ./carrello");
$arrayIdPietanza = $_POST["id"];
$arrayQuantitaPietanza = $_POST["quantita"];
print_r($_POST["quantita"]);
?>
