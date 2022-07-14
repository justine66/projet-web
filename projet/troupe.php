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

				$data = array();
					for($i = 0 ; $i < sizeof($prog) - 1 ; $i++){
					
					if (in_array($prog[$i]['compagnie'], $data)){
						$data[$prog[$i]['compagnie']]['p']  += $prog[$i]['p']; 
						$data[$prog[$i]['compagnie']]['r']  += $prog[$i]['r']; 
						$data[$prog[$i]['compagnie']]['o']  += $prog[$i]['o']; 
						$data[$prog[$i]['compagnie']]['sJ'] += $prog[$i]['sJ']; 
						$data[$prog[$i]['compagnie']]['sA'] += $prog[$i]['sA']; 
						$data[$prog[$i]['compagnie']]['E']  += $prog[$i]['E'];
				} else {
						array_push($data, ['compagnie'=> $prog[$i]['compagnie'], 
											'p' => $prog[$i]['p'],
											'r' => $prog[$i]['r'],
											'a' => $prog[$i]['o'],
											'sJ'=> $prog[$i]['sJ'],
											'sA'=> $prog[$i]['sA'],
											'E' => $prog[$i]['E']
										]);
					 }
					}
		
		 }else {
                   echo '<p>le fichier existe pas</p>';
         }
		echo json_encode ($prog);
		//echo json_encode ($data);
?>
