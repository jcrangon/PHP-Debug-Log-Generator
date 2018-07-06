<?php
$_SESSION["pathtologger"]=$pathto_logger_file;

include($pathto_debug_conf);
include($_SESSION["pathtologger"]."/activate.dat.php");
$status=$logginactivated_state;


if($_SESSION["usedebug"]==1){
	mkpaths($_SESSION["pathtologger"]);

	if($status==1){
		$logenabled=true;
		$_SESSION["logenabled"]=true;
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