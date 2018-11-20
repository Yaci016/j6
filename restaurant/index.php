<?php
require 'controller/frontEnd.php';
session_start();
if (isset($_SESSION['user'])) {
    $ConectedUser = unserialize($_SESSION['user']);
}
if (isset($_GET['action'])) {
    $action = $_GET['action'] ;
    //rajouter des if else if ici pour les pages du site
    switch ($action) {
        case 'home' : //page d'accueil
            getMeal();
            break;
        case 'SignUp'://page d'inscription
            ViewSignUp();
            break;
        case 'checkSignUp'://page de validation d'inscription (juste un script avec un header)
            CheckSignUpinfo();
            break;
        case 'LogIn'://page de connexion
            logIn();
            break;
        case 'Account':
            //CheckEditInfo();
            ViewAccount();
            break;
        case 'reservation':
            Reserve();
            break;
        case 'order':
            Order();
            break;
        case 'LogOff':
            LogOff();
            break;
        default ://si aucun argument n'est rentré pour la variable $_get['action'] on affiche la page d'accueil
            header('location:index.php?action=home');
            break;
    }
} else { //definit la page principal si aucune page n'est demandé
    header('location:index.php?action=home');
}