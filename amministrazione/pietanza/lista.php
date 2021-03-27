<!DOCTYPE html>
<html lang="en">
<head>
  <?php
  /* Jacopo Beragnoli 5°IC */
  session_start();
  if(!isset($_SESSION["username"])) {
    header("location: ../");
  }
  ?>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Amministrazione - I tre porcellini</title>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.24/datatables.min.css"/>
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
  <link rel="icon" href="../../static/images/logo.ico">
</head>
<body>
  <!-- SIDEBAR -->
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
  <div class="container row col-12 text-center" id="gestioneLavori">
    <div class="col-6 border">
      <label for="gestioneLavori" class="text-justify h2 flex self-center">
        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-table" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z" />
        </svg>
        <span class="ml-2">GESTIONE PIETANZE</span>
      </label>
      <br />
      <a class="btn btn-info form-control text-white col-4" href="./inserimento">Inserisci Pietanza</a>
      <a class="btn btn-info form-control text-white col-4" href="./inserimento_ingredienti">Inserisci Ingrediente</a>
      <p></p>
    </div>
    <div class="border col-6" id="stampe">
      <label for="stampe" class="text-justify h2 flex">
        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-richtext" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M4 0h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H4z" />
          <path fill-rule="evenodd" d="M4.5 11.5A.5.5 0 0 1 5 11h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 9h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm1.639-3.708l1.33.886 1.854-1.855a.25.25 0 0 1 .289-.047l1.888.974V7.5a.5.5 0 0 1-.5.5H5a.5.5 0 0 1-.5-.5V7s1.54-1.274 1.639-1.208zM6.25 5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5z" />
        </svg>
        <span class="ml-2">GESTIONE ORDINI</span>
      </label>
      <br />
      <a class="btn btn-success form-control text-white col-4" href="../ordine/lista?tipo=giornaliero">Giornalieri</a>
      <a class="btn btn-success form-control text-white col-4" href="../ordine/lista?tipo=mensile">Mensili</a>
      <p class="mt-2"></p>
      <a class="btn btn-success form-control text-white col-4" href="../cliente/lista">Clienti</a>
      <p class="mb-4"></p>
    </div>
  </div>
  <div class="container">
    <table id="dataTable" class="table text-uppercase table-hover table-bordered" data-page-length='50'>
      <thead>
        <th>Id</th>
        <th>Nome</th>
        <th>Tipo</th>
        <th>Prezzo</th>
        <th></th>
      </thead>
    </table>
    <script src="../../static/js/jquery.js"></script>
    <script src="../../static/js/amministrazione_pietanze.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.24/datatables.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" charset="utf-8"></script>
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
  </div>
</body>
</html>
