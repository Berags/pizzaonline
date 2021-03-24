<?php 
/* Jacopo Beragnoli 5°IC */
session_start();
if(!isset($_SESSION["username"])) {
	header("location: ../");
}
?>