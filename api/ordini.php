<?php
header("Content-Type: application/json; charset=UTF-8");
include_once '../classes/DBManager.php';
include_once '../resolvers/ordini.php';
if(!isset($_GET['tipo'])) {
  if(empty(OrdiniResolver::getOrdini()[0])) {
    echo json_encode((object)array());
    die();
  }
  echo json_encode(OrdiniResolver::getOrdini());
  die();
}
if(strcmp($_GET['tipo'], 'giornaliero') == 0) {
  if(empty(OrdiniResolver::getOrdiniGiornalieri()[0])) {
    echo json_encode((object)array());
    die();
  }
  echo json_encode(OrdiniResolver::getOrdiniGiornalieri());
  die();
}
if(strcmp($_GET['tipo'], 'mensile') == 0) {
  if(empty(OrdiniResolver::getOrdiniMensili()[0])) {
    echo json_encode((object)array());
    die();
  }
  echo json_encode(OrdiniResolver::getOrdiniMensili());
  die();
}
