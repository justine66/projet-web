var nb_form = 0;
//var bool = true;        
        
        function init(){

            $.ajax({async:false, url: "menu-bandeau.php", success: function (result){
				 //console.log("menu-bandeau");
                 $cpth = result;
                 $("#cpth").html(result);
                
               }, error : function(){ console.log("erreur");}});

            $.ajax({async:false, url: "Planning.php", success: function (result){
				 //console.log("menu-bandeau");
                 $cpthp = result;
                 $("#cpthp").html(result);
                
               }, error : function(){ console.log("erreur");}});
            spec(init2);
            total();
            total_all();
         }
        //partie billeterie
         function donnees(){
         	console.log("donnée");
			let result = [];
			
			for(i=0; i<=nb_form;i++){
				let ligne = [];
				if(document.getElementById("contain"+i)!=null){
					let s = document.getElementById("contain"+i).value;
					//console.log("s:"+s);
					ligne.push(s);
				}else {ligne.push('n'+i);}
				if(document.getElementById("day"+i)!=null){
					let j = document.getElementById("day"+i).value;
					//console.log("jour:"+j);
					ligne.push(j);
				}else {ligne.push('n'+i);}
				if(document.getElementById("hour"+i)!=null){
					let h = document.getElementById("hour"+i).value;
					//console.log("heure:"+h);
					ligne.push(h);
				}else {ligne.push('n'+i);}
				if(document.getElementById("place"+i)!=null){
					let e = document.getElementById("place"+i).value;
					//console.log("place:"+e);
					ligne.push(e);
				}else {ligne.push('n'+i);}
				/**if(document.getElementById("Tarifplein"+i)!=null){
					var tp = document.getElementById("Tarifplein"+i).value;
					//console.log("tp:"+tp);
					result +=tp;
				}
				if(document.getElementById("Tarifreduit"+i)!=null){
					var tr = document.getElementById("Tarifreduit"+i).value;
					//console.log("tr:"+tr);
					result +=tr;
				}**/
				result.push(ligne);
				//console.log(ligne);
				
			}

			//console.log(result[0]);
			//console.log(result[1]);
			return(result);
		 }
		 
		 function Lieu(){
			 var l;
			 $.ajax({async:false, url: "trajet.php" , success: function(result){
				 l = JSON.parse(result);
				 //console.log("l"+l);
				 //console.log("lieu"+l[0]['lieu']);
				 
			 }, error : function(){l=0,console.log("erreur lieu");}});
			 return l; 
		 }
		 
		 function tab (s1,s2){
			 let l=Lieu();
			 for (i=0; i< l.length; i++){
				 if (l[i]['lieu'] = s1){return l[i][s2]}
			 }
		 }
		 
		 function Alert(id1){
		 	console.log("alert");
		 	let result=null;
		 	if (id1 == nb_form){
			 	if (nb_form>=1){ 
				 	let donnee = donnees();
				 	console.log(donnee[0][1]);
				 	console.log(donnee[1][1]);
				 	let l = Lieu();
				 	for (i=0; i<donnee.length;i++) {
						for (j=0; j<donnee.length; j++){

							if (j!=i){
								if (donnee[i][1] == donnee[j][1]){
									
									let h1 = donnee[i][2].split("h");
									h1.forEach(parseInt);
									let h2 = donnee[j][2].split("h");
									h2.forEach(parseInt);
									//console.log ('h'+h);
									if ( Math.max(h1[0]*60+h1[1]*1,h2[0]*60+h2[1]*1)-Math.min(h1[0]*60+h1[1]*1,h2[0]*60+h2[1]*1)<120)
										{alert('Attention!!! vous ne pourrez pas aller au spectacle '+donnee[i][0]+' et au spectacle '+donnee[j][0]+' car leur representation se chevauche.');

									}else{
										let s1 = donnee[i][3];
										s1 = s1.split(",")[1];
										let s2 = donnee[j][3];
										s2 = s2.split(",")[1];
										let p=tab(s1,s2);
										//console.log('p'+p);
										if (17<Math.min(h1[0],h2[0])+2<19)
											{p = p+0.1*p;}
										if (Math.min(h1[0]*60+h1[1]*1,h2[0]*60+h2[1]*1)+120+p>Math.max(h1[0]*60+h1[1]*1,h2[0]*60+h2[1]*1))
											{alert('Attention!!!\n Bonjour\nVous ne pourrez pas aller au spectacle '+donnee[i][0]+' et au spectacle '+donnee[j][0]+' car leur representation se chevauche.');
											}

									}
										
								}
							}
						}
					}
					
				}
				
			}
		 	
		 }
	

         function add(callback){
			 if (callback && typeof(callback) === "function") {
				nb_form ++;
				var field = callback();
				//console.log( "add" );
				document.getElementById("cpths").innerHTML += field;
				//console.log(document.getElementById('cpths'));
				
			}
			total_all();
		}
		
		function remove(){
			 var element = document.getElementById("form"+nb_form);
			 nb_form--;

			element.remove(element);
			total_all();
			
		}
		
		function total(id1){
			var total1 = 0;
			if(document.getElementById("Tarifplein"+id1)!=null){
				var tp = document.getElementById("Tarifplein"+id1).value;
				var tr = document.getElementById("Tarifreduit"+id1).value;
				
				total1 = tp*15+tr*10;
					i= (tp*1+tr*1);
					p=0;
					r=0;
					while (i>5){
						if (tr > 0) {
						total1-=10;
						tr--;
						r++;
						}
						else if (tp > 0)  {
						total1=total1-15;
						tp--;
						p++;
						}
						i-=6;
						
					}
				total1 =total1 +"€";
				//e= p*1+r*1;
				//total1+= "<br> vous avez "+e+" place(s) gratuite(s) <br> (P : " +p+" | R : "+r+" | E : 0)";

			}
			$("#tot"+id1).html(total1);
			total_all();
		}
		
		function total_all(){
			//console.log("total_all");
			let totala = 0;
			let nb_tp =0;
			let nb_tr =0;
			let where_tr = [];

			for(i=0; i<=nb_form;i++){
				document.getElementById("offertes"+i).value = 0;
				//console.log("debut for");
				if(document.getElementById("Tarifplein"+i)!=null){
					let tp = document.getElementById("Tarifplein"+i).value;
					//console.log("tp:"+tp);
					let tr = document.getElementById("Tarifreduit"+i).value;
					if (tr>0) {
						where_tr.push(i)
					}
					//console.log("tr:"+tr);
					let total1 = tp*15+tr*10;
				
					nb_tp += tp*1;
					//console.log("nb_tp"+nb_tp);
					nb_tr += tr*1;
					totala += total1;
				}
			}
			let j= (nb_tp*1+nb_tr*1);
			//console.log(j);
			p=0;
			r=0;
			while (j>5){
				if (nb_tr > 0) {
					totala-=10;
					nb_tr--;
					r++;
				}
				else if (nb_tp > 0)  {
					totala -=15;
					nb_tp--;
					p++;
				}
				j-=6;
						
			}
			totala =totala +"€";
			let e= p*1+r*1;
			totala+= "<br> vous avez "+e+" place(s) gratuite(s) <br> (P : " +p+" | R : "+r+" | E : 0)";
			let cpt=0;

			while (e>0){
				console.log(where_tr == 0);
				console.log(where_tr);
				if (where_tr.length == 0){

					let calcule = document.getElementById("Tarifplein"+cpt).value - document.getElementById("offertes"+cpt).value;
					if (calcule>0){
						console.log('plein');
						document.getElementById("offertes"+cpt).value ++;
						e --;
					}else{
						cpt++;
					}	
					
				
				}else{
					let calcule = document.getElementById("Tarifreduit"+where_tr[0]).value - document.getElementById("offertes"+where_tr[0]).value;
					if (calcule>0){
						console.log('reduit');
						document.getElementById("offertes"+where_tr[0]).value ++;
						e --;
					}else{
						where_tr.shift();
					}	
				}
			}
				
			

			$("#tot").html(totala);
		}	 
		
  
		function init2(){
			//console.log("init2");
			let da= null;
			$.ajax({async:false, url: "queljour.php" , success: function(result){
 
			   var cpths = JSON.parse(result);
			   var s =[] ;
			   var result1 = '<form id="form'+nb_form.toString()+'" action="tocsv.php" target="_blank" method="post"> <fieldset name= "fieldset0"> '+ ' Choix du Spectacle : <br> <select id="contain'+nb_form.toString()+'" name="spectacle'+nb_form.toString()+'" onchange="jour('+nb_form.toString()+')">'+ '<option> choisissez le spectacle </option>';
			   for( i = 0 ;  i < cpths.length - 1 ; i++){
					  if (!s.includes(cpths[i]['titre'])){
						  s.push(cpths[i]['titre']);
					  }
				}
				for(i=0; i<s.length;i++){
					result1=result1+'<option value="'+s[i]+'">'+s[i]+'</option>'; 
				}
				result1=result1+'</select> <br> Choix du jour : <br>  <span id="cpthj'+nb_form.toString()+'"></span> ';
				result1=result1+'<br> Choix de l\'heure : <br> <span id="cpthh'+nb_form.toString()+'" ></span> ';
				result1=result1+'<br> Choix du lieu : <br>  <span id="cpthl'+nb_form.toString()+'" ></span> ';
				result1+='<br> <strong>Total: </strong><span id="tot'+nb_form.toString()+'" > </span>';
				result1=result1+'<br> </div> <div class="block" id="div'+nb_form.toString()+'"> <br><strong>Nombre de Billet:</strong><br> <br> Tarif plein  : 15€ <input type="number" id="Tarifplein'+nb_form.toString()+'" name="Tarifplein'+nb_form.toString()+'" value="0" min="0" max="64" onchange="total('+nb_form.toString()+')">';
				result1=result1+'<br> <br>Tarif reduit : 10€ <input type="number" id="Tarifreduit'+nb_form.toString()+'" name="Tarifreduit'+nb_form.toString()+'" value="0" min="0" max="64" onchange="total('+nb_form.toString()+')">';
				result1=result1+'<br><br> Tarif enfant :  0€ <input type="number" id="Tarifenfant'+nb_form.toString()+'" name="Tarifenfant'+nb_form.toString()+'" value="0" min="0" max="64">';
				result1=result1+'<br><br> Places Offertes : <input type="number" id="offertes'+nb_form.toString()+'" name="offertes'+nb_form.toString()+'" value="0" readonly><br> </div></fieldset> </form>';
				//console.log("init2"+ result1);
				da=result1;
			}, error : function(){ da= 0; console.log("erreur");}});
			
			return da;
		}
		
         function spec(callback) {
			 if (callback && typeof(callback) === "function") {
				var result1 = callback();
				//console.log("spec");
				$("#cpths").html(result1);
			}	
		}
		
        function jour(id1) {
			
			$.ajax({url: "queljour.php" , success: function(result){
			   //console.log("jour",id1);
			   var cpthj = JSON.parse(result);
			   var j =[] ;
			   var s =document.getElementById("contain"+id1).value;
			   
			  var result1 = '<select id="day'+id1+'" name="day'+id1+'" onchange="heure('+id1+')">'+ '<option>'+'choisissez le jour'+'</option>'; 
			   for( i = 0 ;  i < cpthj.length - 1 ; i++){
				   if(cpthj[i]['titre']==s){
					   if (!j.includes(cpthj[i]['date'])){
						   j.push(cpthj[i]['date']);
						}
					}
				}
				
				for(i=0; i<j.length;i++){
					result1=result1+'<option value="'+j[i]+'">'+j[i]+'</option>'; 
				}
				result1=result1+'</select>';
				//console.log(result1);
				var x = "cpthj"+id1;
				$("#"+x).html(result1);
										
			}, error : function(){ console.log("erreur");}});
			
		}
		
		function heure(id1) {
			
			$.ajax({url: "queljour.php" , success: function(result){
				   //console.log("heure",id1);
                   var cpthh = JSON.parse(result);
                   var h =[] ;
                   var jo = document.getElementById("day"+id1).value;
                   var s = document.getElementById("contain"+id1).value;
                   var result1 = '<select id="hour'+id1+'" name="hour'+id1+'" onchange="endroit('+id1+')">'+ '<option>'+'choisissez l\'heure'+'</option>'; 
                   for( i = 0 ;  i < cpthh.length - 1 ; i++){
					  if(cpthh[i]['titre']==s){
						   if(cpthh[i]['date']==jo){
							   if (!h.includes(cpthh[i]['heure'])){
								   h.push(cpthh[i]['heure']);
								}
							}
						}
					}
					h.sort();
					for(i=0; i<h.length;i++){
						result1=result1+'<option value="'+h[i]+'">'+h[i]+'</option>';
						
						 
					}
					result1=result1+'</select>';
					var x = "cpthh"+id1;
					$("#"+x).html(result1);
											
			}, error : function(){ console.log("erreur");}});
			
		}
		
		function endroit(id1) {
			
			$.ajax({url: "queljour.php" , success: function(result){
				//console.log("endroit",id1);   
			   var cpthl = JSON.parse(result);
			   var l =[] ;
			   var jo = document.getElementById('day'+id1).value;
			   var s = document.getElementById('contain'+id1).value;
			   var h = document.getElementById('hour'+id1).value;
			   var result1 = '<select id="place'+id1+'" name="place'+id1+'" onchange="Alert('+id1+')">'+ '<option>'+'choisissez le lieu'+'</option>'; 
			   for( i = 0 ;  i < cpthl.length - 1 ; i++){
				  if(cpthl[i]['titre']==s){
					   if(cpthl[i]['date']==jo){
						   if(cpthl[i]['heure']==h){
							   if (!l.includes(cpthl[i]['lieu'])){
								   l.push(cpthl[i]['lieu']+","+cpthl[i]['village']);
								}
							}
						}
					}
				}
				l.sort();
				for(i=0; i<l.length;i++){
					result1=result1+'<option value="'+l[i]+'">'+l[i]+'</option>';
					
					 
				}
				result1=result1+'</select>';
				var x = "cpthl"+id1;
				$("#"+x).html(result1);

										
			}, error : function(){ console.log("erreur");}});
			
		}
		function toutvalider(){
			console.log(nb_form);
			document.getElementById("form0").insertAdjacentHTML('beforeend','<input type = "hidden" name="identifiant" value="'+nb_form.toString()+'">') ;
			for(i=0; i<=nb_form;i++){
				
				document.getElementById("form"+i.toString()).submit();
				
			}
			console.log("fin");
		}
		//partie planning
		function update(id){

			//console.log("update");
			$(this).removeClass("shadowboxNormal");
			$("#"+id).toggleClass("shadowboxChoisie shadowboxNormal");
		}