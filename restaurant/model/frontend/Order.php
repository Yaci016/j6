<?php
/**
 * Created by PhpStorm.
 * User: wali7
 * Date: 13/11/18
 * Time: 09:19
 */
//TODO Methode connexion a rajouter
//TODO rajouter une page membre avec la possibilité de changer ses informations
//TODO rajouter une div qui affiche les donnée et le statue connecté quand la personne se connecte
//TODO rajouter une page pour faire une reservation
//TODO commencer le back office (admin peux acceder a tout les infos du site.
namespace restaurant\model\frontEnd;

class Order extends Manager {
	public function AddOrder($idUser,$TotalPrice,$date){
		$bdd = $this->dbConnect();
		$sql = "INSERT INTO `commandes` ( `id_user`, `prix_total`, `date`) VALUES (?,?,?)";
		$InsererCommanderBdd = $bdd -> prepare($sql);
$InsererCommanderBdd -> execute(array($idUser,$TotalPrice,$date));
		return $lastId = $bdd->lastInsertId();
	}
	public function AddOrderDetails($id_Commande,$idMeal,$quantite,$prix_unit) {
		$bdd = $this->dbConnect();
		$sql = "INSERT INTO `ligne_de_commande` (`idCommande`, `id_meal`, `quantité`, `prix_unitaire`) VALUES (?, ?, ?, ?)";
		$insereLigneDecommandeBDD = $bdd -> prepare($sql);
		$insereLigneDecommandeBDD -> execute(array($id_Commande,$idMeal,$quantite,$prix_unit));
	}
}