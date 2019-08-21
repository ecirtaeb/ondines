<?php 
include_once 'services/util.php'; // utilitaires
include_once 'modele/ondinesReservation.php'; // lecture infos réservations

// Récupération information du logement sélectionné

$date = new DateTime();
$id = $_GET['id'];

switch ($id) {
	case "A":
    $idsuiv = "B";
    $idprec = "J";
    break;
  	case "B":
    $idsuiv = "C";
    $idprec = "A";
    break;
  	case "C":
    $idsuiv = "D";
    $idprec = "B";
    break;
  	case "D":
    $idsuiv = "E";
    $idprec = "C";
    break;
  	case "E":
    $idsuiv = "F";
    $idprec = "D";
    break;
  	case "F":
    $idsuiv = "G";
    $idprec = "E";
    break;
  	case "G":
    $idsuiv = "H";
    $idprec = "F";    
    break;
  	case "H":
    $idsuiv = "I";
    $idprec = "G";    
    break;
   case "I":
    $idsuiv = "J";
    $idprec = "H";    
    break;
  	case "J":
    $idsuiv = "A";
    $idprec = "I";    
    break;
 }

$src = recupVignette($id)['vignette1'];	// récupération chemin vignette affichée dans le header 

$ical = lireLienCalAppart($id,$date->format('Y'));				// récupération du lien ical
$planningResa = recupCalendrier($ical);		// récupération du calendrier des réservations

$nbdate = count($planningResa);


$planning = new classPlanning($date,$id,$planningResa);
$planningDispo = $planning->lirePlanning();

// Affichage page disponibilité
include 'vues/dispo.phtml.php';
 
 ?>