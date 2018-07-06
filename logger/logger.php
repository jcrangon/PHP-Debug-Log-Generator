<?php
$_SESSION["pathtologger"]=$pathto_logger_file;

include($pathto_debug_conf);
include($_SESSION["pathtologger"]."/activate.dat.php");
$status=$logginactivated_state;


if($_SESSION["usedebug"]==1){
	mkpaths($_SESSION["pathtologger"]);
	// Afficher les erreurs à l'écran
	ini_set('display_errors', 'Off');
	// Enregistrer les erreurs dans un fichier de log
	ini_set('log_errors', "On");
	// Nom du fichier qui enregistre les logs (attention aux droits à l'écriture)
	ini_set('error_log', $_SESSION["pathtologger"].'/log.txt');
	// Afficher les erreurs et les avertissements
	error_reporting(E_ALL);
	
	if($status==1){
		$logenabled=true;
		$_SESSION["logenabled"]=true;
		include($_SESSION["loggerlib"]);
		checkloggersession(__FILE__,__LINE__);  
		setlogfile($_SESSION["logfile"],__FILE__,__LINE__); 
		setlogpage($_SESSION["logpage"],__FILE__,__LINE__); 
		checkloggerenv(__FILE__,__LINE__);
		mklog(__FILE__,__LINE__);
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