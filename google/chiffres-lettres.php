<!DOCTYPE html>
<html>
<head>
	<title>Des Chiffres et des Lettres</title>
	<meta charset="utf-8"> 
  	<style type="text/css">
  		@font-face {
  		font-family: Paper; src: url('English-Essay.ttf'); // English-Essay.ttf - Paper-Mache.ttf
  		}
  		body {
  		display: box;
  		box-orient: horizontal;
  		box-align: center;
  		padding: 20px;
  		font-family: "Trebuchet MS", Verdana, Tahoma, sans-serif;
  		}  		
  		legend:not([style]) {
  		font-family:Paper, serif;
  		font-size: xx-large;
  		}
  		#chiffres, #lettres {
		border: 0px solid black;
		border-radius: 20px;
		width: 500px;
		padding: 15px;
		margin-top: 40px;
		box-shadow:1px 1px 10px #333333;
		text-align:left;
		display:inline-block;
		}
		#nbToReach {
		font-size: large;
		}
		.case {
		border: 1px solid silver;
		min-width: 30px;
		height: 30px;
		padding : 5px;
		margin: 0px 5px;
		font-weight:bold;
		font-size:x-large;
		}
		td {
		text-align:center;
		}
		input[type=text] {
		width:350px;
		font-size:0.9em;
		background: rgba(255, 255, 255, 0.9);
		background:-moz-linear-gradient(90deg, #fff, #eee); /* Firefox */
		background:-webkit-gradient(linear, left top, left bottom, from(#eee), to(#fff), color-stop(0.2, #fff)); /* Webkit */
		border:1px solid #aaa;
		border-radius: 3px;
		box-shadow:0px 0px 3px #aaa;
		padding: 5px;
		}
		input[type=button] {
		font-size:16px;
		}
		footer {
		color: gray;
		font-size: 0.7em;
		margin-top:50px;
		text-align: center;
		}
		footer a {
		color: gray;
		}
		progress {
		width: 100%;
		visibility: hidden;
		}
		#score {
		position: fixed;
		left: 10px;
		bottom: 10px;
		background-color: #333333;
		color: white;
		padding: 8px 20px;
		border-radius: 5px;
		}
		
		#help {
		background: white;
		border-radius: 5px;
		color:black;
		display:none;
		font-size: 0.85em;
		position:absolute;
		top:10%;
		left:20%;
		width: 60%;
		padding:10px 20px;
		box-shadow:1px 1px 10px #333333;
		-webkit-transition: all 1s ease-in-out;
		}
		#help:target {
		display:block;
		}
		#close:target ~ #help {
		display: none;
		}
  	</style>
</head>
<body>
 <!-- http://www.dailymotion.com/video/xd9244_des-chiffres-et-des-lettres-le-scan_fun#rel-page-3 -->
 <!-- Détection automatique de progress et audio à faire et prévenir l'utilisateur si non supporté -->

<audio>
	<source src="reflexion.mp3"></source>
	<source src="reflexion.ogg"></source>
</audio>

<center>
<fieldset id="chiffres">
	<legend>Des Chiffres...</legend>
	
	<table>
		<tr>
			<td>
				<fieldset style="box-flex:1;border-color:gray;border-radius:3px;">
					<legend style="font-size:x-small;width:120px;">Nombre à atteindre</legend>
					<span id="nbToReach">???</span>
				</fieldset>
			</td>
			<td><div class="case" id="nombre0">?</div></td>
			<td><div class="case" id="nombre1">?</div></td>
			<td><div class="case" id="nombre2">?</div></td>
			<td><div class="case" id="nombre3">?</div></td>
			<td><div class="case" id="nombre4">?</div></td>
			<td><div class="case" id="nombre5">?</div></td>
		</tr>
	</table><br />
	
	<input type="text" placeholder="" maxlength="100" onKeyUp="previewNumber()" />
	<input type="button" value="Commencer !" onclick="numbers();" /><br />
	<progress value="0" max="30000"></progress>
</fieldset>

<div id="result" style="position:relative;bottom:60px;left:50px;color:#A3A3A3;text-align:right;width:100px;">= 0</div>

<fieldset id="lettres">
	<legend>... et des Lettres</legend>
	
	<table>
		<tr>
			<td><div class="case" id="lettre0">?</div></td>
			<td><div class="case" id="lettre1">?</div></td>
			<td><div class="case" id="lettre2">?</div></td>
			<td><div class="case" id="lettre3">?</div></td>
			<td><div class="case" id="lettre4">?</div></td>
			<td><div class="case" id="lettre5">?</div></td>
			<td><div class="case" id="lettre6">?</div></td>
			<td><div class="case" id="lettre7">?</div></td>
			<td><div class="case" id="lettre8">?</div></td>
		</tr>
	</table><br />
	
	<input type="text" placeholder="" maxlength="9" style="text-transform:uppercase;" />
	<input type="button" value="Commencer !" onclick="letters();" /><br />
	<progress value="0" max="30000"></progress>
