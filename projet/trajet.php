<?php
		
		 if(file_exists("Lieu.csv")){
				$fichierT=fopen("Lieu.csv","r"); 
				$tailleL = count(file("Lieu.csv"));
				$boucle=fgetcsv($fichierT,10000,",");
				$prog = array();
				$nbColonnes=count($boucle);
				for($i = 0 ; $i < $tailleL - 1 ; $i++){
					$boucle=fgetcsv($fichierT,10000,",");
					$prog[$i]['lieu'] = $boucle[0];
					$prog[$i]['Moulins'] = $boucle[1];
					$prog[$i]['Monétay sur Allier'] = $boucle[2];
					$prog[$i]['Vichy'] = $boucle[3];
					$prog[$i]["Monteignet sur l'Andelot"] = $boucle[4];
					$prog[$i]['Veauce'] = $boucle[5];
					$prog[$i]['Clermont-Ferrand'] = $boucle[6];
				}
				//$columns = array_column($prog, 'lieu');
				//array_multisort($columns, SORT_ASC, $prog);
		 }else {
                   echo '<p>le fichier existe pas</p>';
         }
		echo json_encode ($prog);
?>
