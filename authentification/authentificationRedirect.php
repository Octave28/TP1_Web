<?php

# session intermédiaire pour envoi du code pour la 2FA

require_once __DIR__ . "/sessionSet.include.php";

session_start(); # Je reprends la session

if (session_status() == PHP_SESSION_ACTIVE) {

    // Si la session est toujours active :

    if (isset($_SESSION['email']) && $_SESSION['nom'] && isset($_SESSION['prenom']) && isset($_SESSION['ip']) && $_SESSION['ip'] == $_SERVER['REMOTE_ADDR']) {

        $destinataire = $_SESSION['email']; // Utilisation de l'email en session
        #$destinataire = "2309595@cegepat.qc.ca";
        $code = rand(100000, 999999);
        $_SESSION['code'] = $code;
        $prenom = $_SESSION['prenom'];
        $nom = $_SESSION['nom'];

        # J'envoie le code

        if (envoyerMail($destinataire, "Votre code est : " . $code)) {
            # Si le code est bien envoyé, 
            
            header("Location:formAuthentificationCode.php"); # Redirection de l'utilisateur vers le formulaire pour qu'il entre le code recu 

            exit();

            # Sinon  
        } else {
            echo "<p>Message non envoyé à " . htmlspecialchars($destinataire) . "</p>";
        }
    } else {   
        
        header("Location: ../erreur.php");
       
    }
}
 else {
    header("Location: ../erreur.php");
}

// Fonction d'envoi de mail
function envoyerMail($to, $message) {
    $subject = 'Code de vérification';
    $headers = 
        'From: akpachoh25techin@techinfo420.ca' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    return mail($to, $subject, $message, $headers);    
}
?>