<?php
session_start();
//////////////////////////  LOGGER /////////////////////////////////////
// Enter the relative path to debug.conf.php :                              
    $pathto_debug_conf="../logger/debug.conf.php";
//Enter relative path to logger folder :
    $pathto_logger_file="../logger";
////////////////////////////////////////////////////////////////////////
// Loads the logger if activated 
	include($pathto_logger_file."/logger.php");
// usage in script:	
// if($logenabled){wlog("$ SESSION",$_SESSION,$_SESSION["logfile"],__FILE__,__LINE__));
// if($logenabled){wlog("Dans la procedure X","",$_SESSION["logfile"],__FILE__,__LINE__);} 
// if($logenabled){wlog($Arg1,$Arg2,$_SESSION["logfile"],__FILE__,__LINE__));}
//
// to use inside individual functions :
// if($_SESSION["logenabled"]){wlog("$ SESSION",$_SESSION,$_SESSION["logfile"],__FILE__,__LINE__));
// if($_SESSION["logenabled"]){wlog("Dans la procedure X","",$_SESSION["logfile"],__FILE__,__LINE__);} 
// if($_SESSION["logenabled"]){wlog($Arg1,$Arg2,$_SESSION["logfile"],__FILE__,__LINE__));}
//////////////////////////////////////////////////////////////////////////////////////////////////////

if($logenabled){wlog("Test - Test - Test - Test !!!","",$_SESSION["logfile"],__FILE__,__LINE__);}


?>
<!DOCTYPE html>
<html style="padding:0;margin:0;width:100%;height:100px;">
	<head>
		<!-- Adjust Paths for JS files -->
		<script src="../logger/jquery/jquery-3.1.1.min.js"></script>
		<script src="../logger/js/logger.js"></script>
		<title>Keno Center</title>
	</head>
	
	<body>
		<?php if($_SESSION["usedebug"]==1){include($_SESSION["loggerdiv"]); }?>
	</body>
</html>