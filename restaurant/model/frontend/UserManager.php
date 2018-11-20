<?php
/**
 * Created by PhpStorm.
 * User: wali7
 * Date: 13/11/18
 * Time: 09:19
 */
//TODO Methode connexion a rajouter
//TODO rajouter une page membre avec la possibilité de changer ses informations
//TODO rajouter une div qui affiche les donnée et le statue connecté quand la personne se connecte
//TODO rajouter une page pour faire une reservation
//TODO commencer le back office (admin peux acceder a tout les infos du site.
namespace restaurant\model\frontEnd;

class UserManager extends Manager
{

    public function addUser($nom = null, $prenom = null, $email, $Pass, $adresse = null, $date_naissance = null, $codePostal = null, $ville = null, $telephone)
    {
        $table = [$nom, $prenom, $email, $Pass, $adresse, $date_naissance, $codePostal, $ville, $telephone];
        //checks input informations /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        if ($nom !== "") {
            if (!preg_match(" /[a-zA-Z]{3,20}/ ", $nom)) {
                $_SESSION['nom'] = true;
            }
        } elseif ($nom === "") {
            $nom = null;
        }

        if ($prenom !== "") {
            if (!preg_match(" /[a-zA-Z]{3,20}/ ", $prenom)) {
                $_SESSION['prenom'] = true;
            }
        } elseif ($prenom === "") {
            $prenom = null;
        }

        if ($email !== "") {
            if (!preg_match(" /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/ ", $email)) {
                $_SESSION['email'] = true;
            }
        } elseif ($email === "") {
            $email = null;
        }

        if ($Pass !== "") {
            if (!preg_match(" /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/ ", $Pass)) {
                $_SESSION['mot de passe'] = true;
            }
        } elseif ($Pass === "") {
            $Pass = null;
        }

        if ($date_naissance !== "") {

            if (!preg_match(" /^([0-3][0-9]{3,3})(\-)([0-3]{0,1}[0-9])(\-)([0-3]{0,1}[0-9])$/ ", $date_naissance)) {
                $_SESSION['date'] = $date_naissance;
            }
        } elseif ($date_naissance === "") {
            $date_naissance = null;
        }

        if ($codePostal !== "") {
            if (!preg_match(" /^[0-9]{5,5}$/ ", $codePostal)) {
                $_SESSION['code postal'] = true;
            }
        } elseif ($codePostal === "") {
            $codePostal = 0;
        }

        if ($ville !== "") {
            if (!preg_match(" /[a-zA-Z]{3,25}/ ", $ville)) {
                $_SESSION['ville'] = true;
            }
        } elseif ($ville === "") {
            $ville = null;
        }

         if ($adresse !== "") {
            if (!preg_match(" /[a-zA-Z0-9_ ]{3,40}/ ", $adresse)) {
                $_SESSION['adresse'] = true;
            }
        } elseif ($adresse === "") {
            $adresse = null;
        }


        if ($telephone !== "") {
            if (!preg_match(" /^([0]\d\s)(\d\d\s){3}(\d\d)$/", $telephone)) {
                $_SESSION['telephone'] = true;
            }
        } elseif ($telephone === "") {
            $telephone = null;
        }

        if (isset($_SESSION['nom']) || isset($_SESSION['nom']) || isset($_SESSION['prenom']) || isset($_SESSION['email']) || isset($_SESSION['mot de passe']) || isset($_SESSION['date']) || isset($_SESSION['code postal']) || isset($_SESSION['ville']) || isset($_SESSION['ville'])) {
            return;
        }
        //checks in database /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $bdd = $this->dbConnect();
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //on recherche dans la table users si le mail existe deja
        $verificationEmail = "SELECT * FROM user WHERE email = ? "; //ta requere sql
        $check_mail_In_Bdd = $bdd->prepare($verificationEmail); // tu prepare ta requete sql come ca
        $check_mail_In_Bdd->execute(array($email)); // tu execute ta requete sql avec co
        $count = $check_mail_In_Bdd->rowCount();
        if ($count != 0) {
            $email_utilise = true;
        }

        //on recherche dans la table users si le telephone existe deja
        $verificationPhone = "SELECT * FROM user WHERE phone = ?";
        $check_phone_In_Bdd = $bdd->prepare($verificationPhone);
        $check_phone_In_Bdd->execute(array($telephone));
        $count = $check_phone_In_Bdd->rowCount();
        if ($count != 0) {
            $phone_utilise = true;
        }


        // serie de condition pour choisir qu'elle erreur afficher
        if (isset($email_utilise) && isset($phone_utilise)) {
            $_SESSION['used_phone_email'] = true;
            return;
        } elseif (isset($email_utilise)) {
            $_SESSION['used_email'] = true;
            return;
        } elseif (isset($phone_utilise)) {
            $_SESSION['used_phone'] = true;
            return;
        }

        $InsererDansBdd = "INSERT INTO user ( nom, prenom, email, mdp, date_de_naissance, adresse, code_postal, ville, phone) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $signUp = $bdd->prepare($InsererDansBdd);
        $signUp->execute(array(htmlspecialchars($nom), htmlspecialchars($prenom), htmlspecialchars($email), password_hash($Pass, PASSWORD_DEFAULT), htmlspecialchars($date_naissance), htmlspecialchars($adresse), htmlspecialchars($codePostal), htmlspecialchars($ville), htmlspecialchars($telephone)));
        if ($signUp) {
            $_SESSION['signUp_success'] = true;
        } else {
            $_SESSION['signUp_fail'] = true;
        }
    }


    public function signInUser($email, $Pass)
    {
        $bdd = $this->dbConnect();
        //on recherche dans la table users le pseudo et pass et voir si ca match avec ce que l'utilisateur a rentré
        $verification_email_mdp = "SELECT * FROM user WHERE email = ? ";
        $checkLoginInBdd = $bdd->prepare($verification_email_mdp);
        $checkLoginInBdd->execute(array($email));
        $count = $checkLoginInBdd->rowCount();
        if ($count === 0) {
            $_SESSION['Email_non_existant'] = true;
            return false;//fail inscription
        } else {
            $Les_ids = $checkLoginInBdd->fetch();
            $id = $Les_ids['id'];
            $pass_bdd = $Les_ids['mdp'];
            //on check le mot de passe si il est valide on go next
            if (password_verify($Pass, $pass_bdd)) {
                $ConectedUser = new \restaurant\model\frontEnd\User($id);
                var_dump($ConectedUser);
                $_SESSION['user'] = serialize($ConectedUser);
            }

            if (isset($_SESSION['user'])) {
                $_SESSION['logIn_success'] = true;
            } else {
                $_SESSION['logIn_fail'] = true;
            }
        }
    }


}
