<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 11/19/2018 0019
 * Time: 1:51 AM
 */

namespace restaurant\model\frontEnd;


use restaurant\model\ClassMixte\Manager;

class Reservation extends Manager {
    private $id,$id_user,$date,$nb_couverts;

    public function ajouterReservation($id_user, $date, $nb_couverts) {
        $bdd = $this-> dbConnect();
        $sql = "INSERT INTO `reservation` ( `id_user`, `date`, `nb_couverts`) VALUES (?,?,?)";
        $ajouterReservationVar = $bdd -> prepare($sql);
        $ajouterReservationVar -> execute(array($id_user,$date,$nb_couverts));
        if ($ajouterReservationVar) {
            $_SESSION['ReservationReussi'] = true;
        } else {
            $_SESSION['ReservationRate'] = true;
        }
    }
    public function GetList(){
        $bdd = $this-> dbConnect();
        $sql = "SELECT * FROM `reservation`";
        $reservations = [];
        $ajouterReservationVar = $bdd -> prepare($sql);
        $ajouterReservationVar -> execute();

       while ($donnees = $ajouterReservationVar->fetch()) {
            $reservations[] = $donnees;
        };
        return $reservations;
    }
}