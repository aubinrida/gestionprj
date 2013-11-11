<!DOCTYPE HTML>
<html>
	<head>
		<title>Inteface du super-Administrateur</title>
		<link rel="shortcut icon" href="../favicon.png">
		<link rel="stylesheet" href="../css/style.css">
		<link rel="stylesheet" href="../css/global.css">
	</head>
	<body>
		<?php
			session_start();
			if(isset($_SESSION['login'])){
				if($_SESSION['type_compte'] != 'super_administrateur'){
					header('Location: ../index.php');
				}
		?>	
		<div id="welcome" class="main">
			<div id="head">
				<div id="titre">Inteface du super-Administrateur</div>
				<div id="compte">
					<span id="nom"><?php echo $_SESSION['nom']; ?></span>
					<a href="../modifier_compte.php">Modifier le compte</a>
					<a href="../logout.php">Déconnexion</a>
					
				</div>
			</div>			
		</div>			
		<?php
				
			}else{
				echo "logged out";
				header('Location: ../index.php');
			}
		?>


	</body>
</html>