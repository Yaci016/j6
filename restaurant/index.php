<?php
require 'controller/frontEnd.php';
if (isset($_GET['action'])) {
    if ($_GET['action'] === 'home'){
        getMeal();
    }//rajouter des else if ici pour les autres pages
} else { //definit la page principal si aucune page n'est demandé
    getMeal();
}