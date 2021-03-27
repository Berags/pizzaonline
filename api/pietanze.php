<?php
header("Content-Type: application/json; charset=UTF-8");
include_once "../classes/DBManager.php";
include_once "../resolvers/pietanze.php";
if(isset($_GET['method']) && $_GET['method'] == "delete") {
	DeletePietanza();
	return;
}
GetPietanze();

function GetPietanze() {
	echo json_encode(PietanzeResolver::getMenu());
}

function DeletePietanza() {
	$response = array("status" => "ok", "message" => "Pietanza correttamente eliminata!");
	PietanzeResolver::eliminaPietanza(mysqli_real_escape_string(DBManager::getConnection(), $_GET["id"]));
	echo json_encode($response);
}
?>
