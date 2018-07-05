<?php
function checkloggersession($f,$l){
	$location=$f." Line ".$l;
	$status=session_status();
	if($status!=2){
		DIE("Logger Error: PHP Session Not Started! @".$location);
	}
}

function checkloggerenv($f,$l){
	$location=$f." Line ".$l;
	if(!isset($_SESSION["logfile"])){
		DIE ("checkloggerenv(): session variable logfile not found @".$location);
	}
	if(!isset($_SESSION["logpage"])){
		DIE ("checkloggerenv(): session variable logpage not found @".$location);
	}
	$file=$_SESSION["logfile"];
	if(!$fh=fopen($file,"a")){
		die("setlogpage() : cannot fopen log file @".$location);
	}
	else{
		switch ($_SESSION["debugverbose"]){
			case 3:
				$lmsg="Appel checkloggerenv() @".$location." correctement executé, variables de session vérifées.";
				$line=mkline($lmsg,0);
				fwrite($fh,$line);
				fclose($fh);
				break;
		}
	}
}

function mkline($lmsg,$sp){
	$line="";
	$now=date("d-m-Y H:i:s");
	$ipAddress = $_SERVER['REMOTE_ADDR'];
	if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
		$exploded= explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
		$ipAddress = array_pop($exploded);
	}
	if($sp==1){
		$line="\n\n";
	}
	
	switch ($_SESSION["debugverbose"]){
		
		case 1:
			$line.=$lmsg." \n";
			break;
		
		case 2:
			$line.="[".$now."] -> ".$lmsg." \n";
			break;
		
		case 3:
			$line.="[".$now."] -> [".$ipAddress."]- ".$lmsg." \n";
			break;
	}
	
	return $line;
}

function setlogfile($file,$f,$l){
	$location=$f." Line ".$l;
	if(!$fh=fopen($file,"a")){
		die("setlogfile() : cannot fopen log file");
	}
	else{
		switch ($_SESSION["debugverbose"]){
			case 3:
				$lmsg="Appel setlogfile() @".$location;
				$line=mkline($lmsg,1);
				fwrite($fh,$line);
				fclose($fh);
				break;
		}	
	}
}

function setlogpage($file,$f,$l){
	$location=$f." Line ".$l;
	if(!$fh=fopen($file,"a")){
		die("setlogpage() : cannot fopen log page @".$location);
	}
	else{
		$file=$_SESSION["logfile"];
		if(!$fh=fopen($file,"a")){
		die("setlogpage() : cannot fopen log file @".$location);
		}
		else{
			$ipAddress = $_SERVER['REMOTE_ADDR'];
			if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
				$exploded= explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
				$ipAddress = array_pop($exploded);
			}
			switch ($_SESSION["debugverbose"]){
				case 2:
					$lmsg=" Initiating for IP: ".$ipAddress;
					$line=mkline($lmsg,1);
					fwrite($fh,$line);
					fclose($fh);
					break;
					
				case 3:
					$lmsg="Appel setlogpage() @".$location."\n Initiating for IP: ".$ipAddress;
					$line=mkline($lmsg,0);
					fwrite($fh,$line);
					fclose($fh);
					break;
			}
		}
	}
}

function mklog($f,$l){
	$location=$f." Line ".$l;
	$file=$_SESSION["logfile"];
	if(!$fh=fopen($file,"a")){
		die("mklog() : cannot fopen log file @".$location);
	}
	else{
		switch ($_SESSION["debugverbose"]){
			case 3:
				$lmsg="Appel mklog() @".$location." ..... Starting the log .............";
				$line=mkline($lmsg,0);
				fwrite($fh,$line);
				fclose($fh);
				break;
			
			default:
				$lmsg=" ..... Starting the log .............";
				$line=mkline($lmsg,1);
				fwrite($fh,$line);
				fclose($fh);
				break;
		}
	}
	$content=file_get_contents($file);
	$htmlcontent="<pre>".$content."</pre>";
	loadlogpage($htmlcontent);
}

function clearlog($file,$f,$l){
	$location=$f." Line ".$l;

	if(!$fh=fopen($file,"w")){
		die("clearlog() : cannot fopen logfile @ ".$location);
	}
	else{
		fclose($fh);
		clearpage($_SESSION["logpage"],$f,$l);
	}	
}

function clearpage($file,$f,$l){
	$location=$f." Line ".$l;
	if(!$fh=fopen($file,"w")){
		die("clearpage() : cannot fopen logpage @ ".$location);
	}
	else{
		fclose($fh);
	}
}

function wlog( $varname, $vardata,$file, $f,$l){
	$location=$f." Line ".$l;
	if(is_bool($vardata)){
		if($vardata){
			$vardata="TRUE";
		}
		else{
			$vardata="FALSE";
		}
	}
	$serialized=print_r($vardata,true);  // true permet de recup la valeur de print_r sans l'afficher a l'ecran
	if(!$fh=fopen($file,"a")){
		die("wlog() : cannot fopen log file @".$location);
	}
	else{
		switch ($_SESSION["debugverbose"]){
			case 1:
				$lmsg=$varname." = ".$serialized;
				break;
				
			case 2:
				$lmsg="wlog @ Line".$l.": \n".$varname." = ".$serialized;
				break;
				
			case 3:
				$lmsg="wlog @ ".$location.": \n".$varname." = ".$serialized;
				break;
		}
		$line=mkline($lmsg,0);
		fwrite($fh,$line);
		$content=file_get_contents($file);
		$htmlcontent="<pre>".$content."</pre>";
		fclose($fh);
		loadlogpage($htmlcontent);
	}
}

function loadlogpage($content){
	$file=$_SESSION["logpage"];
	if(!$fh=fopen($file,"w")){
			die("ERROR : cannot fopen log page");
	}
	else{
		fwrite($fh,$content);
		fclose($fh);
	}
}

?>