<?php
session_start();
// use this button if only the ajax routines are using the logger thus it is not 
// set to log actions on the main page

//////////////////////////  MIN LOGGER /////////////////////////////////////
// Enter the relative path to debug.conf.php :                              
    $pathto_debug_conf="../logger/debug.conf.php";
//Enter relative path to logger folder :
    $pathto_logger_file="../logger";
////////////////////////////////////////////////////////////////////////
// Loads the logger if activated 
	include($pathto_logger_file."/min_logger.php");
////////////////////////////////////////////////////////////////////////


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
		<?php if($_SESSION["usedebug"]==1){include($_SESSION["showdebuglog"]); }?>
		<?php if($_SESSION["usedebug"]==1){include($_SESSION["erasedebuglog"]); }?>
		<?php if($_SESSION["usedebug"]==1){include($_SESSION["de_reactdebuglog"]); }?>
	</body>
</html>