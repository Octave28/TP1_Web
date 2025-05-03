<?php

# session intermédiaire pour envoi du code pour la 2FA

require_once __DIR__ . "/sessionSet.include.php";

session_start(); # Je reprends la session

if (session_status() == PHP_SESSION_ACTIVE) {

    // Si la session est toujours active :

    if (isset($_SESSION['email']) && $_SESSION['nom'] && isset($_SESSION['prenom']) && isset($_SESSION['ip']) && $_SESSION['ip'] == $_SERVER['REMOTE_ADDR']) {

        $destinataire = $_SESSION['email']; // Utilisation de l'email en session
        $code = rand(100000, 999999);
        $_SESSION['code'] = $code;
        $prenom = $_SESSION['prenom'];
        $nom = $_SESSION['nom'];

        # J'envoie le code

        if (envoyerMail($destinataire, "Votre code est : " . $code)) {
            # Si le code est bien envoyé, 
            
            header("Location:formAuthentificationCode.php"); # Redirection de l'utilisateur vers le formulaire pour qu'il entre le code recu 

            exit();

        } else {
            echo "<p>Message non envoyé à " . htmlspecialchars($destinataire) . "</p>";
        }
    } else {   
        
        echo"<h3><a href='authentificationRedirect.php'>Une erreur est servenue. Veuillez réessayer.</a></h3>";
       
    }
}
 else {
    echo"<h3><a href='formConnexion.html'> La session n'est plus active. Veuillez vous reconnecter.</a></h3>";
}

// Fonction d'envoi de mail
function envoyerMail($to, $message) {
    $subject = 'Code de vérification';
    $headers = 
        'From: info@cinepass.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    return mail($to, $subject, $message, $headers);    
}
?>
