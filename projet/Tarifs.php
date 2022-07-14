<!DOCTYPE html>
<html>
<head>
	<title> Tarif Theatres de Bourbon </title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="ju3.css"> 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
    </script>
    <script src= "JS/Tarif.js">
    </script>
    



</head>
<body onload = init()>
	<span id="cpth" ></span>
	<div>
	<span id="cpthp" ></span>
    </div>
     
     <!--<h1 >Rappel des distances entre chaque lieu de représentation</h1>
     <div class="decalage">
	<table > 
		<tr> 	<th></th>		          <th>Moulins</th> 	   <th>Monétay</th> 	<th>Vichy</th>       <th>Monteignet</th>  <th>Veauce</th>     <th>Clermont-Ferrand</th> </tr>
		<tr> 	<th>Moulins</th>          <td>0</td> 	       <td>25km/30mins</td> <td>69km/1h10</td>   <td>91km/1h05</td>   <td>91km/1h08</td>  <td>98km/1h37</td>        </tr>
		<tr> 	<th>Monétay</th>          <td>25km/30mins</td> <td>0</td>           <td>39km/45min</td>  <td>33km/36min</td>  <td>45km/42min</td> <td>107km/1h20</td>       </tr>
		<tr> 	<th>Vichy</th>	          <td>69km/1h10</td>   <td>39km/45min</td>  <td>0</td>           <td>18km/26min</td>  <td>54km/58min</td> <td>56km/1h05</td>        </tr>
		<tr> 	<th>Monteignet</th>       <td>91km/1h05</td>   <td>33km/36min</td>  <td>18km/26min</td>  <td>0</td>           <td>22km/26min</td> <td>50km/55min</td>       </tr>
		<tr> 	<th>Veauce</th> 	      <td>91km/1h08</td>   <td>45km/42min</td>  <td>54km/58min</td> <td>22km/26min </td>  <td>0</td>          <td>54km/45min</td>       </tr>
		<tr> 	<th>Clermont-Ferrand</th> <td>98km/1h37</td>   <td>107km/1h20</td>  <td>56km/1h05</td> <td>50km/55min</td>    <td>54km/45min</td> <td>0</td>                </tr>
	</table>
	</div>-->
     <h1>Billeterie</h1>
     <div class="decalage30" id= "button">
		
		<div>Tarif réduit : -26 ans, chomeurs, handicapés <br> Tarif enfant: -12 ans <br> Un billet offert pour 5 billets achetés </div>
		<br>
		<button> <img src="images/plus.png" width= 40% height = 10% onclick="add(init2)"></button>
		<button> <img src="images/poubelle2.png" width= 40% height = 10% onclick="remove()"></button>
		<br><br>
		<span id="cpths" ></span>
		<br><br>
		<span id="tot" ></span>
		<br><br>
		<input type="button" value="Tout valider" onclick="toutvalider()"></input>
		
	</div>	
	
</body>
