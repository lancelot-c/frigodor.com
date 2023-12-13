<!DOCTYPE html>
<html>
<head>
	<title>Cryptanalyse du chiffre de Vigenère par Vincent Périz</title>
	<meta charset="utf-8"> 
  	<style type="text/css">
  		* { resize: none; }
  		body { padding: 20px; }
  		form { text-align: center; }
  		.decryptMessage { word-wrap: break-word; padding: 10px 0px; }
  		footer { text-align:center; font-size:0.8em; }
  	</style>
</head>
<body>
 
 <form action="vigenere.php" method="post">
	<textarea type="text" id="message" name="message" rows="15" cols="80"  maxlength="1000000" placeholder="Pour un déchiffrage efficace, je vous conseille d'écrire un texte d'au moins 250 caractères." required ></textarea><br />
	<input type="submit" value="Vigenère !" />
</form><br /><br />


<?php
	$alphabet = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');

	// Création du carré de Vigenère
	for ($i = 0; $i < 26; $i++)
		for ($j = 0; $j < 26; $j++)
			$carreVigenere[$i][$j] = $alphabet[($i+$j)%26];
			
			
if (isset($_POST['message']))
	crack(htmlspecialchars($_POST['message']));
	
	
function getKeyChar($cryptChar)
{	
	global $alphabet, $carreVigenere;
	
	$textChar = ord('E'); // 69
	$cryptChar = ord($cryptChar);
	
	if ($cryptChar >= $textChar)
		return $carreVigenere[$cryptChar - $textChar][0];
	else
		return $carreVigenere[$cryptChar - $textChar + 26][0];
}

function decryptChar($cryptChar, $keyChar)
{	
	global $alphabet, $carreVigenere;
	
	$cryptChar = ord($cryptChar);
	$keyChar = ord($keyChar);

	if ($cryptChar >= $keyChar)
		return $carreVigenere[0][$cryptChar - $keyChar];
	else
		return $carreVigenere[0][$cryptChar - $keyChar + 26];
}

function crack($text)
{
	global $alphabet;
	$originalText = $text;
	$text = str_replace(' ','', strtoupper($originalText)); // Met le texte en majuscules et supprime les espaces
	
	// Détermination de la longueur de la clef
	for ($i = 1; $i < 10; $i++)
	{
		$IC[$i] = 0;
		
		for ($j = 0; $i*$j < strlen($text); $j++)
		{
			$sousTexte[$i][$j] = $text[$i*$j];
		}
		
		
		for ($k = 0; $k < count($alphabet); $k++)
		{
			$occurence[$i][$k] = substr_count(implode("", $sousTexte[$i]), $alphabet[$k]);

			$IC[$i] += ($occurence[$i][$k] * ($occurence[$i][$k] - 1)) / (strlen(implode("", $sousTexte[$i])) * (strlen(implode("", $sousTexte[$i])) - 1));
		}
	}
	
	$keySize = array_search(max($IC), $IC);
	$key = '';
	$message = '';
	$spaces = 0;
	echo "L'indice de coincidence le plus élevé est " . max($IC) . "<br />";
	echo "Il a été trouvé pour un décalage de " . $keySize . " caractères.<br />";
	echo "La clef à donc une longueur de " . $keySize . " caractères.<br />";


	// Détermination de la clef
	for ($j = 0; $j < strlen($text); $j++)
		$sousTexte2[$j % $keySize][] = $text[$j];
			
	for ($i = 0; $i < $keySize; $i++)
	{
		for ($k = 0; $k < count($alphabet); $k++)
			$occurence2[$i][$k] = substr_count(implode("", $sousTexte2[$i]), $alphabet[$k]);
		
		$key .= getKeyChar($alphabet[array_search(max($occurence2[$i]), $occurence2[$i])]);
	}
	
	echo "La clef est " . $key . "<br />";
	

	
	// Déchiffrement du message	
	for ($i = 0; $i < strlen($text); $i++)
	{
		if (ord($text[$i]) >= 65 AND ord($text[$i]) <= 90)
		{
			$message .= decryptChar($text[$i], $key[($i - $spaces) % $keySize]);
		}
		else
		{
			$spaces++;
			$message .= $text[$i];
		}
	}
	
	echo "<br /><br />Le message déchiffré est : <div class=\"decryptMessage\">" . $message . "</div><br />";
}
?>

<br />
<footer>Petit programme développé par Vincent Periz<br />EPF - 1<sup>ère</sup> année - groupe Ab</footer>
</body>
</html>