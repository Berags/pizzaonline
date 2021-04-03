<?php
/**
* Classe che gestisce le interrogazioni dal database per gli ordini
*/
class OrdiniResolver {
	/**
	* Funzione che permette di ottenere tutti gli ordini del giorno
	* @return array tutti gli ordini del giorno
	*/
	static function getOrdiniGiornalieri(): array {
		return DBManager::query("SELECT * FROM `ordine` WHERE DATE(data_ora)=DATE(CURDATE())");
	}
	
	/**
	* Funzione che permette di ottenere tutti gli ordini del mese
	* @return array tutti gli ordini del mese
	*/
	static function getOrdiniMensili(): array {
		return DBManager::query("SELECT * FROM `ordine` WHERE MONTH(data_ora)=MONTH(CURDATE())");
	}
	
	/**
	* Funzione che permette di ottenere tutti gli ordini totali
	* @return array tutti gli ordini
	*/
	static function getOrdini(): array {
		return DBManager::query("SELECT * FROM `ordine`");
	}
	
	/**
	* Funzione che permette di ottenere il numero degli ordini di un cliente
	* @param int $id_cliente l'id del cliente
	* @return array l'array associativo per il numero degli ordini
	*/
	static function getNumeroOrdiniPerCliente(int $id_cliente): array {
		return DBManager::query("SELECT COUNT(*) as numero_ordini FROM ordine WHERE id_cliente=$id_cliente");
	}
	
	/**
	* Funzione che permette di ottenere tutti gli ordini di un solo cliente
	* @param int $id_cliente l'id del cliente
	* @return array tutti gli ordini di un solo cliente
	*/
	static function getOrdiniPerCliente(int $id_cliente): array {
		return DBManager::query("SELECT * FROM ordine WHERE id_cliente=$id_cliente");
	}
	
	/**
	* Funzione che permette di ottenere tutti un ordine dal suo id
	* @param int $id l'id dell'ordine
	* @return array l'ordine
	*/
	static function getOrdineById($id): array {
		return DBManager::query("SELECT * FROM `ordine` WHERE id_ordine=$id");
	}
	
	/**
	* Funzione che permette di ottenere tutte le pietanze di un ordine
	* @param int $id l'id dell'ordine
	* @return array tutte le pietanze dell'ordine
	*/
	static function getPietanzeByOrdine(int $id): array {
		return DBManager::query("SELECT * FROM `contiene` c NATURAL JOIN `pietanza` p WHERE id_ordine=$id");
	}
	
	/**
	* Funzione che permette di inserire un nuovo ordine
	* @param string $nome il nome del cliente
	* @param string $cognome il cognome del cliente
	* @param string $telefono il numero di telefono del cliente
	* @param string $citta la città dell'ordine
	* @param string $via il nome della via di consegna
	* @param string $civico il civico dove consegnare l'ordine
	* @param array $pietanze tutte le pietanze dell'ordine
	* @param array $quantita tutte le quantità dell'ordine
	*/
	static function creaOrdine(
		string $nome,
		string $cognome,
		string $telefono,
		string $citta,
		string $via,
		string $civico,
		array $pietanze,
		array $quantita
	) {
		// Controlliamo se il cliente esiste già
		$cliente = DBManager::query("SELECT * FROM cliente WHERE nome='$nome' AND cognome='$cognome' AND telefono='$telefono'")[0];
		$id_cliente = $cliente['id_cliente'];
		if(empty($cliente)) {
			// Il cliente non esiste --> lo creiamo
			$id_cliente = DBManager::getLastInsertId("INSERT INTO cliente (nome, cognome, telefono) VALUES ('$nome', '$cognome', '$telefono')");
		}
		
		$arrayPietanze = array();
		// Controlliamo se le pietanze sono esistono e sono "attive"
		foreach($pietanze as $pietanza) {
			$arrayPietanze[] = DBManager::query("SELECT * FROM pietanza WHERE id_pietanza=$pietanza AND visibile=1");
		}
		
		$prezzo_tot = 0;
		// Creiamo il prezzo totale
		foreach($arrayPietanze as $key => $pietanza) {
			$prezzo_tot += $quantita[$key] * $pietanza[0]['prezzo'];
		}
		$id_ordine = DBManager::query("SELECT COALESCE(MAX(id_ordine)+1, 1) as id_ordine FROM ordine")[0]['id_ordine'];
		DBManager::query("INSERT INTO ordine (id_ordine, data_ora, prezzo_tot, id_cliente, via, civico, citta)
		VALUES ($id_ordine, CURRENT_TIMESTAMP(), $prezzo_tot, $id_cliente, '$via', '$civico', '$citta')");
		foreach($arrayPietanze as $key => $pietanza) {
			// Inseriamo le pietanze
			DBManager::query("INSERT INTO contiene (id_pietanza, id_ordine, quantita) VALUES (" . $pietanza[0]['id_pietanza'] . ", " . $id_ordine . ", " . $quantita[$key] . ")");
		}
	}
}
