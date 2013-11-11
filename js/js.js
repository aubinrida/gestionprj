function login(){
	var vlogin = $("#login").val();
	var vpassword = $("#password").val();							
	if ( (vlogin == '') && (vpassword == '') ){
		$("#error_msg").html("Erreur: le nom d'utilisateur et le mot de pass sont vide");
		$("#error_msg").show();					
		$("#login").val('');
		$("#password").val('');
	}else{
		if(vpassword == ''){
			$("#error_msg").html('Erreur: le mot de pass est vide');
			$("#error_msg").show();						
			$("#password").val('');
		}else{
			if(vlogin == ''){
				$("#error_msg").html("Erreur: le nom d'utilisateur est vide");
				$("#error_msg").show();						
				$("#login").val('');
			}else{
				if ( (!(vlogin.match(/^[0-9a-zàäâéèêëïîöôùüû\s]*$/i)) && !(vpassword.match(/^[0-9a-zàäâéèêëïîöôùüû\s]*$/i)) )){
					$("#error_msg").html("Erreur: le nom d'utilisateur et le mot de pass ne doivent pas contenir des caractères spéciaux");
					$("#error_msg").show();	
					$("#login").val('');
					$("#password").val('');					
				}else{
					if(!vpassword.match(/^[0-9a-zàäâéèêëïîöôùüû\s]*$/i)){
						$("#error_msg").html('Erreur: le mot de pass ne doit pas contenir des caractères spéciaux');
						$("#error_msg").show();						
						$("#password").val('');	
					}else{
						if(!vlogin.match(/^[0-9a-zàäâéèêëïîöôùüû\s]*$/i)){
							$("#error_msg").html("Erreur: le nom d'utilisateur ne doit pas contenir des caractères spéciaux");
							$("#error_msg").show();				
							$("#login").val('');					
						}else{
							$.post("login.php",{
								login: vlogin,
								password: vpassword
							},function(data,status){		  
								$("#error_msg").html(data);
								$("#error_msg").show();
								if ($("#error_msg").html().indexOf('Erreur') < 0) {
									$("#error_msg").hide();
									window.location.assign("welcome.php");
								}
							});						
						}					
					}
				}	
			}					
		}
	}				
}

function modifier_compte(){
	var vnom = $("#nom").val();
	var vtel = $("#tel").val();
	var vemail = $("#email").val();
	var vadresse = $("#adresse").val();
	var vlogin = $("#login").val();
	var vpassword = $("#password").val();
	$.post("update_compte.php",{
		nom: vnom,
		tel: vtel,
		email: vemail,
		adresse: vadresse,
		login: vlogin,
		password: vpassword
	},function(data,status){			  
		$("#response").html("Modification appliquée");
		$("#response").show();						
		setTimeout(function(){
			window.location.assign("welcome.php");						
		}, 2000);		
	});	
}
