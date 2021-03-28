<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>I tre porcellini - Carrello</title>
  <link rel="stylesheet" href="./static/css/bootstrap.min.css">
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
  <link rel="icon" href="./static/images/logo.ico">
  <script src="./static/js/jquery.js"></script>
</head>
<body>
  <!-- SIDEBAR -->
  <div class="flex items-center">
    <a onclick="mostraSidebar()" id="sidebarButton" class="w-full">
      <svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" fill="currentColor" class="bi bi-list cursor-pointer" viewBox="0 0 16 16">
        <path class="ml-8" fill-rule="evenodd" d="M2.5 11.5A.5.5 0 0 1 3 11h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 3h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
      </svg>
    </a>
    <div class="flex w-1/3 justify-self-end items-center ml-64">
      <?php
      session_start();
      require_once './classes/SessionManager.php';
      if(isset($_SESSION['username'])) {
        echo 'Bentornato, ' . SessionManager::decode($_SESSION['username'])['username'] . '!';
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
      <a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg dark-mode:bg-gray-700 dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="./">Home</a>
      <a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="./menu">Il nostro menu</a>
      <a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="./carrello">Carrello</a>
      <a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="./amministrazione/">Amministrazione</a>
      <a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="./login">Login</a>
    </nav>
  </div>
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
  <!-- SIDEBAR -->
  <div class="container mx-auto px-5 bg-white">
    <div class="flex lg:flex-row flex-col-reverse shadow-lg">
      <div class="w-full lg:w-3/5 min-h-screen shadow-lg">
        <div class="flex flex-row justify-between items-center px-5 mt-5">
          <div class="text-gray-800">
            <div class="font-bold text-xl">Pizzeria "I Tre Porcellini"</div>
          </div>
          <div class="flex items-center">
            <div class="text-sm text-center mr-4">
              <div class="font-light text-gray-500">last synced</div>
              <span class="font-semibold">3 mins ago</span>
            </div>
          </span>
        </div>
      </div>
      <div class="grid grid-cols-3 gap-2 px-5 mt-5 overflow-y-auto">
        <script>
        const aggiungiCarrelloDaCarrello = (id, quantita, nome, imgpath, prezzo) => {
          aggiungiElementoAlCarrello(id, quantita, nome, imgpath, prezzo);
          location.reload();
        }
        </script>
        <?php
        include_once "./classes/DBManager.php";
        include_once "./resolvers/pietanze.php";
        $menu = PietanzeResolver::getMenu();

        foreach($menu as $pietanza) {
          //TODO(bera): filtrare le pietanze in base al tipo (rossa, bianca e senza glutine)
          ?>
          <div class="px-3 py-3 flex flex-col border border-gray-200 rounded-md h-36 justify-between">
            <div>
              <div class="font-bold text-gray-800 overflow-y-auto h-12"><a href="./menu?id_pietanza=<?php echo $pietanza['id_pietanza']; ?>&back=./carrello"><?php echo $pietanza["nome"]; ?></a></div>
            </div>
            <div class="flex flex-row justify-between items-center">
              <span class="self-end font-bold text-lg text-yellow-500">€<?php echo $pietanza["prezzo"]; ?>
                <button type="button" class="ml-2 text-black" data-bs-toggle="tooltip" data-bs-placement="right" title="Aggiungi al carrello" onclick="aggiungiCarrelloDaCarrello(<?php echo $pietanza['id_pietanza']; ?>, 1, '<?php echo $pietanza['nome']; ?>', '<?php echo $pietanza['imgpath']; ?>', <?php echo $pietanza['prezzo']; ?>);">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                    <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"/>
                    <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                  </svg>
                </button>
              </span>
              <img src="./static/images/menu/<?php echo $pietanza['imgpath'] ?>" class=" h-14 w-14 object-cover rounded-md" alt="">
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
    <div class="w-full lg:w-2/5">
      <div class="flex flex-row items-center justify-between px-5 mt-5">
        <div class="font-bold text-xl">Ordine corrente</div>
        <div class="font-semibold">
          <span class="px-4 py-2 rounded-md bg-red-100 text-red-500 cursor-pointer" onclick="eliminaCarrello()">Svuota carrello</span>
        </div>
      </div>
      <form action="post_ordine.php" method="POST" class="px-5 py-4 mt-5 overflow-y-auto h-64" id="ordini">
      </form>
      <div class="px-5 mt-5">
        <div class="py-2 rounded-md shadow-lg">
          <div class="mt-3 pb-2 px-4 flex items-center justify-between">
            <span class="font-semibold text-2xl">Totale</span>
            <span class="font-bold text-2xl" id="totale">€0.00</span>
          </div>
        </div>
      </div>
      <div class="px-5 mt-5">
        <div class="px-4 py-4 rounded-md shadow-lg text-center bg-purple-700 text-white font-semibold cursor-pointer" onclick="controllaInvio()">
          Ordina
        </div>
      </div>
    </div>
  </div>
</div>
<script src="./static/js/carrello.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" charset="utf-8"></script>
<script>
$(document).ready(() => {
  componiTabella(ottieniCarrello())
});
</script>
</body>
</html>
