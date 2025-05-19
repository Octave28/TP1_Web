<?php

require_once 'bdParams.php';

# Code pour vériification du mot de passe entré par l'utilisateur pour se connecter et celui enrégistré dans la base de données à son inscription

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (!empty($_POST['email']) && !empty($_POST['password']))  {

        $email = filter_input(INPUT_POST,"email",FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST,'password',FILTER_DEFAULT);

        try {

            $connexion = new PDO($dsn, $usagerLecture, $mdp1BD);
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Récupération du nom et du mot de passe hashé à partir du courriel

            $stmt = $connexion->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);

            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Validation du mot de passe :
            
            if (password_verify($password, $user['mdp'])) {


            // Si correct, j'enregistre le prénom et je crée une nouvelle session

                $prenom = htmlspecialchars($user['prenom']);
                $nom = htmlspecialchars($user['nom']);

                require_once __DIR__."/sessionSet.include.php";
            
                session_start();
                $_SESSION['email'] = $email;
                $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
                $_SESSION['prenom'] = $prenom;
                $_SESSION['nom'] = $nom;
                header("Location: authentificationRedirect.php");

                // var_dump($_SESSION['prenom']);

            } else {
                //Mauvais mot de passe, rediriger
                header("Location: ../formConnexion.php?erreur=login");
                error_log("[".date("d/m/o H:i:s e",time())."]  Client ".$_SERVER['REMOTE_ADDR']."\n\r",3, __DIR__."/../../../logs/Cinepass/authentificationEchouees.log");
            }

        } catch (PDOException $e) {
            error_log("Erreur de connexion à la base de données :  " .$e->getMessage(),3, __DIR__."/../../../logs/Cinepass/error.log");
        }
    } else {
        echo "<p>Veuillez remplir tous les champs.</p>";
    }
} else {
    echo "<p>Accès refusé.</p>";
}
?>