<!DOCTYPE html>
<html>
<head>
	<title> Par Lieu Theatres de Bourbon </title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="ju3.css"> 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="JS/bandeau.js"></script>


</head>
<body onload= init()>
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
				
				$columns = array_column($prog, 'lieu');
				array_multisort($columns, SORT_ASC, $prog);
				
				$endroit = $prog[0]['lieu'];
				$commune = $prog[0]['village'];
				echo '<div class="decalage">';
				echo '<br>';
				echo ' <img
                            src="images/kje.jpg"
                            alt="[ L\'image n\'est pas dans le fichier ]"
                            
                            
                            
                            
                    >';
				echo '<div class=Lieu>';
				echo '<h2>' .$endroit. ', ' . $commune . '</h2>';
				echo ' <img class="vignette"
                            src="images/'.$endroit.'.jpg"
                            alt="[ L\'image n\'est pas dans le fichier ]"
                            width=150px
                            height=200px
                            
                    >';
                
				echo '<p>';
				echo '<b> Le Programme :</b> <br><br>';
                echo $prog[0]['date'];
                echo ", ";
                echo $prog[0]['heure'];
                echo ", ";
                echo $prog[0]['titre'];
                echo ", ";
                echo $prog[0]['compagnie'];
                
                echo '</p>';
                
                for($j = 1; $j < $tailleL - 1; $j++) {
					if($prog[$j]['lieu']!=$endroit){
					echo'</div>';//class=lieu
					$endroit = $prog[$j]['lieu'];
					$commune = $prog[$j]['village'];
					echo '<div class=Lieu>';
					echo '<h2>' .$endroit. ', ' . $commune . '</h2>';
					
					echo ' <img class="vignette"
                             src="images/'.$endroit.'.jpg"
                            alt="[ L\'image n\'est pas dans le fichier]"
                            width=150px
                            height=200px
                            
                    >';
                    echo '<p><b> Le Programme :</b> <br><br></p>';
					}
					echo '<p>';
                echo $prog[$j]['date'];
                echo ", ";
                echo $prog[$j]['heure'];
                echo ", ";
                echo $prog[$j]['titre'];
                echo ", ";
                echo $prog[$j]['compagnie'];
                echo '</p>';
               
                }
                
                fclose($fichierT);
            } else {
				echo '<p>le fichier existe pas</p>';
			}

			echo '</div>';
                ?>
</body>
