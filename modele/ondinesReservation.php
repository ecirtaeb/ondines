<?php

function recupCalendrier($ical) {

	$icalendrier = file_get_contents($ical);
	preg_match_all("/\bSUMMARY:(.*)\b/i", $icalendrier, $infosTab, PREG_PATTERN_ORDER);
/*	preg_match_all("/\bDESCRIPTION:(.*)\b/i", $icalendrier, $tarifTableau, PREG_PATTERN_ORDER);*/
	preg_match_all("/\bDTSTART;VALUE=DATE:(.*)\b/i", $icalendrier, $dateDebutTab, PREG_PATTERN_ORDER);
	preg_match_all("/\bDTEND;VALUE=DATE:(.*)\b/i", $icalendrier, $dateFinTab, PREG_PATTERN_ORDER);

	$calendrier=[];
	$ical = 0;

	/* Le calendrier récupéré est issus de la concaténation (en dehors de ce site) de plusieurs calendriers ical, les séjours ne sont donc pas chronologiques, il faut les trier par date de début */

	$datdeb = $dateDebutTab[1];   // on récupère les données date de début et fin d'évènement
	$datfin = $dateFinTab[1];	
	asort($datdeb); 					// tri par date de début en conservant les indices
	$infos = $infosTab[1];   		// on récupère les données date de début et fin d'évènement

	foreach ($datdeb as $i => $deb) {

		// les réservations provisoires ne sont pas considérées comme des réservations
		// une période incluse dans la précédente est écartée également


		if ( (substr($infos[$i], 0, 10) != 'Provisoire') &&
			  ( $ical == 0  || ($ical > 0 && $datfin[$i] >  $calendrier[$ical-1]['datfin']) )	) {

			if ( $ical >> 0 && $calendrier[$ical-1]['datfin'] > $datfin[$i] ) {
		// si la période traitée chevauchent la précédente on modifie la date de fin de cette dernière
				$calendrier[$ical-1]['datfin'] = $datfin[$i];

			} else {

				$calendrier[] = array('datdeb' => $deb, 'datfin' => $datfin[$i]);
				$ical++;
			}
		}
	}

	return $calendrier;
}

function lireLienCalAppart($id,$annee) {

	$db = connexion();
	$select = 'SELECT 
					icalresa
					FROM calendrierdetail
					WHERE annee = ' .  $annee . ' and id_logement = "' . $id .'"';
					
	$data = [];
	$statement = $db->prepare($select);
	$statement->execute();
	$data = $statement->fetch(\PDO::FETCH_ASSOC);

	return $data['icalresa'];
}

function lireTousLesIcal($annee) {

	$db = connexion();
	$select = 'SELECT 
					id_logement, icalresa
					FROM calendrierdetail
					WHERE annee = ' . $annee;
					
	$data = [];
	$statement = $db->prepare($select);
	$statement->execute();
	$data = $statement->fetchALL(\PDO::FETCH_ASSOC);

	return $data;
}


/* fonction de mise en forme du calendrier pour l'affichage sur la page :
	en entrée $calendrier */
function mefCalendrier($calendrier) {

	$db = connexion();
	$select = "SELECT * FROM planning";
	$logements = [];
	$statement = $db->prepare($select);
	$statement->execute();
	$logements = $statement->fetchAll(\PDO::FETCH_ASSOC);

	return $logements;
}

// Fonction fusionCalendrier  

function fusionCalendrier($icals) {

	foreach ($icals as $ical) {
		
		$icalResa = recupCalendrier($ical['icalresa']);

		$resa[$ical['id_logement']] = $icalResa;

	}

	return $resa;

}

/* Fonction de recherche des logements disponibles pour la période demandée
*/
function rechercheLogementDispo(array $resas, $datdeb, $datfin) {

	$listOk = [];

	foreach ($resas as $id_logement => $resa) {

		$ko = false;
		$i = 0;

		do  {

			$resadeb = DateTime::createFromFormat('Ymd', $resa[$i]['datdeb']);
			$resafin = DateTime::createFromFormat('Ymd', $resa[$i]['datfin']);

			if ( 
					( $datdeb->format('Ymd') <= $resadeb->format('Ymd') && 
					  $datfin->format('Ymd') >  $resadeb->format('Ymd') )
				||

					( $datdeb->format('Ymd') <	$resafin->format('Ymd') &&		
					  $datfin->format('Ymd') >	$resadeb->format('Ymd') )
				) {

				$ko = true;
			}

			$i++;	

		} while ($i < count($resa) && !$ko);

		if ( !$ko ) {

			$listOk[]=$id_logement;

		}
	}

	sort($listOk);
	dbug($listOk);
	return $listOk;

}


function recupVignette($id) {
// Cette fonction retourne le chemin de la première photo vignette

	$db = connexion();
	$select = 'SELECT vignette1 
				FROM logement
                WHERE id = :id';
	
	$statement = $db->prepare($select);
	$statement->bindValue(':id', $id);
	$statement->execute();
	$vignette= $statement->fetch(\PDO::FETCH_ASSOC);

	return $vignette;
}

?>
