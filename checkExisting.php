<?php
# self-explanatory
if (!file_exists("logs")) {
    mkdir("logs", 0775);
}

/* It initializes the files 'forbidden' (empty) and
'pool' (with all the participants). It only runs
the first time index.php is called, after deployment */
if (!file_exists("forbidden") || !file_exists("pool")) {
    $command = escapeshellcmd("python3 python/reset.py");
    shell_exec($command);
}
?>