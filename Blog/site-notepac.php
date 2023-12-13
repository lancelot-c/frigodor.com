<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
        <title>Sites web</title>
    </head>
    <body>
<?php include("header.php"); ?>
<?php include("nav.php"); ?>

<div id="fiche"></div>	
<div id="comments"></div>
<table id="tableSite">
	<tr>
    	<td style="min-width:630px;"> 		
			<p class="boutons">
				<?php	$_SESSION['idSite'] = '1';	include("compteur.php");	?>
    			<a href="#comments" class="linktoComments">
    				<?php echo $_SESSION['nbViews']; ?> <img src="views.png" alt="vues" title="<?php echo $_SESSION['nbViews']; ?> vues" />
    				2 <img src="comments.png" alt="commentaires" title="2 commentaires" />
    			</a>
    		</p>
    		<h3 class="website">Notepac</h3><hr /><br />
    			
    		<a href="screens_sites/notepac.png">
    			<img src="screens_sites/notepac.png" class="screenshot" alt="Aperçu du site" />
    		</a>
    		<ul style="padding-left:0px;">
    			<li><u class="client"></u> moi :p</li><br />
    			<li><u class="periode"></u> 2009</li><br />
    			<li><u class="acces"></u> non disponible</li><br />
    			<li><u class="description"></u> Notepac est un logiciel que j'ai créé durant mes années de troisième et de seconde en parallèle de mes études. Il permet de développer un site web de A à Z en intégrant à la fois la fonction d'éditeur de texte, de client ftp et de navigateur.
    			Ainsi il se distingue des innombrables logiciels que l'on peut trouver sur la toile qui vous propose de créer votre site web en un clic. Ces logiciels ne vous laissent aucune marge de manoeuvre, ils créent le site à votre place selon un désign prédéfini. Autant vous dire que vous ne créez rien...<br /><br />
    			Pour en faire la promotion j'ai décidé de créer un site où je publiais régulièrement des screenshots de Notepac. Le design de ce site a été réalisé par Lusso, un webdesigner qui m'a proposé de me faire une maquette gratuitement. J'ai tout de suite eu le coup de coeur pour <a href="http://lussostudio.daportfolio.com/gallery/104843#4">sa maquette</a> que j'ai décidé d'adopter. Malheureusement j'ai dû arrêter le développement du logiciel peu de temps après pour me concentrer sur mes études et mon bac qui approchait.<br /><br />
    			Notepac fut tout de même téléchargé plusieurs milliers de fois en seulement 2 ans d'existence et m'a valu plusieurs articles sur internet. C'est à ce jour la création dont je suis le plus fier.</li>
			</ul>
    	</td>
    			
    					
    	<td style="min-width:500px;padding-left:50px;">
 			<p class="boutons">
    			<a href="#fiche">
    				<img src="back.png" alt="Retour" title="Revenir à la fiche du site" />
    			</a>
    		</p>
			<h3>2 commentaires</h3><hr />
			
			<table id="tableComments">
				<tr>
					<td class="info">
						<img src="user.png" alt="" /><br />
						<b>Sandra</b><br />
						<time datetime="2012-07-16">Le 16/07/12</time>
					</td>
					<td class="comment">
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam scelerisque purus ac augue congue pretium. Curabitur vel justo arcu. Nunc vitae enim vel risus condimentum placerat a non ante. Nulla pretium, lacus vitae ornare consequat, justo nisl aliquet ante, quis auctor risus dolor a eros. Mauris ligula dui, consequat eu vehicula a, faucibus non eros. Pellentesque porta libero sed tellus tincidunt accumsan. Pellentesque dictum hendrerit turpis id vulputate. Sed rutrum elementum nunc sed vestibulum. Nunc ac risus quis dui euismod hendrerit sit amet consequat ipsum. Etiam sed quam enim.
					</td>
				</tr>
				<tr>
					<td class="info">
						<img src="userAdmin.png" alt="" /><br />
						<b>Lancelot</b><br />
						<time datetime="2012-07-18">Le 18/07/12</time>
					</td>
					<td class="comment">
						Fusce eu sapien eget nibh vestibulum adipiscing. In commodo varius ornare. Maecenas ut turpis in turpis pellentesque ornare nec at diam. In nisi metus, ultricies vel vulputate non, bibendum at diam. Pellentesque auctor nisi id magna facilisis euismod. Duis elit libero, tempus et condimentum ac, sagittis a lacus. Donec luctus pretium sapien vitae commodo. Nam quis nibh et nulla mattis luctus quis porttitor nunc. Etiam id condimentum ante. Sed vestibulum eros eu mauris pulvinar gravida dignissim eu nisl. Vivamus scelerisque semper justo, sed iaculis turpis interdum in.
					</td>
				</tr>
			</table><br /><br />


			<h3>Ajouter un commentaire</h3><hr />
			<form method="post" action="site-anepp.php#comments" id="commentForm">
				<input type="text" name="prenom" placeholder="Prénom" value="<?php echo htmlspecialchars($_POST['prenom']); ?>" maxlength="15" required /><br /><br />
				<textarea name="message" placeholder="Message" maxlength="10000" required><?php echo htmlspecialchars($_POST['message']); ?></textarea><br />
				
				<?php 
    				if (isset($_POST['prenom']) AND isset($_POST['message']))
    				{
    					echo '<script language="javascript">document.getElementsByName("prenom")[0].disabled=true; document.getElementsByName("message")[0].disabled=true; document.getElementsByName("prenom")[0].style.color="#9C9B99"; document.getElementsByName("message")[0].style.color="#9C9B99";</script>';
						echo '<input type="submit" class="success" value="Commentaire ajouté" disabled />';
					
						//Script d'ajout du commentaire dans la bdd
    				}
    				else
    				{
    					echo '<input type="submit" value="Commenter" />';
    				}
    			?>
			</form>
    	</td>
    </tr>
</table>
    		    			
<?php include("footer.php"); ?>
    </body>
</html>