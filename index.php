<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Amic invisible</title>
    <link rel="stylesheet" href="styles/index.css">
    <script src="script.js"></script>
</head>
<body>
    <div>
    <h1>AMIC INVISIBLE</h1>
    <h2>Digues qui ets<br>i et trauré el teu amic invisible</h2>
        <form action="secretFriend.php" method="get">
            <select name="player" id="player">
                <option value="" disabled selected>-- QUI ETS? --</option>
                <?php
                $command = escapeshellcmd("python3 python/optgroups.py");
                echo shell_exec($command);
                ?>
            </select>
            <input type="submit" value="D'acord">
        </form>
        <p>
            No sortirà ni el teu propi nom ni cap membre
            de la teva unitat familiar <br>
            <b>Tria bé el teu nom</b> perquè només es pot
            participar un pic <br><span>(i si t'equivoques donaràs
            molts mals de caps a en Bernat de sa Papereria per
            arreglar-ho...) :(</span><br>
            Apunta bé o fes captura del nom que et toqui perquè <b>només
            el veruàs un pic</b> i es perdrà quan tanquis o recarreguis
            la pàgina<br>
            <span>Si et passa això o hi ha algun problema contacta amb
            en Bernat de sa Papereria</span>
        </p>
    </div>
</body>
</html>
