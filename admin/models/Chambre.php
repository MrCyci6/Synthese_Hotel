<?php

    require_once 'models/Database.php';

    class Chambre {

        static function getRoomsCountByHotel(int $hotelId) {
            $statement = Database::preparedQuery(
                "SELECT COUNT(id_chambre) FROM chambre WHERE id_hotel=?;",
                [$hotelId]
            );
            return $statement->fetch()['count'];
        }

        static function getRoomsInfo(int $hotelId) {
            $statement = Database::preparedQuery(
                "SELECT hotel.id_hotel as id,categorie.denomination as chambre,prix_chambre.prix as prix FROM hotel 
                JOIN prix_chambre on hotel.id_classe=prix_chambre.id_classe and hotel.id_categorie=prix_chambre.id_categorie
                WHERE id_hotel=?;",
                [$hotelId]
            );
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
    }

?>