<!DOCTYPE HTML>
<html>
	<head>
		<title>Interface du chef de projet</title>
		<link rel="shortcut icon" href="../favicon.png">
		<link rel="stylesheet" href="../css/style.css">
		<link rel="stylesheet" href="../css/global.css">
	</head>
	<body>
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

			$projet_results = mysql_query("SELECT * FROM `projet`");
			
			while($row = mysql_fetch_array($projet_results)){
				if( $_SESSION['id_chef_projet'] == $row['Chef de projetID'] ){
					$nom_projet = $row['Nom_projet'];
				}
			}			
			
			if(isset($_SESSION['login'])){
				if($_SESSION['type_compte'] != 'chef_projet'){
					header('Location: ../index.php');
				}			
		?>	
		<div id="main_chef_projet" class="main">
			<div id="head">
				<div id="titre">Inteface du chef de projet</div>
				<div id="compte">
					<span id="nom"><?php echo $_SESSION['nom']; ?></span>
					<a href="../modifier_compte.php">Modifier le compte</a>
					<a href="../logout.php">Déconnexion</a>
					
				</div>
			</div>
			<div id="nom_projet">Projet : <?php echo $nom_projet; ?></div><br><br>
			<div id="liste_membre_titre">Liste des membres de l'équipe du projet</div>
			<div id="liste_membre">
				<table  class="table_style">
					<thead>
						<tr>
							<th>Nom</th>
							<th>Téléphone</th>
							<th>Email</th>
							<th>Adresse</th>
							<th>Date Embauche</th>
							<th>Points</th>
							<th>Salaire</th>
							<th>Tache affecté</th>
							
						</tr>
					</thead>
					<tbody>
						<?php							
							$membre_equipe_results = mysql_query("SELECT * FROM `membre equipe` , `compte de récompence`
							WHERE `membre equipe`.`ID` = `compte de récompence`.`Membre equipeID` AND `Chef de projetID` =".$_SESSION['id_chef_projet']."
							ORDER BY `Points` DESC, `date_embauche` ASC");							
							
							while($row = mysql_fetch_array($membre_equipe_results)){
								$membre_equipe_id = $row['ID'];
								$nom = $row['Nom'];
								$tel = $row['Tel'];
								$email = $row['Email'];
								$adresse = $row['Adresse'];
								$date_embauche = $row['date_embauche'];
								$points = $row['Points'];
								$Nom_tache_cr = mysql_fetch_array(mysql_query("SELECT `Nom_tache` FROM `tache critique` WHERE `Membre equipeID` = ".$membre_equipe_id));
								$Nom_tache_nncr = mysql_fetch_array(mysql_query("SELECT `Nom_tache` FROM `tache non critique` WHERE `Membre equipeID` = ".$membre_equipe_id));
								$Nom_tache_cr = $Nom_tache_cr['Nom_tache'];
								$Nom_tache_nncr = $Nom_tache_nncr['Nom_tache'];
								
								if(isset($Nom_tache_cr)){
									$Nom_tache = $Nom_tache_cr.'(tache <span class="tache_critique">critique</span>)';
								}else{
									if(isset($Nom_tache_nncr)){
										$Nom_tache = $Nom_tache_nncr.'(tache <span class="tache_nncritique">non critique</span>)';
									}else{
										$Nom_tache = "Pas de tache affecté(<a href='liste_tache_membre.php?membre_equipe_id=".$membre_equipe_id."&nom=".$nom."'>Affecter une tache à ce membre</a>)";
									}	
								}								
								$salaire = mysql_fetch_array(mysql_query("SELECT `salaire` FROM `compte de récompence` WHERE `Membre equipeID` = ".$membre_equipe_id));
								$salaire = $salaire['salaire'];
								echo "<tr>
									<td>".$nom."</td>
									<td>".$tel."</td>
									<td>".$email."</td>
									<td>".$adresse."</td>
									<td>".$date_embauche."</td>
									<td>".$points."</td>
									<td>".$salaire." DH</td>
									<td>".$Nom_tache."</td>
								</tr>";
							}
						?>
					</tbody>
				
				</table>
			</div>
			<div id="links">
				<a href="liste_tache.php">Liste des taches</a><br>
				<a href="raise_salary.php">Effectuer l'augmentation du salaire</a><br>
			</div>
			<br><br>
		</div>			
		<?php	
				mysql_close($con);
			}else{
				echo "logged out";
				header('Location: ../index.php');
			}
		?>
	</body>
</html>