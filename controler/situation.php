<?php 
include_once 'services/util.php'; // utilitaires
include_once 'modele/ondinesConnexion.php'; // connexion bdd
include_once 'modele/ondinesDiapo.php'; // lecture photos diaporama(s)

// Récupération informations sur la résidence

$photosResidence = lireDiapoCateg('ondines');

include 'vues/situation.phtml.php';
 ?>