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
	if (isset($_POST['submit'])) {
		var_dump($_POST);
		var_dump($_FILES);
		//$_POST['filename']
		$target_dir = "public/images/meals/";
		$target_file = $target_dir . $filee;
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
    	$check = getimagesize($_FILES["Parcourir"]["tmp_name"]);
    	if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    	} else {
        $uploadOk = 0;
    	}
}
// Check if file already exists
if (file_exists($target_file)) {
    //echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["Parcourir"]["size"] > 500000) {
    //echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    //echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["Parcourir"]["tmp_name"], $target_file)) {
		//echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		$_SESSION['success_uploading_file'] = true;
		$donnees = ['name' => $_POST['nom'],'categories'=> $_POST['Categorie'],'description'=> $_POST['description'],'prix_achat'=> $_POST['achat'],'prix_vente'=> $_POST['vente'],'stock'=> $_POST['stock'],'photo'=>$_POST['filename'] ];
		$meal = new Meal($donnees);
		$mealManager = new MealManager();
		$mealManager -> add($meal);
		
    } else {
		//echo "Sorry, there was an error uploading your file.";
		$_SESSION['error_uploading_file'] = true;
    }
}
	}
	    require_once 'view/backEnd/Meals/addMealView.phtml';
}
function editMeal(){
	
	if (isset($_POST['id'])) {
		$meals = new MealManager();
		$donnees = $meals -> getMeal($_POST['id']);
		if (isset($_POST['Submitedit'])) {
			$donnees = ['id' => $_POST['id'],'name' => $_POST['nom'],'categories'=> $_POST['Categorie'],'description'=> $_POST['description'],'prix_achat'=> $_POST['achat'],'prix_vente'=> $_POST['vente'],'stock'=> $_POST['stock'],'photo'=> $_POST['filename']];
			$meal = new Meal($donnees);
			$meals -> update($meal);
			header('location:index.php?action=Meals');
		}
		require_once 'view/backEnd/Meals/editMealView.phtml';
	} 
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
