<!DOCTYPE HTML>
<html>
	<head>
		<title>Inteface du client</title>
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
				if( $_SESSION['id_compte'] == $row['ClientID'] ){
					
					$nom_projet = $row['Nom_projet'];
					$desc_projet = $row['Desc_projet'];
				}
			}			
			
			if(isset($_SESSION['login'])){
				if($_SESSION['type_compte'] != 'client'){
					header('Location: ../index.php');
				}
				$id_client = $_SESSION['id_compte'];
		?>	
		<div id="welcome" class="main">
			
			<div id="head">
				<div id="titre">Inteface du client</div>
				<div id="compte">
					<span id="nom"><?php echo $_SESSION['nom']; ?></span>
					<a href="../modifier_compte.php">Modifier le compte</a>
					<a href="../logout.php">Déconnexion</a>
					
				</div>
			</div>
			<div id="nom_projet">Projet : <?php echo $nom_projet; ?></div>
			<div id="desc_projet">Description : <?php echo $desc_projet; ?></div>			
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