<?php
/* Jacopo Beragnoli 5°IC */
session_start();
if(!isset($_SESSION["username"])) {
  header("location: ../");
}

include_once "../../classes/DBManager.php";
include_once "../../resolvers/pietanze.php";
include_once "../../resolvers/ingredienti.php";
$dbLink       = DBManager::getConnection();
$id           = $_POST["id_pietanza"];
$nomePietanza = mysqli_real_escape_string($dbLink, $_POST["nome_pietanza"]);
$descrizione  = mysqli_real_escape_string($dbLink, $_POST["descrizione"]);
$prezzo       = floatval($_POST["prezzo"]);
$tipo         = mysqli_real_escape_string($dbLink, $_POST["tipo"]);
$ingredienti  = $_POST["ingredienti"];
print_r($ingredienti);
// Rimuoviamo gli elementi doppi negli ingredienti
$ingredienti = array_filter($ingredienti);
$ingredienti = array_unique($ingredienti);
print_r($ingredienti);
// Controlliamo se sono presenti gli ingredienti inseriti dall'utente nel database
$nomeIngredientiDatabase = IngredientiResolver::getNomeIngredienti();
foreach($ingredienti as $ingrediente) {
  if(!in_array($ingrediente, $nomeIngredientiDatabase)) {
    echo "Un ingrediente inserito non esiste nel database!";
    return;
  }
}

$immagine = uploadFile();
if($immagine == "") {
  $immagine = PietanzeResolver::getImmaginePietanza($id)["imgpath"];
}
PietanzeResolver::modificaPietanza($id, $nomePietanza, $descrizione, $tipo, $prezzo, $immagine);
IngredientiResolver::eliminaIngredientiPietanza($id);
IngredientiResolver::inserisciIngredientiPietanza($ingredienti, $id);
//header("location: ../pietanza/lista");

function uploadFile() {
  $target_dir = "../../static/images/menu/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  if(empty(basename($_FILES["fileToUpload"]["name"]))) {
    return "";
  }
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  // Check if image file is a actual image or fake image
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

  // Check if file already exists
  if (file_exists($target_file)) {
    unlink($target_file);
    echo "L'immagine esisteva già, è stata quindi rimpiazzata.";
    $uploadOk = 1;
  }

  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }

  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
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
?>
