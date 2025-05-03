<?php
    require_once __DIR__ . "/authentification/sessionSet.include.php";

    session_start();
     
    if (session_status() == PHP_SESSION_ACTIVE) {
 
        // Vérifie si l'utilisateur est bien connecté (ex. par l'email stocké)

        if (isset($_SESSION['email']) && isset($_SESSION['ip']) && $_SESSION['ip'] == $_SERVER['REMOTE_ADDR']) 
         {
            $prenom = $_SESSION['nom'];
            $prenom = $_SESSION['prenom'];
            $mail = $_SESSION['email'];
         }

        else{
            error_log("[".date("d/m/o H:i:s e",time())."]  Client ".$_SERVER['REMOTE_ADDR']."\n\r",3, __DIR__."/../../../logs/Cinepass/error.log");
            header("Location: erreur.php");
            exit();
         }

        }
     
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

        // $nom =$_POST["nom"];
        // $prenom = $_POST["prenom"];
        $film = (int)$_POST["film"];
        $date = $_POST["date"];
        $horaire = $_POST["horaire"];
        $nb_places = (int) $_POST["nombre_places"];

        // Validations
        if (empty($film) || empty($date) || empty($horaire) || $nb_places < 1) {
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