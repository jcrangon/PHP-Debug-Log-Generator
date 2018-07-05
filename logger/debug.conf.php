<?php
/////////////////////////////////////////////////////////////////////////////
// Verification de demarrage de session - NE PAS MODIFIER                  //
$status=session_status();                                                  //
if($status!=2){                                                            //
	DIE("Logger Conf Error: PHP Session Not Started! @ debug.cong.php");   //
}                                                                          //
//                                                                         //
/////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////////////
// Switch d'activation du log de debogage 0-OFF, 1-ON                      //
$_SESSION["usedebug"]=1;                                                   //
$_SESSION["debugverbose"]=1; // range 1-3                                  //
//                                                                         //
/////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////////////
// creation des variables path - NE PAS MODIFIER 
function mkpaths($pathtologger){
	$lastchar=substr($pathtologger, -1);
	if($lastchar!="/"){$pathtologger.="/";$_SESSION["pathtologger"]=$pathtologger;}
	$_SESSION["logfile"]=$_SESSION["pathtologger"]."log.txt";
	$_SESSION["logpage"]=$_SESSION["pathtologger"]."log.php";
	$_SESSION["clearlog"]=$_SESSION["pathtologger"]."clearlog.php";
	$_SESSION["loggerlib"]=$_SESSION["pathtologger"]."logger.lib.php";
	$_SESSION["loggerdiv"]=$_SESSION["pathtologger"]."loggerdiv.php";
}

function mkajaxpaths($ajaxpathtologger){
	$lastchar=substr($ajaxpathtologger, -1);
	if($lastchar!="/"){$ajaxpathtologger.="/";$_SESSION["ajaxpathtologger"]=$ajaxpathtologger;}
	$_SESSION["ajaxlogfile"]=$_SESSION["ajaxpathtologger"]."log.txt";
	$_SESSION["ajaxlogpage"]=$_SESSION["ajaxpathtologger"]."log.php";
	$_SESSION["ajaxloggerlib"]=$_SESSION["ajaxpathtologger"]."logger.ajax.lib.php";
}

function checkdebugstatus($pathtologgerfile){
	$filex=$pathtologgerfile."/activate.txt";
	$file = new SplFileObject($filex);
	$tabline=array();
	while (!$file->eof()) {
	    $tabline[]=$file->fgets();
	}
	$status=explode("=",$tabline[0]);
	if($status[0]!="logenable"){
		$file = null;
		die("Etat debogage illisible ... Termination");
	}
	else{
		if($status[1]==1){
			$file = null;
			return 1;
		}
		else{
			$file = null;
			return 0;
		}
	}
}
//
/////////////////////////////////////////////////////////////////////////////
?>