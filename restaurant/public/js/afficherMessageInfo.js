'use strict';
document.addEventListener('DOMContentLoaded', function () {
    //variable
    var divInfo = document.querySelector('#message_info');
    //executing program
    fadeIn(divInfo);
    setTimeout(function () {
        fadeOut(divInfo);
    }, 10000);
});