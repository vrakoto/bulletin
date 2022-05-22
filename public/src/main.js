/* const lesEleves = $(".unEleve");

for (let i = 0; i < lesEleves.length; i++) {
    const unEleve = lesEleves[i];
    $(unEleve).click(function (e) { 
        $(unEleve).addClass("unEleveHoverJS")
        lesEleves.not($(e.target)).removeClass("unEleveHoverJS")
    });
} */

const lesUtilisateurs = document.querySelectorAll('.leUtilisateur');

for (let i = 0; i < lesUtilisateurs.length; i++) {
    const utilisateur = lesUtilisateurs[i];
    
    utilisateur.addEventListener('click', (e) => {
        .log(e.originalTarget);
    });
    
}