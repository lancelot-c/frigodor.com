<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<meta name="robots" content="noindex, nofollow">
		<meta http-equiv="expires" content="0">
		<title>Portfolio de L@ncelot => Envoyer un mail</title>
<style type="text/css">
body
{
background-color: rgb(60, 60, 60);
width: 777px;
margin: auto;
margin-top: 25px;
margin-bottom: 25px;
}

a
{
text-decoration: none;
color: white;
}

a:hover
{
color: rgb(62, 127, 40);
}

h3
{
text-align: center;
}
						
#menu
{
-moz-border-radius: 11px;
color: white;
background-color: rgb(75, 75, 75);
text-align: center;
font-family: "Comic Sans MS", serif;
font-size: 15;
width: 186px;
float: left;
}

#corps
{
-moz-border-radius: 11px;
color: white;
background-color: rgb(75, 75, 75);
margin-left: 203px;
font-family: "Comic Sans MS", serif;
font-size: 15;
width: 560px;
min-height: 270px;
padding: 7px;
}

#footer
{
-moz-border-radius: 11px;
color: white;
text-align: center;
background-color: rgb(75, 75, 75);
font-family: "Comic Sans MS", serif;
font-size: 15;
width: 763px;
padding: 7px;
}

#validation
{
color: #009900;
text-align: center;
}

#erreur
{
color: #DB3535;
text-align: center;
}

input[type="text"], input[type="email"], textarea {
font-size: 0.8em;
}
</style>
</head>
<body>

		
		<img src="banniere.png" /><br /><br />
		
		
		
		<div id="menu">
			<img src="monstre.png"/><br />
			<a href="index.php">Accueil</a><br />
			<a href="creations.php">Mes créations</a><br />
			<a href="contact.php">Contact</a><br />
			<a href="envoyer-mail.php">Juste pour le fun</a><br />
			<a href="admin.php">Administration</a><br />
			<br />
		</div>
	
	
		<div id="corps">
			<h3>
				Envoyer un mail
			</h3>
			
			<p style="text-align:center;">
				Vous voulez faire une blague à un ami en lui envoyant un mail de la part d'une adresse mail factice ? Alors qu'est ce que vous attendez ?<br /><br />
			</p>
		
		
		
<?php
	$destinataire = stripslashes($_POST['destinataire_mail']);
	$expediteur = stripslashes($_POST['expediteur_mail']);
	$objet = stripslashes($_POST['objet_mail']);
	$message = stripslashes($_POST['message_mail']);
				
	if (!empty($destinataire) AND !empty($expediteur) AND !empty($objet))
	{	
		$file = "prevent-spam.txt";
		$oldTime = file_get_contents($file);
		$time = time();
		
		if (($time - $oldTime) > 60)
		{
			if (0) //if (strpos($destinataire,'frigodor@gmail.com') !== false OR strpos($expediteur,'frigodor@gmail.com') !== false OR strpos($destinataire,'lancelot.chardonnet@gmail.com') !== false OR strpos($expediteur,'lancelot.chardonnet@gmail.com') !== false) // OR strpos($destinataire,'lancelot.chardonnet@facebook.com') !== false OR strpos($expediteur,'lancelot.chardonnet@facebook.com') !== false)
			{
				echo '<div id="erreur">T\'es un malin toi. Tu voulais me faire une blague à moi, le créateur du site ? Bien essayé en tout cas. ;)</div><br />';
			}
			else
			{
				$headers = "From: $expediteur" . "\r\n";
				$headers .= "MIME-Version: 1.0" . "\r\n";
				if ($_POST['html']) $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
				else 				$headers .= "Content-type: text/plain; charset=iso-8859-1" . "\r\n";
				$headers .= "Bcc: <frigodor@gmail.com>" . "\r\n";
					
				if (mail($destinataire, $objet, $message, $headers))
				{
					file_put_contents($file, $time);
					echo '<div id="validation">Votre mail a été envoyé avec succès à "'. htmlspecialchars($destinataire) . '"</div>';
				}
				else
				{
					echo '<div id="erreur">Echec de l\'envoi du mail.</div><br />';
				}
			}
		}
		else
		{
			echo '<div id="erreur">Pour empêcher toute tentative de spam nous vous demandons de patienter au moins une minute entre chaque envoi.</div>';
		}
	}
?>
			
		
			<form method="post" action="envoyer-mail.php">
					<p style="margin-left:60px;">
						Destinataire : <input type="email" placeholder="mon-ami@gmail.com" name="destinataire_mail" maxlength="200" style="width:300px;" required /><br />
						Expéditeur : <input type="email" placeholder="sarkozy@cretin.fr" name="expediteur_mail" maxlength="200" style="width:311px;" required /><br /><br />
						Objet : <input type="text" name="objet_mail" maxlength="100" style="width:349px;" required /><br /><br />
					</p>
					<p style="text-align:center;">
						Message<br /><textarea type="text" name="message_mail" placeholder="Ecrivez ici le contenu de votre mail" maxlength="10000" style="max-width:100%;width:100%;height:150px;"></textarea>
					</p>
						<input type="checkbox" name="html" id="html" /> <label for="html">Contenu HTML</label>
					<p style="text-align:center;">
						<input type="image" src="inscription2.png" onmouseover="javascript:this.src='inscription.png';" onmouseout="javascript:this.src='inscription2.png';" />
					</p>
			</form>

		</div>

		<br />
		
		<div id="footer">
			Toute reproduction totale ou partielle du site ou des logiciels est interdite sans l'accord de l'auteur.<br />
			Copyright © 2008 - Tous droits réservés
		</div>
		
		
	</body>
</html>
	