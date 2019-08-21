<?php include 'head.phtml.php'; ?>
	<link rel="stylesheet" type="text/css" href="vues/css/tourisme.css">	
<body>
	<header id="imgfond">
		<nav id="menu">
			<ul class="flex">
				<li>
					<a href="index.php">Accueil</a>
				</li>
				<li>
					<a href="index.php?page=situation" id="navSituation">Localisation/Accès</a>
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
	<main class="container-tourisme">
		<h1>Quelques idées de sorties pour agrémenter votre séjour</h1>		
		<?php foreach ($diapoTourisme as $id=>$diapo) : ?>

			<section id=<?='"'.$diapo['categ'].'"'?>>
				<h2><?=$diapo['libelle']?></h2>
				<section class="diaporama">
					<ul class="flex posrelative diapo" data-id=<?='"'.$id.'"'?>>
						<?php foreach ($diapo['photos'] as $i=>$photo) : ?>
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
			</section>	

		<?php endforeach; ?>

	</main>

		<?php include 'footermini.phtml.php';?>	
		<script src="vues/js/tourisme.js" ></script>	
</body>
</html>
