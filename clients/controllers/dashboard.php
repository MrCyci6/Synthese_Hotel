<?php
session_start();

if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
	header('Location: login.php');
	exit();
}

require_once __DIR__ . '/../models/Client.php';
require __DIR__ . '/../views/dashboard.php';
?>
