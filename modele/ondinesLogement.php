<?php

function selLogements(array $liste, $resadeb, $resafin) {

	$db = connexion();

	$select = 'SELECT 
				lo.*, ty.libelle
				FROM logement as lo
				JOIN typelogement as ty
				ON lo.id_type_logement = ty.id';

	if (count($liste) > 0) {

		$listid = '';
		for ($i=0; $i < count($liste); $i++) { 
			
			$listid.= "'".$liste[$i]."'";
			if (!($i == count($liste)-1)) {
				$listid.=' ,';
			}
			
		}
		$select .= ' WHERE lo.id in ('. $listid . ')  ORDER by lo.id';

	} else {

		$select .= ' ORDER by lo.id';
	}


	$logements = [];
	$statement = $db->prepare($select);
	$statement->execute();
	$logements = $statement->fetchAll(\PDO::FETCH_ASSOC);

	// Ajout pour chaque logement du tarif minimum ( ou du tarif du séjour si période demandée) et des photos

	foreach ($logements as $key => $logement) {

		if ( $resadeb && $resafin ) {

			$logements[$key]['tarif'] = calculTarifSejour($logement['id'],DateTime::createFromFormat('d-m-Y', $resadeb), DateTime::createFromFormat('d-m-Y', $resafin));

		} else {

			$logements[$key]['tarifmin'] = recupTarifMin($logement['id']);
		}
		
	}

	return $logements;
}

function selLogementParId($id) {

	$db = connexion();
	$infoLogement = [];

	// Récupération informations générales du logement
	$select = 'SELECT *
					FROM logement as l
					JOIN typelogement as t
					ON l.id_type_logement = t.id
               where l.id = :id';

	$statement = $db->prepare($select);
	$statement->bindValue(':id', $id);
	$statement->execute();
	$infoLogement['infos'] = $statement->fetch(\PDO::FETCH_ASSOC);

	// Récupération informations détaillées du logement
	$select = 'SELECT *
					FROM logementdetail
               WHERE id_logement = :id
               ORDER BY rang';
	
   $info = [];
	$statement = $db->prepare($select);
	$statement->bindValue(':id', $id);
	$statement->execute();
	$infoLogement['detail'] = $statement->fetchAll(\PDO::FETCH_ASSOC);

	return $infoLogement;
}

function recupTarif($id) {
// Cette fonction retourne, pour le logement demandé, les différents tarifs appliqués

	$db = connexion();
	$select = 'SELECT t.id_periode, p.libelle, t.tarif_jour, t.tarif_semaine,(t.tarif_vs*2) as tarif_vs
					FROM tarif as t
					JOIN periode as p
					ON t.id_periode = p.id
                    where t.id_logement = :id GROUP BY t.id_periode';
	$infoTarif = [];

	$statement = $db->prepare($select);
	$statement->bindValue(':id', $id);
	$statement->execute();
	$infoTarif = $statement->fetchAll(\PDO::FETCH_ASSOC);

	return $infoTarif;
}

function recupTarifMin($id) {
// Cette fonction retourne le tarif minimum d'une semaine pour un logement

	$db = connexion();
	$select = 'SELECT min(t.tarif_semaine) as tarifmin
				FROM tarif as t
                WHERE t.id_logement = :id';
	
	$statement = $db->prepare($select);
	$statement->bindValue(':id', $id);
	$statement->execute();
	$infoTarif= $statement->fetch(\PDO::FETCH_ASSOC);

	if (!isset($infoTarif['tarifmin'])) { 
		$infoTarif['tarifmin'] = ""; 	// si l'info n'est pas en base rien ne sera affiché
	}
	return $infoTarif['tarifmin'];
}

function recupPeriode() {

// Cette fonction retourne la liste des périodes tarifaires avec leurs dates
	$db = connexion();
	$select = 'SELECT id, libelle FROM periode';

	$periodes = [];

	$statement = $db->prepare($select);
	$statement->execute();
	$periodes = $statement->fetchAll(\PDO::FETCH_ASSOC);

	foreach ($periodes as $id => $periode) {

		$select = 'SELECT date_format(datedebut,"%d/%m/%Y") as datedebut,  
						  date_format(datefin,"%d/%m/%Y") as datefin
					FROM dateperiode
                    where id_periode = "' . $periode['id'] .'"';
		
		$datperiodes = [];


		$statement = $db->prepare($select);
		$statement->execute();
		$datperiodes = $statement->fetchAll(\PDO::FETCH_ASSOC);

		$periodes[$id]['date'] = $datperiodes;
	
	}

	return $periodes;

}

