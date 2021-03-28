<?php
if(!isset($_POST["id"])) header("location: ./carrello");
include_once "./classes/DBManager.php";
include_once "./resolvers/pietanze.php";
$arrayIdPietanza = $_POST["id"];
$arrayQuantitaPietanza = $_POST["quantita"];
?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>I tre porcellini - Ordine</title>
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
  <link rel="icon" href="./static/images/logo.ico">
</head>
<body>
	<script src="./static/js/jquery.js"></script>
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
      if(isset($_SESSION['username'])) {
      require_once './classes/SessionManager.php';
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
	<form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col my-2" method="POST" action="ordine_completato.php">
		<div class="-mx-3 md:flex mb-6">
			<div class="md:w-1/2 px-3 mb-6 md:mb-0">
				<label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
					Nome
				</label>
				<input required class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" id="grid-first-name" type="text" name="nome">
			</div>
			<div class="md:w-1/2 px-3">
				<label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-last-name">
					Cognome
				</label>
				<input required class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" id="grid-last-name" type="text" name="cognome">
			</div>
		</div>
		<div class="-mx-3 md:flex mb-6">
			<div class="md:w-full px-3">
				<label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-password">
					Telefono
				</label>
				<input required class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3" id="grid-password" type="tel" name="telefono">
			</div>
		</div>
		<div class="-mx-3 md:flex mb-2">
			<div class="md:w-1/2 px-3 mb-6 md:mb-0">
				<label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-city">
					City
				</label>
				<input required class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" id="grid-city" type="text" placeholder="Pistoia" name="citta">
			</div>
			<div class="md:w-1/2 px-3 mb-6 md:mb-0">
				<label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-city">
					Via
				</label>
				<input required class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" id="grid-city" type="text" name="via">
			</div>
			<div class="md:w-1/2 px-3">
				<label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-zip">
					Civico
				</label>
				<input required class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" id="grid-zip" type="text" name="civico">
			</div>
		</div>
		<div>
			<h1>Riepilogo</h1>
			<ul style="list-style-type: circle;" class="ml-6">
				<?php
				foreach($arrayIdPietanza as $key => $pietanza ) {
					$objPietanza = PietanzeResolver::getPizzaById($pietanza)[0];
					?>
					<li>
						<input type="hidden" name="id[]" value="<?php echo $pietanza; ?>">
						<input type="hidden" name="quantita[]" value="<?php echo $arrayQuantitaPietanza[$key]; ?>">
						<?php echo $arrayQuantitaPietanza[$key] . " x " . $objPietanza["nome"]; ?></li>
					<?php }
					?>
				</ul>
			</div>
			<div class="flex flex-wrap px-5 mt-5 gap-4 place-content-center">
				<button type="button" onclick="window.location.href = './carrello'" class="px-4 py-4 rounded-md shadow-lg text-center bg-purple-700 text-white font-semibold w-1/3" onclick="controllaInvio()">
					Indietro
				</button>
				<button type="submit" class="px-4 py-4 rounded-md shadow-lg text-center bg-purple-700 text-white font-semibold w-1/3" onclick="controllaInvio()">
					Ordina
				</button>
			</div>
		</form>
		<script src="./static/js/jquery.js"></script>
	  <script src="./static/js/carrello.js"></script>
	  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" charset="utf-8"></script>
	</body>
	</html>
