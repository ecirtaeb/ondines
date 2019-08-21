<?php 
include_once 'services/util.php'; // utilitaires
include_once 'modele/ondinesConnexion.php'; // connexion bdd
include_once 'modele/ondinesReservation.php'; // lecture infos réservations
include_once 'modele/ondinesLogement.php'; // lecture info logements

//==================================================================================
// Appelé suite à une demande de recherche de disponibilité pour une période saisie
// via une requête AJAX
//==================================================================================


//                  ------------------------------
// >>>>>>>>>>>>>>>  Contrôle des données à traiter <<<<<<<<<<<<<<<<<<<
//                  ------------------------------

$date = new DateTime();

// Contrôle que la date de début est renseignée

if ( !empty($_GET['datdeb'])) {

	$datdeb = DateTime::createFromFormat('d-m-Y', $_GET['datdeb']);
	$_SESSION['datdeb']=$_GET['datdeb']; // sauvegarde en Session date saisie

} else {

	print_r('error110');
	exit;	

}

// Contrôle que la date de fin est renseignée

if ( !empty($_GET['datfin'])) {

	$datfin = DateTime::createFromFormat('d-m-Y', $_GET['datfin']);
	$_SESSION['datfin']=$_GET['datfin']; // sauvegarde en Session date saisie	

} else {

	print_r('error110');
	exit;

}

// Contrôle cohérence des dates de la période demandée

if ( !($datdeb < $datfin) ) {

	print_r('error120');
	exit;
}

// Contrôle période demandée de samedi à samedi du 20 juillet et août
// (à terme ces dates seront enregistrées en base de donnée)

if ( (
			( ($datdeb->format('m') == "07" && $datdeb->format('DD') >= 20)
			   || $datdeb->format('m') == "08" ) &&
			($datdeb->format('D') != 'Sat')
		) 
			||
		(
			( ($datfin->format('m') == "07" && $datfin->format('DD') >= 20)
			 || $datfin->format('m') == "08" ) &&
			($datfin->format('D') != 'Sat')
		)
	)
{

	print_r('error130');
	exit;
}


// Contrôle période demandée supérieure à 2 jours

if ( ($datdeb->diff($datfin)->format('%a') < 2) ) {

	print_r('error140');
	exit;
}


// Contrôle période demandée supérieure à 28 jours

if ( ($datdeb->diff($datfin)->format('%a') > 28) ) {

	print_r('error150');
	exit;
}

//                  --------------------------------               
// >>>>>>>>>>>>>>>  Collecte des informations utiles  <<<<<<<<<<<<<<<<<<<
//                  --------------------------------

// La fonction "lireTousLesIcal" va lire en bdd le nom des planning de réservation (fichier .ics) 
//  
$lienscal = lireTousLesIcal($date->format('Y'));   // un lien récupéré par logement


// La fonction "fusionCalendrier" retourne sous forme de tableau et par logement tous les périodes réservées
//  
$resa = fusionCalendrier($lienscal);

// La fonction "rechercheLogementDispo" retourne la liste des logements disponibles pour la période demandée 

$listOk = rechercheLogementDispo($resa, $datdeb, $datfin);


//                -------------------------------------------------------------------
// >>>>>>>>>>>>>> Mise en forme des informations générales supplémentaires à afficher <<<<<<<<<<<<<<
//                -------------------------------------------------------------------

if ( count($listOk) > 0 ) {

	$_SESSION['listOk']=$listOk; // sauvegarde de la liste des logements selon critères dates
	
// La fonction "selLogements" retourne le détail des informations pour chaque logement
//           
	$logements = selLogements($listOk,$_SESSION['datdeb'],$_SESSION['datfin']);

	$intitule = 'Disponibilités';

} else {

   $intitule = 'Nous n\'avons plus de disponibilité';
	$logements = [];
}

$intitule .= ' pour la période <br> du <span> ' . $datdeb->format('d/m/Y') .	' </span> au <span> '.	$datfin->format('d/m/Y') . '</span>';

$infodate = '%20pour%20la%20période%20du%20' . $datdeb->format('d/m/Y') .	'%20au%20'.	$datfin->format('d/m/Y');
$liendate = 'Modifier vos dates';

if ( isset($_SESSION['datdeb']) && isset($_SESSION['datfin'])) {

	$datdebsaisie = $_SESSION['datdeb'];
	$datfinsaisie = $_SESSION['datfin'];
}


include 'vues/listeLogements.phtml.php';
 
 ?>