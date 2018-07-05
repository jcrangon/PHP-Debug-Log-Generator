<?php
$_SESSION["pathtologger"]=$pathto_logger_file;

include($pathto_debug_conf);
$status = checkdebugstatus($_SESSION["pathtologger"]);

if($_SESSION["usedebug"]==1){
	mkpaths($_SESSION["pathtologger"]);
	
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