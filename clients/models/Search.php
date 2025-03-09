<?php
require_once __DIR__ . '/Database.php';

class Search {

	/**
	 * Récupère la liste des catégories d'hôtels depuis la table classe.
	 *
	 * @return array Liste des catégories.
	 */
	public static function getHotelCategories(): array {
		$query = "SELECT DISTINCT cl.denomination AS categorie FROM classe cl ORDER BY cl.denomination";
		$stmt = Database::preparedQuery($query, []);
		return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
	}

	/**
	 * Récupère la liste des hôtels avec leur catégorie associée.
	 *
	 * @return array Liste des hôtels (id, nom et catégorie).
	 */
	public static function getHotelList(): array {
		$query = "SELECT h.id_hotel, h.nom, cl.denomination AS categorie 
                  FROM hotel h 
                  JOIN classe cl ON h.id_classe = cl.id_classe 
                  ORDER BY h.nom";
		$stmt = Database::preparedQuery($query, []);
		return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
	}

	/**
	 * Récupère la catégorie d'un hôtel à partir de son identifiant.
	 *
	 * @param int $id_hotel L'identifiant de l'hôtel.
	 * @return string|null La catégorie ou null si non trouvée.
	 */
	public static function getHotelCategory(int $id_hotel): ?string {
		$query = "SELECT cl.denomination AS categorie 
                  FROM hotel h 
                  JOIN classe cl ON h.id_classe = cl.id_classe 
                  WHERE h.id_hotel = :id_hotel";
		$stmt = Database::preparedQuery($query, [':id_hotel' => $id_hotel]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result ? $result['categorie'] : null;
	}
}
