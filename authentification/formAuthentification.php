<?php session_start(); ?>
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
        <p>Un code de sécurité à 6 chiffres a été envoyé à l'adresse courriel <strong><?= htmlspecialchars($_SESSION['email'] ?? 'adresse inconnue') ?></strong>.</p>
        <p>Veuillez saisir le code de sécurité reçu et appuyer sur 'Valider'.</p>

        <form action="verifierCode.php" method="POST">

            <div class="insertion">
                <label for="code">Code de sécurité (6 chiffres)* :</label>
                <input type="text" id="code" name="code" maxlength="6" required>
            </div>

            <button type="submit">Valider</button>
        </form>

        <a href="renvoyerCode.php" class="link">Demander un nouveau code</a>
    </div>
</body>
</html>
