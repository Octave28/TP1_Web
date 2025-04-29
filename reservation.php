<?php
    define("BDSCHEMA", "akpachoh25techin_BD-Octave");
    define("BDSERVEUR", "127.0.0.1");
    $dsn = "mysql:dbname=" . BDSCHEMA . ";host=" . BDSERVEUR;
    $usager = "akpachoh25techin_userEcriture";
    $mdp = "lm#B$.mH^J.f";

    try {
        $connexion = new PDO($dsn, $usager, $mdp);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérification de la méthode soumission du formulaire

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Récupération des données du formulaire

        $nom =$_POST["nom"];
        $prenom = $_POST["prenom"];
        $film = (int)$_POST["film"];
        $date = $_POST["date"];
        $horaire = $_POST["horaire"];
        $nb_places = (int) $_POST["nombre_places"];

        // Validations
        if (empty($nom) || empty($prenom) || empty($film) || empty($date) || empty($horaire) || $nb_places < 1) {
            die("Tous les champs doivent être remplis correctement.");
        }

        $stmt = $connexion->prepare("INSERT INTO reservations (nom, prenom, film_id, date, horaire, nombre_places) VALUES (:nom, :prenom, :film, :date, :horaire, :nb_places)");
 
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $stmt->bindParam(':film', $film, PDO::PARAM_STR);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->bindParam(':horaire', $horaire, PDO::PARAM_STR);
        $stmt->bindParam(':nb_places', $nb_places, PDO::PARAM_STR);

        $stmt->execute();

        echo "<p>Réservation enregistrée avec succès !</p>";
        echo "<a href='reservations.php'>Vos réservations</a>";
    } else {
        echo "<p>Une erreur est survenue. Veuillez réessayer.</p>";
    }

} catch (PDOException $e) {
    echo "Erreur de connexion ou de requête : " . $e->getMessage();
}
?>