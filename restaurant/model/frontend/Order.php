<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 11/25/2018 0025
 * Time: 6:50 PM
 */

namespace restaurant\model\frontEnd;


class Order
{
    private $id, $id_user, $prix_total, $date;

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

    public function id_user()
    {
        return $this->id_user;
    }

    public function prix_total()
    {
        return $this->prix_total;
    }

    public function date()
    {
        return $this->date;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setId_user($id_user)
    {
        $this->id_user = $id_user;
    }

    public function setPrix_total($prix_total)
    {
        $this->prix_total = $prix_total;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

}