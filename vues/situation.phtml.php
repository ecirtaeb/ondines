<?php include 'head.phtml.php'; ?>
	<link rel="stylesheet" type="text/css" href="vues/css/situation.css">	
</head>
<body>
	<header id="imgfond">
		<nav id="menu">
			<ul class="flex menu">
				<li>
					<a href="index.php">Accueil</a>
				</li>
				<li>
					<a href="index.php?page=situation" id="navSituation">Situation/Accès</a>
				</li>
				<li>
					<a href="index.php?page=tourisme" id="navTourisme">Activités/Tourisme</a>
				</li>
				<li>
					<a href="index.php?page=contact" id="navContact">Nous contacter</a>
				</li>
			</ul>
		</nav>
	</header>
	<main class="container">
		<h1>Nous situer : Damgan, la Résidence</h1>		
		<section id="localisation">
			<h2>Damgan : Bretagne Sud</h2>			
			<div class="flex">
				<section>
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1379586.6627324661!2d-3.7242594585944917!3d47.51902660201698!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x480ffc75685de5bb%3A0xf6a6acc568cd732!2sRue+des+Ondines%2C+56750+Damgan!5e0!3m2!1sfr!2sfr!4v1561712063636!5m2!1sfr!2sfr" allowfullscreen></iframe>
				</section>
				<aside>
					<p>Intégré au Parc Naturel Régional du Golfe du Morbihan, Damgan est une station balnéaire restée familiale.<br>
					La Grande Plage est la préférée des vacanciers, surveillée, exposée plein sud, dotée d'un terrain de beach volley, de clubs de voile avec manège et jeux pour enfants juste en face.
					<br>Les plages de Kervoyal sont plus sauvages avec un beau panorama sur la Presqu’île de Guérande. 	Une promenade cyclable et piétonne permet longer l'Océan de Kervoyal jusqu'au petit port de Pénerf.
					<br>Marché tous les samedis matin à Damgan, également les mardis marin en juillet et août ainsi qu'un marché artisanat nocturne les mercredis à partir de 18h00.
					</p>
					<a href="index.php?page=tourisme">Consultez notre page Activité/Tourisme.</a>
				</aside>
			</div>
		</section>
		<section id="acces" >
			<h2>Comment venir à Damgan</h2>
			<ul class="flex">
				<li>
					<h3>En train</h3>	
					<img src="vues/img/pictos/train.svg" class="picto" alt="picto train">				
					<p> Gare TGV Vannes </p>
				</li>
				<li>
					<h3>En avion</h3>
					<img src="vues/img/pictos/avion.svg" class="picto" alt="picto avion">
					<p> Aéroport Nantes Atlantique à 100 km</p>
					<p> Aéroport Lorient 80 km</p>
				</li>
				<li>
					<h3>En voiture</h3>
					<img src="vues/img/pictos/voiture.svg" class="picto voiture" alt="picto voiture">
					<p> Depuis :   <br>
						Paris - 5h <br>
						Rennes - 1h20 <br>
						Nantes - 1h10
					</p>
					<p>Parking privé et gratuit à la résidence</p>
				</li>
			</ul>                                       
		</section>
				<section id="infos">
			<h2>A proximité</h2>
			<table>
				<thead>					
				</thead>
				<tbody class="centre">
					<tr>
						<td><img src="vues/img/pictos/sun-umbrella.svg" class="picto" alt="picto plage"></td>
						<td>plage</td>
<!-- 					</tr>
					<tr> -->
						<td><img src="vues/img/pictos/sailing.svg" class="picto" alt="picto voitrer"></td> 
						<td>écoles de voile</td>
					</tr>
					<tr>
						<td><img src="vues/img/pictos/bicycle.svg" class="picto" alt="picto bicyclette"></td> 
						<td>piste cyclable</td>
<!-- 					</tr>
					<tr> -->
						<td><i class="fas fa-biking"></i></td> 
						<td>sentier de randonnée</td>
					</tr>
					<tr>
						<td><img src="vues/img/pictos/tennis-court.svg" class="picto" alt="picto tennis"></td> 
						<td>tennis</td>
<!-- 					</tr>
					<tr> -->
						<td><img src="vues/img/pictos/petanque.svg" class="picto" alt="picto petanque"></td> 
						<td>pétanque</td>
					</tr>
					<tr>
						<td><img src="vues/img/pictos/minigolf.svg" class="picto" alt="picto minigolf"></td> 
						<td>mini-golf</td>
<!-- 					</tr>
					<tr> -->
						<td><img src="vues/img/pictos/giraffe.svg" class="picto" alt="picto girafe"></td> 
						<td>parcs animalier et botanique</td>
					</tr>
					<tr>
						<td><img src="vues/img/pictos/shopping-cart.svg" class="picto" alt="picto commerce"></td> 
						<td>commerces à 1 500m</td>
<!-- 					</tr>
					<tr> -->
						<td><img src="vues/img/pictos/play-movie.svg" class="picto" alt="picto plage"></td> 
						<td>Cinéma</td>
					</tr>
					<tr>
						<td><img src="vues/img/pictos/sunset.svg" class="picto" alt="picto coucher de soleil"></td>
						<td>d'inoubliables couchers de soleil à la pointe de Penerf</td>
					</tr>
				</tbody>
			</table>
		</section>
		<section class="diaporama" id="ondines">
			<h2>La résidence et le voisinage</h2>
			<ul class="flex posrelative diapo" data-id="0">
				<?php foreach ($photosResidence as $i=>$photo) : ?>
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
	</main>
<?php include 'footer.phtml.php'; ?>
</body>
</html>
