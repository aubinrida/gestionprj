<?php
	session_start();
			
	$config = @simplexml_load_file('../config.xml');
	if (!$config) die('...');
	global $config;
	$con = mysql_connect($config->database->host,$config->database->user,$config->database->password);
	if (!$con){
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db($config->database->database_name, $con);
	
	if(isset($_SESSION['login'])){
		if($_SESSION['type_compte'] != 'chef_projet'){
			mysql_close($con);
			header('Location: ../index.php');
		}
		$membre_equipe_results = mysql_query("SELECT * FROM `membre equipe` , `compte de récompence`
		WHERE `membre equipe`.`ID` = `compte de récompence`.`Membre equipeID` AND `Chef de projetID` =".$_SESSION['id_chef_projet']."
		ORDER BY `Points` DESC, `date_embauche` ASC");	
		$nb_membres = 0;
		while($row = mysql_fetch_array($membre_equipe_results)){
			$membre_equipe_id = $row['ID'];
			$nom = $row['Nom'];
			$tel = $row['Tel'];
			$email = $row['Email'];
			$adresse = $row['Adresse'];
			$date_embauche = $row['date_embauche'];
			$points = $row['Points'];
			$Nom_tache_cr = mysql_fetch_array(mysql_query("SELECT `Nom_tache` FROM `tache critique` WHERE `Membre equipeID` = ".$membre_equipe_id));
			$Nom_tache = $Nom_tache_cr['Nom_tache'];
			if(isset($Nom_tache)){
				
				$nb_membres++;
				if($nb_membres<3){
					mysql_query("UPDATE  `compte de récompence` SET  salaire = salaire*1.1 WHERE `Membre equipeID` =".$membre_equipe_id);		
					echo "10% raised to membre N ".$membre_equipe_id."<br>";
					echo "Tache ".$Nom_tache."<br><br>";
				}else{
					mysql_query("UPDATE  `compte de récompence` SET  salaire = salaire*1.05 WHERE `Membre equipeID` =".$membre_equipe_id);		
					echo "5% raised to membre N ".$membre_equipe_id."<br>";
					echo "Tache ".$Nom_tache."<br><br>";
				}
			}else{
				// $Nom_tache = "Pas de tache affecté(<a href='liste_tache_membre.php?membre_equipe_id=".$membre_equipe_id."&nom=".$nom."'>Affecter une tache à ce membre</a>)";
				echo "0% raised to membre N ".$membre_equipe_id."<br>";
				echo "Tache ".$Nom_tache."<br><br>";
			}	
				
					
		}
		mysql_close($con);
		header('Location: liste_membre.php'); 
		
	}else{
		mysql_close($con);
		header('Location: ../index.php');
	}	
?>							