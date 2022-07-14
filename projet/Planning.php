	<?php
    //echo ' <span id="cpthp" ></span>';  
 
	echo '<div class="decalage30">';
		if(file_exists("ResultatsFestival.csv")){
			$fichierT=fopen("ResultatsFestival.csv","r");  
			$boucle=fgetcsv($fichierT,10000,",");
			$boucle=fgetcsv($fichierT,10000,",");
			$Jour = $boucle[0];
			echo '<div class="jourEntier">';
			echo '<h2>' .$Jour. '</h2>';
			echo '<div class=emballage>';
			$cpt = 0;
			$cpt2 = 0;
			$id =0;
			while(($boucle=fgetcsv($fichierT,10000,","))!==FALSE){
				if($boucle[0]!=$Jour){
				$Jour = $boucle[0];
				while ($cpt != 3){ // pour remplire la colone en cours
					echo '<div class="shadowboxVide">'; 
					echo'</div>';
					$cpt++;
				}
				
				echo'</div>';
				while ($cpt2 != 3){ // pour avoir 4 colones par jour
					echo '<div class=emballage>';
					echo '<div class="shadowboxVide">'; 
					echo'</div>';
					echo '<div class="shadowboxVide">'; 
					echo'</div>';
					echo '<div class="shadowboxVide">'; 
					echo'</div>';
					echo'</div>';
					$cpt2++;
				}
				echo '</div>';
				echo '<div class="jourEntier">';
				echo '<h2>' .$Jour. '</h2>';
				echo '<div class=emballage>';
				$cpt=0;
				$cpt2=0;
				}
				if ($cpt  == 3){
					echo '</div>';
					echo '<div class=emballage>';
					$cpt=0;
					$cpt2++;
				}
				$cpt++;
				$nbColonnes=count($boucle);
                echo '<div onclick="update(this.id)" id = "Planning'.$id.'" class="shadowboxNormal">';   
						$id ++ ;
                echo '<horaire>';   // jour
                echo $Jour." ";
                echo'</horaire>';             
                echo '<horaire>';   // heure
                echo $boucle[1];
                echo'</horaire>'; 
                echo '</br>';
                echo '<lieu>';   	// lieu
                echo $boucle[4];
                echo'</lieu>';    
                echo '</br>'; echo '</br>';                   
                echo '<div class="boutonAEnfoncer">Choisir'; //bouton
                echo'</div>';           
                echo '<titreSpectacle>';   //titre
                echo $boucle[2];
                echo'</titreSpectacle>';    	
                echo'</div>';   
			}
			while ($cpt != 3){ // pour remplire la colone en cours
					echo '<div class="shadowboxVide">'; 
					echo'</div>';
					$cpt++;
				}
				echo'</div>';
				while ($cpt2 != 3){ // pour avoir 4 colones par jour
					echo '<div class=emballage>';
					echo '<div class="shadowboxVide">'; 
					echo'</div>';
					echo '<div class="shadowboxVide">'; 
					echo'</div>';
					echo '<div class="shadowboxVide">'; 
					echo'</div>';
					echo'</div>';
					$cpt2++;
				}
			fclose($fichierT);
		} else {
		echo '<p>Le fichier n\'existe pas</p>';
					}
      echo '</div>';
      echo'</div>'
?>

