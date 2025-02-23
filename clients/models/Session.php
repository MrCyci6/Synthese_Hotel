<?php
	class Session {
		public static function start() {
			// Configuration des cookies de session avant de démarrer la session
			session_set_cookie_params([
				'lifetime' => 0, // Expire à la fermeture du navigateur
				'path' => '/', // Accessible sur tout le site
				'secure' => isset($_SERVER['HTTPS']), // Seulement en HTTPS si disponible
				'httponly' => true, // Utilisation que par http donc pas de js
				'samesite' => 'Strict' // Utilisation de session que sur le dashboard
			]);

			if (session_status() === PHP_SESSION_NONE) {
				session_start();
			}
		}

		public static function destroy() {
			session_unset();
			session_destroy();
			setcookie(session_name(), '', time() - 3600, '/');
		}
	}

