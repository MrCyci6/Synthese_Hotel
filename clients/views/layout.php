<?php

$pageTitle = $pageTitle ?? 'Tableau de bord';

include 'partials/header.php';
include 'partials/sidebar.php';
include 'partials/navbar.php';

/*if (isset($_SESSION['client_id']))
	try {
		echo "Bonjour, " . $_SESSION['client_id']['prenom'].' '.$_SESSION['client_id']['nom'];
	} catch (Exception $e) {
		echo $e->getMessage();
	}
*/

if (isset($view)) {
	include __DIR__ . '/../views/dashboard/' . $viewFile;
} else {
	try {
		include __DIR__ . '/../views/dashboard/home.php';
	} catch (Exception $e) {
		include __DIR__ . '/../views/error.php';
		echo $e->getMessage();
		exit();
	}
}