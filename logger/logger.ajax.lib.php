<?php
function checkloggersession($f,$l){
	$location=$f." Line ".$l;
	$status=session_status();
	if($status!=2){
		DIE("Logger Error: PHP Session Not Started! @".$location);
	}
}

function checkajaxloggerenv($f,$l){
	$location=$f." Line ".$l;
	if(!isset($_SESSION["ajaxlogfile"])){
		DIE ("checkajaxloggerenv(): session variable logfile not found @".$location);
	}
	if(!isset($_SESSION["ajaxlogpage"])){
		DIE ("checkajaxloggerenv(): session variable logpage not found @".$location);
	}
	$file=$_SESSION["ajaxlogfile"];
	if(!$fh=fopen($file,"a")){
		die("setajaxlogpage() : cannot fopen log file @".$location);
	}
	else{
		switch ($_SESSION["debugverbose"]){
			case 3:
				$lmsg="Appel checkajaxloggerenv() @".$location." correctement executé, variables de session vérifées.";
				$line=mkajaxline($lmsg,0);
				fwrite($fh,$line);
				fclose($fh);
				break;
		}	
	}
}

function mkajaxline($lmsg,$sp){
	$now=date("d-m-Y H:i:s");
	$ipAddress = $_SERVER['REMOTE_ADDR'];
	if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
		$exploded= explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
		$ipAddress = array_pop($exploded);
	}
	if($sp==1){
		$line="\n\n";
	}
	else{
		$line="";
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

function setajaxlogfile($file,$f,$l){
	$location=$f." Line ".$l;
	if(!$fh=fopen($file,"a")){
		die("setajaxlogfile() : cannot fopen log file");
	}
	else{
		switch ($_SESSION["debugverbose"]){
			case 3:
				$lmsg="Appel setajaxlogfile() @".$location;
				$line=mkajaxline($lmsg,1);
				fwrite($fh,$line);
				fclose($fh);
				break;
		}
		
	}
}

function setajaxlogpage($file,$f,$l){
	$location=$f." Line ".$l;
	if(!$fh=fopen($file,"a")){
		die("setajaxlogpage() : cannot fopen log page @".$location);
	}
	else{
		$file=$_SESSION["ajaxlogfile"];
		if(!$fh=fopen($file,"a")){
		die("setajaxlogpage() : cannot fopen log file @".$location);
		}
		else{
			switch ($_SESSION["debugverbose"]){
				case 3:
					$lmsg="Appel setajaxlogpage() @".$location;
					$line=mkajaxline($lmsg,0);
					fwrite($fh,$line);
					fclose($fh);
					break;
			}
		}
	}
}

function mkajaxlog($f,$l){
	$location=$f." Line ".$l;
	$file=$_SESSION["ajaxlogfile"];
	if(!$fh=fopen($file,"a")){
		die("mkajaxlog() : cannot fopen log file @".$location);
	}
	else{
		switch ($_SESSION["debugverbose"]){
			case 3:
				$lmsg="Appel mkajaxlog() @".$location." ..... Starting the AJAX log .............";
				$line=mkajaxline($lmsg,0);
				fwrite($fh,$line);
				fclose($fh);
				break;
			
			default:
				$lmsg=" ..... Starting the AJAX log .............\n";
				$line=mkajaxline($lmsg,1);
				fwrite($fh,$line);
				fclose($fh);
				break;
		}
	}
	$content=file_get_contents($file);
	$htmlcontent="<pre>".$content."</pre>";
	loadajaxlogpage($htmlcontent);
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
		die("setlogfile() : cannot fopen log file @".$location);
	}
	else{
		switch ($_SESSION["debugverbose"]){
			case 1:
				$lmsg=$varname." = ".$serialized;
				break;
				
			case 2:
				$lmsg="wlog @ Line ".$l.": \n".$varname." = ".$serialized;
				break;
				
			case 3:
				$lmsg="wlog @ ".$location.": \n".$varname." = ".$serialized;
				break;
		}
		$line=mkajaxline($lmsg,0);
		fwrite($fh,$line);
		$content=file_get_contents($file);
		$htmlcontent="<pre>".$content."</pre>";
		fclose($fh);
		loadajaxlogpage($htmlcontent);
	}
}

function loadajaxlogpage($content){
	
	$file=$_SESSION["ajaxlogpage"];
	if(!$fh=fopen($file,"w")){
			die("ERROR : cannot fopen log page");
	}
	else{
		fwrite($fh,$content);
		fclose($fh);
	}
}

?>