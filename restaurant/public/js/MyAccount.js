   'use strict';
        //TODO faire en sorte quand on click un button une fois apres on rentre notre nouvel valeur dans l'input si on click sur entré ca ne marche que sur le boutton lié a l'input changé.
        document.addEventListener('DOMContentLoaded', function () {

            function changeParagraphToInput(span, button, icone, type, regex) {
                
                var handler = function (e) {
                    e.preventDefault();
                    var value = span.textContent;
                    span.innerHTML = '<input type="text" name="' + type + '" pattern="' + regex + '" id="nom" placeholder="' + value + '">';
                    icone.classList.remove('fa-pen');
                    icone.classList.add('fa-check');
                    button.setAttribute('name', type);
                    button.removeEventListener("click", handler);
                    SetValue();
                };
                var SetValue = function() {
                   var input =  document.querySelector('input[name="'+type+'"]');
                   input.addEventListener('input',function(){
                   button.setAttribute('value',input.value);
                   input.addEventListener('keypress',function(e){
                    var key = 'which' in e ? e.which : e.keyCode;
                    if (key == 13 ) {
                        e.preventDefault();
                        button.click();
                    }
                   })
                })};
                button.addEventListener('click', handler);
            }
changeParagraphToInput(document.querySelector('#nomSpan'), document.querySelector('.buttonNom'), document.querySelector('.nom'), 'nom', '[a-zA-Z]{3,20}');
changeParagraphToInput(document.querySelector('#prenomSpan'), document.querySelector('.buttonPrenom'), document.querySelector('.prenom'), 'prenom', '[a-zA-Z]{3,20}');
changeParagraphToInput(document.querySelector('#villeSpan'), document.querySelector('.buttonVille'), document.querySelector('.ville'), 'ville', '[a-zA-Z]{3,25}');
changeParagraphToInput(document.querySelector('#adresseSpan'), document.querySelector('.buttonAdresse'), document.querySelector('.adresse'), 'adresse', '[a-zA-Z0-9_ ]{3,40}');
changeParagraphToInput(document.querySelector('#emailSpan'), document.querySelector('.buttonEmail'), document.querySelector('.email'), 'email', '^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$');
changeParagraphToInput(document.querySelector('#code_postalSpan'), document.querySelector('.buttonCodePostal'), document.querySelector('.code_postal'), 'code_postal', '^[0-9]{5,5}$');
changeParagraphToInput(document.querySelector('#telephoneSpan'), document.querySelector('.buttonTelephone'), document.querySelector('.telephone'), 'telephone', '^([0]\\d\\s)(\\d\\d\\s){3}(\\d\\d)$');
        });