<?php include_once "./components/heading.php"; ?>
<body>
	<?php include_once "./components/sidebar.php"; ?>
	<?php
	include_once "./classes/DBManager.php";
	include_once "./resolvers/pietanze.php";

	// Mostra solo il menu se non è presente alcuna pietanza
	if(!isset($_GET["id_pietanza"])) {
		include_once "./components/menu.php";
		return;
	}

	// Quello che vogliamo vedere è una pietanza specifica
	$pietanza = PietanzeResolver::GetPizzaById($_GET["id_pietanza"]);
	include_once "./components/pizza.php";
	?>
</body>
