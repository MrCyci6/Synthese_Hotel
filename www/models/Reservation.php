<?php

    require_once '../models/Database.php';

    class Reservation {

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
                    (id_chambre, id_user, date_debut, date_fin, date_arrivee, paiement, due)
                    VALUES (:id_chambre, :id_user, :date_debut, :date_fin, :date_arrivee, :paiement, 0)
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
         * Récupère toutes les réservations d'un client.
         *
         * @param int $userId L'identifiant du client.
         * @return array Un tableau associatif des réservations.
         */
        public static function getReservationsByClient(int $userId): array {
            $query = "SELECT r.id_sejour, r.date_debut, r.date_fin, h.nom as nom_hotel, ch.numero_chambre FROM reservation r
                INNER JOIN chambre ch ON ch.id_chambre=r.id_chambre
                INNER JOIN hotel h ON ch.id_hotel=h.id_hotel
                WHERE id_user = :id_user
                ORDER BY r.id_sejour DESC";
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
            $query = "SELECT r.id_sejour, r.date_debut, r.date_fin, h.nom AS hotel_name
	              FROM reservation r
	              JOIN chambre c ON r.id_chambre = c.id_chambre
	              JOIN hotel h ON c.id_hotel = h.id_hotel
	              WHERE r.id_user = :id_user
	                AND r.date_debut <= CURRENT_DATE
	                AND r.date_fin >= CURRENT_DATE";
            $params = [':id_user' => $userId];
            $stmt = Database::preparedQuery($query, $params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function getReservationById(int $reservationId, int $userId): ?array {
            $query = "SELECT r.*, h.nom as hotel_name, (r.date_fin >= CURRENT_DATE) as is_ongoing
                FROM reservation r 
                JOIN chambre c ON r.id_chambre = c.id_chambre 
                JOIN hotel h ON c.id_hotel = h.id_hotel 
                WHERE r.id_sejour = :id_sejour 
                    AND r.id_user = :id_user";
            $params = [
                ':id_sejour' => $reservationId,
                ':id_user' => $userId
            ];
            $stmt = Database::preparedQuery($query, $params);
            return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
        }
 

        public static function getPastReservationsByClient(int $userId): array {
            $query = "SELECT r.id_sejour, r.date_debut, r.date_fin, h.nom as hotel_name 
                FROM reservation r 
                JOIN chambre c ON r.id_chambre = c.id_chambre 
                JOIN hotel h ON c.id_hotel = h.id_hotel 
                WHERE r.id_user = :id_user 
                    AND r.date_fin < CURRENT_DATE 
                ORDER BY r.date_debut DESC";
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

        static function getReservations(int $hotelId, int $limit, int $page) {
            $statement = Database::preparedQuery(
                "SELECT r.id_sejour, ca.denomination as categorie, u.nom as nom_user, u.prenom as prenom_user, h.id_classe, pc.prix, r.date_debut, r.date_fin, (r.date_fin-r.date_debut)*pc.prix as total, r.due, r.paiement, NOW() as now FROM reservation r
                INNER JOIN chambre c ON c.id_chambre=r.id_chambre
                INNER JOIN hotel h ON h.id_hotel=c.id_hotel
                INNER JOIN prix_chambre pc ON pc.id_classe=h.id_classe AND pc.id_categorie=c.id_categorie
                INNER JOIN users u ON u.id_user=r.id_user
                INNER JOIN categorie ca ON ca.id_categorie=c.id_categorie
                WHERE h.id_hotel=?
                ORDER BY r.id_sejour DESC
                LIMIT ? OFFSET ?;",
                [$hotelId, $limit, ($page-1)*$limit]
            );
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }

        static function getReservation(int $reservationId) {
            $statement = Database::preparedQuery(
                "SELECT r.id_sejour, h.id_hotel, h.nom as nom_hotel, cl.denomination as classe, r.id_chambre, ch.numero_chambre, ca.id_categorie, ca.denomination as categorie, u.id_user, u.nom as nom_user, u.prenom as prenom_user, u.email as email_user, r.date_debut, r.date_fin, r.date_arrivee, r.date_fin-r.date_debut as nuits, (r.date_fin-r.date_debut)*pc.prix as total, r.due, paiement, NOW() now FROM reservation r
                INNER JOIN chambre ch ON ch.id_chambre=r.id_chambre
                INNER JOIN hotel h ON h.id_hotel=ch.id_hotel
                INNER JOIN categorie ca ON ca.id_categorie=ch.id_categorie
                INNER JOIN prix_chambre pc ON pc.id_classe=h.id_classe AND pc.id_categorie=ca.id_categorie
                INNER JOIN users u ON u.id_user=r.id_user
                INNER JOIN classe cl ON cl.id_classe=h.id_classe  
                WHERE r.id_sejour=?;",
                [$reservationId]
            );
            $results = $statement->fetch();
            return $results;
        }

        static function searchReservation(string $data, int $hotelId, int $limit, $page) {
            $statement = Database::preparedQuery(
                "SELECT r.id_sejour, h.id_hotel, h.nom as nom_hotel, cl.denomination as classe, ch.numero_chambre, ca.denomination as categorie, u.id_user, u.nom as nom_user, u.prenom as prenom_user, u.email as email_user, r.date_debut, r.date_fin, r.date_arrivee, r.date_fin-r.date_debut as nuits, pc.prix, (r.date_fin-r.date_debut)*pc.prix as total, r.due, r.paiement, NOW() now FROM reservation r
                INNER JOIN chambre ch ON ch.id_chambre=r.id_chambre
                INNER JOIN categorie ca ON ca.id_categorie=ch.id_categorie
                INNER JOIN users u ON u.id_user=r.id_user
                INNER JOIN hotel h ON h.id_hotel=ch.id_hotel
                INNER JOIN classe cl ON cl.id_classe=h.id_classe
                INNER JOIN prix_chambre pc ON pc.id_classe=h.id_classe AND pc.id_categorie=ca.id_categorie

                WHERE h.id_hotel=? AND 
                    (LOWER(u.email) LIKE LOWER('%' || ? || '%') 
                    OR LOWER(u.nom) LIKE LOWER('%' || ? || '%') 
                    OR LOWER(u.prenom) LIKE LOWER('%' || ? || '%') 
                    OR CAST(r.date_debut as varchar) LIKE '%' || ? || '%'  
                    OR CAST(r.date_fin as varchar) LIKE '%' || ? || '%'
                    OR LOWER(ca.denomination) LIKE LOWER('%' || ? || '%'))
                    ORDER BY r.id_sejour DESC
                    LIMIT ? OFFSET ?;", 
                [$hotelId, $data, $data, $data, $data, $data, $data, $limit, ($page-1)*$limit]
            );
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }

        static function getReservationsByUser(int $userId) {
            $statement = Database::preparedQuery(
                "SELECT r.id_sejour, h.id_hotel, h.nom as nom_hotel, cl.denomination as classe, ch.numero_chambre, ca.denomination as categorie, u.id_user, u.nom as nom_user, u.prenom as prenom_user, u.email as email_user, r.date_debut, r.date_fin, r.date_arrivee, r.date_fin-r.date_debut as nuits, NOW() now FROM reservation r
                INNER JOIN chambre ch ON ch.id_chambre=r.id_chambre
                INNER JOIN categorie ca ON ca.id_categorie=ch.id_categorie
                INNER JOIN users u ON u.id_user=r.id_user
                INNER JOIN hotel h ON h.id_hotel=ch.id_hotel
                INNER JOIN classe cl ON cl.id_classe=h.id_classe  
                WHERE r.id_user=?;",
                [$userId]
            );
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }

        static function getReservationsCountByHotel(int $hotelId) {
            $statement = Database::preparedQuery(
                "SELECT COUNT(r.id_sejour) as count FROM reservation r
                INNER JOIN chambre ch ON ch.id_chambre=r.id_chambre
                WHERE ch.id_hotel=?;",
                [$hotelId]
            );
            return $statement->fetch()['count'];
        }

        static function getReservationsByHotelAndUser(int $hotelId, int $userId) {
            $statement = Database::preparedQuery(
                "SELECT r.id_sejour, h.id_hotel, h.nom as nom_hotel, cl.denomination as classe, ch.numero_chambre, ca.denomination as categorie, u.id_user, u.nom as nom_user, u.prenom as prenom_user, u.email as email_user, r.date_debut, r.date_fin, r.date_arrivee, r.date_fin-r.date_debut as nuits, NOW() now FROM reservation r
                INNER JOIN chambre ch ON ch.id_chambre=r.id_chambre
                INNER JOIN categorie ca ON ca.id_categorie=ch.id_categorie
                INNER JOIN users u ON u.id_user=r.id_user
                INNER JOIN hotel h ON h.id_hotel=ch.id_hotel
                INNER JOIN classe cl ON cl.id_classe=h.id_classe  
                WHERE h.id_hotel=? AND r.id_user=?;",
                [$hotelId, $userId]
            );
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }

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

        static function getCategories() {
            $statement = Database::preparedQuery(
                "SELECT id_categorie, denomination as categorie FROM categorie;",
                []
            );
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        static function getPrice(int $bookId, $end, $start) {
            $statement = Database::preparedQuery(
                "SELECT (CAST(? as DATE)-CAST(? as DATE))*pc.prix as due FROM reservation r
                INNER JOIN chambre ch ON ch.id_chambre=r.id_chambre
                INNER JOIN hotel h ON h.id_hotel=ch.id_hotel
                INNER JOIN categorie ca ON ca.id_categorie=ch.id_categorie
                INNER JOIN prix_chambre pc ON pc.id_classe=h.id_classe AND pc.id_categorie=ca.id_categorie
                WHERE r.id_sejour=?;",
                [$end, $start, $bookId]
            );

            return $statement->fetch()['due'];
        }

        static function modifyBook(int $bookId, $start, $end, $paiement) {
            Database::preparedQuery(
                "UPDATE reservation SET date_debut=?, date_fin=?, due=?, paiement=? WHERE id_sejour=?;",
                [$start, $end, Reservation::getPrice($bookId, $end, $start), $paiement, $bookId]
            );
        }

        static function getReservEnCours(){
            $statement = Database::preparedQuery(
                "SELECT id_sejour FROM Reservation WHERE NOW() BETWEEN date_debut AND date_fin;", 
                array()
            );
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }

?>