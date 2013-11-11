<!DOCTYPE HTML>
<html>
	<head>
		<title>Inteface membre d'équipe</title>
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
			$id_projet = '';
			while($row = mysql_fetch_array($projet_results)){
				if( $_SESSION['id_chef_projet'] == $row['Chef de projetID'] ){
					$id_projet = $row['ID'];
					$nom_projet = $row['Nom_projet'];
					$desc_projet = $row['Desc_projet'];
					$client_projet = $row['ClientID'];
					$client_projet = mysql_fetch_array(mysql_query("SELECT `Nom` FROM  `client` WHERE  `ID` =".$client_projet));
					$client_projet = $client_projet['Nom'];
				}
			}			
			$Nom_tache_cr = mysql_fetch_array(mysql_query("SELECT * FROM `tache critique` WHERE `Membre equipeID` = ".$_SESSION['id_compte']));
			$Nom_tache_nncr = mysql_fetch_array(mysql_query("SELECT * FROM `tache non critique` WHERE `Membre equipeID` = ".$_SESSION['id_compte']));
			
			$type_tache = "";
			if($Nom_tache_cr != NULL){
				$type_tache = "tache_critique";
			}else{
				if($Nom_tache_nncr != NULL){
					$type_tache = "tache_non_critique";
				}else{
					$type_tache = "";
				}
			}				
			if(isset($_SESSION['login'])){
				if($_SESSION['type_compte'] != 'membre_equipe'){
					header('Location: ../index.php');
				}			
		?>	
		<div id="welcome" class="main">
			<div id="head">
				<div id="titre">Inteface membre d'équipe</div>
				<div id="compte">
					<span id="nom"><?php echo $_SESSION['nom']; ?></span>
					<a href="../modifier_compte.php">Modifier le compte</a>
					<a href="../logout.php">Déconnexion</a>
				</div>
			</div>

		<?php
			if(isset($nom_projet)){
		?>
			<div id="nom_projet">Projet : <?php echo $nom_projet; ?></div>
			<div id="desc_projet">Description : <?php echo $desc_projet; ?></div>
			<div id="client_projet">Client : <?php echo $client_projet; ?></div>
			
			<br><br>
		<?php
			}else{
				echo "<div id='nom_projet'>Vous n'est affecté à aucun projet en ce moment</div>";
			}
		?>				
			
			<?php 
				if($type_tache == "tache_critique"){
			?>
			<div id="liste_tache_crt">
				<table  class="table_style">
					<thead>
						<tr>
							<th>Nom de la tache</th>
							<th>Description</th>
							<th>Date de debut</th>
							<th>Date de fin</th>
							<th>Date critique</th>
						</tr>
					</thead>
					<tbody>
						<?php
							
							$id_tache = $Nom_tache_cr['ID'];
							$Nom_tache = $Nom_tache_cr['Nom_tache'];
							$Desc_tache = $Nom_tache_cr['Desc_tache'];
							$Date_debut = $Nom_tache_cr['Date_debut'];
							$Date_fin = $Nom_tache_cr['Date_fin'];

							if(!isset($Date_fin)){
								$Date_fin = "La tache n'est pas encore fini";
							}
							$Date_critique = $Nom_tache_cr['Date_critique'];
							
							echo "<tr> 
									<td>".$Nom_tache."</td>
									<td>".$Desc_tache."</td>
									<td>".$Date_debut."</td>
									<td>".$Date_fin."</td>
									<td>".$Date_critique."</td>
								</tr>";
							
						?>
					</tbody>
				</table>
					
			</div>
			<br><br>
			<?php 				
				}else{
					if($type_tache == "tache_non_critique"){
			?>
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
						</tr>
					</thead>
					<tbody>
						<?php
							
							$id_tache = $Nom_tache_nncr['ID'];
							$Nom_tache = $Nom_tache_nncr['Nom_tache'];
							$Desc_tache = $Nom_tache_nncr['Desc_tache'];
							$Date_debut = $Nom_tache_nncr['Date_debut'];
							$Date_fin = $Nom_tache_nncr['Date_fin'];
							if(!isset($Date_fin)){
								$Date_fin = "La tache n'est pas encore fini";
							}								
							$Date_plustard = $Nom_tache_nncr['Date_plustard'];
							$Date_plustot = $Nom_tache_nncr['Date_plustot'];
							
							echo "<tr> 
									<td>".$Nom_tache."</td>
									<td>".$Desc_tache."</td>
									<td>".$Date_debut."</td>
									<td>".$Date_fin."</td>
									<td>".$Date_plustard."</td>
									<td>".$Date_plustot."</td>
								</tr>";
							
						?>
					</tbody>
				</table>	
			</div>
			<br><br>
			<?php 				
					}else{
						echo'<div id="nom_tache">Pas de tache affecté en ce moment</div><br><br>';
					}
				}
			?>			
			<div id="compte_recomp_ttr">Compte de récompence</div>
			<div id="compte_recomp">
				<table class="table_style">
					<thead>
						<tr>
							<th>Points</th>
							<th>Salaire</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$id_compte = $_SESSION['id_compte'];
							$compte_recomp_results = mysql_query("SELECT * FROM `compte de récompence` WHERE `Membre equipeID` =".$id_compte);
							
							while($row = mysql_fetch_array($compte_recomp_results)){
								$Points = $row['Points'];
								$salaire = $row['salaire'];
									
								echo "<tr> 
										<td>".$Points."</td>
										<td>".$salaire." DH</td>									
									</tr>";
							}
						?>
					</tbody>
				</table>
					
			</div>
		</div>		
		<br><br>

					
		<?php	
				mysql_close($con);
			}else{
				echo "logged out";
				header('Location: ../index.php');
			}
		?>
	</body>
</html>