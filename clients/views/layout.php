<?php

$pageTitle = $pageTitle ?? 'Tableau de bord';

include 'partials/header.php';
include 'partials/sidebar.php';
include 'partials/navbar.php';

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