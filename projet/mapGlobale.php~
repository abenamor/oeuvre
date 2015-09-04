


<?php include("googleMap.php"); 
#echo $_POST['urlinput'];
?>

<?php
            	//connexion a la base de données
            	$connect = mysql_connect ('localhost','root', '') or die ("Connexion à la base SQL impossible");
            	$select = mysql_select_db ('project', $connect) ;             	
            //	echo "connexion à a base de données réussie</br>";
?>
<p>
  <form  method="post" action="index2.php"  >
            		Entrez une URL Valide : </br> 
            	<input type="text" name="urlinput" id="urlinput1" /></br>
            	<input type="submit" name="Search" value ="Search" /> 
   </form>
</p>

<?php

 if (isset($_POST['Search']))
            {
            	$sql = 'INSERT INTO url
            			(url)
            			VALUES
            			("'.$_POST['urlinput'].'");';
            	$nomSite = $_POST['urlinput'];
            //	echo "voici mon echo $".$nomSite;
            	$result = mysql_query($sql) 
            	or die('<font color="red">Error :/</font> on line <b>'.__LINE__.'</b>:<br />'.mysql_error());
            			
            	//$debut = exec('python /opt/lampp/htdocs/projet/debut_script_recup2.py www.google.fr');
            	system("python /opt/lampp/htdocs/projet/debut_script_recup2.py ".$_POST['urlinput']);
            	system("sh /opt/lampp/htdocs/projet/Site/listinng/$nomSite/geo.sh requests.csv");
            	system("python /opt/lampp/htdocs/projet/Site/listing/$nomSite/gestionDonneesGeo.py cities.csv");	
            	echo '</br> lles scripts sont exécutés';

            }
            else 
            {
            	echo '</br> aucun script n\'as encore executer, pour ce faire, appyuer sur Valider';
            }
?>            