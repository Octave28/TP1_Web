<?php

# Code pour vériification du mot de passe entré par l'utilisateur pour se connecter et celui enrégistré dans la base de données à son inscription

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (!empty($_POST['email']) && !empty($_POST['password']))  {

        $email = filter_input(INPUT_POST,"email",FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST,'password',FILTER_DEFAULT);

        define("BDSCHEMA", "akpachoh25techin_BD-Octave");
        define("BDSERVEUR", "127.0.0.1");
        $dsn = "mysql:dbname=" . BDSCHEMA . ";host=" . BDSERVEUR;
        $usager = "akpachoh25techin_UserLecture";
        $mdpBD = "b+zIQTikY5RX";

        try {

            $connexion = new PDO($dsn, $usager, $mdpBD);
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

                var_dump($_SESSION['prenom']);

            } else {
                //Mauvais mot de passe, rediriger
                header("Location: ../formConnexion.php?erreur=login");
            }

        } catch (PDOException $e) {
            #echo "<p>Erreur de connexion à la base de données : " . $e->getMessage() . "</p>";
            "<h3><a href='../formConnexion.php'> Une erreur est survenue. Veuillez réessayer.</a></h3>";
        }
    } else {
        echo "<p>Veuillez remplir tous les champs.</p>";
    }
} else {
    echo "<p>Accès refusé.</p>";
}
?>