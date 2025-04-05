<?php
require_once "Database.php";

class Chambres
{
    static function getRoomsCountByHotel(int $hotelId)
    {
        $statement = Database::preparedQuery(
            "SELECT COUNT(id_chambre) FROM chambre WHERE id_hotel=?;",
            [$hotelId]
        );
        return $statement->fetch()['count'];
    }

    public static function getRoomInfos(int $hotelId, string $dateDebut, string $dateFin)
    {
        $query = "SELECT h.nom AS hotel_nom, c.denomination AS categorie_nom, prix_ch.prix
        FROM chambre ch
        JOIN categorie c ON ch.id_categorie = c.id_categorie
        JOIN hotel h ON ch.id_hotel = h.id_hotel
        JOIN prix_chambre prix_ch ON ch.id_categorie = prix_ch.id_categorie
        WHERE ch.id_hotel = :hotelId
        AND ch.id_chambre NOT IN (
            SELECT r.id_chambre
            FROM reservation r
            WHERE r.date_fin > :dateDebut
            AND r.date_debut <= :dateFin
        )
        GROUP BY h.id_hotel, c.id_categorie, prix_ch.prix;
    ";

        return Database::preparedQuery($query, [':hotelId' => $hotelId, ':dateDebut' => $dateDebut, ':dateFin' => $dateFin])->fetchAll();
    }

}




?>
