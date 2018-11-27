<?php

require 'model/frontend/model.php';


function getMeal()
{
    $meals = new MealManager();
    $liste_aliment = $meals->getMeals();
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
        $login = $logInUSer->signInUser($email, $mdp);
        if ($login === false) {
            $logInAdmin = new \restaurant\model\backEnd\AdminManager();
            $logInAdmin->signInAdmin($email, $mdp);
        }
        header('location:index.php');
    }
}
function ViewAccount()
{
    global $ConectedUser;
    if (isset($_POST)) {
        $attributes = ['nom', 'prenom', 'ville', 'adresse', 'email', 'code_postal', 'telephone'];
        foreach ($attributes as $attribute) {
            isset($_POST[$attribute]) ? CheckEditInfo($attribute, $_POST[$attribute], $ConectedUser) : null;
        }
    }
    require_once 'view/frontEnd/espace_membre/MyAccountView.phtml';
}

//a continuer ici

//TODO changer l'emplacement de #message infos du homeview a layout
//TODO rajouter une gestion d'erreur sur le update my infos du mon compte
// 
function CheckEditInfo($attribute, $value, \restaurant\model\frontEnd\User $user)
{

    switch ($attribute) {
        case 'nom':
            $user->setnom($value);
            break;
        case 'prenom':
            $user->setprenom($value);
            break;
        case 'ville':
            $user->setville($value);
            break;
        case 'adresse':
            $user->setadresse($value);
            break;
        case 'email':
            $user->setemail($value);
            break;
        case 'code_postal':
            $user->setcode_postal($value);
            break;
        case 'telephone':
            $user->setphone($value);
            break;
        default :
            null;
            break;
    }
}

function Reserve()
{
    if (isset($_POST['year'])) {
        $date_reservation = $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'] . ' ' . $_POST['hours'] . ':' . $_POST['minutes'] . ':' . '00';
        global $ConectedUser;
        $reservation = new  \restaurant\model\frontEnd\Reservation;

        $reservation->ajouterReservation($ConectedUser->getid(), $date_reservation, $_POST['nombre_couvert']);
    }
    require_once('view/frontEnd/espace_membre/ReserverView.phtml');
}

function Order()
{
    $meals = new MealManager();
    $liste_aliment = $meals->getMeals();
    $premier_aliment = $meals->getMeal(1);

    require_once('view/frontEnd/espace_membre/CommanderView.phtml');
}


function ajax()
{
    global $id;
    if (isset($id)) {

        $meal = new MealManager();
        $premier_aliment = $meal->getMeal($id);
        echo "<img src=\"public/images/meals/" . $premier_aliment['photo'] . "\" alt=\"" . $premier_aliment['name'] . "\">
        <p>" . $premier_aliment['description'] . "</p><p>Prix unitaire : <span id='prix_unitaire'>" . $premier_aliment['prix_vente'] . "</span> €</p>";
    }
}

function ConfirmOrder()
{
    global $ConectedUser;
    $listeCommande = json_decode($_POST['data'], true);
    $orderManager = new \restaurant\model\frontEnd\OrderManager();
    $orderLineManager = new \restaurant\model\frontEnd\OrderLineManager();
    $prix_total = $_POST['prix_total'];
    $date = date("Y-m-d H:i:s");
    $order = new \restaurant\model\frontEnd\Order(['id_user' => $ConectedUser->getid(), 'prix_total' => $prix_total, 'date' => $date]);
    //Pour commande `id_user`, `prix_total`, `date` // Pour ligne de commande $id_Commande,$idMeal,$quantite,$prix_unit
    $idCommande = $orderManager->AddOrder($order);
    foreach ($listeCommande as $key => $value) {
        $orderLine = new \restaurant\model\frontEnd\OrderLine(['idCommande' => $idCommande, 'id_meal' => $value['id'], 'quantité' => $value['quantite'], 'prix_unitaire' => $value['prixUnitaire']]);
        $orderLineManager->Add($orderLine);
    }
}

//TODO INVESTIGER LA CAUSE DE POURQUOI LA SESSION ADMIN N'EST PAS PRISE EN COMPTE
//TODO FAIRE LES PAGES Consulter les COMMANDES A/ CONSULTER LES RESERVATIONS / AJOUTER UN PRODUIT / EDITER UN PRODUIT de l'espace admin
//TODO RAJOUTER DES CONDITION DANS L'INDEX POUR PROTEGER LACCES AU PAGES UTILISATEUR CONNECTE / ADMIN CONNECTE
//TODO RAJOUTER DU CSS/JS  SUR LES PAGES du site POUR DONNER VIE AUX SITE
function LogOff()
{
    session_destroy();
    header('location:index.php');
}

function checkErrors()
{
    $color = ' red';
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
    if (isset($_SESSION['adresse'])) {
        unset($_SESSION['adresse']);
        isset($message) ? $message .= '<p>erreur format : adresse</p>' : $message = '<p>erreur format : adresse</p>';
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
        $color = ' lawngreen';
    };

    if (isset($_SESSION['ReservationRate'])) {
        unset($_SESSION['ReservationRate']);
        $message = 'echec de la Reservation.';

    };
    if (isset($_SESSION['ReservationReussi'])) {
        unset($_SESSION['ReservationReussi']);
        $message = 'Reservation reussi.';
        $color = ' lawngreen';
    };


    if (isset($_SESSION['logIn_success_admin'])) {
        unset($_SESSION['logIn_success_admin']);
        $message = 'Bon retour Monsieur L\'admin.';
    };
    if (isset($_SESSION['success_uploading_file'])) {
        unset($_SESSION['success_uploading_file']);
        $message = 'Le fichier a bien etait upload dans la base de donnee.';
    };
    if (isset($_SESSION['error_uploading_file'])) {
        unset($_SESSION['error_uploading_file']);
        $message = 'Le fichier n\'a pas etait upload dans la base de donnee.';
    };

    isset($message) ? $message_info = '<div id="message_info" style="border:1px solid' . $color . ';"><p style="color:black;font-weight:bold;">' . stripslashes($message) . '</p></div>' : null;
    if (isset($message_info)) {
        return $message_info;
    }
}

function error()
{
    require_once('view/Error404.phtml');
}

