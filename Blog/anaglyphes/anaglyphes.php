<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
    <title>Les anaglyphes</title>
    <link rel="stylesheet" href="design.css" type="text/css">
    <link rel="icon" type="image/png" href="favicon.png" />
</head>
<body>
    
<?php include("header.php"); ?>

<?php include("aside.php"); ?>

<article>
<h2>Les anaglyphes</h2>


<img src="ana-1.png" width="300" style="float:right;margin:15px;" />

<p>C’est le plus ancien procédé qui a été utilisé dès les années 50 pour les premiers films 3D au cinéma : L’homme au masque de cire (1953) et L’étrange créature du lac noir (1954). Sous ce nom étrange se cache en fait une image à laquelle vous avez certainement déjà été confronté. Les anaglyphes sont les premières images 3D qui ont fait leur apparition au cinéma. Elles sont à dominante rouge et bleu et paraissent floues lorsque vous ne portez pas de lunettes.</p><br />

<b><u>L’anaglyphe : deux images en une</u></b><br />
<p>Nous avons vu précédemment que l’impression de relief réside dans le fait que nos deux yeux reçoivent deux images légèrement différentes. L’anaglyphe est une image très puissante dans la mesure où elle permet de cacher ces deux images en une grâce à un jeu de couleurs.</p><br /><br />
 
<b><u>Explication</u></b><br /><br />
La lumière qui nous paraît blanche est en fait composée de 3 couleurs de base dites «primaires» : le rouge, le vert et le bleu. Les couleurs « secondaires » (jaune, cyan, magenta) sont obtenues par addition des couleurs primaires.<br /><br />
<div class="remarque information">N.B. : le blanc est obtenu par addition des 3 couleurs primaires ou secondaires. Le noir est quant à lui désigné comme une couleur par abus de langage mais il correspond en fait à l’absence de couleur.</div><br /><br />
Toutes les couleurs sont ainsi composées uniquement de rouge, de bleu et de vert. Mélangées dans des proportions inégales, on peut alors reconstituer absolument toutes les couleurs de l’arc-en-ciel.<br />
 
<center class="legende"><img src="ana-2.png" height="250" /><br />Décomposition d’un faisceau lumineux</center>
<p>Un filtre coloré absorbe certaines ondes lumineuses et en laisse passer d’autres. Par exemple, un filtre rouge absorbe toutes les radiations sauf celles qui composent la couleur rouge.</p><br /><br />
<b><u>Application</u></b><br />
<p>Voici deux séquences d’images dont nous souhaitons percevoir le relief :</p>
<center><table class="tableau legende"><tr><td><img src="ana/1/left.jpg" width="300" /></td><td><img src="ana/1/right.jpg" width="300" /></td></tr>
<tr><td><em>Image de gauche</em></td><td><em>Image de droite</em></td></tr></table></center><br /><br />
  
</p>Nous n'allons conserver à gauche que la composante rouge de l’image et à droite uniquement les composantes verte et bleu.</p>  
<center><table class="tableau legende"><tr><td><img src="ana/1/leftRed.jpg" width="300" /></td><td><img src="ana/1/rightCyan.jpg" width="300" /></td></tr>
<tr><td><em>Composante rouge de l'image de gauche</em></td><td><em>Composantes verte et bleu de l'image de droite</em></td></tr></table></center><br /><br />


<p>Puis nous superposons les deux séquences et nous les observons à travers des lunettes dont le verre gauche est un filtre rouge et le verre droit, un filtre cyan (le cyan étant la somme du vert et du bleu) :</p> 
<center class="legende"><img src="ana/1/ana.jpg" style="width:600px;" /><br /><b><u>Anaglyphe</u></b></center>
<p>Le filtre rouge ne laisse passer à l’œil gauche que l’image de gauche et le filtre cyan, que l’image de droite. Il ne reste plus à notre cerveau qu'à fusionner ces deux images pour nous faire percevoir le relief.</p><br /><br />
<b><u>Créez votre propre anaglyphe</u></b><br />
<p>A nos heures perdues, nous avons réussi à développer un petit programme qui créent des anaglyphes. Glissez simplement deux images de votre bureau dans les 2 carrés inférieurs et observez le résultat avec vos lunettes anaglyphes. (Il va de soi que le relief ne sera pas perçu si vos images n'ont pas été prises à 6,5cm d'écart)</p> 
<div class="remarque attention">Cette animation utilise une technologie uniquement compatible avec les navigateurs Google Chrome et Firefox 4. Merci d’utiliser un de ces deux navigateurs.</div>

<br /><br /><?php include("anaglyphe-generator.html"); ?><br /><br />


<b><u>Etude complémentaire : pourquoi le rouge et le cyan ?</u></b><br />
<p>Pour créer un anaglyphe, il est impératif d’utiliser deux images aux couleurs complémentaires afin que la séparation des images par les filtres se fasse sans difficulté  et que chaque œil ne voit que l’image qui lui est destinée. Il existe naturellement d’autres couleurs complémentaires que le rouge et le cyan. On peut citer par exemple le vert et le magenta ou le bleu et le jaune. Cependant, l’œil ne perçoit pas de la même manière ces couleurs.</p>
<p>Le graphique ci-dessous présente l’intensité lumineuse des couleurs en fonction de leur longueur d’onde. Plus l’intensité lumineuse est forte, plus notre œil sera stimulé lors de la vision de cette couleur. </p>
 
<center><img src="ana-3.png" width="500" /></center>
 
<p>On remarque que si l'on fait la moyenne des intensités lumineuses des couleurs bleu et vert, on obtient la moyenne de l’intensité lumineuse de la couleur rouge : (m1 + m2)/2 = m3. Notre rétine a donc une sensibilité égale pour le cyan(vert + bleu) et le rouge. Ainsi, lorsque qu’on regarde une image rouge avec notre œil gauche et une image cyan avec notre œil droit, nos deux yeux seront autant stimulés l’un que l’autre et le relief sera restitué.</p>
<p>Ceci n’est pas vérifié pour les couples de couleurs vert/magenta et bleu/jaune. Dans ces cas là, un des deux yeux sera prépondérant sur l’autre et cela atténuera évidemment la sensation de relief.</p><br /><br />
 
<p>Les anaglyphes, très présents pendant les années 90 laissent peu à peu place à la polarisation, le procédé actuellement utilisé par les cinémas pour diffuser des films en 3D.</p><br />

<br /><br />
<center><a class="large black awesome" href="polarisation.php">2<sup>ème</sup> procédé : la projection polarisée</a></center>

</article>

<?php include("footer.php"); ?>
	
</body>  
</html>  