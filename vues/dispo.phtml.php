<?php include 'head.phtml.php'; ?>
	<link rel="stylesheet" type="text/css" href="vues/css/dispo.css">	
</head>
<body>
	<header id="imgfond">
		<nav id="menu">
			<ul class="flex">
				<li>
					<a href="index.php?page=accueil" id="finfiche" class="pointer"><i class="fa fa-arrow-left" aria-hidden="true"></i> Retour page accueil</a>
				</li>
				<li>
					<a href=<?='"index.php?page=fiche&id='.$id.'"'?> class="pointer"><i class="fa fa-info" aria-hidden="true"></i>  Détail logement</a>
				</li>
				<li>
					<a href=<?='"mailto:?to=beatrice@activimage.net&subject=Demande%20de%20réservation%20du%20logement%20'.$id.'%20(Dates%20non%20précisées&body=VOTRE%20MESSAGE%20:%20"'?>><i class="fa fa-envelope" aria-hidden="true"></i>  Demande d'information
					</a>
				</li>
			</ul>
		</nav>
		<img src=<?='"' . $src . '"'?> class="mini" alt="vignette">
	</header>
	<main class="container">
		<div id="titre1" class="flex dispo">
			<a class="dispo pointer flex1" href=<?='"routeur.php?page=dispo&id='.$idprec.'&src='.$src.'"'?>>&lt;</a>
			<h1 class="flex4">Planning des disponibilités du logement <?php print_r($id)?></h1>
			<a class="dispo pointer flex1" href=<?='"routeur.php?page=dispo&id='.$idsuiv.'&src='.$src.'"'?>>&gt;</a>
		</div>
		<div class="flex">
			<div id="dispologement" class="blocinfo container">
				<section class="container-dispo flex">
					<?php foreach ($planningDispo as $im => $mois) : ?>
						<table class="tabplanning">
							<thead>
								<tr><th colspan="7"><?=$mois['mois']?></th></tr>
							</thead>
							<tbody>
								<tr>
									<td>Sam</td>
									<td>Dim</td>
									<td>Lun</td>
									<td>Mar</td>
									<td>Mer</td>
									<td>Jeu</td>
									<td>Ven</td>
								</tr>
								<?php foreach ($mois['jmois'] as $ijour => $jour) : ?>

									<?php if ( in_array($ijour, [0, 7, 14, 21, 28, 35, 42]) ):  ?>
										<tr>
									<?php endif; ?>

									<td class="<?=$jour['info']?>"><?=$jour['jour']?></td>

									<?php if ( in_array($ijour, [6, 13, 20, 27, 34]) ) : ?>
										</tr>
									<?php endif; ?>

								<?php endforeach; ?>
								</tr>	
							</tbody>				
						</table>
					<?php endforeach; ?>
				</section>
			</div>			
		</div>
	</main>
	<?php include 'footermini.phtml.php';?>
	</body>
</html>