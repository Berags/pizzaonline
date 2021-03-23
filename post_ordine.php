<?php 
if(!isset($_POST["id"])) header("location: ./carrello");
include_once "./classes/DBManager.php";
include_once "./resolvers/pietanze.php";
$arrayIdPietanza = $_POST["id"];
$arrayQuantitaPietanza = $_POST["quantita"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
	<script src="./static/js/jquery.js"></script>
	<?php 
	/* Jacopo Beragnoli 5°IC */
	include_once "./components/sidebar.php";
	?>
	<form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col my-2" method="POST" action="ordine_completato.php">
		<div class="-mx-3 md:flex mb-6">
			<div class="md:w-1/2 px-3 mb-6 md:mb-0">
				<label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
					Nome
				</label>
				<input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" id="grid-first-name" type="text" name="nome">
			</div>
			<div class="md:w-1/2 px-3">
				<label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-last-name">
					Cognome
				</label>
				<input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" id="grid-last-name" type="text" name="cognome">
			</div>
		</div>
		<div class="-mx-3 md:flex mb-6">
			<div class="md:w-full px-3">
				<label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-password">
					Telefono
				</label>
				<input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3" id="grid-password" type="tel" name="telefono">
			</div>
		</div>
		<div class="-mx-3 md:flex mb-2">
			<div class="md:w-1/2 px-3 mb-6 md:mb-0">
				<label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-city">
					City
				</label>
				<input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" id="grid-city" type="text" placeholder="Pistoia" name="citta">
			</div>
			<div class="md:w-1/2 px-3 mb-6 md:mb-0">
				<label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-city">
					Via
				</label>
				<input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" id="grid-city" type="text" name="via">
			</div>
			<div class="md:w-1/2 px-3">
				<label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-zip">
					Civico
				</label>
				<input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" id="grid-zip" type="text" name="civico">
			</div>
		</div>
		<div>
			<h1>Riepilogo</h1>
			<ul style="list-style-type: circle;" class="ml-6">
				<?php 
				foreach($arrayIdPietanza as $key => $pietanza ) { 
					$objPietanza = PietanzeResolver::GetPizzaById($pietanza)[0];
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
	</body>
	</html>