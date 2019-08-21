<?php include_once 'head.phtml.php'; ?>
	<link rel="stylesheet" type="text/css" href="vues/css/contact.css">		
</head>
<body>
	<header id="imgfond">
		<nav id="menu">
			<ul class="flex">
				<li class="posrelative">
					<a href="index.php">Accueil</a>
				</li>
				<li>
					<a href="index.php?page=localisation" id="navLocalisation">Localisation/Accès</a>
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
	<main class="container-contact">
		<div id="contact">
			<h1>POUR NOUS CONTACTER</h1>
			<p> <i class="fas fa-phone"></i> : 06 61 91 07 21</p>
			<p> <i class="fas fa-envelope"></i> : M.NASRI 5bis rue des Ondines 56750 DAMGAN </p>
			<a href="mailto:?to=ondines@activimage.net&subject=Les%20Ondines%20Demande%20information%20&body=Informations%20:%20">
				<i class="fas fa-at"></i> : ondines@activimage.net</a>
		</div>	
	</main>
<?php include 'footermini.phtml.php'; ?>
</body>
</html>