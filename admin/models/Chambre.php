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
    }

?>