<?php

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

            $stmt = $connexion->prepare("SELECT * FROM user WHERE email = :email");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);

            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Validation du mot de passe :
            
            if (password_verify($password, $user['mdp'])) {

                $prenom = htmlspecialchars($user['prenom']);

                require_once __DIR__."/authentification/sessionSet.include.php";
                
                session_start();
                $_SESSION['email'] = "2309595@cegepat.qc.ca";
                $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
                header("Location: authentification/authentificationRedirect.php");

            } else {
                //Mauvais mot de passe, rediriger
                 header("Location: ../index.php?session=erreurInfo");
            }

        } catch (PDOException $e) {
            echo "<p>Erreur de connexion à la base de données : " . $e->getMessage() . "</p>";
        }
    } else {
        echo "<p>Veuillez remplir tous les champs.</p>";
    }
} else {
    echo "<p>Accès refusé.</p>";
}
?>