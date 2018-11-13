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

    public function addUser($nom, $prenom, $email, $Pass, $adresse, $date_naissance, $codePostal, $ville, $telephone)
    {
        $bdd = $this->dbConnect();
        //on recherche dans la table users si le  pseudo existe deja
        $verificationEmail = "SELECT * FROM user WHERE email = ? ";

        $check_mail_In_Bdd = $bdd->prepare($verificationEmail);
        $check_mail_In_Bdd->execute(array($email));
        $count = $check_mail_In_Bdd->rowCount();
        if ($count != 0) {
            $email_utilisé = true;
        }
        $verificationPhone = "SELECT * FROM user WHERE phone = ?";
        $check_phone_In_Bdd = $bdd->prepare($verificationPhone);
        $check_phone_In_Bdd->execute(array($telephone));
        $count = $check_phone_In_Bdd->rowCount();
        if ($count != 0) {
            $phone_utilisé = true;
        }
        if (isset($email_utilisé) && isset($phone_utilisé)) {
            return 'email et telephone deja utilisé';
        } elseif (isset($email_utilisé)) {
            return 'email deja utilisé';
        } elseif (isset($phone_utilisé)) {
            return 'telephone deja utilisé';
        }

        $InsererDansBdd = "INSERT INTO user ( nom, prenom, email, mdp, date_de_naissance, adresse, code_postal, ville, phone) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $signUp = $bdd->prepare($InsererDansBdd);
        $signUp->execute(array($nom, $prenom, $email, $Pass, $date_naissance, $adresse, $codePostal, $ville, $telephone));
        return 'inscription reussie';


    }

}