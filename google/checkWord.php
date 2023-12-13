<?php
header('Content-Type: text/html; charset=utf-8');

$dico = fopen('dictionnaire.txt', 'r');
$mot = htmlspecialchars($_GET['m']);

if ($dico AND $mot != NULL)
{
	while (!feof($dico))
	{
		$ligne = fgets($dico); // Récupère la ligne courante du dico
		$ligne = substr($ligne, 0, -1); // Supprime le retour chariot à la fin de la ligne (à modifier par un code plus fiable)
		
		if ($ligne == $mot)
		{
			echo 'ok';
			break;
		}
	}
}

fclose($dico);
?>