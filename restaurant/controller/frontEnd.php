<?php
require 'model/frontend/model.php';


function getMeal() {
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
    if (isset($nom) && isset($prenom) && isset($Pass) && isset($email) && isset($date_naissance) && isset($adresse) && isset($ville) && isset($codePostal) && isset($telephone)) {
        $nom = $_POST['Nom'];
        $prenom = $_POST['Prenom'];
        $Pass = $_POST['Pass'];
        $email = $_POST['email'];
        $date_naissance = $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'];
        $adresse = $_POST['adresse'];
        $ville = $_POST['ville'];
        $codePostal = $_POST['Code_postal'];
        $telephone = $_POST['telephone'];
        //instantiation de la classe UserManager et utilisation de sa methode addUser
        $checkUser = new \restaurant\model\frontEnd\UserManager();
        $state = $checkUser->addUser($nom, $prenom, $email, $Pass, $adresse, $date_naissance, $codePostal, $ville, $telephone);

        /* 'email et telephone deja utilisé'
    'email deja utilisé'
    'telephone deja utilisé'
    'inscription reussie'*/

        //un switch pour  check la valeur retourné par la methode addUser
        switch ($state) {
            case 'email et telephone deja utilisé':

                $_SESSION['used_phone_email'] = true;
                break;
            case 'email deja utilisé':

                $_SESSION['used_email'] = true;
                break;
            case 'telephone deja utilisé':

                $_SESSION['used_phone'] = true;
                break;
            case 'inscription reussie':

                $_SESSION['signUp_success'] = true;
                break;
        }
    } else {
        $_SESSION['signUp_fail'] = true;
    }
    header('location:index.php');
}


function checkErrors()
{
    if (isset($_SESSION['used_phone_email'])) {
        unset($_SESSION['used_phone_email']);
        $message_info = '<p>Echec de l\'inscription. telephone et email rentré deja utilisé.</p>';
    };
    if (isset($_SESSION['used_email'])) {
        unset($_SESSION['used_email']);
        $message_info += '<p>Echec de l\'inscription. email utilisé</p>';
    };
    if (isset($_SESSION['used_phone'])) {
        unset($_SESSION['used_phone']);
        $message_info += '<p>Echec de l\'inscription. telephone deja utilisé</p>';
    };
    if (isset($_SESSION['signUp_success'])) {
        unset($_SESSION['signUp_success']);
        $message_info = '<p>inscription reussi.</p>';
    };
    if (isset($_SESSION['signUp_fail'])) {
        unset($_SESSION['signUp_fail']);
        $message_info = '<p>echec de l\'inscription . veuiller a bien rentré toute les infos.</p>';
    };

    if (isset($message_info)) return $message_info;
}
