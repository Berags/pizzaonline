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
  <title>Document</title>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.24/datatables.min.css"/>
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
</head>
<body>
    <a onclick="mostraSidebar()">
        <svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" fill="currentColor" class="bi bi-list cursor-pointer" viewBox="0 0 16 16">
            <path class="ml-8" fill-rule="evenodd" d="M2.5 11.5A.5.5 0 0 1 3 11h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 3h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
        </svg>
    </a>
    <div class="md:flex flex-col md:flex-row md:min-h-screen w-full" id="sidebar">
        <nav :class="{'block': open, 'hidden': !open}" class="flex-grow md:block px-4 pb-4 md:pb-0 md:overflow-y-auto">
            <a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg dark-mode:bg-gray-700 dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="../../">Home</a>
            <a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="../../menu">Il nostro menu</a>
            <a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="../../carrello">Carrello</a>
            <a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="../">Amministrazione</a>
            <a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="../../login">Login</a>
        </nav>
    </div>
    <div class="justify-self-center">
        <?php 
        /* Jacopo Beragnoli 5°IC */
        if(isset($_GET["tipo"]) && strcmp($_GET["tipo"], "giornaliero") == 0) {
            ?>
            <h1 class="my-3 text-3xl font-semibold text-gray-700 dark:text-gray-200"><?php echo "LISTA ORDINI GIORNALIERI";
            ?></h1>
            <?php
        }else if(isset($_GET["tipo"])) {
            ?>
            <h1 class="my-3 text-3xl font-semibold text-gray-700 dark:text-gray-200"><?php echo "LISTA ORDINI GIORNALIERI";
            ?></h1>
            <?php
        }
        ?>
    </div>
    <table id="dataTable" class="table text-uppercase table-hover table-bordered" data-page-length='50'>
        <thead>
            <th>Id</th>
            <th>Data e Ora</th>
            <th>Prezzo totale</th>
            <th>Cliente</th>
            <th></th>
        </thead>
    </table>
    <script src="../../static/js/jquery.js"></script>
    <script src="../../static/js/amministrazione_ordini.js"></script>
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
    <?php
    if(!isset($_GET["tipo"])) {
      // Tutto 
      ?>
      <script>
        $(document).ready(tabellaTotale());
    </script> 
<?php }

if(isset($_GET["tipo"]) && strcmp($_GET["tipo"], "giornaliero") == 0) {
    ?>
    <script>
        $(document).ready(tabellaGiornaliero());
    </script> 
    <?php
}

if(isset($_GET["tipo"]) && strcmp($_GET["tipo"], "mensile") == 0) {
    ?>
    <script>
        $(document).ready(tabellaMensile());
    </script>  
    <?php 
}
?>
</body>
</html>