</fieldset>
</center>

<div id="close" style="display:none;"></div>
<div id="help">
	<h3>Règles du jeu</h3>
	<p>Diffusé à partir de 1965 sur France 3, <em>Des chiffres et des lettres</em> est un jeu télévisé français composé de 2 types d'épreuves :
	<ul>
		<li><u>Le compte est bon :</u> le but de cette épreuve est de faire des opérations élémentaires (+, -, x, ÷) sur 6 entiers naturels tirés au hasard pour se rapprocher le plus possible d'un nombre. L'idéal étant bien entendu d'obtenir le nombre lui-même.</li><br />
		<li><u>Le mot le plus long :</u> dans cette épreuve 9 lettres sont tirés au hasard. Le but est d'utiliser ces lettres pour former le mot le plus long possible sachant que chaque lettre ne peut être utilisée qu'une seule fois. Les mots avec accents et les verbes conjugués sont autorisés, les noms propres sont interdits.</li>
	</ul>
	Vous disposez de 30 secondes pour chacune des épreuves. Dans la 1<sup>ère</sup> épreuve, écrivez toutes les opérations nécessaires à votre calcul dans le champ mis à votre disposition. Pour vous aider, un indicateur à droite vous indique le résultat de votre calcul. Pour la 2<sup>ème</sup> épreuve écrivez simplement votre mot dans le champ.<br />
	Si vous avez terminé avant la fin du temps imparti, cliquez sur le bouton "Terminer".
	</p><br />
	<h3>Comment sont comptabilisés les points ?</h3>
	<ul>
		<li><u>Le compte est bon :</u> si la distance entre votre nombre et le nombre à atteindre est supérieure à 100 vous ne gagnez rien. Sinon le nombre de points gagné est obtenu suivant la formule <b>100 - distance</b>.</li>
		<li><u>Le mot le plus long :</u> si votre mot est correct, chaque lettre vous rapporte 10 points.</li>
	</ul><br />
	
	<center>
		<a href="#close">
			<input type="button" value="Fermer" />
		</a>
	</center>
</div>

<div id="score"></div>
<a href="#help" style="position:fixed;bottom:0px;right:10px;">
	<img src="question.png" style="width:50px;" alt="Aide" title="Afficher l'aide" />
</a>


<script>
var score = 0;
var loadStep = 50;
var isPlaying = 0;
var timer, i, j, n, randomLetters, progressBarCurrent, buttonCurrent;
var audio = document.getElementsByTagName("audio")[0];
var result = document.getElementById("result");

var inputNumbers = document.getElementsByTagName("input")[0];
var inputLetters = document.getElementsByTagName("input")[2];
var buttonNumbers = document.getElementsByTagName("input")[1];
var buttonLetters = document.getElementsByTagName("input")[3];
var progressBarNumbers = document.getElementsByTagName("progress")[0];
var progressBarLetters = document.getElementsByTagName("progress")[1]; 

var nombres = ['1','2','3','4','5','6','7','8','9','10','25','50','75','100'];
var consonnes = ['B','C','D','F','G','H','J','K','L','M','N','P','Q','R','S','T','V','W','X','Z'];
var voyelles = ['A','E','I','O','U','Y'];
addPoints(0);


function numbers()
{
	if (isPlaying == 1)
	{
		end();
		return;
	}
	else if (isPlaying == 2)
	{
		return;
	}
	else
	{
		progressBarCurrent = progressBarNumbers;
		buttonCurrent = buttonNumbers;
		beginNumbers();
	}
}


function letters()
{
	if (isPlaying == 1)
	{
		return;
	}
	else if (isPlaying == 2)
	{
		end();
		return;
	}
	else
	{
		progressBarCurrent = progressBarLetters;
		buttonCurrent = buttonLetters;
		beginLetters();
	}
}


function beginNumbers()
{
	for (i = 0; i < 6; i++)
	{
		document.getElementById("nombre" + i).innerHTML = nombres[rand(0, nombres.length-1)];
	}
	
	document.getElementById("nbToReach").innerHTML = rand(100, 999);
	inputNumbers.value = '';
	previewNumber();
	
	isPlaying = 1;
	audio.play();
	progressBarCurrent.style.visibility = "visible";
	timer = setInterval("progress()", loadStep);
	buttonCurrent.value = "Terminer !";
}


function beginLetters()
{
	for (i = 0; i < 9; i++)
	{
		if (rand(1, 2) == 1) // consonne
		{
			document.getElementById("lettre" + i).innerHTML = consonnes[rand(0, consonnes.length-1)];
		}
		else // voyelle
		{
			document.getElementById("lettre" + i).innerHTML = voyelles[rand(0, voyelles.length-1)];
		}
	}
	inputLetters.value = '';
	
	isPlaying = 2;	
	audio.play();	
	progressBarCurrent.style.visibility = "visible";
	timer = setInterval("progress()", loadStep);
	buttonCurrent.value = "Terminer !";
}

