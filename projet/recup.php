<html>


<body>
            
            <?php
            	//connexion a la base de données
            	$bdd = new PDO('mysql: host=localhost;dbname=project','root', '') or die ("Connexion à la base SQL impossible");
            #	$select = mysql_select_db ('project', $connect) ; 
            	echo "connexion à a base de données réussie</br>";
            	
            	$requete = $bdd -> query('SELECT * FROM geolocalisation');
            	
            	while ($data = $requete -> fetch())
            		{
            			echo '<h2>'.$data['lat'].'</h2>';
            			$latitude = $data['lat']; 
            			echo '<h2>'.$data['lon'].'</h2>';
            			$longitude = $data['lon']; 
            			$requete->closeCursor();
            			echo $latitude;
            		}

            		?>
            		<p>
            			voici la valeur de : <?php echo $latitude ?>
            			
            		</p>
            		
</body>
</html> 