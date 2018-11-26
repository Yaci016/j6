<?php
/**
 * Created by PhpStorm.
 * User: wali7
 * Date: 12/11/18
 * Time: 14:29
 */
class MealManager extends \restaurant\model\ClassMixte\Manager
{

    public function add(Meal $meal) {
        $id =           $meal->id();
        $name =         $meal ->name();
        $categories =   $meal ->categories();
        $description =  $meal -> description();
        $prix_achat =   $meal -> prix_achat();
        $prix_vente =   $meal -> prix_vente();
        $stock =        $meal -> stock();
        $photo =        $meal -> photo();

        $bdd = $this -> dbConnect();

        $sql = "INSERT INTO `meal` ( `name`, `categories`, `description`, `prix_achat`, `prix_vente`, `stock`, `photo`) VALUES ( ?, ?, ?, ?, ?, ?, ?)";
        $insertMeal = $bdd -> prepare($sql);
        $insertMeal = execute(array($name,$categories,$description,$prix_achat,$prix_vente,$stock,$photo));

    }

    public function delete(Meal $meal) {
        $bdd = $this -> dbConnect();
        $id = $meal->id();
        $sql = 'DELETE FROM `meal` WHERE `meal`.`id` = ?';
        $deleteMeal = $bdd -> prepare($sql);
        $deleteMeal -> execute(array($id));
    }

    public function update(Meal $meal) {
       $bdd = $this -> dbConnect();
        $id =           $meal->id();
        $name =         $meal ->name();
        $categories =   $meal ->categories();
        $description =  $meal -> description();
        $prix_achat =   $meal -> prix_achat();
        $prix_vente =   $meal -> prix_vente();
        $stock =        $meal -> stock();
        $photo =        $meal -> photo();

        $sql = 'UPDATE `meal` SET name = ?, `categories` = ?, `description` = ?, `prix_achat` = ?, `prix_vente` = ?, `stock` = ?, photo = ? WHERE `meal`.`id` = ?';

        $insertMeal = $bdd -> prepare($sql);
        $insertMeal -> execute(array($name,$categories,$description,$prix_achat,$prix_vente,$stock,$photo,$id));
    }

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
        $donne = $reponseCommand -> fetch(PDO::FETCH_ASSOC);
        return $donne;
    }
}
