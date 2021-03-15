<?php
include_once "../classes/DBManager.php";
include_once "../resolvers/ingredienti.php";
$dbLink       = DBManager::getConnection(); 
$nomePietanza = mysqli_real_escape_string($dbLink, $_POST["nome_pietanza"]);
$descrizione  = mysqli_real_escape_string($dbLink, $_POST["descrizione"]); 
$prezzo       = floatval($_POST["prezzo"]); 
$tipo         = mysqli_real_escape_string($dbLink, $_POST["tipo"]);
$ingredienti  = $_POST["ingredienti"];

// Rimuoviamo gli elementi doppi negli ingredienti
$ingredienti = array_unique($ingredienti);

// Controlliamo se sono presenti gli ingredienti inseriti dall'utente nel database
$nomeIngredientiDatabase = IngredientiResolver::GetNomeIngredienti();
foreach($ingredienti as $ingrediente) {
  if(!in_array($ingrediente, $nomeIngredientiDatabase)) {
    echo "Un ingrediente inserito non esiste nel database!";
    return;
  }
}

/*
TODO:
- Inserimento pietanza
- Ottenimento id della pietanza
- refactoring
- commenti
*/
IngredientiResolver::InserisciIngredientiPietanza($ingredienti, 4);

/* function checkType() { //Per fare l'effettivo controllo prima bisogna vedere come si vogliono inserire gli ingredienti
  $ingredienti_senza_glutine = DBManager::query("SELECT nome FROM ingrediente WHERE senza_glutine=true AND nome=".$ingrediente["nome"]);
  //controllo ingredienti per celiaci
  if($ingredienti_senza_glutine == NULL){
    echo "Non ci sono ingredienti per celiaci";
  } 
}
 */
//uploadFile();

function uploadFile() {
  $target_dir = "../static/images/menu/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
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
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }

  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 500000) {
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
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
}
?> 