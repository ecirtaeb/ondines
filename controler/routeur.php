<?php 
include_once 'services/util.php'; // utilitaires
require_once 'modele/ondinesConnexion.php'; // connexion bdd*/
include_once 'services/util.php'; // utilitaires

// Appel du controleur en fonction de la de l'information "page" récupérée par GET 

if (isset($_GET['page'])) {

	if ($_GET['page']=="accueil") {

		require 'controler/accueil.php';

	} else if (is_file('controler/'.$_GET['page'].'.php')) {

		require 'controler/'.$_GET['page'].'.php';

	} else {

		require 'controler/oups.php';
	}
    
} else {

	initAccueil();
   require 'controler/accueil.php';		// S'il n'y a pas de page on route vers la page accueil
}


?>