<!DOCTYPE HTML>
<html>
	<head>
		<title>Bienvenue</title>
	</head>
	<body>
		<?php
			session_start();
			if(isset($_SESSION['login'])){
				switch($_SESSION['type_compte']){
					case 'client':
						header('Location: profiles/client.php');
					break;
					case 'membre_equipe':
						header('Location: profiles/membre_equipe.php');
					break;
					case 'super_administrateur':
						header('Location: profiles/super-admin.php');
					break;
					case 'chef_projet':
						header('Location: profiles/chef_projet.php');
					break;
					
					default:
						
				}				
		?>	
		<div id="welcome">
			<form action="logout.php" method="post">
				<?php echo "Bienvenue ".$_SESSION['nom']; ?>
				<input type="submit" value="log out">
			</form>				
		</div>			
		<?php
				
			}else{
				echo "logged out";
				header('Location: index.php');
			}
		?>
	</body>
</html>
