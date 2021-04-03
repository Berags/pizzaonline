<?php
/* Jacopo Beragnoli 5°IC */
session_start();
if(!isset($_SESSION['username'])) {
  header('location: ../');
}
include_once '../../classes/DBManager.php';
include_once '../../resolvers/pietanze.php';
include_once '../../resolvers/ingredienti.php';
$dbLink       = DBManager::getConnection();
$nomePietanza = mysqli_real_escape_string($dbLink, $_POST['nome_pietanza']);
$descrizione  = mysqli_real_escape_string($dbLink, $_POST['descrizione']);
$prezzo       = floatval($_POST['prezzo']);
$tipo         = mysqli_real_escape_string($dbLink, $_POST['tipo']);
$ingredienti  = $_POST['ingredienti'];

// Rimuoviamo gli elementi doppi negli ingredienti
$ingredienti = array_filter($ingredienti);
$ingredienti = array_unique($ingredienti);

// Controlliamo se sono presenti gli ingredienti inseriti dall'utente nel database
$nomeIngredientiDatabase = IngredientiResolver::getNomeIngredienti();
foreach($ingredienti as $ingrediente) {
  if(!in_array($ingrediente, $nomeIngredientiDatabase)) {
    echo "Un ingrediente inserito non esiste nel database!";
    return;
  }
}

$immagine = uploadFile();
$id_pietanza = PietanzeResolver::inserisciPietanza($nomePietanza, $descrizione, $tipo, $prezzo, $immagine);
IngredientiResolver::inserisciIngredientiPietanza($ingredienti, intval($id_pietanza));
header('location: ../pietanza/lista');

function uploadFile() {
  $target_dir = "../../static/images/menu/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
      echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
    }
  }
  
  if (file_exists($target_file)) {
    unlink($target_file);
    echo "L'immagine esisteva già, è stata quindi rimpiazzata.";
    $uploadOk = 1;
  }
  
  if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }
  
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }
  
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
      return basename( $_FILES["fileToUpload"]["name"]);
    } else {
      echo "Sorry, there was an error uploading your file.";
      return "";
    }
  }
}
