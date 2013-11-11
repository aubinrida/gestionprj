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

			$id_tache = $_GET['id_tache'];
			$type_tache = $_GET['type_tache'];
			if($type_tache == "tache_critique"){
				$nom_tache = mysql_fetch_array(mysql_query("SELECT * FROM `tache critique` WHERE `ID` =".$id_tache));
			}else{
				if($type_tache == "tache_non_critique"){
					$nom_tache = mysql_fetch_array(mysql_query("SELECT * FROM `tache non critique` WHERE `ID` =".$id_tache));
				}
			}
			$nom_tache = $nom_tache['Nom_tache'];				
			
			$projet_results = mysql_query("SELECT * FROM `projet`");
			
			while($row = mysql_fetch_array($projet_results)){
				if( $_SESSION['id_chef_projet'] == $row['Chef de projetID'] ){
					$nom_projet = $row['Nom_projet'];
				}
			}			
			
			if(isset($id_tache)){
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
					<?php 
						if($type_tache == "tache_critique"){
					?>
							<div id="nom_tache">Tache(<span class="tache_critique">critique</span>) : <?php echo $nom_tache; ?></div><br><br>
					<?php 
						}else{
							if($type_tache == "tache_non_critique"){
					?>
								<div id="nom_tache">Tache(<span class="tache_nncritique">non critique</span>) : <?php echo $nom_tache; ?></div><br><br>
					<?php 
							}
						}
					?>
					
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
									<th>Action</th>
									
								</tr>
							</thead>
							<tbody>
								<?php
									$membre_equipe_results = mysql_query("SELECT * FROM `membre equipe` , `compte de récompence`
									WHERE `membre equipe`.`ID` = `compte de récompence`.`Membre equipeID` AND `Chef de projetID` =".$_SESSION['id_chef_projet']."
									ORDER BY `Points` DESC, `date_embauche` ASC");
									$nb_rows_cr = 0;
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
											$Nom_tache = $Nom_tache_cr;
										}else{
											$Nom_tache = $Nom_tache_nncr;
										}								
										
										if(isset($Nom_tache)){
										
										}else{
											
											echo "<tr> 
												<td>".$nom."</td>
												<td>".$tel."</td>
												<td>".$email."</td>
												<td>".$adresse."</td>
												<td>".$date_embauche."</td>
												<td>".$points."</td>
												<td><a href='affecter_tache_membre.php?id_tache=".$id_tache."&membre_equipe_id=".$membre_equipe_id."&type_tache=".$type_tache."'>Affecter la tache à ce membre</a></td>
											</tr>";
											$nb_rows_cr++;
										}
										
									}
									if($nb_rows_cr == 0){
										echo "<tr class='empty_row'> 
												<td>Tous les membres ont déjà des taches</td>
												<td>-</td>
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
						<a href="liste_tache.php">Liste des taches</a><br>
						<a href="liste_membre.php">Liste des membres de l'équipe</a>			
					</div>
					<br><br>
				</div>			
		<?php	
			}else{
				echo "Pas de tache selectionner";
				header('Location: ../index.php');
			}
			mysql_close($con);
		?>
	</body>
</html>