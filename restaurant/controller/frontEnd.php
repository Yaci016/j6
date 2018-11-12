<?php
require 'model/frontend/model.php';
function getMeal() {
    $meals = new MealManager();
    $liste_aliment = $meals -> getMeals();
    //rajouter la logique presente sur l'accueil ici
    require 'view/frontEnd/accueil/homeView.phtml';
}