'use strict';

//declaration function generique
function testInput(inputField, regex, helpSpan, adviceAboutFormat) {
    inputField.addEventListener('input', function () {
        inputField.style.outline = 'none';
        helpSpan.style.whiteSpace = 'nowrap';
        helpSpan.style.padding = '1%';
        helpSpan.style.borderRadius = '5px';
        var message;
        if (!regex.test(inputField.value)) {
            inputField.style.border = "1px solid red";
            message = adviceAboutFormat;
            helpSpan.style.border = '1px solid red';
        } else {
            inputField.style.border = "1px solid green";
            message = 'success';
            helpSpan.style.border = '1px solid green';
        }
        helpSpan.textContent = message;
    })
}

function compareTwoInputs(input1, input2) {
    input2.addEventListener('input', function () {
        if (input2.value === input1.value) {
            input2.style.border = '1px solid green';
        } else {
            input2.style.border = '1px solid red';
        }
    })
}

function compareToREgex(inputField, regex) {
    inputField.addEventListener('input', function () {
        if (!regex.test(inputField.value)) {
            inputField.style.border = "1px solid red";
        } else {
            inputField.style.border = "1px solid green";
        }
    })
}

document.addEventListener('DOMContentLoaded', function () {
    var boutonConnexion = document.querySelector('#Connexion');
    var sectionConnexion = document.querySelector('#section_connexion');
    if (boutonConnexion) {
        boutonConnexion.addEventListener('click', function (e) {
            sectionConnexion.style.display = "flex";
            boutonConnexion.style.display = "none";
            e.preventDefault();
        })
    }
    if (document.getElementById('email')) {
        var email = document.getElementById('email');
        compareToREgex(email, /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/);
    }

});