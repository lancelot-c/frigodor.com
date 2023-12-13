<!DOCTYPE html>
<html>
<head>
	<title>Solveur de Sudoku</title>
	<meta charset="utf-8"> 
	<link href="numbers.png" rel="icon" type="image/x-icon" />
  	<style type="text/css">
  		body {
  		background:#292931;
  		font-family: "Trebuchet MS", Verdana, Tahoma, sans-serif;
  		font-size: 0.8em;
  		margin: auto;
  		padding-top:70px;
  		width:70%;
  		}
  		form{
  		text-align: center;
  		float:left;
  		}
  		input[type="submit"], input[type="button"], select {
  		font-size: 1.3em;
  		}
  		#grille {
  		background: url("grille.png") center no-repeat;
  		opacity: 0.9;
  		}
  		label {
  		font-size:0.8em;	
  		}
  		#panel {
  		background-color: #423142;
  		background-image: url("gradient.png");
  		background-position: top;
  		background-repeat: repeat-x;
  		color: white;
  		width: 230px;
  		padding: 15px;
  		margin-left: 500px;
  		text-align:left;
  		}
  		.case { 
  		text-align: center;
  		padding: 0px;
  		margin: 0px;
  		background: transparent;
  		border:none;
  		font-size: 1.3em;
  		height: 48px;
  		width: 48px;
  		}
  		.case:focus {
  		}
  		footer {
  		color: white;
  		font-size: 0.85em;
  		text-align: center;
  		padding: 15px 0px;
  		}
  		footer a {
  		color: white;
		text-decoration: none;
		}
  	</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="http://www.frigodor.com/Sudoku/js/highcharts.js" type="text/javascript"></script>
<script type="text/javascript" src="http://www.frigodor.com/Sudoku/js/themes/gray.js"></script>
</head>
<body>

<?php
init();

function init()
{
	global $grille, $nbPos, $nbSteps, $possibilities, $ordre, $chrono, $nbCases, $nbPossibilitees;
	$nbPos = array();
	$nbCases = 0;
	$nbPossibilitees = 0;
	$chrono = 0;
	
	// Transmition des valeurs POST
	for ($i = 0; $i <= 80; $i++)
	{
		if (!empty($_POST[$i])) {
			$grille[$i] = htmlspecialchars($_POST[$i]);
			$nbCases++;
		}
		else {
			$grille[$i] = 0;
		}
		
		if (!(ord($grille[$i]) >= 48 AND ord($grille[$i]) <= 57))
			alert("La grille ne doit contenir que des chiffres.");
	}
	
	// Si la grille n'est pas vide on la résoud
	if (array_sum($grille) > 0)
	{
		initPossibilities();
		$start = microtime(true);
		solve();
		$end = microtime(true);
		$chrono = $end - $start;
		$nbPossibilitees = array_sum($nbPos);
		
		//Enregistrement BDD
		mysql_connect("localhost", "wb58981", "m5oe8mri");
		mysql_select_db("wb58981");
	
		$requete = mysql_query("SELECT * FROM sudoku WHERE nbCasesRemplies='$nbCases'");
		
		if (mysql_num_rows($requete) == 0) {
			mysql_query("INSERT INTO sudoku VALUES('$nbCases', '$nbPossibilitees', '$nbSteps', '$chrono', '1')");
		}
		else if (mysql_num_rows($requete) == 1)
		{
			$requete2 = mysql_query("SELECT * FROM sudoku WHERE nbCasesRemplies='$nbCases'");
			
			while ($reponse2 = mysql_fetch_array($requete2))
			{
				$p = $reponse2['nbPossibiliteesMoyen'];
				$s = $reponse2['nbPasMoyen'];
				$t = $reponse2['tempsMoyen'];
				$c = $reponse2['compteur'];
	
				mysql_query("UPDATE sudoku SET nbPossibiliteesMoyen='".($p*$c+$nbPossibilitees)/($c+1)."', nbPasMoyen='".($s*$c+$nbSteps)/($c+1)."', tempsMoyen='".($t*$c+$chrono)/($c+1)."', compteur='".($c+1)."' WHERE nbCasesRemplies='$nbCases'");
			}
		}
		 
		mysql_close();
	}
}

function initPossibilities()
{
	global $grille, $possibilities, $ordre, $nbPos;
	$possibilities = array();
	
	// Calcul du nombre de possibilitées pour chaque case
	for ($i = 0; $i <= 80; $i++)
	{						
		if (empty($grille[$i]))
		{
			for ($n = 1; $n <= 9; $n++)
				$possibilities[$i][$n] = 1;
					
			// *** Parcours de la Ligne ***
			for ($j = $i-($i%9); $j < $i-($i%9)+9; $j++)
				$possibilities[$i][$grille[$j]] = 0;
				
			// *** Pourcours de la Colonne ***
			for ($j = $i%9; $j < 81; $j+=9)
				$possibilities[$i][$grille[$j]] = 0;
				
			// *** Parcours du Carré ***
			$rowCase = floor($i/9);
			$colCase = $i%9;
			$rowFirstCase = $rowCase - ($rowCase%3);
			$colFirstCase = $colCase - ($colCase%3);
			for ($r = $rowFirstCase; $r < $rowFirstCase+3; $r++)
				for ($c = $colFirstCase; $c < $colFirstCase+3; $c++)
					$possibilities[$i][$grille[($r*9) + $c]] = 0;
		}
		else
		{			
			for ($n = 1; $n <= 9; $n++)
				$possibilities[$i][$n] = 0;
			$possibilities[$i][$grille[$i]] = 1;
		}
	}
}	

