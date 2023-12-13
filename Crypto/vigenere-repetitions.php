<!DOCTYPE html>
<html>
<head>
	<title>Chiffre de Vigenère</title>
	<meta charset="utf-8"> 
  	<style type="text/css">
  		body { text-align:center; }
  	</style>
</head>
<body>
 
 <form action="vigenere.php" method="post">
	<textarea type="text" name="message" rows="15" cols="80" placeholder="Pour un déchiffrage efficace, nous vous conseillons d'écrire un texte d'au moins 250 caractères."></textarea><br />
	<input type="submit" value="Vigenère !" />
</form><br /><br />

<?php
if (isset($_POST['message']))
	crack(htmlspecialchars($_POST['message']));
	

function getKeyChar($text, $crypt)
{
	$text = ord($text);
	$crypt = ord($crypt);
	
	if ($crypt >= $text)
		return $carreVigenere[$crypt - $text][0];
	else
		return $carreVigenere[$crypt - $text + 26][0];
}


function crack($text)
{
	$alphabet = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');	
	$text = str_replace(' ','', strtoupper($text)); // Met le texte en majuscules et supprime les espaces
	
	// Création du carré de Vigenère
	for ($i = 0; $i < 26; $i++)
		for ($j = 0; $j < 26; $j++)
			$carreVigenere[$i][$j] = $alphabet[($i+$j)%26];


	// Enregistrement des distances entre les divisions
	for ($i = 0; $i-2 < strlen($text); $i++)
	{
		$triplet = 	$text[$i] . $text[$i+1] . $text[$i+2];
		
		if (substr_count($text, $triplet) >= 2)
			echo count(array_keys($text[], "FVJ"));
		else
			$distancesRepetitions[$i] = "0";
	}
	
	// Enregistrement des diviseurs des distances
	for ($i = 1; $i < count($distancesRepetitions); $i++)
		if($distancesRepetitions[$i] != "0")
			for ($j = 2; $j < $distancesRepetitions[$i]; $j++) // On commence par 2 car 0 et 1 ne sont pas considérés comme des diviseurs
				if ($i % $j == 0)
					$diviseurs[$j]++;
				
	// Le diviseur qui apparait le plus souvent correspond à la longueur de la clef
	$keySize = array_search(max($diviseurs), $diviseurs)-1;
	
	
	// Création des sous-textes
	for ($i = 0; $i < strlen($text); $i++)
			$sousTexte[$i % $keySize][floor($i/$keySize)] = $text[$i];
	
	// Calcul des fréquences des lettres dans les sous-textes
	for ($i = 0; $i < $keySize; $i++)
	{
		for ($j = 0; $j < count($alphabet); $j++)
		{
			//$frequence[$i][$j] = substr_count(implode("", $sousTexte[$i]), alphabet[$j]) / strlen(implode("", $sousTexte[$i]));
		
			$key[$i] = getKeyChar('E', $alphabet[array_search(max($frequence[$i]), $frequence[$i])]);
		}
	}
	
	echo $key;
}
?>



</body>
</html>