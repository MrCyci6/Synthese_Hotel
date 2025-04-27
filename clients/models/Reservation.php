<?php
require_once __DIR__ . '/Database.php';

class Reservation {

	/**
	 * Crée une nouvelle réservation avec une transaction.
	 *
	 * @param int    $userId      L'identifiant du client.
	 * @param int    $hotelId     L'identifiant de l'hôtel.
	 * @param string $categorie   La dénomination de la catégorie de chambre.
	 * @param string $dateDebut   Date de début (format YYYY-MM-DD).
	 * @param string $dateFin     Date de fin (format YYYY-MM-DD).
	 * @param float  $paiement    Le prix de la réservation.
	 * @return int|false L'ID de la nouvelle réservation si l'insertion réussit, false sinon.
	 */
	public static function createReservationWithTransaction(int $userId, int $hotelId, string $categorie, string $dateDebut, string $dateFin, float $paiement) {
		$db = Database::getConnection();
		$db->beginTransaction();
		try {
			// Récupérer l'ID de la catégorie
			$query = "SELECT id_categorie FROM categorie WHERE denomination = :denomination LIMIT 1";
			$stmt = $db->prepare($query);
			$stmt->execute([':denomination' => $categorie]);
			$categorie_row = $stmt->fetch(PDO::FETCH_ASSOC);

			if (!$categorie_row) {
				throw new Exception('Catégorie de chambre invalide.');
			}
			$categorie_id = $categorie_row['id_categorie'];

			// Rechercher une chambre disponible
			$query = "
                SELECT c.id_chambre 
                FROM chambre c
                WHERE c.id_hotel = :id_hotel 
                  AND c.id_categorie = :id_categorie
                  AND NOT EXISTS (
                    SELECT 1 
                    FROM reservation r
                    WHERE r.id_chambre = c.id_chambre
                      AND (r.date_debut <= :date_fin AND r.date_fin >= :date_debut)
                  )
                LIMIT 1 FOR UPDATE
            ";
			$stmt = $db->prepare($query);
			$stmt->execute([
				':id_hotel' => $hotelId,
				':id_categorie' => $categorie_id,
				':date_debut' => $dateDebut,
				':date_fin' => $dateFin
			]);
			$chambre = $stmt->fetch(PDO::FETCH_ASSOC);

			if (!$chambre) {
				throw new Exception('Aucune chambre disponible pour cette catégorie dans cet hôtel pour les dates sélectionnées.');
			}

			$chambre_id = $chambre['id_chambre'];

			// Créer la réservation
			$query = "
                INSERT INTO reservation 
                (id_chambre, id_user, date_debut, date_fin, date_arrivee, paiement)
                VALUES (:id_chambre, :id_user, :date_debut, :date_fin, :date_arrivee, :paiement)
            ";
			$stmt = $db->prepare($query);
			$stmt->execute([
				':id_chambre' => $chambre_id,
				':id_user' => $userId,
				':date_debut' => $dateDebut,
				':date_fin' => $dateFin,
				':date_arrivee' => $dateDebut,
				':paiement' => $paiement
			]);

			if ($stmt->rowCount() === 0) {
				throw new Exception('Échec de l\'insertion de la réservation.');
			}

			$reservation_id = (int)$db->lastInsertId();
			if ($reservation_id <= 0) {
				throw new Exception('Échec de la récupération de l\'ID de la réservation.');
			}

			$db->commit();
			return $reservation_id;
		} catch (Exception $e) {
			$db->rollBack();
			error_log('Erreur lors de la création de la réservation: ' . $e->getMessage());
			return false;
		}
	}

	/**
	 * Récupère les informations d'une chambre à partir de son identifiant.
	 *
	 * @param int $chambreId L'identifiant de la chambre.
	 * @return array|null Un tableau associatif contenant id_hotel, categorie (denomination) et prix, ou null si non trouvé.
	 */
	public static function getChambreInfo(int $chambreId): ?array {
		$query = "
            SELECT 
                c.id_hotel,
                cat.denomination AS categorie,
                pc.prix
            FROM chambre c
            LEFT JOIN categorie cat ON c.id_categorie = cat.id_categorie
            LEFT JOIN hotel h ON c.id_hotel = h.id_hotel
            LEFT JOIN prix_chambre pc ON h.id_classe = pc.id_classe AND c.id_categorie = pc.id_categorie
            WHERE c.id_chambre = :id
        ";
		$params = [':id' => $chambreId];
		$stmt = Database::preparedQuery($query, $params);
		return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
	}

