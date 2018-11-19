<?php
require 'model/frontend/model.php';


function getMeal()
{
    $message_info = checkErrors();
    $meals = new MealManager();
    $liste_aliment = $meals -> getMeals();
    //rajouter la logique presente sur l'accueil ici
    require_once 'view/frontEnd/accueil/homeView.phtml';
}


function ViewSignUp()
{
    require_once 'view/frontEnd/espace_membre/SignUpView.phtml';
}


function CheckSignUpinfo()
{

    //variable $_post renomé pour faire plus beau
    if (isset($_POST['mdp']) && isset($_POST['email']) && isset($_POST['telephone'])) {

        isset($_POST['Nom']) ? $nom = $_POST['Nom'] : null;//need to check its a chain of caracters

        isset($_POST['Prenom']) ? $prenom = $_POST['Prenom'] : null;// need to check its a chain of caracters

        isset($_POST['mdp']) ? $Pass = $_POST['mdp'] : null;//need to check for length at least 8 and contains at least a number

        isset($_POST['email']) ? $email = $_POST['email'] : null;//no need to check html tag is enough

        isset($_POST['year']) ? $date_naissance = $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'] : null;//no need to check.

        isset($_POST['adresse']) ? $adresse = $_POST['adresse'] : null;

        isset($_POST['ville']) ? $ville = $_POST['ville'] : null; //need to check its a chain of caracters

        isset($_POST['Code_postal']) ? $codePostal = $_POST['Code_postal'] : null;//need to check its a chain of numbers

        isset($_POST['telephone']) ? $telephone = $_POST['telephone'] : null;//need to check its a chain of numbers

        //instantiation de la classe UserManager et utilisation de sa methode addUser
        $checkUser = new \restaurant\model\frontEnd\UserManager();
        $checkUser->addUser($nom, $prenom, $email, $Pass, $adresse, $date_naissance, $codePostal, $ville, $telephone);


    } else {
        $_SESSION['signUp_fail'] = true;
    }
    header('location:index.php');
}

function logIn()
{
    if (isset($_POST['mdp']) && isset($_POST['email'])) {
        $email = htmlspecialchars($_POST['email']);
        $mdp = htmlspecialchars($_POST['mdp']);
        $logInUSer = new \restaurant\model\frontEnd\UserManager();
        $logInUSer->signInUser($email, $mdp);
        header('location:index.php');
    }
}


function ViewAccount()
{
    $ConectedUser = new \restaurant\model\frontEnd\User($_SESSION['id']);
    var_dump($ConectedUser);
    require_once 'view/frontEnd/espace_membre/MyAccountView.phtml';
}

function Reserve()
{

}

function Order()
{

}


function LogOff()
{
    session_destroy();
    header('location:index.php');
}

function checkErrors()
{
    $color = 'red';
    //inscription potential errors
    if (isset($_SESSION['used_phone_email'])) {
        unset($_SESSION['used_phone_email']);
        $message = "Echec de l\'inscription. telephone et email rentré deja utilisé.";
    };
    if (isset($_SESSION['used_email'])) {
        unset($_SESSION['used_email']);
        $message = 'Echec de l\'inscription. email utilisé';
    };
    if (isset($_SESSION['used_phone'])) {
        unset($_SESSION['used_phone']);
        $message = 'Echec de l\'inscription. telephone deja utilisé';
    };
    if (isset($_SESSION['signUp_success'])) {
        unset($_SESSION['signUp_success']);
        $message = 'inscription reussi.';
        $color = 'lawngreen';
    };
    if (isset($_SESSION['signUp_fail'])) {
        unset($_SESSION['signUp_fail']);
        $message = 'echec de l\'inscription . veuiller a bien rentré toute les infos.';

    };

    if (isset($_SESSION['nom'])) {
        unset($_SESSION['nom']);
        isset($message) ? $message .= '<p>erreur format :  nom</p>' : $message = '<p>erreur format :  nom</p>';
    }
    if (isset($_SESSION['prenom'])) {
        unset($_SESSION['prenom']);
        isset($message) ? $message .= '<p>erreur format : prenom</p>' : $message = '<p>erreur format : prenom</p>';
    }
    if (isset($_SESSION['email'])) {
        unset($_SESSION['email']);
        isset($message) ? $message .= '<p>erreur format : email</p>' : $message = '<p>erreur format : email</p>';
    }
    if (isset($_SESSION['mot de passe'])) {
        unset($_SESSION['mot de passe']);
        isset($message) ? $message .= '<p>erreur format : mot de passe</p>' : $message = '<p>erreur format : mot de passe</p>';
    }
    if (isset($_SESSION['date'])) {
        unset($_SESSION['date']);
        isset($message) ? $message .= '<p>erreur format : date</p>' : $message = '<p>erreur format : date</p>';
    }
    if (isset($_SESSION['code postal'])) {
        unset($_SESSION['code postal']);
        isset($message) ? $message .= '<p>erreur format : code postal</p>' : $message = '<p>erreur format : code postal</p>';
    }
    if (isset($_SESSION['ville'])) {
        unset($_SESSION['ville']);
        isset($message) ? $message .= '<p>erreur format : ville</p>' : $message = '<p>erreur format : ville</p>';
    }
    if (isset($_SESSION['telephone'])) {
        unset($_SESSION['telephone']);
        isset($message) ? $message .= '<p>erreur format : telephone</p>' : $message = '<p>erreur format : telephone</p>';
    }
    //connexion potential errors
    if (isset($_SESSION['Email_non_existant'])) {
        unset($_SESSION['Email_non_existant']);
        $message = 'echec de la connexion.l\'email fournis inexistant dans la base de donnée.';

    };
    if (isset($_SESSION['logIn_fail'])) {
        unset($_SESSION['logIn_fail']);
        $message = 'echec de la connexion. Mauvaix mot de passe.';

    };
    if (isset($_SESSION['logIn_success'])) {
        unset($_SESSION['logIn_success']);
        $message = 'Connexion reussi.';
        $color = 'lawngreen';
    };


    isset($message) ? $message_info = '<div id="message_info" style="background:' . $color . '"><p style="color:white;">' . $message . '</p></div>' : null;
    if (isset($message_info)) {
        return $message_info;
    }
}
