<?php
	session_start();
	if(isset($_SESSION['login'])){
		header('Location: welcome.php'); 	
	}else{
	
	}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Login</title>
		<link rel="shortcut icon" href="favicon.png">
		<link rel="stylesheet" href="css/login.css">
		<script src="js/jquery.min.js"></script>
		<script src="js/js.js"></script>
		<script>
			$(document).ready(function(){
				$(document).keypress(function(event) {
					if ( event.which == 13 ) {
						event.preventDefault();
						login();
					}
					
				});
				
				$("#login_button").click(function(){
					login();
				});
			});
		</script>				
	
	</head>
	<body>
		
		<div id="login_title_wr" ><div id="login_title" >Veuillez vous authentifier</div></div>
		<div id="Login_form" >
			<table>
				<tbody>
					<tr>
						<td>Nom d'utilisateur : </td>				
						<td><input type="text" name="login" id="login" size="35" tabindex="1"></td>				
					</tr>
					<tr>
						<td>Mot de passe : </td>				
						<td><input type="password" name="password" id="password" size="35"></td>				
					</tr>
					
				</tbody>				
			</table>
			<button type="button" id="login_button" >Se connecter</button>
			<div id="error_msg"></div>
		</div>
	</body>
</html>