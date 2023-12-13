<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
        <title>Contact</title>
    </head>
    <body>
    	<?php include("header.php"); ?>
    	
    	<?php include("nav.php"); ?>


			<h3>Demander un devis gratuit</h3>
			<p>Vous souhaitez créer votre site web sur mesure en faisant appel à quelqu'un de sérieux ?<br />
			Je suis webdesigner en freelance depuis quelques mois. Pour me faire connaitre je propose des prix attractifs beaucoup moins cher que la concurrence.</p><br />
			
			<form method="post" action="devis.php" id="devisForm">
				<textarea name="message" maxlength="10000" placeholder="Présentez moi en détail votre projet dans ce formulaire ou envoyez moi un mail à frigodor@gmail.com. Je tacherais de vous répondre rapidement." required><?php echo htmlspecialchars(stripslashes($_POST['message'])); ?></textarea><br />
				
			<?php 
    			if (isset($_POST['message']))
    			{
    				echo '<script language="javascript">document.getElementsByName("message")[0].disabled=true; document.getElementsByName("message")[0].style.color="#9C9B99";</script>';
    				
    				if (mail("frigodor@gmail.com", "Demande de devis", stripslashes($_POST['message']), "From: contact@frigodor.com" ))
    				{
    					echo '<input type="submit" class="success" value="Message envoyé" disabled />';
    				}
    				else
    				{
    					echo '<input type="submit" class="failed" value="Echec de l\'envoi" disabled />';
    				}
    			}
    			else
    			{
    				echo '<input type="submit" value="Envoyer" />';
    			}
    		?>
			</form>
    	
    	
    	<?php include("footer.php"); ?>
    </body>
</html>
