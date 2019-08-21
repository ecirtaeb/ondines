<?php 
include_once 'services/util.php'; // utilitaires
include_once 'modele/ondinesConnexion.php'; // connexion bdd
include_once 'modele/ondinesLogement.php'; // lecture info logements
include_once 'modele/ondinesDiapo.php'; // lecture photos diaporama(s)

// On récupère les dates en session s'il y en a et la liste des logements correspondants

if ( isset($_SESSION['datdeb']) && isset($_SESSION['datfin']) ) {

	$datdeb = $_SESSION['datdeb'];
	$datfin = $_SESSION['datfin'];
	$resadeb = DateTime::createFromFormat('d-m-Y', $datdeb);
	$resafin = DateTime::createFromFormat('d-m-Y', $datfin);
	$liste = ( isset($_SESSION['listOk']) ) ? $_SESSION['listOk'] : [];

} else {

	$datdeb = null;
	$datfin = null;
	$liste = [];

}


// La fonction listeDiapo retourne la liste des photos du diaporama de la page d'accueil

$listePhotos = lireDiapoCateg('accueil');

// La fonction selLogements retourne le détail des informations de chaque logement à afficher
//             ----------------

/*$logements = selToutLogements();*/
$logements = selLogements($liste, $datdeb, $datfin);

// Mise en forme des informations générales supplémentaires à afficher

if  ( !$datdeb || !$datfin ) {

	$intitule = 'Tous les logements de la Résidence des Ondines';
	$infodate = '(date%20non%20précisée)';
	$liendate = 'Saisir vos dates';

} else {

	$intitule = 'Logements disponibles à la Résidence des Ondines ';
	$intitule .= ' pour la période <br> du <span> ' . $resadeb->format('d/m/Y') .	' </span> au <span> '.	$resafin->format('d/m/Y') . '</span>';

	$infodate = 'du ' . $resadeb->format('d/m/Y') .	' au '.	$resafin->format('d/m/Y');
	$liendate = 'Modifier ces dates';

}

// Affichage page Accueil
include 'vues/accueil.phtml.php';
?>