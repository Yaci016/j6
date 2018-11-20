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

    public function setnom($nom)
    {
        if (!preg_match(" /[a-zA-Z]{3,20}/ ", $nom)) {
            $_SESSION['nom'] = true;
        }
        $this->nom = $nom;
    }

    public function setprenom($prenom)
    {
        if ($prenom !== "") {
            if (!preg_match(" /[a-zA-Z]{3,20}/ ", $prenom)) {
                $_SESSION['prenom'] = true;
            }
        }

        $this->prenom = $prenom;
    }

    public function setemail($email)
    {
        $this->email = $email;
    }

    public function setdate_de_naissance($date_de_naissance)
    {
        $this->date_de_naissance = $date_de_naissance;
    }

    public function setmdp($mdp)
    {
        $this->mdp = $mdp;
    }

    public function setadresse($adresse)
    {
        $this->adresse = $adresse;
    }

    public function setcode_postal($code_postal)
    {
        $this->code_postal = $code_postal;
    }

    public function setville($ville)
    {
        $this->ville = $ville;
    }

    public function setphone($phone)
    {
        $this->phone = $phone;
    }
}