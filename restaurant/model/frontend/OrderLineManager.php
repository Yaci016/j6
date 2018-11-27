<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 11/27/2018 0027
 * Time: 12:30 AM
 */

namespace restaurant\model\frontEnd;


class OrderLineManager extends \restaurant\model\ClassMixte\Manager
{

    public function Add(OrderLine $orderLine)
    {
        $id_Commande = $orderLine->idCommande();
        $idMeal = $orderLine->id_meal();
        $quantite = $orderLine->quantité();
        $prix_unit = $orderLine->prix_unitaire();
        $bdd = $this->dbConnect();
        $sql = "INSERT INTO `ligne_de_commande` (`idCommande`, `id_meal`, `quantité`, `prix_unitaire`) VALUES (?, ?, ?, ?)";
        $insereLigneDecommandeBDD = $bdd->prepare($sql);
        $insereLigneDecommandeBDD->execute(array($id_Commande, $idMeal, $quantite, $prix_unit));
    }

    public function update(OrderLine $orderLine)
    {
        $bdd = $this->dbConnect();
        $id = $orderLine->id();
        $idCommande = $orderLine->idCommande();
        $id_meal = $orderLine->id_meal();
        $quantité = $orderLine->quantité();
        $prix_unitaire = $orderLine->prix_unitaire();

        $sql = 'UPDATE `ligne_de_commande` SET idCommande = ?, `id_meal` = ?, `quantité` = ?, `prix_unitaire` = ? WHERE `ligne_de_commande`.`id` = ?';

        $UpdateLigneDecommandeBDD = $bdd->prepare($sql);
        $UpdateLigneDecommandeBDD->execute(array($idCommande, $id_meal, $quantité, $prix_unitaire, $id));
    }

    public function dalete(OrderLine $orderLine)
    {
        $bdd = $this->dbConnect();
        $id = $orderLine->id();
        $sql = 'DELETE FROM `ligne_de_commande` WHERE `ligne_de_commande`.`id` = ?';
        $deleteMeal = $bdd->prepare($sql);
        $deleteMeal->execute(array($id));
    }

    public function getlistOrdersLines($idCommande)
    {
        $bdd = $this->dbConnect();
        $sql = "SELECT * FROM `ligne_de_commande` WHERE idCommande = ?";
        $ligne_de_commandes = [];
        $Liste_commandeLines = $bdd->prepare($sql);
        $Liste_commandeLines->execute(array($idCommande));

        while ($donnees = $Liste_commandeLines->fetch()) {
            $ligne_de_commandes[] = $donnees;
        };
        return $ligne_de_commandes;
    }


    public function getOrderLine($id)
    {
        $bdd = $this->dbConnect();
        $sql = "SELECT * FROM `ligne_de_commande` WHERE id = ?";
        $commandeLine = $bdd->prepare($sql);
        $commandeLine->execute(array($id));
        $donne = $commandeLine->fetch(PDO::FETCH_ASSOC);
        return $donne;
    }
}