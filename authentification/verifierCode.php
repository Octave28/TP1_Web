<?php
require_once __DIR__ . "/sessionSet.include.php";
session_start();

if (!isset($_POST['code'])) {
    echo "Pas de code. <a href='formAuthentication.php'>Réessayer</a>";;
}

$codeUtilisateur = $_POST['code'];
$codeSession = $_SESSION['code'];
$mail = $_SESSION['email'];

if ($codeUtilisateur == $codeSession) {

    // Code correct
   
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

    $_SESSION['email'] = $mail;

    header("Location: ../pagePrecieuse.php");

    exit();

} else {

    echo "Code incorrect. <a href='formAuthentication.php'>Réessayer</a>";

}
