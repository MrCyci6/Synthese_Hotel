<?php
require_once "Database.php";
class Hotel{
    static function getHotelIdName()
    {   $db=Database::getConnection();
        $statement = $db->prepare(" select nom,id_hotel as id from hotel;");
        $statement->execute();
        return $statement->fetchAll();
    }

}

?>
