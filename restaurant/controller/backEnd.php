<?php
require 'model/Class_Mixte/Manager.php';
require 'model/backEnd/model.php';
function adminHome(){
    require_once 'view/backEnd/Accueil/HomeView.phtml';
}
function Meals(){
	 $meals = new MealManager();
    $liste_aliment = $meals->getMeals();
	if (isset($_POST['edit'])) {
		editMeal();
		}
	if (isset($_POST['delete'])) {
	deleteMeal();
	header('location:index.php?action=Meals');
} 
    require_once 'view/backEnd/Meals/MealsView.Phtml';
}
function addMeal(){
	    require_once 'view/backEnd/Meals/addMealView.phtml';
}
function editMeal(){
		$meals = new MealManager();
		$donnees = $meals -> getMeal($_POST['id']);
		$meal = new Meal($donnees);
		$meals -> update($meal);
}

function deleteMeal() {
		$meals = new MealManager();
		$donnees = $meals -> getMeal($_POST['id']);
		$meal = new Meal($donnees);
		$meals -> delete($meal);
}

function AdminReservation(){
	$reservations = new restaurant\model\frontEnd\Reservation();
	$liste_reservation = $reservations -> GetList();
	require_once 'view/backEnd/Reservation/ReservationView.phtml';
}
function editCommande(){
	if (isset($_GET['idCommande'])) {
        $ligneCommande = new restaurant\model\frontEnd\OrderLineManager();
		$liste_Lignecommandes = $ligneCommande -> getlistOrdersLines($_GET['idCommande']);
		require_once 'view/backEnd/Order/ligneDeCommande.phtml';
	} else {
		$commandes = new restaurant\model\frontEnd\OrderManager();
	$liste_commandes = $commandes -> getlistOrders();
	require_once 'view/backEnd/Order/OrderView.phtml';
	}
	
}
/* 
CHOSES A FAIRE :

Finir la page commande ligne qui prend en paramatre get id commande :

avoir une requete sql sur la page qui fait 

SI id commande existe on execute la function pour afficher les lignes de commande lié a l'id passer en paramtre sinon on affiche toute les commandes 

Finir la page Gestion aliments : 

ajouter la page d'ajout d'aliment quand on clique sur ajouter un aliment puis rajouter une function dans le modele pour inserer un nouvel aliments

ajouter la page edit d'aliment quand on clique sur editer un aliment puis utiliser la function update dans meal manager.

Finir la page Gestion des reservation :

RAjouter des table dans la BDD : 

Ajouter une table  lié au categories(ex boisson hamburger ect ...)

Ajouter une table  lié a l'etat de la commande (en cours de preparation /  expedié / recu)*/
