<?php
	$fichier = "compteur.txt";
	$lignes = file($fichier);
	
	$_SESSION['nbViews'] = trim($lignes[$_SESSION['idSite']]);
	$_SESSION['nbViews']++;
	$lignes[$_SESSION['idSite']] = $_SESSION['nbViews'] . "\n";
	
	file_put_contents($fichier, $lignes);
?>