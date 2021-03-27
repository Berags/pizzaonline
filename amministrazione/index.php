<!DOCTYPE html>
<html lang="en">
<head>
	<?php
	session_start();
	if(!isset($_SESSION["username"])) {
		header("location: ../");
	}
	?>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Amministrazione - I Tre Porcellini</title>
	<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
	<link rel="icon" href="../static/images/logo.ico">
</head>
<body>
	<style>
	.bannerFondo{
		height: 400px;
	}
	</style>
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
			<a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg dark-mode:bg-gray-700 dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="../">Home</a>
			<a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="../menu">Il nostro menu</a>
			<a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="../carrello">Carrello</a>
			<a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="#">Amministrazione</a>
			<a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="../login">Login</a>
		</nav>
	</div>
	<div>
		<div class="bannerFondo bg-purple-800 bg-left-top bg-auto bg-repeat-x">
		</div>
		<div class="-mt-64 ">
			<div class="w-full text-center">
				<p class="text-sm tracking-widest text-white">Amministrazione</p>
				<h1 class="font-bold text-5xl text-white">
					I Tre Porcellini
				</h1>
			</div>

			<div class="grid grid-cols-1 gap-4 sm:grid-cols-3 ">

				<a class="p-2 sm:p-10 text-center cursor-pointer" href="./pietanza/lista">
					<div class="py-16 max-w-sm rounded overflow-hidden shadow-lg hover:bg-white transition duration-500  bg-white">
						<div class="space-y-10">
							<i class="fas fa-pizza-slice" style="font-size:48px;"></i>

							<div class="px-6 py-4">
								<div class="space-y-5">
									<div class="font-bold text-xl mb-2">Pietanze</div>
									<p class="text-gray-700 text-base">
										Creazione, Modifica e Eliminazione Pietanze
									</p>
								</div>
							</div>
						</div>
					</div>
				</a>

				<a class="p-2 sm:p-10 text-center cursor-pointer text-white" href="./ordine/lista">
					<div class="py-16 max-w-sm rounded overflow-hidden shadow-lg bg-purple-500 hover:bg-orange-600 transition duration-500">
						<div class="space-y-10">
							<i class="fas fa-chart-line" style="font-size:48px;"></i>
							<div class="px-6 py-4">
								<div class="space-y-5">
									<div class="font-bold text-xl mb-2">Ordini</div>
									<p class="text-base">
										Visualizzazione e Riepilogo Ordini
									</p>
									<p></p>
								</div>
							</div>
						</div>
					</div>
				</a>

				<a class="p-2 sm:p-10 text-center cursor-pointer translate-x-2" href="./cliente/lista">
					<div class="py-16 max-w-sm rounded overflow-hidden shadow-lg hover:bg-white transition duration-500 bg-white">
						<div class="space-y-10">
							<i class="fas fa-user-friends" style="font-size:48px;"></i>
							<div class="px-6 py-4">
								<div class="space-y-5">
									<div class="font-bold text-xl mb-2">Clienti</div>
									<p class="text-gray-700 text-base">
										Visualizzazione e Riepilogo Clienti
									</p>
									<p></p>
								</div>
							</div>
						</div>
					</div>
				</a>

			</div>
		</div>

	</div>
	<script src="../static/js/jquery.js"></script>
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
