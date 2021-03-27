<?php
include_once './classes/DBManager.php';
include_once './resolvers/pietanze.php';
include_once './resolvers/ordini.php';
$link        = DBManager::getConnection();
$nome        = mysqli_real_escape_string($link, $_POST["nome"]);
$cognome     = mysqli_real_escape_string($link, $_POST["cognome"]);
$telefono    = mysqli_real_escape_string($link, $_POST["telefono"]);
$citta       = mysqli_real_escape_string($link, $_POST["citta"]);
$indirizzo   = mysqli_real_escape_string($link, $_POST["via"]);
$civico      = mysqli_real_escape_string($link, $_POST["civico"]);
$id_pietanza = $_POST["id"];
$quantita    = $_POST["quantita"];

OrdiniResolver::creaOrdine($nome, $cognome, $telefono, $citta, $indirizzo, $civico, $id_pietanza, $quantita);
?>
<h1>Ordine completato!</h1>
Puoi tornare alla <a href="./">Home</a>!
<script src="./static/js/carrello.js"></script>
<script>eliminaCarrello()</script>
