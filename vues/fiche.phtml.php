<?php include 'head.phtml.php'; ?>
	<link rel="stylesheet" type="text/css" href="vues/css/fiche.css">	
</head>
<body>
	<header id="imgfond">
		<nav id="menu">
			<ul class="flex">
				<li>
					<a href="index.php?page=accueil" id="finfiche" class="pointer"><i class="fa fa-arrow-left picto" aria-hidden="true"></i> Retour page d'accueil</a>
				</li>
				<li id="liendispo">
					<a class="dispo pointer" href=<?='"index.php?page=dispo&id='.$id.'"'?>><img src="vues/img/pictos/calendar-page-with-many-squares.svg" class="picto" alt="picto planning"/><p>Disponibilité du logement</p></a>
				</li>
				<li>
					<a href=<?='"mailto:?to=beatrice@activimage.net&subject=Demande%20d\'information%20pour%20le%20logement%20'.$id.'%20(Dates%20non%20précisées&body=votre%20message%20:"'?>><i class="fa fa-envelope picto" aria-hidden="true"></i> Demande d'information
					</a>
				</li>
			</ul>
		</nav>
	</header>
	<main class="container">
		<div id="titre1" class="flex">
			<?php if ( $id != $idsuiv ) : ?>  <!-- pas de flèche suivant si 1 seul logement disponible -->
				<a class="fiche pointer flex1" href=<?='"routeur.php?page=fiche&id='.$idprec.'"'?>>&lt;</a>
			<?php endif; ?>
			<h2 class="fiche flex4">Descriptif <?=$fichelogement['infos']['libelle']." ".$id?> </h2>
			<?php if ( $id != $idsuiv ) : ?>  <!-- pas de flèche suivant si 1 seul logement disponible -->			
				<a class="fiche pointer flex1" href=<?='"routeur.php?page=fiche&id='.$idsuiv.'"'?>>&gt;</a>
			<?php endif; ?>
		</div>
		<?php if ( isset($datdeb) ) : ?>
			<p><span id="prix"><?=$prix?> €</span> pour la période du <?=$datdeb?> au <?=$datfin?></p>
		<?php endif; ?>	
		<section id="fichelogement">
			<div id="titre2">
					<!-- Affichage description -->
				<p><?=$fichelogement['infos']['commentaire']?></p>
				<a href="#detail" class="lien">Détails ci-dessous</a>
			</div>		
			<!--  DIAPORAMA  -->
			<section class="diaporama">
				<ul class="flex posrelative diapo" data-id="0">
					<?php foreach ($photosFiche as $i => $photo) : ?>
						<?php if ($i == 0) : ?>
							<li class="grandformat posrelative">
								<button type="submit" class="diapoprec pointer"> &lt; </button>
								<img src=<?='"'.$photo['url'].'"'?> alt="photo location">
								<button type="submit" class="diaposuiv pointer"> &gt; </button>                         
								<p class="legende"><?=$photo['legende']?></p>
							</li>
						<?php endif; ?>
						<li class="petitformat" data-id=<?='"'.$i.'"'?>>
							<img src=<?='"'.$photo['url'].'"'?> alt="photo location">
							<p class="hidden legende"><?=$photo['legende']?></p>
						</li>                   
					<?php endforeach; ?>
				</ul>
			</section>
			<section id="detail">
				<div class="flex">

					<?php foreach ($fichelogement['detail']  as $infodetail) : ?>						
					<!-- Affichage de la liste des informations -->
					<div class="info flex">
						<ul class="alignegauche">
							<li><?=$infodetail['id_type_desc']?></li> 
							<?php $infos = explode(";" , $infodetail['infos']); ?>
							<?php foreach ($infos as $info) : ?>
								<li>									
									<p><i class="fa fa-check" aria-hidden="true"></i><?=' '.$info?></p>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>					
					<?php endforeach; ?>
				</div>	

			</section>
		</section>

				<!-- Affichage des tarifs et des périodes-->
		<section class="container-tarif flex">

			<table id="tabtarif">
				<thead>
					<tr>
						<th colspan="4">TARIFS (en €uros) </th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Période</td>						
						<td>Nuit <br>(2 nuits<br>minimum)</td>
						<td>Semaine</td>
						<td>Week-end <br>(vendredi et samedi)</td>
					</tr>
					
					<?php foreach ($fichetarif as $tarif) : ?>
						<tr>
							<td class="alignegauche"><?=$tarif['libelle'].'<span class="purple"> ('.$tarif['id_periode'].')</span>'?></td>
							<td><?=$tarif['tarif_jour']?></td>
							<td><?=$tarif['tarif_semaine']?></td>
							<td><?=$tarif['tarif_vs']?></td>
						</tr>
					<?php endforeach; ?>

				</tbody>				
			</table>

			<section id="tabperiode">
				<ul>
					<?php foreach ($ficheperiode as $periode) : ?>
						<li class="alignegauche">
							<?php 
								$texte = '<span class="purple"> ('.$periode['id'].')  </span>';
								foreach ($periode['date'] as $i=>$date) {
									
									$texte.= ($i > 0) ? '   et   ' : '';
									$texte.= " du ".$date['datedebut']." au ".$date['datefin'];
								}
								print_r('<p>'.$texte.'</p>');
							?>
						</li>
					<?php endforeach; ?>
				</ul>				
			</section>

			<section id="remarques">

				<h4>Remarques</h4>
				<p>Les prix sont indiqués hors charges (eau et électricité)</p>
<!-- 				<p><i class="fa fa-paw" aria-hidden="true"></i>Les animaux sont admis sous conditions (nous contacter)</p> -->
				<p>Le linge de maison n'est pas fourni</p>
				
			</section>

		</section>

	</main>

	<?php include 'footermini.phtml.php';?>	
		<script src="vues/js/fiche.js" ></script>

	</body>
</html>