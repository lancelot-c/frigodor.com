<header>
	<table>
		<tr>
			<td rowspan="2" style="vertical-align:top;min-width:420px;padding-left:30px;padding-top:30px;">
				<a href="index.php"><img src="banniere.png" style="margin-bottom:7px;" /></a><br />
				<span id="prob"><u>Problématique :</u> Dans quelle mesure la 3D a-t-elle révolutionné le monde cinématographique ?</span>
			</td>
			
			<td style="vertical-align:middle;text-align:right;padding:5px 0px;padding-right:65px;padding-top:40px;width:100%;height:100%;">
				Lycée Saint Erembert - Année 2010/2011<br />
				TPE réalisé par Lancelot Chardonnet, Nicolas Lequin et Arthur Ringot
			</td>
		</tr>
		<tr>
			<td style="vertical-align:bottom;padding:0px 0px;padding-right:30px;min-height:150px;">
				<div id="hr"><hr /></div>
				<nav>
						<?php
						function endsWith($str, $sub) // return true if $str ends with $sub
						{
							return ( substr( $str, strlen( $str ) - strlen( $sub ) ) == $sub );
						}
						
						$lien1 = "vision.php";
						$lien2 = "procedes.php";
						$lien3 = "place.php";
						$lien4 = "annexes.php";
						
						$Bouton1_state = (endsWith($_SERVER['SCRIPT_FILENAME'], $lien1)) ? "on" : "off";
						$Bouton2_state = (endsWith($_SERVER['SCRIPT_FILENAME'], $lien2)) ? "on" : "off";
						$Bouton3_state = (endsWith($_SERVER['SCRIPT_FILENAME'], $lien3)) ? "on" : "off";
						$Bouton4_state = (endsWith($_SERVER['SCRIPT_FILENAME'], $lien4)) ? "on" : "off";
						?>
		
					<ul>
						<li class="<?php echo $Bouton1_state; ?>"><a href="<?php echo $lien1; ?>"><img src="eye.png" />La vision<br />en relief</a></li> 
						<li class="<?php echo $Bouton2_state; ?>"><a href="<?php echo $lien2; ?>"><img src="pigeon3d.png" />Les procédés<br />au cinéma</a></li> 
						<li class="<?php echo $Bouton3_state; ?>" style="width:160px;"><a href="<?php echo $lien3; ?>"><img src="video.png" />La place de la 3D<br>dans le cinéma</a></li>
						<li class="<?php echo $Bouton4_state; ?>"><a href="<?php echo $lien4; ?>"><img src="draw.png" />Annexes<br /><span style="font-size:0.8em;">(anaglyphes, lexique)</span></a></li> 
					</ul>
				</nav>
			</td>
		</tr>
	</table>
</header>