<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 11/19/2018 0019
 * Time: 1:51 AM
 */

namespace restaurant\model\frontEnd;


class User extends Manager
{
    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $date_de_naissance;
    private $mdp;
    private $adresse;
    private $code_postal;
    private $ville;
    private $phone;

    public function __construct($id)
    {
        $this->id = $id;
    }

    protected function GetUser()
    {
        $bdd = $this->dbConnect();
        $getAttributes = "SELECT * FROM user WHERE id = ? ";
        $checkLoginInBdd = $bdd->prepare($getAttributes);
        $checkLoginInBdd->execute(array($this->id));
        $Les_ids = $checkLoginInBdd->fetch();
        $this->nom = $Les_ids['nom'];
        $this->prenom = $Les_ids['prenom'];
        $this->email = $Les_ids['email'];
        $this->date_de_naissance = $Les_ids['date_de_naissance'];
        $this->mdp = $Les_ids['mdp'];
        $this->adresse = $Les_ids['adresse'];
        $this->code_postal = $Les_ids['code_postal'];
        $this->ville = $Les_ids['ville'];
        $this->phone = $Les_ids['phone'];
    }

    public function __wakeup()
    {
        $this->GetUser();
    }

    public function __sleep()
    {
        return ['id'];
    }
    public function getid(){
        return $this->id;
    }
    public function getnom()
    {
        return $this->nom;
    }

    public function getprenom()
    {
        return $this->prenom;
    }

    public function getemail()
    {
        return $this->email;
    }

    public function getdate_de_naissance()
    {
        return $this->date_de_naissance;
    }

    public function getmdp()
    {
        return $this->mdp;
    }

    public function getadresse()
    {
        return $this->adresse;
    }

    public function getcode_postal()
    {
        return $this->code_postal;
    }

    public function getville()
    {
        return $this->ville;
    }

    public function getphone()
    {
        return $this->phone;
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/// /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/// /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//done
    public function setnom($nom)
    {
        if (!preg_match(" /[a-zA-Z]{3,20}/ ", $nom)) {
            $_SESSION['nom'] = true;
            return;
        }
        $bdd = $this-> dbConnect();
        $sql = "UPDATE `user` SET `nom` = ? WHERE `user`.`id` = ?";
        $updateNom = $bdd -> prepare($sql);
        $updateNom -> execute(array($nom,$this->id));
        $this->nom = $nom;
    }
//done
    public function setprenom($prenom)
    {
        if ($prenom !== "") {
            if (!preg_match(" /[a-zA-Z]{3,20}/ ", $prenom)) {
                $_SESSION['prenom'] = true;
                return;
            }
        }

        $bdd = $this-> dbConnect();
        $sql = "UPDATE `user` SET `prenom` = ? WHERE `user`.`id` = ?";
        $updatePrenom = $bdd -> prepare($sql);
        $updatePrenom -> execute(array($prenom,$this->id));

        $this->prenom = $prenom;
    }
//pas done
    public function setemail($email)
    {
        
        //condition
            if (!preg_match(" /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/ ", $email)) {
                $_SESSION['email'] = true;
                return;
            }
        $bdd = $this-> dbConnect();
        $sql = "UPDATE `user` SET `email` = ? WHERE `user`.`id` = ?";
        $updateemail = $bdd -> prepare($sql);
        $updateemail -> execute(array($email,$this->id));
        $this->email = $email;
    }
//pas done
    public function setdate_de_naissance($date_de_naissance)
    {
        //condition
            if (!preg_match(" /^([0-3][0-9]{3,3})(\-)([0-3]{0,1}[0-9])(\-)([0-3]{0,1}[0-9])$/ ", $date_de_naissance)) {
                $_SESSION['date_de_naissance'] = true;
                return;
            }
        //si condition valide on update la bdd
        $bdd = $this-> dbConnect();
        $sql = "UPDATE `user` SET `date_de_naissance` = ? WHERE `user`.`id` = ?";
        $updatedate_de_naissance = $bdd -> prepare($sql);
        $updatedate_de_naissance -> execute(array($date_de_naissance,$this->id));
        $this->date_de_naissance = $date_de_naissance;
    }
//pas done
    public function setmdp($mdp)
    {
        //condition
            if (!preg_match(" /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/ ", $mdp)) {
                $_SESSION['mot de passe'] = true;
                return;
            }
        //si condition valide on update la bdd
          $bdd = $this-> dbConnect();
        $sql = "UPDATE `user` SET `mdp` = ? WHERE `user`.`id` = ?";
        $updatemdp = $bdd -> prepare($sql);
        $updatemdp -> execute(array($mdp,$this->id));
        $this->mdp = $mdp;
    }
//done
    public function setadresse($adresse)
    {
        //condition
            if (!preg_match(" /[a-zA-Z0-9_ ]{3,25}/ ", $adresse)) {
                $_SESSION['adresse'] = true;
                return;
            }
        //si condition valide on update la bdd
          $bdd = $this-> dbConnect();
        $sql = "UPDATE `user` SET `adresse` = ? WHERE `user`.`id` = ?";
        $updateadresse = $bdd -> prepare($sql);
        $updateadresse -> execute(array($adresse,$this->id));
        $this->adresse = $adresse;
    }
//done
    public function setcode_postal($code_postal)
    {
        //condition
            if (!preg_match(" /[0-9]{5}/ ", $code_postal)) {
                $_SESSION['code postal'] = true;
                return;
            }
        //si condition valide on update la bdd
          $bdd = $this-> dbConnect();
        $sql = "UPDATE `user` SET `code_postal` = ? WHERE `user`.`id` = ?";
        $updatecode_postal = $bdd -> prepare($sql);
        $updatecode_postal -> execute(array($code_postal,$this->id));
        $this->code_postal = $code_postal;
    }
//done
    public function setville($ville)
    {
        //condition
            if (!preg_match(" /[a-zA-Z]{3,25}/ ", $ville)) {
                $_SESSION['ville'] = true;
                return;
            }
        //si condition valide on update la bdd
          $bdd = $this-> dbConnect();
        $sql = "UPDATE `user` SET `ville` = ? WHERE `user`.`id` = ?";
        $updateville = $bdd -> prepare($sql);
        $updateville -> execute(array($ville,$this->id));
        $this->ville = $ville;
    }
//done
    public function setphone($phone)
    {
        //condition
            if (!preg_match(" /^([0]\d\s)(\d\d\s){3}(\d\d)$/ ", $phone)) {
                $_SESSION['telephone'] = true;
                return;
            }
        //si condition valide on update la bdd
          $bdd = $this-> dbConnect();
        $sql = "UPDATE `user` SET `phone` = ? WHERE `user`.`id` = ?";
        $updatephone = $bdd -> prepare($sql);
        $updatephone  -> execute(array($phone,$this->id));
        $this->phone = $phone;
    }
}