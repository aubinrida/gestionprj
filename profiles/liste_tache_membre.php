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
			
			$membre_equipe_id = $_GET['membre_equipe_id'];
			$membre_equipe_nom = $_GET['nom'];
			
			if(isset($membre_equipe_id)){
			
			}else{
				header('Location: liste_membre.php');
			}
			
			while($row = mysql_fetch_array($projet_results)){
				if( $_SESSION['id_chef_projet'] == $row['Chef de projetID'] ){
					$nom_projet = $row['Nom_projet'];
					$desc_projet = $row['Desc_projet'];
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
			
			<div id="liste_tache_crt_titre">Liste des taches critiques du projet</div>
			<div id="liste_tache_crt">
				<table class="table_style">
					<thead>
						<tr>
							<th>Nom de la tache</th>
							<th>Description</th>
							<th>Date de debut</th>
							<th>Date de fin</th>
							<th>Date critique</th>
							<th>Membre de l'équipe affecté</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$id_projet = $_SESSION['id_projet'];
							$tache_critique_results = mysql_query("SELECT * FROM `tache critique` WHERE `ProjetID` =".$id_projet);
							$type_tache = "tache_critique";
							$nb_rows_cr = 0;
							while($row = mysql_fetch_array($tache_critique_results)){
								$id_tache = $row['ID'];
								$Nom_tache = $row['Nom_tache'];
								$Desc_tache = $row['Desc_tache'];
								$Date_debut = $row['Date_debut'];
								$Date_fin = $row['Date_fin'];
								if(!isset($Date_fin)){
									$Date_fin = "La tache n'est pas encore fini";
								}								
								$Date_critique = $row['Date_critique'];
								$Membre_equipeID = $row['Membre equipeID'];
								if(isset($Membre_equipeID)){
									
								}else{
									
									$Membre_equipe = "Aucun membre n'est affecté à cette tache(<a href='affecter_tache_membre.php?id_tache=".$id_tache."&membre_equipe_id=".$membre_equipe_id."&type_tache=".$type_tache."'>Affecter cette tache à ".$membre_equipe_nom."</a>)";
									echo "<tr> 
											<td>".$Nom_tache."</td>
											<td>".$Desc_tache."</td>
											<td>".$Date_debut."</td>
											<td>".$Date_fin."</td>
											<td>".$Date_critique."</td>
											<td>".$Membre_equipe."</td>
											
										</tr>";	
									$nb_rows_cr++;
								}

							}
							if($nb_rows_cr == 0){
								echo "<tr class='empty_row'> 
										<td>Toutes les sont prises par les autres membres</td>
										<td>-</td>
										<td>-</td>
										<td>-</td>
										<td>-</td>
										<td>-</td>
									</tr>";							
							}
						?>
					</tbody>
				</table>
					
			</div>
			<br><br>
			
			<div id="liste_tache_nncrt_titre">Liste des taches non critiques du projet</div>
			<div id="liste_tache_nncrt">
				<table class="table_style">
					<thead>
						<tr>
							<th>Nom de la tache</th>
							<th>Description</th>
							<th>Date de debut</th>
							<th>Date de fin</th>
							<th>Date au plus-tard</th>
							<th>Date au plus-tot</th>
							<th>Membre de l'équipe affecté</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$id_projet = $_SESSION['id_projet'];
							$tache_non_critique_results = mysql_query("SELECT * FROM `tache non critique` WHERE `ProjetID` =".$id_projet);		
							$type_tache = "tache_non_critique";
							$nb_rows_nncr = 0;
							while($row = mysql_fetch_array($tache_non_critique_results)){
								$id_tache = $row['ID'];
								$Nom_tache = $row['Nom_tache'];
								$Desc_tache = $row['Desc_tache'];
								$Date_debut = $row['Date_debut'];
								$Date_fin = $row['Date_fin'];
								if(!isset($Date_fin)){
									$Date_fin = "La tache n'est pas encore fini";
								}								
								$Date_plustard = $row['Date_plustard'];
								$Date_plustot = $row['Date_plustot'];
								$Membre_equipeID = $row['Membre equipeID'];
								if(isset($Membre_equipeID)){
									$Membre_equipe = mysql_fetch_array(mysql_query("SELECT `Nom` FROM `membre equipe` WHERE `ID` =".$Membre_equipeID));
									$Membre_equipe = $Membre_equipe['Nom']."(<a href='affecter_tache_membre.php?id_tache=".$id_tache."&membre_equipe_id=".$membre_equipe_id."&type_tache=".$type_tache."'>Affecter cette tache à ".$membre_equipe_nom."</a>)";
								}else{
									$Membre_equipe = "Aucun membre n'est affecté à cette tache(<a href='affecter_tache_membre.php?id_tache=".$id_tache."&membre_equipe_id=".$membre_equipe_id."&type_tache=".$type_tache."'>Affecter cette tache à ".$membre_equipe_nom."</a>)";
								}
								echo "<tr> 
										<td>".$Nom_tache."</td>
										<td>".$Desc_tache."</td>
										<td>".$Date_debut."</td>
										<td>".$Date_fin."</td>
										<td>".$Date_plustard."</td>
										<td>".$Date_plustot."</td>
										<td>".$Membre_equipe."</td>
									</tr>";
								$nb_rows_nncr++;
							}
							if($nb_rows_nncr == 0){
								echo "<tr  class='empty_row'> 
										<td>Toutes les sont prises par les autres membres</td>
										<td>-</td>
										<td>-</td>
										<td>-</td>
										<td>-</td>
										<td>-</td>
									</tr>";							
							}							
						?>
					</tbody>
				</table>	
			</div>
			<div id="links">
				<a href="liste_membre.php">Liste des membres de l'équipe</a>			
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