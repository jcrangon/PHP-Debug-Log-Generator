<?php
if(!$fh=fopen("./log.txt","w")){
	die("clearlog()  button : cannot fopen logfile  @ logger/clearlog.php Line 3");
}
else{
	fclose($fh);
}

if(!$fh=fopen("./log.php","w")){
	die("clearlog()  button : cannot fopen logfile  @ logger/clearlog.php Line 11");
}
else{
	fclose($fh);
}

echo "<h2>Log Cleared!</h2>";
?>