// Chamgement dynamique des images en arrière plan

const images = ["Images/avatar.jpg", "Images/Deadpool & Wolverine.jpg", "Images/Godzilla.jpg", "Images/joker.webp",  "Images/Ghostbusters.jpg", "Images/Underground.jpg",  "Images/elevation.jpg",  "Images/redNotice.avif" ];
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