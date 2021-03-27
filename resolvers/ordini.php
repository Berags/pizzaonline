<?php
class OrdiniResolver {
	static function getOrdiniGiornalieri() {
		// Oggi
		return DBManager::query("SELECT * FROM `ordine` WHERE DATE(data_ora)=DATE(CURDATE())");
	}
	static function getOrdiniMensili() {
		// Ordini mensili
		return DBManager::query("SELECT * FROM `ordine` WHERE MONTH(data_ora)=MONTH(CURDATE())");
	}
	static function getOrdini() {
		// Ordini totali
		return DBManager::query("SELECT * FROM `ordine`");
	}

	static function getOrdineById($id) {
		return DBManager::query("SELECT * FROM `ordine` WHERE id_ordine=$id");
	}

	static function getPietanzeByOrdine(int $id) {
		return DBManager::query("SELECT * FROM `contiene` c NATURAL JOIN `pietanza` p WHERE id_ordine=$id");
	}

	static function creaOrdine($nome, $cognome, $telefono, $citta, $via, $civico, $pietanze, $quantita) {
		$cliente = DBManager::query("SELECT * FROM cliente WHERE nome='$nome' AND cognome='$cognome' AND telefono='$telefono'")[0];
		$id_cliente = $cliente['id_cliente'];
		if(empty($cliente)) {
			$id_cliente = DBManager::getLastInsertId("INSERT INTO cliente (nome, cognome, telefono) VALUES ('$nome', '$cognome', '$telefono')");
		}
		$arrayPietanze = array();
		foreach($pietanze as $pietanza) {
			$arrayPietanze[] = DBManager::query("SELECT * FROM pietanza WHERE id_pietanza=$pietanza AND visibile=1");
		}
		$prezzo_tot = 0;
		foreach($arrayPietanze as $key => $pietanza) {
			$prezzo_tot += $quantita[$key] * $pietanza[0]['prezzo'];
		}
		$id_ordine = DBManager::query("SELECT COALESCE(MAX(id_ordine)+1,1) as id_ordine FROM ordine")[0]['id_ordine'];
		DBManager::query("INSERT INTO ordine (id_ordine, data_ora, prezzo_tot, id_cliente, via, civico, citta)
		VALUES ($id_ordine, CURRENT_TIMESTAMP(), $prezzo_tot, $id_cliente, '$via', '$civico', '$citta')");
		foreach($arrayPietanze as $key => $pietanza) {
			DBManager::query("INSERT INTO contiene (id_pietanza, id_ordine, quantita) VALUES (" . $pietanza[0]['id_pietanza'] . ", " . $id_ordine . ", " . $quantita[$key] . ")");
		}
	}
}
?>
