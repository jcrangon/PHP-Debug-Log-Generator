<?php
session_start();
//////////////////////////  LOGGER /////////////////////////////////////
// Enter the relative path to debug.conf.php :                              
    $ajaxpathto_debug_conf="./debug.conf.php";
//Enter relative path to logger folder :
    $ajaxpathto_logger_file="./";
////////////////////////////////////////////////////////////////////////
// Loads the logger if activated 
	include($ajaxpathto_logger_file."/ajaxlogger.php");
// usage:
// if($logenabled){wlog("$ SESSION",$_SESSION,$_SESSION["ajaxlogfile"],__FILE__,__LINE__);}
// if($logenabled){wlog("Dans la procedure X","",$_SESSION["ajaxlogfile"],__FILE__,__LINE__);}
// if($logenabled){wlog($Arg1,$Arg2,$_SESSION["ajaxlogfile"],__FILE__,__LINE__);}
//
// for use inside individual functions :
// if($_SESSION["logenabled"]){wlog("$ SESSION",$_SESSION,$_SESSION["ajaxlogfile"],__FILE__,__LINE__);}
// if($_SESSION["logenabled"]){wlog("Dans la procedure X","",$_SESSION["ajaxlogfile"],__FILE__,__LINE__);}
// if($_SESSION["logenabled"]){wlog($Arg1,$Arg2,$_SESSION["ajaxlogfile"],__FILE__,__LINE__);}
//////////////////////////////////////////////////////////////////////////////////////////////////////////

function write_file($file,$txt){
	if(!$handle = fopen($file, "w+")){
		return false;
	}
	if(fwrite($handle,$txt,strlen($txt))===false){
		fclose($handle);
		return false;
	}
	else{
		fclose($handle);
		return true;
	}
}

if(!isset($_POST["status"]) || !is_numeric($_POST["status"])){
	echo "errorpost";
	exit();
}
$status=$_POST["status"];

$txt="logenable=".$status."\n";

$file="./activate.txt";

$setstatus=write_file($file,$txt);

if($setstatus===false){
	echo "echececriture";
	exit();
}
else{
	echo "oktoutbon";
	if($logenabled){wlog("*********** DESACTIVATION DU LOGGER ********** ","BYE !!!",$_SESSION["ajaxlogfile"],__FILE__,__LINE__);}
	exit();
}
?>