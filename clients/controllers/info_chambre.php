<?php
  require_once 'model/Chambres.php';

      $date_arrive=$_POST['arriver'];
      $date_depart=$_POST['depart'];
      $id_hotel =$_POST['hotel'];
      if(!empty($date_arrive)&& !empty($date_depart)&& !empty($id_hotel)){
          $chambres=Chambres::getRoomInfos($id_hotel,$date_arrive,$date_depart);
      }
      
  require 'views/Reservation.php';

?>

