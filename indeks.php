<?php
session_start();
if (1)
{
	
	// Création des varibles de séssion
	
	if ($_SESSION['connect'] == NULL OR $_SESSION['connect'] == 0)
	{
		$_SESSION['connect'] = 0;
		$_SESSION['pseudo'] = NULL;
		$_SESSION['groupe'] = 'Visiteur';
	}
	
	
	// Suppresion des comptes non validés
	
	mysql_connect("localhost", "wb58981", "m5oe8mri");
	mysql_select_db("wb58981");
	
	$reponse_mysql = mysql_query("SELECT * FROM membres WHERE statut='Validation'") or die(mysql_error());
	
	mysql_close();
	
	while ($donnees_mysql = mysql_fetch_array($reponse_mysql))
	{
		if ($donnees_mysql['timestamp']+2*(24*3600) <= time())
		{	
			mysql_connect("localhost", "wb58981", "m5oe8mri");
			mysql_select_db("wb58981");
			
			mysql_query('DELETE FROM membres WHERE pseudo="' . $donnees_mysql['pseudo'] . '"');
			
			mysql_close();
			
		}
	}
	
	
	// Déconnexion
	
	if (isset($_GET['deconnexion']) AND $_GET['deconnexion'] == 1)
	{	
		mysql_connect("localhost", "wb58981", "m5oe8mri");
		mysql_select_db("wb58981");
		
		mysql_query('DELETE FROM connectes WHERE ip="' . $_SERVER['REMOTE_ADDR'] . '"');
		
		mysql_close();
		
		$_SESSION['connect'] = 2;
		$_SESSION['pseudo'] = NULL;
		$_SESSION['groupe'] = 'Visiteur';
	}
	
	
	// Connexion automatique
	
	if ($_SESSION['connect'] == NULL OR $_SESSION['connect'] == 0)
	{	
		mysql_connect("localhost", "wb58981", "m5oe8mri");
		mysql_select_db("wb58981");
	
		$ip = $_SERVER['REMOTE_ADDR'];
		
		$connexion = mysql_query("SELECT * FROM membres WHERE ip='$ip'") or die(mysql_error()); 
	
		mysql_close();
			
		while ($reponse_connexion = mysql_fetch_array($connexion))
		{
			if ($reponse_connexion['connexion'] == 'automatique' AND $reponse_connexion['statut'] != 'Banni')
			{
				$_SESSION['connect'] = 1;
				$_SESSION['pseudo'] = $reponse_connexion['pseudo'];
				$_SESSION['groupe'] = $reponse_connexion['statut'];
			}
		}
	}
	
	
	// Mise à jour de l'adresse IP
	
	if ($_SESSION['connect'] == 1)
	{
		$pseudo = $_SESSION['pseudo'];
		$ip = $_SERVER['REMOTE_ADDR'];
			
		mysql_connect("localhost", "wb58981", "m5oe8mri");
		mysql_select_db("wb58981");
			
		$reponse_mysql = mysql_query("SELECT ip FROM membres WHERE pseudo='$pseudo'") or die(mysql_error()); 
		$donnees_mysql = mysql_fetch_array($reponse_mysql);
		
		mysql_close();
		
		if ($ip != $donnees_mysql['ip'])
		{
			mysql_connect("localhost", "wb58981", "m5oe8mri");
			mysql_select_db("wb58981");
			
			mysql_query("UPDATE membres SET ip='$ip' WHERE pseudo='$pseudo'"); 
		
			mysql_close();
		}
	}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
   <head>
       <title>Notepac : logiciel de création de site</title>
       <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
       <link rel="stylesheet" media="screen" type="text/css" title="Design" href="design.css" />
       <link rel="icon" type="image/png" href="favicon.png" />
		<!--[if IE]><link rel="shortcut icon" type="image/x-icon" href="favicon.ico" /><![endif]-->
		
   </head>
   <body>
	
	<?php include("header.php"); ?>
	
	<?php include("menu.php"); ?>

		
	<br />
	


	<ul style="text-align:left;font-size:small;margin:0% 10%;">
	<br /><li><b>Qu'est ce que Notepac ?</b></li>
	Notepac est un logiciel gratuit, libre et multi-plateforme qui permet de modifier les pages de votre site web.
	Il regroupe tous les outils pour concevoir un site tel qu'un éditeur de texte, un ftp ainsi qu'un navigateur.
	Idéal pour débuter, le logiciel est très simple d'utilisation et nécessite simplement des connaissances en HTML.<br /><br />
	
	<li><b>En quoi est-il innovant ?</b></li>
	Notepac est innovant car il permet à lui seul la création d'un site web de A à Z. D'ailleurs, c'est avec Notepac que j'ai créé ce site. :)
	De plus, comme Notepac fonctionne avec le code source que vous lui donnez, ses fonctionnalités sont infinies. Il permet aussi bien de coder des animations CSS3 que des scripts PHP complexes comme la création d'un espace membre ou d'un forum... ce que des logiciels tels que iWeb (sur Mac) ne permettent pas.<br />
	N'attendez plus, adoptez Notepac. ;)
	</ul><br />
	
	
	<?php
		$lien_windows = "Downloads/Notepac_windows.exe";
		$lien_mac = "Downloads/Notepac_mac.dmg";
		$lien_linux = "Downloads/Notepac_linux.zip";
		$lien_sources = "Downloads/sources-1.1.zip";
	?>
	
	
	<table style="margin:auto;">
		<tr>
			<td class="bouton_telechargement">
				<a href="<?php echo $lien_windows; ?>">Télécharger pour<br />Windows</a><br />
				<span class="taille_fichier">(<?php echo round(filesize($lien_windows)/1000000, 1); ?> Mo)</span>
			</td>
			
			<td class="bouton_telechargement">
				<a href="<?php echo $lien_mac; ?>">Télécharger pour<br />Mac</a><br />
				<span class="taille_fichier">(<?php echo round(filesize($lien_mac)/1000000, 1); ?> Mo)</span>
			</td>
			
			<td class="bouton_telechargement">
				<a href="<?php echo $lien_linux; ?>">Télécharger pour<br />Linux</a><br />
				<span class="taille_fichier">(<?php echo round(filesize($lien_linux)/1000000, 1); ?> Mo)</span>
			</td>
			
			<td class="bouton_telechargement">
				<a href="<?php echo $lien_sources; ?>">Télécharger les<br />sources</a><br />
				<span class="taille_fichier">(<?php echo round(filesize($lien_sources)/1000000, 1); ?> Mo)</span>
			</td>
		</tr>
	</table>
	
	<br />


	<?php include("news.php"); ?>
	
	
	
	<?php include("footer.php"); ?>
	
	
	
	<?php	}	?>
	