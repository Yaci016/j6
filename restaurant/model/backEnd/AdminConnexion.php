<?php
//TODO commencer le back office (admin peux acceder a tout les infos du site.
namespace restaurant\model\backEnd;
class AdminConnexion extends Manager
{
    public function signInAdmin($email, $Pass)
    {


        $bdd = $this->dbConnect();
        //on recherche dans la table users le pseudo et pass et voir si ca match avec ce que l'utilisateur a rentré
        $verification_email_mdp = "SELECT * FROM admin WHERE email = ? ";
        $checkLoginInBdd = $bdd->prepare($verification_email_mdp);
        $checkLoginInBdd->execute(array($email));
        $count = $checkLoginInBdd->rowCount();


        if ($count === 0) {
            return false;//fail inscription
        } else {
            $Les_ids = $checkLoginInBdd->fetch();
            $id = $Les_ids['id'];
            $pass_bdd = $Les_ids['mdp'];
            //on check le mot de passe si il est valide on go next
           // echo $Pass.'//////////////////'.$pass_bdd;
            if (password_verify($Pass, $pass_bdd)) {
            	session_unset();
                $Connectedadmin = new \restaurant\model\backEnd\admin($id);
                $_SESSION['admin'] = serialize($Connectedadmin);
                var_dump($_SESSION);
                return true;
            }
            if (isset($_SESSION['admin'])) {
                $_SESSION['logIn_success_admin'] = true;
            } else {
                $_SESSION['logIn_fail'] = true;
            }
        }



    }

}