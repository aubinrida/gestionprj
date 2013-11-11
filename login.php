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
	
	if ( isset($_POST['login']) && isset($_POST['login']) ){
		$login = $_POST['login'];
		$password = $_POST['password'];		
		$login_succes = false;
		$password_succes = false;
		$client_results = mysql_query("SELECT * FROM `client`");
		$membre_equipe_results = mysql_query("SELECT * FROM `membre equipe`");
		$super_administrateur_results = mysql_query("SELECT * FROM `super administrateur`");
		$chef_projet_results = mysql_query("SELECT * FROM `chef de projet`");
		
		while($row = mysql_fetch_array($client_results)){
			if($login == $row['Login']){
				$login_succes = true;
			}
			if($password == $row['Password']){
				$password_succes = true;
			}
			if( ($login == $row['Login']) && ($password == $row['Password']) ){
				$type_compte = 'client';
				$nom = $row['Nom'];
				$id_compte = $row['ID'];
				
				header('Location: welcome.php'); 
			}
		}
		while($row = mysql_fetch_array($membre_equipe_results)){
			if($login == $row['Login']){
				$login_succes = true;
			}
			if($password == $row['Password']){
				$password_succes = true;
			}		
			if( ($login == $row['Login']) && ($password == $row['Password']) ){
				$type_compte = 'membre_equipe';
				$id_chef_projet = $row['Chef de projetID'];
				$nom = $row['Nom'];
				$id_compte = $row['ID'];
				
				header('Location: welcome.php'); 
			}			
		}
		while($row = mysql_fetch_array($super_administrateur_results)){
			if($login == $row['Login']){
				$login_succes = true;
			}
			if($password == $row['Password']){
				$password_succes = true;
			}		
			if( ($login == $row['Login']) && ($password == $row['Password']) ){
				$type_compte = 'super_administrateur';
				$nom = $row['Nom'];
				$id_compte = $row['ID'];
				
				header('Location: welcome.php'); 
			}
		}
		while($row = mysql_fetch_array($chef_projet_results)){
			if($login == $row['Login']){
				$login_succes = true;
			}
			if($password == $row['Password']){
				$password_succes = true;
			}			
			if( ($login == $row['Login']) && ($password == $row['Password']) ){
				
				$id_compte = $row['ID'];
				$id_chef_projet = $row['ID'];
				$nom = $row['Nom'];
				$type_compte = 'chef_projet';
				header('Location: welcome.php'); 
			}
		}
		
		if ( ($login_succes == false) && ($password_succes == false) ){
			echo("Erreur: le nom d'utilisateur et le mot de pass sont erronnés");			
			echo('<br><script>$("#login").val("");$("#password").val("");</script>');			
		}else{
			if($password_succes == false){
				echo('Erreur: le mot de pass est erronné');
				echo('<br><script>$("#password").val("");</script>');			
			}else{
				if($login_succes == false){
					echo("Erreur: le nom d'utilisateur est erronné");
					echo('<br><script>$("#login").val("");</script>');			
				}else{
					$_SESSION['id_compte'] = $id_compte;
					$_SESSION['id_chef_projet'] = $id_chef_projet;
					$_SESSION['nom'] = $nom;
					$_SESSION['login'] = $login;
					$_SESSION['type_compte'] = $type_compte;
					// echo 'login = '.$login." | pswd = ".$password;
							 					
				}					
			}
		}		
		
	mysql_close($con);	
	}else{
		echo 'erreur';
		header('Location: index.php');
	}
?>
		
		