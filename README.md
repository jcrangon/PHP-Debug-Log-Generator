# PHP-Debug-Log-Generator
A simple log system that helps debugging php web pages and php ajax routine.
The following explains installation and configuration of the logger.
1. Copy the 'logger' folder into your website folder.
2. Move the file 'debug.conf.php' to your 'conf' folder if you have one, or leave it inside the logger folder.
3. Place the following code on the php page you want to debug just under the 'session_start()' instruction.

session_start();
|------------------------------------------------------------------------
//////////////////////////  LOGGER ///////////////////////////////////////////////

// Enter the relative path to debug.conf.php :  

    $pathto_debug_conf="./conf/debug.conf.php";
    
//Enter relative path to logger folder :

    $pathto_logger_file="./logger";
    
//////////////////////////////////////////////////////////////////////////////////

// Loads the logger if activated 

    include($pathto_debug_conf);
    
    if($_SESSION["usedebug"]==1){
    
      checkloggersession(__FILE__,__LINE__);
      
      $_SESSION["pathtologger"]=$pathto_logger_file; 
      
      $logenabled=true; 
      
      mkpaths($_SESSION["pathtologger"]);  
      
      include($_SESSION["loggerlib"]);
      
      setlogfile($_SESSION["logfile"],__FILE__,__LINE__); 
      
      setlogpage($_SESSION["logpage"],__FILE__,__LINE__); 
      
      checkloggerenv(__FILE__,__LINE__);
      
      mklog(__FILE__,__LINE__);
      
    } 
    
    else{   
    
      $logenabled=false; 
      
    } 
// usage: 

//<code> if($logenabled){wlog("tableau de session",$_SESSION,$_SESSION["logfile"],__FILE__,__LINE__);}</code>

//<code> if($logenabled){wlog("Dans la procedure X","",$_SESSION["logfile"],__FILE__,__LINE__);} </code>

//<code> if($logenabled){wlog($Arg1,$Arg2,$_SESSION["logfile"],__FILE__,__LINE__);}  </code>

////////////////////////////////////////////////////////////////////////////////////////////////////

|-----------------------------------------------------------------------------------------------------------


4. In order to get acces to the control button directly on the page, paste the following code in the top level
<div> of the page:
    
|-----------------------------------------------------------------------------------------------------------

  <?php if($_SESSION["usedebug"]==1){include($_SESSION["loggerdiv"]); }?>
  
|-----------------------------------------------------------------------------------------------------------


5. If the code is an AJAX routine, paste the following right below the 'session_start()' instruction


session_start();

|------------------------------------------------------------------------

//////////////////////////  LOGGER ///////////////////////////////////////////////

// Enter the relative path to debug.conf.php :        

    $ajaxpathto_debug_conf="../conf/debug.conf.php";
    
//Enter relative path to logger folder :

    $ajaxpathto_logger_file="../logger";
    
//////////////////////////////////////////////////////////////////////////////////

// Loads the logger if activated 

    include($ajaxpathto_debug_conf);
    
    if($_SESSION["usedebug"]==1){
    
      checkloggersession(__FILE__,__LINE__);
      
      $_SESSION["ajaxpathtologger"]=$ajaxpathto_logger_file; 
      
      $logenabled=true; 
      
      mkpaths($_SESSION["ajaxpathtologger"]);  
      
      include($_SESSION["ajaxloggerlib"]);
      
      setajaxlogfile($_SESSION["logfile"],__FILE__,__LINE__); 
      
      setajaxlogpage($_SESSION["logpage"],__FILE__,__LINE__); 
      
      checkajaxloggerenv(__FILE__,__LINE__);
      
      mkajaxlog(__FILE__,__LINE__);
      
    } 
    else{   
    
      $logenabled=false; 
      
    } 
    
// usage:                                                                                       

//<code> <pre>if($logenabled){wlog("tableau de session",$_SESSION,$_SESSION["logfile"],__FILE__,__LINE__);} </pre> </code>

// <code>if($logenabled){wlog("Dans la procedure X","",$_SESSION["logfile"],__FILE__,__LINE__);} </code>

// <code>if($logenabled){wlog($Arg1,$Arg2,$_SESSION["logfile"],__FILE__,__LINE__);}     </code> 

////////////////////////////////////////////////////////////////////////////////////////////////////

|-----------------------------------------------------------------------------------------------------------


6. Edit the file 'debug.conf.php' :


/////////////////////////////////////////////////////////////////////////////

// Activation switch 0-OFF, 1-ON 

$_SESSION["usedebug"]=1;

//

/////////////////////////////////////////////////////////////////////////////


7. Usage: place this line inside the code where you want to log variables or check 
the execution of the code :

     
    <code>if($logenabled){wlog($Arg1,$Arg2,$_SESSION["logfile"],_ _ FILE _ _,__LINE__);}</code> 
    
    $Arg1 = description of what is being logged
    
    $Arg2 = variable that will be dumped in the log
    
Using the controls button :
  - 'Show Log' opens a new tab in the browser and displays the content of the log file
  - 'clear Log' deletes all contents il the log file.

Found this simple, logging systeme very practical to debug such things as google recaptcha for instance.

Have fun!!
