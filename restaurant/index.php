<?php
require 'controller/frontEnd.php';
if (isset($_GET['action'])) {
    $action = $_GET['action'] ;
    //rajouter des if else if ici pour les pages du site
    if ($action === 'home'){
        getMeal();
    } elseif ($action === 'SignUp'){

    }elseif ($action === 'LogIn') {

}
} else { //definit la page principal si aucune page n'est demandé
    getMeal();
}