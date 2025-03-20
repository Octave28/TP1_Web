<?php
session_start();

// Simuler un utilisateur connecté
$_SESSION["user_id"] = 1;
$_SESSION["nom"] = "Dupont";
$_SESSION["prenom"] = "Jean";

$user_connected = isset($_SESSION["user_id"]);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
</head>
<body>
    <header>
        <h1>Bienvenue 
            <?php echo $user_connected ? htmlspecialchars($_SESSION["prenom"]) : "sur notre site"; ?> !
        </h1>
    </header>

    <nav>
        <a href="index.php">Accueil</a>
        <a href="catalogue.html">Catalogue</a>
        <a href="reservation.html">Faire une réservation</a>
        <a href="infos.html">Nous joindre</a>
        <?php if ($user_connected): ?>
            <a href="deconnexion.php">Déconnexion</a>
        <?php else: ?>
            <a href="login.html">Connexion</a>
        <?php endif; ?>
    </nav>

    <main>
        <h2>Films recommandés pour vous</h2>

        <?php if ($user_connected): ?>
            <p>Bonjour, <?php echo htmlspecialchars($_SESSION["prenom"]); ?> ! Voici des films sélectionnés pour vous :</p>
        <?php else: ?>
            <p>Connectez-vous pour voir des recommandations personnalisées !</p>
        <?php endif; ?>

        <div class="film-grid">
            <div class="film">
                <img src="Images/avatar.jpg" alt="Black Dog">
                <span class="label new">NOUVEAU</span>
                <h2>Avatar</h2>
            </div>
            <div class="film">
                <img src="Images/Ghostbusters.jpg" alt="Black Dog">
                <h2>Ghostbusters</h2>
            </div>
        </div>
    </main>

    <footer>
        <p>Contactez-nous à info@cinemapass.com</p>
    </footer>
</body>
</html>