'use strict';//mode strict de js
//Gestionaire d'evenmenets
document.addEventListener('DOMContentLoaded', function () {
    //////////////////////////////////////////////////////////////////////////////////////////////
    var prenom = document.querySelector("#Prenom");

    var aidePrenom = document.querySelector("#aidePrenom");

    var nom = document.querySelector("#Nom");

    var aideNom = document.querySelector("#aideNom");

    var ville = document.querySelector("#ville");

    var aideVille = document.querySelector("#aideVille");

    var codePostal = document.querySelector("#Code_postal");

    var aideCodePostal = document.querySelector("#aideCodePostal");

    var telephone = document.querySelector("#telephone");

    var aidePhone = document.querySelector("#aidePhone");

//////////////////////////////////////////////////////
    var form = document.querySelector("form");

    var mdp1Id = document.getElementById("mdp1");

    var mdp2Id = document.getElementById("mdp2");

    var email = document.getElementById("email1");

    var aideEmail = document.getElementById("aideEmail1");

    var email2 = document.getElementById("email2");

//teste des input des valeurs non necessaire
    testInput(prenom, /^[a-zA-Z]{3,20}$/, aidePrenom, 'le prenom doit contenir entre 3 et 20 lettres.');

    testInput(nom, /^[a-zA-Z]{3,20}$/, aideNom, 'le nom doit contenir entre 3 et 20 lettres.');

    testInput(ville, /^[a-zA-Z]{3,40}$/, aideVille, 'la ville doit contenir entre 3 et 40 lettres.');

    testInput(codePostal, /^[0-9]{5,5}$/, aideCodePostal, 'le code postal doit contenir entre 5 chiffres.');

    testInput(telephone, /^([0]\d\s)(\d\d\s){3}(\d\d)$/, aidePhone, 'le telephone doit etre sous le format "0X XX XX XX XX"');

    testInput(email, /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/, aideEmail, 'l\'email  doit etre sous le format "abc@ycv.fr"');
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    compareTwoInputs(email1, email2);
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
    var handler = function (e) {

        var mdp1 = form.elements.mdp1.value;

        var mdp2 = form.elements.mdp2.value;

        var message = "Mots de passe OK";

        if (mdp1 === mdp2) {
            if (mdp1.length >= 8) {
                var regexMdp = /\d+/;
                if (!regexMdp.test(mdp1)) {
                    message = "Erreur : le mot de passe ne contient aucun chiffre";
                    e.preventDefault();
                }
            } else {
                message = "Erreur : la longueur minimale du mot de passe est de 8 caractères";
                e.preventDefault();
            }
        } else {
            message = "Erreur : les mots de passe saisis sont différents";
            e.preventDefault();
        }

        document.getElementById("aideMdp1").textContent = message;

        form.removeEventListener("submit", handler)

    };
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    mdp1Id.addEventListener("input", function (e) {

        var mdp = e.target.value; // Valeur saisie dans le champ mdp
        var longueurMdp = "faible";
        var couleurMsg = "red"; // Longueur faible => couleur rouge
        var aideMdpElt = document.getElementById("aideMdp1");
        var regexCourriel = /[0-9]+/;
        var validiteMdp = "";
        var mdpInfo = document.getElementById("aideMdp1");

        //logique par rapport a la longueur du code
        if (mdp.length >= 8) {
            longueurMdp = "suffisante";
            couleurMsg = "green"; // Longueur suffisante => couleur verte
        } else if (mdp.length >= 6) {
            longueurMdp = "moyenne";
            couleurMsg = "orange"; // Longueur moyenne => couleur orange
        }
        //logique par rapport a la conformité du code a un regex
        if (!regexCourriel.test(e.target.value)) {
            validiteMdp = " / Chiffre : Le mot de passe a besoin d'un chiffre au moins !";
        } else {
            validiteMdp = "";
        }

        aideMdpElt.textContent = "Longueur : " + longueurMdp; // Texte de l'aide
        e.target.style.border = '1px solid ' + couleurMsg;
        aideMdpElt.style.whiteSpace = 'nowrap';
        aideMdpElt.style.borderRadius = '5px';
        aideMdpElt.style.padding = '1%';
        aideMdpElt.style.border = '1px solid ' + couleurMsg; // Couleur du texte de l'aide
        mdpInfo.textContent += validiteMdp;
    });
///////////////////////////////////////////////////////////////////////////////////////////////////////
    compareTwoInputs(mdp1Id, mdp2Id);

    form.addEventListener("submit", handler);
});