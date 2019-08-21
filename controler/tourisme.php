<?php 
include_once 'services/util.php'; // utilitaires
include_once 'modele/ondinesConnexion.php'; // connexion bdd
include_once 'modele/ondinesDiapo.php'; // lecture info planning et tarifs

// Récupération phtos pour constituer les diaporamas

$diapoTourisme = lirediapoType('tourisme');

// Affichage liste logements
include 'vues/tourisme.phtml.php';
 
 ?>