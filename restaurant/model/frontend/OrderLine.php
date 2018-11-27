<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 11/25/2018 0025
 * Time: 6:51 PM
 */

namespace restaurant\model\frontEnd;


class OrderLine
{
    private $id, $idCommande, $id_meal, $quantité, $prix_unitaire;

    //function constructeur
    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }

//function pour hydrater
    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {
            // On récupère le nom du setter correspondant à l'attribut.
            $method = 'set' . ucfirst($key);

            // Si le setter correspondant existe.
            if (method_exists($this, $method)) {
                // On appelle le setter.
                $this->$method($value);
            }
        }
    }

    public function id()
    {
        return $this->id;
    }

    public function idCommande()
    {
        return $this->idCommande;
    }

    public function id_meal()
    {
        return $this->id_meal;
    }

    public function quantité()
    {
        return $this->quantité;
    }

    public function prix_unitaire()
    {
        return $this->prix_unitaire;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setIdCommande($idCommande)
    {
        $this->idCommande = $idCommande;
    }

    public function setId_meal($id_meal)
    {
        $this->id_meal = $id_meal;
    }

    public function setQuantité($Quantité)
    {
        $this->quantité = $Quantité;
    }

    public function setPrix_unitaire($setPrix_unitaire)
    {
        $this->prix_unitaire = $setPrix_unitaire;
    }
}