function solve()
{
	global $grille, $nbPos, $nbSteps, $possibilities, $ordre, $value, $oldPos;
	$nbSteps = 0;
	$oldPos = array();
	$oldPosBacktrackCase = array();
	
	for ($i = 0; $i <= 80; $i++) {
		$nbPos[$i] = 0;
		for ($n = 1; $n <= 9; $n++) {
			if ($possibilities[$i][$n] == 1)
				$nbPos[$i]++;
		}
	}
	
	// On trie les cases par nombre de possibilitées croissant puis on les assigne à $ordre			
	asort($nbPos);
	$ordre = array();
	foreach ($nbPos as $key => $val)
		if (empty($grille[$key])) //Permet de ne pas faire de backtracking sur les cases initialement remplies
			array_push($ordre, $key);

	
	$notPossibleValue = 0;
	$backtracking = array();
	
	for ($i = 0; $i < count($ordre); $i++)
	{
		$nbSteps++;
		$currentCase = $ordre[$i];
		$value = 0;
		
		for ($j = $notPossibleValue+1; $j <= 9; $j++)
		{						
			if ($possibilities[$currentCase][$j] == 1)
			{
				$value = $j;	
				break;	
			}
		}
			
		// On avance dans la grille
		if (!empty($value))
		{
			array_push($backtracking, $currentCase);
			$grille[$currentCase] = $value;
			
			$notPossibleValue = 0;
			updatePossibilities($currentCase, $value, false);
		}
		else
		{
// Si on ne peut plus retourner en arrière, on a testé toutes les possibilitées sans arriver à une grille valide donc la grille est impossible
			if (count($backtracking) == 0)
			{
				alert("La grille est impossible à résoudre.");
				break;
			}
			
			// Sinon on revient en arrière
			$lastBacktrack = array_pop($backtracking);
			$notPossibleValue = $grille[$lastBacktrack];
			$i = array_search($lastBacktrack, $ordre)-1;
			$grille[$lastBacktrack] = 0;
			
			updatePossibilities($lastBacktrack, $notPossibleValue, true);
		}
	}
}

function updatePossibilities($case, $value, $isBacktracking)
{
	global $grille, $nbPos, $possibilities, $ordre, $oldPos, $oldPosBacktrackCase;
	
	// Si on revient en arrière, la valeur est à nouveau disponible pour les cases aux alentours
	if ($isBacktracking)
	{
		$possibilities = $oldPos[$case];
		
		//foreach ($oldPos[$case] as $caseAlentour => $v)
		//{	
		//	$possibilities[$caseAlentour][$value] = $v;
		//}
		
		//for ($n = 1; $n <= 9; $n++)
		//	$possibilities[$case][$n] = $oldPosBacktrackCase[$case][$n];
	}
	else // Si on avance dans le backtracking, une valeur est assignée à une case donc les cases aux alentours ne pourront pas avoir cette valeur
	{	
		$oldPos[$case] = $possibilities;
		
		
			// *** Parcours de la Ligne ***
			for ($k = $case-($case%9); $k < $case-($case%9)+9; $k++) {
				//$oldPos[$case][$k] = $possibilities[$k][$value];
				$possibilities[$k][$value] = 0;
			}
				
			// *** Pourcours de la Colonne ***
			for ($k = $case%9; $k < 81; $k+=9) {
				//$oldPos[$case][$k] = $possibilities[$k][$value];
				$possibilities[$k][$value] = 0;
			}
			
			// *** Parcours du Carré ***
			$rowCase = floor($case/9);
			$colCase = $case%9;
			$rowFirstCase = $rowCase - ($rowCase%3);
			$colFirstCase = $colCase - ($colCase%3);
			for ($r = $rowFirstCase; $r < $rowFirstCase+3; $r++) {
				for ($c = $colFirstCase; $c < $colFirstCase+3; $c++) {
					//$oldPos[$case][(($r*9)+($c))] = $possibilities[(($r*9)+($c))][$value];
					$possibilities[(($r*9)+($c))][$value] = 0;
				}
			}
		
		
		for ($n = 1; $n <= 9; $n++) {
			//$oldPosBacktrackCase[$case][$n] = $possibilities[$case][$n];
			$possibilities[$case][$n] = 0;
		}
		$possibilities[$case][$value] = 1;
	}
}

function alert($message)
{
	echo '<script>alert("'.$message.'");</script>';
}
?>