function calculTarifSejour($id, DateTime $deb, DateTime $fin) {
//Cette fonction retourne le prix du logement demandé pour la période demandée

	$db = connexion();

	// On récupère d'abord la(les) périodes tarifaires couvertes par le séjour demandé
	// ($deb = début séjour et $fin = fin du séjour)

   $select = 'SELECT t.id_periode, 
   						date_format(dp.datedebut,"%d%m%Y") as datedebut, 
   						date_format(dp.datefin,"%d%m%Y") as datefin,
    						t.tarif_jour, t.tarif_semaine, t.tarif_vs
					FROM dateperiode as dp
					JOIN tarif as t
					ON t.id_periode = dp.id_periode
                    where  t.id_logement = :id
                    AND (
	                    		(dp.datedebut <= :deb AND dp.datefin > :deb)
                        OR	(dp.datedebut <= :fin AND dp.datefin > :fin)
                        OR (dp.datedebut >= :deb AND dp.datedebut < :fin)
                        OR (dp.datefin > :deb AND dp.datefin < :fin)
                    		)
               ORDER BY dp.datedebut';



	$tarifSejour = [];

	$statement = $db->prepare($select);
	$statement->bindValue(':id', $id);
	$statement->bindValue(':deb', DATE_FORMAT($deb,"Ymd"));
	$statement->bindValue(':fin', DATE_FORMAT($fin,"Ymd"));
	$statement->execute();
	$tarifSejour = $statement->fetchAll(\PDO::FETCH_ASSOC);

	/*   Calcul du prix du séjour en fonction des dates demandées */
	if ( $tarifSejour == FALSE ) {

		return 9999;

	} else {
		
		$prixSejour = 0;
		$iper = 0; // indice pour parcourir les périodes tarifaires

		$trtdate = clone $deb;
		
		$datfintarif = DateTime::createFromFormat('dmY', $tarifSejour[$iper]['datefin']);

		// On parcourt la période demandée, et pour chaque jour on récupère le tarif journalier qui est cumulé dans la variable $prixSejour

		while ( $trtdate->format('Ymd') < $fin->format('Ymd') ) {
					
			if ( $trtdate->format('Ymd') > $datfintarif->format('Ymd') ) {

				$iper++;// période suivante
				$datfintarif = DateTime::createFromFormat('Ymd', $tarifSejour[$iper]['datefin']);
			}

			if ( $trtdate->format('D') == 'Fri' ) {
		// si vendredi le tarif vs (vendredi samedi) s'applique
				$prixSejour += $tarifSejour[$iper]['tarif_vs'];
				$trtdate = $trtdate->modify('+ 1 day'); // jour suivant

			} else if ( $trtdate->format('D') != 'Sat' )  {
		// si pas samedi le tarif jour s'applique
				$prixSejour += $tarifSejour[$iper]['tarif_jour'];
				$trtdate = $trtdate->modify('+ 1 day'); // jour suivant

			} else {  // c'est un samedi
		// si le séjour ne se termine pas avant le samedi suivant on applique le tarif semaine,
		// puis on se positionne 7 jours plus loin
			 	$dateplus7j = clone $trtdate;
			 	$dateplus7j = $dateplus7j->modify('+ 7 day');
		 		
		 		if ( $dateplus7j->format('Ymd') <= $fin->format('Ymd') ) {

		 			$prixSejour += $tarifSejour[$iper]['tarif_semaine'];
		 			$trtdate = $trtdate->modify('+ 7 day');

		 		} else {

		 // on applique le tarif vs (vendredi samedi)
		 			$prixSejour += $tarifSejour[$iper]['tarif_vs'];
		 			$trtdate = $trtdate->modify('+ 1 day');
		 		}

			}

		} 

		return number_format($prixSejour, 0, ',', ' ');
	}
}

?>