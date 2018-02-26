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
		$lmsg="Appel checkajaxloggerenv() @".$location." correctement executé, variables de session vérifées.";
		$line=mkajaxline($lmsg);
		fwrite($fh,$line);
		fclose($fh);
	}
}

function mkajaxline($lmsg){
	$now=date("d-m-Y H:i:s");
	$ipAddress = $_SERVER['REMOTE_ADDR'];
	if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
		$exploded= explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
		$ipAddress = array_pop($exploded);
	}
	$line="[".$now."] -> [".$ipAddress."]- ".$lmsg." \n";
	return $line;
}

function setajaxlogfile($file,$f,$l){
	$location=$f." Line ".$l;
	if(!$fh=fopen($file,"a")){
		die("setajaxlogfile() : cannot fopen log file");
	}
	else{
		$lmsg="Appel setajaxlogfile() @".$location;
		$line=mkajaxline($lmsg);
		fwrite($fh,$line);
		fclose($fh);
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
			$lmsg="Appel setajaxlogpage() @".$location;
			$line=mkajaxline($lmsg);
			fwrite($fh,$line);
			fclose($fh);
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
		$lmsg="Appel mkajaxlog() @".$location." ..... Starting the ajax log .............";
		$line=mkajaxline($lmsg);
		fwrite($fh,$line);
		fclose($fh);
	}
	$content=file_get_contents($file);
	$htmlcontent="<pre>".$content."</pre>";
	loadajaxlogpage($htmlcontent);
}


function wlog( $varname, $vardata,$file, $f,$l){
	$location=$f." Line ".$l;
	$serialized=print_r($vardata,true);  // true permet de recup la valeur de print_r sans l'afficher a l'ecran
	if(!$fh=fopen($file,"a")){
		die("setlogfile() : cannot fopen log file @".$location);
	}
	else{
		$lmsg="wlog @ ".$location.": \n".$varname." = ".$serialized;
		$line=mkajaxline($lmsg);
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