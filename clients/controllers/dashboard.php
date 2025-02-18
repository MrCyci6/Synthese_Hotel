<?php
session_start();

require_once __DIR__ . '/../models/Client.php';

$datefin = Client::getReservations($_SESSION['id']);

require __DIR__ . '/../views/dashboard.php';
?>
