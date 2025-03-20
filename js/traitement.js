document.addEventListener("DOMContentLoaded", ObtenirDonnees());

const liste = []

function ObtenirDonnees(){
    let nom = document.getElementById("nom")
    let prenom = document.getElementById("prenom")
    let mail = document.getElementById("new-email")

    liste+= nom;
    liste+=prenom;
    liste+=mail
    
    return liste
}

