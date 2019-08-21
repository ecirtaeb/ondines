<?php

function connexion() {

	$user ='root';
	$password = '';
	try {
		$dbname = 'mysql:host=localhost;dbname=ondines';
		$db = new PDO($dbname, $user, $password);	
		$db->exec('SET NAMES UTF8');
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}		
	catch (PDOException $rc) {
    	echo 'Échec lors de la connexion : ' . $rc->getMessage();
    	$erreur['erreur'] = $rc->getMessage();
    	return $erreur;
    }
	return $db;	

}
