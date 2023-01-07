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
    // Aquest bloc passa el participant i executa l'script de python i
    // n'extreu el resultat (extracció o bé nom prohibit) i el codi de sortida
    $player = $_GET["player"];
    $command = escapeshellcmd("python3 python/secretFriend.py '$player'");
    $res = "";
    $output = array();
    $exitCode = 0;
    exec($command, $output, $exitCode);
    $res = $output[0];
    /* NOTA: és l'script de python el que fa la conversió a
    majúscules abans de tornar el nom perquè amb PHP
    era molt complexa la gestió de la codificació UTF-8 */

    if ($exitCode == 1) { // Ja ha participat
        forbidden($res);
    }else {
        yourFriend($res);
    }

    logInstance($player, $res);

    // Dón el resultat de l'extracció
    function yourFriend($out) {
        echo '<div>';
        echo '<h1>HA SORTIT:</h1>';
        echo '<h2>'.$out.'</h2>';
        echo '</div>';
    }

    // Missatge d'error si ja s'havia participat
    function forbidden($out) {
        echo '<div class="forbidden">';
        echo '<h1>UEP!!!</h1>';
        echo '<h2>TU JA HAS PARTICIPAT,<br>'.$out.'<br>¯\_(ツ)_/¯</h2>';
        echo '</div>';
    }

    /* Es fan dos logs separats però de tal manera que el participant
    i el nom extret es corresponguin *exactament* amb la mateixa data,
    de tal manera que l'administrador pot resoldre problemes sense
    saber qui ha tocat a qui */
    function logInstance($player, $extraction) {
        include "checkExisting.php";
        global $exitCode;
        $pLog = "logs/participants.log";
        $exLog = "logs/extractions.log";
        // dos espais per utilitzar la funció partition o split de python
        $date = date("y-m-d H:i:s T  ");
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