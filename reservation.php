<?php
    require_once 'authentification/bdParams.php';
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

    try {
        $connexion = new PDO($dsn, $usagerEcriture, $mdp2BD);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Vérification de la méthode soumission du formulaire

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Récupération des données du formulaire
            $film = (int)filter_input(INPUT_POST,"film",FILTER_DEFAULT);
            $date = filter_input(INPUT_POST,"date",FILTER_DEFAULT);
            $horaire = filter_input(INPUT_POST,"horaire",FILTER_DEFAULT);
            $nb_places = (int)filter_input(INPUT_POST,"nombre_places",FILTER_VALIDATE_INT);

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

            error_log("[" . date("d/m/o H:i:s e", time()) . "]  Client " . $_SERVER['REMOTE_ADDR'] . "\n\r", 3, __DIR__ . "/../../../logs/Cinepass/error.log");
            error_log("Ecriture dans la base de données.", 3, __DIR__ . "/../../../logs/Cinepass/ecritureBase.log");

            echo "<p>Réservation enregistrée avec succès !</p>";
            echo "<a href='reservations.php'>Vos réservations</a>";
        } else {
            header("Location: erreur.php");
        }

    } catch (PDOException $e) {
        error_log("Erreur de connexion à la base de données : " . $e->getMessage(), 3, __DIR__ . "/../../../logs/Cinepass/error.log");
        error_log("[" . date("d/m/o H:i:s e", time()) . "]  Client " . $_SERVER['REMOTE_ADDR'] . "\n\r", 3, __DIR__ . "/../../../logs/Cinepass/error.log");
    }
?>