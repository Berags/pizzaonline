<?php
session_start();
if(!isset($_SESSION["username"])) {
	header("location: ../");
}
include_once "../../classes/DBManager.php";
include_once "../../resolvers/ingredienti.php";
$dbLink       = DBManager::getConnection();
$nomeIngrediente = mysqli_real_escape_string($dbLink, $_POST["nome_ingrediente"]);
$celiachia = 0;
if(isset($_POST["celiaco"]))
$celiachia  = 1;
IngredientiResolver::inserisciIngredienti($nomeIngrediente, $celiachia);
echo "<script>window.close();</script>";
header("location: ../");
