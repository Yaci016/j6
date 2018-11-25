<?php
date_default_timezone_set('Europe/Paris');
require 'controller/backEnd.php';
require 'controller/frontEnd.php';
session_start();
if (isset($_SESSION['user'])) {
    $ConectedUser = unserialize($_SESSION['user']);
}
if (isset($_SESSION['admin'])) {
    $ConectedAdmin = unserialize($_SESSION['admin']);
}
if (isset($_POST['id'])){
    $id = $_POST['id'];
}
if (isset($_GET['action'])) {
    $action = $_GET['action'] ;
    //rajouter des if else if ici pour les pages du site
    switch ($action) {
        case 'home' : //page d'accueil
            global $ConectedAdmin;
            if (isset($ConectedAdmin)) {
                adminHome();
            } else {
                getMeal();
            }
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
            global $ConectedUser;
            if (isset($ConectedUser)) {
                ViewAccount();
            } else {
                header('location:index.php?action=error');
            }

            break;
        case 'reservation':
            global $ConectedUser;
            if (isset($ConectedUser)) {
                Reserve();
            } else {
                header('location:index.php?action=error');
            }
            break;
        case 'order':
            global $ConectedUser;
            if (isset($ConectedUser)) {
                Order();
            } else {
                header('location:index.php?action=error');
            }
            break;
        case 'orderIdMeal':
            global $ConectedUser;
            if (isset($ConectedUser)) {
                ajax();
            } else {
                header('location:index.php?action=error');
            }
            break;
        case 'ConfirmOrder':
            global $ConectedUser;
            if (isset($ConectedUser)) {
                ConfirmOrder();
            } else {
                header('location:index.php?action=error');
            }
            break;
        case 'LogOff':
            LogOff();
            break;
        case 'error':
            error();
            break;
        default ://si aucun argument n'est rentré pour la variable $_get['action'] on affiche la page d'accueil
            header('location:index.php?action=home');
            break;
    }
} else { //definit la page principal si aucune page n'est demandé
    header('location:index.php?action=home');
}