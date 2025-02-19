<?php
require_once __DIR__ . '/Database.php';

class Conso {

	/**
	 * Récupère toutes les consommations associées à un séjour donné.
	 *
	 * @param int $sejourId L'identifiant du séjour.
	 * @return array Un tableau associatif contenant les consommations.
	 */
	public static function getConsommationsForSejour(int $sejourId): array {
		$query = "SELECT cc.id_cc, cc.date_conso, cc.nombre, (pc.prix * cc.nombre) AS prix_total
                  FROM conso_client cc
                  JOIN public.prix_conso pc ON cc.id_conso = pc.id_conso
                  WHERE cc.id_sejour = :id_sejour";
		$params = [':id_sejour' => $sejourId];
		$stmt = Database::preparedQuery($query, $params);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	/**
	 * Récupère le nombre total de consommations pour un séjour donné.
	 *
	 * @param int $sejourId L'identifiant du séjour.
	 * @return int Le total des consommations (somme de 'nombre').
	 */
	public static function getTotalNombreConsommations(int $sejourId): int {
		$query = "SELECT SUM(nombre) AS total FROM conso_client WHERE id_sejour = :id_sejour";
		$params = [':id_sejour' => $sejourId];
		$stmt = Database::preparedQuery($query, $params);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return isset($result['total']) ? (int)$result['total'] : 0;
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
}
