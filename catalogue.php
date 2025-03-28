<?php

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A la une</title>
</head>
<body>
    <header>
        <h1>Notre Catalogue</h1>
    </header>

    <nav>
        <a href="index.php">Accueil</a>
        <a href="catalogue.html">Catalogue</a>
        <a href="reservation.html">Faire une réservation</a>
        <a href="creation.html">Créer un compte</a>
        <a href="connexion.html">Se connecter</a>
        <a href="infos.html">Nous joindre</a>
    </nav>

    <main>

    <main>

        <!-- Formulaire de recherche -->
        <div class="form-container2">
            <div class="form-box" id="register-form">
            <form method="GET" action="index.php">
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

                <p> Connectez vous pour voir une liste de films spécialement réservés pour vous ! Nous avons une super élection qui devrait vous plaire. </p>
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
</html>