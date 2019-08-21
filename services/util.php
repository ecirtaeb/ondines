<?php 
session_start();

function dbug($info) {
	echo '<pre>';
	print_r ($info);
	echo '</pre>';
}


function initAccueil() {

//supprimer les dates de la Session et la liste des logements stockés

	if ( isset($_SESSION['datdeb']) ) {

	   $_SESSION['datdeb'] = null;
	}

	if ( isset($_SESSION['datfin']) ) {
	   		
	   $_SESSION['datfin'] = null;
	 }

	if ( isset($_SESSION['listOk']) ) {

	   $_SESSION['listok'] = null;
	}
}

function chargerClasse($classe) {

	require 'modele/' . $classe .'.php';
}

function nomdumois($m) {

	$mois = [];
 	$mois[1] = "JANVIER";
 	$mois[2] = "FEVRIER"; 
 	$mois[3] = "MARS"; 
 	$mois[4] = "AVRIL";
 	$mois[5] =  "MAI"; 
 	$mois[6] = "JUIN";
 	$mois[7] = "JUILLET"; 
 	$mois[8] = "AOUT";
 	$mois[9] = "SEPTEMBRE"; 
 	$mois[10] = "OCTOBRE";
 	$mois[11] = "NOVEMBRE";
 	$mois[12] = "DECEMBRE";

 	return($mois[$m]);
}

spl_autoload_register('chargerClasse'); 