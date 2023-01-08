<?php

/* 
It uses a form where a PIN or password must be introduced,
in order to be executed.

Only accepts alphanumeric characters.

WARNING: Fairly INSECURE (post over HTTP).
*/

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pass = 880870;
    if ($_POST["pass"] == $pass) {

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
        echo "$str<br>"; // feedback

        $str = "\n".$date."POOL RESET".$ip."\n\n";
        $file = fopen($exLog, "a");
        fwrite($file, $str);
        fclose($file);
        echo "$str<br>"; // feedback

    }else {
        echo '<span style="color: red; font-size: 20px;">';
        echo 'CONTRASENYA INCORRECTA</span><br>';
    }
}
?>
<br>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <label for="pass">Contrasenya:</label>
    <input type="password" name="pass" id="pass" pattern="[a-zA-Z0-9]+">
    <input type="submit" value="Executa">
</form>