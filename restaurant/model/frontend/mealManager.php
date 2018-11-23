<?php
/**
 * Created by PhpStorm.
 * User: wali7
 * Date: 12/11/18
 * Time: 14:29
 */
class MealManager extends \restaurant\model\ClassMixte\Manager
{
    public function getMeals(){
    $bdd = $this -> dbConnect();
        $getMeals = "SELECT * FROM `meal`";
        $Meals = [];

        $reponseIndex = $bdd->prepare($getMeals);
        $reponseIndex->execute();
        while ($donnees = $reponseIndex->fetch()) {
            $Meals[] = $donnees;
        };
        return $Meals;
    }
    public function getMeal($id) {
        $bdd = $this -> dbConnect();
        $getMeal = "SELECT * FROM meal WHERE id = ?";
         $reponseCommand = $bdd->prepare($getMeal);
        $reponseCommand->execute(array($id));
        $donne = $reponseCommand -> fetch();
        return $donne;
    }
}
