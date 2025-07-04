<?php
require_once __DIR__ . "/authentification/sessionSet.include.php";

    session_start();

    if (session_status() == PHP_SESSION_ACTIVE) {

        // Vérifie si l'utilisateur est bien connecté (ex. par l'email stocké)

        if (isset($_SESSION['email']) && isset($_SESSION['ip']) && $_SESSION['ip'] == $_SERVER['REMOTE_ADDR']) 
        {
            $mail = $_SESSION['email'];
        }
        else{
            error_log("[".date("d/m/o H:i:s e",time())."]  Client ".$_SERVER['REMOTE_ADDR']."\n\r",3, __DIR__."/../../../logs/Cinepass/error.log");
            header("Location: formConnexion.php");
            exit();
        }
    }
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A la une</title>
</head>
<body>
    
    <main> 
        
        <div class="form-container">

            <div class="form-box" id="reservation-form">

                <h2> Réserver une place </h2>

                <form action="reservation.php" method="POST">

                    <!-- <label for="name">Nom :</label> -->
                    <input type="hidden" id="nom" name="nom" required>

                    <!-- <label for="name">Prenom :</label> -->
                    <input type="hidden" id="prenom" name="prenom" required>
                    
                    <label for="movie">Film :</label>

                    <select id="film" name="film" required>

                        <option value="1">Deadpool 2</option>
                        <option value="2">Dune </option>
                        <option value="3">Mission Impossible 2</option>
                        <option value="4">Godzilla </option>
                        <option value="5">Joker</option>
                        <option value="6">Avatar</option>
                        <option value="7">Ghostbusters</option>
                        <option value="8">Kung-Fu Panda 4</option>
                        <option value="9">Aladin</option>
                        <option value="10">Thunderbolts</option>
                        <option value="11">Destination Finale</option>
                        <option value="12">Shadow Force</option>
                        <option value="13">Elevation</option>
                        <option value="14">Underground</option>
                        <option value="15">Gray Man</option>
                        <option value="16">Red Notice</option>

                    </select>
                    
                    <label for="date">Date :</label>
                    <input type="date" id="date" name="date" required>
                    
                    <label for="time">Horaire :</label>
                    <input type="time" id="horaire" name="horaire" required>
                    
                    <label for="seats">Nombre de places :</label>
                    <input type="number" id="nombre_places" name="nombre_places" min="1" required>
                    
                    <button type="submit">Réserver</button>

                </form>

            </div>

        </div>

    </div>

    </main>
</body>
</html>