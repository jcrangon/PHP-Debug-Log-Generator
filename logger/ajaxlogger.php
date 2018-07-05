<?php
$_SESSION["ajaxpathtologger"]=$ajaxpathto_logger_file;
include($ajaxpathto_debug_conf);
$status = checkdebugstatus($_SESSION["ajaxpathtologger"]);

if($_SESSION["usedebug"]==1){
	if($status==1){
		$logenabled=true;
		$_SESSION["logenabled"]=true;
		mkajaxpaths($_SESSION["ajaxpathtologger"]);  
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