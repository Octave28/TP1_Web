<?php

    require_once __DIR__ . "/authentification/sessionSet.include.php";

    session_start();

    if (session_status() == PHP_SESSION_ACTIVE) {

        // Vérifie si l'utilisateur est bien connecté (ex. par l'email stocké)

        if (isset($_SESSION['email']) && isset($_SESSION['ip']) && $_SESSION['ip'] == $_SERVER['REMOTE_ADDR']) 
        {
            $mail = $_SESSION['email'];
        }
        else{
            error_log("[".date("d/m/o H:i:s e",time())."]  Client ".$_SERVER['REMOTE_ADDR']."\n\r",3, __DIR__."/../../../logs");
            header("Location: catalogue.html");
            exit();
        }
    }

    require_once 'films.php';

    $filmsAffiches = $films; // Par défaut, afficher tous les films
    if (isset($_GET['recherche']) && !empty($_GET['recherche'])) {
        $filmsAffiches = rechercherFilms($films, $_GET['recherche']);
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="css/style.css">
    <meta charset="UTF-8">
    <script src="./dom.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A la une</title>
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

    <header>
        <h1>Notre Catalogue</h1>
    </header>
    
    <main>

        <!-- Formulaire de recherche -->
         
        <div class="form-container2">
            <div class="form-box" id="register-form">
                 <form method="GET" action="">
                    <input type="text" name="recherche" placeholder="Rechercher un film..." 
                        value="<?= isset($_GET['recherche']) ? htmlspecialchars($_GET['recherche']) : '' ?>">
                    <button type="submit">Rechercher</button>
                    <?php if (isset($_GET['recherche']) && !empty($_GET['recherche'])): ?>
                        <a href="catalogue.php" class="btn-annuler">Annuler la recherche</a>
                    <?php endif; ?>
                </form>
            </div>
        </div>
         
        <div class = catalogue>
            
            <!-- Affichage des films -->
            
            <div class = films-container>
                <div class = film-grid>
                    <?php afficherFilms($films)?>
                </div> 
            </div>

            <div class = text-Publicite>
                <h2> Ne restez pas en retrait !!!!!</h2>

                <p> Vous pouvez faire vos réservations en vous rendnat sur place également. La billetterie ouvre a tous les jours de de 8:00 à 21:00, a compter de 12:00 le samedi et dimanche, 
                    elle ferme 15 minutes après la dernière représentation du jour.
                    Horaire sujet a changement sans préavis. </p>
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
</html>