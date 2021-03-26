<?php
header("Content-Type: application/json; charset=UTF-8");
include_once "../classes/DBManager.php";
include_once "../resolvers/ordini.php";
if(!isset($_GET["tipo"])) {
  if(empty(OrdiniResolver::GetOrdini()[0])) {
    echo json_encode((object)array());
    die();
  }
  echo json_encode(OrdiniResolver::GetOrdini());
  die();
}
if(strcmp($_GET["tipo"], "giornaliero") == 0) {
  if(empty(OrdiniResolver::GetOrdiniGiornalieri()[0])) {
    echo json_encode((object)array());
    die();
  }
  echo json_encode(OrdiniResolver::GetOrdiniGiornalieri());
  die();
}
if(strcmp($_GET["tipo"], "mensile") == 0) {
  if(empty(OrdiniResolver::GetOrdiniMensili()[0])) {
    echo json_encode((object)array());
    die();
  }
  echo json_encode(OrdiniResolver::GetOrdiniMensili());
  die();
}

?>
