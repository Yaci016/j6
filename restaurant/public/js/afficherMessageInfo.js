'use strict';
document.addEventListener('DOMContentLoaded', function () {
    //variable
    var divInfo = document.querySelector('#message_info');

    //functions
    function fadeOut(el) {
        el.style.opacity = 1;

        (function fade() {
            if ((el.style.opacity -= .1) < 0) {
                el.style.display = "none";
            } else {
                requestAnimationFrame(fade);
            }
        })();
    }

    function fadeIn(el, display) {
        el.style.opacity = 0;
        el.style.display = display || "block";

        (function fade() {
            var val = parseFloat(el.style.opacity);
            if (!((val += .1) > 1)) {
                el.style.opacity = val;
                requestAnimationFrame(fade);
            }
        })();
    }

    //executing program
    fadeIn(divInfo);
    setTimeout(function () {
        fadeOut(divInfo);
    }, 10000);
});