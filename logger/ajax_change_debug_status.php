<?php
session_start();

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

function append_data_in_file($file,$txt){
	if(!$handle = fopen($file, "a")){
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
	$file='./log.txt';
	if($_SESSION["logenabled"]){
		$txt="\n\n*********** DESACTIVATION DU LOGGER **********\n";
	}
	else{
		$txt="\n\n*********** REACTIVATION DU LOGGER **********\n";
	}
	append_data_in_file($file,$txt);
	$content=file_get_contents($file);
	$htmlcontent="<pre>".$content."</pre>";
	$file="./log.php";
	if(!$fh=fopen($file,"w")){
		echo "cannotopenlogphpfile";
		exit();
	}
	else{
		fwrite($fh,$htmlcontent);
		fclose($fh);
	}
	echo "oktoutbon";
	exit();
}
?>