function end()
{
	clearInterval(timer);
	loaded = 0;
	audio.pause();
	audio.currentTime = 0;
	progressBarCurrent.style.visibility = "hidden";
	progressBarCurrent.value = "0";
	buttonCurrent.value = "Commencer !";

	if (isPlaying == 1)
		addPoints(checkNumber());
		
	if (isPlaying == 2 && checkWord())
		addPoints(inputLetters.value.length *10);
		
	isPlaying = 0;
}

function progress()
{
	progressBarCurrent.value += loadStep;
	
	if (progressBarCurrent.value == progressBarCurrent.max)
		end();
}

function rand(min, max)
{
    return Math.floor(Math.random() * (max - min + 1) + min);
}

function previewNumber()
{
	if (eval(inputNumbers.value) == document.getElementById("nbToReach").innerHTML) {
		result.style.color = '#4D9900';
	}
	else {
		result.style.color = '#A3A3A3';
	}
	
	if (inputNumbers.value == '')
		result.innerHTML = '= 0';
	else
		result.innerHTML = '= ' + eval(inputNumbers.value);
}

function checkNumber()
{
	var expression = inputNumbers.value;
	var numberToCheck = eval(expression);
	var numberToReach = document.getElementById("nbToReach").innerHTML;
	
	var extractedNumbers = new Array();
	var randomNumbers = new Array();
	var previousWasNb = false;
	var temporyNb = '';
	
	// Extraction des nombres de l'expression
	for (i = 0; i < expression.length; i++)
	{
		if (!isNaN(expression.charAt(i)))
		{
			temporyNb += expression.charAt(i);
			previousWasNb = true;
		}
		else if (previousWasNb)
		{
			extractedNumbers.push(temporyNb);
			temporyNb = '';
			previousWasNb = false;
		}
		else
		{
			previousWasNb = false;
		}
	}
	
	if (previousWasNb)
		extractedNumbers.push(temporyNb);
		
		
	// L'expression est t'elle composée des nombres demandés ?
	for (j = 0; j < 6; j++)
	{
		randomNumbers.push(document.getElementById("nombre" + j).innerHTML);
	}
	
	var goodNb;
	for (i = 0; i < extractedNumbers.length; i++)
	{
		goodNb = false;
		for (j = 0; j < randomNumbers.length; j++)
		{
			if (extractedNumbers[i] == randomNumbers[j])
			{
				randomNumbers.splice(j, 1);
				goodNb = true;
			}
		}
		
		if (!goodNb)
			return 0;
	}
	
	
	if ((100 - Math.abs(numberToReach - numberToCheck)) > 0)
		return (100 - Math.abs(numberToReach - numberToCheck));
	else
		return 0;
}

function checkWord()
{
	var mot = inputLetters.value.toLowerCase().replace('é', 'e').replace('è', 'e').replace('ê', 'e').replace('à', 'a').replace('ù', 'u').replace('ö', 'o').replace('ï', 'i');
	
	if (mot == '')
		return false;
	
	// Le mot existe t'il dans la langue française ?
	if (window.XMLHttpRequest)
	{
		xhr = new XMLHttpRequest();
	}
	else if (window.ActiveXObject)
	{
		xhr = new ActiveXObject('Microsoft.XMLHTTP');
	}
	else
	{
		alert('JavaScript : Votre navigateur ne supporte pas les objets XMLHttpRequest...');
		return false;
	}
		
 	xhr.open('GET', 'checkWord.php?m=' + mot, false);
        
    xhr.onreadystatechange = function()
    { 
        if (xhr.readyState == 4)
        {
            if (xhr.status != 200)
            	alert('Erreur lors de la lecture du dictionnaire');
            
            if (xhr.responseText != 'ok')
            	return false;
        }
	}
	xhr.send(null);
	
	
	// Le mot est t'il composé des caractères demandés ?
	randomLetters = '';
	for (j = 0; j < 9; j++)
	{
		randomLetters += document.getElementById("lettre" + j).innerHTML.toLowerCase();
	}
		
	for (i = 0; i < inputLetters.value.length; i++)
	{
		n = randomLetters.indexOf(mot.charAt(i));
		if (n != -1)
			randomLetters = randomLetters.replace(randomLetters.charAt(n), '');
		else
			return false;
	}

	return true;
}

function addPoints(points)
{
	score += points;
	document.getElementById("score").innerHTML = 'Score : '+score;
}
</script>

<footer>
Application développée par <a href="mailto:lancelot.chardonnet@gmail.com">Lancelot Chardonnet</a> et inspirée de l'émission <a href="http://programmes.france3.fr/des-chiffres-et-des-lettres">Des chiffres et de lettres</a> de France 3.<br />
<? echo "Dernière mise à jour effectuée le " . date ("d/m/y", getlastmod()) . "."; ?> 
</footer>


</body>
</html>