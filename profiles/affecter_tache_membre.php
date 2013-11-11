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
	
	if(isset($_SESSION['login'])){
		if($_SESSION['type_compte'] != 'chef_projet'){
			mysql_close($con);
			header('Location: ../index.php');
		}	
		$id_tache = $_GET['id_tache'];
		$membre_equipe_id = $_GET['membre_equipe_id'];
		$type_tache = $_GET['type_tache'];
		
		if( isset($id_tache) && isset($membre_equipe_id) && isset($type_tache) ){
			if($type_tache == "tache_critique"){
				mysql_query("UPDATE `tache critique` SET  `Membre equipeID` =  '".$membre_equipe_id."' WHERE  `ID` =".$id_tache);
				
				
			}else{
				if($type_tache == "tache_non_critique"){
					mysql_query("UPDATE `tache non critique` SET  `Membre equipeID` =  '".$membre_equipe_id."' WHERE  `ID` =".$id_tache);
				}
			}	
				
		}else{
		
		}
		mysql_close($con);
		header('Location: liste_tache.php'); 
	}else{
		mysql_close($con);
		header('Location: ../index.php');
	}	

		
?>