<?php
/**
 * Created by PhpStorm.
 * User: wali7
 * Date: 12/11/18
 * Time: 14:29
 */
require_once 'manager.php';
class MealManager extends \restaurant\model\frontEnd\manager
{
    public function getMeals(){
    $bdd = $this -> dbConnect();
        $getMeal = "SELECT * FROM `meal`";
        $Meals = [];

        $reponseIndex = $bdd->prepare($getMeal);
        $reponseIndex->execute();
        while ($donnees = $reponseIndex->fetch()) {
            $Meals[] = $donnees;
        };
        return $Meals;
    }
}
