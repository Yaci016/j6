<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 11/19/2018 0019
 * Time: 1:51 AM
 */

namespace restaurant\model\backEnd;


use restaurant\model\ClassMixte\Manager;

class admin extends Manager
{
    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $mdp;

    public function __construct($id)
    {
        $this->id = $id;
    }

    protected function GetUser()
    {
        $bdd = $this->dbConnect();
        $getAttributes = "SELECT * FROM admin WHERE id = ? ";
        $checkLoginInBdd = $bdd->prepare($getAttributes);
        $checkLoginInBdd->execute(array($this->id));
        $Les_ids = $checkLoginInBdd->fetch();
        $this->nom = $Les_ids['nom'];
        $this->prenom = $Les_ids['prenom'];
        $this->email = $Les_ids['email'];
        $this->mdp = $Les_ids['mdp'];
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

    public function getmdp()
    {
        return $this->mdp;
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/// /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/// /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//done

}