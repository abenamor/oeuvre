  <?php
            	//connexion a la base de données
            	$bdd = new PDO('mysql: host=localhost;dbname=project','root', '') or die ("Connexion à la base SQL impossible");
            #	$select = mysql_select_db ('project', $connect) ; 
            	echo "connexion à a base de données réussie</br>";
            	            	
            	$requete = $bdd -> query('SELECT * FROM geolocalisation2');
            	
            	while ($data = $requete -> fetch())
            	{
            	echo '<script type="text/javascript">console.log("OK")</script>';
            	echo '<h2>'.$data['lat'].'</h2>';
				$lat = $data['lat']; 
				echo '<h2>'.$data['lon'].'</h2>';
				$lon = $data['lon'];
				echo '<script type="text/javascript">initialisation()</script>';
				echo '<script type="text/javascript">trajectoire()</script>';
				echo "tata";
				}
            		?>