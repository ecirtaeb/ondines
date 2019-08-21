<?php

class classPlanning {

	private $annee;
	private $logement;
	private $tabmois;

	public function __construct(datetime $date, $logement, array $reservation) // 
  {
    
    $this->annee = $date->format('Y');
    $this->logement = $logement;
    $this->initTabmois($date, $reservation);

  }

  public function initTabmois(datetime $date, array $reservation) {

  /* alimenter 12 mois en commençant par le mois en cours */

 	$trtdate = clone $date;
 	$trtdate->modify('first day of this month'); // date de départ : premier jour du mois en cours
 	$semaine = [6 , 0 , 1 , 2 , 3 , 4 , 5];

	$lendemain = clone $trtdate;
 	$lendemain = $lendemain->modify('+ 1 day');

 	$iresa = 0;	// pour parcourir les périodes occupées
 	$iresamax = count($reservation)-1;

 	$finresaprec = DateTime::createFromFormat('Ymd', '20000101');

 	// on se positionne sur la première date occupée supérieure à la date de début du planning à constituer
 	//==> à mettre dans une fonction

	$resadeb = DateTime::createFromFormat('Ymd', $reservation[$iresa]['datdeb']);
	$resafin = DateTime::createFromFormat('Ymd', $reservation[$iresa]['datfin']);	 	
	while ( $trtdate->format('Ymd') > $resafin->format('Ymd') && $iresa < $iresamax ) {
				
		$iresa++;
		$resadeb = DateTime::createFromFormat('Ymd', $reservation[$iresa]['datdeb']);
		$resafin = DateTime::createFromFormat('Ymd', $reservation[$iresa]['datfin']);

	} 

 	for ($m=0; $m <= 11 ; $m++) {  // on charge 12 mois

		// on remplit 6 lignes de 7 jours par mois dans cet ordre S D L M M J V
		// 	1 - initialiser le mois 
 		//	2 - on cale le 1er jour en fonction du jour de la semaine
		// 	3 - puis on remplit les jours du mois
		//  4 - on complète les dernières occurences (on veut 6 X 7 = 42 occurences)

		$dernierjour = clone $trtdate;
		$dernierjour->modify('last day of this month');

		$im = nomdumois($dernierjour->format('n'))." ".$dernierjour->format('Y');
		$vide = ['info' => '', 'jour' => ''];

		$jmois = [];
		$douzmois[$m] = array('mois' => $im,				// Initialisation de l'occurence du mois en cours
  							'jmois' => $jmois);

		$ijour = 0;
		$demainbusy = false;		// pour repérer les débuts et fins 
		$veillebusy = true;		// de période d'occupation pour mise en forme style

		while ( $trtdate->format('w') != $semaine[$ijour]  && $ijour < 7) {
			
			$jmois[$ijour] = $vide;  // jour hors mois en cours
			$ijour++;
		}

		while ( $trtdate->format('Ymd') <= $dernierjour->format('Ymd')  ) { 

			$occupe =	$trtdate->format('Ymd') >= $resadeb->format('Ymd') && 
						$trtdate->format('Ymd') <= $resafin->format('Ymd');

			$trtj	=	$trtdate->format('j'); // jour du mois en cours de traitement

  			if ( $occupe ) {

				$demainbusy = true;

  				// s'il s'agit du dernier jour d'une résa , on récupère la suivante s'il y en a 
				if ( $trtdate->format('Ymd') == $resafin->format('Ymd') ) {

					if ($iresa < $iresamax ) {

						$finresaprec = clone $resafin;
						$iresa++; 		
						$resadeb = DateTime::createFromFormat('Ymd', $reservation[$iresa]['datdeb']);
						$resafin = DateTime::createFromFormat('Ymd', $reservation[$iresa]['datfin']);

						// si la resa suivante ne démarre pas le dernier jour de la résa en cours ni le jour suivant, le jour en cours est libre l'après-midi
						if ( $resadeb->format('Ymd') != $trtdate->format('Ymd')  ) {
							$demainbusy = false;
						}
					} else {

						//  la résa en cours est la dernière, le lendemain du jour en cours est libre
							$demainbusy = false;
						 
					}
				}

				// s'il s'agit du premier jour d'une résa mais pas le dernier jour de la résa précédente,
				// la veille du jour en cours n'est pas occupée  
				if ( $trtdate->format('Ymd') == $resadeb->format('Ymd') )
 
					 if ($trtdate->format('Ymd') != $finresaprec->format('Ymd') ) {
					
							$veillebusy = false;

					 } else {

							$veillebusy = true;
	
				} 

				if ( !$veillebusy ) { 

	   			$jmois[$ijour] = array('jour' => $trtj,
	  								'info' => "busyPM");	// occupé l'après-midi
	  				$veillebusy = true;

   			} else {

   				if ( !$demainbusy ) {	//* lendemain libre 

					$jmois[$ijour] = array('jour' => $trtj,
		  								'info' => "busyAM");	// occupé le matin
					} else {

						$jmois[$ijour] = array('jour' => $trtj,
		  								'info' => "busy");	// occupé toute la journée 

					}

   			} 
		  				  								
  			} else {

  				$jmois[$ijour] = array('jour' => $trtj,
  												'info' => "free");		// libre

  				$veillebusy = false;
  			}


  			$trtdate = $trtdate->modify('+ 1 day'); // jour suivant
  			$lendemain = $lendemain->modify('+ 1 day');
  			$ijour++;

	  	}

	  	for (  ; $ijour < 42 ; $ijour++) {
			
			$jmois[$ijour] = $vide;  // jour hors mois en cours

		}

		$douzmois[$m]['jmois'] = $jmois;				// chargement des jours du mois en cours
	  	
  	}
  	$this->tabmois = $douzmois;
  }

  public function lirePlanning() {

  	return($this->tabmois);
  }

// Cette fonction vérifie la disponiblité d'un logement pour une période demandée
// retourne vrai ou faux
// non implémentée pour le moment
  public function verifDispo(datetime $datedebut, datetime $datefin, array $reservation) {

//

  }
}
