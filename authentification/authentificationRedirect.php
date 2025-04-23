<?php
require_once __DIR__ . "sessionSet.include.php";
session_start();

if (session_status() == PHP_SESSION_ACTIVE) {

    // Vérifie si l'utilisateur est bien connecté (ex. par l'email stocké)
    if (isset($_SESSION['email']) && isset($_SESSION['ip']) && $_SESSION['ip'] == $_SERVER['REMOTE_ADDR']) {

        $destinataire = $_SESSION['email']; // Utilisation de l'email en session
        $code = rand(100000, 999999);
        $_SESSION['code'] = $code;

        if (envoyerMail($destinataire, "Votre code est : " . $code)) {
            header("Location:formAuthentication.php");
            exit();
        } else {
            echo "<p>Message non envoyé à " . htmlspecialchars($destinataire) . "</p>";
        }
    } else {
        echo "<p>Veuillez vous recoennecter.</p>";
    }
}

// Fonction d'envoi de mail
function envoyerMail($to, $message) {
    $subject = 'Code de vérification';
    $headers = 
        'From: cinepass@noreply' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    return mail($to, $subject, $message, $headers);    
}
?>
