<!DOCTYPE html>

	<head>
		<title>Titre de votre page</title>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
		<meta charset="UTF-8">
		<style type="text/css">
			
			html {
				height: 100%
			}
			body {
				height: 100%;
				margin: 0;
				padding: 0
			}
			#EmplacementDeMaCarte {
				height: 600px
			}
			#info {
				background: #fff;
				padding: 5px;
				font-size: 14px;
				font-family: arial
			}
		 <?php 
            	//connexion a la base de données
            	$bdd = new PDO('mysql: host=localhost;dbname=project','root', '') or die ("Connexion à la base SQL impossible");
            #	$select = mysql_select_db ('project', $connect) ; 
            	echo "connexion à la base de données réussie</br>";
            	            	
            	$requete = $bdd -> query('SELECT * FROM geolocalisation2');
            	
            	while ($data = $requete -> fetch())
            	{
            //	echo '<script type="text/javascript">console.log("OK")</script>';
            	echo '<h2>'.$data['lat'].'</h2>';
				$lat = $data['lat']; 
				echo '<h2>'.$data['lon'].'</h2>';
				$lon = $data['lon'];
				}
            		?>

	</head>
	<body>
	</style>
		<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&libraries=geometry"></script>
		<script type="text/javascript">

		
			function initialisation () {
		
            		
				lon = <?php echo $lon; ?>;
				lat = <?php echo $lat; ?>;
				
				//console.log(lon + " " + lat);
            		
				var pointDepart = new google.maps.LatLng(47.390273,0.688834);
				var pointArrivee = new google.maps.LatLng(lat, lon);
				var limites = new google.maps.LatLngBounds();
				limites.extend(pointDepart);
				limites.extend(pointArrivee);
				limites.extend(new google.maps.LatLng(70.407348,66.796875));
				...
				
				
				/*
					
				lon2 = 2;
				lat2 = 49;
            		
				var distanceFractionnaire = .70;
				var pointDepart = new google.maps.LatLng(47.390273,0.688834);
				var pointArrivee2 = new google.maps.LatLng(lat2, lon2);
				var pointIntermediaire = google.maps.geometry.spherical.interpolate(pointDepart, pointArrivee2, distanceFractionnaire);
				var limites = new google.maps.LatLngBounds();
				limites.extend(pointDepart);
				limites.extend(pointArrivee2);
				limites.extend(new google.maps.LatLng(70.407348,66.796875));

				
				*/
				
				var optionsCarte = {
					zoom: 4,
					center: pointDepart,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				};
				var maCarte = new google.maps.Map(document.getElementById("EmplacementDeMaCarte"), optionsCarte);
			/*	Permet d'avoir des marqueurs	
			var marqueurDepart = new google.maps.Marker({
					map: maCarte,
					icon: new google.maps.MarkerImage("http://static.touraineverte.com/marqueurDvert.png", new google.maps.Size(24, 38), new google.maps.Point(0,0), new google.maps.Point(11, 37)),
					position: pointDepart
				});
				var  marqueurArrivee = new google.maps.Marker({
					map: maCarte,
					icon: new google.maps.MarkerImage("http://static.touraineverte.com/marqueurArouge.png", new google.maps.Size(24, 38), new google.maps.Point(0,0), new google.maps.Point(11, 37)),
					position: pointArrivee
				});*/
				
			
				
				var nordVraiCap = new google.maps.Polyline({map:maCarte,path:[pointDepart,pointArrivee],strokeColor:"#0000FF",geodesic:true});
				document.getElementById("origineLat").innerHTML = pointDepart.lat().toFixed(6);
				document.getElementById("origineLng").innerHTML = pointDepart.lng().toFixed(6);
				document.getElementById("destinationLat").innerHTML = pointArrivee.lat().toFixed(6);
				document.getElementById("destinationLng").innerHTML = pointArrivee.lng().toFixed(6);
				maCarte.fitBounds(limites);
				/*
				
				var nordVraiCap = new google.maps.Polyline({map:maCarte,path:[pointDepart,pointArrivee2],strokeColor:"#0000FF",geodesic:true});
				document.getElementById("origineLat").innerHTML = pointDepart.lat().toFixed(6);
				document.getElementById("origineLng").innerHTML = pointDepart.lng().toFixed(6);
				document.getElementById("destinationLat2").innerHTML = pointArrivee2.lat().toFixed(6);
				document.getElementById("destinationLng2").innerHTML = pointArrivee.lng().toFixed(6);
				maCarte.fitBounds(limites);*/
			}
			
			
			
		google.maps.event.addDomListener( window, "load", initialisation );

		</script>


		</script>
		
		<div id="EmplacementDeMaCarte"></div>
		<div id="info">
			<b>Départ</b> : Latitude : <span id="origineLat"></span> - Longitude : <span id="origineLng"></span> <img src="http://static.touraineverte.com/marqueurDvert.png" alt="Départ" width="30" height="36"/><br/>
			<b>Arrivée</b> : Latitude : <span id="destinationLat"></span> - Longitude : <span id="destinationLng"></span> <img src="http://static.touraineverte.com/marqueurArouge.png" alt="Départ" width="27" height="44"/><br/>
		
		</div>
	</body>
