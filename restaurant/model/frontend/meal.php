<?php
/**
 * Created by PhpStorm.
 * User: wali7
 * Date: 12/11/18
 * Time: 14:29
 */
class Meal extends \restaurant\model\ClassMixte\Manager
{
private $id,$name,$categories,$description,$prix_achat,$prix_vente,$stock,$photo;

//function constructeur
public function __construct(array $donnees) {
    $this -> hydrate( $donnees );
}
//function pour hydrater
public function hydrate(array $donnees)
{
  foreach ($donnees as $key => $value)
  {
    // On récupère le nom du setter correspondant à l'attribut.
    $method = 'set'.ucfirst($key);
        
    // Si le setter correspondant existe.
    if (method_exists($this, $method))
    {
      // On appelle le setter.
      $this->$method($value);
    }
  }
}
// …
//liste des getters
public function id(){return $this -> id ;}
public function name(){return $this -> name;}
public function categories(){return $this -> categories;}
public function description(){return $this-> description;}
public function prix_achat(){return $this-> prix_achat;}
public function prix_vente(){return $this-> prix_vente;}
public function stock(){return $this-> stock;}
public function photo(){return $this-> photo;}
//liste des setters
public function setId($id){
$this -> id = $id;
}
public function setName($name){
$this -> name =$name;
}
public function setCategories($categories){
$this -> categories = $categories;
}
public function setDescription($description){
$this -> description = $description;
}
public function setPrix_achat($prix_achat){
$this -> prix_achat = $prix_achat;
}
public function setPrix_vente($prix_vente){
$this -> prix_vente = $prix_vente;
}
public function setStock($stock){
$this -> stock = $stock;
}
public function setPhoto($photo){
$this -> photo = $photo;
}

}