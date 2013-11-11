<!DOCTYPE HTML>
<html>
	<head>
		<title>Modifier le compte</title>
		<link rel="shortcut icon" href="favicon.png">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/account.css">
		<script src="js/jquery.min.js"></script>
		<script src="js/js.js"></script>
		<script>
			$(document).ready(function(){
				$("#cancel").click(function(){
					window.location.assign("welcome.php");
				});
				$("#init").click(function(){
					$("input").val('');
				});
				$("#save").click(function(){
					modifier_compte();
				});
				$(document).keypress(function(event) {
					if ( event.which == 13 ) {
						event.preventDefault();
						modifier_compte();
					}
					
				});				
			});
		</script>				
		
	</head>
	<body>
		<?php
			session_start();
			$config = @simplexml_load_file('config.xml');
			if (!$config) die('...');
			global $config;
			$con = mysql_connect($config->database->host,$config->database->user,$config->database->password);
			if (!$con){
				die('Could not connect: ' . mysql_error());
			}
			mysql_select_db($config->database->database_name, $con);

			if(isset($_SESSION['login'])){
				switch($_SESSION['type_compte']){
					case 'client':
						$client_results = mysql_query("SELECT * FROM `client` WHERE `ID` = ".$_SESSION['id_compte']);
						$row = mysql_fetch_array($client_results);
						$nom = $row['Nom'];
						$tel = $row['Tel'];
						$email = $row['Email'];
						$adresse = $row['Adresse'];
						$login = $row['Login'];
						$password = $row['Password'];
											
					break;
					case 'membre_equipe':
						$membre_equipe_results = mysql_query("SELECT * FROM `membre equipe` WHERE `ID` = ".$_SESSION['id_compte']);
						$row = mysql_fetch_array($membre_equipe_results);
						$nom = $row['Nom'];
						$tel = $row['Tel'];
						$email = $row['Email'];
						$adresse = $row['Adresse'];
						$login = $row['Login'];
						$password = $row['Password'];
					break;
					case 'super_administrateur':
						$super_administrateur_results = mysql_query("SELECT * FROM `super administrateur` WHERE `ID` = ".$_SESSION['id_compte']);
						$row = mysql_fetch_array($super_administrateur_results);
						$nom = $row['Nom'];
						$tel = $row['Tel'];
						$email = $row['Email'];
						$adresse = $row['Adresse'];
						$login = $row['Login'];
						$password = $row['Password'];
					break;
					case 'chef_projet':
						$chef_projet_results = mysql_query("SELECT * FROM `chef de projet` WHERE `ID` = ".$_SESSION['id_compte']);
						$row = mysql_fetch_array($chef_projet_results);
						$nom = $row['Nom'];
						$tel = $row['Tel'];
						$email = $row['Email'];
						$adresse = $row['Adresse'];
						$login = $row['Login'];
						$password = $row['Password'];
					break;
						
					default:
							
				}				
		?>	
		<div id="update_compte">
				<div id="account_title_wr" ><div id="account_title" >Modifier votre compte</div></div>
				<div id="form">
				
					<table>
						<tbody>
							<tr>
								<td>Nom : </td>				
								<td><input size="35" type="text" name="nom" id="nom" value="<?php echo $nom;?>"></td>				
							</tr>
							<tr>
								<td>Tel : </td>				
								<td><input size="35" type="text" name="tel" id="tel" value="<?php echo $tel;?>"></td>				
							</tr>
							<tr>
								<td>Email : </td>				
								<td><input size="35" type="text" name="email" id="email" value="<?php echo $email;?>"></td>				
							</tr>
							<tr>
								<td>Adresse : </td>				
								<td><input size="35" type="text" name="adresse" id="adresse" value="<?php echo $adresse;?>"></td>				
							</tr>
							<tr>
								<td>Login : </td>				
								<td><input size="35" type="text" name="login" id="login" value="<?php echo $login;?>"></td>				
							</tr>
							<tr>
								<td>Mot de pass : </td>				
								<td><input size="35" type="text" name="password" id="password" value="<?php echo $password;?>"></td>				
							</tr>
							
						</tbody>				
					</table>
					<br>
					<button type="button" id="save">Enregistrer</button>
					<button type="button" id="init" >Réinitialiser</button>
					<button type="button" id="cancel" >Annuler</button>
					<br><br>
					<div id="response" >
					</div>								
				</div>				

		</div>			
		<?php
				mysql_close($con);
			}else{
				echo "logged out";
				header('Location: index.php');
			}
		?>
	</body>
</html>