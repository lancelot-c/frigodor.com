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


			<h3>Contact</h3>
			
			<form method="post" action="contact.php" id="contactForm">
				<input type="text" name="objet" placeholder="Objet" value="<?php echo htmlspecialchars(stripslashes($_POST['objet'])); ?>" maxlength="100" required /><br /><br />
				<textarea name="message" placeholder="Message" maxlength="10000" required><?php echo htmlspecialchars(stripslashes($_POST['message'])); ?></textarea><br />
				
			<?php 
    			if (isset($_POST['objet']) AND isset($_POST['message']))
    			{
    				echo '<script language="javascript">document.getElementsByName("objet")[0].disabled=true; document.getElementsByName("message")[0].disabled=true; document.getElementsByName("objet")[0].style.color="#9C9B99"; document.getElementsByName("message")[0].style.color="#9C9B99";</script>';
    				
    				if (mail("frigodor@gmail.com", stripslashes($_POST['objet']), stripslashes($_POST['message']), "From: contact@frigodor.com" ))
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
