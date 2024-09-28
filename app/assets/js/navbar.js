window.onload = () => {
    const navButton = document.querySelector("#main-navbar .nav-button");

    // Si on clique sur le bouton on ouvre le menu
    navButton.addEventListener("click", function(event){
        // On stoppe la propagation
        event.stopPropagation();

        // On ajoute la classe show ou on l'enlève
        this.nextElementSibling.classList.toggle("show");
    });

    // Si on clique n'importe où, on ferme le menu
    document.addEventListener("click", function(){
        navButton.nextElementSibling.classList.remove("show");
    })
}