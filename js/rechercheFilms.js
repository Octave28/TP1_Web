document.addEventListener("DOMContentLoaded", function () {
    const searchForm = document.querySelector("form");
    const input = document.querySelector("input[name='recherche']");
    const films = document.querySelectorAll(".film");

    searchForm.addEventListener("submit", function (e) {
        e.preventDefault(); // Empêche le rechargement de la page
        const terme = input.value.trim().toLowerCase();

        // Supprimer les anciens effets de mise en évidence
        films.forEach(film => {
            film.classList.remove("film-highlight");
        });

        // Si le champ est vide, ne rien faire
        if (terme === "") return;

        // Ajouter l’effet aux bons films
        films.forEach(film => {
            const titre = film.getAttribute("data-titre").toLowerCase();
            if (titre.includes(terme)) {
                film.classList.add("film-highlight");
            }
        });
    });
});

function AnnulerRecherche() {
    const films = document.querySelectorAll(".film");
    const input = document.querySelector("input[name='recherche']");
    input.value = "";
    films.forEach(film => film.classList.remove("film-highlight"));
};
