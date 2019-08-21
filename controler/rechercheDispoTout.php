<?php 
include_once 'services/util.php'; // utilitaires
include_once 'modele/ondinesConnexion.php'; // connexion bdd
include_once 'modele/ondinesLogement.php'; // lecture info logements


// Appelé suite à demande de RAZ de la période via requête AJAX
// Il faut : supprimer les dates de la Session et la liste des logements correspondants

initAccueil();

$datdeb = null;
$datfin = null;
$liste = [];

$logements = selLogements($liste,$datdeb,$datfin);
 
// Mise en forme des informations générales supplémentaires à afficher

$intitule = 'Tous les logements de la Résidence des Ondines';
$infodate = '(date%20non%20précisée)';
$liendate = 'Saisir vos dates';
$datdebsaisie = '';
$datfinsaisie = '';

include 'vues/listeLogements.phtml.php';
   
?>