<form action="solveur.php" method="post">

	<div id="grille"><?php
		for ($i = 0; $i <= 80; $i++)
		{
	?><input type="text" value="<?php if (!empty($grille[$i])) echo $grille[$i]; ?>" name="<?php echo $i; ?>" pattern="[0-9]{1}" maxlength="1" class="case" /><?php
		if ($i%9 == 8)
			echo "<br />";
		}
	?></div><br />
	
	<input type="submit" value="Résoudre la grille" />
	<select name="generate" onChange="generateGrid(this)">
		<option value="title"  selected>Générer une grille</option>
		<option value="empty">vide</option>
		<option value="alea">aléatoire</option>
		<option value="escargot">AI Escargot</option>
	</select>
</form><br /><br />


<div id="panel">
	<?php 
	if (!empty($chrono)) {
		echo "Temps de résolution : ";
			
		if ($chrono < 1)
			echo (round($chrono, 3)*1000).' ms';
		else
			echo round($chrono, 3).' sec';
			
		echo '<br />Nombre d\'opérations : '.$nbSteps.'<br />';
	}
	else {
	echo "Le graphique ci-dessous représente le temps moyen de résolution d'une grille en fonction du nombre de cases initialement remplies.";
	}
	?>
</div>
<img src="fleche.png" style="margin-left:100px;margin-bottom:4px;"/><br />

<script type="text/javascript">
function generateGrid(select)
{
	var type = select.options[select.selectedIndex].value;
	select.selectedIndex = 0;
	
	if (type == "empty")
	{
		var sudoku = '';
	}
	else if (type == "alea")
	{
		var grilles = ['601000007873400000000600930700015000200000008000270006057003000000009753900000402'];
		var sudoku = grilles[randNb(grilles.length-1)];
		sudoku = shuffleGrid(sudoku);
	}
	else if (type == "escargot")
	{
		var sudoku = '100007090030020008009600500005300900010080002600004000300000010040000007007000300';
	}
	
	for (i=0; i<=80; i++)
		document.getElementsByName(i)[0].value = (sudoku.charAt(i).length == 1 && sudoku.charAt(i) != '0') ? sudoku.charAt(i) : '';
}

function shuffleGrid(grid)
{
	// PERMTUTATIONS POSSIBLES
		// 0. Bandes
		// 1. Piles
		// 2. Lignes d'une bande
		// 3. Colonnes d'une pile
		// 4. Rotation
		// 5. Symétries horizontale, verticale, diagonale (?)
		// 6. Echange de chiffre
		// 7. Ajout de n à chaque case non vide
	
	
	for (level = randNb(4); level > 0; level--)
	{
		var newGrid = '';
		var permu = randNb(7);
		
		if (1)	// #6
		{
			var first = randNb(8) + 1;
			do { var second = randNb(8) + 1; } while (second == first);
			
			for (i=0; i<=80; i++)
			{
				if (grid.charAt(i) == first)
					newGrid += second;
				else if (grid.charAt(i) == second)
					newGrid += first;
				else
					newGrid += grid.charAt(i);
			}
		}
		else if (permu == 7) // #7
		{
			var add = randNb(7) + 1;
			for (i=0; i<=80; i++)
			{
				if (grid.charAt(i) != '0')
					newGrid += (parseInt(grid.charAt(i))+add)%9;
				else
					newGrid += '0';
			}
		}
		
		grid = newGrid;
	}
	
	return grid;
}

function randNb(max)
{
	return Math.round(Math.random()*max);	
}



//Création du graphique
var chart;
$(document).ready(function() {
   chart = new Highcharts.Chart({
      chart: {
         renderTo: 'graphique',
         type: 'spline',
         backgroundColor: '#292931',
         marginRight: 0,
         zoomType: 'xy'
      },
      title: {
         text: '',
         align: 'right',
         verticalAlign: 'top'
      },
      xAxis: {
         title: {
            text: 'Nombre de cases initialement remplies'
         },
         showLastLabel: true,
         min: 0,
         max: 81
      },
      yAxis: {
         title: {
            text: 'Temps de résolution (en s)'
         },
         min: 0
      },
      tooltip: {
         formatter: function() {
         return ''+ Math.round(this.y*1000)/1000 +'s'; // pour '+ this.x +' case'+ ((this.x > 1) ? "s" : "") +'';
         }
      },
      legend: {
         enabled: false
      },
      series: [{
         name: 'temps = f(cases)',
         data: [<?php
         		mysql_connect("localhost", "wb58981", "m5oe8mri");
				mysql_select_db("wb58981");
         		$requete = mysql_query("SELECT * FROM sudoku ORDER BY nbCasesRemplies");
			
				while ($reponse = mysql_fetch_array($requete))
				{
					echo "[".$reponse['nbCasesRemplies'].", ".$reponse['tempsMoyen'].'], ';
				}
				mysql_close();
         		?>]
      }]
   });
   
   
});
</script>
<div id="graphique" style="width: 330px; height: 250px;margin-left:480px;"></div>
<div style="background:#292931;position:relative;top:-15px;left:720px;width:100px;min-height:13px;"></div>
<br /><br /><br /><br /><br /><br />


<footer>
Application développée par <a href="mailto:lancelot.chardonnet@gmail.com">Lancelot Chardonnet</a><br />
<? echo "Dernière mise à jour effectuée le " . date ("d/m/y", getlastmod()) . ""; ?> 
</footer>
</body>
</html>