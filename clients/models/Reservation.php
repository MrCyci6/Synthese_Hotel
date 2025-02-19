<?php
require_once __DIR__ . '/Database.php';

class Reservation {

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
            SELECT (date_fin - CURRENT_DATE) AS days_left
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
		$ongoingReservations = Reservation::getOngoingReservationsByClient($userId);
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
		$query = "SELECT id_sejour, id_user, date_debut, date_fin
                  FROM reservation 
                  WHERE id_sejour = :id_sejour";
		$params = [':id_sejour' => $reservationId];
		$stmt = Database::preparedQuery($query, $params);
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	/**
	 * Crée une nouvelle réservation.
	 *
	 * @param int    $chambreId   L'identifiant de la chambre.
	 * @param int    $userId      L'identifiant du client.
	 * @param string $dateDebut   Date de début (format YYYY-MM-DD).
	 * @param string $dateFin     Date de fin (format YYYY-MM-DD).
	 * @param string|null $dateArrivee (optionnel) Date d'arrivée réelle (format YYYY-MM-DD).
	 * @param bool|int|null $paiement   (optionnel) État ou type de paiement (selon votre structure).
	 * @return bool True si l'insertion réussit, false sinon.
	 */
	public static function createReservation(int $chambreId, int $userId, string $dateDebut, string $dateFin, ?string $dateArrivee = null, $paiement = null): bool {
		$query = "INSERT INTO reservation 
                  (id_chambre, id_user, date_debut, date_fin, date_arrivee, paiement)
                  VALUES (:id_chambre, :id_user, :date_debut, :date_fin, :date_arrivee, :paiement)";

		$params = [
			':id_chambre'  => $chambreId,
			':id_user'     => $userId,
			':date_debut'  => $dateDebut,
			':date_fin'    => $dateFin,
			':date_arrivee' => $dateArrivee,
			':paiement'    => $paiement
		];


		$stmt = Database::preparedQuery($query, $params);
		if ($stmt !== false) {
			return Database::getConnection()->lastInsertId();
		}
		return false;
	}

	/**
	 * Supprime une réservation par son identifiant.
	 *
	 * @param int $reservationId L'identifiant de la réservation.
	 * @return bool True si la suppression a réussi, false sinon.
	 */
	public static function deleteReservation($reservationId) {
		// Supprime d'abord les consommations associées
		$query1 = "DELETE FROM conso_client WHERE id_sejour = :id_sejour";
		$params = [':id_sejour' => $reservationId];
		Database::preparedQuery($query1, $params);

		// Puis supprime la réservation
		$query2 = "DELETE FROM reservation WHERE id_sejour = :id_sejour";
		return Database::preparedQuery($query2, $params) !== false;
	}

}
