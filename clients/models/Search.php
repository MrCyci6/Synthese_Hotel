<?php
require_once __DIR__ . '/Database.php';

class Search {
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
	 * @param int $id_hotel L'id de l'hôtel.
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

	/**
	 * Récupère toutes les infos d'un hôtel à partir de son id.
	 *
	 * @param int $hotelId L'id de l'hôtel
	 * @return array|null La liste des infos ou null sinon.
	 */
	public static function getHotelById(int $hotelId): ?array {
		$query = "SELECT h.id_hotel, h.nom, h.localisation, c.denomination AS categorie 
              FROM hotel h
              JOIN classe c ON h.id_classe = c.id_classe
              WHERE h.id_hotel = :id_hotel";
		$params = [':id_hotel' => $hotelId];
		$stmt = Database::preparedQuery($query, $params);
		return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
	}

	public static function getAvailableRooms(int $hotelId, string $dateDebut, string $dateFin): array {
		$query = "SELECT c.id_chambre, c.nom, c.capacite, c.prix 
              FROM chambre c
              WHERE c.id_hotel = :id_hotel
              AND c.id_chambre NOT IN (
                  SELECT r.id_chambre FROM reservation r
                  WHERE r.date_debut <= :dateFin AND r.date_fin >= :dateDebut
              )";
		$params = [
			':id_hotel' => $hotelId,
			':dateDebut' => $dateDebut,
			':dateFin' => $dateFin
		];
		$stmt = Database::preparedQuery($query, $params);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public static function getHotelId() : array {
		$query = "SELECT nom, id_hotel as id FROM hotel;";
		$stmt = Database::preparedQuery($query, []);
		return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
	}
}
