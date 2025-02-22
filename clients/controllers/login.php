<?php
ini_set('session.cookie_path', '/');
session_start();
require_once __DIR__ . '/../models/Client.php';

if (isset($_SESSION['client_id'])) {
	header("Location: /dashboard/home");
	exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$email = $_POST['email'] ?? '';
	$password = $_POST['password'] ?? '';

	$clientData = Client::loginClient($email, $password);

	if ($clientData !== false) {
		$_SESSION['client_id'] = [
			'id'     => $clientData['id_user'],
			'nom'    => $clientData['nom'],
			'prenom' => $clientData['prenom'],
			'email'  => $clientData['email'],
		];
		header("Location: /dashboard/home");
		exit();
	} else {
		// Stocke l'erreur
		$_SESSION['error'] = "Identifiants incorrects.";
		header("Location: /login"); // Requête en GET pour modèle PRG
		exit();
	}
}

// Supprime l'erreur au prochain refresh
$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);

require '../views/login/login.php';
