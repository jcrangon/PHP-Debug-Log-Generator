function clearlogajax(){
	$.ajax({
		url : './logger/ajax_clearlog.php',  // a modifier en fonction
		type : 'POST',
		data: {
		},
		dataType : 'html',

		success : function(code_html, statut){
			
			switch(code_html){
				
				case "cannotopenfile": 
					// traitement
				break;
				
				case "cannotopenphplogfile": 
					// traitement
				break;
				
				case "ok":                     // pas d"'erreur retournée'
					// traitement
				break;
			}
		},

		error : function(resultat, statut, erreur){
				alert(statut+", "+erreur+", "+resultat+" : Erreur Ajax_clearlog.php");
		
		},

		complete : function(resultat, statut){
			
		}
	});
}

function changedebugstatus(status,pathtologger){
	$.ajax({
		url : pathtologger + 'ajax_change_debug_status.php',
		type : 'POST',
		data: {
			status:status
		},
		dataType : 'html',

		success : function(code_html, statut){
			console.log(code_html);
			switch(code_html){
				
				case "errorpost": 
					alert ("Erreur Post");
				break;
				
				case "echececriture": 
					alert("echec ecriture fichier");
				break;
				
				case "oktoutbon":                     // pas d"'erreur retournée'
					location.reload();
				break;
			}
		},

		error : function(resultat, statut, erreur){
				alert(statut+", "+erreur+", "+resultat+" : Erreur Ajax_clearlog.php");
		
		},

		complete : function(resultat, statut){
			
		}
	});
}