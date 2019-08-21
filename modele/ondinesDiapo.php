<?php

function lireDiapoCateg($nom) {

	$db = connexion();

	$select = 'SELECT CONCAT(d.urlDiapo,dd.nomphoto) as url, 
							dd.titre,
							dd.description 
					FROM diapo as d
					JOIN diapodetail as dd
					ON d.id = dd.id_diapo
					WHERE d.categorie = :idx2
					AND dd.actif = 1 
					ORDER BY rang';
 
	$statement = $db->prepare($select);
	$statement->bindValue(':idx2', $nom);
	$statement->execute();
	$diapo = $statement->fetchAll(\PDO::FETCH_ASSOC);

	return validerDiapo($diapo);

}

function lirediapoType($type) {

	$db = connexion();
	$categories = [];

	// Récupération catégories à afficher
	$select = 'SELECT diapo.id, categorie, urlDiapo, libelle
					FROM diapo
					JOIN categdiapo as cat
					ON diapo.categorie = cat.id
					WHERE type = :type
					AND cat.actif is TRUE';
 
	$statement = $db->prepare($select);
	$statement->bindValue(':type', $type);
	$statement->execute();
	$categories = $statement->fetchAll(\PDO::FETCH_ASSOC);

	$infoTourisme = [];

// Récupération détail de chaque catégorie

	foreach ($categories as $i => $categ) {

		$diapo = [];

		$select = 'SELECT CONCAT(:url,nomphoto) as url,
		 					titre,
							description				
						FROM diapodetail
               	WHERE id_diapo = :id
               	ORDER BY rang';
		
		$statement = $db->prepare($select);
		$statement->bindValue(':id', $categ['id']);
		$statement->bindValue(':url', $categ['urlDiapo']);
		$statement->execute();

		$diapo = $statement->fetchAll(\PDO::FETCH_ASSOC);

		$infoTourisme[$i] = array(
											'categ' => $categ['categorie'],
											'libelle' => $categ['libelle'],		
  											'photos' => validerDiapo($diapo)
  										);

		}

		return $infoTourisme;
}

function validerDiapo($diapo) {

		// on ne garde que les url valides

	$diapok = [];
	$iok = 0;
	foreach ($diapo as $i => $photo) {

		if ( file_exists($photo['url']) ) {

			if ( $photo['description'] && $photo['titre'] ) {

				$photo['legende'] = $photo['titre']." - ".$photo['description'];

			} else {

				$photo['legende'] = $photo['titre'];

			}

			$diapok[$iok] = $photo;
			$iok++;
		}
	}
	return $diapok;

}

?>