	/**
	 * Récupère toutes les réservations d'un client.
	 *
	 * @param int $userId L'identifiant du client.
	 * @return array Un tableau associatif des réservations.
	 */
	public static function getReservationsByClient(int $userId): array {
		$query = "SELECT id_sejour, date_debut, date_fin 
                  FROM reservation 
                  WHERE id_user = :id_user";
		$params = [':id_user' => $userId];
		$stmt = Database::preparedQuery($query, $params);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public static function getDaysLeftInCurrentStay(int $userId): ?int {
		$query = "
            SELECT (COALESCE((
                            SELECT r2.date_fin
                            FROM reservation r2
                            WHERE r2.id_user = :id_user
                              AND r2.date_debut = r1.date_fin
                            ORDER BY r2.date_fin DESC
                            LIMIT 1
                        ),r1.date_fin) - CURRENT_DATE) AS days_left
            FROM (
                SELECT date_fin
                FROM reservation
                WHERE id_user = :id_user
                  AND date_debut <= CURRENT_DATE
                  AND date_fin >= CURRENT_DATE
                ORDER BY date_fin
                LIMIT 1
            ) AS r1";
		$params = [':id_user' => $userId];
		$stmt = Database::preparedQuery($query, $params);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);

		if (!$result) {
			return null;
		}
		return (int)$result['days_left'];
	}

	public static function getNextDepartureDate(int $userId): ?string {
		$query = "
            SELECT date_fin
            FROM reservation
            WHERE id_user = :id_user
              AND date_debut <= CURRENT_DATE
              AND date_fin >= CURRENT_DATE
            ORDER BY date_fin
            LIMIT 1
        ";
		$params = [':id_user' => $userId];
		$stmt = Database::preparedQuery($query, $params);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);

		return $result ? $result['date_fin'] : null;
	}

	public static function getOngoingReservationsByClient(int $userId): array {
		$query = "SELECT id_sejour, date_debut, date_fin 
                  FROM reservation 
                  WHERE id_user = :id_user
                    AND date_debut <= CURRENT_DATE
                    AND date_fin >= CURRENT_DATE";
		$params = [':id_user' => $userId];
		$stmt = Database::preparedQuery($query, $params);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public static function getOccupancyRate(int $userId): ?float {
		$ongoingReservations = self::getOngoingReservationsByClient($userId);
		if (empty($ongoingReservations)) {
			return null;
		}
		$reservation = $ongoingReservations[0];

		$dateDebut = new DateTime($reservation['date_debut']);
		$dateFin = new DateTime($reservation['date_fin']);
		$today = new DateTime();

		if ($today < $dateDebut) {
			return 0.0;
		}
		if ($today > $dateFin) {
			return 100.0;
		}

		$totalDays = $dateFin->diff($dateDebut)->days;
		if ($totalDays == 0) {
			return 100.0;
		}
		$elapsedDays = $dateDebut->diff($today)->days;

		$occupancyRate = ($elapsedDays / $totalDays) * 100;
		return round($occupancyRate, 2);
	}

	/**
	 * Récupère une réservation par son identifiant.
	 *
	 * @param int $reservationId L'identifiant de la réservation.
	 * @return array|false La réservation sous forme de tableau associatif, ou false si non trouvée.
	 */
	public static function getReservation(int $reservationId) {
		$query = "SELECT *
                  FROM reservation 
                  WHERE id_sejour = :id_sejour";
		$params = [':id_sejour' => $reservationId];
		$stmt = Database::preparedQuery($query, $params);
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	/**
	 * Supprime une réservation par son identifiant.
	 *
	 * @param int $reservationId L'identifiant de la réservation.
	 * @return bool True si la suppression a réussi, false sinon.
	 */
	public static function deleteReservation($reservationId) {
		$query1 = "DELETE FROM conso_client WHERE id_sejour = :id_sejour";
		$params = [':id_sejour' => $reservationId];
		Database::preparedQuery($query1, $params);

		$query2 = "DELETE FROM reservation WHERE id_sejour = :id_sejour";
		return Database::preparedQuery($query2, $params) !== false;
	}
}