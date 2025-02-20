<?php
require_once __DIR__ . '/Database.php';

class Conso {

	public static function getAllAvailableConsos(): array {
		$query = "SELECT id_conso, denomination FROM conso ORDER BY denomination";
		$stmt = Database::preparedQuery($query, []);
		return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
	}

	/**
	 * Récupère toutes les consommations associées à un séjour donné.
	 *
	 * @param int $sejourId L'identifiant du séjour.
	 * @return array Un tableau associatif contenant les consommations.
	 */
	public static function getConsommationsForSejour(int $sejourId): array {
		$query = "
		    SELECT 
		        cc.id_cc,
		        cc.date_conso,
		        cc.nombre,
		        c.denomination AS conso_name,
		        pc.prix AS unit_price,
		        (pc.prix * cc.nombre) AS prix_total
		    FROM conso_client cc
		    JOIN reservation r ON cc.id_sejour = r.id_sejour
		    JOIN chambre ch ON r.id_chambre = ch.id_chambre
		    JOIN prix_conso pc ON cc.id_conso = pc.id_conso AND ch.id_hotel = pc.id_hotel
		    JOIN conso c ON cc.id_conso = c.id_conso
		    WHERE cc.id_sejour = :id_sejour
		";


		$params = [':id_sejour' => $sejourId];
		$stmt = Database::preparedQuery($query, $params);
		return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
	}

	public static function getTotalConsommationsAmount(int $sejourId): float {
		$query = "
	        SELECT COALESCE(SUM(pc.prix * cc.nombre), 0) AS total_amount
	        FROM conso_client cc
	        JOIN reservation r ON cc.id_sejour = r.id_sejour
	        JOIN chambre ch ON r.id_chambre = ch.id_chambre
	        JOIN prix_conso pc 
	            ON cc.id_conso = pc.id_conso
	            AND ch.id_hotel = pc.id_hotel
	        WHERE cc.id_sejour = :id_sejour
		";

		$params = [':id_sejour' => $sejourId];
		$stmt = Database::preparedQuery($query, $params);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return (float)$result['total_amount'];
	}

	/**
	 * Ajoute une consommation pour un séjour donné.
	 *
	 * @param int $sejourId L'identifiant du séjour.
	 * @param int $idConso L'identifiant de la consommation.
	 * @param int $nombre Le nombre de consommations à ajouter.
	 * @return bool True en cas de succès, false sinon.
	 */
	public static function addConsommation(int $sejourId, int $idConso, int $nombre): bool {
		$query = "INSERT INTO conso_client (id_sejour, id_conso, date_conso, nombre)
                  VALUES (:id_sejour, :id_conso, NOW(), :nombre)";
		$params = [
			':id_sejour' => $sejourId,
			':id_conso'  => $idConso,
			':nombre'    => $nombre
		];
		return Database::preparedQuery($query, $params) !== false;
	}

	/**
	 * Récupère les consommations historiques d'un client (réservations terminées).
	 *
	 * @param int $userId L'identifiant du client.
	 * @return array Un tableau associatif des consommations historiques.
	 */
	public static function getHistoricalConsumptionsByClient(int $userId): array {
		$query = "
	        SELECT 
	            cc.id_cc,
	            cc.id_sejour,
	            cc.date_conso,
	            cc.nombre,
	            pc.prix AS unit_price,
	            (pc.prix * cc.nombre) AS prix_total,
	            c.denomination AS conso_name,
	            r.date_debut,
	            r.date_fin,
	            h.nom AS hotel_name
	        FROM conso_client cc
	        JOIN reservation r ON cc.id_sejour = r.id_sejour
	        JOIN chambre ch ON r.id_chambre = ch.id_chambre
	        JOIN hotel h ON ch.id_hotel = h.id_hotel
	        JOIN prix_conso pc ON cc.id_conso = pc.id_conso AND ch.id_hotel = pc.id_hotel
	        JOIN conso c ON cc.id_conso = c.id_conso
	        WHERE r.id_user = :id_user
	          AND r.date_fin < CURRENT_DATE
	        ORDER BY cc.date_conso DESC
	    ";
		$params = [':id_user' => $userId];
		$stmt = Database::preparedQuery($query, $params);
		return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
	}


}
