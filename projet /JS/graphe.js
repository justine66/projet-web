
		var t;
		var p  = [0];
		var	r  = [0];
		//var	e  = [0];
		var	sA = [0];
		var	sJ = [0];
		//var	o  = [0];
        var comp=[];
        let type_graphe ='compagnie'; //'lieu'

        function init(){
			        

            $.ajax({async : false,  url: "menu-bandeau.php", success: function(result){
				console.log("init");
                   $cpth = result;
                   $("#cpth").html(result);
                   troup('compagnie');       
					//Draw();
               },error : function (){console.log("menu-bandeau error");}});             
        }
        
        function troup(type_graphe) {
			console.log("init troupe");
			$.ajax({async : false,  url: type_graphe+".php", success: function(result){
			
				t = JSON.parse(result);				
				var nb_compagnie =0;
				p  = [0];
				p[0] =t[0]["p"]*0.1*15;
				r = [0];
				r[0] =t[0]["r"]*0.1*10;
				sA = [0];
				sA[0]=t[0]["sJ"]*9;
				sJ = [0];
				sJ[0]=t[0]["E"]*1;;
				comp=[];
				comp[0]= t[0][type_graphe];
				for ( i = 0; i<t.length-1; i++){
					if ( t[i][type_graphe] == t[i+1][type_graphe]){
							p[nb_compagnie] = p[nb_compagnie]*1  + t[i+1]["p"]*0.1*15;
							r[nb_compagnie] = r[nb_compagnie]*1  + t[i+1]["r"]*0.1*10;
							sA[nb_compagnie]= sA[nb_compagnie]*1 + t[i+1]["sA"]*12.5;
							sJ[nb_compagnie]= sJ[nb_compagnie]*1 + t[i+1]["sJ"]*9;
						//	e[nb_compagnie] = e[nb_compagnie]*1  + t[i+1]["E"]*1;
					}else{
						nb_compagnie++;
						p.push(t[i+1]["p"]*0.1*15);
						r.push(t[i+1]["r"]*0.1*10);
						sA.push(t[i+1]["sA"]*12.5);
						sJ.push(t[i+1]["sJ"]*9);
						comp.push(t[i+1][type_graphe]);
					}
					
				}
				comp.push(t[t.length-1][type_graphe]); // pour mettre le dernier 
				//console.log("t"+t);
				//console.log("t.length"+t.length);
				console.log("P: "+p);
				console.log("r: "+r);
				console.log("sA: "+sA);
				console.log("sJ: "+sJ);
				console.log("t"+t);
				console.log("comp "+comp);
				//console.log(t[0][type_graphe]);
				//console.log(t[0]["r"]);
				$("#c").html(t);
			},error : function (){console.log("troupe error");}});
			Draw();
		}
			
				function Draw(){
					console.log("draw");
					var myCanvas = document.getElementById('myCanvas');
					var context = myCanvas.getContext('2d');
					let maxi_temp = [0,0,0,0,0];
					for ( i = 0 ; i< p.length-1; i++ ){
						 if( p[i]*1+ r[i]*1> sJ[i]*1 + sA[i] *1){
							maxi_temp[i]= p[i]*1+ r[i]*1
						}else { maxi_temp[i]= sJ[i]*1 + sA[i] *1}
					}
					let maxi = max (maxi_temp);
					let hauteur  = maxi ; 
					//let largeur_barre = 75;
					let largeur_barre = 75;
					let taille_abscisse = ((largeur_barre+5)* (p.length))*2+100;
					$("#myCanvas").attr('width' ,taille_abscisse + largeur_barre);
					$("#myCanvas").attr('height',hauteur +160 );
					
					//origine
					
					let x0 = 50 ;
					let y0 = hauteur +100 ;
					context.fillStyle = '#000' ;
					context.lineWidth = '1.0' ;
					let z =((myCanvas.height-100)/maxi)*0.9
					console.log(maxi);
					
					//ordonnée
					tracer(context , x0 ,y0 , x0 , 80 );	
					tracer(context , x0-10 ,80+13 , x0 , 80);		
					tracer(context , x0+10 ,80+13 , x0 , 80);	
					
					context.textAlign ='center';
					context.font = '9pt Tahoma';
					let graduation = 0 ;
					
					let pas = Math.floor ( (hauteur/100) *10 );
					
					for ( let i = 0 ; i<= 10 ; i++){
						tracer(context , x0-5 ,y0-(pas*i), x0+5 , y0-(pas*i));
						graduation = Math.floor(( maxi/10) *i );
						context.fillText (graduation, (x0 -20) , (y0 - (pas*i)));
					}	
					
					// abcisse 
					tracer(context , x0 ,y0 , taille_abscisse , y0);	
					tracer(context , taille_abscisse -10 ,y0 -8 , taille_abscisse , y0);		
					tracer(context , taille_abscisse -10 ,y0 +8 , taille_abscisse , y0);
					
					let comptTotal = 0;
					
					for (let i = 0 ; i< 2*p.length ; i=i+2){
						
						//rectagle des places p
						context.fillStyle = '#3C7113';
						context.beginPath();
						context.rect(x0 +15 + (i*largeur_barre)+ 5*i , y0-1-(p[i/2]),largeur_barre,(p[i/2]));
						//legende 
						context.rect(50, 25,10,(10));
						context.fillText("place tarif plein", 110 , 35 );
						//
						context.closePath();
						context.stroke();
						context.fill();


						//rectagle des placex r
						context.fillStyle = '#5F80B4';
						context.beginPath();
						context.rect(x0 +15 + (i*largeur_barre)+ 5*i ,  y0-1-(p[i/2])-(r[i/2]),largeur_barre,(r[i/2]));
						//legende
						context.rect(200, 25,10,(10));
						context.fillText("place tarif reduit", 200+60 , 35 );
						//
						context.closePath();
						context.stroke();
						context.fill();
						
						//rectagle des placex sA
						context.fillStyle = '#EDED45';
						context.beginPath();
						context.rect(x0 +20 + ((i+1)*largeur_barre)+ 5*i ,  y0-1-(sA[i/2]),largeur_barre,(sA[i/2]));
						//legend
						context.rect(350, 25,10,(10));
						context.fillText("place tarif sA", 350+60 , 35 );
						//
						context.closePath();
						context.stroke();
						context.fill();

				      	//rectagle des placex sJ
						context.fillStyle = '#F66227';
						context.beginPath();
						context.rect(x0+20 + ((i+1)*largeur_barre)+ 5*i ,  y0-1-(sA[i/2])-(sJ[i/2]),largeur_barre,(sJ[i/2]));
						//legend
						context.rect(500, 25,10,(10));
						context.fillText("place tarif sJ", 500+60 , 35 );
						//
						context.closePath();
						context.stroke();
						context.fill();

						context.fillStyle = 'black'
						
						if ((i/2)%2 == 0 ){
							context.fillText(comp[i/2], x0+10+largeur_barre+ (i*largeur_barre)+5*i, y0+20 )
						}
						else{
						context.fillText(comp[i/2], x0+10+largeur_barre+ (i*largeur_barre)+5*i, y0+40 )
						}
					}
					//legende graph 
				}
                
                function tracer(ctx,x1,y1,x2,y2){
					ctx.beginPath();
					ctx.moveTo(x1 ,y1);
					ctx.lineTo(x2,y2);
					ctx.closePath();
					ctx.stroke();
				}
				 function max(b){
					let m = b[0];
					for ( i = 1 ; i < b.length-1 ; i++){
						if ( m < b[i+1]){
							m = b[i+1];
						}
					}
					return m;
				}
				function min(b){
					let m = b[0];
					for ( i = 0 ; i < b.length-1 ; i++){
						if ( m > b[i+1]){
							m = b[i+1];
						}
					}
					return m;
				}
				   