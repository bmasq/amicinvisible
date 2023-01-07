<?php

/* De moment el nom d'aquest fitxer és reset<codi 6 dígits>.php
per donar-li una mica més de seguretat (un poc de bromes)
i qualsevol no el pugui executar */

$command = escapeshellcmd("python3 python/reset.py");
echo shell_exec($command);

// loga el reset
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