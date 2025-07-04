<?php
    
    require_once 'films.php';

    require_once __DIR__ . "/authentification/sessionSet.include.php";
    
    session_start();
    
    if (session_status() == PHP_SESSION_ACTIVE) {

        // Vérifie si l'utilisateur est bien connecté (ex. par l'email stocké)
        if (isset($_SESSION['email']) && isset($_SESSION['ip']) && $_SESSION['ip'] == $_SERVER['REMOTE_ADDR']) 
        {
            $nom = $_SESSION['nom'];
            $prenom = $_SESSION['prenom'];
            $mail = $_SESSION['email'];
        }
        else{
            error_log("[".date("d/m/o H:i:s e",time())."]  Client ".$_SERVER['REMOTE_ADDR']."\n\r",3, __DIR__."/../../../logs/Cinepass/error.log");
            header("Location: erreur.php");
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/dom.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CinePass</title>
</head>
<body>
    
    <nav>
        <img class = "ImageLogo" src="./Images/cinepass.jpeg" alt="Erreur">
        <a href="pagePrecieuse.php">Accueil</a>
        <a href="catalogue.php">Catalogue</a>
        <a href="formReservation.php">Faire une réservation</a>
        <a href="reservations.php">Vos réservations</a>
        <a href="infosProtegee.php">Nous joindre</a>
        <a href="deconnexion.php">Déconnexion</a>
       
    </nav>

    <div class="resume-forward">  

            <h1> Bienvenue, <?php echo $prenom; ?> </h1>

            <div class="background-slider">

                <div class="texte-resume">  

                    <h1> Voici nos films présentement à l'affiche</h1>

                    <p class="texte-long">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                        Vivamus convallis id turpis ac vulputate. Cras viverra ultricies ornare. 
                        Phasellus dictum nisi vel ligula Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Vivamus convallis id turpis ac vulputate. Cras viverra ultricies ornare.
                        Phasellus dictum nisi vel ligula venenatis viverra ut et leo. 
                        Donec egestas ex eu euismod tempor. Donec tempus et elit eget posuere. 
                        Cras sit amet purus vitae enim pellentesque vulputate. 
                        Pellentesque vel posuere sem, sit amet bibendum nisl. Etiam quis sagittis libero.
                    </p>

                    <div class="film-grid">
                        <?php afficherFilmsAleatoires($films, 5); ?>
                    </div>

                </div> 

            </div>

        <h1>Et nos toutes dernières sorties</h1>

        <p class="texte-long">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
            Vivamus convallis id turpis ac vulputate. Cras viverra ultricies ornare. 
            Phasellus dictum nisi vel ligula Lorem ipsum dolor sit amet, consectetur adipiscing elit.
            Vivamus convallis id turpis ac vulputate. Cras viverra ultricies ornare.
            Phasellus dictum nisi vel ligula venenatis viverra ut et leo. 
            Donec egestas ex eu euismod tempor. Donec tempus et elit eget posuere. 
            Cras sit amet purus vitae enim pellentesque vulputate. 
            Pellentesque vel posuere sem, sit amet bibendum nisl. Etiam quis sagittis libero.
        </p>

        <div class="film-grid">
            <?php afficherFilmsAleatoires($films, 10); ?>
        </div>

    </div>
        
    <footer>
        <div>
            <ul>
                <li>Reserver</li>
                <li>À l'affiche</li>
                <li>Ipsu m</li>
                <li>Ipsum</li>
            </ul>
        </div>
        <div>
            <ul>
                <li>1XX, rue du Cine Est (Movie), J1X XYZ</li>
                <li>info@cinepass.com</li>
                <li>123-4566-7890</li>
            </ul>
        </div>
        <div>
            <ul>
                <li>Billeterie physique</li>
                <li>La billetterie ouvre a tous les jours a compter de 18:00, a compter de 12:00 le samedi et dimanche, 
                    elle ferme 15 minutes après la dernière représentation du jour.
                    Horaire sujet a changement sans préavis.</li>
                <li>Lorem</li>
                <li>Ipsum</li>
            </ul>
        </div>
    </footer>
</body>
</html>