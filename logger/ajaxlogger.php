<?php
$_SESSION["ajaxpathtologger"]=$ajaxpathto_logger_file;

include($ajaxpathto_debug_conf);
include($_SESSION["ajaxpathtologger"]."/activate.dat.php");
$status=$logginactivated_state;

if($_SESSION["usedebug"]==1){
	mkajaxpaths($_SESSION["ajaxpathtologger"]); 
	// Afficher les erreurs à l'écran
	ini_set('display_errors', 'Off');
	// Enregistrer les erreurs dans un fichier de log
	ini_set('log_errors', "On");
	// Nom du fichier qui enregistre les logs (attention aux droits à l'écriture)
	ini_set('error_log', $_SESSION["ajaxpathtologger"].'/log.txt');
	// Afficher les erreurs et les avertissements
	error_reporting(E_ALL);
	if($status==1){
		$logenabled=true;
		$_SESSION["logenabled"]=true;
		include($_SESSION["ajaxloggerlib"]);
		checkloggersession(__FILE__,__LINE__);  
		setajaxlogfile($_SESSION["ajaxlogfile"],__FILE__,__LINE__); 
		setajaxlogpage($_SESSION["ajaxlogpage"],__FILE__,__LINE__); 
		checkajaxloggerenv(__FILE__,__LINE__);
		mkajaxlog(__FILE__,__LINE__);
	}
	else{
		$logenabled=false;
  		$_SESSION["logenabled"]=false;
	}
}
else{   
  $logenabled=false;
  $_SESSION["logenabled"]=false;
} 
?>