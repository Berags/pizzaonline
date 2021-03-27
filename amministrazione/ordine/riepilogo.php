<?php
/* Jacopo Beragnoli 5°IC */
session_start();
if(!isset($_SESSION["username"])) {
  header("location: ../");
}
?><?php
include_once "../../classes/DBManager.php";
include_once "../../resolvers/ordini.php";
if(!isset($_GET["id"])) {
  // Se non è presente il parametro ID nella richiesta di GET
  // Si ritorna alla pagina delle pietanze
  header("location: ./lista");
  die();
}
$ordine = OrdiniResolver::getOrdineById(mysqli_real_escape_string(DBManager::getConnection(), $_GET["id"]))[0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Riepilogo - I Tre Porcellini</title>
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
  <link rel="icon" href="../../static/images/logo.ico">
</head>
<body>
  <div class="flex items-center">
    <a class="w-full" onclick="mostraSidebar()">
      <svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" fill="currentColor" class="bi bi-list cursor-pointer" viewBox="0 0 16 16">
        <path class="ml-8" fill-rule="evenodd" d="M2.5 11.5A.5.5 0 0 1 3 11h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 3h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
      </svg>
    </a>
    <div class="flex w-1/3 justify-self-end items-center ml-64">
      <?php
      if(isset($_SESSION['username'])) {
        echo 'Bentornato, ' . $_SESSION['username'] . '!';
        ?>
        <form action="" method="POST">
          <button class="ml-2 focus:outline-none text-purple-600 text-sm py-2.5 px-5 rounded-md hover:bg-purple-100" type="submit">logout</button>
        </form>
        <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
          unset($_SESSION['username']);
          ?>
          <script>
          location.reload();
          </script>
          <?php
        }
      }
      ?>
    </div>
  </div>

  <div class="md:flex flex-col md:flex-row md:min-h-screen w-full" id="sidebar">
    <nav :class="{'block': open, 'hidden': !open}" class="flex-grow md:block px-4 pb-4 md:pb-0 md:overflow-y-auto">
      <a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg dark-mode:bg-gray-700 dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="../../">Home</a>
      <a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="../../menu">Il nostro menu</a>
      <a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="../../carrello">Carrello</a>
      <a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="../">Amministrazione</a>
      <a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="../../login">Login</a>
    </nav>
  </div>
  <div class="p-6 pl-6">
    <div class="flex flex-wrap items-baseline">
      <h1 class="w-full flex-none font-semibold mb-2.5">
        Ordine numero: <?php echo $ordine["id_ordine"]; ?>
      </h1>
      <div class="text-sm font-medium text-gray-400 mr-3">
        Totale:
      </div>
      <div class="text-4xl leading-7 font-bold text-purple-600">
        <?php echo number_format(floatval($ordine["prezzo_tot"]), 2); ?>
      </div>
    </div>
    <div class="flex items-baseline my-8">
      Data e ora ordinazione: <?php echo date_format(date_create($ordine["data_ora"]), "d/m/Y H:i"); ?>
      <br>
      Indirizzo spedizione: <?php echo $ordine["via"] . " " . $ordine["civico"] . ", " . $ordine["citta"]; ?>
      <br>
      <div class="flex ml-4">
        Cliente Numero:
        <a class="flex items-center text-blue-500" href="../cliente/riepilogo?id_cliente=<?php echo $ordine["id_cliente"]; ?>">&nbsp;<?php echo $ordine["id_cliente"]; ?>
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-right-square ml-2" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm5.854 8.803a.5.5 0 1 1-.708-.707L9.243 6H6.475a.5.5 0 1 1 0-1h3.975a.5.5 0 0 1 .5.5v3.975a.5.5 0 1 1-1 0V6.707l-4.096 4.096z"/>
          </svg>
        </a>
      </div>
    </div>
    <div class="ml-4">
      <ul style="list-style-type:disc">
        <?php
        /* Jacopo Beragnoli 5°IC */
        $pietanze = OrdiniResolver::getPietanzeByOrdine($ordine["id_ordine"]);
        if(!empty($pietanze)) {
          foreach($pietanze as $pietanza) {
            echo "<li>" . $pietanza["quantita"] . " x " .$pietanza["nome"];
            echo "</li>";
          }
        }
        ?>
      </ul>
    </div>
  </div>
  <a href="../" class="ml-6 focus:outline-none text-purple-600 text-sm py-2.5 px-5 rounded-md hover:bg-purple-100">Indietro</a>
  <script src="../../static/js/jquery.js"></script>
  <script>
  $("#sidebar").hide();
  var visibile = false;
  const mostraSidebar = () => {
    if(visibile) {
      $("#sidebar").fadeOut();
    }else {
      $("#sidebar").fadeIn();
    }
    visibile = !visibile;
  }
</script>
</body>
</html>
