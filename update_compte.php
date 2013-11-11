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
	
	switch($_SESSION['type_compte']){
		case 'client':
			mysql_query("UPDATE `client` SET 
				`Nom` = '".$_POST['nom']."',
				`Tel` = '".$_POST['tel']."',
				`Email` = '".$_POST['email']."',
				`Adresse` = '".$_POST['adresse']."',
				`Login` = '".$_POST['login']."',
				`Password` = '".$_POST['password']."'
				WHERE `ID` =".$_SESSION['id_compte']);						
		
		break;
		case 'membre_equipe':
			mysql_query("UPDATE `membre equipe` SET 
				`Nom` = '".$_POST['nom']."',
				`Tel` = '".$_POST['tel']."',
				`Email` = '".$_POST['email']."',
				`Adresse` = '".$_POST['adresse']."',
				`Login` = '".$_POST['login']."',
				`Password` = '".$_POST['password']."'
				WHERE `ID` =".$_SESSION['id_compte']);						

		break;
		case 'super_administrateur':
			mysql_query("UPDATE `super administrateur` SET 
				`Nom` = '".$_POST['nom']."',
				`Tel` = '".$_POST['tel']."',
				`Email` = '".$_POST['email']."',
				`Adresse` = '".$_POST['adresse']."',
				`Login` = '".$_POST['login']."',
				`Password` = '".$_POST['password']."'
				WHERE `ID` =".$_SESSION['id_compte']);						

		break;
		case 'chef_projet':
			mysql_query("UPDATE `chef de projet` SET 
				`Nom` = '".$_POST['nom']."',
				`Tel` = '".$_POST['tel']."',
				`Email` = '".$_POST['email']."',
				`Adresse` = '".$_POST['adresse']."',
				`Login` = '".$_POST['login']."',
				`Password` = '".$_POST['password']."'
				WHERE `ID` =".$_SESSION['id_compte']);						

		break;
					
		default:
						
	}						
	mysql_close($con);
	header('Location: welcome.php'); 
?>
