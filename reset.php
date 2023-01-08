<?php

/* 
It calls 'reset.py' so the name extraction
can begin from zero.

WARNING: Ultra-super-mega INSECURE. It can be called by *anyone*.
There is a future plan to protect this file, with HTTP basic
authentication (see README.md)
*/

include "checkExisting.php";

$command = escapeshellcmd("python3 python/reset.py");
shell_exec($command);

// logs the reset
$pLog = "logs/participants.log";
$exLog = "logs/extractions.log";
$date = date("y-m-d H:i:s T  ");
$ip = "  FROM ".$_SERVER["REMOTE_ADDR"];

$str = "\n".$date."FORBIDDEN EMPTIED".$ip."\n\n";
$file = fopen($pLog, "a");
fwrite($file, $str);
fclose($file);

$str = "\n".$date."POOL RESET".$ip."\n\n";
$file = fopen($exLog, "a");
fwrite($file, $str);
fclose($file);
?>