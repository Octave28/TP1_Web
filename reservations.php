<?php
require_once __DIR__ . "/authentification/sessionSet.include.php";
session_start();

if (session_status() == PHP_SESSION_ACTIVE) {
// Vérifie si l'utilisateur est connecté
    if (!isset($_SESSION['email']) || !isset($_SESSION['prenom'])) {
        // Rediriger vers la page de connexion si non connecté
        header('Location: formConnexion.html');
        exit();
    }
}

define("BDSCHEMA", "akpachoh25techin_BD-Octave");
define("BDSERVEUR", "127.0.0.1");
$dsn = "mysql:dbname=" . BDSCHEMA . ";host=" . BDSERVEUR;
$usager = "akpachoh25techin_UserLecture";
$mdp = "b+zIQTikY5RX";

try {
    $connexion = new PDO($dsn, $usager, $mdp);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prépare une requête pour récupérer seulement les réservations de l'utilisateur connecté
    $stmt = $connexion->prepare(
        "SELECT r.*, f.titre, f.image
         FROM reservations r
         INNER JOIN films f ON r.film_id = f.id
         WHERE r.prenom = :prenom"
    );
    
    // $stmt->bindParam(':nom', $_SESSION['nom'], PDO::PARAM_STR);
    $stmt->bindParam(':prenom', $_SESSION['prenom'], PDO::PARAM_STR);

    $stmt->execute();
    $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes réservations</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <nav>
        <img class = "ImageLogo" src="./Images/cinepass.jpeg" alt="Erreur">
        <a href="pagePrecieuse.php">Accueil</a>
        <a href="catalogue.php">Catalogue</a>
        <a href="formReservation.html">Faire une réservation</a>
        <a href="reservations.php">Vos réservations</a>
        <a href="infosProtegee.php">Nous joindre</a>
        <a href="deconnexion.php">Déconnexion</a>
    </nav>

    <h1>Vos réservations</h1>

    <main>

        <div class="reservation2">

            <?php if (empty($reservations)): ?>
                <p>Vous n'avez pas encore de réservations.</p>
            <?php else: ?>
                <p>
                Voici une liste de toutes les réservations que vous avez faites jusqu'à ce jour.
                </p>

                <table>
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Film</th>
                            <th>Affiche</th>
                            <th>Date</th>
                            <th>Horaire</th>
                            <th>Nombre de places</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reservations as $reservation): ?>
                            <tr>
                                <td><?= htmlspecialchars($reservation['nom']) ?></td>
                                <td><?= htmlspecialchars($reservation['prenom']) ?></td>
                                <td><?= htmlspecialchars($reservation['titre'])?></td>
                                <td> <img class="imgReservation" src="<?= htmlspecialchars($reservation['image']) ?>" alt="Affiche du film">
                                <td><?= htmlspecialchars($reservation['date']) ?></td>
                                <td><?= htmlspecialchars($reservation['horaire']) ?></td>
                                <td><?= htmlspecialchars($reservation['nombre_places']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
            
           
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