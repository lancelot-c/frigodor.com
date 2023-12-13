<?php 
	mysql_connect("localhost", "wb58981", "m5oe8mri");
	mysql_select_db("wb58981");

	$pseudo = $_SESSION['pseudo'];
	
	$retour_requete = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM connectes WHERE pseudo='$pseudo'") or die(mysql_error()); 
	$donnees_requete = mysql_fetch_array($retour_requete);

	if ($donnees_requete['nbre_entrees'] == 0) // L'ip ne se trouve pas dans la table, on va l'ajouter
	{
		if ($_SESSION['pseudo'] != NULL AND $_SESSION['connect'] == 1)
		{
			mysql_query("INSERT INTO connectes VALUES('".date('d/m/Y')."', '".date('H:i')."', '" . $_SESSION['groupe'] . "', '$pseudo', '" . time() . "')") or die(mysql_error()); 
		}
	}
	else
	{
		if ($_SESSION['pseudo'] != NULL AND $_SESSION['connect'] == 1)
		{
			mysql_query('UPDATE connectes SET timestamp=' . time() . ' WHERE pseudo=\'$pseudo\'') or die(mysql_error()); 
		}
	}

	$timestamp_5min = time() - (60 * 5); // 60 *5 = nombre de secondes écoulées en 5 minutes
	mysql_query('DELETE FROM connectes WHERE timestamp < ' . $timestamp_5min);

	// -------
	// ETAPE 3 : on compte le nombre d'ip stockées dans la table. C'est le nombre de visiteurs connectés
	$retour = mysql_query('SELECT COUNT(*) AS nbre_entrees FROM connectes') or die(mysql_error()); 
	$donnees = mysql_fetch_array($retour);
	
	$reponses = mysql_query("SELECT maximum FROM connectes_maximum ") or die(mysql_error()); 
	$connectes = mysql_fetch_array($reponses);
	
	if ($donnees['nbre_entrees'] > $connectes['maximum'])
	{
		$max_connectes = $donnees['nbre_entrees'];

		mysql_query("UPDATE connectes_maximum SET maximum = '$max_connectes'") or die(mysql_error());
		mysql_query("UPDATE connectes_maximum SET date = '".date('d/m/Y')."'") or die(mysql_error());
		mysql_query("UPDATE connectes_maximum SET heure = '".date('H:i')."'") or die(mysql_error());

	}
	
	mysql_close();
?>