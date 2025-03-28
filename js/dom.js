// Chamgement dynamique des images en arrière plan

const images = ["Images/avatar.jpg", "Images/Deadpool & Wolverine.jpg", "Images/Godzilla.jpg", "Images/joker.webp",  "Images/Ghostbusters.jpg" ];
var index = 0;

function changeBackground() {
    document.querySelector(".background-slider").style.backgroundImage = `url(${images[index]})`;
    index++; // Passe à l'image suivante 
    if (index == images.length)
       {index = 0} //Revient au début
    console.log(document.querySelector(".background-slider").style.backgroundImage)
}

setInterval(changeBackground, 3000); // Change l’image toutes les 3 secondes
changeBackground(); // Appel initial pour éviter l'attente



// // Gestion de l'affichage des films // 


// Tableau des films
let films = [
    {
        'titre': 'Deadpool 2',
        'image': 'Images/deadpool 2.jpg',
        'labels': {'new': 'NOUVEAU'}
    },

    {
        'titre': 'Dune !',
        'image': 'Images/Dune-2-Poster-4x5-BW.jpg',
        'labels': {}
    },

    {
        'titre': 'Mission Impossible 2',
        'image': 'Images/mission-impossible-dex-reckoning-part-2-poster-by-rahalarts.jpg',
        'labels': {'oscars': '8 OSCARS'}
    },

    {
        'titre': 'Godzilla',
        'image': 'Images/Godzilla.jpg',
        'labels': {'new': 'NOUVEAU'}
    },

    {
        'titre': 'Joker',
        'image': 'Images/joker.webp',
        'labels': {'oscars': '10 NOMINATIONS AUX OSCARS'}
    },

    {
        'titre': 'Avatar',
        'image': 'Images/avatar.jpg',
        'labels': {'new': 'NOUVEAU'}
    },

    {
        'titre': 'Ghostbusters',
        'image': 'Images/Ghostbusters.jpg',
        'labels': {}
    },

    {
        'titre': 'Kung-Fu Panda 4',
        'image': 'Images/kung-fu-panda-4.jpg',
        'labels': {'oscars': '6 NOMINATIONS AUX OSCARS'}
    }
];



//Fonction pour rechercher des films 

function rechercherFilms(terme) {
    
    let results = [];
    
    // Convertir le terme de recherche en minuscule et le nettoyer des espaces
    terme = terme.trim().toLowerCase();
    
    // Parcours du tableau des films
    films.forEach(film => {
        // Si le titre du film contient le terme de recherche
        if (film.titre.toLowerCase().includes(terme)) {
            results.push(film); // Ajoute le film aux résultats
        }
    });
    
    return results; // Retourne les films trouvés
}


// Fonction pour afficher les films 

function afficherFilms(films) {
    films.forEach(film => {
        // Créer un conteneur div pour chaque film
        let filmDiv = document.createElement('div');
        filmDiv.classList.add('film');
        
        // Créer et ajouter l'image du film
        let img = document.createElement('img');
        img.src = film.image;
        img.alt = film.titre;
        filmDiv.appendChild(img);
        
        // Si le film a des labels, on les affiche
        if (Object.keys(film.labels).length > 0) {
            for (let classLabel in film.labels) {
                let label = document.createElement('span');
                label.classList.add('label', classLabel);
                label.textContent = film.labels[classLabel];
                filmDiv.appendChild(label);
            }
        }
        
        // Ajouter le titre du film
        let titre = document.createElement('h2');
        titre.textContent = film.titre;
        filmDiv.appendChild(titre);
        
        // Ajouter le film à la page
        document.body.appendChild(filmDiv);
    });
}


// Fonction pour afficher 5 films aléatoires :

function afficherFilmsAleatoires(films, nombre = 5) {
    // On ne peut pas demander plus de films que disponibles
    nombre = Math.min(nombre, films.length);
    
    // Mélanger les films de manière aléatoire
    let filmsAleatoires = [];
    let indicesUtilises = new Set();
    
    while (filmsAleatoires.length < nombre) {
        let indexAleatoire = Math.floor(Math.random() * films.length);
        
        if (!indicesUtilises.has(indexAleatoire)) {
            filmsAleatoires.push(films[indexAleatoire]);
            indicesUtilises.add(indexAleatoire);
        }
    }
    
    // Afficher les films choisis au hasard
    filmsAleatoires.forEach(film => {
        let filmDiv = document.createElement('div');
        filmDiv.classList.add('film');
        
        let img = document.createElement('img');
        img.src = film.image;
        img.alt = film.titre;
        filmDiv.appendChild(img);
        
        if (Object.keys(film.labels).length > 0) {
            for (let classLabel in film.labels) {
                let label = document.createElement('span');
                label.classList.add('label', classLabel);
                label.textContent = film.labels[classLabel];
                filmDiv.appendChild(label);
            }
        }
        
        let titre = document.createElement('h2');
        titre.textContent = film.titre;
        filmDiv.appendChild(titre);
        
        document.body.appendChild(filmDiv);
    });
}