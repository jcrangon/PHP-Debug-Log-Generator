<?php
/**
 * Permet de creer un bouton dans la page qui effacera le log en utilisant un appel ajax
 * 
 * 
****** HTML *************
<input type="button" value="Effacer le LOG CRON" onclick="clearlogajax();"  style="box-shadow: 5px 5px #aaaaaa;cursor:pointer;"/>

****** Javascript ************
function clearlogajax(){
	$.ajax({
		url : './logger/ajax_clearlog.php',
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
**/

if(!$fh=fopen("./log.txt","w")){
	echo "cannotopenfile";
	exit();
}
else{
	fclose($fh);
}

if(!$fh=fopen("./log.php","w")){
	echo "cannotopenphplogfile";
	exit();
}
else{
	fclose($fh);
}

echo "ok";
?>