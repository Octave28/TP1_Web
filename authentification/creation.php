<?php
require_once 'bdParams.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $nom = filter_input(INPUT_POST,"nom",FILTER_SANITIZE_STRING);
    $prenom = filter_input(INPUT_POST,"prenom",FILTER_SANITIZE_STRING);
    $email =  filter_input(INPUT_POST,"email",FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST,"password",FILTER_DEFAULT);
    $confirmPassword = filter_input(INPUT_POST,"confirm-password",FILTER_DEFAULT);

    if (!empty($nom) && !empty($prenom) && !empty($email) && !empty($password) && $password === $confirmPassword) {

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        try {
            $connexion = new PDO($dsn, $usagerEcriture, $mdp2BD);
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Vérifier si l’email existe déjà
            $stmt = $connexion->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                header("Location: ../formCreation.php?erreur=email");
                exit();
            } else {
                $stmt = $connexion->prepare("INSERT INTO users (nom, prenom, email, mdp) VALUES (:nom, :prenom, :email, :password)");
                $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
                $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->bindParam(':password', $passwordHash, PDO::PARAM_STR);

                if ($stmt->execute()) {
                    error_log("[" . date("d/m/o H:i:s e", time()) . "]  Client " . $_SERVER['REMOTE_ADDR'] . "\n\r", 3, __DIR__ . "/../../../logs/Cinepass/ecritureBase.log");
                    error_log("Ecriture dans la base de données.", 3, __DIR__ . "/../../../logs/Cinepass/ecritureBase.log");
                    header("Location: ../formConnexion.php?alerte=compteCree");
                    exit();
                } else {
                    header("Location: ../erreur.php");
                }
            }
        } catch (PDOException $e) {
            error_log("Erreur de connexion à la base de données : " . $e->getMessage(), 3, __DIR__ . "/../../../logs/Cinepass/error.log");
            error_log("[" . date("d/m/o H:i:s e", time()) . "]  Client " . $_SERVER['REMOTE_ADDR'] . "\n\r", 3, __DIR__ . "/../../../logs/Cinepass/error.log");
            exit();
        }

    } else {
        header("Location: ../formCreation.php?erreur2=entreesInvalides");
    }

} else {
    error_log("Accès refusé à la base de données.", 3, __DIR__ . "/../../../logs/Cinepass/error.log");
    error_log("[" . date("d/m/o H:i:s e", time()) . "]  Client " . $_SERVER['REMOTE_ADDR'] . "\n\r", 3, __DIR__ . "/../../../logs/Cinepass/error.log");
    exit();
}
?>
