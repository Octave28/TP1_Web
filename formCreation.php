<?php
    $erreur = filter_input(INPUT_GET,"erreur",FILTER_DEFAULT);
    $erreur2 = filter_input(INPUT_GET,"erreur2",FILTER_DEFAULT);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaires de connexion et inscription</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="form-container">
        <div class="form-box" id="register-form">
            <h2>Créer un compte</h2>
            <form action="authentification/creation.php" method="POST" id="formCreation">

                <div class="erreur">
                    <?php 
                        if (isset($erreur))
                        {
                            echo " Un compte avec cette adresse courriel existe déja ! ";
                        } 
                    ?>
                </div>

                <div class="erreur">
                    <?php 
                        if (isset($erreur2))
                        {
                            echo " Veuillez remplir tous les champs correctement ! ";
                        } 
                    ?>
                </div>

                <label for="Nom">Nom :</label>
                <input type="nom" id="nom" name="nom" required>

                <label for="Prenom">Prenom :</label>
                <input type="prenom" id="prenom" name="prenom" required>

                <label for="new-email">Email :</label>
                <input type="email" id="new-email" name="email" required>
                
                <label for="new-password">Mot de passe :</label>
                <input type="password" id="new-password" name="password" required>
                
                <label for="confirm-password">Confirmer le mot de passe :</label>
                <input type="password" id="confirm-password" name="confirm-password" required>
                
                <button type="submit">Créer un compte</button>
            </form>
        </div>
        <p> Vous avez déjà un compte ? <a href="formConnexion.php">Connectez-vous </a> !</p>    
    </div>
</body>
</html>