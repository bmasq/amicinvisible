<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Resultat</title>
    <link rel="stylesheet" href="styles/result.css">
    <script src="script.js"></script>
</head>
<body>
    <?php
    // This block passes the participant to the python script and
    // extracts its output (successful extraction of a name or 
    // forbidden player - they have already participated) and an exit code
    $player = $_GET["player"];
    $command = escapeshellcmd("python3 python/secretFriend.py '$player'");
    $res = "";
    $output = array();
    $exitCode = 0;
    exec($command, $output, $exitCode);
    $res = $output[0];
    /* NOTE: The python script capitalizes the output, before
    returning it because handling UTF-8 encoding with PHP is
    much more complex */

    if ($exitCode == 1) { // Ja ha participat
        forbidden($res);
    }else {
        yourFriend($res);
    }

    logInstance($player, $res);

    // Displays the extraction result
    function yourFriend($out) {
        echo '<div>';
        echo '<h1>HA SORTIT:</h1>';
        echo '<h2>'.$out.'</h2>';
        echo '</div>';
    }

    // Displays error message if already participated
    function forbidden($out) {
        echo '<div class="forbidden">';
        echo '<h1>UEP!!!</h1>';
        echo '<h2>TU JA HAS PARTICIPAT,<br>'.$out.'<br>¯\_(ツ)_/¯</h2>';
        echo '</div>';
    }

    /* There are two separate logs, one containing participants and the
    other containing the extracted names. They correspond with each other
    with the *exact* same date, this way the administrator can resolve
    conflicts or problems without knowing which name got each player */
    function logInstance($player, $extraction) {
        include "checkExisting.php";
        global $exitCode;
        $pLog = "logs/participants.log";
        $exLog = "logs/extractions.log";
        // two spaces to use the 'partition' or 'split' python function
        $date = date("y-m-d H:i:s T  ");
        // logs the player's IP address (purpose unknown for now)
        $ip = "  FROM ".$_SERVER["REMOTE_ADDR"];

        if ($exitCode != 1) {
            $str = $date.$extraction.$ip."\n";
            $file = fopen($exLog, "a");
            fwrite($file, $str);
            fclose($file);
        }

        $str = $date.$player;
        if ($exitCode == 1) {
            $str .= " RETRY ERROR".$ip."\n";
        }else {
            $str .= $ip."\n";
        }
        $file = fopen($pLog, "a");
        fwrite($file, $str);
        fclose($file);
    }

    ?>
</body>
</html>