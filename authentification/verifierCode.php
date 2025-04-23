<?php
require_once __DIR__ . "/sessionSet.include.php";
session_start();

if (!isset($_POST['code'])) {
    echo "Pas de code. <a href='formAuthentication.php'>Réessayer</a>";;
}

$codeUtilisateur = $_POST['code'];
$codeSession = $_SESSION['code'];

if ($codeUtilisateur == $codeSession) {
    // Code correct
    //session_unset();          // Nettoie les variables
    if (session_status() == PHP_SESSION_ACTIVE){
        $parametresSession = session_get_cookie_params(); //Pour antidater (détruire) le cookie

            setcookie(
                session_name(), '', time()-60*60*24*30,
                $parametresSession["path"], $parametresSession["domain"],
                $parametresSession["secure"], $parametresSession["httponly"]
            );

            session_destroy(); //La session est effacée
    }
         
    session_start(); // Nouvelle session

    $_SESSION['authentifié'] = true;

    $_SESSION['email'] = $_SESSION['email']; 

    header("Location: accueil.php");

    exit();
} else {
    echo "Code incorrect. <a href='formAuthentication.php'>Réessayer</a>";
}
