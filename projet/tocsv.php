<!DOCTYPE html>
<html>
<head>
	<title> Tarif Theatres de Bourbon </title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="ju3.css"> 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
    </script>
    <script src= "JS/bandeau.js">
    </script>


</head>
<body onload="init()" >
	<span id="cpth" ></span>

 	<?php
 	echo '<div class = "decalage30">';
 	
 		$id = $_POST["identifiant"];
 		for ($i=0 ; $i<=$id ; $i++){
 			
	 		$spectacle[$i] = $_POST["spectacle".$i];
	 		$jour[$i] = $_POST["day".$i];
	 		$heure[$i] = $_POST["hour".$i];
	 		$lieu[$i] = $_POST["place".$i];
	 		$tp[$i] = $_POST["Tarifplein".$i];
	 		$tr[$i] =$_POST["Tarifreduit".$i];
	 		$te[$i] = $_POST["Tarifenfant".$i];
	 		$to[$i] = $_POST["offertes".$i];
	 		

 		}
 		if(file_exists("ResultatsFestival.csv")){
			$fichierT=fopen("ResultatsFestival.csv","r");
			$tailleL = count(file("ResultatsFestival.csv"));  
			//$boucle=fgetcsv($fichierT,10000,",");
			//$boucle=fgetcsv($fichierT,10000,",");
			$prog = array();
			
			for($i = 0 ; $i < $tailleL  ; $i++){
				$boucle=fgetcsv($fichierT,10000,",");
				$prog[$i]['date'] = $boucle[0];
				$prog[$i]['heure'] = $boucle[1];
				$prog[$i]['titre'] = $boucle[2];
				$prog[$i]['lieu'] = $boucle[3];
				$prog[$i]['village'] = $boucle[4];
				$prog[$i]['compagnie'] = $boucle[5];
				$prog[$i]['p'] = $boucle[6];
				$prog[$i]['r'] = $boucle[7];
				$prog[$i]['o'] = $boucle[8];
				$prog[$i]['sJ'] = $boucle[9];
				$prog[$i]['sA'] = $boucle[10];
				$prog[$i]['E'] = $boucle[11];
			}
			
		} else {
			echo '<p>le fichier existe pas</p>';
		}
		//echo "test";
		for ($i=0 ; $i<=$id ; $i++){
			for($j = 1 ; $j < $tailleL ; $j++){
				if($prog[$j]['date']==$jour[$i]){
					if ($prog[$j]['heure']==$heure[$i]){
						if($prog[$j]['titre']==$spectacle[$i]){
							if (intval($to[$i])>0){
								if(intval($tr[$i])>=intval($to[$i])){
									$prog[$j]['r'] = intval($prog[$j]['r']) + intval($tr[$i])-intval($to[$i]) ;
									$prog[$j]['p'] = intval($prog[$j]['p']) + intval($tp[$i]);
									$prog[$j]['E'] = intval($prog[$j]['E']) + intval($te[$i]);
									$prog[$j]['o'] = intval($prog[$j]['o']) + intval($to[$i]);

								}else{

									$prog[$j]['p'] = intval($prog[$j]['p']) + intval($tp[$i])-intval($tr[$i])-intval($to[$i]) ;
									$prog[$j]['E'] = intval($prog[$j]['E']) + intval($te[$i]);
									$prog[$j]['o'] = intval($prog[$j]['o']) + intval($to[$i]);
								}
							}else{
							$prog[$j]['p'] = intval($prog[$j]['p']) + intval($tp[$i]);
							$prog[$j]['r'] = intval($prog[$j]['r']) + intval($tr[$i]);
							$prog[$j]['E'] = intval($prog[$j]['E']) + intval($te[$i]);
							}
						}
					}
				}
			}
		}

 		if(file_exists("ResultatsFestival.csv")){
				$fichierT=fopen("ResultatsFestival.csv","w"); 
				/*for($j = 0 ; $j < $tailleL - 1 ; $j++){
				    $line = '"';
				    $line .= implode('","', $prog[$j]);
				    $line .= '"';
				    $line .= "\r\n";
				 
				     $fichierT->fwrite($line);
				}*/
				for($j = 0 ; $j < $tailleL ; $j++){
					fputcsv($fichierT, $prog[$j], ',');
				}
				echo '<h1>prise en compte de votre reservation</h1>';
		 }else {
                   echo '<p>le fichier existe pas</p>';
         }
        echo '</div>';
 	?>
</body>