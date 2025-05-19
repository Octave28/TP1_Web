<?php

require_once __DIR__ . "/authentification/sessionSet.include.php";
session_start();

$_SESSION = []; // Je vide toutes les variables de session

$params = session_get_cookie_params(); // Récupère les paramètres du cookie de session

// Suppression des cookies de session
setcookie(session_name(), '', time()-60*60*24*30,
    $params["path"], $params["domain"],
    $params["secure"], $params["httponly"]
);

// Détruit la session
session_destroy();

// Redirige vers la page d'accueil
header("Location: formConnexion.php");
exit();
?>
