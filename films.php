<?php
require_once 'authentification/bdParams.php';

    // Connexion à la base de données
    try {
        $connexion = new PDO($dsn, $usagerLecture, $mdp1BD);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Preparation de la requete pour obtenir les films

        $stmt = $connexion->prepare(
            "SELECT f.* FROM films f"
        );

        $stmt->execute();

        $films = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } 
    catch (PDOException $e) {
        error_log("Erreur de connexion à la base de données : " . $e->getMessage(), 3, __DIR__ . "/../../../logs/Cinepass/error.log");
    }


function afficherFilms(array $films) {
    foreach ($films as $film) {
        echo '<div class="film" data-titre="' . strtolower(htmlspecialchars($film['titre'])) . '">';
        echo '<img src="' . htmlspecialchars($film['image']) . '" alt="' . htmlspecialchars($film['titre']) . '">';

        if (!empty($film['labels'])) {
            foreach ($film['labels'] as $label) {
                echo '<span class="label ' . htmlspecialchars($label) . '">' . htmlspecialchars($label) . '</span>';
            }
        }
        
        echo '<h2>' . htmlspecialchars($film['titre']) . '</h2>';
        echo '</div>';
    }
}


// Fonction pour afficher 5 films aléatoires 

function afficherFilmsAleatoires($films, $nombre = 5) {
    // Vérifier qu'on ne demande pas plus de films que disponibles
    $nombre = min($nombre, count($films));
    
    // Générer les index aléatoires uniques
    $indexAleatoires = array_rand($films, $nombre);
    
    // Si un seul film, array_rand retourne un seul index (pas un tableau)
    if ($nombre == 1) {
        $indexAleatoires = [$indexAleatoires];
    }
    
    // Afficher les films
    foreach ($indexAleatoires as $index) {
        $film = $films[$index];
        echo '<div class="film">';
        echo '<img src="'.$film['image'].'" alt="'.htmlspecialchars($film['titre']).'">';
        
        
        if (!empty($films['labels'])) {
    
            foreach ($films['labels'] as $label) {
                echo '<span class="label ' . htmlspecialchars($label) . '">' . htmlspecialchars($label) . '</span>';
                }
        }
        echo '<h2>'.htmlspecialchars($film['titre']).'</h2>';
        echo '</div>';
    }
}