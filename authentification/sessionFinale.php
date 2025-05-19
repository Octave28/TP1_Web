<?php
require_once __DIR__ . "/sessionSet.include.php";
session_start();

if (!isset($_POST['code']) || !isset($_SESSION['prenom']) ) {
    echo "Pas de code. <a href='formAuthentication.php'>Réessayer</a>";
    header("Location:authentificationRedirect.php");
}

$codeUtilisateur = filter_input(INPUT_POST,"code",FILTER_VALIDATE_INT);
$codeSession = $_SESSION['code'];
$mail = $_SESSION['email'];
$prenom = $_SESSION['prenom'];
$nom = $_SESSION['nom'];
$ip = $_SESSION['ip'];

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
    $_SESSION['prenom'] = $prenom;
    $_SESSION['nom'] = $nom;
    $_SESSION['ip'] = $ip;

    error_log("[".date("d/m/o H:i:s e",time())."]  Client ".$_SERVER['REMOTE_ADDR']."\n\r",3, __DIR__."/../../../logs/Cinepass/authentificationReussies.log");
    header("Location: ../pagePrecieuse.php");
    exit();

} else {
    header("Location: formAuthentificationCode.php?erreur=1");
    error_log("[".date("d/m/o H:i:s e",time())."]  Client ".$_SERVER['REMOTE_ADDR']."\n\r",3, __DIR__."/../../../logs/Cinepass/authentificationEchouees.log");
    exit();
}