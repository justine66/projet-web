<?php
		
		 if(file_exists("ResultatsFestival.csv")){
				$fichierT=fopen("ResultatsFestival.csv","r"); 
				$tailleL = count(file("ResultatsFestival.csv"));
				$boucle=fgetcsv($fichierT,10000,",");
				$prog = array();
				$nbColonnes=count($boucle);

				for($i = 0 ; $i < $tailleL - 1 ; $i++){
					$boucle=fgetcsv($fichierT,10000,",");
					$prog[$i]['compagnie'] = $boucle[5];
					$prog[$i]['p'] = $boucle[6];
					$prog[$i]['r'] = $boucle[7];
					$prog[$i]['o'] = $boucle[8];
					$prog[$i]['sJ'] = $boucle[9];
					$prog[$i]['sA'] = $boucle[10];
					$prog[$i]['E'] = $boucle[11];
				}
				$columns = array_column($prog, 'compagnie');
				array_multisort($columns, SORT_ASC, $prog);
		 }else {
                   echo '<p>le fichier existe pas</p>';
         }
		echo json_encode ($prog);
		//echo json_encode ($data);
?>
