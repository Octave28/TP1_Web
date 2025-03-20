<?php
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $mail = $_POST['email'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/changementImages.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CinePass</title>
</head>
<body>
    
    <nav>
        <a href="index.php">Accueil</a>
        <a href="catalogue.html">Catalogue</a>
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
                
                <!-- <div class="film-grid">

                    <div class="film">
                        <img src="Images/deadpool 2.jpg" alt="Black Dog">
                        <span class="label new">NOUVEAU</span>
                        <h2>Deadpool 2</h2>
                    </div>

                    <div class="film">
                        <img src="Images/Dune-2-Poster-4x5-BW.jpg" alt="À Bicyclette !">
                        <h2>Dune !</h2>
                    </div>
                    <div class="film">
                        <img src="Images/mission-impossible-dex-reckoning-part-2-poster-by-rahalarts.jpg" alt="Un Parfait Inconnu">
                        <span class="label oscars">8 OSCARS</span>
                        <h2>Mission Impossible 2</h2>
                    </div>
                    <div class="film">
                        <img src="Images/Godzilla.jpg" alt="Becoming Led Zeppelin">
                        <span class="label new">NOUVEAU</span>
                        <h2>Godzilla</h2>
                    </div>
                    <div class="film">
                        <img src="Images/joker.webp" alt="The Brutalist">
                        <span class="label oscars">10 NOMINATIONS AUX OSCARS</span>
                        <h2>Joker</h2>
                    </div>
                </div> -->

                <div class="film-grid">
                <div class="film">
                    <img src="Images/avatar.jpg" alt="Black Dog">
                    <span class="label new">NOUVEAU</span>
                    <h2>Avatar</h2>
                </div>
                <div class="film">
                    <img src="Images/Ghostbusters.jpg" alt="Black Dog">
                    <h2>Ghostbusters</h2>
                </div>
                <div class="film">
                        <img src="Images/Godzilla.jpg" alt="Becoming Led Zeppelin">
                        <span class="label new">NOUVEAU</span>
                        <h2>Godzilla</h2>
                </div>
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