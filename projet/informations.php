<html>
<p>
	Merci d'avance d'avoir participé à cette expérience !</br>
	Recevez toutes les données correspondantes à votre site !!</br>
</p>
<p>
  <form  method="post" action="index.php"  >
  					Entrez une URL Valide : </br>
  				<input typ="text" name ="urlinput" id ="urlinput1"/> </br>
  
            		Adresse Email de l'utilisateur : </br>
            	
            	<input type="text" name="mail" id="mail" /></br>
            		Nombres de passages : </br>
            	<input type="text" name="passages" /></br>
            		
            	<input type="submit" name="Valider" value ="Valider" />
   </form>
</p>


            <?php
            //connexion a la base de données
            	$connect = mysql_connect ('localhost','root', '') or die ("Connexion à la base SQL impossible");
            	$select = mysql_select_db ('project', $connect) ; 
            	
            	echo "connexion à a base de données réussie</br>";
            	
            	
            // si le boutton valider a été activé
            if (isset($_POST['Valider']))
            {
            	//on insert la valeur du champs mail dans la table mail de la base de données
            	$sql = 'INSERT INTO mail
            			(mail)
            			VALUES
            			("'.$_POST['mail'].'");';
            	$result = mysql_query($sql)
            	or die('<font color="red">Error :/</font> on line <b>'.__LINE__.'</b>:<br />'.mysql_error());
            			
            	//on insert la valeur du champs passages dans la table passsages de la base de données
            	$sql = 'INSERT INTO passages
            			(passages)
            			VALUES
            			("'.$_POST['passages'].'");';
            			//permet de voir les erreures sur la gestion de base de données
            			$result = mysql_query($sql)
            			or die('<font color="red">Error :/</font> on line <b>'.__LINE__.'</b>:<br />'.mysql_error());
            	
                //on insert la valeur du champs url dans la table url de la base de données
            	$sql = 'INSERT INTO url
            			(url)
            			VALUES
            			("'.$_POST['urlinput'].'");';
            	$nomSite = $_POST['urlinput'];
            	$result = mysql_query($sql) 
            	or die('<font color="red">Error :/</font> on line <b>'.__LINE__.'</b>:<br />'.mysql_error());
            			
            	//$debut = exec('python /opt/lampp/htdocs/projet/debut_script_recup2.py www.google.fr');
            	system("python /opt/lampp/htdocs/projet/debut_script_recup2.py ".$_POST['urlinput']);
            	system("sh /opt/lampp/htdocs/projet/Site/listinng/$nomSite/geo.sh requests.csv");
            	system("python /opt/lampp/htdocs/projet/Site/listing/$nomSite/gestionDonneesGeo.py cities.csv");	
            	echo '</br> les scripts sont exécutés';
		
            			
            			
            	
            	
            }
            else 
            {
            	echo 'debut_script_recup.py pas encore executer,, pour ce faire, appyuer sur Valider';
            }
            	
            //deconnexion de la base de données
       //     mysql_close();
            echo "insertion effectuée";
            	?>
            
<html>
