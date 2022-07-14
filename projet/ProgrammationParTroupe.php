<!DOCTYPE html>
<html>
<head>
	<title> Par spectacle Theatres de Bourbon </title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="ju3.css"> 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="JS/bandeau.js"></script>



</head>
<body onload = init()>
	<?php
    echo ' <span id="cpth" ></span>';
     
     ?>
	
	   <?php

            if(file_exists("ResultatsFestival.csv")){
				$fichierT=fopen("ResultatsFestival.csv","r"); 
				$tailleL = count(file("ResultatsFestival.csv"));
				$boucle=fgetcsv($fichierT,10000,",");
				$prog = array();
				$nbColonnes=count($boucle);
				for($i = 0 ; $i < $tailleL - 1 ; $i++){
					$boucle=fgetcsv($fichierT,10000,",");
					$prog[$i]['date'] = $boucle[0];
					$prog[$i]['heure'] = $boucle[1];
					$prog[$i]['titre'] = $boucle[2];
					$prog[$i]['lieu'] = $boucle[3];
					$prog[$i]['village'] = $boucle[4];
					$prog[$i]['compagnie'] = $boucle[5];
				}
				
				$columns = array_column($prog, 'compagnie');
				array_multisort($columns, SORT_ASC, $prog);
				
				$troupe = $prog[0]['compagnie'];
				echo '<div class="decalage">';
				echo '<div class=Lieu>';
				echo '<h2>' .$troupe. '</h2>';
				
				echo '<p>';
                echo $prog[0]['date'];
                echo ", ";
                echo $prog[0]['heure'];
                echo ", ";
                echo $prog[0]['titre'];
                echo ", ";
                echo $prog[0]['lieu'];
                echo ", ";
                echo $prog[0]['village'];
                echo '</p>';
                for($j = 1; $j < $tailleL - 1; $j++) {
					if($prog[$j]['compagnie']!=$troupe){
						echo'</div>';//class=lieu
						$troupe = $prog[$j]['compagnie'];
						echo '<div class=Lieu>';
						echo '<h2>' .$troupe. '</h2>';
					}
					echo '<p>';
                echo $prog[$j]['date'];
                echo ", ";
                echo $prog[$j]['heure'];
                echo ", ";
                echo $prog[$j]['titre'];
                echo ", ";
                echo $prog[$j]['lieu'];
                echo ", ";
                echo $prog[$j]['village'];
                echo '</p>';
                }
                fclose($fichierT);
            } else {
				echo '<p>le fichier existe pas</p>';
			}
                ?>	

 
</body>
