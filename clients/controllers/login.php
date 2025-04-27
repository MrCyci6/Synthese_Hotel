<?php
/* Pour gestion des erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
require_once __DIR__ . '/../models/Session.php';
Session::start();
require_once __DIR__ . '/../models/Client.php';

// Récupérer le paramètre redirect de l'URL
$redirect = $_GET['redirect'] ?? '/dashboard/home';

// Si l'utilisateur est déjà connecté, rediriger immédiatement
if (isset($_SESSION['client_id'])) {
	header("Location: " . urldecode($redirect));
	exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$email = $_POST['email'] ?? '';
	$password = $_POST['password'] ?? '';

	$clientData = Client::loginClient($email, $password);

	if ($clientData !== false) { // Vérification de la connexion réussie
		$_SESSION['id_user'] = $clientData['id_user'];
		$_SESSION['client_id'] = [
			'id'     => $clientData['id_user'],
			'nom'    => $clientData['nom'],
			'prenom' => $clientData['prenom'],
			'email'  => $clientData['email'],
		];

		// Vérifier si redirect est non vide, sinon utiliser une valeur par défaut
		$redirect = !empty($_POST['redirect']) ? urldecode($_POST['redirect']) : (!empty($_GET['redirect']) ? urldecode($_GET['redirect']) : '/dashboard/home');

		header("Location: $redirect");
		exit();
	} else {
		$_SESSION['error'] = "Identifiants incorrects.";
		header("Location: /login?redirect=" . urlencode($redirect));
		exit();
	}
}

// Supprime l'erreur au prochain refresh
$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);

// Passer $redirect à la vue
require '../views/login/loginView.php';