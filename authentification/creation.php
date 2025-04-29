<?php

// Vérifie que le formulaire a bien été soumis en POST

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];

    // Vérifie que les champs ne sont pas vides

    if (!empty($nom) && !empty($prenom) && !empty($email) && !empty($password) && $password === $confirmPassword) {

        // Hash du mot de passe
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Connexion à la base

        define("BDSCHEMA", "akpachoh25techin_BD-Octave");
        define("BDSERVEUR", "127.0.0.1");
        $dsn = "mysql:dbname=" . BDSCHEMA . ";host=" . BDSERVEUR;
        $usager = "akpachoh25techin_userEcriture";
        $mdp = "lm#B$.mH^J.f";

        try {
            $connexion = new PDO($dsn, $usager, $mdp);
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Requete pour vérification si le compte existe déjà 
            $nbIdentifiant = $connexion->query("SELECT COUNT(email) from users where email = ':email'");
            $nbIdentifiant ->bindParam(':email', $email);

            //var_dump($nbIdentifiant);

            if ($nbIdentifiant->rowCount() > 1) {
                echo "<h3><a href='../formCreation.html'> Cette adresse email existe déjà. Veuillez réessayer.</a></h3>";
            }

            else{

            // Requête d'insertion

            $stmt = $connexion->prepare("INSERT INTO users (nom, prenom, email, mdp) VALUES (:nom, :prenom, :email, :password)");
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $passwordHash);

            // Exécuter l'insertion
            
            if ($stmt->execute()) {
                echo "<h2>Compte créé avec succès !</h2>";
                echo "<h3><a href='../formConnexion.html'> Se connecter </a></h3>";
            } else {
                echo "<p>Erreur lors de la création du compte.</p>";
            }
            }
        } catch (PDOException $e) {

            echo "<h3><a href='../formCreation.html'> Une erreur inconnue est survenue. Veuillez réessayer.</a></h3>";
            #echo "Erreur de connexion à la base de données : " . $e->getMessage();
        }
    } else {
        echo "<p>Veuillez remplir tous les champs correctement.</p>";
    }
} else {
    echo "<p>Accès refusé.</p>";
}
?>