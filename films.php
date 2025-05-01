<?php
// // Tableau des films
// $films = [
//     [
//         'titre' => 'Deadpool 2',
//         'image' => 'Images/deadpool 2.jpg',
//         'labels' => ['new' => 'NOUVEAU']
//     ],
//     [
//         'titre' => 'Dune !',
//         'image' => 'Images/Dune-2-Poster-4x5-BW.jpg',
//         'labels' => []
//     ],
//     [
//         'titre' => 'Mission Impossible 2',
//         'image' => 'Images/mission-impossible-dex-reckoning-part-2-poster-by-rahalarts.jpg',
//         'labels' => ['oscars' => '8 OSCARS']
//     ],
//     [
//         'titre' => 'Godzilla',
//         'image' => 'Images/Godzilla.jpg',
//         'labels' => ['new' => 'NOUVEAU']
//     ],
//     [
//         'titre' => 'Joker',
//         'image' => 'Images/joker.webp',
//         'labels' => ['oscars' => '10 NOMINATIONS AUX OSCARS']
//     ],

//     [
//         'titre' => 'Avatar',
//         'image' => 'Images/avatar.jpg',
//         'labels' => ['new' => 'NOUVEAU']
//     ],

//     [
//         'titre' => 'Ghostbusters',
//         'image' => 'Images/Ghostbusters.jpg',
//         'labels' => []
//     ],

//     [
//         'titre' => 'Kung-Fu Panda 4',
//         'image' => 'Images/kung-fu-panda-4.jpg',
//         'labels' => ['oscars' => '6 NOMINATIONS AUX OSCARS']
//     ]
// ];

// Array des films
define("BDSCHEMA", "akpachoh25techin_BD-Octave");
define("BDSERVEUR", "127.0.0.1");
$dsn = "mysql:dbname=" . BDSCHEMA . ";host=" . BDSERVEUR;
$usager = "akpachoh25techin_UserLecture";
$mdp = "b+zIQTikY5RX";

    // Connexion à la base de données
    try {
        $connexion = new PDO($dsn, $usager, $mdp);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Preparation de la requete pour obtenir les films

        $stmt = $connexion->prepare(
            "SELECT f.* FROM films f"
        );

        $stmt->execute();

        $films = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } 
    catch (PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
    }


// Fonction pour rechercher des films
function rechercherFilms($terme) {
    global $films;
    $results = [];
    $terme = strtolower(trim($terme));
    
    foreach ($films as $film) {
        if (strpos(strtolower($film['titre']), $terme) !== false) {
            $results[] = $film;
        }
    }
    
    return $results;
}

// Fonction pour afficher les films :

function afficherFilms(array $films) {
    foreach ($films as $film) {
        echo '<div class="film">';
        echo '<img src="' . htmlspecialchars($film['image']) . '" alt="' . htmlspecialchars($film['titre']) . '">';
        
        // if (!empty($film['labels'])) {
        //     // foreach ($film['labels'] as $class => $label) {
        //     //     echo '<span class="label ' . htmlspecialchars($class) . '">' . htmlspecialchars($label) . '</span>';
        //     // }
        //     foreach ($film['labels'] as $label) {
        //         echo '<span class="label ' . htmlspecialchars($label) . '">' . htmlspecialchars($label) . '</span>';
        //         }
        // }

        if (!empty($films['labels'])) {
            // foreach ($film['labels'] as $class => $label) {
            //     echo '<span class="label ' . htmlspecialchars($class) . '">' . htmlspecialchars($label) . '</span>';
            // }
            foreach ($films['labels'] as $label) {
                echo '<span class="label ' . htmlspecialchars($label) . '">' . htmlspecialchars($label) . '</span>';
                }
            
            var_dump($films);
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
        
        // if (!empty($film['labels'])) {
        //     // foreach ($film['labels'] as $class => $label) {
        //     //     echo '<span class="label '.$class.'">'.$label.'</span>';
        //     // }
        //     foreach ($film['labels'] as $label) {
        //         echo '<span class="label ' . htmlspecialchars($label) . '">' . htmlspecialchars($label) . '</span>';
        //     }
        // } 
        
        
        if (!empty($films['labels'])) {
            // foreach ($film['labels'] as $class => $label) {
            //     echo '<span class="label ' . htmlspecialchars($class) . '">' . htmlspecialchars($label) . '</span>';
            // }
            foreach ($films['labels'] as $label) {
                echo '<span class="label ' . htmlspecialchars($label) . '">' . htmlspecialchars($label) . '</span>';
                }
        }
        echo '<h2>'.htmlspecialchars($film['titre']).'</h2>';
        echo '</div>';
    }
}