<!-- <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaires de connexion et inscription</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="form-container">
        <div class="form-box" id="login-form">
            <h2>Se connecter</h2>

            <form action="authentification/connexion.php" method="POST" id="formConnexion">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required>
                
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
                
                <button type="submit">Se connecter</button>
            </form>
            
        </div>    
        <p> Vous n'avez pas encore de compte, <a href="formCreation.html">créez -en ici </a> !</p>    
    </div>
</body>
</html> -->

<?php
    $erreur = filter_input(INPUT_GET,"erreur",FILTER_VALIDATE_EMAIL);
?>

<!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Formulaires de connexion et inscription</title>
        <link rel="stylesheet" href="css/style.css">
        <script src="js/dom.js"></script>
    </head>
    <body>
        <div class="form-container">
            <div class="form-box" id="login-form">
                <h2>Se connecter</h2>

                <div>
                    <?php 
                        if (isset($erreur))
                        {
                            echo " Adresse email ou mot de passe Incorrect ! Veuillez réessayer ";
                        } 
                    ?>
                </div>

                <form action="authentification/connexion.php" method="POST" id="formConnexion">

                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email" required>
                    
                    <label for="password">Mot de passe :</label>
                    <input type="password" id="password" name="password" required>
                    
                    <button type="submit">Se connecter</button>
                </form>
                
            </div>    
            <p> Vous n'avez pas encore de compte, <a href="formCreation.php">créez -en ici </a> !</p>    
        </div>
    </body>

</html>

