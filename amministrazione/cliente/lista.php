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
        require_once '../../classes/SessionManager.php';
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
      <a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg dark-mode:bg-gray-700 dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="../../">Home</a>
      <a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="../../menu">Il nostro menu</a>
      <a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="../../carrello">Carrello</a>
      <a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="../">Amministrazione</a>
      <a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="../../login">Login</a>
    </nav>
  </div>
  <div class="container">
    <table id="dataTable" class="table text-uppercase table-hover table-bordered" data-page-length='50'>
      <thead>
        <th>Id</th>
        <th>Nome</th>
        <th>Cognome</th>
        <th>Telefono</th>
        <th></th>
      </thead>
    </table>
    <script src="../../static/js/jquery.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.24/datatables.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" charset="utf-8"></script>
    <script src="../../static/js/amministrazione_cliente.js"></script>
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
