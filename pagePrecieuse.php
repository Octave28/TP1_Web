<?php
    
    require_once __DIR__ . "/sessionSet.include.php";
    require_once 'films.php';
    $meilleursFilms = array_filter($films, function($film) {
        return isset($film['labels']['oscars']);
    });

    session_start();
    
    if (session_status() == PHP_SESSION_ACTIVE) {

        // Vérifie si l'utilisateur est bien connecté (ex. par l'email stocké)
        if (isset($_SESSION['email']) && isset($_SESSION['ip']) && $_SESSION['ip'] == $_SERVER['REMOTE_ADDR']) 
        {
            $prenom = $_SESSION['prenom'];
            $mail = $_SESSION['email'];
        }
    
    }
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="stylesheet" href="css/style.css">
    <script src="./dom.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CinePass</title>
</head>
<body>
    
    <nav>
        <img class = "ImageLogo" src="./Images/cinepass.jpeg" alt="Erreur">
        <a href="index.php">Accueil</a>
        <a href="catalogue.php">Catalogue</a>
        <a href="reservation.html">Faire une réservation</a>
        <a href="reservation.html">Vos réservations</a>
        <a href="infos.html">Nous joindre</a>
        <a href="deconnexion.php">Déconnexion</a>
       
    </nav>

    <main>
       
        <div class="resume-forward" >  

            <div class="texte-resume" >  

                <h1> Bienvenue, <?php echo $prenom; ?> </h1>

                <h2> Voici une liste de films recommandés pour vous !</h2>

                <div class="film-grid">
                    <?php afficherFilms($meilleursFilms) ?>
                </div>
            
            </div>

        </div>

    </main>
    
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
                <li>info@cinemapass.com</li>
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