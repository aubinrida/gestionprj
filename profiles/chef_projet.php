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
					$id_projet = $row['ID'];
					$_SESSION['id_projet'] = $id_projet;
					$nom_projet = $row['Nom_projet'];
					$desc_projet = $row['Desc_projet'];
					$client_projet = $row['ClientID'];
					$client_projet = mysql_fetch_array(mysql_query("SELECT `Nom` FROM  `client` WHERE  `ID` =".$client_projet));
					$client_projet = $client_projet['Nom'];
					
					
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
		<?php
			if(isset($nom_projet)){
		?>
			<div id="nom_projet">Projet : <?php echo $nom_projet; ?></div>
			<div id="desc_projet">Description : <?php echo $desc_projet; ?></div>
			<div id="client_projet">Client : <?php echo $client_projet; ?></div>
			
			<div id="links">
				<a href="liste_tache.php">Liste des taches</a><br>
				<a href="liste_membre.php">Liste des membres de l'équipe</a>			
			</div>
			

			<br><br>
		<?php
			}else{
				echo "<div id='nom_projet'>Aucun projet n'a été affecté à vous en ce moment</div>";
			}
		?>			
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