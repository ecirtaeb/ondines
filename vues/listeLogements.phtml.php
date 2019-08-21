<?php print_r('<h2>'.$intitule.'</h2>'); ?>	
<?php print_r('<a id="gotodate" class="lien" href="#du">'.$liendate.'</a>');?>
<a href="#" class="btnrazdat lien hidden">Effacer les dates</a>
<table>
	<?php if ( !empty($logements) ) : ?>
		<thead>
<!-- 			<tr class="flextablogement">
				<th>Capacité</th>
				<?php if (isset($datdeb)) {

					print_r('<th colspan=3>Description</th>');
					print_r('<th>Prix du séjour '.$infodate.'</th>');

				} else {

					print_r('<th colspan=4>Description</th>');
				}
				?>								
				<th><i class="fa fa-envelope" aria-hidden="true"></i></th>
			</tr> -->
		</thead>
	<?php endif; ?>
	<tbody>
		<?php foreach ($logements as $logement) : ?>
			<?php $href='"index.php?page=fiche&id='.$logement['id'].'"' ?>
			<tr class="flextablogement" data-id=<?=$logement['id']?>>
				<td class="detail pointer none1" data-href=<?=$href?>>
					<?php
						$capacite = $logement['capacite'];
						$libcapacite ="";
						if ($capacite < 2) {
							for ($i=0; $i < $capacite; $i++) { 
								$libcapacite .= '<i class="fas fa-user"></i>';
							}
						} else {
							$libcapacite = ' <i class="fas fa-user"></i> '.$capacite;
						} 
					?>
					<p><?=$libcapacite?></p>
				</td>
				<td class="detail pointer" data-href=<?=$href?>>
					<ul class="alignegauche liendetail" data-id=<?=$logement['id']?> >
						<li class="titre"><?=$logement['libelle']." ".$logement['id']?></li>
						<li class="none3"><?=$libcapacite?></li>
             		<li><?=$logement['commentaire']?></li>								
						<li>Surface utile <?=$logement['surface_utile']?> m²</li>
						<li class="pictos">
							<?php
								$nblit = $logement['nblit2'];
								$liblit ="";									
								if ($nblit > 0) {
									for ($i=0; $i < $nblit; $i++) { 
										$liblit.= '<img src="vues/img/pictos/litdouble.svg" class="picto lit2" alt="picto lit double">';
									}
								} 									
								$nblit = $logement['nblit1'];

								if ($nblit > 0) {
									for ($i=0; $i < $nblit; $i++) { 
										$liblit.= '<img src="vues/img/pictos/litsimple.svg" class="picto" alt="picto lit simple">';
									}
								}
								print_r($liblit);
							?>
							<img src="vues/img/pictos/wifilight.svg" class="picto" alt="picto wifi">
							<img src="vues/img/pictos/parkinglight.svg" class="picto" alt="picto parking">
						</li>
					</ul>
				</td>
				<td class="detail pointer none1" data-href=<?=$href?>>
					<img src=<?='"'.$logement['vignette1'].'"'?>  alt="vignette"/>
				</td>
				<td class="detail pointer none2" data-href=<?='"index.php?page=fiche&id='.$logement['id'].'"'?>>
					<img src=<?='"'.$logement['vignette2'].'"'?>  alt="vignette"/>
				</td>
				<td class="pointer">
					<ul class="flex-colonne" data-id=<?=$logement['id']?>>
						<?php if ( isset($logement['tarifmin'])) : ?>
							<li class="tarif detail pointer" data-href=<?=$href?>>
								<p>La semaine à partir de </p>
								<p><span><?=$logement['tarifmin']?> €</span></p>
							</li>
						<?php endif; ?>	
						<?php if ( isset($logement['tarif'])) : ?>									
							<li class="tarif detail pointer" data-href=<?=$href?>>
								<p class="prix centre"><?=$logement['tarif'].' €'?></p>
								<p class='noir centre'><?=$infodate?></p>
								<p class="minus noir centre">Hors charges <br> (eau et électricité)</p>
							</li>
						<?php endif; ?>
						<?php if ( !isset($logement['tarif'])) : ?>									
							<li class="dispo alien" data-href=<?='"index.php?page=dispo&id='.$logement['id'].'&src='.$logement['vignette1'].'"'?>>Disponibilités</li>
						<?php endif; ?>
					</ul>
				</td>
				<td class="resa lien pointer none1" data-id=<?=$logement['id']?>>
					<a class="lien" href=<?='"mailto:?to=beatrice@activimage.net&subject=Demande%20de%20réservation%20du%20logement%20'.$logement['id'].'%20'.$infodate.'&body=message%20:........%0D%0ANom%20:......%0D%0ANombre%20de%20personnes%20:%20.........."'?>>Demande
					</a>
				</td>
			</tr>							 		
		<?php endforeach; ?>
	</tbody>
</table>
