<?php
require_once __DIR__ . '/Database.php';

class Search {

	/**
	 * Récupère les hôtels disponibles en fonction de la localisation, des dates et de la catégorie.
	 *
	 * @param string $location  Localisation recherchée (partielle possible).
	 * @param string $dateDebut Date de début au format YYYY-MM-DD.
	 * @param string $dateFin   Date de fin au format YYYY-MM-DD.
	 * @param string $category  Catégorie de l'hôtel.
	 * @return array Liste des hôtels disponibles.
	 */
	public static function getAvailableHotels(string $location, string $dateDebut, string $dateFin, string $category): array {
		$query = "
        SELECT DISTINCT h.id_hotel, h.nom, h.localisation, cl.denomination AS categorie
        FROM hotel h
        JOIN classe cl ON h.id_classe = cl.id_classe
        JOIN chambre c ON h.id_hotel = c.id_hotel
        WHERE h.localisation ILIKE :location
          AND cl.denomination = :category
          AND c.id_chambre NOT IN (
              SELECT r.id_chambre
              FROM reservation r
              WHERE NOT (r.date_fin < :dateDebut OR r.date_debut > :dateFin)
          )
    ";
		$params = [
			':location'  => '%' . $location . '%',
			':category'  => $category,
			':dateDebut' => $dateDebut,
			':dateFin'   => $dateFin
		];
		$stmt = Database::preparedQuery($query, $params);
		return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
	}

	public static function getHotelList(): array {
		$query = "SELECT id_hotel, nom FROM hotel ORDER BY nom";
		$stmt = Database::preparedQuery($query, []);
		return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
	}

	public static function getHotelCategories(): array {
		$query = "SELECT DISTINCT denomination AS categorie FROM classe ORDER BY denomination";
		$stmt = Database::preparedQuery($query, []);
		return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
	}

	public static function checkAvailability(int $hotelId, string $dateDebut, string $dateFin): bool {
		$query = "
        SELECT COUNT(*) as available_rooms
        FROM chambre c
        WHERE c.id_hotel = :hotelId
          AND c.id_chambre NOT IN (
              SELECT r.id_chambre
              FROM reservation r
              WHERE NOT (r.date_fin < :dateDebut OR r.date_debut > :dateFin)
          )
    ";
		$params = [
			':hotelId'   => $hotelId,
			':dateDebut' => $dateDebut,
			':dateFin'   => $dateFin
		];
		$stmt = Database::preparedQuery($query, $params);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return ($result && (int)$result['available_rooms'] > 0);
	}
}
