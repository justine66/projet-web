<!DOCTYPE html>
<html>
<head>
	<title> Graph </title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="ju3.css"> 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
    </script>
    <script src="JS/graphe.js">
    </script>
   
</head>

<body onload= init()>
				
				<span id="cpth"></span>	
				</br>
				<h1> Graphique des finances :</h1>
				<div class="decalage30">
				<div class= "canvas" overflow ="scroll">					
				<canvas id="myCanvas"></canvas>
				<span id="c"></span>	
				</div>
				</div>
				</br>
				
	<div class="decalage30">	
		<button name='compagnie' value='Compagnie' onclick="troup('compagnie')")>Compagnie</button>
		<button name='lieu' value='Lieu' onclick="troup('lieu')")>Lieu</button>
		<button name='titre' value='spectacle' onclick="troup('titre')")>Spectacle</button>
	</div>
	</br>
</body>
</html>
