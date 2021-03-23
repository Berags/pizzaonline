<?php 
header("Content-Type: application/json; charset=UTF-8");
include_once "../classes/DBManager.php";
include_once "../resolvers/ordini.php";
if(!isset($_GET["tipo"])) {
	echo json_encode(OrdiniResolver::GetOrdini());
	die();
}
if(strcmp($_GET["tipo"], "giornaliero") == 0) {
    echo json_encode(OrdiniResolver::GetOrdiniGiornalieri());
    die();
}
if(strcmp($_GET["tipo"], "mensile") == 0) {
    echo json_encode(OrdiniResolver::GetOrdiniMensili());
    die();
}

?>