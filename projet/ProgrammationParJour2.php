<!DOCTYPE html>
<html>
<head>
	<title> Par Jour Theatres de Bourbon </title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="ju3.css"> 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
    </script>
    <script src="JS/bandeau.js"></script>


</head>
<body onload = init()>
	<?php
    echo ' <span id="cpth" ></span>';
     
     ?>
		
	<?php

		if(file_exists("ResultatsFestival.csv")){
			$fichierT=fopen("ResultatsFestival.csv","r");  
			$boucle=fgetcsv($fichierT,10000,",");
			$boucle=fgetcsv($fichierT,10000,",");
			$Jour = $boucle[0];
			echo '<div class="decalage">';
			echo '<div class=Lieu>';
			echo '<h2>' .$Jour. '</h2>';
			echo '<p>';
			$nbColonnes=count($boucle);
			for($i=1; $i<$nbColonnes-7; $i++){
				echo $boucle[$i]. ', ';
			}
			echo $boucle[$nbColonnes-7];
			echo '</p>';
			while(($boucle=fgetcsv($fichierT,10000,","))!==FALSE){
				if($boucle[0]!=$Jour){
				echo'</div>';//class=lieu
				$Jour = $boucle[0];
				echo '<div class=Lieu>';
				echo '<h2>' .$Jour. '</h2>';
									}
				$nbColonnes=count($boucle);
				echo '<p>';
				for($i=1; $i<$nbColonnes-7; $i++){
					echo $boucle[$i]. ', ';
				}
				echo $boucle[$nbColonnes-7];
				echo '</p>';
			}
			fclose($fichierT);
		} else {
							echo '<p>le fichier existe pas</p>';
					}
	echo '</div>';
			?>
	<br>
</body>
