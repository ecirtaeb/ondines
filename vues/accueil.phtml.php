<?php include_once 'head.phtml.php'; ?>
	<link rel="stylesheet" type="text/css" href="vues/css/accueil.css">		
</head>
<body>
	<header id="imgfond">
		<div>
			<nav id="menu">
				<ul class="flex">
					<li class="posrelative">
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
			<h1 class="bold">Résidence Les Ondines</h1>
			<h2>à 250 mètres de la plage</h2>
			<form method="GET" class="flex" id="recherche" action="rechercheDispo.php">
				<fieldset>
					<label for="du">du : </label>
					<input type="text" id="du" name="datdeb" class="du" <?php if(isset($datdeb)) { print_r('value="'.$datdeb.'"'); } ?> autocomplete="off">
				</fieldset>
				<fieldset>
					<label for="au">au : </label>
					<input type="text" id="au" name="datfin" class="au" <?php if(isset($datfin)) { print_r('value="'.$datfin.'"'); } ?> autocomplete="off">				
				</fieldset>
				<button type="button">Recherche disponibilités pour cette période</button>
			</form>
			<h3 id="icimsg"> </h3>
			<a href="#" class="hidden btnrazdat lien">Effacer les dates</a>
		</div>
	</header>
<main class="container" >
	<div>
		<div class="flex" id="main1">
			<section class="diaporama">
				<ul class="flex posrelative diapo">
					<!-- Uniquement 10 photos de visibles en même temps -->
					<?php for ($i=0 ; $i < 10 && $i < count($listePhotos) ; $i++) : ?> 
						<?php if ($i == 0) : ?>
							<li class="grandformat posrelative">
								<button type="submit" class="diapoprec pointer"> &lt; </button>
								<img src=<?='"'.$listePhotos[$i]['url'].'"'?> alt="photo location">
								<button type="submit" class="diaposuiv pointer"> &gt; </button>                         
								<p class="legende"><?=$listePhotos[$i]['legende']?></p>
							</li>
						<?php endif; ?>
						<li class="petitformat" data-id=<?='"'.$i.'"'?>>
							<img src= <?='"'.$listePhotos[$i]['url'].'"'?> alt="photo location">
							<p class="hidden legende"><?=$listePhotos[$i]['legende']?></p>
						</li>                   
					<?php endfor; ?>
					<!-- Les autres photos s'il en reste  sont cachées -->
					<?php for ($i ; $i < count($listePhotos) ; $i++) : ?>
						<li class="petitformat hidden" data-id=<?='"'.$i.'"'?>>
							<img src= <?='"'.$listePhotos[$i]['url'].'"'?> alt="photo location">
							<p class="legende"><?=$listePhotos[$i]['legende']?></p>
						</li>                   
					<?php endfor; ?>       
				</ul>
			</section>
			<aside class="flex">
				<section id="localisation" class="flex1">
					<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d689793.3787226885!2d-2.603654!3d47.519023!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x480ffc75685de5bb%3A0xf6a6acc568cd732!2sRue+des+Ondines%2C+56750+Damgan!5e0!3m2!1sfr!2sfr!4v1558798680595!5m2!1sfr!2sfr"  allowfullscreen>
					</iframe>
				</section>
				<section id="presentation" >
					<ul class="flex">
						<li>
							<img src="vues/img/pictos/plage.svg" class="picto" alt="picto plage">
							<p> à 250 mètres de la plage </p>
						</li>
						<li>
							<img src="vues/img/pictos/ville.svg" class="picto" alt="picto ville">
							<p> 25 km de Vannes <br>
								47 km d'Auray 
							</p>
						</li>
						<li>
							<img src="vues/img/pictos/train.svg" class="picto" alt="picto train">
							<p> Gare TGV Vannes </p>
						</li>
						<li>
							<img src="vues/img/pictos/avion.svg" class="picto" alt="picto avion">
							<p> Aéroport Nantes Atlantique à 100 km</p>
						</li>
						<li>
							<img src="vues/img/pictos/voiture.svg" class="picto voiture" alt="picto voiture">
							<p> Depuis :   <br>
								Paris - 5h <br>
								Rennes - 1h20 <br>
								Nantes - 1h10
							</p>
						</li>
					</ul>                                       
				</section>
			</aside>
		</div>
		<section id="logements" class="containerbis posrelative">
			<div id="listlogements">
				<?php include('listeLogements.phtml.php'); ?>
			</div>
		</section>
	</div>
</main>

	<?php include 'footer.phtml.php';?>
	<script src="vues/js/accueil.js"></script>	
</body>
</html>