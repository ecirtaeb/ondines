<?php 
include_once 'modele/ondinesConnexion.php'; // connexion bdd
include_once 'modele/ondinesLogement.php'; // lecture info logements
include_once 'modele/ondinesDiapo.php'; // lecture photos diaporama(s)
include_once 'services/util.php'; // utilitaires

// Récupération informations du logement sélectionné

$id = $_GET['id'];
$initliste = ['A','B','C','D','E','F','G','H','I','J'];

// On récupère les dates en session s'il y en a 

if ( isset($_SESSION['datdeb']) && isset($_SESSION['datfin'])) {

	$datdeb = $_SESSION['datdeb'];
	$datfin = $_SESSION['datfin']; 
  $prix = calculTarifSejour($id,DateTime::createFromFormat('d-m-Y', $datdeb), DateTime::createFromFormat('d-m-Y', $datfin));
  $liste = ( isset($_SESSION['listOk']) ) ? $_SESSION['listOk'] : $initliste;

} else {

  $liste = $initliste;
}

$iid = array_search($id, $liste);
$idsuiv = ( $iid == count($liste)-1 ) ? $liste[0] : $liste[$iid + 1];
$idprec = ( $iid == 0) ? $liste[count($liste)-1] : $liste[$iid - 1];

$photosFiche = lireDiapoCateg($id); // liste des photos constituant le diaporama du logement

$fichelogement = selLogementParId($id);	// informations à afficher
$fichetarif = recupTarif($id);				// grille tarifaire du logement	
$ficheperiode = recupPeriode();				// dates des périodes (haute, basse, moyenne saison);

include 'vues/fiche.phtml.php';

?>