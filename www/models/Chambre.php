<?php

    require_once '../models/Database.php';

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
                "SELECT distinct categorie.denomination as chambre,categorie.id_categorie as cate,hotel.id_hotel as id,prix_chambre.prix as prix,hotel.id_classe FROM hotel
                JOIN chambre using(id_hotel)
                JOIN categorie using(id_categorie)
                JOIN prix_chambre on hotel.id_classe=prix_chambre.id_classe and chambre.id_categorie=prix_chambre.id_categorie
                WHERE id_hotel=?;",
                [$hotelId]
            );
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        static function modifyPrice($categorie, $classe, $prix) {
            $statement = Database::preparedQuery(
                "UPDATE prix_chambre SET prix=? where id_classe=? and id_categorie=?;", 
                [$prix, $categorie, $classe]
            );
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
    }

?>