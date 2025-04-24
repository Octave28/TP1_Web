<?php 
    require_once __DIR__ . "/sessionSet.include.php";
    session_start(); # je reprends la session

    #Si la session n'est plus active
    if (!session_status() == PHP_SESSION_ACTIVE) {
        echo "La session n'est plus valide. <a href='..'>Réessayer</a>";
        exit();
    }

    if (!isset($_SESSION['code'])){
        echo "<h3><a href='authentificationRedirect.php'>Votre session n'est plus valide. Veuillez réessayer.</a></h3>";
        exit();
    }


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Validation d'identité</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="formValidation">

    <div class="formValidationCode">

        <h2>Validation d'identité</h2>
        <p>Un code de sécurité à 6 chiffres a été envoyé à l'adresse courriel <strong><?= htmlspecialchars($_SESSION['email']) ?></strong>.</p>
        <p>Veuillez saisir le code de sécurité reçu et appuyer sur 'Valider'.</p>

        <form action="sessionFinale.php" method="POST">

            <div class="insertion">
                <label for="code">Code de sécurité (6 chiffres)* :</label>
                <input type="text" id="code" name="code" maxlength="6" required>
            </div>

            <button type="submit">Valider</button> 
        </form>

        <a href="authentificationRedirect.php" class="link">Demander un nouveau code</a>
    </div>

</body>
</html>