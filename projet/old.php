<!DOCTYPE html and PHP>
<html>
    <head>
        <title>Notre première instruction : echo</title>
        <meta charset="utf-8" />
    </head>
    <body>
        <h2>Affichage de texte avec PHP</h2>
        
        <p>
            Cette ligne a été écrite entièrement en HTML.<br />
            et celle ci aussi !! <br/>
            
            DATE : 
            
            <?php
            function dates ()
            {
           $annees = date('Y'); 
           $mois = date('m'); 
           $jours = date('d'); 
           $heures = date('h'); 
           $minutes = date('m'); 

           echo 'nous somme le ' .$jours. '/'.$mois.'/'.$annees. '<br/> il est :' .$heures.'H'.$minutes.'minutes' ; 
            }
            echo "<br/>Celle-ci a été écrite entièrement en PHP." ;
            
            ?>
        </p>
        <?php
        	/*
            	Voici quelques commentaires en php
            	*/
            		echo "voici un echauffement sur php avec echo <br/>";
            ?>
            
            
            <?php
//bloc permettant de créer la connnexion envers la base de donnée via e php
	try

	{
		$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
		echo "connexion à a base de données réussie";
		
		
		
		$reponse = $bdd->prepare('SELECT nom, prix FROM jeux_video WHERE possesseur = :possesseur AND prix <= :prixmax');
		
		
		$reponse -> execute(array('possesseur'=> $_GET['possesseur'], 'prixmax'=> $_GET['prix'])) ;
		
		echo "récupération des données effectuée";
		while ($donnees = $reponse->fetch())
			{?>
			<p>
			<strong>Jeu</strong>: <?php echo $donnees['nom']; ?><br />

   
   
			</p>
			
			
			<?php
			
			
			}$reponse->closeCursor(); 
	
	}

	catch (Exception $e)

	{

		die('Erreur : ' . $e->getMessage());
	}

?>
            
            <form method="post" action="indexPHP.php">
            
            	<p>
            		Formulaire a remplir est içi :
            	</p>
            	<input type="test" name="pseudo" />
            	<input type="submit" value ="Valider" />
            	
            	<br/>
            	<textarea name="informations" rows="8" cols="48">
            		Içi est ton message 
            	</textarea>
            	
            </form>
            
            
            
           <?php
           echo "Celle-ci a été écrite entièrement en PHP.";

           include("menu.php");
           include("entete.php");
           include("pied_de_page.php");
           
           $valeur = 27; 
           $valeur2 = 3;
           $valeur3 = $valeur + $valeur2; 
           $text ="valeur + valeur2 =";
           echo 'le réultat de ton calcul est : ' .$valeur3. ',merci de votre participation. <br/>'; 
           
           if ($valeur3 >=20)
           {
           	   echo "tu as un chiffre supérieur ou égale à 20"; 
           }
           else 
           {
           	   echo "tu as un chiffre inférieur ou égale à 20";
           }
           $nombre =0;
           while ($nombre < 10)
           	   {
           	   echo 'le nombre est égale a :'  .$nombre.' <br/>';
           	   $nombre ++;
           	   }
           
           function Tata($nom)
           {
           	   echo 'ta tente est ' .$nom. '<br/>';
           	   
           }
           
           tata('salima');
           dates();
           
           

           $tableau = array ('1','20','30');
                      $somme  = $tableau[1]+$tableau[2];
           echo ' <br/>la valeur du tableau 2 est : ' .$tableau[2];
           echo ' <br/>la valeur de la somme du tableau 1 et 2  est : ' .$somme;
           
           
           $tableau2 = array (
           	   'prenom' => 'Adel',
           	   'nom' => 'benamor',
           	   'date_de_naissance' => '20/09/1990',
           	   'ville'=> 'Marseille');
           
           echo '<br/>'.$tableau2['ville'];

           foreach ($tableau2 as $cle => $elements)
           	   {
           	   	   echo "$cle => $elements <br/>";
           	   }
           
           	  echo  '<pre>';
           	   print_r($tableau2);
           	   echo  '</pre>';
           	   
           	   
           ?>
           
    </body>
</html>
