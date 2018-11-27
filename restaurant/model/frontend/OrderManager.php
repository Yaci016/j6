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

use restaurant\model\ClassMixte\Manager;

class OrderManager extends Manager
{
    public function AddOrder(Order $order)
    {
        $id_user = $order->id_user();
        $prix_total = $order->prix_total();
        $date = $order->date();
        $bdd = $this->dbConnect();
        $sql = "INSERT INTO `commandes` ( `id_user`, `prix_total`, `date`) VALUES (?,?,?)";
        $InsererCommanderBdd = $bdd->prepare($sql);
        $InsererCommanderBdd->execute(array($id_user, $prix_total, $date));
        return $lastId = $bdd->lastInsertId();
    }
    public function getlistOrders(){
        $bdd = $this-> dbConnect();
        $sql = "SELECT * FROM `commandes`";
        $commandes = [];
        $Liste_commandes = $bdd -> prepare($sql);
        $Liste_commandes -> execute();

       while ($donnees = $Liste_commandes->fetch()) {
            $commandes[] = $donnees;
        };
        return $commandes;
    }


}